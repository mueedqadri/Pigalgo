<?php 

add_action( "wp_ajax_add_consent_accept_cookies", "add_consent_accept_cookies" );
add_action( "wp_ajax_nopriv_add_consent_accept_cookies", "add_consent_accept_cookies" );
add_action( "wp_ajax_add_consent_deny_cookies", "add_consent_deny_cookies" );
add_action( "wp_ajax_nopriv_add_consent_deny_cookies", "add_consent_deny_cookies" );



/**
 * ajax function on accept cookie button
 */
function add_consent_accept_cookies(){
	$referer = $_SERVER['HTTP_REFERER'];
	$address = $_SERVER['SERVER_NAME'];
	if($referer){
		if (strpos($address, $referer) !== 0) {
		global $wpdb;
		$tableName = $wpdb->prefix . 'gdpr_consent';
		$current_user = wp_get_current_user();
		$user_email = sanitize_email($current_user->user_email);
		if($user_email=="" && isset($_COOKIE['gdpr_key'])){
			$email = explode("|",$_COOKIE['gdpr_key']);
			$user_email = sanitize_email($email['0']);
		}
		
		$wpdb->insert( $tableName, [
			'email'      => $user_email,
			'version'    => 1,
			'consent'    => 'gdpr_cookie_consent',
			'status'     => 1,
			'updated_at' => current_time( 'mysql' ),
			'ip'         => sanitize_text_field($_POST['userip']),
		] );
		do_action('gdpr_consent_accept_cookies');
		wp_die(); // ajax call must die to avoid trailing 0 in your response
		}else{
			echo "Error !!!";
			wp_die();
		}
	}else{
		echo "ERROR !!";
		wp_die();		
	}
}

/**
 * ajax function on deny cookie button
 */
function add_consent_deny_cookies(){
	$referer = $_SERVER['HTTP_REFERER'];
	$address = $_SERVER['SERVER_NAME'];
	if($referer){
		if (strpos($address, $referer) !== 0) {
			do_action('consent_deny_cookies');
			wp_die();
		}else{
			echo "Error !!!";
			wp_die();
		}
	}else{
		echo "ERROR !!";
		wp_die();		
	}
}

/**
 * Load dependencies
 */
if (!class_exists('\Codelight\GDPR\Container')) 
{
	if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
		$gdpr_error(
			_x(
				'You appear to be running a development version of GDPR. You must run <code>composer install</code> from the plugin directory.',
				'(Admin)',
				'gdpr-framework'
			),
			_x(
				'Autoloader not found.',
				'(Admin)',
				'gdpr-framework'
			)
		);
	}
	require_once $composer;
}
/**
 * Install the database table and custom role
 */
register_activation_hook(__FILE__, function () {
	$model = new \Codelight\GDPR\Components\Consent\UserConsentModel();
	$model->createTable();
	$model->createUserTable();
	if (apply_filters('gdpr/data-subject/anonymize/change_role', true) && ! get_role('anonymous')) {

		add_role(
			'anonymous',
			_x('Anonymous', '(Admin)', 'gdpr-framework'),
			array()
		);
	}

	update_option('gdpr_enable_stylesheet', true);
	update_option('gdpr_enable', true);
});

