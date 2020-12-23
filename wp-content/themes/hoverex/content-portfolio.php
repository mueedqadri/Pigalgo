<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($hoverex_columns).' post_format_'.esc_attr($hoverex_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!hoverex_is_off($hoverex_animation) ? ' data-animation="'.esc_attr(hoverex_get_animation_classes($hoverex_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$hoverex_image_hover = hoverex_get_theme_option('image_hover');
	// Featured image
	hoverex_show_post_featured(array(
		'thumb_size' => hoverex_get_thumb_size(strpos(hoverex_get_theme_option('body_style'), 'full')!==false || $hoverex_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $hoverex_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $hoverex_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>