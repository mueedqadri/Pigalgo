<?php

namespace Codelight\GDPR\Components\WordpressUser\Controllers;

use Codelight\GDPR\DataSubject\DataExporter;
use Codelight\GDPR\DataSubject\DataSubject;
use Codelight\GDPR\DataSubject\DataSubjectManager;

class DashboardProfilePageController
{
    public function __construct(DataSubjectManager $dataSubjectManager, DataExporter $dataExporter)
    {          
        $this->dataSubjectManager = $dataSubjectManager;
        $this->dataExporter       = $dataExporter;
        
        add_action('gdpr/dashboard/profile-page/content', [$this, 'renderHeader'], 10);
        add_action('gdpr/dashboard/profile-page/content', [$this, 'renderConsentTable'], 20);
        add_action('gdpr/dashboard/profile-page/content', [$this, 'renderExportForm'], 30);
        add_action('gdpr/dashboard/profile-page/content', [$this, 'renderDeleteForm'], 40);
        add_action('gdpr/dashboard/profile-page/contentuser', [$this, 'renderHeader'], 10);
        add_action('gdpr/dashboard/profile-page/contentuser', [$this, 'renderConsentTable'], 20);
        add_action('gdpr/dashboard/profile-page/userlogs', [$this, 'gdpr_user_logs'], 50);

        add_action('gdpr/admin/action/export', [$this, 'export']);
        add_action('gdpr/admin/action/forget', [$this, 'forget']);
    }

    protected function isUserAnonymized(DataSubject $dataSubject)
    {   
        return !$dataSubject->getEmail();
    }

    public function renderHeader(DataSubject $dataSubject)
    {
        $isAnonymized = $this->isUserAnonymized($dataSubject);

        echo gdpr('view')->render(
            "modules/wordpress-user/dashboard/profile-page/header",
            compact('isAnonymized')
        );
    }

    
    public function gdpr_user_logs(DataSubject $dataSubject)
    {
        if ($this->isUserAnonymized($dataSubject)) {
            return;
        }

        $userlogData = $dataSubject->getuserlogsData(); 
        echo gdpr('view')->render(
            "modules/wordpress-user/dashboard/profile-page/user-logs",
            compact('userlogData')
        );
    }

    public function renderConsentTable(DataSubject $dataSubject)
    {
        if ($this->isUserAnonymized($dataSubject)) {
            return;
        }

		$consentData = $dataSubject->getConsentData();
		
		echo gdpr('view')->render(
            "modules/wordpress-user/dashboard/profile-page/table-consent",
            compact('consentData')
        );
    }

    public function renderExportForm(DataSubject $dataSubject)
    {
        if ($this->isUserAnonymized($dataSubject)) { 
            return;
        }

        $exportHTMLUrl = add_query_arg([
            'gdpr_action' => 'export',
            'gdpr_format' => 'html',
            'gdpr_email'  => $dataSubject->getEmail(),
            'gdpr_nonce'  => wp_create_nonce("gdpr/admin/action/export"),
        ]);

        $exportJSONUrl = add_query_arg([
            'gdpr_action' => 'export',
            'gdpr_format' => 'json',
            'gdpr_email'  => $dataSubject->getEmail(),
            'gdpr_nonce'  => wp_create_nonce("gdpr/admin/action/export"),
        ]);

        echo gdpr('view')->render(
            "modules/wordpress-user/dashboard/form-export",
            compact('exportHTMLUrl', 'exportJSONUrl')
        );
    }

    public function renderDeleteForm(DataSubject $dataSubject)
    {
        if ($this->isUserAnonymized($dataSubject)) {
            return;
        }

        // Hide the delete button away from site admins on their own profile page to avoid accidents
        $showDelete = !(current_user_can('manage_options') && wp_get_current_user()->ID === $dataSubject->getUserId());

        $anonymizeUrl = add_query_arg([
            'gdpr_email'        => $dataSubject->getEmail(),
            'gdpr_action'       => 'forget',
            'gdpr_force_action' => 'anonymize',
            'gdpr_nonce'        => wp_create_nonce("gdpr/admin/action/forget"),
        ]);

        $deleteUrl = add_query_arg([
            'gdpr_email'        => $dataSubject->getEmail(),
            'gdpr_action'       => 'forget',
            'gdpr_force_action' => 'delete',
            'gdpr_nonce'        => wp_create_nonce("gdpr/admin/action/forget"),
        ]);

        echo gdpr('view')->render(
            "modules/wordpress-user/dashboard/profile-page/form-delete",
            compact('anonymizeUrl', 'deleteUrl', 'showDelete')
        );
    }

    public function export()
    {
        $gdpr_email = sanitize_email($_REQUEST['gdpr_email']);
        $gdpr_format = sanitize_key($_REQUEST['gdpr_format']);
        $dataSubject = $this->dataSubjectManager->getByEmail($gdpr_email);
        $data = $dataSubject->export($gdpr_format, true);
        $this->dataExporter->export($data, $dataSubject, $gdpr_format);
    }

    public function forget()
    {
        $gdpr_email = sanitize_email($_REQUEST['gdpr_email']);
        $gdpr_force_action = sanitize_key($_REQUEST['gdpr_force_action']);
        $dataSubject = $this->dataSubjectManager->getByEmail($gdpr_email);
        $dataSubject->forget($gdpr_force_action);

        wp_safe_redirect(admin_url('users.php'));
    }
}
