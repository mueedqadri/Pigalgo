<option value="" <?= selected($themeAction, ''); ?>>
    <?= esc_html_x('Default', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="classic" <?= selected($themeAction, 'classic'); ?>>
    <?= esc_html_x('Classic', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="edgeless" <?= selected($themeAction, 'edgeless'); ?>>
    <?= esc_html_x('Edgeless', '(Admin)', 'gdpr-framework') ?>
</option>
