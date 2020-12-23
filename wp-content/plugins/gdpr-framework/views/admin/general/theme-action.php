<select class="gdpr-select js-gdpr-conditional" name="gdpr_popup_theme">
    <?= gdpr('view')->render('global/theme-action', compact('themeAction')); ?>
</select>