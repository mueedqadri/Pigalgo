<?php

namespace Codelight\GDPR;

/**
 * General helper functions
 *
 * Class Helpers
 *
 * @package Codelight\GDPR
 */
class Helpers
{
    public function supportUrl($url = '')
    {
        return gdpr('config')->get('help.url') . $url;
    }

    /**
     * Get an associative array of EU countries
     *
     * @return array
     */
    public function getEUCountryList()
    {
        return [
            'AT' => _x('Austria', '(Admin)', 'gdpr-framework'),
            'BE' => _x('Belgium', '(Admin)', 'gdpr-framework'),
            'BG' => _x('Bulgaria', '(Admin)', 'gdpr-framework'),
            'HR' => _x('Croatia','(Admin)', 'gdpr-framework'),
            'CY' => _x('Cyprus', '(Admin)', 'gdpr-framework'),
            'CZ' => _x('Czech Republic', '(Admin)', 'gdpr-framework'),
            'DK' => _x('Denmark', '(Admin)', 'gdpr-framework'),
            'EE' => _x('Estonia', '(Admin)', 'gdpr-framework'),
            'FI' => _x('Finland', '(Admin)', 'gdpr-framework'),
            'FR' => _x('France', '(Admin)', 'gdpr-framework'),
            'DE' => _x('Germany', '(Admin)', 'gdpr-framework'),
            'GR' => _x('Greece', '(Admin)', 'gdpr-framework'),
            'HU' => _x('Hungary', '(Admin)', 'gdpr-framework'),
            'IE' => _x('Ireland', '(Admin)', 'gdpr-framework'),
            'IT' => _x('Italy', '(Admin)', 'gdpr-framework'),
            'LV' => _x('Latvia', '(Admin)', 'gdpr-framework'),
            'LT' => _x('Lithuania', '(Admin)', 'gdpr-framework'),
            'LU' => _x('Luxembourg', '(Admin)', 'gdpr-framework'),
            'MT' => _x('Malta', '(Admin)', 'gdpr-framework'),
            'NL' => _x('Netherlands', '(Admin)', 'gdpr-framework'),
            'PL' => _x('Poland', '(Admin)', 'gdpr-framework'),
            'PT' => _x('Portugal', '(Admin)', 'gdpr-framework'),
            'RO' => _x('Romania', '(Admin)', 'gdpr-framework'),
            'SK' => _x('Slovakia', '(Admin)', 'gdpr-framework'),
            'SI' => _x('Slovenia', '(Admin)', 'gdpr-framework'),
            'ES' => _x('Spain', '(Admin)', 'gdpr-framework'),
            'SE' => _x('Sweden', '(Admin)', 'gdpr-framework'),
            'UK' => _x('United Kingdom', '(Admin)', 'gdpr-framework'),
            // All country list
            'AF' => _x('Afghanistan ', '(Admin)', 'gdpr-framework'),
            'AX' => _x('Åland Islands', '(Admin)', 'gdpr-framework'),
            'AL' => _x('Albania', '(Admin)', 'gdpr-framework'),
            'DZ' => _x('Algeria', '(Admin)', 'gdpr-framework'),
            'AS' => _x('American Samoa  ', '(Admin)', 'gdpr-framework'),
            'AD' => _x('Andorra', '(Admin)', 'gdpr-framework'),
            'AO' => _x('Angola', '(Admin)', 'gdpr-framework'),
            'AI' => _x('Anguilla', '(Admin)', 'gdpr-framework'),
            'AQ' => _x('Antarctica', '(Admin)', 'gdpr-framework'),
            'AG' => _x('Antigua and Barbuda', '(Admin)', 'gdpr-framework'),
            'AR' => _x('Argentina', '(Admin)', 'gdpr-framework'),
            'AM' => _x('Armenia', '(Admin)', 'gdpr-framework'),
            'AW' => _x('Aruba', '(Admin)', 'gdpr-framework'),
            'AU' => _x('Australia', '(Admin)', 'gdpr-framework'),
            'AZ' => _x('Azerbaijan', '(Admin)', 'gdpr-framework'),
            'BH' => _x('Bahrain', '(Admin)', 'gdpr-framework'),
            'BS' => _x('Bahamas', '(Admin)', 'gdpr-framework'),
            'BD' => _x('Bangladesh', '(Admin)', 'gdpr-framework'),
            'BB' => _x('Barbados', '(Admin)', 'gdpr-framework'),
            'BY' => _x('Belarus', '(Admin)', 'gdpr-framework'),
            'BZ' => _x('Belize', '(Admin)', 'gdpr-framework'),
            'BJ' => _x('Benin', '(Admin)', 'gdpr-framework'),
            'BM' => _x('Bermuda', '(Admin)', 'gdpr-framework'),
            'BT' => _x('Bhutan', '(Admin)', 'gdpr-framework'),
            'BO' => _x('Bolivia, Plurinational State of', '(Admin)', 'gdpr-framework'),
            'BQ' => _x('Bonaire, Sint Eustatius and Saba', '(Admin)', 'gdpr-framework'),
            'BA' => _x('Bosnia and Herzegovina', '(Admin)', 'gdpr-framework'),
            'BW' => _x('Botswana', '(Admin)', 'gdpr-framework'),
            'BV' => _x('Bouvet Island', '(Admin)', 'gdpr-framework'),
            'BR' => _x('Brazil', '(Admin)', 'gdpr-framework'),
            'IO' => _x('British Indian Ocean Territory', '(Admin)', 'gdpr-framework'),
            'BN' => _x('Brunei Darussalam', '(Admin)', 'gdpr-framework'),
            'BF' => _x('Burkina Faso', '(Admin)', 'gdpr-framework'),
            'BI' => _x('Burundi', '(Admin)', 'gdpr-framework'),
            'KH' => _x('Cambodia', '(Admin)', 'gdpr-framework'),
            'CM' => _x('Cameroon', '(Admin)', 'gdpr-framework'),
            'CA' => _x('Canada', '(Admin)', 'gdpr-framework'),
            'CV' => _x('Cape Verde', '(Admin)', 'gdpr-framework'),
            'KY' => _x('Cayman Islands', '(Admin)', 'gdpr-framework'),
            'CF' => _x('Central African Republic', '(Admin)', 'gdpr-framework'),
            'TD' => _x('Chad', '(Admin)', 'gdpr-framework'),
            'CL' => _x('Chile', '(Admin)', 'gdpr-framework'),
            'CN' => _x('China', '(Admin)', 'gdpr-framework'),
            'CX' => _x('Christmas Island', '(Admin)', 'gdpr-framework'),
            'CC' => _x('Cocos (Keeling) Islands', '(Admin)', 'gdpr-framework'),
            'CO' => _x('Colombia', '(Admin)', 'gdpr-framework'),
            'KM' => _x('Comoros', '(Admin)', 'gdpr-framework'),
            'CG' => _x('Congo', '(Admin)', 'gdpr-framework'),
            'CD' => _x('Congo, the Democratic Republic of the', '(Admin)', 'gdpr-framework'),
            'CK' => _x('Cook Islands', '(Admin)', 'gdpr-framework'),
            'CR' => _x('Costa Rica', '(Admin)', 'gdpr-framework'),
            'CI' => _x('Côte dIvoire', '(Admin)', 'gdpr-framework'),
            'CU' => _x('Cuba', '(Admin)', 'gdpr-framework'),
            'CW' => _x('Curaçao', '(Admin)', 'gdpr-framework'),
            'DJ' => _x('Djibouti', '(Admin)', 'gdpr-framework'),
            'DM' => _x('Dominica', '(Admin)', 'gdpr-framework'),
            'DO' => _x('Dominican Republic', '(Admin)', 'gdpr-framework'),
            'EC' => _x('Ecuador', '(Admin)', 'gdpr-framework'),
            'EG' => _x('Egypt', '(Admin)', 'gdpr-framework'),
            'SV' => _x('El Salvador', '(Admin)', 'gdpr-framework'),
            'GQ' => _x('Equatorial Guinea', '(Admin)', 'gdpr-framework'),
            'ER' => _x('Eritrea', '(Admin)', 'gdpr-framework'),
            'ET' => _x('Ethiopia', '(Admin)', 'gdpr-framework'),
            'FK' => _x('Falkland Islands (Malvinas)', '(Admin)', 'gdpr-framework'),
            'FO' => _x('Faroe Islands', '(Admin)', 'gdpr-framework'),
            'FJ' => _x('Fiji', '(Admin)', 'gdpr-framework'),
            'GF' => _x('French Guiana', '(Admin)', 'gdpr-framework'),
            'PF' => _x('French Polynesia', '(Admin)', 'gdpr-framework'),
            'TF' => _x('French Southern Territories', '(Admin)', 'gdpr-framework'),
            'GA' => _x('Gabon', '(Admin)', 'gdpr-framework'),
            'GM' => _x('Gambia', '(Admin)', 'gdpr-framework'),
            'GE' => _x('Georgia', '(Admin)', 'gdpr-framework'),
            'GE' => _x('Georgia ', '(Admin)', 'gdpr-framework'),
            'GH' => _x('Ghana', '(Admin)', 'gdpr-framework'),
            'GI' => _x('Gibraltar', '(Admin)', 'gdpr-framework'),
            'GL' => _x('Greenland', '(Admin)', 'gdpr-framework'),
            'GD' => _x('Grenada ', '(Admin)', 'gdpr-framework'),
            'GP' => _x('Guadeloupe  ', '(Admin)', 'gdpr-framework'),
            'GU' => _x('Guam', '(Admin)', 'gdpr-framework'),
            'GT' => _x('Guatemala', '(Admin)', 'gdpr-framework'),
            'GG' => _x('Guernsey', '(Admin)', 'gdpr-framework'),
            'GN' => _x('Guinea  ', '(Admin)', 'gdpr-framework'),
            'GW' => _x('Guinea-Bissau   ', '(Admin)', 'gdpr-framework'),
            'GY' => _x('Guyana  ', '(Admin)', 'gdpr-framework'),
            'HT' => _x('Haiti   ', '(Admin)', 'gdpr-framework'),
            'HM' => _x('Heard Island and McDonald Islands   ', '(Admin)', 'gdpr-framework'),
            'VA' => _x('Holy See (Vatican City State)   ', '(Admin)', 'gdpr-framework'),
            'HN' => _x('Honduras    ', '(Admin)', 'gdpr-framework'),
            'HK' => _x('Hong Kong   ', '(Admin)', 'gdpr-framework'),
            'IN' => _x('India   ', '(Admin)', 'gdpr-framework'),
            'ID' => _x('Indonesia   ', '(Admin)', 'gdpr-framework'),
            'IR' => _x('Iran, Islamic Republic of   ', '(Admin)', 'gdpr-framework'),
            'IQ' => _x('Iraq    ', '(Admin)', 'gdpr-framework'),
            'IM' => _x('Isle of Man ', '(Admin)', 'gdpr-framework'),
            'IL' => _x('Israel  ', '(Admin)', 'gdpr-framework'),
            'JM' => _x('Jamaica ', '(Admin)', 'gdpr-framework'),
            'JP' => _x('Japan   ', '(Admin)', 'gdpr-framework'),
            'JE' => _x('Jersey  ', '(Admin)', 'gdpr-framework'),
            'JO' => _x('Jordan  ', '(Admin)', 'gdpr-framework'),
            'KZ' => _x('Kazakhstan  ', '(Admin)', 'gdpr-framework'),
            'KE' => _x('Kenya   ', '(Admin)', 'gdpr-framework'),
            'KI' => _x('Kiribati    ', '(Admin)', 'gdpr-framework'),
            'KP' => _x('Korea, Democratic Peoples Republic of   ', '(Admin)', 'gdpr-framework'),
            'KR' => _x('Korea, Republic of  ', '(Admin)', 'gdpr-framework'),
            'KW' => _x('Kuwait  ', '(Admin)', 'gdpr-framework'),
            'KG' => _x('Kyrgyzstan  ', '(Admin)', 'gdpr-framework'),
            'LA' => _x('Lao Peoples Democratic Republic ', '(Admin)', 'gdpr-framework'),
            'LB' => _x('Lebanon ', '(Admin)', 'gdpr-framework'),
            'LS' => _x('Lesotho ', '(Admin)', 'gdpr-framework'),
            'LR' => _x('Liberia ', '(Admin)', 'gdpr-framework'),
            'LY' => _x('Libya   ', '(Admin)', 'gdpr-framework'),
            'MO' => _x('Macao   ', '(Admin)', 'gdpr-framework'),
            'MK' => _x('Macedonia, the Former Yugoslav Republic of  ', '(Admin)', 'gdpr-framework'),
            'MG' => _x('Madagascar  ', '(Admin)', 'gdpr-framework'),
            'MW' => _x('Malawi  ', '(Admin)', 'gdpr-framework'),
            'MY' => _x('Malaysia    ', '(Admin)', 'gdpr-framework'),
            'MV' => _x('Maldives    ', '(Admin)', 'gdpr-framework'),
            'ML' => _x('Mali    ', '(Admin)', 'gdpr-framework'),
            'MH' => _x('Marshall Islands    ', '(Admin)', 'gdpr-framework'),
            'MQ' => _x('Martinique  ', '(Admin)', 'gdpr-framework'),
            'MR' => _x('Mauritania  ', '(Admin)', 'gdpr-framework'),
            'MU' => _x('Mauritius   ', '(Admin)', 'gdpr-framework'),
            'YT' => _x('Mayotte ', '(Admin)', 'gdpr-framework'),
            'MX' => _x('Mexico  ', '(Admin)', 'gdpr-framework'),
            'FM' => _x('Micronesia, Federated States of ', '(Admin)', 'gdpr-framework'),
            'MD' => _x('Moldova, Republic of    ', '(Admin)', 'gdpr-framework'),
            'MC' => _x('Monaco  ', '(Admin)', 'gdpr-framework'),
            'MN' => _x('Mongolia    ', '(Admin)', 'gdpr-framework'),
            'ME' => _x('Montenegro  ', '(Admin)', 'gdpr-framework'),
            'MS' => _x('Montserrat  ', '(Admin)', 'gdpr-framework'),
            'MA' => _x('Morocco ', '(Admin)', 'gdpr-framework'),
            'MZ' => _x('Mozambique  ', '(Admin)', 'gdpr-framework'),
            'MM' => _x('Myanmar ', '(Admin)', 'gdpr-framework'),
            'NA' => _x('Namibia ', '(Admin)', 'gdpr-framework'),
            'NR' => _x('Nauru   ', '(Admin)', 'gdpr-framework'),
            'NP' => _x('Nepal   ', '(Admin)', 'gdpr-framework'),
            'NC' => _x('New Caledonia   ', '(Admin)', 'gdpr-framework'),
            'NZ' => _x('New Zealand ', '(Admin)', 'gdpr-framework'),
            'NI' => _x('Nicaragua   ', '(Admin)', 'gdpr-framework'),
            'NE' => _x('Niger   ', '(Admin)', 'gdpr-framework'),
            'NG' => _x('Nigeria ', '(Admin)', 'gdpr-framework'),
            'NU' => _x('Niue    ', '(Admin)', 'gdpr-framework'),
            'NF' => _x('Norfolk Island  ', '(Admin)', 'gdpr-framework'),
            'MP' => _x('Northern Mariana Islands    ', '(Admin)', 'gdpr-framework'),
            'OM' => _x('Oman    ', '(Admin)', 'gdpr-framework'),
            'PK' => _x('Pakistan    ', '(Admin)', 'gdpr-framework'),
            'PW' => _x('Palau   ', '(Admin)', 'gdpr-framework'),
            'PS' => _x('Palestine, State of ', '(Admin)', 'gdpr-framework'),
            'PA' => _x('Panama  ', '(Admin)', 'gdpr-framework'),
            'PG' => _x('Papua New Guinea    ', '(Admin)', 'gdpr-framework'),
            'PY' => _x('Paraguay    ', '(Admin)', 'gdpr-framework'),
            'PE' => _x('Peru    ', '(Admin)', 'gdpr-framework'),
            'PH' => _x('Philippines ', '(Admin)', 'gdpr-framework'),
            'PN' => _x('Pitcairn    ', '(Admin)', 'gdpr-framework'),
            'PR' => _x('Puerto Rico ', '(Admin)', 'gdpr-framework'),
            'QA' => _x('Qatar   ', '(Admin)', 'gdpr-framework'),
            'RE' => _x('Réunion ', '(Admin)', 'gdpr-framework'),
            'RU' => _x('Russian Federation  ', '(Admin)', 'gdpr-framework'),
            'RW' => _x('Rwanda  ', '(Admin)', 'gdpr-framework'),
            'BL' => _x('Saint Barthélemy    ', '(Admin)', 'gdpr-framework'),
            'SH' => _x('Saint Helena, Ascension and Tristan da Cunha    ', '(Admin)', 'gdpr-framework'),
            'KN' => _x('Saint Kitts and Nevis   ', '(Admin)', 'gdpr-framework'),
            'LC' => _x('Saint Lucia ', '(Admin)', 'gdpr-framework'),
            'MF' => _x('Saint Martin (French part)  ', '(Admin)', 'gdpr-framework'),
            'PM' => _x('Saint Pierre and Miquelon   ', '(Admin)', 'gdpr-framework'),
            'VC' => _x('Saint Vincent and the Grenadines    ', '(Admin)', 'gdpr-framework'),
            'WS' => _x('Samoa   ', '(Admin)', 'gdpr-framework'),
            'SM' => _x('San Marino  ', '(Admin)', 'gdpr-framework'),
            'ST' => _x('Sao Tome and Principe   ', '(Admin)', 'gdpr-framework'),
            'SA' => _x('Saudi Arabia    ', '(Admin)', 'gdpr-framework'),
            'SN' => _x('Senegal ', '(Admin)', 'gdpr-framework'),
            'RS' => _x('Serbia  ', '(Admin)', 'gdpr-framework'),
            'SC' => _x('Seychelles  ', '(Admin)', 'gdpr-framework'),
            'SL' => _x('Sierra Leone    ', '(Admin)', 'gdpr-framework'),
            'SG' => _x('Singapore   ', '(Admin)', 'gdpr-framework'),
            'SX' => _x('Sint Maarten (Dutch part)   ', '(Admin)', 'gdpr-framework'),
            'SB' => _x('Solomon Islands ', '(Admin)', 'gdpr-framework'),
            'SO' => _x('Somalia ', '(Admin)', 'gdpr-framework'),
            'ZA' => _x('South Africa    ', '(Admin)', 'gdpr-framework'),
            'GS' => _x('South Georgia and the South Sandwich Islands    ', '(Admin)', 'gdpr-framework'),
            'SS' => _x('South Sudan ', '(Admin)', 'gdpr-framework'),
            'LK' => _x('Sri Lanka   ', '(Admin)', 'gdpr-framework'),
            'SD' => _x('Sudan   ', '(Admin)', 'gdpr-framework'),
            'SR' => _x('Suriname    ', '(Admin)', 'gdpr-framework'),
            'SJ' => _x('Svalbard and Jan Mayen  ', '(Admin)', 'gdpr-framework'),
            'SZ' => _x('Swaziland   ', '(Admin)', 'gdpr-framework'),
            'SY' => _x('Syrian Arab Republic    ', '(Admin)', 'gdpr-framework'),
            'TW' => _x('Taiwan   ', '(Admin)', 'gdpr-framework'),
            'TJ' => _x('Tajikistan  ', '(Admin)', 'gdpr-framework'),
            'TZ' => _x('Tanzania, United Republic of    ', '(Admin)', 'gdpr-framework'),
            'TH' => _x('Thailand    ', '(Admin)', 'gdpr-framework'),
            'TL' => _x('Timor-Leste ', '(Admin)', 'gdpr-framework'),
            'TG' => _x('Togo    ', '(Admin)', 'gdpr-framework'),
            'TK' => _x('Tokelau ', '(Admin)', 'gdpr-framework'),
            'TO' => _x('Tonga   ', '(Admin)', 'gdpr-framework'),
            'TT' => _x('Trinidad and Tobago ', '(Admin)', 'gdpr-framework'),
            'TN' => _x('Tunisia ', '(Admin)', 'gdpr-framework'),
            'TR' => _x('Turkey  ', '(Admin)', 'gdpr-framework'),
            'TM' => _x('Turkmenistan    ', '(Admin)', 'gdpr-framework'),
            'TC' => _x('Turks and Caicos Islands    ', '(Admin)', 'gdpr-framework'),
            'TV' => _x('Tuvalu  ', '(Admin)', 'gdpr-framework'),
            'UG' => _x('Uganda  ', '(Admin)', 'gdpr-framework'),
            'UA' => _x('Ukraine ', '(Admin)', 'gdpr-framework'),
            'AE' => _x('United Arab Emirates    ', '(Admin)', 'gdpr-framework'),
            'UM' => _x('United States Minor Outlying Islands    ', '(Admin)', 'gdpr-framework'),
            'UY' => _x('Uruguay ', '(Admin)', 'gdpr-framework'),
            'UZ' => _x('Uzbekistan  ', '(Admin)', 'gdpr-framework'),
            'VU' => _x('Vanuatu ', '(Admin)', 'gdpr-framework'),
            'VE' => _x('Venezuela, Bolivarian Republic of   ', '(Admin)', 'gdpr-framework'),
            'VN' => _x('Viet Nam    ', '(Admin)', 'gdpr-framework'),
            'VG' => _x('Virgin Islands, British ', '(Admin)', 'gdpr-framework'),
            'VI' => _x('Virgin Islands, U.S.    ', '(Admin)', 'gdpr-framework'),
            'WF' => _x('Wallis and Futuna   ', '(Admin)', 'gdpr-framework'),
            'EH' => _x('Western Sahara  ', '(Admin)', 'gdpr-framework'),
            'YE' => _x('Yemen   ', '(Admin)', 'gdpr-framework'),
            'ZM' => _x('Zambia  ', '(Admin)', 'gdpr-framework'),
            'ZW' => _x('Zimbabwe    ', '(Admin)', 'gdpr-framework'),
        ];
    }

