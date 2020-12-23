<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://iamankitp.com/
 * @since      1.7.0
 *
 * @package    hab_Hide_Admin_Bar_Based_On_User_Roles
 * @subpackage hab_Hide_Admin_Bar_Based_On_User_Roles/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    hab_Hide_Admin_Bar_Based_On_User_Roles
 * @subpackage hab_Hide_Admin_Bar_Based_On_User_Roles/admin
 * @author     Ankit Panchal <ankitmaru@live.in>
 */
class hab_Hide_Admin_Bar_Based_On_User_Roles_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.7.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.7.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in hab_Hide_Admin_Bar_Based_On_User_Roles_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The hab_Hide_Admin_Bar_Based_On_User_Roles_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if( isset($_GET['page']) && $_GET['page'] == 'hide-admin-bar-settings' ) { 
			wp_enqueue_style( "hab_materials_icons", plugin_dir_url( __FILE__ ) . 'css/materialdesignicons.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( "hab_icheck", plugin_dir_url( __FILE__ ) . 'css/all.css', array(), $this->version, 'all' );
			wp_enqueue_style( "hab_tags_input", plugin_dir_url( __FILE__ ) . 'css/jquery.tagsinput.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( "hab_style", plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );
			wp_enqueue_style( "hab_style_1", plugin_dir_url( __FILE__ ) . 'css/style_1.css', array(), $this->version, 'all' );
			
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hide-admin-bar-based-on-user-roles-admin.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.7.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in hab_Hide_Admin_Bar_Based_On_User_Roles_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The hab_Hide_Admin_Bar_Based_On_User_Roles_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if( isset($_GET['page']) && $_GET['page'] == 'hide-admin-bar-settings' ) { 

			wp_enqueue_script( "hab_base_js", plugin_dir_url( __FILE__ ) . 'js/vendor.bundle.base.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( "hab_icheck_min", plugin_dir_url( __FILE__ ) . 'js/icheck.min.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( "hab_tags_input", plugin_dir_url( __FILE__ ) . 'js/jquery.tagsinput.min.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( "hab_icheck", plugin_dir_url( __FILE__ ) . 'js/iCheck.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hide-admin-bar-based-on-user-roles-admin.js', array( 'jquery' ), $this->version, false );

			wp_localize_script( $this->plugin_name, 'ajaxVar', array( 'url' => admin_url( 'admin-ajax.php' ) ) );	
		}


	}


	public function generate_admin_menu_page() {

		add_options_page(__('Hide Admin Bar Settings','hide-admin-bar-based-on-user-roles'), __('Hide Admin Bar Settings','hide-admin-bar-based-on-user-roles'), 'manage_options', 'hide-admin-bar-settings', array($this,'hide_admin_bar_settings') );

	}

	public function hide_admin_bar_settings() {

		$settings = get_option("hab_settings");
		$hab_reset_key = get_option("hab_reset_key");

		if( !empty($hab_reset_key) && isset($_GET["reset_plugin"]) && $_GET["reset_plugin"] == $hab_reset_key ){
			update_option("hab_settings","");
			update_option("hab_reset_key", rand(0,999999999) );
			echo '<script>window.location.reload();</script>';
		}

		?>
		<div class="main-panel">
        <div class="container-wrapper">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3><?php echo __('Hide Admin Bar Based on User Roles','hide-admin-bar-based-on-user-roles');?></h3><br />
                        <form class="form-sample">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label"><?php echo __('Hide Admin Bar for All Users','hide-admin-bar-based-on-user-roles');?></label>
                                        <div class="col-sm-6">
                                        	<?php 
												$disableForAll = ( isset($settings["hab_disableforall"]) ) ? $settings["hab_disableforall"] : "";
												$checked = ( $disableForAll == 'yes' ) ? "checked" : "";
												echo '<div class="icheck-square">
		                                                <input tabindex="5" '.$checked.' type="checkbox" id="hide_for_all">
		                                            </div>';
											?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if( $disableForAll == "no" || empty($disableForAll) ) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label"><?php echo __('Hide Admin Bar for All Guests Users','hide-admin-bar-based-on-user-roles');?></label>
                                        <div class="col-sm-6">
                                        	<?php 
												$disableForAllGuests = ( isset($settings["hab_disableforallGuests"]) ) ? $settings["hab_disableforallGuests"] : "";
												$checkedGuests = ( $disableForAllGuests == 'yes' ) ? "checked" : "";
												echo '<div class="icheck-square">
		                                                <input tabindex="5" '.$checkedGuests.' type="checkbox" id="hide_for_all_guests">
		                                            </div>';
											?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label"><?php echo __('User Roles','hide-admin-bar-based-on-user-roles');?><br /><br /><?php echo __('Hide admin bar for selected user roles.','hide-admin-bar-based-on-user-roles');?></label>
                                        <div class="col-sm-6">
                                        	<?php 
												global $wp_roles;
												$exRoles = ( isset($settings["hab_userRoles"]) ) ? $settings["hab_userRoles"] : "";
												$checked = '';

												$roles = $wp_roles->get_names();
												if( is_array( $roles ) ) {
													foreach( $roles as $key => $value ):
														if( is_array($exRoles) )
															$checked = ( in_array($key, $exRoles) ) ? "checked" : "";

														echo '<div class="icheck-square">
			                                                <input name="userRoles[]" '.$checked.' tabindex="5" type="checkbox" value="'.$key.'">&nbsp;&nbsp;'.$value.'
			                                            </div>';
													endforeach;
												}
											?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label"><?php echo __('Capabilities Blacklist','hide-admin-bar-based-on-user-roles');
                                        	echo '<br />';
                                        	echo __('Hide admin bar for selected user capabilities','hide-admin-bar-based-on-user-roles');?></label>
                                        <div class="col-sm-6">
                                        	<?php 
												$caps = (isset($settings["hab_capabilities"])) ? $settings["hab_capabilities"] : "";
											?>
                                            <div class="icheck-square">
                                                <textarea name="had_capabilities" id="had_capabilities"><?php echo $caps;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        	<?php } ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-fw" id="submit_roles"><?php echo __("Save Changes",'hide-admin-bar-based-on-user-roles');?></button>
                                </div>
                                <div class="col-md-12">
                                	<br />
                                	<p><?php echo __("You can reset plugin settings by visiting this url without login to admin panel. Keep it safe.",'hide-admin-bar-based-on-user-roles'); ?><br /><a href="<?php echo admin_url()."options-general.php?page=hide-admin-bar-settings&reset_plugin=".$hab_reset_key;?>" target="_blank"><?php echo admin_url()."options-general.php?page=hide-admin-bar-settings&reset_plugin=".$hab_reset_key;?></a></p>
                                </div>
                            </div>
                        </form>
                        <script>
                        	if (jQuery('#had_capabilities').length) {
						        jQuery('#had_capabilities').tagsInput({
						            'width': '100%',
						            'height': '75%',
						            'interactive': true,
						            'defaultText': 'Add More',
						            'removeWithBackspace': true,
						            'minChars': 0,
						            'maxChars': 20, // if not provided there is no limit
						            'placeholderColor': '#666666'
						        });
						    }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-wrapper">
            <div class="col-12 grid-margin">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 stretch-card">
                        <div class="card card-statistics social-card card-default">
                            <div class="card-header header-sm">
                                <div class="d-flex align-items-center">
                                <div class="wrapper d-flex align-items-center media-info text-wordpress">
                                    <i class="mdi mdi-wordpress icon-md"></i>
                                    <h2 class="card-title ml-3"><?php echo __("Download My New Plugin",'hide-admin-bar-based-on-user-roles');?></h5>
                                </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <img class="d-block img-sm rounded-circle mx-auto mb-2" src="https://ps.w.org/advanced-page-visit-counter/assets/icon-128x128.png" alt="profile image">
                                <p class="text-center user-name"><?php echo __("Advanced Page Visit Counter",'hide-admin-bar-based-on-user-roles');?></p>
                                <p class="text-center mb-2 comment">
                                	<strong><?php echo __("41000+ Downloads..",'hide-admin-bar-based-on-user-roles');?></strong><Br />
                                	<?php echo __("This plugin will count the total visits of your website or ecommerce store.",'hide-admin-bar-based-on-user-roles');?></p>
                                <a href="https://wordpress.org/plugins/advanced-page-visit-counter/" target="_blank" class="text-center btn btn-info btn-rounded btn-fw"><?php echo __("Download Now",'hide-admin-bar-based-on-user-roles');?></a></small>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 stretch-card">
                            <div class="card card-statistics social-card card-default">
                            <div class="card-header header-sm">
                                <div class="d-flex align-items-center">
                                <div class="wrapper d-flex align-items-center media-info text-twitter">
                                    <i class="mdi mdi-twitter icon-md"></i>
                                    <h2 class="card-title ml-3"><?php echo __("Follow me on Twitter",'hide-admin-bar-based-on-user-roles');?></h2>
                                </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <img class="d-block img-sm rounded-circle mx-auto mb-2" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/author.png';?>" alt="profile image">
                                <p class="text-center user-name"><?php echo __("Ankit Panchal",'hide-admin-bar-based-on-user-roles'); ?></p>
                                <p class="text-center mb-2 comment"><?php echo __("I am WordPress Fan, Developer and Contributor. <br />WordPress Plugin Author, WordPress Contributor - TemplateMonster Certified Developer",'hide-admin-bar-based-on-user-roles');?></p>
                                <a href="https://twitter.com/wplegend_ankitp" target="_blank" class="text-center btn btn-info btn-rounded btn-fw"><?php echo __("View Profile",'hide-admin-bar-based-on-user-roles');?></a></small>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 stretch-card">
                            <div class="card card-statistics social-card card-default">
                            <div class="card-header header-sm">
                                <div class="d-flex align-items-center">
                                <div class="wrapper d-flex align-items-center media-info text-wordpress">
                                    <i class="mdi mdi-wordpress icon-md"></i>
                                    <h2 class="card-title ml-3"><?php echo __("Follow Me On WordPress",'hide-admin-bar-based-on-user-roles');?></h5>
                                </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <img class="d-block img-sm rounded-circle mx-auto mb-2" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/author.png';?>" alt="profile image">
                                <p class="text-center user-name"><?php echo __("Ankit Panchal",'hide-admin-bar-based-on-user-roles');?></p>
                                <p class="text-center mb-2 comment"><?php echo __("I am WordPress Fan, Developer and Contributor. <br />WordPress Plugin Author, WordPress Contributor - TemplateMonster Certified Developer</p>",'hide-admin-bar-based-on-user-roles');?>
                                <a href="https://profiles.wordpress.org/ankitmaru/" target="_blank" class="text-center btn btn-info btn-rounded btn-fw"><?php echo __("View Profile",'hide-admin-bar-based-on-user-roles');?></a></small>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>

		
		<?php
	}

	public function save_user_roles(){
		global $wpdb;

		$UserRoles = $_REQUEST['UserRoles'];
		$caps = sanitize_text_field(str_replace("&nbsp;","",$_REQUEST['caps']));
		$disableForAll = $_REQUEST['disableForAll'];
		$auto_hide_time = $_REQUEST['auto_hide_time']; 		
		$autoHideFlag = $_REQUEST['autoHideFlag']; 		
		$forGuests = $_REQUEST['forGuests']; 		
		
		$settings = array();
		$settings['hab_disableforall'] = $disableForAll;

		if( $disableForAll == 'no' ){
			$settings['hab_userRoles'] = $UserRoles;
			$settings['hab_capabilities'] = $caps;
			$settings['hab_auto_hide_time'] = $auto_hide_time;
			$settings['hab_auto_hide_flag'] = $autoHideFlag;
			$settings['hab_disableforallGuests'] = $forGuests;
		}
		update_option("hab_settings",$settings);

		wp_die();
	}

	public function upgrader_process_complete(){

		
	}

}
