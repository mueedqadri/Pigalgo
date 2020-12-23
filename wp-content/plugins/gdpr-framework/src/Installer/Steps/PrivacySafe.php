<?php


namespace Codelight\GDPR\Installer\Steps; 

use Codelight\GDPR\Installer\InstallerStep;
use Codelight\GDPR\Installer\InstallerStepInterface;

class PrivacySafe extends InstallerStep implements InstallerStepInterface {
	protected $slug = 'privacy-safe';

	protected $type = 'wizard';

	protected $template = 'installer/steps/privacy-safe';

	protected $activeSteps = 0;

	public function submit() {
		if ( isset( $_POST['gdpr_privacy_safe_params'] ) ) {
			$seal_code  = sanitize_text_field( wp_unslash( $_POST['gdpr_privacy_safe_params'] ) );
			$image_code = sanitize_text_field( wp_unslash( $_POST['gdpr_privacy_safe_imagecode'] ) );
			if ( ! get_option( 'gdpr_privacy_safe_params' ) ) {
				gdpr( 'options' )->set( 'gdpr_privacy_safe_params', $seal_code );
			} else {
				update_option( 'gdpr_privacy_safe_params', $seal_code );
			}
			if ( ! get_option( 'gdpr_privacy_safe_imagecode' ) ) {
				gdpr( 'options' )->set( 'gdpr_privacy_safe_imagecode', $image_code );
			} else {
				update_option( 'gdpr_privacy_safe_imagecode', $image_code );
			}
		}

	}
}
