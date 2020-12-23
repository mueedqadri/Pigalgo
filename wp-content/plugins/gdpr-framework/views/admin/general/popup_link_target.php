<select class="gdpr-select js-gdpr-conditional" name="gdpr_popup_link_target">
<option value="_blank" <?= selected($content, '_blank'); ?>>
    <?= esc_html_x('Next Tab', '(Admin)', 'gdpr-framework') ?>
</option>
<option value="_self" <?= selected($content, '_self'); ?>>
    <?= esc_html_x('Self', '(Admin)', 'gdpr-framework') ?>
</option>
</select>
