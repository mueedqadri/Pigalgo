<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Hoverex_Theme_Updater' ) ) {

	if ( ! class_exists( 'WP_Upgrader_Skin' ) ) {
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader-skin.php' );
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( HOVEREX_THEME_DIR . 'includes/skin-installer/class-hoverex-upgrader-skin.php' );
	}


	class Hoverex_Skin_Install{

		/**
		 * Updater settings.
		 *
		 * @var array
		 */
		protected $settings = array();

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Init class parameters.
		 *
		 * @since  1.0.0
		 */
		public function __construct() {
			add_filter( 'hoverex_skin_list', array( $this, 'return_skin_list' ) );
			add_action( 'admin_post_install_skin', array( $this, 'install_skin' ) );

			// Theme activation  and updates
			add_action('wp_ajax_hoverex_activate_theme', array( $this, 'activate_theme' ) );
			add_action('wp_ajax_hoverex_update_skin',    array( $this, 'update_skin' ) );
			add_action('hoverex_check_theme_updates', array( $this, 'check_theme_updates' ) );

		}


		//-------------------------------------------------------
		//-- Admin activate theme
		//-------------------------------------------------------

		// Activate theme
		function activate_theme() {
			// Init admin url and nonce
			$current_page = hoverex_get_value_gp('page');
			if (is_admin() && isset($current_page) && $current_page === 'hoverex_about') {
				// If submit form with activation code
				$nonce = hoverex_get_value_gp('nonce');
				$code  = hoverex_get_value_gp('hoverex_activate_theme_code');
				$response = array('status' => 'error', 'message' => esc_attr__('Security code is invalid! ', 'hoverex'));

				if ( !empty( $nonce ) ) {
					// Check nonce
					if ( !wp_verify_nonce( $nonce, admin_url('admin-ajax.php') ) ) {
						$response = array(
							'status' => 'error',
							'message' => esc_attr__('Security code is invalid! Theme is not activated!', 'hoverex')
						);
					} else if ( empty( $code ) ) {
						$response = array(
							'status' => 'error',
							'message' => esc_attr__('Please, specify the purchase code!', 'hoverex')
						);

						// Check code
					} else {
						$theme_info  = hoverex_get_theme_info();
						$upgrade_url = sprintf(
							'http://upgrade.themerex.net/upgrade.php?key=%1$s&src=%2$s&theme_slug=%3$s&theme_name=%4$s&action=check',
							urlencode( $code ),
							urlencode( hoverex_storage_get('theme_pro_key') ),
							urlencode( $theme_info['theme_slug'] ),
							urlencode( $theme_info['theme_market_name'] )
						);
						$result = hoverex_fgc( $upgrade_url );
						if ( substr( $result, 0, 5 ) == 'a:2:{' && substr( $result, -1, 1 ) == '}' ) {
							try {
								$result = hoverex_unserialize( $result );
							} catch ( Exception $e ) {
								$result = array(
									'error' => '',
									'data' => -1
								);
							}
							if ( $result['data'] === 1 ) {
								update_option('hoverex_theme_activated', true);
								update_option('hoverex_theme_code_activation', $code);

								$response = array(
									'status' => 'success',
									'message' => esc_attr__('Congratulations! Your theme is activated successfully.', 'hoverex')
								);

							} elseif ( $result['data'] === -1 ) {
								$response = array(
									'status' => 'error',
									'message' => esc_attr__('Bad server answer! Theme is not activated!', 'hoverex')
								);
							} else {
								$response = array(
									'status' => 'error',
									'message' => esc_attr__('Your purchase code is invalid! Theme is not activated!', 'hoverex')
								);
							}
						}
					}
				}

				echo json_encode($response);
				wp_die();
			}
		}

		public function return_skin_list() {
			$json = $this->get_skin_list( HOVEREX_THEME_DIR . 'includes/skin-installer/config.json' );

			if( ! $json || empty( $json['skins'] ) ){
					return;
				}

				$action_url = get_site_url() . '/wp-admin/admin-post.php';
				$first_checked = true;

				$output_html = '<form method="POST" name="skin-installer" enctype="multipart/form-data" id="skin-installer" action="' . $action_url . '">';
				$output_html .= '<div class="hoverex_about_block_description">' . esc_html__('Select skins: ', 'hoverex') . '</div>';
				$output_html .= '<input name="action" type="hidden" value="install_skin">';
				$output_html .= '<input name="action_nonce" type="hidden" value="' . wp_create_nonce( 'install_skin_nonce' ) . '">';
				$output_html .= '<ul class="skin-list">';

				foreach ( $json['skins'] as $key => $value) {
					$theme = wp_get_theme( $key);

				$theme_is_installed = 'publish' === $theme->get('Status') ? 'disabled': '' ;
				$value = $theme_is_installed ? $value . esc_html__( ' ( Installed )', 'hoverex' ) : $value ;
				$checked = '';
				if( $first_checked && 'disabled' !== $theme_is_installed ) {
					$checked = 'checked';
					$first_checked = false;
				}

				$img_href = get_template_directory_uri() . '/includes/skin-installer/img/' . $key . '.jpg';
				$output_html .= sprintf('<li><input type="radio" name="theme_skin" value="%1$s" id="%1$s" %3$s %4$s><label for="%1$s"><img src="%5$s" alt="%2$s">%2$s</label></li>', $key, $value, $checked, $theme_is_installed, $img_href );

			}
			$disabled_button = $first_checked ? 'disabled': '' ;

			$output_html .= '</ul>';
			$output_html .= '<hr>';
			$output_html .= '<button class="button button-primary skin-installer" type="submit" form="skin-installer" ' . $disabled_button . '>' . esc_html__('Install Skin', 'hoverex') . '</button>';
			$output_html .= '</form>';

			return $output_html;
		}

		private function get_skin_list( $json_dir ) {

			if ( ! file_exists( $json_dir ) ) {
				wp_die( 'Dos not exist config file.' );

				return false;
			}

			return json_decode( hoverex_fgc( $json_dir ), true );
		}

		public function install_skin() {
			$theme_slug = empty( $_POST['theme_skin'] ) ? false :  $_POST['theme_skin'];

			if( ! $theme_slug || ! wp_verify_nonce( $_POST['action_nonce'], 'install_skin_nonce') || !hoverex_theme_is_active()){
				return;
			}

			$redirect_url = admin_url().'themes.php?page=hoverex_about';
			$theme_info  = hoverex_get_theme_info();
			$upgrade_url = sprintf(
				'http://upgrade.themerex.net/upgrade.php?key=%1$s&src=%2$s&theme_slug=%3$s&theme_name=%4$s&skin=%5$s&action=install_skin',
				urlencode( get_option('hoverex_theme_code_activation') ),
				urlencode( hoverex_storage_get('theme_pro_key') ),
				urlencode( $theme_info['theme_slug'] ),
				urlencode( $theme_info['theme_market_name'] ),
				urlencode( $theme_slug )
			);
			$result = hoverex_fgc( $upgrade_url );

			if ( substr( $result, 0, 5 ) == 'a:2:{' && substr( $result, -1, 1 ) == '}' ) {
				try {
					$result = hoverex_unserialize( $result );
				} catch ( Exception $e ) {
					$result = array(
						'error' => '',
						'data' => -1
					);
				}

				if ( !empty($result['error']) ) { return; }

				// Save ZIP
				$uploads = wp_upload_dir();
				$zip_dir = $uploads['basedir'] . '/' . $theme_info['theme_slug'] . '.zip';
				$url = $uploads['baseurl'] . '/' . $theme_info['theme_slug'] . '.zip';
				$res = hoverex_fpc( $zip_dir , $result['data']);

				if ( empty($res) ) { return; }

				// Install Skin
				$nonce = 'install-theme_' . $theme_slug;
				$upgrader = new Theme_Upgrader( new Hoverex_Upgrader_Skin( compact( 'url', 'nonce' ) ) );

				$install_result = $upgrader->run( array(
					'package' => $url,
					'destination' => get_theme_root(),
					'clear_destination' => false, //Do not overwrite files.
					'clear_working' => true,
					'hook_extra' => array(
						'type' => 'theme',
						'action' => 'install',
					),
				) );

				// Remove downloaded zip
				hoverex_fs_delete($zip_dir);

				if( is_wp_error( $install_result ) ){
					$redirect_url = admin_url( 'themes.php' );
				}else{
					switch_theme( $install_result['destination_name'] );
				}

			}

			update_option( 'hoverex_about_page', 0 );
			wp_safe_redirect( $redirect_url );
			exit();
		}

		public function update_skin() {
			$theme_slug = empty( $_POST['theme_skin'] ) ? false :  $_POST['theme_skin'];
			$response = array('status' => 'error', 'message' => esc_attr__('Security code is invalid! ', 'hoverex'));

			if( ! $theme_slug || ! wp_verify_nonce( $_POST['nonce'], admin_url('admin-ajax.php')) || !hoverex_theme_is_active()){
				echo json_encode($response);
				wp_die();
			}

			$theme_info  = hoverex_get_theme_info();
			$upgrade_url = sprintf(
				'http://upgrade.themerex.net/upgrade.php?key=%1$s&src=%2$s&theme_slug=%3$s&theme_name=%4$s&skin=%5$s&action=install_skin',
				urlencode( get_option('hoverex_theme_code_activation') ),
				urlencode( hoverex_storage_get('theme_pro_key') ),
				urlencode( $theme_info['theme_slug'] ),
				urlencode( $theme_info['theme_market_name'] ),
				urlencode( $theme_slug )
			);
			$result = hoverex_fgc( $upgrade_url );

			if ( substr( $result, 0, 5 ) == 'a:2:{' && substr( $result, -1, 1 ) == '}' ) {
				try {
					$result = hoverex_unserialize( $result );
				} catch ( Exception $e ) {
					$result = array(
						'error' => '',
						'data' => -1
					);
				}

				if ( !empty($result['error']) ) { return; }

				// Save ZIP
				$uploads = wp_upload_dir();
				$zip_dir = $uploads['basedir'] . '/' . $theme_info['theme_slug'] . '.zip';
				$url = $uploads['baseurl'] . '/' . $theme_info['theme_slug'] . '.zip';
				$res = hoverex_fpc( $zip_dir , $result['data']);

				if ( empty($res) ) { return; }

				// Install Skin
				$nonce = 'install-theme_' . $theme_slug;
				$upgrader = new Theme_Upgrader( new Hoverex_Upgrader_Skin( compact( 'url', 'nonce' ) ) );

				$install_result = $upgrader->run( array(
					'package' => $url,
					'destination' => get_theme_root(),
					'clear_destination' => true, //Overwrite files.
				) );

				if( is_wp_error( $install_result ) ){
					$response = array(
						'status' => 'success',
						'message' => '<p>'
							. sprintf( esc_attr__('<b>%s</b> update failed. ', 'hoverex'), $theme_slug)
							. '</p>'
					);
				} else {

					$update_list = get_transient( 'hoverex_skins_to_update' );
					unset( $update_list[ $theme_slug ] );
					set_transient( 'hoverex_skins_to_update', $update_list );

					$response = array(
						'status' => 'success',
						'message' => '<p>'
							. sprintf( esc_html__('%s%s%s updated successfully. ', 'hoverex'), '<b>',$install_result['destination_name'],'</b>')
							. '</p>'
					);
				}

				// Remove downloaded zip
				hoverex_fs_delete($zip_dir);

				echo json_encode($response);
				wp_die();
			}

			exit();
		}

		public function remote_skin_version( $skin ) {
			$theme_info  = hoverex_get_theme_info();
			$upgrade_url = sprintf(
				'http://upgrade.themerex.net/upgrade.php?theme_slug=%1$s&skin=%2$s&action=info_skin',
				urlencode( $theme_info['theme_slug'] ),
				urlencode( $skin )
			);
			$result = hoverex_fgc( $upgrade_url );
			$version = '0';
			if ( substr( $result, 0, 5 ) == 'a:2:{' && substr( $result, -1, 1 ) == '}' ) {
				try {
					$result = hoverex_unserialize($result);
					$version = json_decode( $result['data'] );
					$version = $version->version;
				} catch (Exception $e) {
					$result = array(
						'error' => '',
						'data' => -1
					);
				}
				if (!empty($result['error'])) {
					return 0;
				}
			}
			return $version;
		}

		public function check_theme_updates() {

			$all_skins = $this->get_skin_list( HOVEREX_THEME_DIR . 'includes/skin-installer/config.json' );
			$update_list = array();

			if( ! $all_skins || empty( $all_skins['skins'] ) ){
				return;
			}

			foreach ( $all_skins['skins'] as $key => $value) {
				$theme = wp_get_theme( $key );
				$version_remote = $this->remote_skin_version( $key );
				$version_local = $theme->version;
				if ( !empty($version_local) && version_compare( $version_remote, $version_local,'>') ) {
					$update_list[$key] = $value;
				}
			}
			set_transient( 'hoverex_skins_to_update', $update_list );
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
	}

	/**
	 * Returns instanse.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	function hoverex_skin_install() {
		return Hoverex_Skin_Install::get_instance();
	}
	hoverex_skin_install();
}
