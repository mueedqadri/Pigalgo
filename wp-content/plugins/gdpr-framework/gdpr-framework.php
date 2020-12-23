<?php

/**
 * Plugin Name:       The GDPR Framework
 * Plugin URI:        https://www.data443.com/gdpr-framework/
 * Description:       Tools to help make your website GDPR-compliant. Fully documented, extendable and developer-friendly.
 * Version:           1.0.40
 * Author:            Data443
 * Author URI:        https://www.data443.com/
 * Text Domain:       gdpr-framework
 * Domain Path:       /languages
 *
 * @package WordPress
 */

if (!defined('WPINC')) 
{ 
    die;
}

define('GDPR_FRAMEWORK_VERSION', '1.0.40');

add_shortcode( 'gdpr_privacy_safe', 'render_privacy_safe' );

/**
 * Render WHMCS Seal Generator Addon Javascript
 */
function render_privacy_safe() {
	wp_register_script( 'gdpr_whmcs_seal_generator', gdpr( 'config' )->get( 'plugin.url' ) . 'assets/js/showseal.js', null, true, true );
	wp_localize_script(
		'gdpr_whmcs_seal_generator',
		'gdpr_seal_var',
		array(
			'gdpr_imageparams'   => esc_attr( get_option( 'gdpr_privacy_safe_params' ) ),
			'gdpr_imagecode'     => esc_attr( get_option( 'gdpr_privacy_safe_imagecode' ) ),
			'gdpr_showimagefunc' => 'showimage_' . esc_attr( get_option( 'gdpr_privacy_safe_imagecode' ) ),
		)
	);
	wp_enqueue_script( 'gdpr_whmcs_seal_generator', basename( dirname( __FILE__ ) ) . 'assets/js/showseal.js', null, true, true );

	if( get_option( 'gdpr_privacy_safe_backlink' ) === '1' ){
		$backlink = '<span style="font-size:12px;">Privacy Management Service by <a href="https://data443.com/products/global-privacy-manager/" target="_blank">Data443</a></span>';
	}else{
		$backlink = '';
	}

	echo '<a href="javascript:;" onclick="openpopup_' . esc_attr( get_option( 'gdpr_privacy_safe_imagecode' ) ) . '();">
	<img src="https://orders.data443.com/seal/seal.php?params=' . esc_attr( get_option( 'gdpr_privacy_safe_params' ) ) . '"/>
	</a><br/>' . $backlink;
}

add_action( 'plugins_loaded', 'gdpr_framework_load_textdomain' );
function gdpr_framework_load_textdomain() 
{
  load_plugin_textdomain( 'gdpr-framework', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
/**
 * Our custom post type function
 */
function create_custom_post_type() {
	$args = array(
		'label'               => 'Do Not Sell Info',
		'public'              => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'donotsellrequests' ),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'excerpt', 'custom-fields', 'post-formats' ),
	);
	register_post_type( 'donotsellrequests', $args );
}
/**
 * Hooking up our function to theme setup
 */
add_action( 'init', 'create_custom_post_type' );

/**
 * Helper function for prettying up errors
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$gdpr_error = function($message, $subtitle = '', $title = '') 
{
    $title = $title ?: _x('WordPress GDPR &rsaquo; Error', '(Admin)', 'gdpr-framework');
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare(phpversion(), '5.6.0', '<')) 
{
    $gdpr_error(
        _x('You must be using PHP 5.6.0 or greater.', '(Admin)', 'gdpr-framework'),
        _x('Invalid PHP version', '(Admin)', 'gdpr-framework')
    );
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare(get_bloginfo('version'), '4.3', '<')) 
{
    $gdpr_error(
        _x('You must be using WordPress 4.3.0 or greater.', '(Admin)', 'gdpr-framework'),
        _x('Invalid WordPress version', '(Admin)', 'gdpr-framework')
    );
}

 /**
  * Fix issue with redeclate function issue on DIVI theme.
  */
function TermAndConditionWithPrivacyContent() 
{
    return 'I accept the %sTerms and Conditions%s and the %sPrivacy Policy%s';
}

function gdprfPrivacyPolicy() 
{
    return 'I accept the %sPrivacy Policy%s';
}

function gdprfPrivacyPolicyurl($policypage) 
{
    $policypageURL = get_option( 'gdpr_custom_policy_page' );
    if($policypageURL=="")
    {
        return $policypage;
    }else{
        return $policypageURL;
    }
}

function gdpr_privacy_accpetance($gdpr_error_massage)
{
    return $gdpr_error_massage;
}

/**
 * Save user logs
 */
add_action( 'profile_update', 'my_profile_update', 10, 2 );

function my_profile_update( $user_id, $old_user_data ) 
{
    $data = (array) $old_user_data->data;
   
    $all_meta_for_user = get_user_meta( $user_id );
    if($all_meta_for_user['nickname']['0']){
        $data['nickname'] = $all_meta_for_user['nickname']['0'];
    }
    if($all_meta_for_user['first_name']['0']){
        $data['first_name'] = $all_meta_for_user['first_name']['0'];
    }
    if($all_meta_for_user['last_name']['0']){
        $data['last_name'] = $all_meta_for_user['last_name']['0'];
    }
    if($all_meta_for_user['description']['0']){
        $data['description'] = $all_meta_for_user['description']['0'];
    }
    $userdata = serialize($data);
    $model = new \Codelight\GDPR\Components\Consent\UserConsentModel();
    $model->savelog($user_id,$userdata);
}

require_once('gdpr-helper-functions.php');
require_once('bootstrap.php');
