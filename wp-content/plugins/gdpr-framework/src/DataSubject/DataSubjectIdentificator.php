<?php

namespace Codelight\GDPR\DataSubject;

use Codelight\GDPR\Options\Options;
use Codelight\GDPR\Components\Consent\UserConsentModel; 
/**
 * Identify the data subject by unique temporary key
 *
 * Class DataSubjectIdentificator
 *
 * @package Codelight\GDPR\DataSubject
 */
class DataSubjectIdentificator
{
    /* @var DataSubjectManager */
    protected $dataSubjectManager;

    /* @var Options */
    protected $options;

    protected $UserConsentModel;
    /**
     * DataSubjectIdentificator constructor.
     *
     * @param DataSubjectManager $dataSubjectManager
     */
    public function __construct(DataSubjectManager $dataSubjectManager, Options $options,UserConsentModel $UserConsentModel)
    {
        $this->dataSubjectManager = $dataSubjectManager;
        $this->options = $options;
        $this->UserConsentModel = $UserConsentModel;
    }

    /**
     * Check if there is any data associated with the given email address
     *
     * @param $email
     * @return bool
     */
    public function isDataSubject($email)
    {
        $email = sanitize_email($email);
        $dataSubject = $this->dataSubjectManager->getByEmail($email);
        $get_on_site_status='';
        if($dataSubject->hasData()){
            $get_on_site_status = $dataSubject->hasData();
        }else{
            $output = $this->UserConsentModel->getAll($email);
            if (!empty($output)) {
                $get_on_site_status = 1;
            }
        }
        return apply_filters('gdpr/data-subject/has-data', $get_on_site_status, $email);
    }

    /**
     * Send the email with the link that allows data subject to authenticate
     *
     * @param $email
     */
    public function sendIdentificationEmail($email)
    {
        $email = sanitize_email($email);
        $key = $this->generateKey($email);
        $privacyToolsPageUrl = gdpr('helpers')->getPrivacyToolsPageUrl();
        $privacyToolsPageUrl = apply_filters('privacy_tools_gdprf_page_url',$privacyToolsPageUrl);
        $identificationUrl = add_query_arg([
            'gdpr_key' => $key,
            'email' => $email,
        ], $privacyToolsPageUrl);

        $siteName = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        // todo: handle or log email sending errors
        gdpr('helpers')->mail(
            $email,
            __("Your personal data on", 'gdpr-framework') . ' ' . $siteName,
            gdpr('view')->render('email/identify-data-subject', compact('identificationUrl', 'siteName')),
            ['Content-Type: text/html; charset=UTF-8']
        );
    }

    /**
     * Notify the email address that we do not store any data about them
     *
     * @param $email
     */
    public function sendNoDataFoundEmail($email)
    {
        $email = sanitize_email($email);
        $siteName = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        gdpr('helpers')->mail(
            $email,
            __("Your personal data on", 'gdpr-framework') . ' ' . $siteName,
            gdpr('view')->render('email/no-data', compact('siteName')),
            ['Content-Type: text/html; charset=UTF-8']
        );
    }

    /**
     * Check if the given key is valid for the given email
     *
     * @param $email
     * @param $key
     * @return bool
     */
    public function isKeyValid($email, $key)
    {
        $email = sanitize_email($email);
        $keyData = $this->options->get("key_{$email}");

        if (!$keyData) {
            // No key exists
            return false;
        }

        if (!isset($keyData['hashed-key']) || empty($keyData['hashed-key'])) {
            // There was an error saving the data to database
            return false;
        }

        if (!$this->validateKey($key, $keyData['hashed-key'])) {
            // Invalid key
            return false;
        }

        if ($keyData['valid-until'] < strtotime('now')) {
            // expired key
            return false;
        }

        // Double-check everything just to make sure we leave no errors in the code
        return ($this->validateKey($key, $keyData['hashed-key']) && $keyData['valid-until'] > strtotime('now'));
    }

    /**
     * Generate a secret key using the same functionality WP itself is using for Forgot Password requests
     *
     * @param $email
     */
    public function generateKey($email)
    {
        $key = wp_generate_password(20, false);
        $this->saveKey($email, $key);

        return $key;
    }

    /**
     * Save key into the database along with the expiration timestamp
     *
     * @param $email
     * @param $key
     */
    protected function saveKey($email, $key)
    {
        $email = sanitize_email($email);
        $this->options->set("key_{$email}", [
            'email'       => $email,
            'hashed-key'  => $this->hashKey($key),
            'valid-until' => strtotime('+15 minutes'),
        ]);
    }

    /**
     * @param $submittedKey
     * @param $storedKey
     */
    protected function validateKey($submittedKey, $storedKey)
    {
        return $this->getHasher()->CheckPassword($submittedKey, $storedKey);
    }

    /**
     * Hash the key before saving to database to keep it hidden from the prying eyes of your sysadmin
     *
     * @param $key
     * @return bool|string
     */
    protected function hashKey($key)
    {
        return $this->getHasher()->HashPassword($key);
    }

    /**
     * @return \PasswordHash
     */
    protected function getHasher()
    {
        global $wp_hasher;
        if (empty($wp_hasher)) {
            require_once ABSPATH . WPINC . '/class-phpass.php';
            $wp_hasher = new \PasswordHash(8, true);
        }

        return $wp_hasher;
    }
}
