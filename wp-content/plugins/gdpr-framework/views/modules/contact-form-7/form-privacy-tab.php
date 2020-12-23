<h2><?php echo esc_html(__('Privacy', 'gdpr-framework')); ?></h2>
<fieldset>
    <legend>
        <?php //_ex('Privacy configuration', '(Admin)', 'gdpr-framework'); ?>
    </legend>

    <p class="description">
        <label for="gdpr_cf7_enabled">
            <input type="checkbox" id="gdpr_cf7_enabled" name="gdpr_cf7_enabled" value="1" <?= checked($enabled, true); ?>>
            <?php _ex("Include the entries of this form when downloading or deleting a data subject's data.", '(Admin)', 'gdpr-framework'); ?>
        </label>
    </p>

    <br>

    <p class="description">
        <label for="gdpr_cf7_email_field">
            <?php _ex("Select the mail-tag of the sender's email field (for example, your-email).", '(Admin)', 'gdpr-framework'); ?>
            <?php 
            $args = wpcf7_scan_form_tags();
            $contact_form_id = filter_var( $_GET['post'], FILTER_SANITIZE_NUMBER_INT );
            $data = get_post_meta($contact_form_id, 'gdpr_cf7_email_field', true);
            ?>
            <br>
            <select id="gdpr_cf7_email_field" name="gdpr_cf7_email_field" class="large-cf7-select">
                <?php if($args){
                        foreach($args as $arg){
                        if($arg->basetype=="email"){                        
                    ?>            
                        <option value="<?php echo $arg->name?>" <?php if($data == $arg->name){echo 'selected';}?>><?php echo $arg->name?></option>
                    <?php }
                    }
                } ?>
            </select>
  
        </label>
    </p>
</fieldset>