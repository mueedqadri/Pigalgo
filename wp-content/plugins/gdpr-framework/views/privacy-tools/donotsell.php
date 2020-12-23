<?php do_action('gdpr/privacy-tools-page/donotsell/before'); ?>
            <div class="gdpr-notice" id="doNotSellAlert"style="display:none">
            <div class="alert alert-primary" role="alert">
            <h2>Your request has been submitted. Depending on your history with Widget Manufacturing Company and the number of other requests we are processing, it may take up 
            to 45 days to complete your request. We will email you at the address you provided when the request has been handled. If you have any 
            questions, feel free to contact us at contact@wmc.com.</h2></div>    
            </div><div class="gdpr-notice" id="captchaAlert"style="display:none">
            <div class="alert alert-danger" role="alert">
            <h2>Captcha is invalid!</h2></div>    
            </div>

<form id="form-new-post">
        <fieldset>
            <h4 class="mt-0"><?= __('Do Not Sell Request', 'gdpr-framework') ?></h4>
            <span id="donotsellmsg" class="msg"></span>
            <span id="donotsell-error-msg" class="msg"></span>
            
<div class="form_row" style="display:block" > 
                <div class="col_6">
                    <div class="form-group">
                        <input type="text" class="form-control"  placeholder="First Name" id="donotsell_first_name" name="donotsell_first_name" value="<?= ($first_name !='') ? esc_html($first_name):''; ?>" required/>
                    </div>
                </div>
                <div class="col_6">
                    <div class="form-group">
                        <input type="text" class="form-control"  placeholder="Last Name" id="donotsell_last_name" name="donotsell_last_name" value="<?= ($last_name !='') ? esc_html($last_name):''; ?>" required/>
                        
                    </div>
                </div>
                <div class="col_12">
                    <div class="form-group">
                        <input type="email" class="form-control"  placeholder="Email" id="donotsell_email" name="donotsell_email" value="<?= ($user_email !='') ? esc_html($user_email):''; ?>" required/>
                    </div>
                </div>
            </div>
            
            <?php if(!empty($defaultConsentTypes)){ ?>
                <div class="form-group">
                    <label for="donotsell_consent" class="form_p">
                        <input type="checkbox" name="donotsell_consent" id="donotsell_consent" class="js-gdpr-conditional form_check" data-show=".gdpr-terms-page" value="yes" required>
                        <?= __(esc_html($defaultConsentTypes['title']), 'gdpr-framework') ?>
                    </label>
                </div>
                <div class="form-group">
                    <p class="form_p"><?= __(esc_html($defaultConsentTypes['description']), 'gdpr-framework') ?></p>
                </div>
            <?php }else{ ?>
                <div class="form-group">
                    <label for="donotsell_consent" class="form_p">
                        <input type="checkbox" name="donotsell_consent" id="donotsell_consent" class="js-gdpr-conditional form_check" data-show=".gdpr-terms-page" value="yes" required>
                        <?= __('I agree to receive other communications from GDPR', 'gdpr-framework') ?>
                    </label>
                </div>
                <div class="form-group"><p class="form_p"></p></div>
            <?php } ?>
                <button type="submit"
                        class="submit"
                        id="do-not-sell-submit"
                        data-is-updated="false"
                        data-is-update-text="UPDATE"
                        >Send Request
                </button>
        </fieldset>
    </form>
<?php echo '<!-- PRIVACYSAFEKEY'.get_option("privacysafe").'-->'; ?>  