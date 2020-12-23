<?php

namespace Codelight\GDPR\Components\PrivacyManager;

use Codelight\GDPR\Admin\AdminTab;

class AdminTabPrivacyManager extends AdminTab
{
    /* @var string */
    protected $slug = 'privacy-manager';

    /* @var PolicyGenerator */
    protected $policyGenerator;

    public function __construct()
    {
        $this->title = _x('Privacy Manager', '(Admin)', 'gdpr-framework');

        add_action('gdpr/admin/action/PrivacyManager/generate', [$this, 'generatePrivacyManager']);
    }

    public function init()
    {
        /**
         * General settings
         */
        $this->registerSettingSection(
            'gdpr_section_privacy_policy',
            _x('Privacy Manager', '(Admin)', 'gdpr-framework'),
            [$this, 'renderHeader']
        );

    }

    public function renderHeader()
    {
        echo gdpr('view')->render('admin/privacy-manager/header');
    }

    public function renderSubmitButton()
    {
       // submit_button(_x('Save', '(Admin)', 'gdpr-framework'));
    }

}
