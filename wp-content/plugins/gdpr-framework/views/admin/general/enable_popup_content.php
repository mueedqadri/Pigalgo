<textarea name="gdpr_popup_content" rows="5" cols="40">
<?php if($content!=""){?>
<?= esc_html_x($content, 'gdpr-framework');?>
<?php }else{ ?>
<?= esc_html_x('This website uses cookies to ensure you get the best experience on our website.', 'gdpr-framework');?>
<?php } ?>
</textarea>

