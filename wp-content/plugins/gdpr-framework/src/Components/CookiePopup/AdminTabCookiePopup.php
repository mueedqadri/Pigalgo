<?php

namespace Codelight\GDPR\Components\CookiePopup;

use Codelight\GDPR\Admin\AdminTab;

class AdminTabCookiePopup extends AdminTab
{
    /* @var string */
    protected $slug = 'cookie-popup';

    /* @var PolicyGenerator */
    protected $policyGenerator;

    public function __construct()
    {
        $this->title = _x('Cookie Popup', '(Admin)', 'gdpr-framework');
        $this->registerSetting('gdpr_enable_popup');
        $this->registerSetting('gdpr_onetime_popup');
        $this->registerSetting('gdpr_policy_popup');                
        $this->registerSetting('gdpr_popup_content');
        $this->registerSetting('gdpr_header');
        $this->registerSetting('gdpr_popup_position');
        $this->registerSetting('gdpr_popup_theme');
        $this->registerSetting('gdpr_popup_allow_text');
        $this->registerSetting('gdpr_popup_dismiss_text');
        $this->registerSetting('gdpr_popup_learnmore_text');
        $this->registerSetting('gdpr_popup_background');
        $this->registerSetting('gdpr_popup_text');
        $this->registerSetting('gdpr_popup_link_target');
        $this->registerSetting('gdpr_popup_button_background');
        $this->registerSetting('gdpr_popup_button_text');
        $this->registerSetting('gdpr_popup_border_text');
        add_action('gdpr/admin/action/CookiePopup/generate', [$this, 'generateCookiePopup']);
    }

    public function init()
    {
        /**
         * General settings
         */
        $this->registerSettingSection(
            'gdpr_cookie_popup_setting',
            _x('Cookie Popup Settings', '(Admin)', 'gdpr-framework')
        );
        $this->registerSettingField(
            'gdpr_enable_popup',
            _x('Enable Cookie Acceptance Popup', '(Admin)', 'gdpr-framework'),
            [$this, 'renderEnableCheckboxpopup'],
            'gdpr_cookie_popup_setting'
        );
        $this->registerSettingField(
            'gdpr_onetime_popup',
            _x('Enable One Time Cookie Acceptance Popup', '(Admin)', 'gdpr-framework'),
            [$this, 'renderEnableOneTimeCheckboxpopup'],
            'gdpr_cookie_popup_setting'
        );
        $this->registerSettingField(
            'gdpr_policy_popup',
            _x('Enable Privacy policy on Popup', '(Admin)', 'gdpr-framework'),
            [$this, 'renderEnablePolicyOnPopup'],
            'gdpr_cookie_popup_setting'
        );
        $this->registerSettingField(
            'gdpr_header',
            _x('Cookie Acceptance Popup header', '(Admin)', 'gdpr-framework'),
            [$this, 'renderheaderCheckboxpopup'],
            'gdpr_cookie_popup_setting'
        );
        $this->registerSettingField(
            'gdpr_popup_content',
            _x('Cookie Acceptance Popup Content', '(Admin)', 'gdpr-framework'),
            [$this, 'rendercontentCheckboxpopup'],
            'gdpr_cookie_popup_setting'
        );
		/**
         * GDPR Popup setting
         */
        $this->registerSettingSection(
            'gdpr_popup_section',
            _x('Acceptance Popup Setting', '(Admin)', 'gdpr-framework')
        );

        $this->registerSettingField(
            'gdpr_popup_position',
            _x('Popup Position', '(Admin)', 'gdpr-framework'),
            [$this, 'renderPopupPositionSelector'],
            'gdpr_popup_section'
        );

        $this->registerSettingField(
            'gdpr_popup_theme',
            _x('Popup theme', '(Admin)', 'gdpr-framework'),
            [$this, 'renderPopupThemeSelector'],
            'gdpr_popup_section'
        );

        $this->registerSettingField(
            'gdpr_popup_allow_text',
            _x('Popup Allow Text', '(Admin)', 'gdpr-framework'),
            [$this, 'renderAllowContentPopup'],
            'gdpr_popup_section'
        );

        $this->registerSettingField(
            'gdpr_popup_dismiss_text',
            _x('Popup Dismiss Text', '(Admin)', 'gdpr-framework'),
            [$this, 'renderDismissContentPopup'],
            'gdpr_popup_section'
        );
        
        $this->registerSettingField(
            'gdpr_popup_learnmore_text',
            _x('Popup Learn More Text', '(Admin)', 'gdpr-framework'),
            [$this, 'renderlearnmorePopup'],
            'gdpr_popup_section'
        );
        
        $this->registerSettingField(
            'gdpr_popup_link_target',
            _x('Cookie Acceptance link target', '(Admin)', 'gdpr-framework'),
            [$this, 'renderpopuplinktarget'],
            'gdpr_popup_section'
        );

        $this->registerSettingField(
            'gdpr_popup_background',
            _x('Cookie Acceptance Background Color', '(Admin)', 'gdpr-framework'),
            [$this, 'renderpopupBackgroundcolor'],
            'gdpr_popup_section'
        );

        $this->registerSettingField(
            'gdpr_popup_text',
            _x('Cookie Acceptance Text Color', '(Admin)', 'gdpr-framework'),
            [$this, 'renderpopupTextcolor'],
            'gdpr_popup_section'
        );
    
        $this->registerSettingField(
            'gdpr_popup_button_background',
            _x('Cookie Acceptance Button Backgroung Color', '(Admin)', 'gdpr-framework'),
            [$this, 'renderbuttonBackgroundcolor'],
            'gdpr_popup_section'
        );

        $this->registerSettingField(
            'gdpr_popup_button_text',
            _x('Cookie Acceptance Button Color', '(Admin)', 'gdpr-framework'),
            [$this, 'renderbuttonTextcolor'],
            'gdpr_popup_section'
        );

        $this->registerSettingField(
            'gdpr_popup_border_text',
            _x('Cookie Acceptance Border Color', '(Admin)', 'gdpr-framework'),
            [$this, 'renderborderTextcolor'],
            'gdpr_popup_section'
        );
	}

