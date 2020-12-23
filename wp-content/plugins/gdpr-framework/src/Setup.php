<?php

namespace Codelight\GDPR;

use Codelight\GDPR\Admin\AdminTab;
use Codelight\GDPR\Components\Consent\ConsentManager;
use Codelight\GDPR\Components\PrivacyToolsPage\PrivacyToolsPage;
use Codelight\GDPR\Components\PrivacyPolicy\PrivacyPolicy;
use Codelight\GDPR\Components\AdvancedIntegration\AdvancedIntegration;
use Codelight\GDPR\Components\PrivacyManager\PrivacyManager;
use Codelight\GDPR\Components\PrivacySafe\PrivacySafe;
use Codelight\GDPR\Components\DoNotSell\DoNotSell;
use Codelight\GDPR\Components\CookiePopup\CookiePopup;
use Codelight\GDPR\Components\Support\Support;
use Codelight\GDPR\Components\WordpressComments\WordpressComments;
use Codelight\GDPR\DataSubject\DataExporter;
use Codelight\GDPR\DataSubject\DataSubjectAdmin;
use Codelight\GDPR\DataSubject\DataSubjectIdentificator;
use Codelight\GDPR\DataSubject\DataSubjectManager;
use Codelight\GDPR\Modules\ContactForm7\ContactForm7;
use Codelight\GDPR\Modules\WooCommerceGdpr\WooCommerceGdpr;
use Codelight\GDPR\Modules\NewsletterGdpr\NewsletterGdpr;
use Codelight\GDPR\Modules\EddGdpr\EddGdpr;
use Codelight\GDPR\Components\Themes\Themes;
use Codelight\GDPR\Components\WordpressUser\WordpressUser;
use Codelight\GDPR\Modules\ContactForm7\Flamingo;
use Codelight\GDPR\Modules\WPML\WPML;
use Codelight\GDPR\Options\Options;

/**
 * Instantiate components
 *
 * Class Setup
 * @package Codelight\GDPR
 */
class Setup
{
    /**
     * Setup constructor.
     */
    public function __construct()
    {
        $this->registerComponents();
        $this->runComponents();

        add_action('init', function() {

            if (!is_admin()) {
                return;
            }

            gdpr()->singleton(SetupAdmin::class);
            gdpr(SetupAdmin::class);
        }, 0);
    }

    /**
     * Register required components in the container
     */
    protected function registerComponents()
    {
        gdpr()->bind(Router::class);
        gdpr()->bind(DataExporter::class);

        gdpr()->singleton(PrivacyToolsPage::class);

        gdpr()->singleton(AdminTab::class);
        gdpr()->singleton(DataSubjectManager::class);
        gdpr()->singleton(DataSubjectIdentificator::class);
        gdpr()->singleton(View::class);
        gdpr()->singleton(Options::class);
        gdpr()->singleton(ConsentManager::class);
        gdpr()->singleton(Helpers::class);
        gdpr()->singleton(Themes::class);

        gdpr()->alias(View::class, 'view');
        gdpr()->alias(Options::class, 'options');
        gdpr()->alias(ConsentManager::class, 'consent');
        gdpr()->alias(Helpers::class, 'helpers');
        gdpr()->alias(Themes::class, 'themes');
        gdpr()->alias(DataSubjectManager::class, 'data-subject');
    }

    /**
     * Check which components should be ran and run them
     */
    protected function runComponents()
    {
        gdpr()->make(WPML::class);
        gdpr()->make(Router::class);
        gdpr()->make(DataSubjectIdentificator::class);
        gdpr()->make(DataSubjectAdmin::class);
        gdpr()->make(PrivacyToolsPage::class);
        gdpr()->make(PrivacyPolicy::class);        
        gdpr()->make(CookiePopup::class);      
        gdpr()->make(AdvancedIntegration::class);  
		gdpr()->make(PrivacyManager::class);
		gdpr()->make(PrivacySafe::class );
		gdpr()->make(DoNotSell::class );
        gdpr()->make(WordpressComments::class);
        gdpr()->make(WordpressUser::class);
        gdpr()->make(Support::class);

        // Integrations
        gdpr()->make(Themes::class);

        if (defined('WPCF7_VERSION')) {
            gdpr()->make(ContactForm7::class);
        }

        if (defined('FLAMINGO_VERSION')) {
            gdpr()->make(Flamingo::class);
        }

        if ( defined('WC_VERSION') ) {
            gdpr()->make(WooCommerceGdpr::class);
        }
        
        if ( defined('EDD_VERSION') ) {
            gdpr()->make(EddGdpr::class);
        }
        if ( defined('ES_PLUGIN_VERSION') ) {
            gdpr()->make(NewsletterGdpr::class);
        }
    }
}
