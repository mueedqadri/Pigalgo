<?php


namespace Codelight\GDPR\Modules\ContactForm7;


class Flamingo
{
    public function __construct()
    {
        add_filter('wpcf7_editor_panels', [$this, 'addCF7Tab']);
        add_action('wpcf7_save_contact_form', [$this, 'saveCF7Tab'], 10, 3);        
        add_action( 'wpcf7_admin_notices', [$this, 'addInformation'] );

        add_filter('gdpr/data-subject/data', [$this, 'getExportData'], 20, 2);
        add_action('gdpr/data-subject/delete', [$this, 'deleteEntries']);
        add_action('gdpr/data-subject/anonymize', [$this, 'deleteEntries']);
    }

    public function addCF7Tab($tabs)
    {   
        $tabs['privacy-panel'] = [
            'title'    => __('Privacy', 'gdpr-framework'),
            'callback' => [$this, 'renderPrivacyTab'],
        ];

        return $tabs;
    }

    public function renderPrivacyTab(\WPCF7_ContactForm $form)
    {   
        $enabled    = get_post_meta($form->id(), 'gdpr_cf7_enabled', true) ? get_post_meta($form->id(), 'gdpr_cf7_enabled', true) : '';
        $emailField = get_post_meta($form->id(), 'gdpr_cf7_email_field', true) ? get_post_meta($form->id(), 'gdpr_cf7_email_field', true) : '';

        echo gdpr('view')->render(
            'modules/contact-form-7/form-privacy-tab',
            compact('enabled', 'emailField')
        );
    }

    public function saveCF7Tab(\WPCF7_ContactForm $contactForm, $args, $context)
    {
        if(isset($_POST['post_ID']) && $_POST['post_ID'])
        {   
            $contact_form_id = filter_var($_POST['post_ID'], FILTER_SANITIZE_NUMBER_INT);    
            if (isset($_POST['gdpr_cf7_enabled'])) {
                $sanitized_gdpr_cf7_enabled = filter_var($_POST['gdpr_cf7_enabled'], FILTER_SANITIZE_NUMBER_INT);
                update_post_meta($contact_form_id, 'gdpr_cf7_enabled', $sanitized_gdpr_cf7_enabled);
            }

            if (isset($_POST['gdpr_cf7_email_field']) && !empty($_POST['gdpr_cf7_email_field'])) {
                $sanitized_gdpr_cf7_email_field = filter_var($_POST['gdpr_cf7_email_field'], FILTER_SANITIZE_STRING);
                update_post_meta($contact_form_id, 'gdpr_cf7_email_field', $sanitized_gdpr_cf7_email_field);
            }
        }
    }

    public function getExportData(array $data, $email)
    {
        $entries = $this->getEntriesByEmail($email);

        if (!count($entries)) {
            return $data;
        }

        foreach ($entries as $i => $message) {
            $title   = __('Form submissions: ', 'gdpr') . ucfirst($message->channel);

            if (count($message->fields)) {
                foreach ($message->fields as $key => $value) {
                    $data[$title][$i][$key] = $value;
                }
            }

            if (count($message->consent)) {
                foreach ($message->consent as $key => $value) {
                    $data[$title][$i][$key] = $value;
                }
            }

            $data[$title][$i]['date']       = $message->date;
            $data[$title][$i]['ip']         = $message->meta['remote_ip'];
            $data[$title][$i]['user_agent'] = $message->meta['user_agent'];
            $data[$title][$i]['url']        = $message->meta['post_url'];
        }

        return $data;
    }

    public function getEntriesByEmail($email)
    {
        $forms = $this->getValidForms();

        if (!count($forms)) {
            return [];
        }

        $entries = [];

        foreach ($forms as $form) {
            /* @var $form \WPCF7_ContactForm */
            $messages = \Flamingo_Inbound_Message::find([
               'posts_per_page' => -1,
               'channel' => get_post_field( 'post_name', $form->id()),
            ]);

            if (!count($messages)) {
                continue;
            }

            $emailField = get_post_meta($form->id(), 'gdpr_cf7_email_field', true);

            if (!$emailField) {
                continue;
            }

            foreach ($messages as $message) {
                if ($email === $message->fields[$emailField]) {
                    $entries[] = $message;
                }
            }
        }

        return $entries;
    }

    public function getValidForms()
    {
        return \WPCF7_ContactForm::find([
            'meta_query' => [
                [
                    'key'   => 'gdpr_cf7_enabled',
                    'value' => '1',
                ],
            ],
        ]);
    }

    public function deleteEntries($email)
    {
        $entries = $this->getEntriesByEmail($email);

        if (count($entries)) {
            foreach ($entries as $i => $message) {
                if ($message->id) {
                    $message->delete();
                }
            }
        }

        $contacts = \Flamingo_Contact::search_by_email($email);
        if (count($contacts)) {
            foreach ($contacts as $i => $contactId) {
                (new \Flamingo_Contact($contactId))->delete();
            }
        }

    }

    public function addInformation()
    {
        $gdpr_notice_heading =  _x("Do you want form to be GDPR compliance.", "(Admin)", "gdpr-framework");
        $gdpr_notice_message =  _x("You have installed flamingo, To make this GDPR compliance in individual contact form's privacy tab check the checkbox for include data to be search on Privacy tool.", "(Admin)", "gdpr-framework");

        echo "<div class='welcome-gdpr-notice'>";
        echo "<h3>".$gdpr_notice_heading."</h3>";
        echo "<p>".$gdpr_notice_message."</p>";
        echo "</div>";
    }

}