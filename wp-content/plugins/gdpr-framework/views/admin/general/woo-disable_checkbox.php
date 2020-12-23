<input
    type="checkbox"
    id="gdpr_disable_checkbox_woo_compatibility"
    name="gdpr_disable_checkbox_woo_compatibility"
    value="1"
    <?= checked($enabled, true); ?>
/> 

<label for="gdpr_disable_checkbox_woo_compatibility">
    <?= esc_html_x('Disable WooCommerce Privacy Checkbox', '(Admin)', 'gdpr-framework'); ?>
</label>