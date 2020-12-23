<hr>

<h3><?= esc_html_x('Default consent types', '(Admin)', 'gdpr-framework'); ?></h3>
<p><?= esc_html_x('These are the consent types that have been automatically registered by the framework or a plugin.', '(Admin)', 'gdpr-framework'); ?></p>
<?php if (count($defaultConsentTypes)): ?>
    <table class="gdpr-consent">
        <th><?= esc_html_x('Slug', '(Admin)', 'gdpr-framework'); ?></th>
        <th><?= esc_html_x('Title', '(Admin)', 'gdpr-framework'); ?></th>
        <th><?= esc_html_x('Description', '(Admin)', 'gdpr-framework'); ?></th>
        <th><?= esc_html_x('Visibility', '(Admin)', 'gdpr-framework'); ?></th>
    <?php foreach ($defaultConsentTypes as $consentType): ?>
        <tr>
            <td class="gdpr-consent-table-input"><?= $consentType['slug']; ?></td>
            <td class="gdpr-consent-table-input"><?= $consentType['title']; ?></td>
            <td class="gdpr-consent-table-desc"><?= $consentType['description']; ?></td>
            <td>
                <?php if ($consentType['visible']): ?>
                    <?= esc_html_x('Visible', '(Admin)', 'gdpr-framework'); ?>
                <?php else: ?>
                    <?= esc_html_x('Hidden', '(Admin)', 'gdpr-framework'); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
<br>
<hr>
<h3><?= esc_html_x('Custom consent types', '(Admin)', 'gdpr-framework'); ?></h3>
<p><?= esc_html_x('Here you can add custom consent types to track. They will not be used anywhere by default - you will need to build an integration for each of them.', '(Admin)', 'gdpr-framework'); ?></p>
<div class="js-gdpr-repeater" data-name="gdpr_consent_types">
    <table class="gdpr-consent-admin gdpr-show-hide gdpr-hidden" data-repeater-list="gdpr_consent_types">
        <thead>
            <th>
                <?= esc_html_x('Machine-readable slug', '(Admin)', 'gdpr-framework'); ?>*
            </th>
            <th>
                <?= esc_html_x('Title', '(Admin)', 'gdpr-framework'); ?>*
            </th>
            <th>
                <?= esc_html_x('Description', '(Admin)', 'gdpr-framework'); ?>
            </th>
            <th>
                <?= esc_html_x('Visible?', '(Admin)', 'gdpr-framework'); ?>
            </th>
        </thead>
        <tr data-repeater-item>
            <td class="gdpr-consent-table-input">
                <input
                        type="text"
                        name="slug"
                        class="gdpr_custom_consent_types"
                        placeholder="<?= esc_html_x('Slug', '(Admin)', 'gdpr-framework'); ?>"
                        pattern="^[A-Za-z0-9_-]+$"
                        oninvalid="setCustomValidity('Please fill in this field using alphanumeric characters, dashes and underscores.')"
                        oninput="setCustomValidity('')"
                        required
                />
            </td>
            <td class="gdpr-consent-table-input">
                <input type="text" name="title" class="gdpr_custom_consent_types" placeholder="<?= esc_html_x('Title', '(Admin)', 'gdpr-framework'); ?>" required />
            </td>
            <td class="gdpr-consent-table-desc">
                <textarea type="text" name="description" placeholder="<?= esc_html_x('Description', '(Admin)', 'gdpr-framework'); ?>"></textarea>
            </td>
            <td>
                <label>
                    <input type="checkbox" name="visible" value="1"/>
                    <?= esc_html_x('Visible?', '(Admin)', 'gdpr-framework'); ?>
                </label>
            </td>
            <td>
              <input data-repeater-delete class="button button-primary" type="button" value="<?= esc_html_x('Remove', '(Admin)', 'gdpr-framework'); ?>"/>
            </td>
        </tr>

    </table>
    <div class="gdpr-consent-add-button">
      <input data-enable-repeater class="button button-primary show_form_consent_gdpr" type="button" value="<?= esc_html_x('Show Consent types', '(Admin)', 'gdpr-framework'); ?>"/>
      <input data-repeater-create class="button button-primary gdpr-show-hide gdpr-hidden" type="button" value="<?= esc_html_x('Add consent type', '(Admin)', 'gdpr-framework'); ?>"/>
      <input data-enable-repeater class="button button-primary hide_form_consent_gdpr gdpr-show-hide gdpr-hidden" type="button" value="<?= esc_html_x('Hide consent types', '(Admin)', 'gdpr-framework'); ?>"/>
    </div>
    <input type="hidden" name="gdpr_nonce" value="<?= $nonce; ?>" />
    <input type="hidden" name="gdpr_action" value="update_consent_data" />
</div>

<?php if (count($customConsentTypes)): ?>
    <script>
        window.repeaterData = [];
        window.repeaterData['gdpr_consent_types'] = <?= json_encode($customConsentTypes); ?>;
    </script>
<?php endif; ?>
<br>
<hr>
<h3><?= esc_html_x('Additional info', '(Admin)', 'gdpr-framework'); ?></h3>
<p>
    <?= esc_html_x('This text will be displayed to your data subjects on the Privacy Tools page.', '(Admin)', 'gdpr-framework'); ?>
</p>
<?php wp_editor(
    wp_kses_post($consentInfo),
    'gdpr_consent_info',
    [
        'textarea_rows' => 4,
    ]
  );
?>
<br>
<hr>

