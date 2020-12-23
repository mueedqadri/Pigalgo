<p class="gdpr-terms-container">
	<span for="gdpr_terms">
		<input type="checkbox" required name="gdpr_terms" id="gdpr_terms" value="1" />
		<?php $enabled = gdpr( 'options' )->get( 'enable_tac' ); ?>
		<?php
		wp_enqueue_script( 'jquery' );
		wp_register_style( 'gdpr-consent-until', gdpr( 'config' )->get( 'plugin.url' ) . 'assets/css/consentuntil.min.css', array(), true );
		wp_register_script( 'gdpr-consent-until-js', gdpr( 'config' )->get( 'plugin.url' ) . 'assets/js/consentuntil.min.js', array(), true, true );
		wp_register_style( 'gdpr-consent-until-dashicons', includes_url() . '/css/dashicons.min.css', array(), true );
		wp_enqueue_script( 'gdpr-consent-until-js' );
		wp_enqueue_style( 'gdpr-consent-until' );
		wp_enqueue_style( 'gdpr-consent-until-dashicons' );
		if ( ! isset( $gdpr_value ) ) :
			$gdpr_value = '';
		endif;
		if ( ! isset( $gdpr_arg2 ) ) :
			$gdpr_arg2 = '';
		endif;
		if ( ! isset( $gdpr_arg3 ) ) :
			$gdpr_arg3 = '';
		endif;
		if ( $termsUrl && $enabled ) :

			add_filter( 'gdpr-framework-consent-policy-with-terms', 'TermAndConditionWithPrivacyContent' );
			$gdpr_text_policy_with_terms = apply_filters( 'gdpr-framework-consent-policy-with-terms', $gdpr_value, $gdpr_arg2, $gdpr_arg3 );
			?>
		<?php
			echo sprintf(
				__( $gdpr_text_policy_with_terms, 'gdpr-framework' ),
				"<a href='{$termsUrl}' target='_blank'>",
				'</a>',
				"<a href='{$privacyPolicyUrl}' target='_blank'>",
				'</a>'
			);
			?>
		<?php else : ?>

		<?php
			add_filter( 'gdpr-framework-consent-policy', 'gdprfPrivacyPolicy' );
			$gdpr_text_policy = apply_filters( 'gdpr-framework-consent-policy', $gdpr_value, $gdpr_arg2, $gdpr_arg3 );
			?>
		<?php
			echo sprintf(
				__( $gdpr_text_policy, 'gdpr-framework' ),
				"<a href='{$privacyPolicyUrl}' target='_blank'>",
				'</a>'
			);
			?>
		<?php endif; ?><? if( get_option( 'gdpr_consent_until_display' ) === '1' ){ ?>* for<? } ?>
		
	</span>
	<? if( get_option( 'gdpr_consent_until_display' ) === '1' ){ ?>
	<span class="gdpr-consent-until-wrap">
			<span class="dashicons dashicons-calendar-alt gdpr-consent-until-cal"><span class="tooltiptext">Click to select the duration you give consent until.</span></span>
			<select id="gdpr-consent-until" class="gdpr-consent-until" name="gdpr-consent-until">
				<option value="" default>Indefinite</option>
				<option value="1">1 Month</option>
				<option value="3">3 Months</option>
				<option value="6">6 Months</option>
			</select>
		</span>
		<? } ?>
</p>
