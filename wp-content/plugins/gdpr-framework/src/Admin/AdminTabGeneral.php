<?php

namespace Codelight\GDPR\Admin;

class AdminTabGeneral extends AdminTab
{
    protected $slug = 'general';

    public function __construct()
    {   
        $this->title = _x('General', '(Admin)', 'gdpr-framework');
        /**
         * Register settings
         */
        $this->registerSetting('gdpr_enable');
        $this->registerSetting('gdpr_enable_tac');
        $this->registerSetting('gdpr_comment_checkbox');
        $this->registerSetting('gdpr_register_checkbox');

        $this->registerSetting('gdpr_tools_page');
        $this->registerSetting('gdpr_custom_tools_page');
        $this->registerSetting('gdpr_custom_terms_page');
        $this->registerSetting('gdpr_policy_page');
        $this->registerSetting('gdpr_custom_policy_page');
        $this->registerSetting('gdpr_terms_page');
        $this->registerSetting('gdpr_name_from');
        $this->registerSetting('gdpr_email_from');
        $this->registerSetting('gdpr_export_action');
        $this->registerSetting('gdpr_export_action_email');

        $this->registerSetting('gdpr_delete_action');
        $this->registerSetting('gdpr_delete_action_reassign');
        $this->registerSetting('gdpr_delete_action_reassign_user');
        $this->registerSetting('gdpr_delete_action_email');

        $this->registerSetting('gdpr_enable_stylesheet');
        $this->registerSetting('gdpr_enable_theme_compatibility');
        if (class_exists( 'WooCommerce' )) {
            $this->registerSetting('gdpr_enable_woo_compatibility');
            $this->registerSetting('gdpr_disable_checkbox_woo_compatibility');
            $this->registerSetting('gdpr_disable_register_checkbox_woo_compatibility');
        }
        if (class_exists( 'Easy_Digital_Downloads')) {
            $this->registerSetting('gdpr_enable_edd_compatibility'); 
        }        
    }

