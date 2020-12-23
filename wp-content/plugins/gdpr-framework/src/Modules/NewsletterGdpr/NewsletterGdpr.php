<?php
namespace Codelight\GDPR\Modules\NewsletterGdpr;

use Codelight\GDPR\Components\Consent\ConsentManager;
use Codelight\GDPR\DataSubject\DataSubjectManager;

if(file_exists(dirname( ES_PLUGIN_FILE ) . '/includes/db/class-es-db-contacts.php'))
{
    include_once dirname( ES_PLUGIN_FILE ) . '/includes/db/class-es-db-contacts.php';
}else{
    include_once dirname( ES_PLUGIN_FILE ) . '/lite/includes/db/class-es-db-contacts.php';
}

class NewsletterGdpr
{   
    public function __construct(DataSubjectManager $dataSubjectManager, ConsentManager $consentManager)
    {  	    
        $this->dataSubjectManager = $dataSubjectManager;
        $this->consentManager = $consentManager;
        
        if (!defined('ES_PLUGIN_VERSION')) 
        {
            return;
        }

        add_filter('gdpr/data-subject/data', [$this, 'getNewsletterExportData'], 20, 2);
        add_action('gdpr/data-subject/delete', [$this, 'deleteNewsletterEntries']);
        add_action('gdpr/data-subject/anonymize', [$this, 'deleteNewsletterEntries']);
        add_action('ig_es_after_form_fields',[$this, 'newsletter_checkbox_consent']);
        add_filter('ig_es_add_subscriber_data', [$this, 'newsletter_gdpr_consent']);

    }

    public function newsletter_checkbox_consent($data)
    { 	
        $policyPage = gdpr('options')->get('policy_page');

        $policyPageUrl = get_permalink($policyPage);
        
        add_filter( 'gdpr-framework-consent-policy', 'gdprfPrivacyPolicy' );

        $gdpr_text_policy = apply_filters( 'gdpr-framework-consent-policy','true');

        $data = '<div class="es-field-wrap">
                <input type="checkbox" name="es-gdpr-agree" id="es-gdpr-agree" value="1" required="required"> ';
        $data .= sprintf(
                __($gdpr_text_policy, 'gdpr-framework'),
                "<a href='{$policyPageUrl}' target='_blank'>",
                "</a>");
        $data .='</div>';

        echo $data;
    }
 
    public function newsletter_gdpr_consent($data){ 
        if($_POST['esfpx_email']){ 

                $esfpx_email = sanitize_email($_POST['esfpx_email']);
                $dataSubject = $this->dataSubjectManager->getByEmail($esfpx_email);
                $dataSubject->giveConsent('privacy-policy'); 
         }
         return $data;
    }

    public function getNewsletterExportData(array $data, $email)
    {              
        global $wpdb;

        $results  = $wpdb->get_row($wpdb->prepare("SELECT wc.*, GROUP_CONCAT(DISTINCT ls.name ORDER BY ls.name) as list_details  FROM {$wpdb->prefix}ig_contacts as wc LEFT JOIN {$wpdb->prefix}ig_lists_contacts as wl ON wc.id = wl.contact_id LEFT JOIN {$wpdb->prefix}ig_lists as ls ON ls.id = wl.list_id WHERE email = %s",sanitize_email($email)),ARRAY_A);

        if (!count($results)) {
            return $data;
        }
        
        unset($results['hash'],$results['is_rolebased'],$results['is_webmail'],$results['is_deliverable'],$results['is_sendsafely'],$results['is_verified'],$results['is_disposable'],$results['id']);

        if($results['email'])
        {
            $title   = __('Newsletter Form submissions: ', 'gdpr');
            foreach ($results as $i => $message) 
            {            
                $data[$title][$i] = $message;
            }
        }
        
        return $data; 
    }
    /*
    *   Delete user information from order by email address.
    */
    public function deleteNewsletterEntries($email)
    {   
        $contact_id = \ES_DB_Contacts::get_contact_id_by_email($email);
        if($contact_id){
            \ES_DB_Contacts::delete_subscribers(array($contact_id));
        }
    }
}
