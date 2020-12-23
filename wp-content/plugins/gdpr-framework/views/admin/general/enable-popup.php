<input
    type="checkbox"
    id="gdpr_enable_popup"
    name="gdpr_enable_popup"
    value="1"
    <?= checked($enabled, true); ?>
/>
<label for="gdpr_enable_popup">
    <?= esc_html_x('Enable Cookie Acceptance Popup', '(Admin)', 'gdpr-framework'); ?>
</label>
<p class="description">
    <?= _x('<b>Note:</b> Need to add custom content <b>gdpr_cookie_consent</b> its accepted on popup accept button.', '(Admin)', 'gdpr-framework'); ?>
</p>
