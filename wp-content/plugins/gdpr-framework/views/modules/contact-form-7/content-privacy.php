<?php 
    if (!isset($gdpr_value)):
        $gdpr_value = '';
    endif;
    if (!isset($gdpr_arg2)):
        $gdpr_arg2 = '';
    endif;
    if (!isset($gdpr_arg3)):
        $gdpr_arg3 = '';
    endif;
    add_filter( 'gdpr-framework-consent-policy', 'gdprfPrivacyPolicy' );
    $gdpr_text_policy = apply_filters( 'gdpr-framework-consent-policy', $gdpr_value, $gdpr_arg2, $gdpr_arg3 );
    ?>
    
<?= sprintf(
    __( $gdpr_text_policy, 'gdpr-framework'),
    "<a href='{$privacyPolicyUrl}' target='_blank'>",
    '</a>'
    ); ?>
