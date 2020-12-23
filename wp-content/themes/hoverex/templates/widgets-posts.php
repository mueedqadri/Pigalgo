<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

$hoverex_post_id    = get_the_ID();
$hoverex_post_date  = hoverex_get_date();
$hoverex_post_title = get_the_title();
$hoverex_post_link  = get_permalink();
$hoverex_post_author_id   = get_the_author_meta('ID');
$hoverex_post_author_name = get_the_author_meta('display_name');
$hoverex_post_author_url  = get_author_posts_url($hoverex_post_author_id, '');

$hoverex_args = get_query_var('hoverex_args_widgets_posts');
$hoverex_show_date = isset($hoverex_args['show_date']) ? (int) $hoverex_args['show_date'] : 1;
$hoverex_show_image = isset($hoverex_args['show_image']) ? (int) $hoverex_args['show_image'] : 1;
$hoverex_show_author = isset($hoverex_args['show_author']) ? (int) $hoverex_args['show_author'] : 1;
$hoverex_show_counters = isset($hoverex_args['show_counters']) ? (int) $hoverex_args['show_counters'] : 1;
$hoverex_show_categories = isset($hoverex_args['show_categories']) ? (int) $hoverex_args['show_categories'] : 1;

$hoverex_output = hoverex_storage_get('hoverex_output_widgets_posts');

$hoverex_post_counters_output = '';
if ( $hoverex_show_counters ) {
	$hoverex_post_counters_output = '<span class="post_info_item post_info_counters">'
								. hoverex_get_post_counters('comments')
							. '</span>';
}


$hoverex_output .= '<article class="post_item with_thumb">';

if ($hoverex_show_image) {
	$hoverex_post_thumb = get_the_post_thumbnail($hoverex_post_id, hoverex_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($hoverex_post_thumb) $hoverex_output .= '<div class="post_thumb">' . ($hoverex_post_link ? '<a href="' . esc_url($hoverex_post_link) . '">' : '') . ($hoverex_post_thumb) . ($hoverex_post_link ? '</a>' : '') . '</div>';
}

$hoverex_output .= '<div class="post_content">'
			. ($hoverex_show_categories 
					? '<div class="post_categories">'
						. hoverex_get_post_categories()
						. $hoverex_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($hoverex_post_link ? '<a href="' . esc_url($hoverex_post_link) . '">' : '') . ($hoverex_post_title) . ($hoverex_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('hoverex_filter_get_post_info', 
								'<div class="post_info">'
									. ($hoverex_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($hoverex_post_link ? '<a href="' . esc_url($hoverex_post_link) . '" class="post_info_date">' : '') 
											. esc_html($hoverex_post_date) 
											. ($hoverex_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($hoverex_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'hoverex') . ' ' 
											. ($hoverex_post_link ? '<a href="' . esc_url($hoverex_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($hoverex_post_author_name) 
											. ($hoverex_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$hoverex_show_categories && $hoverex_post_counters_output
										? $hoverex_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
hoverex_storage_set('hoverex_output_widgets_posts', $hoverex_output);
?>