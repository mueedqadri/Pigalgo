<p>
    <?= esc_html_x('On this page, you can find which data subjects personal data you are storing and download, export or delete it.', '(Admin)', 'gdpr-framework'); ?>
</p>

<hr>

<?= $results; ?>

<label>
    <h3><?= esc_html_x('Find data subject by email', '(Admin)', 'gdpr-framework'); ?></h3>
    <input type="email" name="gdpr_email" placeholder="<?= esc_html_x('Email address', '(Admin)', 'gdpr-framework'); ?>" />
</label>

<input type="hidden" name="gdpr_nonce" value="<?= $nonce; ?>" />
<input type="hidden" name="gdpr_action" value="search" />
<input class="button button-primary" type="submit" value="<?= esc_html_x('Search', '(Admin)', 'gdpr-framework'); ?>" />

<br><br>
