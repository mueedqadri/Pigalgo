<input
    type="checkbox"
    id="gdpr_enable_tac"
    name="gdpr_enable_tac"
    value="1"
    <?= checked($enabled, true); ?>
/>
<label for="gdpr_enable_tac">
    <?= esc_html_x('Enable the term and condition page.', '(Admin)', 'gdpr-framework'); ?>
</label>
