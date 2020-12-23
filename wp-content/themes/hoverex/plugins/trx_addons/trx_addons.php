<?php
/* ThemeREX Addons support functions
------------------------------------------------------------------------------- */

// Add theme-specific functions
require_once HOVEREX_THEME_DIR . 'theme-specific/trx_addons-setup.php';

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('hoverex_trx_addons_theme_setup1')) {
	add_action( 'after_setup_theme', 'hoverex_trx_addons_theme_setup1', 1 );
	function hoverex_trx_addons_theme_setup1() {
		if (hoverex_exists_trx_addons()) {
			add_filter( 'hoverex_filter_list_posts_types',			'hoverex_trx_addons_list_post_types');
			add_filter( 'hoverex_filter_list_header_footer_types',	'hoverex_trx_addons_list_header_footer_types');
			add_filter( 'hoverex_filter_list_header_styles',		'hoverex_trx_addons_list_header_styles');
			add_filter( 'hoverex_filter_list_footer_styles',		'hoverex_trx_addons_list_footer_styles');
			add_action( 'hoverex_action_load_options',				'hoverex_trx_addons_add_link_edit_layout');
			add_filter( 'trx_addons_filter_default_layouts',		'hoverex_trx_addons_default_layouts');
			add_filter( 'trx_addons_filter_load_options',			'hoverex_trx_addons_default_components');
			add_filter( 'trx_addons_cpt_list_options',				'hoverex_trx_addons_cpt_list_options', 10, 2);
			add_filter( 'trx_addons_filter_sass_import',			'hoverex_trx_addons_sass_import', 10, 2);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('hoverex_trx_addons_theme_setup9')) {
	add_action( 'after_setup_theme', 'hoverex_trx_addons_theme_setup9', 9 );
	function hoverex_trx_addons_theme_setup9() {
		if (hoverex_exists_trx_addons()) {
			add_filter( 'trx_addons_filter_add_thumb_sizes',			'hoverex_trx_addons_add_thumb_sizes');
			add_filter( 'trx_addons_filter_get_thumb_size',				'hoverex_trx_addons_get_thumb_size');
			add_filter( 'trx_addons_filter_featured_image',				'hoverex_trx_addons_featured_image', 10, 2);
			add_filter( 'trx_addons_filter_no_image',					'hoverex_trx_addons_no_image' );
			add_filter( 'trx_addons_filter_get_list_icons',				'hoverex_trx_addons_get_list_icons', 10, 2 );
			add_action( 'wp_enqueue_scripts', 							'hoverex_trx_addons_frontend_scripts', 1100 );
			add_filter( 'hoverex_filter_query_sort_order',	 			'hoverex_trx_addons_query_sort_order', 10, 3);
			add_filter( 'hoverex_filter_merge_scripts',					'hoverex_trx_addons_merge_scripts');
			add_filter( 'hoverex_filter_prepare_css',					'hoverex_trx_addons_prepare_css', 10, 2);
			add_filter( 'hoverex_filter_prepare_js',					'hoverex_trx_addons_prepare_js', 10, 2);
			add_filter( 'hoverex_filter_localize_script',				'hoverex_trx_addons_localize_script');
			add_filter( 'hoverex_filter_get_post_categories',		 	'hoverex_trx_addons_get_post_categories');
			add_filter( 'hoverex_filter_get_post_date',		 			'hoverex_trx_addons_get_post_date');
			add_filter( 'trx_addons_filter_get_post_date',		 		'hoverex_trx_addons_get_post_date_wrap');
			add_filter( 'hoverex_filter_post_type_taxonomy',			'hoverex_trx_addons_post_type_taxonomy', 10, 2 );
			add_filter( 'trx_addons_filter_theme_logo',					'hoverex_trx_addons_theme_logo');
			add_filter( 'trx_addons_filter_show_site_name_as_logo',		'hoverex_trx_addons_show_site_name_as_logo');
			add_filter( 'trx_addons_filter_post_meta',					'hoverex_trx_addons_post_meta', 10, 2);
			if (is_admin()) {
				add_filter( 'hoverex_filter_allow_override', 			'hoverex_trx_addons_allow_override', 10, 2);
				add_filter( 'hoverex_filter_allow_theme_icons', 		'hoverex_trx_addons_allow_theme_icons', 10, 2);
				add_filter( 'trx_addons_filter_export_options',			'hoverex_trx_addons_export_options');
			} else {
				add_filter( 'trx_addons_filter_inc_views',		 		'hoverex_trx_addons_inc_views');
				add_filter( 'hoverex_filter_post_meta_args',			'hoverex_trx_addons_post_meta_args', 10, 3);
				add_filter( 'trx_addons_filter_args_related',			'hoverex_trx_addons_args_related');
				add_filter( 'trx_addons_filter_seo_snippets',			'hoverex_trx_addons_seo_snippets');
				add_action( 'trx_addons_action_before_article',			'hoverex_trx_addons_before_article', 10, 1);
				add_filter( 'hoverex_filter_get_mobile_menu',			'hoverex_trx_addons_get_mobile_menu');
				add_filter( 'hoverex_filter_detect_blog_mode',			'hoverex_trx_addons_detect_blog_mode' );
				add_filter( 'hoverex_filter_get_blog_title', 			'hoverex_trx_addons_get_blog_title');
				add_action( 'hoverex_action_login',						'hoverex_trx_addons_action_login');
				add_action( 'hoverex_action_cart',						'hoverex_trx_addons_action_cart');
				add_action( 'hoverex_action_breadcrumbs',				'hoverex_trx_addons_action_breadcrumbs');
				add_action( 'hoverex_action_show_layout',				'hoverex_trx_addons_action_show_layout', 10, 1);
				add_filter( 'hoverex_filter_get_translated_layout',		'hoverex_trx_addons_filter_get_translated_layout', 10, 1);
				add_filter( 'trx_addons_filter_sc_layout_content',		'hoverex_trx_addons_replace_current_year', 20, 2 );
				add_action( 'hoverex_action_user_meta',					'hoverex_trx_addons_action_user_meta');
				add_action( 'hoverex_action_before_post_meta',			'hoverex_trx_addons_action_before_post_meta'); 
				add_filter( 'trx_addons_filter_featured_image_override','hoverex_trx_addons_featured_image_override');
				add_filter( 'trx_addons_filter_get_current_mode_image',	'hoverex_trx_addons_get_current_mode_image');
				add_filter( 'hoverex_filter_related_thumb_size',		'hoverex_trx_addons_related_thumb_size');
			}
		}
		
		// Add this filter any time: if plugin exists - load plugin's styles, if not exists - load layouts.scss instead plugin's styles
		add_action( 'wp_enqueue_scripts', 								'hoverex_trx_addons_layouts_styles' );
		add_filter( 'hoverex_filter_merge_styles',						'hoverex_trx_addons_merge_styles');
		add_filter( 'hoverex_filter_merge_styles_responsive',			'hoverex_trx_addons_merge_styles_responsive');
		
		if (is_admin()) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins',		'hoverex_trx_addons_tgmpa_required_plugins' );
		} else {
			add_action( 'hoverex_action_search',						'hoverex_trx_addons_action_search', 10, 3);
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'hoverex_trx_addons_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('hoverex_filter_tgmpa_required_plugins', 'hoverex_trx_addons_tgmpa_required_plugins');
	function hoverex_trx_addons_tgmpa_required_plugins($list=array()) {
		if (hoverex_storage_isset('required_plugins', 'trx_addons')) {
			$path = hoverex_get_file_dir('plugins/trx_addons/trx_addons.zip');
			if (!empty($path) || hoverex_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> hoverex_storage_get_array('required_plugins', 'trx_addons'),
					'slug' 		=> 'trx_addons',
					'version'	=> '1.6.41.5',
					'source'	=> !empty($path) ? $path : 'upload://trx_addons.zip',
					'required' 	=> true
				);
			}
		}
		return $list;
	}
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

if (!function_exists('hoverex_trx_addons_cpt_list_options')) {
	// Handler of the add_filter( 'trx_addons_cpt_list_options', 'hoverex_trx_addons_cpt_list_options', 10, 2);
	function hoverex_trx_addons_cpt_list_options($options, $cpt) {
		if ($cpt == 'layouts' && HOVEREX_THEME_FREE) {
			$options = array();
		} else if (is_array($options)) {
			foreach ($options as $k=>$v) {
				// Store this option in the external (not theme's) storage
				$options[$k]['options_storage'] = 'trx_addons_options';
				// Hide this option from plugin's options (only for overriden options)
				$options[$k]['hidden'] = in_array($cpt, array('cars', 'cars_agents', 'certificates', 'courses', 'dishes', 'portfolio', 'properties', 'agents', 'resume', 'services', 'sport', 'team', 'testimonials'));
			}
		}
		return $options;
	}
}

// Return plugin's specific options for CPT
if (!function_exists('hoverex_trx_addons_get_list_cpt_options')) {
	function hoverex_trx_addons_get_list_cpt_options($cpt) {
		$options = array();
		if ($cpt == 'cars')
			$options = array_merge(
						trx_addons_cpt_cars_get_list_options(),
						trx_addons_cpt_cars_agents_get_list_options()
						);
		else if ($cpt == 'certificates')
			$options = trx_addons_cpt_certificates_get_list_options();
		else if ($cpt == 'courses')
			$options = trx_addons_cpt_courses_get_list_options();
		else if ($cpt == 'dishes')
			$options = trx_addons_cpt_dishes_get_list_options();
		else if ($cpt == 'portfolio')
			$options = trx_addons_cpt_portfolio_get_list_options();
		else if ($cpt == 'resume')
			$options = trx_addons_cpt_resume_get_list_options();
		else if ($cpt == 'services')
			$options = trx_addons_cpt_services_get_list_options();
		else if ($cpt == 'properties')
			$options = array_merge(
						trx_addons_cpt_properties_get_list_options(),
						trx_addons_cpt_agents_get_list_options()
						);
		else if ($cpt == 'sport')
			$options = trx_addons_cpt_sport_get_list_options();
		else if ($cpt == 'team')
			$options = trx_addons_cpt_team_get_list_options();
		else if ($cpt == 'testimonials')
			$options = trx_addons_cpt_testimonials_get_list_options();

		foreach ($options as $k=>$v) {
			// Disable refresh the preview area on change any plugin's option
			$options[$k]['refresh'] = false;
			// Remove parameter 'hidden'
			if (!empty($v['hidden']))
				unset($options[$k]['hidden']);
			// Add description
			if ($v['type'] == 'info')
				$options[$k]['desc'] = wp_kses_data(__('In order to see changes made by settings of this section, click "Save" and refresh the page', 'hoverex'));
		}
		return $options;
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('hoverex_trx_addons_setup3')) {
	add_action( 'after_setup_theme', 'hoverex_trx_addons_setup3', 3 );
	function hoverex_trx_addons_setup3() {
		
		// Section 'Cars' - settings to show 'Cars' blog archive and single posts
		if (hoverex_exists_cars()) {
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'cars' => array(
						"title" => esc_html__('Cars', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the cars pages.', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('cars'),
				hoverex_options_get_list_cpt_options('cars'),
				array(
					"single_info_cars" => array(
						"title" => esc_html__('Single car', 'hoverex'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_cars' => array(
						"title" => esc_html__('Show related posts', 'hoverex'),
						"desc" => wp_kses_data( __("Show section 'Related cars' on the single car page", 'hoverex') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_cars' => array(
						"title" => esc_html__('Related cars', 'hoverex'),
						"desc" => wp_kses_data( __('How many related cars should be displayed on the single car page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_cars' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_cars' => array(
						"title" => esc_html__('Related columns', 'hoverex'),
						"desc" => wp_kses_data( __('How many columns should be used to output related cars on the single car page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_cars' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Certificates'
		if (hoverex_exists_certificates()) {
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'certificates' => array(
						"title" => esc_html__('Certificates', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display "Certificates"', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('certificates')
			));
		}
		
		// Section 'Courses' - settings to show 'Courses' blog archive and single posts
		if (hoverex_exists_courses()) {
		
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'courses' => array(
						"title" => esc_html__('Courses', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('courses'),
				hoverex_options_get_list_cpt_options('courses'),
				array(
					"single_info_courses" => array(
						"title" => esc_html__('Single course', 'hoverex'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_courses' => array(
						"title" => esc_html__('Show related posts', 'hoverex'),
						"desc" => wp_kses_data( __("Show section 'Related courses' on the single course page", 'hoverex') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_courses' => array(
						"title" => esc_html__('Related courses', 'hoverex'),
						"desc" => wp_kses_data( __('How many related courses should be displayed on the single course page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_courses' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_courses' => array(
						"title" => esc_html__('Related columns', 'hoverex'),
						"desc" => wp_kses_data( __('How many columns should be used to output related courses on the single course page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_courses' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Dishes' - settings to show 'Dishes' blog archive and single posts
		if (hoverex_exists_dishes()) {

			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'dishes' => array(
						"title" => esc_html__('Dishes', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the dishes pages', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('dishes'),
				hoverex_options_get_list_cpt_options('dishes'),
				array(
					"single_info_dishes" => array(
						"title" => esc_html__('Single dish', 'hoverex'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_dishes' => array(
						"title" => esc_html__('Show related posts', 'hoverex'),
						"desc" => wp_kses_data( __("Show section 'Related dishes' on the single dish page", 'hoverex') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_dishes' => array(
						"title" => esc_html__('Related dishes', 'hoverex'),
						"desc" => wp_kses_data( __('How many related dishes should be displayed on the single dish page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_dishes' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_dishes' => array(
						"title" => esc_html__('Related columns', 'hoverex'),
						"desc" => wp_kses_data( __('How many columns should be used to output related dishes on the single dish page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_dishes' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,4),
						"type" => "select"
						)
					)
				)
			);
		}
		
		// Section 'Portfolio' - settings to show 'Portfolio' blog archive and single posts
		if (hoverex_exists_portfolio()) {
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'portfolio' => array(
						"title" => esc_html__('Portfolio', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the portfolio pages', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('portfolio'),
				hoverex_options_get_list_cpt_options('portfolio'),
				array(
					"single_info_portfolio" => array(
						"title" => esc_html__('Single portfolio item', 'hoverex'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_portfolio' => array(
						"title" => esc_html__('Show related posts', 'hoverex'),
						"desc" => wp_kses_data( __("Show section 'Related portfolio items' on the single portfolio page", 'hoverex') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_portfolio' => array(
						"title" => esc_html__('Related portfolio items', 'hoverex'),
						"desc" => wp_kses_data( __('How many related portfolio items should be displayed on the single portfolio page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_portfolio' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_portfolio' => array(
						"title" => esc_html__('Related columns', 'hoverex'),
						"desc" => wp_kses_data( __('How many columns should be used to output related portfolio on the single portfolio page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_portfolio' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Properties' - settings to show 'Properties' blog archive and single posts
		if (hoverex_exists_properties()) {
		
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'properties' => array(
						"title" => esc_html__('Properties', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the properties pages', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('properties'),
				hoverex_options_get_list_cpt_options('properties'),
				array(
					"single_info_properties" => array(
						"title" => esc_html__('Single property', 'hoverex'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_properties' => array(
						"title" => esc_html__('Show related posts', 'hoverex'),
						"desc" => wp_kses_data( __("Show section 'Related properties' on the single property page", 'hoverex') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_properties' => array(
						"title" => esc_html__('Related properties', 'hoverex'),
						"desc" => wp_kses_data( __('How many related properties should be displayed on the single property page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_properties' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_properties' => array(
						"title" => esc_html__('Related columns', 'hoverex'),
						"desc" => wp_kses_data( __('How many columns should be used to output related properties on the single property page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_properties' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,4),
						"type" => "select"
						)
					)
				)
			);
		}
		
		// Section 'Resume'
		if (hoverex_exists_resume()) {
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'resume' => array(
						"title" => esc_html__('Resume', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display "Resume"', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('resume')
			));
		}
		
		// Section 'Services' - settings to show 'Services' blog archive and single posts
		if (hoverex_exists_services()) {
		
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'services' => array(
						"title" => esc_html__('Services', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the services pages', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('services'),
				hoverex_options_get_list_cpt_options('services'),
				array(
					"single_info_services" => array(
						"title" => esc_html__('Single service item', 'hoverex'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_services' => array(
						"title" => esc_html__('Show related posts', 'hoverex'),
						"desc" => wp_kses_data( __("Show section 'Related services' on the single service page", 'hoverex') ),
						"std" => 0,
						"type" => "checkbox"
						),
					'related_posts_services' => array(
						"title" => esc_html__('Related services', 'hoverex'),
						"desc" => wp_kses_data( __('How many related services should be displayed on the single service page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_services' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_services' => array(
						"title" => esc_html__('Related columns', 'hoverex'),
						"desc" => wp_kses_data( __('How many columns should be used to output related services on the single service page?', 'hoverex') ),
						"dependency" => array(
							'show_related_posts_services' => array(1)
						),
						"std" => 3,
						"options" => hoverex_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Sport' - settings to show 'Sport' blog archive and single posts
		if (hoverex_exists_sport()) {
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'sport' => array(
						"title" => esc_html__('Sport', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the sport pages', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('sport'),
				hoverex_options_get_list_cpt_options('sport')
			));
		}
		
		// Section 'Team' - settings to show 'Team' blog archive and single posts
		if (hoverex_exists_team()) {
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'team' => array(
						"title" => esc_html__('Team', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display the team members pages.', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('team'),
				hoverex_options_get_list_cpt_options('team')
			));
		}
		
		// Section 'Testimonials'
		if (hoverex_exists_resume()) {
			hoverex_storage_merge_array('options', '', array_merge(
				array(
					'testimonials' => array(
						"title" => esc_html__('Testimonials', 'hoverex'),
						"desc" => wp_kses_data( __('Select parameters to display "Testimonials"', 'hoverex') ),
						"type" => "section"
						)
				),
				hoverex_trx_addons_get_list_cpt_options('testimonials')
			));
		}
	}
}

// Add 'layout edit' link to the 'description' in the 'header_style' and 'footer_style' parameters
if ( !function_exists('hoverex_trx_addons_add_link_edit_layout') ) {
	//Handler of the add_action( 'hoverex_action_load_options', 'hoverex_trx_addons_add_link_edit_layout');
	function hoverex_trx_addons_add_link_edit_layout() {
		static $added = false;
		if ($added) return;
		$added = true;
		$options = hoverex_storage_get('options');
		foreach($options as $k=>$v) {
			if (!isset($v['std'])) continue;
			$k1 = substr($k, 0, 12);
			if ($k1=='header_style' || $k1=='footer_style') {
				$layout = hoverex_get_theme_option($k);
				if (hoverex_is_inherit($layout))
					$layout = hoverex_get_theme_option($k1);
				if (!empty($layout)) {
					$layout = explode('-', $layout);
					$layout = $layout[count($layout)-1];
					if ($layout > 0) {
						hoverex_storage_set_array2('options', $k, 'desc', $v['desc']
												. '<br>'
												. sprintf('<a href="%1$s" class="hoverex_post_editor'.(intval($layout)==0 ? ' hoverex_hidden' : '').'" target="_blank">%2$s</a>',
															admin_url( sprintf( "post.php?post=%d&amp;action=edit", $layout ) ),
															__("Open selected layout in a new tab to edit", 'hoverex')
														)
												);
					}
				}
			}
		}
	}
}


// Setup internal plugin's parameters
if (!function_exists('hoverex_trx_addons_init_settings')) {
	add_filter( 'trx_addons_init_settings', 'hoverex_trx_addons_init_settings');
	function hoverex_trx_addons_init_settings($settings) {
		$settings['socials_type']	= hoverex_get_theme_setting('socials_type');
		$settings['icons_type']		= hoverex_get_theme_setting('icons_type');
		$settings['icons_selector']	= hoverex_get_theme_setting('icons_selector');
		return $settings;
	}
}



/* Plugin's support utilities
------------------------------------------------------------------------------- */

// Check if plugin installed and activated
if ( !function_exists( 'hoverex_exists_trx_addons' ) ) {
	function hoverex_exists_trx_addons() {
		return defined('TRX_ADDONS_VERSION');
	}
}

// Return true if cars is supported
if ( !function_exists( 'hoverex_exists_cars' ) ) {
	function hoverex_exists_cars() {
		return defined('TRX_ADDONS_CPT_CARS_PT');
	}
}

// Return true if certificates is supported
if ( !function_exists( 'hoverex_exists_certificates' ) ) {
	function hoverex_exists_certificates() {
		return defined('TRX_ADDONS_CPT_CERTIFICATES_PT');
	}
}

// Return true if courses is supported
if ( !function_exists( 'hoverex_exists_courses' ) ) {
	function hoverex_exists_courses() {
		return defined('TRX_ADDONS_CPT_COURSES_PT');
	}
}

// Return true if dishes is supported
if ( !function_exists( 'hoverex_exists_dishes' ) ) {
	function hoverex_exists_dishes() {
		return defined('TRX_ADDONS_CPT_DISHES_PT');
	}
}

// Return true if layouts is supported
if ( !function_exists( 'hoverex_exists_layouts' ) ) {
	function hoverex_exists_layouts() {
		return defined('TRX_ADDONS_CPT_LAYOUTS_PT');
	}
}

// Return true if portfolio is supported
if ( !function_exists( 'hoverex_exists_portfolio' ) ) {
	function hoverex_exists_portfolio() {
		return defined('TRX_ADDONS_CPT_PORTFOLIO_PT');
	}
}

// Return true if properties is supported
if ( !function_exists( 'hoverex_exists_properties' ) ) {
	function hoverex_exists_properties() {
		return defined('TRX_ADDONS_CPT_PROPERTIES_PT');
	}
}

// Return true if resume is supported
if ( !function_exists( 'hoverex_exists_resume' ) ) {
	function hoverex_exists_resume() {
		return defined('TRX_ADDONS_CPT_RESUME_PT');
	}
}

// Return true if services is supported
if ( !function_exists( 'hoverex_exists_services' ) ) {
	function hoverex_exists_services() {
		return defined('TRX_ADDONS_CPT_SERVICES_PT');
	}
}

// Return true if sport is supported
if ( !function_exists( 'hoverex_exists_sport' ) ) {
	function hoverex_exists_sport() {
		return defined('TRX_ADDONS_CPT_COMPETITIONS_PT');
	}
}

// Return true if team is supported
if ( !function_exists( 'hoverex_exists_team' ) ) {
	function hoverex_exists_team() {
		return defined('TRX_ADDONS_CPT_TEAM_PT');
	}
}

// Return true if testimonials is supported
if ( !function_exists( 'hoverex_exists_testimonials' ) ) {
	function hoverex_exists_testimonials() {
		return defined('TRX_ADDONS_CPT_TESTIMONIALS_PT');
	}
}


// Return true if it's cars page
if ( !function_exists( 'hoverex_is_cars_page' ) ) {
	function hoverex_is_cars_page() {
		return function_exists('trx_addons_is_cars_page') && trx_addons_is_cars_page();
	}
}

// Return true if it's courses page
if ( !function_exists( 'hoverex_is_courses_page' ) ) {
	function hoverex_is_courses_page() {
		return function_exists('trx_addons_is_courses_page') && trx_addons_is_courses_page();
	}
}

// Return true if it's dishes page
if ( !function_exists( 'hoverex_is_dishes_page' ) ) {
	function hoverex_is_dishes_page() {
		return function_exists('trx_addons_is_dishes_page') && trx_addons_is_dishes_page();
	}
}

// Return true if it's properties page
if ( !function_exists( 'hoverex_is_properties_page' ) ) {
	function hoverex_is_properties_page() {
		return function_exists('trx_addons_is_properties_page') && trx_addons_is_properties_page();
	}
}

// Return true if it's portfolio page
if ( !function_exists( 'hoverex_is_portfolio_page' ) ) {
	function hoverex_is_portfolio_page() {
		return function_exists('trx_addons_is_portfolio_page') && trx_addons_is_portfolio_page();
	}
}

// Return true if it's services page
if ( !function_exists( 'hoverex_is_services_page' ) ) {
	function hoverex_is_services_page() {
		return function_exists('trx_addons_is_services_page') && trx_addons_is_services_page();
	}
}

// Return true if it's team page
if ( !function_exists( 'hoverex_is_team_page' ) ) {
	function hoverex_is_team_page() {
		return function_exists('trx_addons_is_team_page') && trx_addons_is_team_page();
	}
}

// Return true if it's sport page
if ( !function_exists( 'hoverex_is_sport_page' ) ) {
	function hoverex_is_sport_page() {
		return function_exists('trx_addons_is_sport_page') && trx_addons_is_sport_page();
	}
}

// Return true if custom layouts are available
if ( !function_exists( 'hoverex_is_layouts_available' ) ) {
	function hoverex_is_layouts_available() {
		return hoverex_exists_trx_addons() 
										&& (
											function_exists('hoverex_exists_sop') && hoverex_exists_sop()
											||
											function_exists('hoverex_exists_visual_composer') && hoverex_exists_visual_composer()
											);
	}
}

// Detect current blog mode
if ( !function_exists( 'hoverex_trx_addons_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'hoverex_filter_detect_blog_mode', 'hoverex_trx_addons_detect_blog_mode' );
	function hoverex_trx_addons_detect_blog_mode($mode='') {
		if ( hoverex_is_cars_page() )
			$mode = 'cars';
		else if ( hoverex_is_courses_page() )
			$mode = 'courses';
		else if ( hoverex_is_dishes_page() )
			$mode = 'dishes';
		else if ( hoverex_is_properties_page() )
			$mode = 'properties';
		else if ( hoverex_is_portfolio_page() )
			$mode = 'portfolio';
		else if ( hoverex_is_services_page() )
			$mode = 'services';
		else if ( hoverex_is_sport_page() )
			$mode = 'sport';
		else if ( hoverex_is_team_page() )
			$mode = 'team';
		return $mode;
	}
}

// Disallow increment views counter on the blog archive
if ( !function_exists( 'hoverex_trx_addons_inc_views' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_inc_views', 'hoverex_trx_addons_inc_views');
	function hoverex_trx_addons_inc_views($allow=false) {
		return $allow && is_page() && hoverex_storage_isset('blog_archive') ? false : $allow;
	}
}

// Add team, courses, etc. to the supported posts list
if ( !function_exists( 'hoverex_trx_addons_list_post_types' ) ) {
	//Handler of the add_filter( 'hoverex_filter_list_posts_types', 'hoverex_trx_addons_list_post_types');
	function hoverex_trx_addons_list_post_types($list=array()) {
		if (function_exists('trx_addons_get_cpt_list')) {
			$cpt_list = trx_addons_get_cpt_list();
			foreach ($cpt_list as $cpt => $title) {
				if (   
					   (defined('TRX_ADDONS_CPT_CARS_PT') && $cpt == TRX_ADDONS_CPT_CARS_PT)
					|| (defined('TRX_ADDONS_CPT_COURSES_PT') && $cpt == TRX_ADDONS_CPT_COURSES_PT)
					|| (defined('TRX_ADDONS_CPT_DISHES_PT') && $cpt == TRX_ADDONS_CPT_DISHES_PT)
					|| (defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $cpt == TRX_ADDONS_CPT_PORTFOLIO_PT)
					|| (defined('TRX_ADDONS_CPT_PROPERTIES_PT') && $cpt == TRX_ADDONS_CPT_PROPERTIES_PT)
					|| (defined('TRX_ADDONS_CPT_SERVICES_PT') && $cpt == TRX_ADDONS_CPT_SERVICES_PT)
					|| (defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && $cpt == TRX_ADDONS_CPT_COMPETITIONS_PT)
					|| (defined('TRX_ADDONS_CPT_TEAM_PT') && $cpt == TRX_ADDONS_CPT_TEAM_PT)
					)
					$list[$cpt] = $title;
			}
		}
		return $list;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'hoverex_trx_addons_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'hoverex_filter_post_type_taxonomy',	'hoverex_trx_addons_post_type_taxonomy', 10, 2 );
	function hoverex_trx_addons_post_type_taxonomy($tax='', $post_type='') {
		if ( defined('TRX_ADDONS_CPT_CARS_PT') && $post_type == TRX_ADDONS_CPT_CARS_PT )
			$tax = TRX_ADDONS_CPT_CARS_TAXONOMY_MAKER;
		else if ( defined('TRX_ADDONS_CPT_COURSES_PT') && $post_type == TRX_ADDONS_CPT_COURSES_PT )
			$tax = TRX_ADDONS_CPT_COURSES_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_DISHES_PT') && $post_type == TRX_ADDONS_CPT_DISHES_PT )
			$tax = TRX_ADDONS_CPT_DISHES_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $post_type == TRX_ADDONS_CPT_PORTFOLIO_PT )
			$tax = TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_PROPERTIES_PT') && $post_type == TRX_ADDONS_CPT_PROPERTIES_PT )
			$tax = TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE;
		else if ( defined('TRX_ADDONS_CPT_SERVICES_PT') && $post_type == TRX_ADDONS_CPT_SERVICES_PT )
			$tax = TRX_ADDONS_CPT_SERVICES_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && $post_type == TRX_ADDONS_CPT_COMPETITIONS_PT )
			$tax = TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type == TRX_ADDONS_CPT_TEAM_PT )
			$tax = TRX_ADDONS_CPT_TEAM_TAXONOMY;
		return $tax;
	}
}

// Show categories of the team, courses, etc.
if ( !function_exists( 'hoverex_trx_addons_get_post_categories' ) ) {
	//Handler of the add_filter( 'hoverex_filter_get_post_categories', 		'hoverex_trx_addons_get_post_categories');
	function hoverex_trx_addons_get_post_categories($cats='') {

		if ( defined('TRX_ADDONS_CPT_CARS_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_CARS_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_CARS_TAXONOMY_TYPE);
			}
		}
		if ( defined('TRX_ADDONS_CPT_COURSES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_COURSES_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_COURSES_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_DISHES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_DISHES_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_DISHES_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_PORTFOLIO_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_PORTFOLIO_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_PROPERTIES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_PROPERTIES_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE);
			}
		}
		if ( defined('TRX_ADDONS_CPT_SERVICES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_SERVICES_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_SERVICES_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_COMPETITIONS_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_TEAM_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_TEAM_PT) {
				$cats = hoverex_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_TEAM_TAXONOMY);
			}
		}
		return $cats;
	}
}

// Show post's date with the theme-specific format
if ( !function_exists( 'hoverex_trx_addons_get_post_date_wrap' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_post_date', 'hoverex_trx_addons_get_post_date_wrap');
	function hoverex_trx_addons_get_post_date_wrap($dt='') {
		return apply_filters('hoverex_filter_get_post_date', $dt);
	}
}

// Show date of the courses
if ( !function_exists( 'hoverex_trx_addons_get_post_date' ) ) {
	//Handler of the add_filter( 'hoverex_filter_get_post_date', 'hoverex_trx_addons_get_post_date');
	function hoverex_trx_addons_get_post_date($dt='') {

		if ( defined('TRX_ADDONS_CPT_COURSES_PT') && get_post_type()==TRX_ADDONS_CPT_COURSES_PT) {
			$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
			$dt = $meta['date'];
			// Translators: Add formatted date to the output
			$dt = sprintf($dt < date('Y-m-d') ? esc_html__('Started on %s', 'hoverex') : esc_html__('Starting %s', 'hoverex'), 
					date_i18n(get_option('date_format'), strtotime($dt)));

		} else if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && in_array(get_post_type(), array(TRX_ADDONS_CPT_COMPETITIONS_PT, TRX_ADDONS_CPT_ROUNDS_PT, TRX_ADDONS_CPT_MATCHES_PT))) {
			$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
			$dt = $meta['date_start'];
			// Translators: Add formatted date to the output
			$dt = sprintf($dt < date('Y-m-d').(!empty($meta['time_start']) ? ' H:i' : '') ? esc_html__('Started on %s', 'hoverex') : esc_html__('Starting %s', 'hoverex'), 
					date_i18n(get_option('date_format') . (!empty($meta['time_start']) ? ' '.get_option('time_format') : ''), strtotime($dt.(!empty($meta['time_start']) ? ' '.trim($meta['time_start']) : ''))));

		} else if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && get_post_type() == TRX_ADDONS_CPT_PLAYERS_PT) {
			// Uncomment (remove) next line if you want to show player's birthday in the page title block
			if (false) {
				$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
				// Translators: Add formatted date to the output
				$dt = !empty($meta['birthday']) ? sprintf(esc_html__('Birthday: %s', 'hoverex'), date_i18n(get_option('date_format'), strtotime($meta['birthday']))) : '';
			} else
				$dt = '';
		}
		return $dt;
	}
}

// Check if options override is allowed
if (!function_exists('hoverex_trx_addons_allow_override')) {
	function hoverex_trx_addons_allow_override($allow, $post_type) {
		return $allow
					|| (defined('TRX_ADDONS_CPT_CARS_PT') && in_array($post_type, array(
																				TRX_ADDONS_CPT_CARS_PT,
																				TRX_ADDONS_CPT_CARS_AGENTS_PT
																				)))
					|| (defined('TRX_ADDONS_CPT_COURSES_PT') && $post_type==TRX_ADDONS_CPT_COURSES_PT)
					|| (defined('TRX_ADDONS_CPT_DISHES_PT') && $post_type==TRX_ADDONS_CPT_DISHES_PT)
					|| (defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $post_type==TRX_ADDONS_CPT_PORTFOLIO_PT) 
					|| (defined('TRX_ADDONS_CPT_PROPERTIES_PT') && in_array($post_type, array(
																				TRX_ADDONS_CPT_PROPERTIES_PT,
																				TRX_ADDONS_CPT_AGENTS_PT
																				)))
					|| (defined('TRX_ADDONS_CPT_RESUME_PT') && $post_type==TRX_ADDONS_CPT_RESUME_PT) 
					|| (defined('TRX_ADDONS_CPT_SERVICES_PT') && $post_type==TRX_ADDONS_CPT_SERVICES_PT) 
					|| (defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && in_array($post_type, array(
																				TRX_ADDONS_CPT_COMPETITIONS_PT,
																				TRX_ADDONS_CPT_ROUNDS_PT,
																				TRX_ADDONS_CPT_MATCHES_PT
																				)))
					|| (defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type==TRX_ADDONS_CPT_TEAM_PT);
	}
}

// Check if theme icons is allowed
if (!function_exists('hoverex_trx_addons_allow_theme_icons')) {
	//Handler of the add_filter( 'hoverex_filter_allow_theme_icons', 'hoverex_trx_addons_allow_theme_icons', 10, 2);
	function hoverex_trx_addons_allow_theme_icons($allow, $post_type) {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		return $allow
					|| (defined('TRX_ADDONS_CPT_LAYOUTS_PT') && $post_type==TRX_ADDONS_CPT_LAYOUTS_PT)
					|| (!empty($screen->id) && in_array($screen->id, array(
																		'appearance_page_trx_addons_options',
																		'profile'
																	)
														)
						);
	}
}

// Disable theme-specific fields in the exported options
if (!function_exists('hoverex_trx_addons_export_options')) {
	//Handler of the add_filter( 'trx_addons_filter_export_options', 'hoverex_trx_addons_export_options');
	function hoverex_trx_addons_export_options($options) {
		// ThemeREX Addons
		if (!empty($options['trx_addons_options'])) {
			$options['trx_addons_options']['debug_mode'] = 0;
			$options['trx_addons_options']['api_google'] = '';
			$options['trx_addons_options']['api_google_analitics'] = '';
			$options['trx_addons_options']['api_google_remarketing'] = '';
			$options['trx_addons_options']['demo_enable'] = 0;
			$options['trx_addons_options']['demo_referer'] = '';
			$options['trx_addons_options']['demo_default_url'] = '';
			$options['trx_addons_options']['demo_logo'] = '';
			$options['trx_addons_options']['demo_post_type'] = '';
			$options['trx_addons_options']['demo_taxonomy'] = '';
			$options['trx_addons_options']['demo_logo'] = '';
			$options['trx_addons_options']['demo_logo'] = '';
			unset($options['trx_addons_options']['themes_market_referals']);
		}
		// ThemeREX Donations
		if (!empty($options['trx_donations_options'])) {
			$options['trx_donations_options']['pp_account'] = '';
		}
		// WooCommerce
		if (!empty($options['woocommerce_paypal_settings'])) {
			$options['woocommerce_paypal_settings']['email'] = '';
			$options['woocommerce_paypal_settings']['receiver_email'] = '';
			$options['woocommerce_paypal_settings']['identity_token'] = '';
		}
		return $options;		
	}
}

// Set related posts and columns for the plugin's output
if (!function_exists('hoverex_trx_addons_args_related')) {
	//Handler of the add_filter( 'trx_addons_filter_args_related', 'hoverex_trx_addons_args_related');
	function hoverex_trx_addons_args_related($args) {
		if (!empty($args['template_args_name']) 
			&& in_array($args['template_args_name'], 
				array('trx_addons_args_sc_cars', 
					  'trx_addons_args_sc_courses',
					  'trx_addons_args_sc_dishes',
					  'trx_addons_args_sc_portfolio',
					  'trx_addons_args_sc_properties',
  					  'trx_addons_args_sc_services'))) {
			$args['posts_per_page'] = (int) hoverex_get_theme_option('show_related_posts')
												? hoverex_get_theme_option('related_posts')
												: 0;
			$args['columns'] = hoverex_get_theme_option('related_columns');
		}
		return $args;
	}
}
// Add 'custom' to the headers types list
if ( !function_exists( 'hoverex_trx_addons_list_header_footer_types' ) ) {
	//Handler of the add_filter( 'hoverex_filter_list_header_footer_types', 'hoverex_trx_addons_list_header_footer_types');
	function hoverex_trx_addons_list_header_footer_types($list=array()) {
		if (hoverex_exists_layouts()) {
			$list['custom'] = esc_html__('Custom', 'hoverex');
		}
		return $list;
	}
}

// Add layouts to the headers list
if ( !function_exists( 'hoverex_trx_addons_list_header_styles' ) ) {
	//Handler of the add_filter( 'hoverex_filter_list_header_styles', 'hoverex_trx_addons_list_header_styles');
	function hoverex_trx_addons_list_header_styles($list=array()) {
		if (hoverex_exists_layouts()) {
			$layouts = hoverex_get_list_posts(false, array(
							'post_type' => TRX_ADDONS_CPT_LAYOUTS_PT,
							'meta_key' => 'trx_addons_layout_type',
							'meta_value' => 'header',
							'orderby' => 'ID',
							'order' => 'asc',
							'not_selected' => false
							)
						);
			$new_list = array();
			foreach ($layouts as $id=>$title) {
				if ($id != 'none') $new_list['header-custom-'.intval($id)] = $title;
			}
			$list = hoverex_array_merge($new_list, $list);
		}
		return $list;
	}
}

// Add layouts to the footers list
if ( !function_exists( 'hoverex_trx_addons_list_footer_styles' ) ) {
	//Handler of the add_filter( 'hoverex_filter_list_footer_styles', 'hoverex_trx_addons_list_footer_styles');
	function hoverex_trx_addons_list_footer_styles($list=array()) {
		if (hoverex_exists_layouts()) {
			$layouts = hoverex_get_list_posts(false, array(
							'post_type' => TRX_ADDONS_CPT_LAYOUTS_PT,
							'meta_key' => 'trx_addons_layout_type',
							'meta_value' => 'footer',
							'orderby' => 'ID',
							'order' => 'asc',
							'not_selected' => false
							)
						);
			$new_list = array();
			foreach ($layouts as $id=>$title) {
				if ($id != 'none') $new_list['footer-custom-'.intval($id)] = $title;
			}
			$list = hoverex_array_merge($new_list, $list);
		}
		return $list;
	}
}


// Replace {{Y}} or {Y} with the current year in the layouts
if ( !function_exists( 'hoverex_trx_addons_replace_current_year' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_sc_layout_content', 'hoverex_trx_addons_replace_current_year', 20, 2 );
	function hoverex_trx_addons_replace_current_year($content, $post_id=0) {
		return str_replace(array('{{Y}}', '{Y}'), date('Y'), $content);
	}
}


// Add theme-specific layouts to the list
if (!function_exists('hoverex_trx_addons_default_layouts')) {
	//Handler of the add_filter( 'trx_addons_filter_default_layouts',	'hoverex_trx_addons_default_layouts');
	function hoverex_trx_addons_default_layouts($default_layouts=array()) {
		if (hoverex_storage_isset('trx_addons_default_layouts')) {
			$layouts = hoverex_storage_get('trx_addons_default_layouts');
		} else {
			require_once HOVEREX_THEME_DIR . 'theme-specific/trx_addons-layouts.php';
			if (!isset($layouts) || !is_array($layouts))
				$layouts = array();
			hoverex_storage_set('trx_addons_default_layouts', $layouts);
		}
		if (count($layouts) > 0)
			$default_layouts = array_merge($default_layouts, $layouts);
		return $default_layouts;
	}
}


// Add theme-specific components to the plugin's options
if (!function_exists('hoverex_trx_addons_default_components')) {
	//Handler of the add_filter( 'trx_addons_filter_load_options',	'hoverex_trx_addons_default_components');
	function hoverex_trx_addons_default_components($options=array()) {
		if (empty($options['components_present'])) {
			if (hoverex_storage_isset('trx_addons_default_components')) {
				$components = hoverex_storage_get('trx_addons_default_components');
			} else {
				require_once HOVEREX_THEME_DIR . 'theme-specific/trx_addons-components.php';
				if (!isset($components) || !is_array($components))
					$components = array();
				hoverex_storage_set('trx_addons_default_components', $components);
			}
			$options = is_array($options) && count($components) > 0
									? array_merge($options, $components)
									: $components;
		}
		// Turn on API of the theme required plugins
		$plugins = hoverex_storage_get('required_plugins');
		foreach ($plugins as $p=>$v) {			
			if (isset($options["components_api_{$p}"]))
				$options["components_api_{$p}"] = 1;
		}
		return $options;
	}
}

// Enqueue custom styles
if ( !function_exists( 'hoverex_trx_addons_layouts_styles' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'hoverex_trx_addons_layouts_styles' );
	function hoverex_trx_addons_layouts_styles() {
		if (!hoverex_exists_trx_addons()) {
			if (hoverex_get_file_dir('plugins/trx_addons/layouts/layouts.css')!='') {
				wp_enqueue_style( 'hoverex-trx_addons_layouts',  hoverex_get_file_url('plugins/trx_addons/layouts/layouts.css'), array(), null );
			}
			if (hoverex_get_file_dir('plugins/trx_addons/layouts/layouts.responsive.css')!='') {
				wp_enqueue_style( 'hoverex-trx_addons_layouts_responsive',  hoverex_get_file_url('plugins/trx_addons/layouts/layouts.responsive.css'), array(), null );
			}
		}
	}
}

// Enqueue custom styles and scripts
if ( !function_exists( 'hoverex_trx_addons_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'hoverex_trx_addons_frontend_scripts', 1100 );
	function hoverex_trx_addons_frontend_scripts() {
		if (hoverex_exists_trx_addons()) {
			if (hoverex_is_on(hoverex_get_theme_option('debug_mode')) && hoverex_get_file_dir('plugins/trx_addons/trx_addons.js')!='')
				wp_enqueue_script( 'hoverex-trx_addons', hoverex_get_file_url('plugins/trx_addons/trx_addons.js'), array('jquery'), null, true );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'hoverex_trx_addons_merge_styles' ) ) {
	//Handler of the add_filter( 'hoverex_filter_merge_styles', 'hoverex_trx_addons_merge_styles');
	function hoverex_trx_addons_merge_styles($list) {
		$list[] = 'plugins/trx_addons/_trx_addons.scss';
		return $list;
	}
}

// Merge responsive styles
if ( !function_exists( 'hoverex_trx_addons_merge_styles_responsive' ) ) {
	//Handler of the add_filter('hoverex_filter_merge_styles_responsive', 'hoverex_trx_addons_merge_styles_responsive');
	function hoverex_trx_addons_merge_styles_responsive($list) {
		$list[] = 'plugins/trx_addons/_trx_addons-responsive.scss';
		return $list;
	}
}

// Add theme-specific vars to the list of responsive files of ThemeREX Addons
if ( !function_exists( 'hoverex_trx_addons_sass_import' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_sass_import','hoverex_trx_addons_sass_import', 10, 2);
	function hoverex_trx_addons_sass_import($output='', $file='') {
		if (strpos($file, 'vars.scss') !== false)
			$output .= "\n" . hoverex_fgc(hoverex_get_file_dir('css/_theme-vars.scss')) . "\n";
		return $output;
	}
}
	
// Merge custom scripts
if ( !function_exists( 'hoverex_trx_addons_merge_scripts' ) ) {
	//Handler of the add_filter('hoverex_filter_merge_scripts', 'hoverex_trx_addons_merge_scripts');
	function hoverex_trx_addons_merge_scripts($list) {
		$list[] = 'plugins/trx_addons/trx_addons.js';
		return $list;
	}
}



// Plugin API - theme-specific wrappers for plugin functions
//------------------------------------------------------------------------

// Debug functions wrappers
if (!function_exists('ddo')) { function ddo($obj, $level=-1) { return var_dump($obj); } }
if (!function_exists('dcl')) { function dcl($msg, $level=-1) { echo '<br><pre>' . esc_html($msg) . '</pre><br>'; } }
if (!function_exists('dco')) { function dco($obj, $level=-1) { dcl(ddo($obj, $level), $level); } }
if (!function_exists('dcs')) { function dcs($level=-1) { $s = debug_backtrace(); array_shift($s); dco($s, $level); } }
if (!function_exists('dfo')) { function dfo($obj, $level=-1) {} }
if (!function_exists('dfl')) { function dfl($msg, $level=-1) {} }

// Check if URL contain specified string
if (!function_exists('hoverex_check_url')) {
	function hoverex_check_url($val='', $defa=false) {
		return function_exists('trx_addons_check_url') 
					? trx_addons_check_url($val) 
					: $defa;
	}
}

// Check if layouts components are showed or set new state
if (!function_exists('hoverex_sc_layouts_showed')) {
	function hoverex_sc_layouts_showed($name, $val=null) {
		if (function_exists('trx_addons_sc_layouts_showed')) {
			if ($val!==null)
				trx_addons_sc_layouts_showed($name, $val);
			else
				return trx_addons_sc_layouts_showed($name);
		} else {
			if ($val!==null)
				return hoverex_storage_set_array('sc_layouts_components', $name, $val);
			else
				return hoverex_storage_get_array('sc_layouts_components', $name);
		}
	}
}

// Return image size multiplier
if (!function_exists('hoverex_get_retina_multiplier')) {
	function hoverex_get_retina_multiplier($force_retina=0) {
		$mult = function_exists('trx_addons_get_retina_multiplier') ? trx_addons_get_retina_multiplier($force_retina) : 1;
		return max(1, $mult);
	}
}

// Return slider layout
if (!function_exists('hoverex_get_slider_layout')) {
	function hoverex_get_slider_layout($args) {
		return function_exists('trx_addons_get_slider_layout') 
					? trx_addons_get_slider_layout($args) 
					: '';
	}
}

// Return video player layout
if (!function_exists('hoverex_get_video_layout')) {
	function hoverex_get_video_layout($args) {
		return function_exists('trx_addons_get_video_layout') 
					? trx_addons_get_video_layout($args) 
					: '';
	}
}

// Return theme specific layout of the featured image block
if ( !function_exists( 'hoverex_trx_addons_featured_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_featured_image', 'hoverex_trx_addons_featured_image', 10, 2);
	function hoverex_trx_addons_featured_image($processed=false, $args=array()) {
		$args['show_no_image'] = true;
		$args['singular'] = false;
		$args['hover'] = isset($args['hover']) && $args['hover']=='' ? '' : hoverex_get_theme_option('image_hover');
		hoverex_show_post_featured($args);
		return true;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'hoverex_trx_addons_add_thumb_sizes' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_add_thumb_sizes', 'hoverex_trx_addons_add_thumb_sizes');
	function hoverex_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			$thumb_sizes = hoverex_storage_get('theme_thumbs');
			foreach ($thumb_sizes as $v) {
				if (!empty($v['subst']) && isset($list[$v['subst']]))
					unset($list[$v['subst']]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'hoverex_trx_addons_get_thumb_size' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_thumb_size', 'hoverex_trx_addons_get_thumb_size');
	function hoverex_trx_addons_get_thumb_size($thumb_size='') {
		$thumb_sizes = hoverex_storage_get('theme_thumbs');
		foreach ($thumb_sizes as $k => $v) {
			if (strpos($thumb_size, $v['subst']) !== false) {
				$thumb_size = str_replace($thumb_size, $v['subst'], $k);
				break;
			}
		}
		return $thumb_size;
	}
}

// Return theme specific 'no-image' picture
if ( !function_exists( 'hoverex_trx_addons_no_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_no_image', 'hoverex_trx_addons_no_image');
	function hoverex_trx_addons_no_image($no_image='') {
		return hoverex_get_no_image($no_image);
	}
}

// Return theme-specific icons
if ( !function_exists( 'hoverex_trx_addons_get_list_icons' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_list_icons', 'hoverex_trx_addons_get_list_icons', 10, 2 );
	function hoverex_trx_addons_get_list_icons($list, $prepend_inherit) {
		return hoverex_get_list_icons($prepend_inherit);
	}
}

// Return links to the social profiles
if (!function_exists('hoverex_get_socials_links')) {
	function hoverex_get_socials_links($style='icons') {
		return function_exists('trx_addons_get_socials_links') 
					? trx_addons_get_socials_links($style)
					: '';
	}
}

// Return links to share post
if (!function_exists('hoverex_get_share_links')) {
	function hoverex_get_share_links($args=array()) {
		return function_exists('trx_addons_get_share_links') 
					? trx_addons_get_share_links($args)
					: '';
	}
}

// Display links to share post
if (!function_exists('hoverex_show_share_links')) {
	function hoverex_show_share_links($args=array()) {
		if (function_exists('trx_addons_get_share_links')) {
			$args['echo'] = true;
			trx_addons_get_share_links($args);
		}
	}
}

// Return post icon
if (!function_exists('hoverex_get_post_icon')) {
	function hoverex_get_post_icon($post_id=0) {
		return function_exists('trx_addons_get_post_icon') 
					? trx_addons_get_post_icon($post_id)
					: '';
	}
}

// Show reactions in the single posts
if (!function_exists('hoverex_trx_addons_action_before_post_meta')) {
	//Handler of the add_action( 'hoverex_action_before_post_meta', 'hoverex_trx_addons_action_before_post_meta'); 
	function hoverex_trx_addons_action_before_post_meta() {
		if (trx_addons_is_on(trx_addons_get_option('emotions_allowed')) && is_single() && !is_attachment())
			trx_addons_get_post_reactions(true);
	}
}


// Return image from the category
if (!function_exists('hoverex_get_category_image')) {
	function hoverex_get_category_image($term_id=0) {
		return function_exists('trx_addons_get_category_image') 
					? trx_addons_get_category_image($term_id)
					: '';
	}
}

// Return small image (icon) from the category
if (!function_exists('hoverex_get_category_icon')) {
	function hoverex_get_category_icon($term_id=0) {
		return function_exists('trx_addons_get_category_icon') 
					? trx_addons_get_category_icon($term_id)
					: '';
	}
}

// Return string with counters items
if (!function_exists('hoverex_get_post_counters')) {
	function hoverex_get_post_counters($counters='views') {
		return function_exists('trx_addons_get_post_counters')
					? str_replace('post_counters_item', 'post_meta_item post_counters_item', trx_addons_get_post_counters($counters))
					: '';
	}
}

// Return list with animation effects
if (!function_exists('hoverex_get_list_animations_in')) {
	function hoverex_get_list_animations_in() {
		return function_exists('trx_addons_get_list_animations_in') 
					? trx_addons_get_list_animations_in()
					: array();
	}
}

// Return classes list for the specified animation
if (!function_exists('hoverex_get_animation_classes')) {
	function hoverex_get_animation_classes($animation, $speed='normal', $loop='none') {
		return function_exists('trx_addons_get_animation_classes') 
					? trx_addons_get_animation_classes($animation, $speed, $loop)
					: '';
	}
}

// Return string with the likes counter for the specified comment
if (!function_exists('hoverex_get_comment_counters')) {
	function hoverex_get_comment_counters($counters = 'likes') {
		return function_exists('trx_addons_get_comment_counters') 
					? trx_addons_get_comment_counters($counters)
					: '';
	}
}

// Display likes counter for the specified comment
if (!function_exists('hoverex_show_comment_counters')) {
	function hoverex_show_comment_counters($counters = 'likes') {
		if (function_exists('trx_addons_get_comment_counters'))
			trx_addons_get_comment_counters($counters, true);
	}
}

// Add query params to sort posts by views or likes
if (!function_exists('hoverex_trx_addons_query_sort_order')) {
	//Handler of the add_filter('hoverex_filter_query_sort_order', 'hoverex_trx_addons_query_sort_order', 10, 3);
	function hoverex_trx_addons_query_sort_order($q=array(), $orderby='date', $order='desc') {
		if ($orderby == 'views') {
			$q['orderby'] = 'meta_value_num';
			$q['meta_key'] = 'trx_addons_post_views_count';
		} else if ($orderby == 'likes') {
			$q['orderby'] = 'meta_value_num';
			$q['meta_key'] = 'trx_addons_post_likes_count';
		}
		return $q;
	}
}

// Return theme-specific logo to the plugin
if ( !function_exists( 'hoverex_trx_addons_theme_logo' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_theme_logo', 'hoverex_trx_addons_theme_logo');
	function hoverex_trx_addons_theme_logo($logo) {
		return hoverex_get_logo_image();
	}
}

// Return true, if theme allow use site name as logo
if ( !function_exists( 'hoverex_trx_addons_show_site_name_as_logo' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_show_site_name_as_logo', 'hoverex_trx_addons_show_site_name_as_logo');
	function hoverex_trx_addons_show_site_name_as_logo($allow=true) {
		return $allow && hoverex_is_on(hoverex_get_theme_option('logo_text'));
	}
}

// Return theme-specific post meta to the plugin
if ( !function_exists( 'hoverex_trx_addons_post_meta' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_post_meta',	'hoverex_trx_addons_post_meta', 10, 2);
	function hoverex_trx_addons_post_meta($meta, $args=array()) {
		return hoverex_show_post_meta(apply_filters('hoverex_filter_post_meta_args', $args, 'trx_addons', 1));
	}
}

// Return theme-specific post meta args
if ( !function_exists( 'hoverex_trx_addons_post_meta_args' ) ) {
	//Handler of the add_filter( 'hoverex_filter_post_meta_args',	'hoverex_trx_addons_post_meta_args', 10, 3);
	function hoverex_trx_addons_post_meta_args($args=array(), $from='', $columns=1) {
		if (is_single() && $from=='trx_addons') {
			$args['components'] = hoverex_array_get_keys_by_value(hoverex_get_theme_option('meta_parts'));
			$args['counters'] = hoverex_array_get_keys_by_value(hoverex_get_theme_option('counters'));
			$args['seo'] = hoverex_is_on(hoverex_get_theme_option('seo_snippets'));
		}
		return $args;
	}
}

// Check if featured image override is allowed
if ( !function_exists( 'hoverex_trx_addons_featured_image_override' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_featured_image_override','hoverex_trx_addons_featured_image_override');
	function hoverex_trx_addons_featured_image_override($flag=false) {
		if ($flag) {
			$flag = hoverex_is_on(hoverex_get_theme_option('header_image_override')) 
					&& apply_filters('hoverex_filter_allow_override_header_image', true);
		}
		return $flag;
	}
}

// Return featured image for current mode (post/page/category/blog template ...)
if ( !function_exists( 'hoverex_trx_addons_get_current_mode_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_current_mode_image','hoverex_trx_addons_get_current_mode_image');
	function hoverex_trx_addons_get_current_mode_image($img='') {
		return hoverex_get_current_mode_image($img);
	}
}

// Return featured image size for related posts
if ( !function_exists( 'hoverex_trx_addons_related_thumb_size' ) ) {
	//Handler of the add_filter( 'hoverex_filter_related_thumb_size', 'hoverex_trx_addons_related_thumb_size');
	function hoverex_trx_addons_related_thumb_size($size='') {
		if (defined('TRX_ADDONS_CPT_CERTIFICATES_PT') && get_post_type() == TRX_ADDONS_CPT_CERTIFICATES_PT)
			$size = hoverex_get_thumb_size( 'masonry-big' );
		return $size;
	}
}
	
// Redirect action 'get_mobile_menu' to the plugin
// Return stored items as mobile menu
if ( !function_exists( 'hoverex_trx_addons_get_mobile_menu' ) ) {
	//Handler of the add_filter("hoverex_filter_get_mobile_menu", 'hoverex_trx_addons_get_mobile_menu');
	function hoverex_trx_addons_get_mobile_menu($menu) {
		return apply_filters('trx_addons_filter_get_mobile_menu', $menu);
	}
}

// Redirect action 'login' to the plugin
if (!function_exists('hoverex_trx_addons_action_login')) {
	//Handler of the add_action( 'hoverex_action_login', 'hoverex_trx_addons_action_login');
	function hoverex_trx_addons_action_login($args=array()) {
		do_action( 'trx_addons_action_login', $args );
	}
}

// Redirect action 'cart' to the plugin
if (!function_exists('hoverex_trx_addons_action_cart')) {
	//Handler of the add_action( 'hoverex_action_cart', 'hoverex_trx_addons_action_cart');
	function hoverex_trx_addons_action_cart($args=array()) {
		do_action( 'trx_addons_action_cart', $args );
	}
}

// Redirect action 'search' to the plugin
if (!function_exists('hoverex_trx_addons_action_search')) {
	//Handler of the add_action( 'hoverex_action_search', 'hoverex_trx_addons_action_search', 10, 3);
	function hoverex_trx_addons_action_search($style, $class, $ajax) {
		if (hoverex_exists_trx_addons())
			do_action( 'trx_addons_action_search', $style, $class, $ajax );
		else {
			set_query_var('hoverex_search_args', compact('style', 'class', 'ajax'));
			get_template_part('templates/search-form');
			set_query_var('hoverex_search_args', array());
		}
	}
}

// Redirect action 'breadcrumbs' to the plugin
if (!function_exists('hoverex_trx_addons_action_breadcrumbs')) {
	//Handler of the add_action( 'hoverex_action_breadcrumbs',	'hoverex_trx_addons_action_breadcrumbs');
	function hoverex_trx_addons_action_breadcrumbs() {
		do_action( 'trx_addons_action_breadcrumbs' );
	}
}

// Redirect action 'show_layout' to the plugin
if (!function_exists('hoverex_trx_addons_action_show_layout')) {
	//Handler of the add_action( 'hoverex_action_show_layout', 'hoverex_trx_addons_action_show_layout', 10, 1);
	function hoverex_trx_addons_action_show_layout($layout_id='') {
		do_action( 'trx_addons_action_show_layout', $layout_id );
	}
}

// Redirect filter 'get_translated_layout' to the plugin
if (!function_exists('hoverex_trx_addons_filter_get_translated_layout')) {
	//Handler of the add_filter( 'hoverex_filter_get_translated_layout', 'hoverex_trx_addons_filter_get_translated_layout', 10, 1);
	function hoverex_trx_addons_filter_get_translated_layout($layout_id='') {
		return apply_filters( 'trx_addons_filter_get_translated_layout', $layout_id );
	}
}

// Show user meta (socials)
if (!function_exists('hoverex_trx_addons_action_user_meta')) {
	//Handler of the add_action( 'hoverex_action_user_meta', 'hoverex_trx_addons_action_user_meta');
	function hoverex_trx_addons_action_user_meta() {
		do_action( 'trx_addons_action_user_meta' );
	}
}

// Redirect filter 'get_blog_title' to the plugin
if ( !function_exists( 'hoverex_trx_addons_get_blog_title' ) ) {
	//Handler of the add_filter( 'hoverex_filter_get_blog_title', 'hoverex_trx_addons_get_blog_title');
	function hoverex_trx_addons_get_blog_title($title='') {
		return apply_filters('trx_addons_filter_get_blog_title', $title);
	}
}

// Return true, if theme need a SEO snippets
if (!function_exists('hoverex_trx_addons_seo_snippets')) {
	//Handler of the add_filter( 'trx_addons_filter_seo_snippets', 'hoverex_trx_addons_seo_snippets');
	function hoverex_trx_addons_seo_snippets($enable=false) {
		return hoverex_is_on(hoverex_get_theme_option('seo_snippets'));
	}
}

// Show user meta (socials)
if (!function_exists('hoverex_trx_addons_before_article')) {
	//Handler of the add_action( 'trx_addons_action_before_article', 'hoverex_trx_addons_before_article', 10, 1);
	function hoverex_trx_addons_before_article($page='') {
		if (hoverex_is_on(hoverex_get_theme_option('seo_snippets')))
			get_template_part('templates/seo');
	}
}

// Redirect filter 'prepare_css' to the plugin
if (!function_exists('hoverex_trx_addons_prepare_css')) {
	//Handler of the add_filter( 'hoverex_filter_prepare_css',	'hoverex_trx_addons_prepare_css', 10, 2);
	function hoverex_trx_addons_prepare_css($css='', $remove_spaces=true) {
		return apply_filters( 'trx_addons_filter_prepare_css', $css, $remove_spaces );
	}
}

// Redirect filter 'prepare_js' to the plugin
if (!function_exists('hoverex_trx_addons_prepare_js')) {
	//Handler of the add_filter( 'hoverex_filter_prepare_js',	'hoverex_trx_addons_prepare_js', 10, 2);
	function hoverex_trx_addons_prepare_js($js='', $remove_spaces=true) {
		return apply_filters( 'trx_addons_filter_prepare_js', $js, $remove_spaces );
	}
}

// Add plugin's specific variables to the scripts
if (!function_exists('hoverex_trx_addons_localize_script')) {
	//Handler of the add_filter( 'hoverex_filter_localize_script',	'hoverex_trx_addons_localize_script');
	function hoverex_trx_addons_localize_script($arr) {
		$arr['trx_addons_exists'] = hoverex_exists_trx_addons();
		return $arr;
	}
}

// Add plugin-specific colors and fonts to the custom CSS
if (hoverex_exists_trx_addons()) { require_once HOVEREX_THEME_DIR . 'plugins/trx_addons/trx_addons-styles.php'; }


// Return text for the "I agree ..." checkbox
if ( ! function_exists( 'hoverex_trx_addons_privacy_text' ) ) {
    add_filter( 'trx_addons_filter_privacy_text', 'hoverex_trx_addons_privacy_text' );
    function hoverex_trx_addons_privacy_text( $text='' ) {
        return hoverex_get_privacy_text();
    }
}

// Add theme-specific options to the post's options
if (!function_exists('hoverex_trx_addons_override_options')) {
    add_filter( 'trx_addons_filter_override_options', 'hoverex_trx_addons_override_options');
    function hoverex_trx_addons_override_options($options=array()) {
        return apply_filters('hoverex_filter_override_options', $options);
    }
}


?>