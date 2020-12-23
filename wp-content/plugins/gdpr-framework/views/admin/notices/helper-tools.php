<p>
    <?= esc_html_x('The contents of this page should contain the [gdpr_privacy_tools] shortcode.', '(Admin)', 'gdpr-framework'); ?>
</p>
<p>
    <?= esc_html_x(
        sprintf('Read more %shere%s', "<a href='{$helpUrl}'>", "</a>"),
        '(Admin)',
        'gdpr-framework'
    ); ?>
</p>