    public function init()
    {
        /**
         * General
         */
        $this->registerSettingSection(
            'gdpr_section_general',
            _x('General Settings', '(Admin)', 'gdpr-framework')
        );

        $this->registerSettingField(
            'gdpr_enable',
            _x('Enable Privacy Tools', '(Admin)', 'gdpr-framework'),
            [$this, 'renderEnableCheckbox'],
            'gdpr_section_general'
        );

        $this->registerSettingField(
            'gdpr_enable_tac',
            _x('Enable Term and Conditions', '(Admin)', 'gdpr-framework'),
            [$this, 'renderEnableCheckboxtac'],
            'gdpr_section_general'
        );

        $this->registerSettingField(
            'gdpr_comment_checkbox',
            _x('Disable Comment Checkbox', '(Admin)', 'gdpr-framework'),
            [$this, 'renderCommentCheckbox'],
            'gdpr_section_general'
        );

        $this->registerSettingField(
            'gdpr_register_checkbox',
            _x('Disable Register Form Checkbox', '(Admin)', 'gdpr-framework'),
            [$this, 'renderRegisterCheckbox'],
            'gdpr_section_general'
        );
        
        /**
         * GDPR Email setting
         */
        $this->registerSettingSection(
            'gdpr_email_section',
            _x('Email Setting', '(Admin)', 'gdpr-framework')
        );

        $this->registerSettingField(
            'gdpr_name_from',
            _x('From Name', '(Admin)', 'gdpr-framework'),
            [$this, 'renderNameFrom'],
            'gdpr_email_section'
        );

        $this->registerSettingField(
            'gdpr_email_from',
            _x('From Email', '(Admin)', 'gdpr-framework'),
            [$this, 'renderEmailFrom'],
            'gdpr_email_section'
        );
        /**
         * GDPR system pages
         */
        $this->registerSettingSection(
            'gdpr_section_pages',
            _x('Pages', '(Admin)', 'gdpr-framework')
        );

        $this->registerSettingField(
            'gdpr_tools_page',
            _x('Privacy Tools Page', '(Admin)', 'gdpr-framework') . '*',
            [$this, 'renderPrivacyToolsPageSelector'],
            'gdpr_section_pages'
		);

		$this->registerSettingField(
            'gdpr_custom_tools_page',
            _x('Privacy Tools Custom URL', '(Admin)', 'gdpr-framework'),
            [$this, 'renderToolsCustomPageSelector'],
            'gdpr_section_pages'
        );

        $this->registerSettingField(
            'gdpr_policy_page',
            _x('Privacy Policy Page', '(Admin)', 'gdpr-framework') . '*',
            [$this, 'renderPolicyPageSelector'],
            'gdpr_section_pages'
        );

        $this->registerSettingField(
            'gdpr_custom_policy_page',
            _x('Privacy Policy Custom URL', '(Admin)', 'gdpr-framework'),
            [$this, 'renderPolicyCustomPageSelector'],
            'gdpr_section_pages'
		);
		
        $this->registerSettingField(
            'gdpr_terms_page',
            _x('Terms & Conditions Page', '(Admin)', 'gdpr-framework'),
            [$this, 'renderTermsPageSelector'],
            'gdpr_section_pages'
		);
		
        $this->registerSettingField(
            'gdpr_custom_terms_page',
            _x('Terms & Conditions Custom URL', '(Admin)', 'gdpr-framework'),
            [$this, 'renderCustomTermsPageSelector'],
            'gdpr_section_pages'
        );

        /**
         * View & Export
         */
        $this->registerSettingSection(
            'gdpr_section_export',
            _x('View & Export Data', '(Admin)', 'gdpr-framework')
        );

        $this->registerSettingField(
            'gdpr_export_action',
            _x('Export action', '(Admin)', 'gdpr-framework'),
            [$this, 'renderExportActionSelector'],
            'gdpr_section_export'
        );

        $this->registerSettingField(
            'gdpr_export_action_email',
            _x('Email to notify', '(Admin)', 'gdpr-framework'),
            [$this, 'renderExportActionEmail'],
            'gdpr_section_export',
            ['class' => 'js-gdpr-export-action-email hidden']
        );

        /**
         * Delete data
         */
        $this->registerSettingSection(
            'gdpr_section_delete',
            _x('Delete & Anonymize Data', '(Admin)', 'gdpr-framework')
        );

        $this->registerSettingField(
            'gdpr_delete_action',
            _x('Delete action', '(Admin)', 'gdpr-framework'),
            [$this, 'renderDeleteActionSelector'],
            'gdpr_section_delete'
        );

        $this->registerSettingField(
            'gdpr_delete_action_reassign',
            _x('Delete or reassign content?', '(Admin)', 'gdpr-framework'),
            [$this, 'renderDeleteActionReassign'],
            'gdpr_section_delete',
            ['class' => 'js-gdpr-delete-action-reassign hidden']
        );

        $this->registerSettingField(
            'gdpr_delete_action_reassign_user',
            _x('Reassign content to', '(Admin)', 'gdpr-framework'),
            [$this, 'renderDeleteActionReassignUser'],
            'gdpr_section_delete',
            ['class' => 'js-gdpr-delete-action-reassign-user hidden']
        );

        $this->registerSettingField(
            'gdpr_delete_action_email',
            _x('Email to notify', '(Admin)', 'gdpr-framework'),
            [$this, 'renderDeleteActionEmail'],
            'gdpr_section_delete',
            ['class' => 'js-gdpr-delete-action-email hidden']
        );

        /**
         * Stylesheet
         */

        $this->registerSettingSection(
            'gdpr_section_stylesheet',
            _x('Styling', '(Admin)', 'gdpr-framework')
        );

        $this->registerSettingField(
            'gdpr_enable_theme_compatibility',
            _x('Enable basic styling on Privacy Tools page', '(Admin)', 'gdpr-framework'),
            [$this, 'renderStylesheetSelector'],
            'gdpr_section_stylesheet'
        );

        if (gdpr('themes')->isCurrentThemeSupported()) {

            /**
             * Compatibility settings
             */
            $this->registerSettingSection(
                'gdpr_section_compatibility',
                _x('Compatibility', '(Admin)', 'gdpr-framework')
            );

            $this->registerSettingField(
                'gdpr_enable_theme_compatibility',
                _x('Enable automatic theme compatibility', '(Admin)', 'gdpr-framework'),
                [$this, 'renderThemeCompatibilitySelector'],
                'gdpr_section_compatibility'
            );
        }
        if (class_exists( 'WooCommerce' )) {

            /**
             * Woocommerce Compatibility settings
             */
            $this->registerSettingSection(
                'gdpr_woo_compatibility',
                _x('Woocommerce Integration', '(Admin)', 'gdpr-framework')
            );

            $this->registerSettingField(
                'gdpr_enable_woo_compatibility',
                _x('Enable WooCommerce Compatibility', '(Admin)', 'gdpr-framework'),
                [$this, 'renderwooCompatibilitySelector'],
                'gdpr_woo_compatibility'
            );
            
            $this->registerSettingField(
                'gdpr_disable_checkbox_woo_compatibility',
                _x('Disable WooCommerce Privacy Checkbox', '(Admin)', 'gdpr-framework'),
                [$this, 'renderwoodisablewooSelector'],
                'gdpr_woo_compatibility'
            );

            $this->registerSettingField(
                'gdpr_disable_register_checkbox_woo_compatibility',
                _x('Disable WooCommerce Register Privacy Checkbox', '(Admin)', 'gdpr-framework'),
                [$this, 'renderwooregisterdisablewooSelector'],
                'gdpr_woo_compatibility'
            );
        }
        
        if (class_exists( 'Easy_Digital_Downloads')) {
            /**
             * Easy Digital Downloads Compatibility settings
             */
            $this->registerSettingSection(
                'gdpr_edd_compatibility',
                _x('Easy Digital Download Integration', '(Admin)', 'gdpr-framework')
            );

            $this->registerSettingField(
                'gdpr_enable_edd_compatibility',
                _x('Enable EDD Compatibility', '(Admin)', 'gdpr-framework'),
                [$this, 'rendereddCompatibilitySelector'],
                'gdpr_edd_compatibility'
            );
        }
    }

