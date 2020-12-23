<input type="text" class="gdpr-text-field" name="gdpr_popup_learnmore_text" value="<?php if($content!=""){?>
<?= esc_html_x($content, 'gdpr-framework');?>
<?php } else { ?><?= esc_html_x('Learn more', 'gdpr-framework');?><?php } ?>" />