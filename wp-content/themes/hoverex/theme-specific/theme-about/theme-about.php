<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if (!function_exists('hoverex_about_after_switch_theme')) {
    add_action('after_switch_theme', 'hoverex_about_after_switch_theme', 1000);
    function hoverex_about_after_switch_theme() {
        update_option('hoverex_about_page', 1);
    }
}
if ( !function_exists('hoverex_about_after_setup_theme') ) {
    add_action( 'init', 'hoverex_about_after_setup_theme', 1000 );
    function hoverex_about_after_setup_theme() {
        if (get_option('hoverex_about_page') == 1) {
            update_option('hoverex_about_page', 0);
            wp_safe_redirect(admin_url().'themes.php?page=hoverex_about');
            exit();
        }
    }
}


// Add 'About Theme' item in the Appearance menu
if (!function_exists('hoverex_about_add_menu_items')) {
    add_action( 'admin_menu', 'hoverex_about_add_menu_items' );
    function hoverex_about_add_menu_items() {
        $theme = wp_get_theme();
        $theme_name = $theme->name . (HOVEREX_THEME_FREE ? ' ' . esc_html__('Free', 'hoverex') : '');
        add_theme_page(
        // Translators: Add theme name to the page title
            sprintf(esc_html__('About %s', 'hoverex'), $theme_name),	//page_title
            // Translators: Add theme name to the menu title
            sprintf(esc_html__('About %s', 'hoverex'), $theme_name),	//menu_title
            'manage_options',											//capability
            'hoverex_about',											//menu_slug
            'hoverex_about_page_builder',								//callback
            'dashicons-format-status',									//icon
            ''															//menu position
        );

		if ( hoverex_theme_is_active()) {
			// Update skins
			$skins = get_transient( 'hoverex_skins_to_update' );
            $skin_count = is_array($skins) ? count( $skins ) : 0;


            $menu_label = empty($skins) ? esc_html__('Update skins', 'hoverex')
				: sprintf(esc_html__('Update skins %s', 'hoverex'),
					"<span class='update-plugins count-$skin_count'><span class='update-count'>" . number_format_i18n($skin_count) . "</span></span>"
				);

			add_theme_page(
			// Translators: Add theme name to the page title
				esc_html__('Update skins', 'hoverex'),	//page_title
				// Translators: Add theme name to the menu title
				$menu_label,												//menu_title
				'update_themes',									//capability
				'hoverex_update_skins',							//menu_slug
				'hoverex_update_skins_page_builder',				//callback
				'dashicons-format-status',									//icon
				''															//menu position
			);
		}
	}
}


// Load page-specific scripts and styles
if (!function_exists('hoverex_about_enqueue_scripts')) {
    add_action( 'admin_enqueue_scripts', 'hoverex_about_enqueue_scripts' );
    function hoverex_about_enqueue_scripts() {
        $screen = function_exists('get_current_screen') ? get_current_screen() : false;
        if (is_object($screen) && $screen->id == 'appearance_page_hoverex_about') {
            // Scripts
            wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );

            if (function_exists('hoverex_plugins_installer_enqueue_scripts'))
                hoverex_plugins_installer_enqueue_scripts();

            // Styles
            wp_enqueue_style( 'fontello-icons',  hoverex_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
            if ( ($fdir = hoverex_get_file_url('theme-specific/theme-about/theme-about.css')) != '' )
                wp_enqueue_style( 'hoverex-about',  $fdir, array(), null );
        }
    }
}


