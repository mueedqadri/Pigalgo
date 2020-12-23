<p>
    The GDPR Framework has not been set up yet. Would you like to do that? <br>
    Our setup wizard will guide you through the process. <br>
    You can also configure the plugin manually by going to <a href="<?= gdpr('helpers')->getAdminUrl(); ?>">Tools > Data443 GDPR</a>.
</p>

<a class="button button-primary" href="<?= $installerUrl; ?>">
    <?= esc_html_x('Run the setup wizard', '(Admin)', 'gdpr-framework'); ?>
</a>

<a class="button button-secondary" href="<?= $autoInstallUrl; ?>">
    <?= esc_html_x('Auto-install pages', '(Admin)', 'gdpr-framework'); ?>
</a>

<a class="button button-secondary" href="<?= $skipUrl; ?>">
    <?= esc_html_x('Skip and install manually', '(Admin)', 'gdpr-framework'); ?>
</a>
