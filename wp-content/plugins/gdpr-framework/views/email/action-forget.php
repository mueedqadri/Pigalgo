<p>
    <?= esc_html_x(
        sprintf('A data subject (%s) has just removed all their data from your website.', esc_html($email)),
        '(Admin)', 'gdpr-framework'
    ); ?> <br><br>

    <?php if ($userId): ?>
        <?= esc_html_x('The data subject had a user account on your website.', '(Admin)', 'gdpr-framework'); ?> (ID: <?= $userId; ?>).
    <?php endif; ?>
</p>
<p>
    <?= esc_html_x('This email is just for your information. You don\'t need to take any action', '(Admin)', 'gdpr-framework'); ?>
</p>
