<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

$hoverex_blog_style = explode('_', hoverex_get_theme_option('blog_style'));
$hoverex_columns = empty($hoverex_blog_style[1]) ? 2 : max(2, $hoverex_blog_style[1]);
$hoverex_post_format = get_post_format();
$hoverex_post_format = empty($hoverex_post_format) ? 'standard' : str_replace('post-format-', '', $hoverex_post_format);
$hoverex_animation = hoverex_get_theme_option('blog_animation');
$hoverex_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($hoverex_columns).' post_format_'.esc_attr($hoverex_post_format) ); ?>
	<?php echo (!hoverex_is_off($hoverex_animation) ? ' data-animation="'.esc_attr(hoverex_get_animation_classes($hoverex_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($hoverex_image[1]) && !empty($hoverex_image[2])) echo intval($hoverex_image[1]) .'x' . intval($hoverex_image[2]); ?>"
	data-src="<?php if (!empty($hoverex_image[0])) echo esc_url($hoverex_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$hoverex_image_hover = 'icon';
	if (in_array($hoverex_image_hover, array('icons', 'zoom'))) $hoverex_image_hover = 'dots';
	$hoverex_components = hoverex_array_get_keys_by_value(hoverex_get_theme_option('meta_parts'));
	$hoverex_counters = hoverex_array_get_keys_by_value(hoverex_get_theme_option('counters'));
	hoverex_show_post_featured(array(
		'hover' => $hoverex_image_hover,
		'thumb_size' => hoverex_get_thumb_size( strpos(hoverex_get_theme_option('body_style'), 'full')!==false || $hoverex_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($hoverex_components)
										? hoverex_show_post_meta(apply_filters('hoverex_filter_post_meta_args', array(
											'components' => $hoverex_components,
											'counters' => $hoverex_counters,
											'seo' => false,
											'echo' => false
											), $hoverex_blog_style[0], $hoverex_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'hoverex') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>