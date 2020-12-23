<input
    type="checkbox"
    id="gdpr_enable_edd_compatibility"
    name="gdpr_enable_edd_compatibility"
    value="1"
    <?= checked($enabled, true); ?>
/>
<label for="gdpr_enable_edd_compatibility">
    <?= esc_html_x('Enable EDD data on GDPR tool.', '(Admin)', 'gdpr-framework'); ?>
</label>
<p class="description">
    <?= esc_html_x('Will work for EDD Version 2.0.0 or later.', '(Admin)', 'gdpr-framework'); ?>
</p>