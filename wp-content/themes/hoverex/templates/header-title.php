<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

// Page (category, tag, archive, author) title

if ( hoverex_need_page_title() ) {
	hoverex_sc_layouts_showed('title', true);
	hoverex_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								hoverex_show_post_meta(apply_filters('hoverex_filter_post_meta_args', array(
									'components' => hoverex_array_get_keys_by_value(hoverex_get_theme_option('meta_parts')),
									'counters' => hoverex_array_get_keys_by_value(hoverex_get_theme_option('counters')),
									'seo' => hoverex_is_on(hoverex_get_theme_option('seo_snippets'))
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$hoverex_blog_title = hoverex_get_blog_title();
							$hoverex_blog_title_text = $hoverex_blog_title_class = $hoverex_blog_title_link = $hoverex_blog_title_link_text = '';
							if (is_array($hoverex_blog_title)) {
								$hoverex_blog_title_text = $hoverex_blog_title['text'];
								$hoverex_blog_title_class = !empty($hoverex_blog_title['class']) ? ' '.$hoverex_blog_title['class'] : '';
								$hoverex_blog_title_link = !empty($hoverex_blog_title['link']) ? $hoverex_blog_title['link'] : '';
								$hoverex_blog_title_link_text = !empty($hoverex_blog_title['link_text']) ? $hoverex_blog_title['link_text'] : '';
							} else
								$hoverex_blog_title_text = $hoverex_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($hoverex_blog_title_class); ?>"><?php
								$hoverex_top_icon = hoverex_get_category_icon();
								if (!empty($hoverex_top_icon)) {
									$hoverex_attr = hoverex_getimagesize($hoverex_top_icon);
									?><img src="<?php echo esc_url($hoverex_top_icon); ?>" alt="<?php echo wp_kses_data($hoverex_blog_title_text); ?>" <?php if (!empty($hoverex_attr[3])) hoverex_show_layout($hoverex_attr[3]);?>><?php
								}
								echo wp_kses_data($hoverex_blog_title_text);
							?></h1>
							<?php
							if (!empty($hoverex_blog_title_link) && !empty($hoverex_blog_title_link_text)) {
								?><a href="<?php echo esc_url($hoverex_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($hoverex_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'hoverex_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>