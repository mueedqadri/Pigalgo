<?php
/**
 * Plugin Name: Paid Memberships Pro - Roles Add On
 * Description: Adds a WordPress Role for each Membership Level.
 * Plugin URI: https://www.paidmembershipspro.com/add-ons/pmpro-roles/
 * Author: Paid Memberships Pro
 * Author URI: https://www.paidmembershipspro.com
 * Version: 1.3.2
 * License: GPL2
 * Text Domain: pmpro-roles
 * Domain Path: /languages
 */

class PMPRO_Roles {

	static $role_key = 'pmpro_role_';
	static $plugin_slug = 'pmpro-roles';
	static $plugin_prefix = 'pmpro_roles_';
	static $ajaction = 'pmpro_roles_repair';
	
	function __construct(){
		add_action( 'pmpro_save_membership_level', array( $this, 'edit_level' ) );
		add_action( 'pmpro_delete_membership_level', array( $this, 'delete_level' ) );
		add_action( 'pmpro_after_change_membership_level', array($this, 'user_change_level' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_scripts' ) );
		add_action( 'wp_ajax_' . PMPRO_Roles::$ajaction, array( $this, 'install' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( 'PMPRO_Roles', 'add_action_links' ) );
		add_filter( 'plugin_row_meta', array( 'PMPRO_Roles', 'plugin_row_meta' ), 10, 2 );
		add_action( 'admin_init', array( 'PMPRO_Roles', 'delete_and_deactivate' ) );
		add_action( 'pmpro_membership_level_after_other_settings', array( 'PMPRO_Roles', 'level_settings' ) );
		add_filter( 'editable_roles', array( 'PMPRO_Roles', 'remove_list_roles' ), 10, 1 );
		add_action( 'init', array( $this, 'load_text_domain' ) );
	}

	/** 
	 * Load plugin text domain for translations.
	 * @since 1.3
	 */
	function load_text_domain() {
		load_plugin_textdomain( 'pmpro-roles', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
	}
	
	/**
	 * Javascript for admin area.
	 */
	function enqueue_admin_scripts($hook) {
		if( 'toplevel_page_pmpro-membershiplevels' != $hook ) {
			return;
		}

		wp_enqueue_script( PMPRO_Roles::$plugin_prefix.'admin', plugin_dir_url( __FILE__ ) . '/admin.js' );
		wp_enqueue_style( PMPRO_Roles::$plugin_prefix.'admin', plugin_dir_url( __FILE__ ) . '/admin.css' );
		$nonce = wp_create_nonce( PMPRO_Roles::$ajaction );
		$vars = array(
			'desc' => esc_html__('Levels not matching up, or missing?', PMPRO_Roles::$plugin_slug ),
			'repair' => esc_html__('Repair', PMPRO_Roles::$plugin_slug ),
			'working' => esc_html__('Working...', PMPRO_Roles::$plugin_slug ),
			'done' => esc_html__('Done!', PMPRO_Roles::$plugin_slug ),
			'fixed' => esc_html__( 'role connections were needed/repaired.', PMPRO_Roles::$plugin_slug ),
			'failed' => esc_html__( 'An error occurred while repairing roles.', PMPRO_Roles::$plugin_slug ),
			'ajaction' => PMPRO_Roles::$ajaction,
			'nonce' => $nonce,
			);
		$key = PMPRO_Roles::$plugin_prefix.'vars';
		wp_localize_script( PMPRO_Roles::$plugin_prefix . 'admin', 'key', array( 'key'=>$key ) );
		wp_localize_script( PMPRO_Roles::$plugin_prefix . 'admin', $key, $vars );
	}
	
	/**
	 * Settings for the edit level admin screen. Creates and saves role selection per level.
	 * @since 1.3
	 */
	function edit_level( $saveid ) {
		//by being here, we know we already have the $_REQUEST we need, so no need to check.
		$capabilities = PMPRO_Roles::capabilities( PMPRO_Roles::$role_key.$saveid );

		if( !empty( $_REQUEST['pmpro_roles_level'] ) ){

			$level_roles = $_REQUEST['pmpro_roles_level'];

			//created a new level
			if( $_REQUEST['edit'] < 0 ) {
				foreach( $level_roles as $role_key => $role_name ){
					if( $role_key === 'pmpro_draft_role' ){						
						add_role( PMPRO_Roles::$role_key.$saveid, sanitize_text_field( $_REQUEST['name'] ), array( 'read' => true ) );	
					}
					if ( $role_key === 'pmpro_role_'. $saveid ) {
						$capabilities = PMPRO_Roles::capabilities( $role_key );
						add_role( $role_key, $role_name, $capabilities );	
					}
				}
			} else {

				global $wpdb;
				//have to get all roles and find ours because get_role() doesn't yield the role's "pretty" name, only its index.
				$roles = get_option( $wpdb->get_blog_prefix() . 'user_roles' );

				if(!is_array( $roles ) ) return;

				foreach( $level_roles as $role_key => $role_name ){					
					
					if( !isset( $roles[$role_key] ) ){
						$capabilities = PMPRO_Roles::capabilities( $role_key );						
						add_role( $role_key, sanitize_text_field( $_REQUEST['name'] ), $capabilities[$role_key] );
						return;
					}

					if( ( strpos( $role_key, PMPRO_Roles::$role_key ) !== FALSE ) && sanitize_text_field( $_REQUEST['name'] ) !== $role_name ) {	
						PMPRO_Roles::update_role_name( $role_key, sanitize_text_field( $_REQUEST['name'] ) );
					}
					
				}
			}

			if( !empty( $level_roles['pmpro_draft_role'] ) ){
				unset( $level_roles['pmpro_draft_role'] );
				$level_roles[PMPRO_Roles::$role_key.$saveid] = sanitize_text_field( $_REQUEST['name'] );
			}

			update_option( 'pmpro_roles_'.$saveid, $level_roles );

		}
		
	}
	
	/**
	 * Delete custom PMPro role on level delete.
	 * @since 1.0
	 */
	function delete_level( $delete_id ) {
		$role_key = PMPRO_Roles::$role_key . $delete_id;
		if( !empty( $role_key ) ){
			remove_role( $role_key );
		}

		delete_option( 'pmpro_roles_' . $delete_id );

		do_action( 'pmpro_roles_delete_membership_level', $delete_id );	
	}

	/** 
	 * Update a PMPro Roles Name if level name changes.
	 * @since 1.3
	 */
	function update_role_name( $role, $name ){
		if( strpos( $role, PMPRO_Roles::$role_key ) !== FALSE ) {
			$roles_array = get_option( 'wp_user_roles', true );
			if( !empty( $roles_array[$role] ) ){
				$roles_array[$role]['name'] = sanitize_text_field( $name );	
				$updated = update_option( 'wp_user_roles', $roles_array );
			}
		}
	}
	
	/**
	 * Change user role based on level change. (Now supports MMPU)
	 * @since 1.0
	 */
	function user_change_level($level_id, $user_id){

		global $pmpro_checkout_levels;
		//get user object
		$wp_user_object = new WP_User($user_id);
		//ignore admins
		if( in_array( 'administrator', $wp_user_object->roles ) )
			return;

		// Check if user is cancelling.
		if( defined( 'PMPROMMPU_DIR' ) && !empty( $_REQUEST['levelstocancel'] ) ) { //Adds support for MMPU
			$levels_to_cancel = explode( " ", $_REQUEST['levelstocancel'] );
			if( !empty( $levels_to_cancel ) ){
				foreach( $levels_to_cancel as $ltc ){
					$wp_user_object->remove_role( PMPRO_Roles::$role_key.intval( $ltc ) );		
				}
			}
			
		} else if( $level_id == 0 ) {
			$default_role = apply_filters( 'pmpro_roles_downgraded_role', get_option( 'default_role' ) );
			$wp_user_object->set_role( $default_role );
		} else {
			if( !empty( $pmpro_checkout_levels ) ){
				//Adds support for MMPU
				foreach( $pmpro_checkout_levels as $co_level ){
					$roles = get_option( 'pmpro_roles_'.$co_level->id );
					if( is_array( $roles ) && ! empty( $roles ) ){
						foreach( $roles as $role_key => $role_name ){
							$wp_user_object->add_role( $role_key );
						}
					} else {
						$wp_user_object->set_role( PMPRO_Roles::$role_key . $co_level->id );
					}
				}
			} else if( $level_id > 0 ){
				$roles = get_option( 'pmpro_roles_'.intval( $level_id ) );
				if( is_array( $roles ) && ! empty( $roles ) ){
					$count = 1;
					foreach( $roles as $role_key => $role_name ){
						if( $count == 1 ){
							$wp_user_object->set_role( $role_key );
						} else {
							$wp_user_object->add_role( $role_key );
						}
						$count++;							
					}
				} else {
					$wp_user_object->set_role( PMPRO_Roles::$role_key.intval( $level_id ) );
				}
			}
		}
	}

	/**
	 * Show a list of all available roles as a checkbox inside level settings.
	 * @since 1.3
	 */
	public static function level_settings() {
		?>
		<hr />

		<h3><?php esc_html_e( 'Role Settings', 'pmpro-roles' ); ?></h3>
		<p class="description">
			<?php
				$allowed_pmpro_roles_description_html = array (
					'a' => array (
						'href' => array(),
						'target' => array(),
						'title' => array(),
					),
				);
				echo sprintf( wp_kses( __( 'Choose one or more roles to be assigned for members of this level. <a href="%s" title="Paid Memberships Pro - Roles Add On" target="_blank">Visit the documentation page</a> for more information.', 'pmpro-roles' ), $allowed_pmpro_roles_description_html ), 'https://www.paidmembershipspro.com/add-ons/pmpro-roles//?utm_source=plugin&utm_medium=pmpro-membershiplevels&utm_campaign=add-ons&utm_content=pmpro-roles' );
			?>
		</p>
		<table class="form-table">
			<tbody>
				<?php
				
				$level_id = absint( filter_input( INPUT_GET, 'edit', FILTER_DEFAULT ) );

				global $wp_roles;

			    $all_roles = $wp_roles->roles;

			    $editable_roles = apply_filters('editable_roles', $all_roles);

			    $saved_roles = get_option( 'pmpro_roles_'.$level_id );			    
			    
			    asort( $editable_roles ); //Display alphabetically

				if( !empty( $editable_roles ) ){
					?>
					<tr>
						<th scope="row" valign="top"><label><?php esc_html_e( 'Roles', 'pmpro-roles' ); ?>:</label></th>
						<td>
							<div class="checkbox_box" <?php if( count( $editable_roles ) > 5 ) { ?>style="height: 150px; overflow: auto; padding: 0px 10px;"<?php } ?>>
								<ul>
								<?php

								//New level, choose if they want to create a role for this level
								if( $_REQUEST['edit'] < 0 ) {
									?>
									<li>
										<input type='checkbox' name='pmpro_roles_level[pmpro_draft_role]' value='pmpro_draft_role' id='pmpro_draft_role' /> <label for='pmpro_draft_role'><?php _e('Create a new custom role for this membership level', 'pmpro-roles'); ?>
										</label>
									</li>
									<hr/>
									<?php
								}

								$custom_pmpro_role = PMPRO_Roles::$role_key.$level_id;

								$checked = '';

								if( isset( $saved_roles[$custom_pmpro_role] ) ){
									$checked = 'checked=true';
								}

								if( isset( $editable_roles[$custom_pmpro_role] ) ){
									?>
									<li>
										<input type='checkbox' name='pmpro_roles_level[<?php echo esc_attr( $custom_pmpro_role ); ?>]' value='<?php echo stripslashes( $editable_roles[$custom_pmpro_role]["name"] ); ?>' id='<?php echo esc_attr( $custom_pmpro_role ); ?>' <?php echo esc_attr( $checked ); ?> /> <label for='<?php echo esc_attr( $custom_pmpro_role ); ?>'><?php echo stripslashes( $editable_roles[$custom_pmpro_role]['name'] ); ?>
										<?php printf( "<code>" . esc_html( 'pmpro_role_%s', 'pmpro-roles' ) . "</code>", $level_id ); ?>
										</label>
									</li>
									<hr/>
									<?php
								}

								$exclude_other_pmpro_roles = apply_filters( 'pmpro_roles_exclude_other_pmpro_roles', true, $level_id );

								foreach( $editable_roles as $key => $role ){
									$checked = '';
									//Backwards compat here, if $saved_roles is empty, set the default level's role as checked
									if( empty( $saved_roles ) ){
										if( PMPRO_Roles::$role_key.$level_id == $key ){
											$checked = 'checked=true';
										}
									}

									if( isset( $saved_roles[$key] ) ){ 
										$checked = 'checked=true';
									}


									if( $exclude_other_pmpro_roles ){
										//excluding the pmpro_role_ roles here
										if ( $key != 'pmpro_role_' . $level_id ) { //Show this one first
											?>
											<li>
												<input type='checkbox' name='pmpro_roles_level[<?php echo esc_attr( $key ); ?>]' value='<?php echo stripslashes( $role["name"] ); ?>' id='<?php echo esc_attr( $key ); ?>' <?php echo esc_attr( $checked ); ?> /> <label for='<?php echo esc_attr( $key ); ?>'><?php echo stripslashes( $role['name'] ); ?>
												<?php echo "<code>". esc_html( $key ). "</code>"; ?>
												</label>
											</li>
											<?php
										}
									} else {
										//include all roles. No checks needed
										?>
										<li>
											<input type='checkbox' name='pmpro_roles_level[<?php echo esc_attr( $key ); ?>]' value='<?php echo stripslashes( $role["name"] ); ?>' id='<?php echo esc_attr( $key ); ?>' <?php echo esc_attr( $checked ); ?> /> <label for='<?php echo esc_attr( $key ); ?>'><?php echo stripslashes( $role['name'] ); ?>
											<?php echo "<code>". esc_html( $key ). "</code>"; ?>
											</label>
										</li>
										<?php
									}
																		
								}
								?>
								<?php
							}
							?>
							</div>
							</ul>
						</td>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Helper function to remove the administrator role from level settings.
	 * @since 1.3
	 */
	public static function remove_list_roles( $roles ){

		if( !function_exists( 'pmpro_getAllLevels' ) ){
			return $roles;
		}

		if( !empty( $_REQUEST['edit'] ) ){

			$edit_level = intval( $_REQUEST['edit'] );

			$all_levels = pmpro_getAllLevels( true, false );

			if( apply_filters( 'pmpro_roles_hide_admin_role', true, $edit_level ) ){
				//Take admins out of the array first 
				unset( $roles['administrator'] );
			}

			foreach( $all_levels as $level_key => $level ){
				if( $level_key !== $edit_level ){
					if( isset( $roles[PMPRO_Roles::$role_key.$level_key] ) ){
						unset( $roles[PMPRO_Roles::$role_key.$level_key] ); 
					}
				}
			}
			
		}

		return $roles;

	}

	/**
	 * Initial function to run on install. Create roles for each existing level.
	 * @since 1.0
	 */
	public static function install() {
		
		global $wpdb;
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			check_ajax_referer( PMPRO_Roles::$ajaction );
		}
		
		$levels = $wpdb->get_results( "SELECT * FROM $wpdb->pmpro_membership_levels" );
		
		if( !$levels ) {
			if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				die( 'failed' );
			}
			else {
				return;
			}
		}

		$capabilities = PMPRO_Roles::capabilities();

		$i = 0;
		foreach ( $levels as $level ) {
			$role_key = PMPRO_Roles::$role_key . $level->id;
			//the role doesn't exist for this level
			if( !get_role( $role_key ) ) {
				$i++;
				add_role( $role_key, $level->name, $capabilities[$level->id] );
			}
		}
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if($i > 0){
				echo $i;
			}
			else{
				echo __('No', PMPRO_Roles::$plugin_slug);
			}
			die();
		}
	}

	/**
	 * Assign capabilities to custom roles.
	 * @since 1.0
	 */
	public static function capabilities( $role_key = null ) {
		$all_levels = pmpro_getAllLevels( true, false );
		$capabilities = array();

		if( !empty( $role_key ) ){
			if( strpos( $role_key, PMPRO_Roles::$role_key ) !== false){
				$capabilities[$role_key] = array( 'read' => true );
			} else {
				$caps = array();
				//Get the caps of this role
			 	$role_caps = get_role( $role_key )->capabilities;
			 	if( !empty( $role_caps ) ){
			 		foreach( $role_caps as $cap ){
			 			$caps[$cap] = true;
			 		}
			 	}
		 		$capabilities[$role_key] = $caps;
			}
		} else {
			foreach ( $all_levels as $key => $value ) {
				$capabilities[$key] = array( 'read' => true );
			}
		}

		$capabilities = apply_filters( 'pmpro_roles_default_caps', $capabilities );

		return $capabilities;
	}

	/**
	 * Add "Delete Roles and Deactivate" link to plugins page
	 * @since 1.0
	 */
	public static function add_action_links($links) {	
		// Only add this if plugin is active.
		if( is_plugin_active( 'pmpro-roles/pmpro-roles.php' ) ) {
			$new_links = array(
				'<a href="' . wp_nonce_url(get_admin_url(NULL, 'plugins.php?pmpro_roles_delete_and_deactivate=1'), 'pmpro_roles_delete_and_deactivate') . '">' . esc_html__( 'Delete Roles and Deactivate', 'pmpro-roles' ) . '</a>',
			);
			return array_merge($new_links, $links);
		}

		return $links;
	}

	/**
	 * Add links to the plugin row meta
	 */
	public static function plugin_row_meta( $links, $file ) {
		if ( strpos( $file, 'pmpro-roles' ) !== false ) {
			$new_links = array(
				'<a href="' . esc_url( 'https://www.paidmembershipspro.com/add-ons/pmpro-roles/' ) . '" title="' . esc_attr( __( 'View Documentation', 'pmpro-roles' ) ) . '">' . esc_html__( 'Docs', 'pmpro-roles' ) . '</a>',
				'<a href="' . esc_url( 'https://paidmembershipspro.com/support/' ) . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro-roles' ) ) . '">' . esc_html__( 'Support', 'pmpro-roles' ) . '</a>',
			);
			$links     = array_merge( $links, $new_links );
		}
		return $links;
	}

	/**
	 * Process delete and deactivate if clicked.
	 */
	public static function delete_and_deactivate() {
		//see if our param was passed
		if(empty($_REQUEST['pmpro_roles_delete_and_deactivate']))
			return;

		//check nonce
		check_admin_referer('pmpro_roles_delete_and_deactivate');
		
		//find roles based on levels
		global $wpdb;
		$roles = get_option( $wpdb->get_blog_prefix() . 'user_roles' );

		foreach($roles as $key => $role) {
			//is this a pmpro role?
			if(strpos($key, PMPRO_Roles::$role_key) !== FALSE ) {	
				//change all users with those roles to have the default role		
				$users = get_users( array( 'role' => $key ) );

				foreach($users as $user) {
					if ( count( $user->roles ) > 1 ){
						$user->remove_role( $key );
					} else {
						$default_role = apply_filters( 'pmpro_roles_downgraded_role', get_option( 'default_role' ) );
						$user->set_role( $default_role );
					}
				}

				//delete the roles
				remove_role($key);
			}
		}

		//deactivate the plugin
		deactivate_plugins( plugin_basename( __FILE__ ) );

		//output deactivated notice:
		?>
		<div id="message" class="updated notice is-dismissible">
			<p><?php esc_html_e( 'Plugin deactivated', 'pmpro-roles' );?>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'pmpro-roles' );?></span></button>
		</div>
		<?php
	}
}
new PMPRO_Roles;
register_activation_hook( __FILE__, array( 'PMPRO_Roles', 'install' ) );
