<?php

namespace Codelight\GDPR\Components\Consent;

/**
 * Handles getting, saving and removing consent based on a whitelist
 *
 * Class ConsentManager
 *
 * @package Codelight\GDPR\Components\Consent
 */
class ConsentManager
{
    /* @var UserConsentModel */
    protected $model;

    /* @var array */
    protected $defaultConsentTypes = [];

    /* @var array */
    protected $customConsentTypes = [];

    /**
     * ConsentManager constructor.
     *
     * @param UserConsentModel $model
     */
    public function __construct(UserConsentModel $model)
    {
        $this->model = $model;

        add_action('init', [$this, 'registerCustomConsentTypes'], 0);
        add_action('init', [$this, 'registerDefaultConsentTypes'], 0);
        
        add_filter('gdpr/data-subject/data', [$this, 'getdata'], 20, 2);
        add_action('gdpr/data-subject/delete', [$this, 'delete']);
        add_action('gdpr/data-subject/anonymize', [$this, 'anonymize'], 10, 2);
    }

    public function registerDefaultConsentTypes()
    {   
        /****
         * privacy-policy default consent
         */
        $policyPageUrl = get_permalink(gdpr('options')->get('policy_page'));
        add_filter( 'gdpr_custom_policy_link', 'gdprfPrivacyPolicyurl' );
    
        $policyPageUrl = apply_filters( 'gdpr_custom_policy_link',$policyPageUrl);

        gdpr('consent')->register(
            'privacy-policy',
            sprintf(
                __('I accept the %sPrivacy Policy%s', 'gdpr-framework'),
                "<a href='{$policyPageUrl}' target='_blank'>",
                "</a>"
            ),
            _x('This consent is not visible by default. If someone wishes to withdraw it, they should simply request to delete all their data.', '(Admin)', 'gdpr-framework'),
            false
        );
        /****
         * terms-conditions default consent
         */
        $termsPage = gdpr('options')->get('terms_page');
        if ($termsPage) {
            $termsPageUrl = get_permalink($termsPage);
        } else {
            $termsPageUrl = false;
        }

        if ($termsPageUrl) {
            gdpr('consent')->register(
                'terms-conditions',
                sprintf(
                    __('I accept the %sTerms & Conditions%s', 'gdpr-framework'),
                    "<a href='{$termsPageUrl}' target='_blank'>",
                    "</a>"
                ),
                _x('This consent is not visible by default. If someone wishes to withdraw it, they should simply request to delete all their data.', '(Admin)', 'gdpr-framework'),
                false
            );
        }
        /****
         * ClassiDocsCallback default consent
         */
        gdpr('consent')->register(
            'ClassiDocsCallback','ClassiDocsCallback',
            _x('This consent is not visible by default. If someone wishes to withdraw it, they should simply request to delete all their data.', '(Admin)', 'gdpr-framework'),
            true
        );
        /****
         * Woocommerce Policy consent
         */
        if ( class_exists( 'WooCommerce' ) ) {
            gdpr('consent')->register(
                'gdpr_woo_consent', _x('Woocommerce Policy Consent', '(Admin)', 'gdpr-framework'),
                _x('This consent is visible by default on woocommerce checkout page. If someone wishes to withdraw it, they should simply request to delete all their data.', '(Admin)', 'gdpr-framework'),
                true
            );
        }
    }

    /**
     * Get a list of all registered consent types
     *
     * @return array
     */
    public function getConsentTypes()
    {
        return apply_filters('gdpr/consent/types', $this->getDefaultConsentTypes() + $this->getCustomConsentTypes());
    }

    /**
     * Get all consent types registered by external sources, i.e. not stored in the database
     *
     * @return array
     */
    public function getDefaultConsentTypes()
    {
        return apply_filters('gdpr/consent/types/default', $this->defaultConsentTypes);
    }

    /**
     * Get all consent types registered by the admin, i.e. stored in the database
     *
     * @return array
     */
    public function getCustomConsentTypes()
    {
        return apply_filters('gdpr/consent/types/custom', $this->customConsentTypes);
    }

    /**
     * Register a *default* consent in the list of valid consents
     *
     * @param $consent
     */
    public function register($slug, $title, $description, $visible = true)
    {
        $this->defaultConsentTypes[$slug] = [
            'slug'        => $slug,
            'title'       => $title,
            'description' => $description,
            'visible'     => $visible,
        ];
    }

