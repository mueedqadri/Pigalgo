<input
    type="checkbox"
    id="gdpr_privacy_safe_backlink"
    name="gdpr_privacy_safe_backlink"
    value="1"
    <?= checked($checked, true); ?>
	
/><input type='hidden' name='gdpr_privacy_safe_backlink_selected' value='1'>

<p class="description">
    <?= _x('<b>Note:</b> We need your support. By selecting to support Data443, a small link is added below the privacy safe seal linking back to our product page on data443.com. Uncheck if you prefer not to have the link display on your site.', '(Admin)', 'gdpr-framework'); ?>
</p>
