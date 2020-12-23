<?php

namespace Codelight\GDPR\Components\CookiePopup;
/**
 * Handles putting together and rendering the privacy policy page
 *
 * Class CookiePopup
 *
 * @package Codelight\GDPR\Components\CookiePopup
 */
class CookiePopup
{
    public function __construct()
    {
       add_filter('gdpr/admin/tabs', [$this, 'registerAdminTab'], 20);
    }

    public function registerAdminTab($tabs)
    {    
        $tabs['cookie-popup'] = gdpr()->make(AdminTabCookiePopup::class);
        return $tabs;
    }
}