    /**
     * Get a list of <option> values for the country selector
     *
     * @param null $current
     *
     * @return mixed
     */
    public function getCountrySelectOptions($current = null)
    {
        $eu      = $this->getEUCountryList();
        $outside = [
            "IS"    => _x('Iceland', '(Admin)', 'gdpr-framework'),
            "NO"    => _x('Norway', '(Admin)', 'gdpr-framework'),
            "LI"    => _x('Liechtenstein', '(Admin)', 'gdpr-framework'),
            "CH"    => _x('Switzerland', '(Admin)', 'gdpr-framework'),
            "US"    => _x('United States', '(Admin)', 'gdpr-framework'),
            // "other" => _x('Rest of the world', '(Admin)', 'gdpr-framework'),
        ];

        return gdpr('view')->render('global/country-options', compact('eu', 'outside', 'current'));
    }

    /**
     * Check if a controller from the given country needs a representative in the EU
     *
     * @param $code
     * @return bool
     */
    public function countryNeedsRepresentative($code)
    {
        return in_array($code, ['US', 'other']);
    }

    /**
     * Get the data protection authority information for a given country
     *
     * @param null $countryCode
     * @return array
     */
    public function getDataProtectionAuthorityInfo($countryCode = null)
    {
        if (!$countryCode) {
            $countryCode = gdpr('options')->get('company_location');
        }

        $dpaData = require(gdpr('config')->get('plugin.path') . 'assets/data-protection-authorities.php');

        if (isset($dpaData[$countryCode])) {
            return $dpaData[$countryCode];
        }

        return [];
    }

