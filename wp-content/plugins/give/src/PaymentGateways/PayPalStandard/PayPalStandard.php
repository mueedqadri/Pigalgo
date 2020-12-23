<?php

namespace Give\PaymentGateways\PayPalStandard;

use Give\PaymentGateways\PaymentGateway;

class PayPalStandard implements PaymentGateway {
	/**
	 * @inheritDoc
	 */
	public function getId() {
		return 'paypal';
	}

	/**
	 * @inheritDoc
	 */
	public function getName() {
		return esc_html__( 'PayPal Standard', 'give' );
	}

	/**
	 * @inheritDoc
	 */
	public function getPaymentMethodLabel() {
		return esc_html__( 'PayPal', 'give' );
	}

	/**
	 * @inheritDoc
	 */
	public function getOptions() {
		return [
			// Section 2: PayPal Standard.
			[
				'type' => 'title',
				'id'   => 'give_title_gateway_settings_2',
			],
			[
				'name' => esc_html__( 'PayPal Email', 'give' ),
				'desc' => esc_html__( 'Enter the email address associated with your PayPal account to connect with the gateway.', 'give' ),
				'id'   => 'paypal_email',
				'type' => 'email',
			],
			[
				'name' => esc_html__( 'PayPal Page Style', 'give' ),
				'desc' => esc_html__( 'Enter the name of the PayPal page style to use, or leave blank to use the default.', 'give' ),
				'id'   => 'paypal_page_style',
				'type' => 'text',
			],
			[
				'name'    => esc_html__( 'PayPal Transaction Type', 'give' ),
				'desc'    => esc_html__( 'Nonprofits must verify their status to withdraw donations they receive via PayPal. PayPal users that are not verified nonprofits must demonstrate how their donations will be used, once they raise more than $10,000. By default, GiveWP transactions are sent to PayPal as donations. You may change the transaction type using this option if you feel you may not meet PayPal\'s donation requirements.', 'give' ),
				'id'      => 'paypal_button_type',
				'type'    => 'radio_inline',
				'options' => [
					'donation' => esc_html__( 'Donation', 'give' ),
					'standard' => esc_html__( 'Standard Transaction', 'give' ),
				],
				'default' => 'donation',
			],
			[
				'name'    => esc_html__( 'Billing Details', 'give' ),
				'desc'    => esc_html__( 'If enabled, required billing address fields are added to PayPal Standard forms. These fields are not required by PayPal to process the transaction, but you may have a need to collect the data. Billing address details are added to both the donation and donor record in GiveWP.', 'give' ),
				'id'      => 'paypal_standard_billing_details',
				'type'    => 'radio_inline',
				'default' => 'disabled',
				'options' => [
					'enabled'  => esc_html__( 'Enabled', 'give' ),
					'disabled' => esc_html__( 'Disabled', 'give' ),
				],
			],
			[
				'name'    => esc_html__( 'PayPal IPN Verification', 'give' ),
				'desc'    => esc_html__( 'If enabled, IPN (Instant Payment Notification) messages sent to your site from PayPal are verified with an extra (background) step. The IPN is what marks PayPal donations as complete on GiveWP\'s side. If donations are not getting marked as complete, disabling this extra verification step can resolve it. Only disable this setting to resolve the pending donation issue, since it is technically less secure.', 'give' ),
				'id'      => 'paypal_verification',
				'type'    => 'radio_inline',
				'default' => 'enabled',
				'options' => [
					'enabled'  => esc_html__( 'Enabled', 'give' ),
					'disabled' => esc_html__( 'Disabled', 'give' ),
				],
			],
			[
				'id'      => 'paypal_invoice_prefix',
				'name'    => esc_html__( 'Invoice ID Prefix', 'give' ),
				'desc'    => esc_html__( 'Please enter a prefix for your invoice numbers. If you use your PayPal account for multiple fundraising platforms or ecommerce stores, ensure this prefix is unique. PayPal will not allow orders or donations with the same invoice number.', 'give' ),
				'type'    => 'text',
				'default' => 'GIVE-',
			],
			[
				'name'  => esc_html__( 'PayPal Standard Gateway Settings Docs Link', 'give' ),
				'id'    => 'paypal_standard_gateway_settings_docs_link',
				'url'   => esc_url( 'http://docs.givewp.com/settings-gateway-paypal-standard' ),
				'title' => esc_html__( 'PayPal Standard Gateway Settings', 'give' ),
				'type'  => 'give_docs_link',
			],
			[
				'type' => 'sectionend',
				'id'   => 'give_title_gateway_settings_2',
			],
		];
	}

	/**
	 * @inheritDoc
	 */
	public function boot(){}
}
