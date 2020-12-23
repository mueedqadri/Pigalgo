<select id="gdpr_delete_action_reassign" name="gdpr_delete_action_reassign" class="gdpr-select js-gdpr-conditional">
    <option value="delete" <?= selected($reassign, 'delete'); ?>>
        <?= esc_html_x('Delete content', '(Admin)', 'gdpr-framework'); ?>
    </option>
    <option value="reassign" <?= selected($reassign, 'reassign'); ?> data-show=".js-gdpr-delete-action-reassign-user">
        <?= esc_html_x('Reassign content to a user', '(Admin)', 'gdpr-framework'); ?>
    </option>
</select>
<p class="description">
    <?= esc_html_x('If the user has submitted any content on your site, should it be deleted or reassigned to another user?', '(Admin)', 'gdpr-framework'); ?>
</p>