    public function renderHeader()
    {
        echo gdpr('view')->render('admin/advanced-integration/header');
    }
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
    public function renderEnablePolicyOnPopup()
    {
        $enabled = gdpr('options')->get('policy_popup');
        echo gdpr('view')->render('admin/general/enable-policy-popup', compact('enabled'));
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
    public function renderAllowContentPopup()
    {
        $content = gdpr('options')->get('popup_allow_text');
        echo gdpr('view')->render('admin/general/enable_popup_allow_content', compact('content'));
    }
    public function renderDismissContentPopup()
    {
        $content = gdpr('options')->get('popup_dismiss_text');
        echo gdpr('view')->render('admin/general/enable_popup_dismiss_content', compact('content'));
    }
    public function renderlearnmorePopup()
    {
        $content = gdpr('options')->get('popup_learnmore_text');
        echo gdpr('view')->render('admin/general/enable_popup_learnmore_content', compact('content'));
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
    public function renderpopuplinktarget()
    {
        $content = gdpr('options')->get('popup_link_target');
        echo gdpr('view')->render('admin/general/popup_link_target', compact('content'));
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
    public function renderPopupPositionSelector()
    {
        $positionAction = gdpr('options')->get('popup_position');
        echo gdpr('view')->render('admin/general/position-action', compact('positionAction'));
        echo gdpr('view')->render('admin/general/description-position-action');
    }
	public function renderPopupThemeSelector()
    {
        $themeAction = gdpr('options')->get('popup_theme');
        echo gdpr('view')->render('admin/general/theme-action', compact('themeAction'));
        echo gdpr('view')->render('admin/general/description-theme-action');
    }
}
