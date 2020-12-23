<input type="text" class="gdpr-color-picker" name="gdpr_popup_<?php echo $content['option'];?>" id='color-picker' value="<?php if($content['value']!=""){?>
<?= esc_html_x($content['value'], 'gdpr-framework');?>
<?php } ?>" />