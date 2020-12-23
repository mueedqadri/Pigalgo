<?php

namespace Codelight\GDPR\Components\PrivacyManager;
/**
 * Handles putting together and rendering the privacy policy page
 *
 * Class PrivacyManager
 *
 * @package Codelight\GDPR\Components\PrivacyManager
 */
class PrivacyManager
{
    public function __construct()
    {
        add_filter('gdpr/admin/tabs', [$this, 'registerAdminTab'], 80);
    }

    public function registerAdminTab($tabs)
    {    
        $tabs['privacy-manager'] = gdpr()->make(AdminTabPrivacyManager::class);
        return $tabs;
    }
}
