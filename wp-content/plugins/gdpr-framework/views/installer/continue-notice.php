<p>
    <?= esc_html_x('The The GDPR Framework setup has not been finalized yet.', '(Admin)', 'gdpr-framework'); ?> <br>
    <?= esc_html_x('You can continue the setup at any time.', '(Admin)', 'gdpr-framework'); ?>
</p>
<a class="button button-primary" href="<?= $buttonUrl; ?>">
    <?= esc_html_x('Continue the setup wizard', '(Admin)', 'gdpr-framework'); ?>
</a>
<a class="button button-secondary" href="<?= $skipUrl; ?>">
    <?= esc_html_x('Hide this message', '(Admin)', 'gdpr-framework'); ?>
</a>
