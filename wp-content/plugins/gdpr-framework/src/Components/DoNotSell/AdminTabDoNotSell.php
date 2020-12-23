<?php

namespace Codelight\GDPR\Components\DoNotSell;

use Codelight\GDPR\Admin\AdminTab;

class AdminTabDoNotSell extends AdminTab {

	/* @var string */
	protected $slug = 'do-not-sell';

	/* @var PolicyGenerator */
	protected $policyGenerator;

	public function __construct() {
		 $this->title = _x( 'Do Not Sell My Data', '(Admin)', 'ccpa-framework' );
		//$this->registerSetting( 'ccpa_privacy_safe_params' );
		//$this->registerSetting( 'ccpa_privacy_safe_imagecode' );

		add_action( 'ccpa/admin/action/PrivacyManager/generate', array( $this, 'generateDoNotSell' ) );

	}

	public function init() {
		/**
		 * Do Not Sell My Data settings
		 */
		$this->registerSettingSection(
			'ccpa_about_privacy_safe_section',
			_x( 'Do Not Sell My Data', '(Admin)', 'ccpa-framework' ),
			array( $this, 'renderAboutHeader' )
		);

		$this->registerSettingField(
			'ccpa_privacy_safe_shortcode',
			_x( 'Shortcode', '(Admin)', 'ccpa-framework' ), 
			array( $this, 'shortcode' ),
			'ccpa_about_privacy_safe_section'
		);
		$this->registerSettingField(
			'ccpa_privacy_safe_shortcodephp',
			_x( 'Shortcode for PHP', '(Admin)', 'ccpa-framework' ),
			array( $this, 'shortcodephp' ),
			'ccpa_about_privacy_safe_section'
		);

	}

	

	public function renderAboutHeader() {
		echo '<p>Place this shortcode on the page you would like to accept requests from users to not sell their information. We recommend placing the shortcode under the privacy tools shortcode on the privacy tools page.</p>';
	}
	
	public function shortcode() {
		echo "<code>[gdpr_do_not_sell_form]</code>";
	}
	public function shortcodephp() {
		echo "<code>echo do_shortcode('[gdpr_do_not_sell_form]');</code>";
	}


}
