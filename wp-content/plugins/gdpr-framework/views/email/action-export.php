<p>
    <?= esc_html_x(
        sprintf('A data subject (%s) has just downloaded their data in %s format.', esc_html($email), esc_html($format)),
        '(Admin)', 'gdpr-framework'
    ); ?>
</p>
<p>
    <?= esc_html_x('This email is just for your information. You don\'t need to take any action', '(Admin)', 'gdpr-framework'); ?>
</p>