    /**
     * Rendering Views
     */

    public function renderEnableCheckbox()
    {
        $enabled = gdpr('options')->get('enable');
        echo gdpr('view')->render('admin/general/enable', compact('enabled'));
    }
    
    public function renderEnableCheckboxtac()
    {
        $enabled = gdpr('options')->get('enable_tac');
        echo gdpr('view')->render('admin/general/enable-tac', compact('enabled'));
    }

    public function renderCommentCheckbox()
    {
        $content['option_name'] = 'comment_checkbox';
        $content['value'] = gdpr('options')->get('comment_checkbox');
        $content['option'] = _x('Disable Checkbox For Comments', '(Admin)', 'gdpr-framework');
        echo gdpr('view')->render('admin/general/disble-checkbox', compact('content'));
    }

    public function renderRegisterCheckbox()
    {   
        $content['option_name'] = 'register_checkbox';
        $content['value'] = gdpr('options')->get('register_checkbox');
        $content['option'] = _x('Disable Checkbox For Register Form', '(Admin)', 'gdpr-framework');
        echo gdpr('view')->render('admin/general/disble-checkbox', compact('content'));
    }

    public function renderEnableCheckboxpopup()
    {
        $enabled = gdpr('options')->get('enable_popup');
        echo gdpr('view')->render('admin/general/enable-popup', compact('enabled'));
    }

    public function renderEnableOneTimeCheckboxpopup()
    {
        $enabled = gdpr('options')->get('onetime_popup');
        echo gdpr('view')->render('admin/general/enable-onetime-popup', compact('enabled'));
    }  

