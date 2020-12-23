<p>
    <?= esc_html_x('Heads up! The GDPR Framework is not properly configured, so it will not work just yet.', '(Admin)', 'gdpr-framework'); ?> <br>
    <?= sprintf(
        esc_html_x('Go to %sTools > Data443 GDPR%s and make sure all fields are filled in.', '(Admin)', 'gdpr-framework'),
        "<a href='" . gdpr('helpers')->getAdminUrl() . "'>",
        '</a>'
    ); ?>
</p>
