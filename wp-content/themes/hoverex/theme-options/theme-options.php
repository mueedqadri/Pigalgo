<?php
/**
 * Theme Options, Color Schemes and Fonts utilities
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('hoverex_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'hoverex_options_theme_setup2', 2 );
	function hoverex_options_theme_setup2() {
		hoverex_create_theme_options();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('hoverex_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'hoverex_options_theme_setup5', 5 );
	function hoverex_options_theme_setup5() {
		hoverex_storage_set('options_reloaded', false);
		hoverex_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('hoverex_load_custom_options')) {
		add_action( 'wp_loaded', 'hoverex_load_custom_options' );
		function hoverex_load_custom_options() {
			if (!hoverex_storage_get('options_reloaded')) {
				hoverex_storage_set('options_reloaded', true);
				hoverex_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('hoverex_load_theme_options') ) {
	function hoverex_load_theme_options() {
		$options = hoverex_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				$value = hoverex_get_theme_option_std($k, $v['std']);
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = wp_kses_data(wp_unslash($_GET[$k]));
					else {
						$default_value = -987654321;
						$tmp = get_theme_mod($k, $default_value);
						if ($tmp != $default_value) $value = $tmp;
					}
				}
				hoverex_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			hoverex_customizer_save_css();
		} else {
			do_action('hoverex_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('hoverex_override_theme_options') ) {
	add_action( 'wp', 'hoverex_override_theme_options', 1 );
	function hoverex_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			hoverex_storage_set('blog_archive', true);
			hoverex_storage_set('blog_template', get_the_ID());
		}
		hoverex_storage_set('blog_mode', hoverex_detect_blog_mode());
		if (is_singular()) {
			hoverex_storage_set('options_meta', get_post_meta(get_the_ID(), 'hoverex_options', true));
		}
		do_action('hoverex_action_override_theme_options');
	}
}

// Override options with stored page meta on 'Blog posts' pages
if ( !function_exists('hoverex_blog_override_theme_options') ) {
	add_action( 'hoverex_action_override_theme_options', 'hoverex_blog_override_theme_options');
	function hoverex_blog_override_theme_options() {
		global $wp_query;
		if (is_home() && !is_front_page() && !empty($wp_query->is_posts_page)) {
			if (($id = get_option('page_for_posts')) > 0)
				hoverex_storage_set('options_meta', get_post_meta($id, 'hoverex_options', true));
		}
	}
}


// Return 'std' value of the option, processed by special function (if specified)
if (!function_exists('hoverex_get_theme_option_std')) {
	function hoverex_get_theme_option_std($opt_name, $opt_std) {
		if (strpos($opt_std, '$hoverex_')!==false) {
			$func = substr($opt_std, 1);
			if (function_exists($func)) {
				$opt_std = $func($opt_name);
			}
		}
		return $opt_std;
	}
}


// Return customizable option value
if (!function_exists('hoverex_get_theme_option')) {
	function hoverex_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;

		if ($post_id > 0) {
			if (!hoverex_storage_isset('post_options_meta', $post_id))
				hoverex_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'hoverex_options', true));
			if (hoverex_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = hoverex_storage_get_array('post_options_meta', $post_id, $name);
				if (!hoverex_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}

		if (!$from_post_meta && hoverex_storage_isset('options')) {

			$blog_mode = hoverex_storage_get('blog_mode');

			if ( !hoverex_storage_isset('options', $name) && (empty($blog_mode) || !hoverex_storage_isset('options', $name.'_'.$blog_mode)) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						// Translators: Add option's name to the output
						echo '<pre>' . esc_html(sprintf(esc_html__('Undefined option "%s" called from:', 'hoverex'), $name));
						if (function_exists('dcs')) dcs();
						echo '</pre>';
						wp_die();
					} else
						$rez = $defa;
				}

			} else {

				$blog_mode_parent = $blog_mode=='post'
										? 'blog'
										: str_replace('_single', '', $blog_mode);

				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = wp_kses_data(wp_unslash($_REQUEST[$name . '_' . $blog_mode]));

				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = wp_kses_data(wp_unslash($_REQUEST[$name]));

				// Override option from current page settings (if exists)
				} else if (hoverex_storage_isset('options_meta', $name) && !hoverex_is_inherit(hoverex_storage_get_array('options_meta', $name))) {
					$rez = hoverex_storage_get_array('options_meta', $name);

				// Override option from current blog mode settings: 'front', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && hoverex_storage_isset('options', $name . '_' . $blog_mode, 'val') && !hoverex_is_inherit(hoverex_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = hoverex_storage_get_array('options', $name . '_' . $blog_mode, 'val');

				// Override option for 'post' from 'blog' settings (if exists)
				// Also used for override 'xxx_single' on the 'xxx'
				// (for example, instead 'sidebar_courses_single' return option for 'sidebar_courses')
				} else if (!empty($blog_mode_parent) && $blog_mode!=$blog_mode_parent && hoverex_storage_isset('options', $name . '_' . $blog_mode_parent, 'val') && !hoverex_is_inherit(hoverex_storage_get_array('options', $name . '_' . $blog_mode_parent, 'val'))) {
					$rez = hoverex_storage_get_array('options', $name . '_' . $blog_mode_parent, 'val');

				// Get saved option value
				} else if (hoverex_storage_isset('options', $name, 'val')) {
					$rez = hoverex_storage_get_array('options', $name, 'val');

				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);

				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('hoverex_check_theme_option')) {
	function hoverex_check_theme_option($name) {
		return hoverex_storage_isset('options', $name);
	}
}


// Return customizable option value, stored in the posts meta
if (!function_exists('hoverex_get_theme_option_from_meta')) {
	function hoverex_get_theme_option_from_meta($name, $defa='') {
		$rez = $defa;
		if (hoverex_storage_isset('options_meta')) {
			if (hoverex_storage_isset('options_meta', $name))
				$rez = hoverex_storage_get_array('options_meta', $name);
			else
				$rez = 'inherit';
		}
		return $rez;
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('hoverex_get_theme_dependencies') ) {
	function hoverex_get_theme_dependencies() {
		$options = hoverex_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}



// -----------------------------------------------------------------
// -- Theme Settings utilities
// -----------------------------------------------------------------

// Return internal theme setting value
if (!function_exists('hoverex_get_theme_setting')) {
	function hoverex_get_theme_setting($name) {
		if ( !hoverex_storage_isset('settings', $name) ) {
			// Translators: Add setting's name to the output
			echo '<pre>' . esc_html(sprintf(esc_html__('Undefined setting "%s" called from:', 'hoverex'), $name));
			if (function_exists('dcs')) dcs();
			echo '</pre>';
			wp_die();
		} else
			return hoverex_storage_get_array('settings', $name);
	}
}

// Set theme setting
if ( !function_exists( 'hoverex_set_theme_setting' ) ) {
	function hoverex_set_theme_setting($option_name, $value) {
		if (hoverex_storage_isset('settings', $option_name))
			hoverex_storage_set_array('settings', $option_name, $value);
	}
}



// -----------------------------------------------------------------
// -- Color Schemes utilities
// -----------------------------------------------------------------

// Load saved values to the color schemes
if (!function_exists('hoverex_load_schemes')) {
	add_action('hoverex_action_load_options', 'hoverex_load_schemes');
	function hoverex_load_schemes() {
		$schemes = hoverex_storage_get('schemes');
		$storage = hoverex_unserialize(hoverex_get_theme_option('scheme_storage'));
		if (is_array($storage) && count($storage) > 0)  {
			foreach ($storage as $k=>$v) {
				if (isset($schemes[$k])) {
					$schemes[$k] = $v;
				}
			}
			hoverex_storage_set('schemes', $schemes);
		}
	}
}

// Return specified color from current (or specified) color scheme
if ( !function_exists( 'hoverex_get_scheme_color' ) ) {
	function hoverex_get_scheme_color($color_name, $scheme = '') {
		if (empty($scheme)) $scheme = hoverex_get_theme_option( 'color_scheme' );
		if (empty($scheme) || hoverex_storage_empty('schemes', $scheme)) $scheme = 'default';
		$colors = hoverex_storage_get_array('schemes', $scheme, 'colors');
		return $colors[$color_name];
	}
}

// Return colors from current color scheme
if ( !function_exists( 'hoverex_get_scheme_colors' ) ) {
	function hoverex_get_scheme_colors($scheme = '') {
		if (empty($scheme)) $scheme = hoverex_get_theme_option( 'color_scheme' );
		if (empty($scheme) || hoverex_storage_empty('schemes', $scheme)) $scheme = 'default';
		return hoverex_storage_get_array('schemes', $scheme, 'colors');
	}
}

// Return colors from all schemes
if ( !function_exists( 'hoverex_get_scheme_storage' ) ) {
	function hoverex_get_scheme_storage($scheme = '') {
		return serialize(hoverex_storage_get('schemes'));
	}
}

// Return schemes list
if ( !function_exists( 'hoverex_get_list_schemes' ) ) {
	function hoverex_get_list_schemes($prepend_inherit=false) {
		$list = array();
		$schemes = hoverex_storage_get('schemes');
		if (is_array($schemes) && count($schemes) > 0) {
			foreach ($schemes as $slug => $scheme) {
				$list[$slug] = $scheme['title'];
			}
		}
		return $prepend_inherit ? hoverex_array_merge(array('inherit' => esc_html__("Inherit", 'hoverex')), $list) : $list;
	}
}



// -----------------------------------------------------------------
// -- Theme Fonts utilities
// -----------------------------------------------------------------

// Load saved values into fonts list
if (!function_exists('hoverex_load_fonts')) {
	add_action('hoverex_action_load_options', 'hoverex_load_fonts');
	function hoverex_load_fonts() {
		// Fonts to load when theme starts
		$load_fonts = array();
		for ($i=1; $i<=hoverex_get_theme_setting('max_load_fonts'); $i++) {
			if (($name = hoverex_get_theme_option("load_fonts-{$i}-name")) != '') {
				$load_fonts[] = array(
					'name'	 => $name,
					'family' => hoverex_get_theme_option("load_fonts-{$i}-family"),
					'styles' => hoverex_get_theme_option("load_fonts-{$i}-styles")
				);
			}
		}
		hoverex_storage_set('load_fonts', $load_fonts);
		hoverex_storage_set('load_fonts_subset', hoverex_get_theme_option("load_fonts_subset"));
		
		// Font parameters of the main theme's elements
		$fonts = hoverex_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = hoverex_get_theme_option("{$tag}_{$css_prop}");
			}
		}
		hoverex_storage_set('theme_fonts', $fonts);
	}
}

// Return slug of the loaded font
if (!function_exists('hoverex_get_load_fonts_slug')) {
	function hoverex_get_load_fonts_slug($name) {
		return str_replace(' ', '-', $name);
	}
}

// Return load fonts parameter's default value
if (!function_exists('hoverex_get_load_fonts_option')) {
	function hoverex_get_load_fonts_option($option_name) {
		$rez = '';
		$parts = explode('-', $option_name);
		$load_fonts = (array)hoverex_storage_get('load_fonts');
		if ($parts[0] == 'load_fonts' && count($load_fonts) > $parts[1]-1 && isset($load_fonts[$parts[1]-1][$parts[2]])) {
			$rez = $load_fonts[$parts[1]-1][$parts[2]];
		}
		return $rez;
	}
}

// Return load fonts subset's default value
if (!function_exists('hoverex_get_load_fonts_subset')) {
	function hoverex_get_load_fonts_subset($option_name) {
		return hoverex_storage_get('load_fonts_subset');
	}
}

// Return load fonts list
if (!function_exists('hoverex_get_list_load_fonts')) {
	function hoverex_get_list_load_fonts($prepend_inherit=false) {
		$list = array();
		$load_fonts = hoverex_storage_get('load_fonts');
		if (is_array($load_fonts) && count($load_fonts) > 0) {
			foreach ($load_fonts as $font) {
				$list['"'.trim($font['name']).'"'.(!empty($font['family']) ? ','.trim($font['family']): '')] = $font['name'];
			}
		}
		return $prepend_inherit ? hoverex_array_merge(array('inherit' => esc_html__("Inherit", 'hoverex')), $list) : $list;
	}
}

// Return font settings of the theme specific elements
if ( !function_exists( 'hoverex_get_theme_fonts' ) ) {
	function hoverex_get_theme_fonts() {
		return hoverex_storage_get('theme_fonts');
	}
}

// Return theme fonts parameter's default value
if (!function_exists('hoverex_get_theme_fonts_option')) {
	function hoverex_get_theme_fonts_option($option_name) {
		$rez = '';
		$parts = explode('_', $option_name);
		$theme_fonts = hoverex_storage_get('theme_fonts');
		if (!empty($theme_fonts[$parts[0]][$parts[1]])) {
			$rez = $theme_fonts[$parts[0]][$parts[1]];
		}
		return $rez;
	}
}

// Update loaded fonts list in the each tag's parameter (p, h1..h6,...) after the 'load_fonts' options are loaded
if (!function_exists('hoverex_update_list_load_fonts')) {
	add_action('hoverex_action_load_options', 'hoverex_update_list_load_fonts', 11);
	function hoverex_update_list_load_fonts() {
		$theme_fonts = hoverex_get_theme_fonts();
		$load_fonts = hoverex_get_list_load_fonts(true);
		foreach ($theme_fonts as $tag=>$v) {
			hoverex_storage_set_array2('options', $tag.'_font-family', 'options', $load_fonts);
		}
	}
}



// -----------------------------------------------------------------
// -- Other options utilities
// -----------------------------------------------------------------

// Return current theme-specific border radius for form's fields and buttons
if ( !function_exists( 'hoverex_get_border_radius' ) ) {
	function hoverex_get_border_radius() {
		$rad = str_replace(' ', '', hoverex_get_theme_option('border_radius'));
		if (empty($rad)) $rad = 0;
		return hoverex_prepare_css_value($rad); 
	}
}




// -----------------------------------------------------------------
// -- Theme Options page
// -----------------------------------------------------------------

if ( !function_exists('hoverex_options_init_page_builder') ) {
	add_action( 'after_setup_theme', 'hoverex_options_init_page_builder' );
	function hoverex_options_init_page_builder() {
		if ( is_admin() ) {
			add_action('admin_enqueue_scripts',	'hoverex_options_add_scripts');
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'hoverex_options_add_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'hoverex_options_add_scripts');
	function hoverex_options_add_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_theme_options') {
			wp_enqueue_style( 'fontello-icons',  hoverex_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			wp_enqueue_style( 'wp-color-picker', false, array(), null);
			wp_enqueue_script('wp-color-picker', false, array('jquery'), null, true);
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'jquery-ui-accordion', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'hoverex-options', hoverex_get_file_url('theme-options/theme-options.js'), array('jquery'), null, true );
			wp_enqueue_script( 'hoverex-colorpicker.colors', hoverex_get_file_url('js/colorpicker/colors.js'), array('jquery'), null, true );
			wp_enqueue_script( 'hoverex-colorpicker', hoverex_get_file_url('js/colorpicker/jqColorPicker.js'), array('jquery'), null, true );
			wp_localize_script( 'hoverex-options', 'hoverex_dependencies', hoverex_get_theme_dependencies() );
			wp_localize_script( 'hoverex-options', 'hoverex_color_schemes', hoverex_storage_get('schemes') );
			wp_localize_script( 'hoverex-options', 'hoverex_simple_schemes', hoverex_storage_get('schemes_simple') );
		}
	}
}

// Add Theme Options item in the Appearance menu
if (!function_exists('hoverex_options_add_menu_items')) {
	add_action( 'admin_menu', 'hoverex_options_add_menu_items' );
	function hoverex_options_add_menu_items() {
		if (!HOVEREX_THEME_FREE) {
			add_theme_page(
				esc_html__('Theme Options', 'hoverex'),	//page_title
				esc_html__('Theme Options', 'hoverex'),	//menu_title
				'manage_options',						//capability
				'theme_options',						//menu_slug
				'hoverex_options_page_builder',			//callback
				'dashicons-admin-generic',				//icon
				''										//menu position
			);
		}
	}
}


// Build options page
if (!function_exists('hoverex_options_page_builder')) {
	function hoverex_options_page_builder() {
		?>
		<div class="hoverex_options">
			<h2 class="hoverex_options_title"><?php esc_html_e('Theme Options', 'hoverex'); ?></h2>
			<?php hoverex_show_admin_messages(); ?>
			<form id="hoverex_options_form" action="#" method="post" enctype="multipart/form-data">
				<input type="hidden" name="hoverex_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
				<?php hoverex_options_show_fields(); ?>
				<div class="hoverex_options_buttons">
					<input type="button" class="hoverex_options_button_submit" value="<?php esc_html_e('Save Options', 'hoverex'); ?>">
				</div>
			</form>
		</div>
		<?php
	}
}


// Display all option's fields
if ( !function_exists('hoverex_options_show_fields') ) {
	function hoverex_options_show_fields($options=false) {
		if (empty($options)) $options = hoverex_storage_get('options');
		$tabs_titles = $tabs_content = array();
		$last_panel = $last_section = $last_group = '';
		foreach ($options as $k=>$v) {
			// New tab
			if ($v['type']=='panel' || ($v['type']=='section' && empty($last_panel))) {
				if (!isset($tabs_titles[$k])) {
					$tabs_titles[$k] = $v['title'];
					$tabs_content[$k] = '';
				}
				if (!empty($last_group)) {
					$tabs_content[$last_section] .= '</div></div>';
					$last_group = '';
				}
				$last_section = $k;
				if ($v['type']=='panel') $last_panel = $k;

			// New group
			} else if ($v['type']=='group' || ($v['type']=='section' && !empty($last_panel))) {
				if (empty($last_group))
					$tabs_content[$last_section] = (!isset($tabs_content[$last_section]) ? '' : $tabs_content[$last_section]) 
													. '<div class="hoverex_accordion hoverex_options_groups">';
				else
					$tabs_content[$last_section] .= '</div>';
				$tabs_content[$last_section] .= '<h4 class="hoverex_accordion_title hoverex_options_group_title">' . esc_html($v['title']) . '</h4>'
												. '<div class="hoverex_accordion_content hoverex_options_group_content">';
				$last_group = $k;
			
			// End panel, section or group
			} else if (in_array($v['type'], array('group_end', 'section_end', 'panel_end'))) {
				if (!empty($last_group) && ($v['type'] != 'section_end' || empty($last_panel))) {
					$tabs_content[$last_section] .= '</div></div>';
					$last_group = '';
				}
				if ($v['type'] == 'panel_end') $last_panel = '';
				
			// Field's layout
			} else {
				$tabs_content[$last_section] = (!isset($tabs_content[$last_section]) ? '' : $tabs_content[$last_section]) 
												. hoverex_options_show_field($k, $v);
			}
		}
		if (!empty($last_group)) {
			$tabs_content[$last_section] .= '</div></div>';
		}
		
		if (count($tabs_content) > 0) {
			// Remove empty sections
			foreach ($tabs_content as $k=>$v) {
				if (empty($v)) {
					unset($tabs_titles[$k]);
					unset($tabs_content[$k]);
				}
			}
			?>
			<div id="hoverex_options_tabs" class="hoverex_tabs <?php echo count($tabs_titles) > 1 ? 'with_tabs' : 'no_tabs'; ?>">
				<?php if (count($tabs_titles) > 1) { ?>
					<ul><?php
						$cnt = 0;
						foreach ($tabs_titles as $k=>$v) {
							$cnt++;
							?><li><a href="#hoverex_options_section_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
						}
					?></ul>
				<?php
				}
				$cnt = 0;
				foreach ($tabs_content as $k=>$v) {
					$cnt++;
					?>
					<div id="hoverex_options_section_<?php echo esc_attr($cnt); ?>" class="hoverex_tabs_section hoverex_options_section">
						<?php hoverex_show_layout($v); ?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}


// Display single option's field
if ( !function_exists('hoverex_options_show_field') ) {
	function hoverex_options_show_field($name, $field, $post_type='') {

		$inherit_allow = !empty($post_type);
		$inherit_state = !empty($post_type) && isset($field['val']) && hoverex_is_inherit($field['val']);
		
		$field_data_present = $field['type']!='info' || !empty($field['override']['desc']) || !empty($field['desc']);

		if (   ($field['type'] == 'hidden' && $inherit_allow) 	// Hidden field in the post meta (not in the root Theme Options)
			|| (!empty($field['hidden']) && !$inherit_allow)	// Field only for post meta in the root Theme Options
		   ) return '';
		
		if ($field['type'] == 'hidden') {

			$output = '<input type="hidden" name="hoverex_options_field_'.esc_attr($name).'"'
								. ' value="'.esc_attr($field['val']).'"'
								. ' />';
		} else {
		
		$output = (!empty($field['class']) && strpos($field['class'], 'hoverex_new_row')!==false 
					? '<div class="hoverex_new_row_before"></div>'
					: '')
					. '<div class="hoverex_options_item hoverex_options_item_'.esc_attr($field['type'])
								. ($inherit_allow ? ' hoverex_options_inherit_'.($inherit_state ? 'on' : 'off' ) : '')
								. (!empty($field['class']) ? ' '.esc_attr($field['class']) : '')
								. '">'
						. '<h4 class="hoverex_options_item_title">'
							. esc_html($field['title'])
							. ($inherit_allow 
									? '<span class="hoverex_options_inherit_lock" id="hoverex_options_inherit_'.esc_attr($name).'"></span>'
									: '')
						. '</h4>'
						. ($field_data_present
							? '<div class="hoverex_options_item_data">'
								. '<div class="hoverex_options_item_field" data-param="'.esc_attr($name).'"'
									. (!empty($field['linked']) ? ' data-linked="'.esc_attr($field['linked']).'"' : '')
									. '>'
							: '');
	
		// Type 'checkbox'
		if ($field['type']=='checkbox') {
			$output .= '<label class="hoverex_options_item_label">'
						. '<input type="checkbox" name="hoverex_options_field_'.esc_attr($name).'" value="1"'
								.($field['val']==1 ? ' checked="checked"' : '')
								.' />'
						. esc_html($field['title'])
					. '</label>';
		
		// Type 'switch' (2 choises) or 'radio' (3+ choises)
		} else if (in_array($field['type'], array('switch', 'radio'))) {
			$field['options'] = apply_filters('hoverex_filter_options_get_list_choises', $field['options'], $name);
			$first = true;
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="hoverex_options_item_label">'
							. '<input type="radio" name="hoverex_options_field_'.esc_attr($name).'"'
									. ' value="'.esc_attr($k).'"'
									. ($field['val']==$k || ($first && !isset($field['options'][$field['val']])) ? ' checked="checked"' : '')
									. ' />'
							. esc_html($v)
						. '</label>';
				$first = false;
			}

		// Type 'text' or 'time' or 'date'
		} else if (in_array($field['type'], array('text', 'time', 'date'))) {
			$output .= '<input type="text" name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />';
		
		// Type 'textarea'
		} else if ($field['type']=='textarea') {
			$output .= '<textarea name="hoverex_options_field_'.esc_attr($name).'">'
							. esc_html(hoverex_is_inherit($field['val']) ? '' : $field['val'])
						. '</textarea>';
		
		// Type 'text_editor'
		} else if ($field['type']=='text_editor') {
			$output .= '<input type="hidden" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_textarea(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. hoverex_show_custom_field('hoverex_options_field_'.esc_attr($name).'_tinymce',
													$field,
													hoverex_is_inherit($field['val']) ? '' : $field['val']);

		// Type 'select'
		} else if ($field['type']=='select') {
			$field['options'] = apply_filters('hoverex_filter_options_get_list_choises', $field['options'], $name);
			$output .= '<select size="1" name="hoverex_options_field_'.esc_attr($name).'">';
			foreach ($field['options'] as $k=>$v) {
				$output .= '<option value="'.esc_attr($k).'"'.($field['val']==$k ? ' selected="selected"' : '').'>'.esc_html($v).'</option>';
			}
			$output .= '</select>';

		// Type 'image', 'media', 'video' or 'audio'
		} else if (in_array($field['type'], array('image', 'media', 'video', 'audio'))) {
			if ( (int) $field['val'] > 0 ) {
				$image = wp_get_attachment_image_src( $field['val'], 'full' );
				$field['val'] = $image[0];
			}
			$output .= (!empty($field['multiple'])
						? '<input type="hidden" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						: '<input type="text" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />')
					. hoverex_show_custom_field('hoverex_options_field_'.esc_attr($name).'_button',
												array(
													'type'			 => 'mediamanager',
													'multiple'		 => !empty($field['multiple']),
													'data_type'		 => $field['type'],
													'linked_field_id'=> 'hoverex_options_field_'.esc_attr($name)
												),
												hoverex_is_inherit($field['val']) ? '' : $field['val']);

		// Type 'color'
		} else if ($field['type']=='color') {
			$output .= '<input type="text" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' class="hoverex_color_selector"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr($field['val']).'"'
							. ' />';
		
		// Type 'icon'
		} else if ($field['type']=='icon') {
			$output .= '<input type="text" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. hoverex_show_custom_field('hoverex_options_field_'.esc_attr($name).'_button',
													array(
														'type'	 => 'icons',
														'button' => true,
														'icons'	 => true
													),
													hoverex_is_inherit($field['val']) ? '' : $field['val']);
		
		// Type 'checklist'
		} else if ($field['type']=='checklist') {
			$output .= '<input type="hidden" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. hoverex_show_custom_field('hoverex_options_field_'.esc_attr($name).'_list',
													$field,
													hoverex_is_inherit($field['val']) ? '' : $field['val']);
		
		// Type 'scheme_editor'
		} else if ($field['type']=='scheme_editor') {
			$output .= '<input type="hidden" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. hoverex_show_custom_field('hoverex_options_field_'.esc_attr($name).'_scheme',
													$field,
													hoverex_unserialize($field['val']));
		
		// Type 'slider' || 'range'
		} else if (in_array($field['type'], array('slider', 'range'))) {
			$field['show_value'] = !isset($field['show_value']) || $field['show_value'];
			$output .= '<input type="'.(!$field['show_value'] ? 'hidden' : 'text').'" id="hoverex_options_field_'.esc_attr($name).'"'
							. ' name="hoverex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(hoverex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ($field['show_value'] ? ' class="hoverex_range_slider_value"' : '')
							. ' />'
						. hoverex_show_custom_field('hoverex_options_field_'.esc_attr($name).'_slider',
													$field,
													hoverex_is_inherit($field['val']) ? '' : $field['val']);
			
		}
		
		$output .= ($inherit_allow
						? '<div class="hoverex_options_inherit_cover'.(!$inherit_state ? ' hoverex_hidden' : '').'">'
							. '<span class="hoverex_options_inherit_label">' . esc_html__('Inherit', 'hoverex') . '</span>'
							. '<input type="hidden" name="hoverex_options_inherit_'.esc_attr($name).'"'
									. ' value="'.esc_attr($inherit_state ? 'inherit' : '').'"'
									. ' />'
							. '</div>'
						: '')
					. ($field_data_present ? '</div>' : '')
					. (!empty($field['override']['desc']) || !empty($field['desc'])
						? '<div class="hoverex_options_item_description">'
							. (!empty($field['override']['desc']) 	// param 'desc' already processed with wp_kses()!
									? $field['override']['desc'] 
									: $field['desc'])
							. '</div>'
						: '')
				. ($field_data_present ? '</div>' : '')
			. '</div>';
		}
		return $output;
	}
}


// Show theme specific fields
function hoverex_show_custom_field($id, $field, $value) {
	$output = '';
	switch ($field['type']) {
		
		case 'mediamanager':
			wp_enqueue_media( );
			$title = empty($field['data_type']) || $field['data_type']=='image'
							? esc_html__( 'Choose Image', 'hoverex')
							: esc_html__( 'Choose Media', 'hoverex');
			$output .= '<input type="button"'
							. ' id="'.esc_attr($id).'"'
							. ' class="button mediamanager hoverex_media_selector"'
							. '	data-param="' . esc_attr($id) . '"'
							. '	data-choose="'.esc_attr(!empty($field['multiple']) ? esc_html__( 'Choose Images', 'hoverex') : $title).'"'
							. ' data-update="'.esc_attr(!empty($field['multiple']) ? esc_html__( 'Add to Gallery', 'hoverex') : $title).'"'
							. '	data-multiple="'.esc_attr(!empty($field['multiple']) ? '1' : '0').'"'
							. '	data-type="'.esc_attr(!empty($field['data_type']) ? $field['data_type'] : 'image').'"'
							. '	data-linked-field="'.esc_attr($field['linked_field_id']).'"'
							. ' value="'
								. (!empty($field['multiple'])
										? (empty($field['data_type']) || $field['data_type']=='image'
											? esc_html__( 'Add Images', 'hoverex')
											: esc_html__( 'Add Files', 'hoverex')
											)
										: esc_html($title)
									)
								. '"'
							. '>';
			$output .= '<span class="hoverex_options_field_preview">';
			$images = explode('|', $value);
			if (is_array($images)) {
				foreach ($images as $img)
					$output .= $img && !hoverex_is_inherit($img)
							? '<span>'
									. (in_array(hoverex_get_file_ext($img), array('gif', 'jpg', 'jpeg', 'png'))
											? '<img src="' . esc_url($img) . '" alt="'.esc_html__('Image', 'hoverex').'">'
											: '<a href="' . esc_attr($img) . '">' . esc_html(basename($img)) . '</a>'
										)
								. '</span>' 
							: '';
			}
			$output .= '</span>';
			break;

		case 'icons':
			$icons_type = !empty($field['style']) 
							? $field['style'] 
							: hoverex_get_theme_setting('icons_type');
			if (empty($field['return']))
				$field['return'] = 'full';
			$hoverex_icons = $icons_type=='images'
								? hoverex_get_list_images()
								: hoverex_array_from_list(hoverex_get_list_icons());
			if (is_array($hoverex_icons)) {
				if (!empty($field['button']))
					$output .= '<span id="'.esc_attr($id).'"'
									. ' class="hoverex_list_icons_selector'
											. ($icons_type=='icons' && !empty($value) ? ' '.esc_attr($value) : '')
											.'"'
									. ' title="'.esc_attr__('Select icon', 'hoverex').'"'
									. ' data-style="'.($icons_type=='images' ? 'images' : 'icons').'"'
									. ($icons_type=='images' && !empty($value) 
										? ' style="background-image: url('.esc_url($field['return']=='slug' 
																							? $hoverex_icons[$value] 
																							: $value).');"' 
											: '')
								. '></span>';
				if (!empty($field['icons'])) {
					$output .= '<div class="hoverex_list_icons">'
								. '<input type="text" class="hoverex_list_icons_search" placeholder="'.esc_attr__('Search icon ...', 'hoverex').'">';
					foreach($hoverex_icons as $slug=>$icon) {
						$output .= '<span class="'.esc_attr($icons_type=='icons' ? $icon : $slug)
								. (($field['return']=='full' ? $icon : $slug) == $value ? ' hoverex_list_active' : '')
								. '"'
								. ' title="'.esc_attr($slug).'"'
								. ' data-icon="'.esc_attr($field['return']=='full' ? $icon : $slug).'"'
								. ($icons_type=='images' ? ' style="background-image: url('.esc_url($icon).');"' : '')
								. '></span>';
					}
					$output .= '</div>';
				}
			}
			break;

		case 'checklist':
			if (!empty($field['sortable']))
				wp_enqueue_script('jquery-ui-sortable', false, array('jquery', 'jquery-ui-core'), null, true);
			$output .= '<div class="hoverex_checklist hoverex_checklist_'.esc_attr($field['dir'])
						. (!empty($field['sortable']) ? ' hoverex_sortable' : '') 
						. '">';
			if (!is_array($value)) {
				if (!empty($value) && !hoverex_is_inherit($value)) parse_str(str_replace('|', '&', $value), $value);
				else $value = array();
			}
			// Sort options by values order
			if (!empty($field['sortable']) && is_array($value)) {
				$field['options'] = hoverex_array_merge($value, $field['options']);
			}
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="hoverex_checklist_item_label' 
								. (!empty($field['sortable']) ? ' hoverex_sortable_item' : '') 
								. '">'
							. '<input type="checkbox" value="1" data-name="'.$k.'"'
								.( isset($value[$k]) && (int) $value[$k] == 1 ? ' checked="checked"' : '')
								.' />'
							. (substr($v, 0, 4)=='http' ? '<img src="'.esc_url($v).'">' : esc_html($v))
						. '</label>';
			}
			$output .= '</div>';
			break;

		case 'slider':
		case 'range':
			wp_enqueue_script('jquery-ui-slider', false, array('jquery', 'jquery-ui-core'), null, true);
			$is_range  = $field['type'] == 'range';
			$field_min = !empty($field['min']) ? $field['min'] : 0;
			$field_max = !empty($field['max']) ? $field['max'] : 100;
			$field_step= !empty($field['step']) ? $field['step'] : 1;
			$field_val = !empty($value) 
							? ($value . ($is_range && strpos($value, ',')===false ? ','.$field_max : ''))
							: ($is_range ? $field_min.','.$field_max : $field_min);
			$output .= '<div id="'.esc_attr($id).'"'
							. ' class="hoverex_range_slider"'
							. ' data-range="' . esc_attr($is_range ? 'true' : 'min') . '"'
							. ' data-min="' . esc_attr($field_min) . '"'
							. ' data-max="' . esc_attr($field_max) . '"'
							. ' data-step="' . esc_attr($field_step) . '"'
							. '>'
							. '<span class="hoverex_range_slider_label hoverex_range_slider_label_min">'
								. esc_html($field_min)
							. '</span>'
							. '<span class="hoverex_range_slider_label hoverex_range_slider_label_max">'
								. esc_html($field_max)
							. '</span>';
			$values = explode(',', $field_val);
			for ($i=0; $i < count($values); $i++) {
				$output .= '<span class="hoverex_range_slider_label hoverex_range_slider_label_cur">'
								. esc_html($values[$i])
							. '</span>';
			}
			$output .= '</div>';
			break;

		case 'text_editor':
			if (function_exists('wp_enqueue_editor')) wp_enqueue_editor();
			ob_start();
			wp_editor( $value, $id, array(
				'default_editor' => 'tmce',
				'wpautop' => isset($field['wpautop']) ? $field['wpautop'] : false,
				'teeny' => isset($field['teeny']) ? $field['teeny'] : false,
				'textarea_rows' => isset($field['rows']) && $field['rows'] > 1 ? $field['rows'] : 10,
				'editor_height' => 16*(isset($field['rows']) && $field['rows'] > 1 ? (int) $field['rows'] : 10),
				'tinymce' => array(
					'resize'             => false,
					'wp_autoresize_on'   => false,
					'add_unload_trigger' => false
				)
			));
			$editor_html = ob_get_contents();
			ob_end_clean();
			$output .= '<div class="hoverex_text_editor">' . $editor_html . '</div>';
			break;

			
		case 'scheme_editor':
			if (!is_array($value)) break;
			if (empty($field['colorpicker'])) $field['colorpicker'] = 'internal';
			$output .= '<div class="hoverex_scheme_editor">';
			// Select scheme
			$output .= '<select class="hoverex_scheme_editor_selector">';
			foreach ($value as $scheme=>$v)
				$output .= '<option value="' . esc_attr($scheme) . '">' . esc_html($v['title']) . '</option>';
			$output .= '</select>';
			// Select type
			$output .= '<div class="hoverex_scheme_editor_type">'
							. '<div class="hoverex_scheme_editor_row">'
								. '<span class="hoverex_scheme_editor_row_cell">'
									. esc_html__('Editor type', 'hoverex')
								. '</span>'
								. '<span class="hoverex_scheme_editor_row_cell hoverex_scheme_editor_row_cell_span">'
									.'<label>'
										. '<input name="hoverex_scheme_editor_type" type="radio" value="simple" checked="checked"> '
										. esc_html__('Simple', 'hoverex')
									. '</label>'
									. '<label>'
										. '<input name="hoverex_scheme_editor_type" type="radio" value="advanced"> '
										. esc_html__('Advanced', 'hoverex')
									. '</label>'
								. '</span>'
							. '</div>'
						. '</div>';
			// Colors
			$groups = hoverex_storage_get('scheme_color_groups');
			$colors = hoverex_storage_get('scheme_color_names');
			$output .= '<div class="hoverex_scheme_editor_colors">';
			foreach ($value as $scheme=>$v) {
				$output .= '<div class="hoverex_scheme_editor_header">'
								. '<span class="hoverex_scheme_editor_header_cell"></span>';
				foreach ($groups as $group_name=>$group_data) {
					$output .= '<span class="hoverex_scheme_editor_header_cell" title="'.esc_html($group_data['description']).'">' 
								. esc_html($group_data['title'])
								. '</span>';
				}
				$output .= '</div>';
				foreach ($colors as $color_name=>$color_data) {
					$output .= '<div class="hoverex_scheme_editor_row">'
								. '<span class="hoverex_scheme_editor_row_cell" title="'.esc_html($color_data['description']).'">'
								. esc_html($color_data['title'])
								. '</span>';
					foreach ($groups as $group_name=>$group_data) {
						$slug = $group_name == 'main' 
									? $color_name 
									: str_replace('text_', '', "{$group_name}_{$color_name}");
						$output .= '<span class="hoverex_scheme_editor_row_cell">'
									. (isset($v['colors'][$slug])
										? "<input type=\"text\" name=\"{$slug}\" class=\"".($field['colorpicker']=='tiny' ? 'tinyColorPicker' : 'iColorPicker')."\" value=\"".esc_attr($v['colors'][$slug])."\">"
										: ''
										)
									. '</span>';
					}
					$output .= '</div>';
				}
				break;
			}
			$output .= '</div>'
					. '</div>';
			break;
	}
	return apply_filters('hoverex_filter_show_custom_field', $output, $id, $field, $value);
}



// Save options
if (!function_exists('hoverex_options_save')) {
	add_action('after_setup_theme', 'hoverex_options_save', 4);
	function hoverex_options_save() {

		if (!isset($_REQUEST['page']) || $_REQUEST['page']!='theme_options' || hoverex_get_value_gp('hoverex_nonce')=='') return;

		// verify nonce
		if ( !wp_verify_nonce( hoverex_get_value_gp('hoverex_nonce'), admin_url() ) ) {
			hoverex_add_admin_message(esc_html__('Bad security code! Options are not saved!', 'hoverex'), 'error', true);
			return;
		}

		// Check permissions
		if (!current_user_can('manage_options')) {
			hoverex_add_admin_message(esc_html__('Manage options is denied for the current user! Options are not saved!', 'hoverex'), 'error', true);
			return;
		}

		// Save options
		$options = hoverex_storage_get('options');
		$values = get_theme_mods();
		$external_storages = array();
		foreach ($options as $k=>$v) {
			// Skip non-data options - sections, info, etc.
			if (!isset($v['std'])) continue;
			// Get option value from POST
			$value = isset($_POST['hoverex_options_field_' . $k])
							? hoverex_get_value_gp('hoverex_options_field_' . $k)
							: ($v['type']=='checkbox' ? 0 : '');
			// Individual options processing
			if ($k == 'custom_logo' && !empty($value) && (int) $value == 0) {
				$value = attachment_url_to_postid(hoverex_clear_thumb_size($value));
				if (empty($value)) $value = get_theme_mod($k);
			}
			// Save to the result array
			if (!empty($v['type']) && $v['type']!='hidden' && (empty($v['hidden']) || !$v['hidden']) && $value != hoverex_get_theme_option_std($k, $v['std'])) {
				$values[$k] = $value;
			} else if (isset($values[$k])) {
				unset($values[$k]);
			}
			// External plugin's options
			if (!empty($v['options_storage'])) {
				if (!isset($external_storages[$v['options_storage']]))
					$external_storages[$v['options_storage']] = array();
				$external_storages[$v['options_storage']][$k] = $value;
			}
		}

		// Update options in the external storages
		foreach ($external_storages as $storage_name => $storage_values) {
			$storage = get_option($storage_name, false);
			if (is_array($storage)) {
				foreach ($storage_values as $k=>$v)
					$storage[$k] = $v;
				update_option($storage_name, apply_filters('hoverex_filter_options_save', $storage, $storage_name));
			}
		}

		// Update Theme Mods (internal Theme Options)
		$stylesheet_slug = get_option('stylesheet');
		update_option("theme_mods_{$stylesheet_slug}", apply_filters('hoverex_filter_options_save', $values, 'theme_mods'));

		do_action('hoverex_action_just_save_options');

		// Store new schemes colors
		if (!empty($values['scheme_storage'])) {
			$schemes = hoverex_unserialize($values['scheme_storage']);
			if (is_array($schemes) && count($schemes) > 0) 
				hoverex_storage_set('schemes', $schemes);
		}
		
		// Store new fonts parameters
		$fonts = hoverex_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				if (isset($values["{$tag}_{$css_prop}"])) $fonts[$tag][$css_prop] = $values["{$tag}_{$css_prop}"];
			}
		}
		hoverex_storage_set('theme_fonts', $fonts);

		// Update ThemeOptions save timestamp
		$stylesheet_time = time();
		update_option("hoverex_options_timestamp_{$stylesheet_slug}", $stylesheet_time);

		// Sinchronize theme options between child and parent themes
		if (hoverex_get_theme_setting('duplicate_options') == 'both') {
			$theme_slug = get_option('template');
			if ($theme_slug != $stylesheet_slug) {
				hoverex_customizer_duplicate_theme_options($stylesheet_slug, $theme_slug, $stylesheet_time);
			}
		}

		// Apply action - moved to the delayed state (see below) to load all enabled modules and apply changes after
		// Attention! Don't remove comment the line below!
		// Not need here: do_action('hoverex_action_save_options');
		update_option('hoverex_action', 'hoverex_action_save_options');

		// Return result
		hoverex_add_admin_message(esc_html__('Options are saved', 'hoverex'));
		if (!empty(wp_get_referer())) {
			wp_redirect(wp_unslash(wp_get_referer()));
			exit();
		}
	}
}


//-------------------------------------------------------
//-- Delayed action from previous session
//-- (after save options)
//-- to save new CSS, etc.
//-------------------------------------------------------
if ( !function_exists('hoverex_do_delayed_action') ) {
	add_action( 'after_setup_theme', 'hoverex_do_delayed_action' );
	function hoverex_do_delayed_action() {
		if (($action = get_option('hoverex_action')) != '') {
		    do_action($action);
			update_option('hoverex_action', '');
		}
	}
}


// Refresh data in the linked field
// according the main field value
if (!function_exists('hoverex_refresh_linked_data')) {
	function hoverex_refresh_linked_data($value, $linked_name) {
		if ($linked_name == 'parent_cat') {
			$tax = hoverex_get_post_type_taxonomy($value);
			$terms = !empty($tax) ? hoverex_get_list_terms(false, $tax) : array();
			$terms = hoverex_array_merge(array(0 => esc_html__('- Select category -', 'hoverex')), $terms);
			hoverex_storage_set_array2('options', $linked_name, 'options', $terms);
		}
	}
}


// AJAX: Refresh data in the linked fields
if (!function_exists('hoverex_callback_get_linked_data')) {
	add_action('wp_ajax_hoverex_get_linked_data', 		'hoverex_callback_get_linked_data');
	add_action('wp_ajax_nopriv_hoverex_get_linked_data','hoverex_callback_get_linked_data');
	function hoverex_callback_get_linked_data() {
		if ( !wp_verify_nonce( hoverex_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			wp_die();
		$chg_name = wp_kses_data(wp_unslash($_REQUEST['chg_name']));
		$chg_value = wp_kses_data(wp_unslash($_REQUEST['chg_value']));
		$response = array('error' => '');
		if ($chg_name == 'post_type') {
			$tax = hoverex_get_post_type_taxonomy($chg_value);
			$terms = !empty($tax) ? hoverex_get_list_terms(false, $tax) : array();
			$response['list'] = hoverex_array_merge(array(0 => esc_html__('- Select category -', 'hoverex')), $terms);
		}
		echo json_encode($response);
		wp_die();
	}
}
?>