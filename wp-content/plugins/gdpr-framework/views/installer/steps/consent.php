<h1>
    Forms and Consent
</h1>

<h2>Introduction</h2>

<p>
    GDPR brings very strict rules for gathering and processing personal data. The most important thing to remember is that
    you need to have <strong>legal grounds</strong> for each and every type of data you gather and process. If you are not
    familiar with what this means, we strongly recommend you read this post from the guide: <br>
    <a href="<?= gdpr('helpers')->docs('legal-grounds-for-processing-data/'); ?>" target="_blank">Consent and other legal grounds for processing data</a>
</p>

<p>
    Under GDPR, <strong>all forms</strong> require special attention. You'll need to explain why you gather the data and
    what you do with it. And if there are no other legal grounds, you'll need to ask for consent.
    Note that your customers must also be able to <strong>withdraw</strong> each consent they have given.
</p>

<h2>WordPress forms</h2>

<p>
    For <strong>posting comments</strong> and <strong>registering accounts</strong>,
    you will need to ask your customers consent to the Privacy Policy. If your site allows comments or registration,
    the GDPR Framework will automatically add consent checkboxes to the respective forms.
</p>

<h2>Withdrawing consent</h2>

<p>
    Your customers can withdraw their given consents on the <a href="<?= $privacyToolsPageUrl; ?>" target="blank">Privacy Tools Page</a>.
</p>
<br>
<hr>

<?php if ($hasGravityForms): ?>
    <h2>&#10004; Gravity Forms</h2>
    <p>
        We have detected that Gravity Forms is enabled on your site.
        You can Use <a  target="_blank" href="https://wordpress.org/plugins/gdpr-for-gravity-forms/">Gravity Forms: GDPR Add-On</a> to make Gravity Forms compatibility to the GDPR Framework.
    </p>
    <hr>
<?php endif; 
if ($hasFrm): ?>
    <h2>&#10004; Formidable Forms</h2>
    <p>
        We have detected that Formidable Forms is enabled on your site.
        You can Use <a  target="_blank" href="https://wordpress.org/plugins/gdpr-for-formidable-forms/">GDPR for Formidable Forms</a> to make Formidable Forms compatibility to the GDPR Framework.
    </p>
    <hr>
<?php endif; 
if ($hasCF7): ?>
    <h2>&#10004; Contact Form 7</h2>
    <p>
        We have detected that Contact Form 7 is enabled on your site. The GDPR Framework is
        compatible with Contact Form 7.
    </p>
    <p>
        Each of the forms requires either a <strong>disclaimer</strong> or a <strong>consent checkbox</strong>.
        We have created some tools to help you out!
    </p>
    <p>
        <a href="<?= gdpr('helpers')->docs('legal-grounds-for-processing-data/'); ?>" target="_blank">Read about making your Contact Form 7 forms GDPR compliant.</a>
    </p>
    <p class="gdpr_cf7_notice">
       <b>NOTE :</b> Your Contact Form 7's data will only store on the website if "<a href="https://wordpress.org/plugins/flamingo/" target="_blank">Flamigo</a>" plugin is installed else no data will be stored on the website, it will only send email. If Flamigo will be activated then there will be new privacy tab appear on each form. You need to setup settings there to make data trackable so that your contact form 7 will become GDPR Complience.
    </p>
    <hr>
<?php endif; ?>

<h2>Custom forms</h2>
<p>
    <label for="gdpr_has_contact_forms">
        <input
            type="checkbox"
            name="gdpr_has_contact_forms"
            id="gdpr_has_contact_forms"
            class="js-gdpr-conditional"
            data-show=".gdpr-contact-custom"
            value="yes"
        >
        I have custom forms on my website (e.g. contact forms, newsletter signups, lottery signups)
    </label>
</p>
<p class="gdpr-contact-custom hidden">
    Each of the forms on your site requires either a <strong>disclaimer</strong> or a <strong>consent checkbox</strong>. <br>
    We cannot do this automatically - you need to do it yourself or request help from a developer. However, we have created some tools to help you out!
    <br>
    <a href="<?= gdpr('helpers')->docs('legal-grounds-for-processing-data/'); ?>" target="_blank">Read about integrating custom forms</a>
</p>

<hr>
<br>
<input type="submit" class="button button-gdpr button-right" value="Continue &raquo;" />