    public function renderheaderCheckboxpopup()
    {
        $content = gdpr('options')->get('header');
        echo gdpr('view')->render('admin/general/enable_popup_header', compact('content'));
    }
    public function rendercontentCheckboxpopup()
    {
        $content = gdpr('options')->get('popup_content');
        echo gdpr('view')->render('admin/general/enable_popup_content', compact('content'));
    }

    public function renderNameFrom()
    {
        $content = gdpr('options')->get('name_from');
        echo gdpr('view')->render('admin/general/name_from', compact('content'));
    }

    public function renderEmailFrom()
    {
        $content = gdpr('options')->get('email_from');
        echo gdpr('view')->render('admin/general/email_from', compact('content'));
    }

    public function renderpopupBackgroundcolor()
    {
        $content['value'] = gdpr('options')->get('popup_background');
        $content['option'] = 'background';
        echo gdpr('view')->render('admin/general/popup_background_color_picker', compact('content'));
    }

    public function renderpopupTextcolor()
    {
        $content['value'] = gdpr('options')->get('popup_text');
        $content['option'] = 'text';
        echo gdpr('view')->render('admin/general/popup_background_color_picker', compact('content'));
    }

    public function renderbuttonBackgroundcolor()
    {
        
        $content['value'] = gdpr('options')->get('popup_button_background');
        $content['option'] = 'button_background';
        echo gdpr('view')->render('admin/general/popup_background_color_picker', compact('content'));
    }
    public function renderbuttonTextcolor()
    {
        $content['value'] = gdpr('options')->get('popup_button_text');
        $content['option'] = 'button_text';
        echo gdpr('view')->render('admin/general/popup_background_color_picker', compact('content'));
    }

    public function renderborderTextcolor()
    {
        $content['value'] = gdpr('options')->get('popup_border_text');
        $content['option'] = 'border_text';
        echo gdpr('view')->render('admin/general/popup_background_color_picker', compact('content'));
    }

    public function renderPrivacyToolsPageSelector()
    {
        wp_dropdown_pages([
            'name'              => 'gdpr_tools_page',
            'show_option_none'  => _x('&mdash; Select &mdash;', '(Admin)', 'gdpr-framework'),
            'option_none_value' => '0',
            'selected'          => gdpr('options')->get('tools_page'),
            'class'             => 'js-gdpr-select2 gdpr-select',
            'post_status'       => 'publish,draft',
        ]);
        echo gdpr('view')->render('admin/general/description-data-page');
    }

    /**
     * Render the GDPR policy page selector dropdown
     */
    public function renderPolicyPageSelector()
    {
        wp_dropdown_pages([
            'name'              => 'gdpr_policy_page',
            'show_option_none'  => _x('&mdash; Select &mdash;', '(Admin)', 'gdpr-framework'),
            'option_none_value' => '0',
            'selected'          => gdpr('options')->get('policy_page'),
            'class'             => 'js-gdpr-select2 gdpr-select',
            'post_status'       => 'publish,draft',
        ]);
        echo gdpr('view')->render('admin/privacy-policy/description-policy-page');
    }
    
    public function renderPolicyCustomPageSelector()
    {
        $content = gdpr('options')->get('custom_policy_page');
        echo gdpr('view')->render('admin/general/custom-policy-url', compact('content'));
	}
	
    public function renderToolsCustomPageSelector()
    {
        $content = gdpr('options')->get('custom_tools_page');
        echo gdpr('view')->render('admin/general/custom-tools-url', compact('content'));
    }
    
    public function renderTermsPageSelector()
    {
        wp_dropdown_pages([
            'name'              => 'gdpr_terms_page',
            'show_option_none'  => _x('&mdash; Select &mdash;', '(Admin)', 'gdpr-framework'),
            'option_none_value' => '0',
            'selected'          => gdpr('options')->get('terms_page'),
            'class'             => 'js-gdpr-select2 gdpr-select',
            'post_status'       => 'publish,draft',
        ]);
        echo gdpr('view')->render('admin/general/description-terms-page');
	}
	
