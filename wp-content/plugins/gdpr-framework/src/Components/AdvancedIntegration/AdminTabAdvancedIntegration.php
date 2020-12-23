<?php

namespace Codelight\GDPR\Components\AdvancedIntegration;

use Codelight\GDPR\Admin\AdminTab;

class AdminTabAdvancedIntegration extends AdminTab
{
    /* @var string */
    protected $slug = 'advanced-integration';

    /* @var PolicyGenerator */
    protected $policyGenerator;

    public function __construct()
    {
        $this->title = _x('ClassiDocs', '(Admin)', 'gdpr-framework');
        $this->registerSetting('gdpr_classidocs_integration');
        $this->registerSetting('gdpr_sar_request_details');
        $this->registerSetting('gdpr_response_related_queries');
        $this->registerSetting('gdpr_classidocs_url');
        $this->registerSetting('gdpr_classidocs_username');
        $this->registerSetting('gdpr_classidocs_password');

        add_action('gdpr/admin/action/AdvancedIntegration/generate', [$this, 'generateAdvancedIntegration']);
    }

    public function init()
    {
        /**
         * General settings
         */
        $this->registerSettingSection(
            'gdpr_section_privacy_policy',
            _x('ClassiDocs', '(Admin)', 'gdpr-framework'),
            [$this, 'renderHeader']
        );
        /**
         * Integration Settings
         */
        $this->registerSettingSection(
            'gdpr_section_integration_setting',
            _x('Integration Settings', '(Admin)', 'gdpr-framework')
        );

        /**
         * Enable Integrate with ClassiDocs
         */
        $this->registerSettingField(
            'gdpr_classidocs_integration',
            _x('Integrate with ClassiDocs?', '(Admin)', 'gdpr-framework'),
            [$this, 'renderClassidocIntegration'],
            'gdpr_section_integration_setting'
        );
        /**
         * Enable Submit SAR request details
         */
        $this->registerSettingField(
            'gdpr_sar_request_details',
            _x('Submit SAR request details?', '(Admin)', 'gdpr-framework'),
            [$this, 'renderSarRequestDetails'],
            'gdpr_section_integration_setting'
        );
        /**
         * Enable Response with related queries
         */
        $this->registerSettingField(
            'gdpr_response_related_queries',
            _x('Enable Response with related queries?', '(Admin)', 'gdpr-framework'),
            [$this, 'renderRelatedQueries'],
            'gdpr_section_integration_setting'
        );
        
        /**
         * Classidocs URLS
         */
        $this->registerSettingField(
            'gdpr_classidocs_url',
            _x('ClassiDocs URL', '(Admin)', 'gdpr-framework'),
            [$this, 'renderClassidocsUrl'],
            'gdpr_section_integration_setting'
        );
        /**
         * Classidocs Username
         */
        // $this->registerSettingField(
        //     'gdpr_classidocs_username',
        //     _x('ClassiDocs Username', '(Admin)', 'gdpr-framework'),
        //     [$this, 'renderClassidocsUsername'],
        //     'gdpr_section_integration_setting'
        // );
        /**
         * Classidocs password
         */
        // $this->registerSettingField(
        //     'gdpr_classidocs_password',
        //     _x('ClassiDocs Password', '(Admin)', 'gdpr-framework'),
        //     [$this, 'renderClassidocsPassword'],
        //     'gdpr_section_integration_setting'
        // );

    }

    public function renderHeader()
    {
        echo gdpr('view')->render('admin/advanced-integration/header');
    }

    public function renderSubmitButton()
    {
        submit_button(_x('Save', '(Admin)', 'gdpr-framework'));
    }

    public function renderClassidocIntegration()
    {
        $hasclassidocs_integration = gdpr('options')->get('classidocs_integration');
        echo gdpr('view')->render('admin/advanced-integration/checkbox-field', compact('hasclassidocs_integration'));
    }

    public function renderSarRequestDetails()
    {
        $hasSarRequestDetails = gdpr('options')->get('sar_request_details');
        echo gdpr('view')->render('admin/advanced-integration/sar_request_details', compact('hasSarRequestDetails'));
    }

    public function renderRelatedQueries()
    {
        $hasRelatedQueries = gdpr('options')->get('response_related_queries');
        echo gdpr('view')->render('admin/advanced-integration/response_related_queries', compact('hasRelatedQueries'));
    }

    public function renderClassidocsUrl()
    {
        $value = gdpr('options')->get('classidocs_url') ? esc_attr(gdpr('options')->get('classidocs_url')) : '';
        $placeholder = _x('ClassiDocs URL', '(Admin)', 'gdpr-framework');
        echo "<input type='url' name='gdpr_classidocs_url' placeholder='{$placeholder}' value='{$value}'>";
    }


    public function renderClassidocsUsername()
    {
        $value = gdpr('options')->get('classidocs_username') ? esc_attr(gdpr('options')->get('classidocs_username')) : '';
        $placeholder = _x('ClassiDocs Username', '(Admin)', 'gdpr-framework');
        echo "<input type='text' name='gdpr_classidocs_username' placeholder='{$placeholder}' value='{$value}'>";
    }

    public function renderClassidocsPassword()
    {
        $value = gdpr('options')->get('classidocs_password') ? esc_attr(gdpr('options')->get('classidocs_password')) : '';
        $placeholder = _x('ClassiDocs Password', '(Admin)', 'gdpr-framework');
        echo "<input type='password' name='gdpr_classidocs_password' placeholder='{$placeholder}' value='{$value}'>";
    }
}