// Build 'About Theme' page
if (!function_exists('hoverex_about_page_builder')) {
    function hoverex_about_page_builder() {
        $theme = wp_get_theme();
        ?>
        <div class="hoverex_about">
            <div class="hoverex_about_header">
                <div class="hoverex_about_logo"><?php
                    $logo = hoverex_get_file_url('theme-specific/theme-about/logo.jpg');
                    if (empty($logo)) $logo = hoverex_get_file_url('screenshot.jpg');
                    if (!empty($logo)) {
                        ?><img src="<?php echo esc_url($logo); ?>"><?php
                    }
                    ?></div>

                <?php if (HOVEREX_THEME_FREE) { ?>
                    <a href="<?php echo esc_url(hoverex_storage_get('theme_download_url')); ?>"
                       target="_blank"
                       class="hoverex_about_pro_link button button-primary"><?php
                        esc_html_e('Get PRO version', 'hoverex');
                        ?></a>
                <?php } ?>
                <h1 class="hoverex_about_title"><?php
                    // Translators: Add theme name and version to the 'Welcome' message
                    echo esc_html(sprintf(esc_html__('Welcome to %1$s %2$s v.%3$s', 'hoverex'),
                        $theme->name,
                        HOVEREX_THEME_FREE ? esc_html__('Free', 'hoverex') : '',
                        $theme->version
                    ));
                    ?></h1>
                <div class="hoverex_about_description">
                    <?php
                    if (HOVEREX_THEME_FREE) {
                        ?><p><?php
                        // Translators: Add the download url and the theme name to the message
                        echo wp_kses_data(sprintf(__('Now you are using Free version of <a href="%1$s">%2$s Pro Theme</a>.', 'hoverex'),
                                esc_url(hoverex_storage_get('theme_download_url')),
                                $theme->name
                            )
                        );
                        // Translators: Add the theme name and supported plugins list to the message
                        echo '<br>' . wp_kses_data(sprintf(__('This version is SEO- and Retina-ready. It also has a built-in support for parallax and slider with swipe gestures. %1$s Free is compatible with many popular plugins, such as %2$s', 'hoverex'),
                                    $theme->name,
                                    hoverex_about_get_supported_plugins()
                                )
                            );
                        ?></p>
                        <p><?php
                        // Translators: Add the download url to the message
                        echo wp_kses_data(sprintf(__('We hope you have a great acquaintance with our themes. If you are looking for a fully functional website, you can get the <a href="%s">Pro Version here</a>', 'hoverex'),
                                esc_url(hoverex_storage_get('theme_download_url'))
                            )
                        );
                        ?></p><?php
                    } else {
                        ?><p><?php
                        // Translators: Add the theme name to the message
                        echo wp_kses_data(sprintf(__('%s is a Premium WordPress theme. It has a built-in support for parallax, slider with swipe gestures, and is SEO- and Retina-ready', 'hoverex'),
                                $theme->name
                            )
                        );
                        ?></p>
                        <p><?php
                        // Translators: Add supported plugins list to the message
                        echo wp_kses_data(sprintf(__('The Premium Theme is compatible with many popular plugins, such as %s', 'hoverex'),
                                hoverex_about_get_supported_plugins()
                            )
                        );
                        ?></p><?php
                    }
                    ?>
                </div>
            </div>
            <div id="hoverex_about_tabs" class="hoverex_tabs hoverex_about_tabs">
                <ul>
                    <li><a href="#hoverex_about_section_start"><?php esc_html_e('Getting started', 'hoverex'); ?></a></li>
                    <li><a href="#hoverex_about_section_actions"><?php esc_html_e('Recommended actions', 'hoverex'); ?></a></li>
                    <?php if (HOVEREX_THEME_FREE) { ?>
                        <li><a href="#hoverex_about_section_pro"><?php esc_html_e('Free vs PRO', 'hoverex'); ?></a></li>
                    <?php } ?>
                </ul>
                <div id="hoverex_about_section_start" class="hoverex_tabs_section hoverex_about_section">

                    <?php // Install theme skin ?>
                    <div class="hoverex_about_block hoverex_skin_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-images-alt2"></i>
                                <?php esc_html_e('Install Another Theme Skin', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
								if ( hoverex_theme_is_active() ) {
									echo apply_filters( 'hoverex_skin_list', '' );
								} else {
									?><h2 class="hoverex_about_block_title"><?php
										esc_html_e('Specify the purchase code', 'hoverex');
										?></h2>
									<form method="post" id="theme_pro_form">
										<input type="hidden" name="ajax_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
										<input type="text" id="theme_activation_key" value="">
										<button class="hoverex_about_block_link button button-primary"><?php esc_html_e('Activate', 'hoverex'); ?></button>
									</form>
									<p>
										<?php esc_html_e('Please activate your copy of the theme in order to get access to skin downloading.', 'hoverex'); ?>
									</p>
									<?php
								}
                                ?></div>
                        </div></div>
                    <?php
                    // Install required plugins
                    if (!HOVEREX_THEME_FREE_WP && !hoverex_exists_trx_addons()) {
                        ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-admin-plugins"></i>
                                <?php esc_html_e('ThemeREX Addons', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, currency and slider, and many other features ...', 'hoverex');
                                ?></div>
                            <?php hoverex_plugins_installer_get_button_html('trx_addons'); ?>
                        </div></div><?php
                    }

                    // Install recommended plugins
                    ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-admin-plugins"></i>
                                <?php esc_html_e('Recommended plugins', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                // Translators: Add the theme name to the message
                                echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'hoverex'), $theme->name));
                                ?></div>
                            <a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
                               class="hoverex_about_block_link button button-primary"><?php
                                esc_html_e('Install plugins', 'hoverex');
                                ?></a>
                        </div></div><?php

                    // Customizer or Theme Options
                    ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-admin-appearance"></i>
                                <?php esc_html_e('Setup Theme options', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'hoverex');
                                ?></div>
                            <a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
                               class="hoverex_about_block_link button button-primary"><?php
                                esc_html_e('Customizer', 'hoverex');
                                ?></a>
                            <?php esc_html_e('or', 'hoverex'); ?>
                            <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
                               class="hoverex_about_block_link button"><?php
                                esc_html_e('Theme Options', 'hoverex');
                                ?></a>
                        </div></div><?php

                    // Documentation
                    ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-book"></i>
                                <?php esc_html_e('Read full documentation', 'hoverex');	?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                // Translators: Add the theme name to the message
                                echo esc_html(sprintf(__('Need more details? Please check our full online documentation for detailed information on how to use %s.', 'hoverex'), $theme->name));
                                ?></div>
                            <a href="<?php echo esc_url(hoverex_storage_get('theme_doc_url')); ?>"
                               target="_blank"
                               class="hoverex_about_block_link button button-primary"><?php
                                esc_html_e('Documentation', 'hoverex');
                                ?></a>
                        </div></div><?php

                    // Video tutorials
                    ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-video-alt2"></i>
                                <?php esc_html_e('Video tutorials', 'hoverex');	?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                // Translators: Add the theme name to the message
                                echo esc_html(sprintf(__('No time for reading documentation? Check out our video tutorials and learn how to customize %s in detail.', 'hoverex'), $theme->name));
                                ?></div>
                            <a href="<?php echo esc_url(hoverex_storage_get('theme_video_url')); ?>"
                               target="_blank"
                               class="hoverex_about_block_link button button-primary"><?php
                                esc_html_e('Watch videos', 'hoverex');
                                ?></a>
                        </div></div><?php

                    // Support
                    if (!HOVEREX_THEME_FREE) {
                        ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-sos"></i>
                                <?php esc_html_e('Support', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                // Translators: Add the theme name to the message
                                echo esc_html(sprintf(__('We want to make sure you have the best experience using %s and that is why we gathered here all the necessary informations for you.', 'hoverex'), $theme->name));
                                ?></div>
                            <a href="<?php echo esc_url(hoverex_storage_get('theme_support_url')); ?>"
                               target="_blank"
                               class="hoverex_about_block_link button button-primary"><?php
                                esc_html_e('Support', 'hoverex');
                                ?></a>
                        </div></div><?php
                    }

                    // Online Demo
                    ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-images-alt2"></i>
                                <?php esc_html_e('On-line demo', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                // Translators: Add the theme name to the message
                                echo esc_html(sprintf(__('Visit the Demo Version of %s to check out all the features it has', 'hoverex'), $theme->name));
                                ?></div>
                            <a href="<?php echo esc_url(hoverex_storage_get('theme_demo_url')); ?>"
                               target="_blank"
                               class="hoverex_about_block_link button button-primary"><?php
                                esc_html_e('View demo', 'hoverex');
                                ?></a>
                        </div></div>

                </div>



                <div id="hoverex_about_section_actions" class="hoverex_tabs_section hoverex_about_section"><?php

                    // Install required plugins
                    if (!HOVEREX_THEME_FREE_WP && !hoverex_exists_trx_addons()) {
                        ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-admin-plugins"></i>
                                <?php esc_html_e('ThemeREX Addons', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, currency and slider, and many other features ...', 'hoverex');
                                ?></div>
                            <?php hoverex_plugins_installer_get_button_html('trx_addons'); ?>
                        </div></div><?php
                    }

                    // Install recommended plugins
                    ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-admin-plugins"></i>
                                <?php esc_html_e('Recommended plugins', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                // Translators: Add the theme name to the message
                                echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'hoverex'), $theme->name));
                                ?></div>
                            <a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
                               class="hoverex_about_block_link button button button-primary"><?php
                                esc_html_e('Install plugins', 'hoverex');
                                ?></a>
                        </div></div><?php

                    // Customizer or Theme Options
                    ?><div class="hoverex_about_block"><div class="hoverex_about_block_inner">
                            <h2 class="hoverex_about_block_title">
                                <i class="dashicons dashicons-admin-appearance"></i>
                                <?php esc_html_e('Setup Theme options', 'hoverex'); ?>
                            </h2>
                            <div class="hoverex_about_block_description"><?php
                                esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'hoverex');
                                ?></div>
                            <a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
                               target="_blank"
                               class="hoverex_about_block_link button button-primary"><?php
                                esc_html_e('Customizer', 'hoverex');
                                ?></a>
                            <?php esc_html_e('or', 'hoverex'); ?>
                            <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
                               class="hoverex_about_block_link button"><?php
                                esc_html_e('Theme Options', 'hoverex');
                                ?></a>
                        </div></div>

                </div>



                <?php if (HOVEREX_THEME_FREE) { ?>
                    <div id="hoverex_about_section_pro" class="hoverex_tabs_section hoverex_about_section">
                        <table class="hoverex_about_table" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            <tr>
                                <td class="hoverex_about_table_info">&nbsp;</td>
                                <td class="hoverex_about_table_check"><?php
                                    // Translators: Show theme name with suffix 'Free'
                                    echo esc_html(sprintf(esc_html__('%s Free', 'hoverex'), $theme->name));
                                    ?></td>
                                <td class="hoverex_about_table_check"><?php
                                    // Translators: Show theme name with suffix 'PRO'
                                    echo esc_html(sprintf(esc_html__('%s PRO', 'hoverex'), $theme->name));
                                    ?></td>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
                            // Responsive layouts
                            ?>
                            <tr>
                                <td class="hoverex_about_table_info">
                                    <h2 class="hoverex_about_table_info_title">
                                        <?php esc_html_e('Mobile friendly', 'hoverex'); ?>
                                    </h2>
                                    <div class="hoverex_about_table_info_description"><?php
                                        esc_html_e('Responsive layout. Looks great on any device.', 'hoverex');
                                        ?></div>
                                </td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                            </tr>

                            <?php
                            // Built-in slider
                            ?>
                            <tr>
                                <td class="hoverex_about_table_info">
                                    <h2 class="hoverex_about_table_info_title">
                                        <?php esc_html_e('Built-in posts slider', 'hoverex'); ?>
                                    </h2>
                                    <div class="hoverex_about_table_info_description"><?php
                                        esc_html_e('Allows you to add beautiful slides using the built-in shortcode/widget "Slider" with swipe gestures support.', 'hoverex');
                                        ?></div>
                                </td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                            </tr>

                            <?php
                            // Revolution slider
                            if (hoverex_storage_isset('required_plugins', 'revslider')) {
                                ?>
                                <tr>
                                    <td class="hoverex_about_table_info">
                                        <h2 class="hoverex_about_table_info_title">
                                            <?php esc_html_e('Revolution Slider Compatibility', 'hoverex'); ?>
                                        </h2>
                                        <div class="hoverex_about_table_info_description"><?php
                                            esc_html_e('Our built-in shortcode/widget "Slider" is able to work not only with posts, but also with slides created  in "Revolution Slider".', 'hoverex');
                                            ?></div>
                                    </td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                </tr>
                            <?php } ?>

                            <?php
                            // SiteOrigin Panels
                            if (hoverex_storage_isset('required_plugins', 'siteorigin-panels')) {
                                ?>
                                <tr>
                                    <td class="hoverex_about_table_info">
                                        <h2 class="hoverex_about_table_info_title">
                                            <?php esc_html_e('Free PageBuilder', 'hoverex'); ?>
                                        </h2>
                                        <div class="hoverex_about_table_info_description"><?php
                                            esc_html_e('Full integration with a nice free page builder "SiteOrigin Panels".', 'hoverex');
                                            ?></div>
                                    </td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                </tr>
                                <tr>
                                    <td class="hoverex_about_table_info">
                                        <h2 class="hoverex_about_table_info_title">
                                            <?php esc_html_e('Additional widgets pack', 'hoverex'); ?>
                                        </h2>
                                        <div class="hoverex_about_table_info_description"><?php
                                            esc_html_e('A number of useful widgets to create beautiful homepages and other sections of your website with SiteOrigin Panels.', 'hoverex');
                                            ?></div>
                                    </td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-no"></i></td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                </tr>
                            <?php } ?>

                            <?php
                            // WPBakery Page Builder
                            ?>
                            <tr>
                                <td class="hoverex_about_table_info">
                                    <h2 class="hoverex_about_table_info_title">
                                        <?php esc_html_e('WPBakery Page Builder', 'hoverex'); ?>
                                    </h2>
                                    <div class="hoverex_about_table_info_description"><?php
                                        esc_html_e('Full integration with a very popular page builder "WPBakery Page Builder". A number of useful shortcodes and widgets to create beautiful homepages and other sections of your website.', 'hoverex');
                                        ?></div>
                                </td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-no"></i></td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                            </tr>
                            <tr>
                                <td class="hoverex_about_table_info">
                                    <h2 class="hoverex_about_table_info_title">
                                        <?php esc_html_e('Additional shortcodes pack', 'hoverex'); ?>
                                    </h2>
                                    <div class="hoverex_about_table_info_description"><?php
                                        esc_html_e('A number of useful shortcodes to create beautiful homepages and other sections of your website with WPBakery Page Builder.', 'hoverex');
                                        ?></div>
                                </td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-no"></i></td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                            </tr>

                            <?php
                            // Layouts builder
                            ?>
                            <tr>
                                <td class="hoverex_about_table_info">
                                    <h2 class="hoverex_about_table_info_title">
                                        <?php esc_html_e('Headers and Footers builder', 'hoverex'); ?>
                                    </h2>
                                    <div class="hoverex_about_table_info_description"><?php
                                        esc_html_e('Powerful visual builder of headers and footers! No manual code editing - use all the advantages of drag-and-drop technology.', 'hoverex');
                                        ?></div>
                                </td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-no"></i></td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                            </tr>

                            <?php
                            // WooCommerce
                            if (hoverex_storage_isset('required_plugins', 'woocommerce')) {
                                ?>
                                <tr>
                                    <td class="hoverex_about_table_info">
                                        <h2 class="hoverex_about_table_info_title">
                                            <?php esc_html_e('WooCommerce Compatibility', 'hoverex'); ?>
                                        </h2>
                                        <div class="hoverex_about_table_info_description"><?php
                                            esc_html_e('Ready for e-commerce. You can build an online store with this theme.', 'hoverex');
                                            ?></div>
                                    </td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                </tr>
                            <?php } ?>

                            <?php
                            // Easy Digital Downloads
                            if (hoverex_storage_isset('required_plugins', 'easy-digital-downloads')) {
                                ?>
                                <tr>
                                    <td class="hoverex_about_table_info">
                                        <h2 class="hoverex_about_table_info_title">
                                            <?php esc_html_e('Easy Digital Downloads Compatibility', 'hoverex'); ?>
                                        </h2>
                                        <div class="hoverex_about_table_info_description"><?php
                                            esc_html_e('Ready for digital e-commerce. You can build an online digital store with this theme.', 'hoverex');
                                            ?></div>
                                    </td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-no"></i></td>
                                    <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                                </tr>
                            <?php } ?>

                            <?php
                            // Other plugins
                            ?>
                            <tr>
                                <td class="hoverex_about_table_info">
                                    <h2 class="hoverex_about_table_info_title">
                                        <?php esc_html_e('Many other popular plugins compatibility', 'hoverex'); ?>
                                    </h2>
                                    <div class="hoverex_about_table_info_description"><?php
                                        esc_html_e('PRO version is compatible (was tested and has built-in support) with many popular plugins.', 'hoverex');
                                        ?></div>
                                </td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-no"></i></td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                            </tr>

                            <?php
                            // Support
                            ?>
                            <tr>
                                <td class="hoverex_about_table_info">
                                    <h2 class="hoverex_about_table_info_title">
                                        <?php esc_html_e('Support', 'hoverex'); ?>
                                    </h2>
                                    <div class="hoverex_about_table_info_description"><?php
                                        esc_html_e('Our premium support is going to take care of any problems, in case there will be any of course.', 'hoverex');
                                        ?></div>
                                </td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-no"></i></td>
                                <td class="hoverex_about_table_check"><i class="dashicons dashicons-yes"></i></td>
                            </tr>

                            <?php
                            // Get PRO version
                            ?>
                            <tr>
                                <td class="hoverex_about_table_info">&nbsp;</td>
                                <td class="hoverex_about_table_check" colspan="2">
                                    <a href="<?php echo esc_url(hoverex_storage_get('theme_download_url')); ?>"
                                       target="_blank"
                                       class="hoverex_about_block_link hoverex_about_pro_link button button-primary"><?php
                                        esc_html_e('Get PRO version', 'hoverex');
                                        ?></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                <?php } ?>

            </div>
        </div>
        <?php
    }
}


