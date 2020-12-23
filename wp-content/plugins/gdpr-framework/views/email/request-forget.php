<p>
    <?= esc_html_x(
        sprintf('A data subject (%s) has requested to remove their data.', esc_html($email)),
        '(Admin)', 'gdpr-framework'
    ); ?>
    <br>
    <?= esc_html_x(
        sprintf('To access the data subject\'s data, %sclick here%s', "<a href='{$adminTabLink}'>", '</a>'),
        '(Admin)', 'gdpr-framework'
    ); ?>
</p>
<p>
    <?= esc_html_x('As a reminder: according to GDPR, you have 30 days to comply.', '(Admin)', 'gdpr-framework'); ?>
</p>
