<?php

namespace Codelight\GDPR\Components\AdvancedIntegration;
/**
 * Handles putting together and rendering the privacy policy page
 *
 * Class AdvancedIntegration
 *
 * @package Codelight\GDPR\Components\AdvancedIntegration
 */
class AdvancedIntegration
{
    public function __construct()
    {
        add_filter('gdpr/admin/tabs', [$this, 'registerAdminTab'], 70);
    }

    public function registerAdminTab($tabs)
    {    
        $tabs['advanced-integration'] = gdpr()->make(AdminTabAdvancedIntegration::class);
        return $tabs;
    }
}