	public function renderCustomTermsPageSelector()
    {
        $content = gdpr('options')->get('custom_terms_page');
        echo gdpr('view')->render('admin/general/custom-terms-url', compact('content'));
    }

    public function renderExportActionSelector()
    {
        $exportAction = gdpr('options')->get('export_action');
        echo gdpr('view')->render('admin/general/export-action', compact('exportAction'));
        echo gdpr('view')->render('admin/general/description-export-action');
    }
    public function renderPopupThemeSelector()
    {
        $themeAction = gdpr('options')->get('popup_theme');
        echo gdpr('view')->render('admin/general/theme-action', compact('themeAction'));
        echo gdpr('view')->render('admin/general/description-theme-action');
    }
    public function renderPopupPositionSelector()
    {
        $positionAction = gdpr('options')->get('popup_position');
        echo gdpr('view')->render('admin/general/position-action', compact('positionAction'));
        echo gdpr('view')->render('admin/general/description-position-action');
    }

    public function renderExportActionEmail()
    {
        $exportActionEmail = gdpr('options')->get('export_action_email');
        echo gdpr('view')->render('admin/general/export-action-email', compact('exportActionEmail'));
    }

    public function renderDeleteActionSelector()
    {
        $deleteAction = gdpr('options')->get('delete_action');
        echo gdpr('view')->render('admin/general/delete-action', compact('deleteAction'));
        echo gdpr('view')->render('admin/general/description-delete-action');
    }

    public function renderDeleteActionReassign()
    {
        $reassign = gdpr('options')->get('delete_action_reassign');
        echo gdpr('view')->render('admin/general/delete-action-reassign', compact('reassign'));
    }

    public function renderDeleteActionReassignUser()
    {
        wp_dropdown_users([
            'name'              => 'gdpr_delete_action_reassign_user',
            'show_option_none'  => _x('&mdash; Select &mdash;', '(Admin)', 'gdpr-framework'),
            'option_none_value' => '0',
            'selected'          => gdpr('options')->get('delete_action_reassign_user'),
            'class'             => 'js-gdpr-select2 gdpr-select',
            'role__in'          => apply_filters('gdpr/options/reassign/roles', ['administrator', 'editor']),
        ]);
    }

    public function renderDeleteActionEmail()
    {
        $deleteActionEmail = gdpr('options')->get('delete_action_email');
        echo gdpr('view')->render('admin/general/delete-action-email', compact('deleteActionEmail'));
    }

    public function renderStylesheetSelector()
    {
        $enabled = gdpr('options')->get('enable_stylesheet');
        echo gdpr('view')->render('admin/general/stylesheet', compact('enabled'));
    }

    public function renderThemeCompatibilitySelector()
    {
        $enabled = gdpr('options')->get('enable_theme_compatibility');
        echo gdpr('view')->render('admin/general/theme-compatibility', compact('enabled'));
    }

    public function renderwooCompatibilitySelector()
    {
        $enabled = gdpr('options')->get('enable_woo_compatibility');
        echo gdpr('view')->render('admin/general/woo-compatibility', compact('enabled'));
    }
    public function renderwoodisablewooSelector()
    {
        $enabled = gdpr('options')->get('disable_checkbox_woo_compatibility');
        echo gdpr('view')->render('admin/general/woo-disable_checkbox', compact('enabled'));
    }
    public function renderwooregisterdisablewooSelector()
    {
        $enabled = gdpr('options')->get('disable_register_checkbox_woo_compatibility');
        echo gdpr('view')->render('admin/general/woo-disable_register_checkbox', compact('enabled'));
    }
    public function rendereddCompatibilitySelector()
    {   
        $enabled = gdpr('options')->get('enable_edd_compatibility');
        echo gdpr('view')->render('admin/general/edd-compatibility', compact('enabled'));
    }
}
