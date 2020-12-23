<?php

namespace Codelight\GDPR\Components\Themes;

class Themes
{
    protected $theme;

    public $supportedThemes = [
        'twentynineteen',
        'twentyseventeen',
        'twentysixteen',
        'storefront'
    ];

    public function __construct()
    {   
        $this->theme = get_option('stylesheet');

        if (!$this->isCurrentThemeSupported() || !gdpr('options')->get('enable_theme_compatibility')) {
            return;
        }

        // If both pages aren't defined, bail
        $privacyPolicy = gdpr('options')->get('policy_page');
        $privacyToolsPage = gdpr('options')->get('tools_page');

        if (!$privacyPolicy || !$privacyToolsPage) {
            return;
        }

        $theme = $this->theme;
        $this->$theme();
    }

    public function isCurrentThemeSupported()
    {
        return in_array($this->theme, $this->supportedThemes);
    }

    public function getCurrentThemeName()
    {
        return $this->theme;
    }
    public function twentynineteen()
    {    
        add_action("the_privacy_policy_link", [$this, 'rendertwentynineteenFooterLinks'], 10, 2);
    }
    public function twentyseventeen()
    {
        add_action("get_template_part_template-parts/footer/site", [$this, 'renderTwentyseventeenFooterLinks'], 10, 2);
    }

    public function twentysixteen()
    {
        add_action("twentysixteen_credits", [$this, 'renderTwentysixteenFooterLinks']);
    }

    public function storefront()
    {
        // I feel slightly dirty, but also clever
        add_filter("storefront_credit_link", [$this, 'renderStorefrontFooterLinks']);
    }
    public function rendertwentynineteenFooterLinks(){

        $privacyPolicyUrl = get_permalink(gdpr('options')->get('policy_page'));
        add_filter( 'gdpr_custom_policy_link', 'gdprfPrivacyPolicyurl' );
        $privacyPolicyUrl = apply_filters( 'gdpr_custom_policy_link',$privacyPolicyUrl);
        $privacyToolsPageUrl = get_permalink(gdpr('options')->get('tools_page'));

        echo gdpr('view')->render(
            'themes/twentyseventeen/footer',
            compact('privacyPolicyUrl', 'privacyToolsPageUrl')
        );
    }
    public function renderTwentyseventeenFooterLinks($slug, $name)
    {
        if ('info' !== $name) {
            return;
        }

        $privacyPolicyUrl = get_permalink(gdpr('options')->get('policy_page'));
        add_filter( 'gdpr_custom_policy_link', 'gdprfPrivacyPolicyurl' );
        $privacyPolicyUrl = apply_filters( 'gdpr_custom_policy_link',$privacyPolicyUrl);
        $privacyToolsPageUrl = get_permalink(gdpr('options')->get('tools_page'));

        echo gdpr('view')->render(
            'themes/twentyseventeen/footer',
            compact('privacyPolicyUrl', 'privacyToolsPageUrl')
        );
    }

    public function renderTwentysixteenFooterLinks()
    {
        $privacyPolicyUrl = get_permalink(gdpr('options')->get('policy_page'));
        add_filter( 'gdpr_custom_policy_link', 'gdprfPrivacyPolicyurl' );
        $privacyPolicyUrl = apply_filters( 'gdpr_custom_policy_link',$privacyPolicyUrl);
        $privacyToolsPageUrl = get_permalink(gdpr('options')->get('tools_page'));

        echo gdpr('view')->render(
            'themes/twentysixteen/footer',
            compact('privacyPolicyUrl', 'privacyToolsPageUrl')
        );
    }

    public function renderStorefrontFooterLinks($value)
    {
        $privacyPolicyUrl = get_permalink(gdpr('options')->get('policy_page'));
        add_filter( 'gdpr_custom_policy_link', 'gdprfPrivacyPolicyurl' );
        $privacyPolicyUrl = apply_filters( 'gdpr_custom_policy_link',$privacyPolicyUrl);
        $privacyToolsPageUrl = get_permalink(gdpr('options')->get('tools_page'));

        echo gdpr('view')->render(
            'themes/storefront/footer',
            compact('privacyPolicyUrl', 'privacyToolsPageUrl')
        );

        return $value;
    }
}