    /**
     * Get the info regarding all DPAs
     */
    public function getDataProtectionAuthorities()
    {
        return require(gdpr('config')->get('plugin.path') . 'assets/data-protection-authorities.php');
    }

    public function getAdminUrl($suffix = '')
    {
        return admin_url('tools.php?page=privacy' . $suffix);
    }

    public function getDashboardDataPageUrl($suffix = '')
    {
        return admin_url('users.php?page=gdpr-profile' . $suffix);
    }

    public function getPrivacyToolsPageUrl()
    {
        if(gdpr('options')->get('custom_tools_page')){
			$privacyToolsUrl = gdpr('options')->get('custom_tools_page');
			return $privacyToolsUrl;			
		}else{
			$toolsPageId = gdpr('options')->get('tools_page');
        	return $toolsPageId ? get_permalink($toolsPageId) : '';
		}		
		
    }

    public function getPrivacyPolicyPageUrl()
    {
        $policyPageId = gdpr('options')->get('policy_page');
        $policyPageurl = get_permalink($policyPageId);
        add_filter( 'gdpr_custom_policy_link', 'gdprfPrivacyPolicyurl' );
        $policyPageurl = apply_filters( 'gdpr_custom_policy_link',$policyPageurl);
        return $policyPageurl ? $policyPageurl : '';
    }

    public function error()
    {
        wp_die(
            __('An error has occurred. Please contact the site administrator.', 'gdpr-framework')
        );
    }

    public function docs($url = '')
    {
        return 'https://www.data443.com/' . $url;
    }

    /**
     * Wrapper around wp_mail() to filter the headers
     * Example code for changing the sender email:
     *
     *  add_filter('gdpr/mail/headers', function($headers) {
     *       $headers[] = 'From: Firstname Lastname <test@example.com>';
     *      return $headers;
     *  });
     *
     *
     */
    public function mail($to, $subject, $message, $headers = '', $attachments = [])
    {   
        $gdpr_name_from = get_option( 'gdpr_name_from' );
        $gdpr_email_from = get_option( 'gdpr_email_from' );
        if($gdpr_name_from == ""){
            $gdpr_name_from = "Data443 GDPR";
        }
        if($gdpr_email_from == ""){
            $gdpr_email_from = get_option('admin_email');
        }
        $headers = apply_filters('gdpr/mail/headers', $headers);
        $headers[] = 'From: '.$gdpr_name_from.' <'.$gdpr_email_from.'>';
        
        wp_mail($to, $subject, $message, $headers, $attachments);
    }
}
