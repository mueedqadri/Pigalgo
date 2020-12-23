<label for="gdpr_classidocs_integration">
    <input
        type="checkbox"
        name="gdpr_classidocs_integration"
        id="gdpr_classidocs_integration"
        class="js-gdpr-conditional"
        value="yes"
        <?= checked($hasclassidocs_integration, 'yes'); ?>
    >
    (<?= esc_html_x('Sign up for free here', '(Admin)', 'gdpr-framework'); ?>: <a target="_blank" href="https://info.data443.com/meetings/data443/classidocs-demo"><?= esc_html_x('Click Here', '(Admin)', 'gdpr-framework'); ?></a>)
</label>