function popup_gdpr(){

	wp_enqueue_script( 'gdpr-framework-cookieconsent-min-js', gdpr('config')->get('plugin.url') .'assets/cookieconsent.min.js' );
	
	wp_enqueue_style( 'gdpr-framework-cookieconsent-css',gdpr('config')->get('plugin.url') .'assets/cookieconsent.min.css');

	wp_register_script( 'gdpr-framework-cookieconsent-js', gdpr('config')->get('plugin.url') . 'assets/ajax-cookieconsent.js', array(), false, true );

	$gdpr_policy_page_id = get_option('gdpr_policy_page');
	if($gdpr_policy_page_id)
	{   
		$gdpr_policy_page_url = get_permalink($gdpr_policy_page_id);
		/* 
		* FIX FOR MULTILANG.
		*/
		if($gdpr_policy_page_url == ""){
			if(isset($gdpr_policy_page_id[substr( get_bloginfo ( 'language' ), 0, 2 )])){
				$gdpr_policy_page_url = get_permalink($gdpr_policy_page_id[substr( get_bloginfo ( 'language' ), 0, 2 )]);
			}
		}
	}else{
		$gdpr_policy_page_url="";
	}
	add_filter( 'gdpr_custom_policy_link', 'gdprfPrivacyPolicyurl' );
	
	$gdpr_policy_page_url = apply_filters( 'gdpr_custom_policy_link',$gdpr_policy_page_url);

	$gdpr_cookie_acceptance_content_url = get_option( 'gdpr_popup_content' );

	$gdpr_cookie_acceptance_content_url = do_shortcode( $gdpr_cookie_acceptance_content_url );

	if($gdpr_cookie_acceptance_content_url != ""){ 

		$gdpr_message= __($gdpr_cookie_acceptance_content_url, 'gdpr-framework');

	}else{

		$gdpr_message= __('This website uses cookies to ensure you get the best experience on our website.', 'gdpr-framework');
	}
	
	$gdpr_cookie_dismiss_text_url = get_option( 'gdpr_popup_dismiss_text' );

	$gdpr_cookie_dismiss_text_url = do_shortcode( $gdpr_cookie_dismiss_text_url );

	if($gdpr_cookie_dismiss_text_url != ""){ 

		$gdpr_dismiss= __($gdpr_cookie_dismiss_text_url, 'gdpr-framework');

	}else{

		$gdpr_dismiss = __('Decline', 'gdpr-framework');
	}

	$gdpr_cookie_allow_text_url = get_option( 'gdpr_popup_allow_text' );

	$gdpr_cookie_allow_text_url = do_shortcode( $gdpr_cookie_allow_text_url );

	if($gdpr_cookie_dismiss_text_url != ""){ 

		 $gdpr_allow = __($gdpr_cookie_allow_text_url, 'gdpr-framework');

	}else{

		 $gdpr_allow = __('Accept', 'gdpr-framework');
	}

	$gdpr_cookie_learnmore_text_url = get_option( 'gdpr_popup_learnmore_text' );

	$gdpr_cookie_learnmore_text_url = do_shortcode( $gdpr_cookie_learnmore_text_url );

	if($gdpr_cookie_learnmore_text_url != ""){ 

		$gdpr_link= __($gdpr_cookie_learnmore_text_url, 'gdpr-framework');

	}else{

		$gdpr_link = __('Learn more', 'gdpr-framework');
	}

	$position = get_option( 'gdpr_popup_position' ); #"bottom-left","top","bottom-right",""

	$static = false; # true

	$gdpr_header = get_option( 'gdpr_header' );
	
	$gdpr_header = do_shortcode($gdpr_header);

	if($gdpr_header != ""){ 
		$gdpr_header= __($gdpr_header, 'gdpr-framework');
	}

	$gdpr_popup_background=get_option( 'gdpr_popup_background' );

	$gdpr_popup_text=get_option( 'gdpr_popup_text' );

	$gdpr_button_background=get_option( 'gdpr_popup_button_background' );

	$gdpr_button_text=get_option( 'gdpr_popup_button_text' );

	$gdpr_link_target=get_option( 'gdpr_popup_link_target' );

	if(!$gdpr_link_target){
		$gdpr_link_target="_blank";
	}
	
	$gdpr_button_border=get_option( 'gdpr_popup_border_text' );

	if(!$gdpr_popup_background){
		$gdpr_popup_background = "#efefef";
	}
	if(!$gdpr_popup_text){
		$gdpr_popup_text = "#404040";
	}
	if(!$gdpr_button_background){
		$gdpr_button_background = "transparent";
	}
	if(!$gdpr_button_text){
		$gdpr_button_text = "#8ec760";
	}
	if(!$gdpr_button_border){
		$gdpr_button_border = "#8ec760";
	}

	$gdpr_popup_theme = get_option( 'gdpr_popup_theme' );

	$gdpr_policy_popup = get_option( 'gdpr_policy_popup' );
	
	$gdpr_hide = get_option('gdpr_onetime_popup');
	
	$type = "opt-out"; #opt-in,opt-out,""
	
	$policy_text = __('Cookie Policy', 'gdpr-framework');

	$get_gdpr_data = array('gdpr_url'=>$gdpr_policy_page_url,'gdpr_message'=>$gdpr_message,'gdpr_dismiss'=>$gdpr_dismiss,'gdpr_allow'=>$gdpr_allow,'gdpr_header'=>$gdpr_header,'gdpr_link'=>$gdpr_link,'gdpr_popup_position'=>$position,'gdpr_popup_type'=>$type,'gdpr_popup_static'=>$static,'gdpr_popup_background'=>$gdpr_popup_background,'gdpr_popup_text'=>$gdpr_popup_text,'gdpr_button_background'=>$gdpr_button_background,'gdpr_button_text'=>$gdpr_button_text,'gdpr_button_border'=>$gdpr_button_border,'gdpr_popup_theme'=>$gdpr_popup_theme,'gdpr_hide'=>$gdpr_hide,'gdpr_popup'=>$gdpr_policy_popup,'policy'=>$policy_text,'ajaxurl' => admin_url( 'admin-ajax.php' ),'gdpr_link_target' => $gdpr_link_target);
	
	wp_localize_script( 'gdpr-framework-cookieconsent-js', 'gdpr_policy_page', $get_gdpr_data );
	wp_enqueue_script( 'gdpr-framework-cookieconsent-js', gdpr('config')->get('plugin.url') . 'assets/ajax-cookieconsent.js');
	
}
/**
 * Cookie acceptance Popup
 */
$enabled_gdpf_cookie_popup = get_option('gdpr_enable_popup');
if($enabled_gdpf_cookie_popup)
{
	add_action( 'wp_enqueue_scripts', 'frontend_enqueue' );
	function frontend_enqueue()
	{   
		wp_enqueue_script('jquery');
		if(get_option('gdpr_onetime_popup') == "1" ){
			if(!isset($_COOKIE['cookieconsent_status'])){ 
				popup_gdpr();
			}
		}else{
			popup_gdpr();        
		}
		if(gdpr('options')->get('classidocs_integration')){
			//wp_enqueue_script( 'gdprdataTables-js', gdpr('config')->get('plugin.url') .'assets/jquery.dataTables.min.js' );
			wp_enqueue_script( 'lgpddataTables-js', '//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js' );
			wp_enqueue_script( 'lgpddataTables-js-init', gdpr( 'config' )->get( 'plugin.url' ) . 'assets/js/initdatatable.js', true );
			//wp_enqueue_style( 'datatables-css',gdpr('config')->get('plugin.url') .'assets/jquery.dataTables.min.css');
			wp_enqueue_style( 'datatables-css', '//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css' );
		}
	}
}

?>