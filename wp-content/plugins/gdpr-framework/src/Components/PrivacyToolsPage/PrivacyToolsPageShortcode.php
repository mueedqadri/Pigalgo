<?php

namespace Codelight\GDPR\Components\PrivacyToolsPage;

use Codelight\GDPR\Components\Consent\ConsentManager;
class PrivacyToolsPageShortcode
{
	protected $consentManager;
	public function __construct(PrivacyToolsPageController $controller, ConsentManager $consentManager )
    {
        $this->controller = $controller;
		$this->consentManager = $consentManager;
        add_shortcode('gdpr_privacy_tools', [$this, 'renderPage']);
        add_shortcode('gdpr_privacy_tools_url', [$this, 'renderUrlShortcode']);
		add_shortcode('gdpr_privacy_tools_link', [$this, 'renderLinkShortcode']);
		add_shortcode('gdpr_do_not_sell_form', [$this, 'renderDoNotSellForm']); 
    }

    public function renderPage()
    {
        if (!gdpr('options')->get('enable')) {
            return __('This page is currently disabled.', 'gdpr-framework');
        }

        if ((!gdpr('options')->get('tools_page') || is_null(get_post(gdpr('options')->get('tools_page')))) && !gdpr('options')->get('custom_tools_page')) {
            return __('Please configure the Privacy Tools page in the admin interface.', 'gdpr-framework');
        }

        ob_start();
        $this->controller->render();
        return ob_get_clean();
    }

    public function renderUrlShortcode()
    {
        return gdpr('helpers')->getPrivacyToolsPageUrl();
    }

    public function renderLinkShortcode($attributes)
    {
        $attributes = shortcode_atts([
            'title' => __('Privacy Tools', 'gdpr-framework'),
        ], $attributes);

        $url = gdpr('helpers')->getPrivacyToolsPageUrl();

        return
            "<a href='{$url}'>" .
            esc_html($attributes['title']) .
            "</a>";
	}
	public function renderDoNotSellForm()
    {
        if (!gdpr('options')->get('enable')) {
            return __('This page is currently disabled.', 'gdpr-framework');
        }

        if (!gdpr('options')->get('tools_page') || is_null(get_post(gdpr('options')->get('tools_page')))) {
            return __('Please configure the Privacy Tools page in the admin interface.', 'gdpr-framework');
        }
        $slug = 'do-not-sell-request';
        $defaultConsentTypes = $this->consentManager->getbySlugConsent($slug);
        $first_name = '';
        $last_name = '';
        $user_email = '';
        if (is_user_logged_in()) {
            // your code for logged in user 
            $current_user =  wp_get_current_user();
            $first_name   =  get_user_meta($current_user->ID, 'first_name', true);
            if ($first_name === '') {
                $first_name = $current_user->user_nicename;
            }
            $last_name    =  get_user_meta($current_user->ID, 'last_name', true);
            $user_email   =  $current_user->user_email;
        }
        ob_start();
        //$this->controller->render(); 
        //$this->controller->renderNoticesOnly();        
        echo gdpr('view')->render('privacy-tools/donotsell', compact('defaultConsentTypes', 'first_name', 'last_name', 'user_email'));
        return ob_get_clean();
    }
}
