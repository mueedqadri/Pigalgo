<option value="anonymize" <?= selected($deleteAction, 'anonymize'); ?>>
    <?= esc_html_x('Automatically anonymize data', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="delete" <?= selected($deleteAction, 'delete'); ?> data-show=".js-gdpr-delete-action-reassign">
    <?= esc_html_x('Automatically delete data', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="anonymize_and_notify" <?= selected($deleteAction, 'anonymize_and_notify'); ?>
        data-show=".js-gdpr-delete-action-email">
    <?= esc_html_x('Automatically anonymize data and notify me via email', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="delete_and_notify" <?= selected($deleteAction, 'delete_and_notify'); ?>
        data-show=".js-gdpr-delete-action-email, .js-gdpr-delete-action-reassign">
    <?= esc_html_x('Automatically delete data and notify me via email', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="notify" <?= selected($deleteAction, 'notify'); ?> data-show=".js-gdpr-delete-action-email">
    <?= esc_html_x('Only notify me via email', '(Admin)', 'gdpr-framework') ?>
</option>