// Build 'Update skins' page
if (!function_exists('hoverex_update_skins_page_builder')) {
	function hoverex_update_skins_page_builder() {
        do_action('hoverex_check_theme_updates');
		$skins = get_transient( 'hoverex_skins_to_update' );
		?><div class="wrap"><form method="post" id="hoverex_skin_update_form">
			<p><input id="upgrade-themes" class="button" type="submit" value="<?php
				esc_html_e('Update Skins', 'hoverex');
				?>" name="upgrade"><span class="spinner"></span></p>

			<table class="widefat updates-table" id="update-themes-table">
				<thead>
				<tr>
					<td class="manage-column check-column"><input type="checkbox" id="themes-select-all"></td>
					<td class="manage-column"><label for="themes-select-all"><?php esc_html_e('Select All', 'hoverex'); ?></label></td>
				</tr>
				</thead>
				<tbody class="plugins">
					<?php if ( empty($skins) ) {
						?>
						<tr>
							<td class="check-column">
							</td>
							<td class="plugin-title">
								<p><?php
									esc_html_e('Your skins are all up to date.', 'hoverex');
									?></p>
							</td>
						</tr>
						<?php
					} else {
						foreach ( $skins as $skin => $value ) {
							$img_href = get_template_directory_uri() . '/includes/skin-installer/img/' . $skin . '.jpg';
							$new_version = Hoverex_Skin_Install::get_instance()->remote_skin_version( $skin );
							?><tr>
								<td class="check-column">
									<input type="checkbox" name="checked[]" value="<?php echo esc_attr($skin);?>">
								</td>
								<td class="plugin-title"><p>
									<img src="<?php echo esc_url($img_href); ?>" width="85" height="64" class="updates-table-screenshot" alt="<?php echo esc_attr($skin);?>">
									<strong><?php echo esc_html($value) ?></strong>
									<?php echo sprintf( esc_html__('Update to %s.', 'hoverex'), $new_version ); ?></p>
								</td>
							</tr>
							<?php
						}
					} ?>
				</tbody>

				<tfoot>
				<tr>
					<td class="manage-column check-column"><input type="checkbox" id="themes-select-all-2"></td>
					<td class="manage-column"><label for="themes-select-all-2"><?php
							esc_html_e('Select All', 'hoverex');
							?></label></td>
				</tr>
				</tfoot>
			</table>
			<p><input id="upgrade-themes-2" class="button" type="submit" value="<?php
				esc_html_e('Update Skins', 'hoverex');
				?>" name="upgrade"><span class="spinner"></span></p>
		</form>
		</div>
		<?php
	}
}


// Utils
//------------------------------------

// Return supported plugin's names
if (!function_exists('hoverex_about_get_supported_plugins')) {
    function hoverex_about_get_supported_plugins() {
        return '"' . join('", "', array_values(hoverex_storage_get('required_plugins'))) . '"';
    }
}

require_once HOVEREX_THEME_DIR . 'includes/plugins-installer/plugins-installer.php';
?>