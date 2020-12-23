<?php

namespace Give\PaymentGateways\PayPalCommerce;

use Give\ConnectClient\ConnectClient;
use Give\PaymentGateways\PayPalCommerce\Models\MerchantDetail;
use Give\PaymentGateways\PayPalCommerce\Repositories\MerchantDetails;
use Give\PaymentGateways\PayPalCommerce\Repositories\PayPalAuth;
use Give\PaymentGateways\PayPalCommerce\Repositories\Settings;
use Give\PaymentGateways\PayPalCommerce\Repositories\Webhooks;
use Give\PaymentGateways\PayPalCommerce\Repositories\PayPalOrder;

/**
 * Class AjaxRequestHandler
 * @package Give\PaymentGateways\PaypalCommerce
 *
 * @sicne 2.9.0
 */
class AjaxRequestHandler {
	/**
	 * @since 2.9.0
	 *
	 * @var Webhooks
	 */
	private $webhooksRepository;

	/**
	 * @since 2.9.0
	 *
	 * @var MerchantDetail
	 */
	private $merchantDetails;

	/**
	 * @since 2.9.0
	 *
	 * @var PayPalAuth
	 */
	private $payPalAuth;

	/**
	 * @since 2.9.0
	 *
	 * @var MerchantDetails
	 */
	private $merchantRepository;

	/**
	 * @since 2.9.0
	 *
	 * @var ConnectClient
	 */
	private $refreshToken;

	/**
	 * @since 2.9.0
	 *
	 * @var Settings
	 */
	private $settings;

	/**
	 * AjaxRequestHandler constructor.
	 *
	 * @since 2.9.0
	 *
	 * @param Webhooks        $webhooksRepository
	 * @param MerchantDetail  $merchantDetails
	 * @param MerchantDetails $merchantRepository
	 * @param RefreshToken    $refreshToken
	 * @param Settings        $settings
	 * @param PayPalAuth      $payPalAuth
	 */
	public function __construct(
		Webhooks $webhooksRepository,
		MerchantDetail $merchantDetails,
		MerchantDetails $merchantRepository,
		RefreshToken $refreshToken,
		Settings $settings,
		PayPalAuth $payPalAuth
	) {
		$this->webhooksRepository = $webhooksRepository;
		$this->merchantDetails    = $merchantDetails;
		$this->merchantRepository = $merchantRepository;
		$this->refreshToken       = $refreshToken;
		$this->settings           = $settings;
		$this->payPalAuth         = $payPalAuth;
	}

	/**
	 *  give_paypal_commerce_user_onboarded ajax action handler
	 *
	 * @since 2.9.0
	 */
	public function onBoardedUserAjaxRequestHandler() {
		$this->validateAdminRequest();

		$partnerLinkInfo = $this->settings->getPartnerLinkDetails();

		$payPalResponse = $this->payPalAuth->getTokenFromAuthorizationCode(
			give_clean( $_GET['authCode'] ),
			give_clean( $_GET['sharedId'] ),
			$partnerLinkInfo['nonce']
		);

		if ( ! $payPalResponse ) {
			wp_send_json_error();
		}

		$this->settings->updateAccessToken( $payPalResponse );

		give( RefreshToken::class )->registerCronJobToRefreshToken( $payPalResponse['expiresIn'] );

		wp_send_json_success();
	}

	/**
	 * give_paypal_commerce_get_partner_url action handler
	 *
	 * @since 2.9.0
	 */
	public function onGetPartnerUrlAjaxRequestHandler() {
		$this->validateAdminRequest();

		if ( empty( $country = $_GET['countryCode'] ) || ! isset( give_get_country_list()[ $country ] ) ) {
			wp_send_json_error( 'Must include valid 2-character country code' );
		}

		$data = $this->payPalAuth->getSellerPartnerLink(
			admin_url( 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=paypal&group=paypal-commerce' ),
			$country
		);

		if ( ! $data ) {
			wp_send_json_error();
		}

		$this->settings->updateAccountCountry( $country );
		$this->settings->updatePartnerLinkDetails( $data );

		wp_send_json_success( $data );
	}

	/**
	 * give_paypal_commerce_disconnect_account ajax request handler.
	 *
	 * @since 2.9.0
	 */
	public function removePayPalAccount() {
		$this->validateAdminRequest();

		// Remove the webhook from PayPal if there is one
		if ( $webhookConfig = $this->webhooksRepository->getWebhookConfig() ) {
			$this->webhooksRepository->deleteWebhook( $this->merchantDetails->accessToken, $webhookConfig->id );
			$this->webhooksRepository->deleteWebhookConfig();
		}

		$this->merchantRepository->delete();
		$this->merchantRepository->deleteAccountErrors();
		$this->merchantRepository->deleteClientToken();
		$this->refreshToken->deleteRefreshTokenCronJob();

		wp_send_json_success();
	}

	/**
	 * Create order.
	 *
	 * @todo: handle payment create error on frontend.
	 *
	 * @since 2.9.0
	 */
	public function createOrder() {
		$this->validateFrontendRequest();

		$postData = give_clean( $_POST );
		$formId   = absint( $postData['give-form-id'] );

		$data = [
			'formId'              => $formId,
			'donationAmount'      => isset( $postData['give-amount'] ) ? (float) apply_filters( 'give_donation_total', give_maybe_sanitize_amount( $postData['give-amount'], [ 'currency' => give_get_currency( $formId ) ] ) ) : '0.00',
			'payer'               => [
				'firstName' => $postData['give_first'],
				'lastName'  => $postData['give_last'],
				'email'     => $postData['give_email'],
			],
			'application_context' => [
				'shipping_preference' => 'NO_SHIPPING',
			],
		];

		try {
			$result = give( PayPalOrder::class )->createOrder( $data );

			wp_send_json_success(
				[
					'id' => $result,
				]
			);
		} catch ( \Exception $ex ) {
			wp_send_json_error(
				[
					'error' => json_decode( $ex->getMessage(), true ),
				]
			);
		}
	}

	/**
	 * Approve order.
	 *
	 * @todo: handle payment capture error on frontend.
	 *
	 * @since 2.9.0
	 */
	public function approveOrder() {
		$this->validateFrontendRequest();

		$orderId = give_clean( $_GET['order'] );

		try {
			$result = give( PayPalOrder::class )->approveOrder( $orderId );
			wp_send_json_success(
				[
					'order' => $result,
				]
			);
		} catch ( \Exception $ex ) {
			wp_send_json_error(
				[
					'error' => json_decode( $ex->getMessage(), true ),
				]
			);
		}
	}

	/**
	 * Validate admin ajax request.
	 *
	 * @since 2.9.0
	 */
	private function validateAdminRequest() {

		if ( ! current_user_can( 'manage_give_settings' ) ) {
			wp_die();
		}
	}

	/**
	 * Validate frontend ajax request.
	 *
	 * @since 2.9.0
	 */
	private function validateFrontendRequest() {
		$formId = absint( $_POST['give-form-id'] );

		if ( ! $formId || ! give_verify_donation_form_nonce( give_clean( $_POST['give-form-hash'] ), $formId ) ) {
			wp_die();
		}
	}
}
