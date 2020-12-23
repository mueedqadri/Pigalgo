
<input type="url" name="gdpr_custom_tools_page" value="<?php if($content!=""){?>
<?= esc_html_x($content, 'gdpr-framework');?>
<?php } ?>" />
<p class="description">
    <?= esc_html_x('Leave blank if privacy tools page already selected', '(Admin)', 'gdpr-framework'); ?>
</p>
