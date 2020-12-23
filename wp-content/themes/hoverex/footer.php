<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

						// Widgets area inside page content
						hoverex_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					hoverex_create_widgets_area('widgets_below_page');

					$hoverex_body_style = hoverex_get_theme_option('body_style');
					if ($hoverex_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$hoverex_footer_type = hoverex_get_theme_option("footer_type");
			if ($hoverex_footer_type == 'custom' && !hoverex_is_layouts_available())
				$hoverex_footer_type = 'default';
			get_template_part( "templates/footer-{$hoverex_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (hoverex_is_on(hoverex_get_theme_option('debug_mode')) && hoverex_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(hoverex_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>