    /**
     * Register consent types saved via WP admin
     */
    public function registerCustomConsentTypes()
    {
        $savedConsentTypes = gdpr('options')->get('consent_types');

        if (is_array($savedConsentTypes) && count($savedConsentTypes)) 
        {
            foreach ($savedConsentTypes as $consentType) 
            {
                $this->customConsentTypes[$consentType['slug']] = [
                    'slug'        => isset($consentType['slug']) ? $consentType['slug'] : '',
                    'title'       => isset($consentType['title']) ? $consentType['title'] : '',
                    'description' => isset($consentType['description']) ? $consentType['description'] : '',
                    'visible'     => isset($consentType['visible']) ? $consentType['visible'] : '',
                ];
            }
        }
    }

    /**
     * Save the given consent types to database
     *
     * @param $consentTypes
     */
    public function saveCustomConsentTypes($consentTypes)
    {
        // Todo: validate to make sure something broken is not saved to DB
        gdpr('options')->set('consent_types', $consentTypes);
    }

    /**
     * Check if a consent is valid so that we don't write random stuff in the database by accident
     *
     * @param $consent
     * @return bool
     */
    public function isRegisteredConsent($consent)
    {
		
		return null !== $this->getConsentTypes( $consent );
		//return isset($this->getConsentTypes()[$consent]);
    }

    /**
     * Check if the given consent is valid. If not, throw error.
     *
     * @param $consent
     */
    protected function validateConsent($consent)
    {
        if (!$this->isRegisteredConsent($consent)) 
        {
            wp_die("Not a valid consent: " . esc_html($consent));
        }
    }

    /**
     * Set a consent as 'given' for the data subject
     *
     * @param $email
     * @param $consent
     */
    public function giveConsent($email, $consent, $valid_until = null)
    {
        $this->validateConsent($consent);

        $validation = apply_filters('gdpr/consent/give', true, $email, $consent);

        // If the data subject has already given this consent, do nothing
        if ($this->model->given($email, $consent) || !$validation) 
        {
            return;
        }

        $this->model->give($email, $consent,  $valid_until);
        do_action('gdpr/consent/given', $email, $consent);
    }

    /**
     * Set a consent as withdrawn for the data subject
     *
     * @param $email
     * @param $consent
     */
    public function withdrawConsent($email, $consent)
    {
        $this->validateConsent($consent);

        $validation = apply_filters('gdpr/consent/withdraw', true, $email, $consent);

        // If the consent has never been given or if data subject has already withdrawn this consent, do nothing
        if (!$this->model->exists($email, $consent) || $this->model->withdrawn($email, $consent) || !$validation) 
        {
            return;
        }

        $this->model->withdraw($email, $consent);
        do_action('gdpr/consent/withdrawn', $email, $consent, 'withdrawn');
    }

    /**
     * Remove consent given by subject
     *
     * @param $email
     * @param $consent
     */
    public function deleteConsent($email, $consent)
    {
        $this->validateConsent($consent);

        if ($this->model->given($email, $consent)) 
        {
            do_action('gdpr/consent/withdrawn', $email, $consent, 'deleted');
        }

        $this->model->delete($email, $consent);
    }

    /**
     * Withdraw and anonymize a consent
     *
     * @param $email
     * @param $consent
     * @param $anonymizedId
     */
    public function anonymizeConsent($email, $consent, $anonymizedId)
    {
        $this->validateConsent($consent);

        if ($this->model->given($email, $consent)) 
        {
            do_action('gdpr/consent/withdrawn', $email, $consent, 'anonymized');
        }

        $this->model->anonymize($email, $consent, $anonymizedId);
    }

    /**
     * Get all consent given by subject
     *
     * @param $email
     */
    public function getAllConsents($email)
    {
        return $this->model->getAll($email);
    }

    /**
     * Get all consent given by subject with other data
     *
     * @param $email
     */
    public function getAllConsentswithdetails($email)
    {
        return $this->model->getAllwithdetails($email);
    }
    
    /**
     * Get all logs deleted for user
     *
     * @param $id
     */
    public function gdpr_delete_log($id)
    {
        return $this->model->deletelog($id);
    }
    
    /**
     * Get all user logs
     *
     * @param $email
     */
    public function getuserlogsData($email)
    { 
        $usefromemail = get_user_by( 'email', $email );
        return $this->model->getuserlogs($usefromemail->data->ID);
    }

