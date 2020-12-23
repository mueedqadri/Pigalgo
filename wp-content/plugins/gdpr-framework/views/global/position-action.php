<option value="bottom" <?= selected($positionAction, ''); ?>>
    <?= esc_html_x('Banner bottom', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="bottom-left" <?= selected($positionAction, 'bottom-left'); ?>>
    <?= esc_html_x('Floating left', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="bottom-right" <?= selected($positionAction, 'bottom-right'); ?>>
    <?= esc_html_x('Floating Right', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="top" <?= selected($positionAction, 'top'); ?>>
    <?= esc_html_x('Banner top', '(Admin)', 'gdpr-framework') ?>
</option>