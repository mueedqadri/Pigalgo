<input
    type="checkbox"
    id="gdpr_policy_popup"
    name="gdpr_policy_popup"
    value="1"
    <?= checked($enabled, true); ?>
/>
<label for="gdpr_policy_popup">
    <?= esc_html_x('Enable Policy Link On Popup', '(Admin)', 'gdpr-framework'); ?>
</label>