    /**
     * Get the registered consent types and add 'given' field depending
     * on whether or not the user has given this particular consent
     *
     * @param $dataSubjectConsents
     * @return array
     */
    public function getConsentData($dataSubjectConsents)
    {   
		$consentTypes = $this->getConsentTypes();
		$consents     = [];

		if($dataSubjectConsents){
			foreach ($dataSubjectConsents as $consent => $subjectConsentType){
				$subjectConsentTypeArray[$subjectConsentType->consent] = $subjectConsentType->consent;
				$subjectConsentUntilArray[$subjectConsentType->consent] = $subjectConsentType->valid_until;
	
			}		
			foreach ($consentTypes as $slug => $consentType) 
			{
				if (in_array($slug, $subjectConsentTypeArray)) 
				{
					$consents[$slug] = $consentType;
					$consents[$slug]['valid_until'] = $subjectConsentUntilArray[$slug];
				}
			}        
	
			return $consents;
		}
		
		
    }
     /**
     * Get the registered consent types and add 'given' field depending
     * on whether or not the user has given this particular consent
     *
     * @param $dataSubjectConsents
     * @return array
     */
    public function getClassiDocsdata($dataSubjectConsents)
    {   
        $old_responce=array();
        $getclassidocs_url = gdpr('options')->get('classidocs_url');
        $classidoc_API_URL1 = esc_url_raw($getclassidocs_url."/gdpr/query/");
        $response = wp_remote_get($classidoc_API_URL1); 
        if ( is_array( $response ) && ! is_wp_error( $response ) ) 
        {   
            if(json_Decode($response['body'])){
                foreach(json_Decode($response['body']) as $data)
                {
                    if($dataSubjectConsents == $data->query)
                    {
                        $old_responce[]=$data->id;
                    }
                }
            }
        }

        $body=array();
        $ClassiDocsdata ="";
        if(gdpr('options')->get('classidocs_integration'))
        {
            if($old_responce)
            {
                foreach($old_responce as $response)
                {
                    $query=$response;       //static for testing
                    $getclassidocs_url = gdpr('options')->get('classidocs_url');
                    $classidoc_API_URL2 = esc_url_raw($getclassidocs_url."/gdpr/query/".$query."?pageSize=200");
                    $response = wp_remote_get($classidoc_API_URL2); 
                    if ( is_array( $response ) && ! is_wp_error( $response ) ) 
                    {
                        $headers = $response['headers']; // array of http header lines
                        $body[]    = $response['body']; // use the content
                    }
                }
            }
                        
        }
        if(isset($body[0]))
        {
            $ClassiDocsdata = $body[0];
        }
        return $ClassiDocsdata;
	}
	
	public function getbySlugConsent($dataSubjectConsents)
    {   
        if(isset($dataSubjectConsents) && !empty($dataSubjectConsents)){
            $dataSubjectConsents=sanitize_key($dataSubjectConsents);
            $consentTypes = $this->getConsentTypes();
            foreach ($consentTypes as $slug => $consentType) 
            {
                if ($slug === $dataSubjectConsents) 
                {
                    return $consentType;
                }
            }
        }

        
    }

    /**
     * Return a list of all data subjects who have given a particular consent
     *
     * @param $consent
     */
    public function getAllDataSubjectsByConsent($consent)
    {
        // Todo
    }

    /**
     * Return a list of all consent with other data
     *
     * @param $data and $email
     */
    public function getdata(array $data, $email)
    {  
        $consents = $this->getAllConsentswithdetails($email);
        if(!empty($consents))
        {
            $title  = __('Consent Information', 'gdpr'); 
            foreach ($consents  as $i => $consent) 
            {
                $data[$title][$i]['consent'] = $consent->consent;
                $data[$title][$i]['updated_at'] = $consent->updated_at;
                $data[$title][$i]['ip'] = $consent->ip;
            }
        } 
        return $data;
    }
    /**
     * Withdraw and delete all consents given by a data subject
     *
     * @param $email
     */
    public function delete($email)
    {
        $consents = $this->getAllConsents($email);
        foreach ($consents as $consent) 
        {
            $this->deleteConsent($email, $consent->consent);
        }
    }

    /**
     * Withdraw and anonymize all consents given by a data subject
     *
     * @param             $email
     * @param             $anonymizedId
     */
    public function anonymize($email, $anonymizedId)
    {
        $consents = $this->getAllConsents($email);
        foreach ($consents as $consent) 
        {
            $this->anonymizeConsent($email, $consent->consent, $anonymizedId);
        }
    }
}
