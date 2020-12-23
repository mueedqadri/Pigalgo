<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

$hoverex_post_format = get_post_format();
$hoverex_post_format = empty($hoverex_post_format) ? 'standard' : str_replace('post-format-', '', $hoverex_post_format);
$hoverex_animation = hoverex_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($hoverex_post_format) ); ?>
	<?php echo (!hoverex_is_off($hoverex_animation) ? ' data-animation="'.esc_attr(hoverex_get_animation_classes($hoverex_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	hoverex_show_post_featured(array( 'thumb_size' => hoverex_get_thumb_size( strpos(hoverex_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('hoverex_action_before_post_title');

			// Post meta
			$hoverex_components = hoverex_array_get_keys_by_value(hoverex_get_theme_option('meta_parts'));
			$hoverex_counters = hoverex_array_get_keys_by_value(hoverex_get_theme_option('counters'));

			if (!empty($hoverex_components))
				hoverex_show_post_meta(apply_filters('hoverex_filter_post_meta_args', array(
						'components' => $hoverex_components,
						'counters' => $hoverex_counters,
						'seo' => false
					), 'excerpt', 1)
				);

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			do_action('hoverex_action_before_post_meta'); 


			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (hoverex_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'hoverex' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'hoverex' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$hoverex_show_learn_more = !in_array($hoverex_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($hoverex_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($hoverex_post_format == 'quote') {
					if (($quote = hoverex_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						hoverex_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 4)!='[vc_') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $hoverex_show_learn_more ) {
				?><p class="sc_button_excerpt"><a class="sc_button sc_button_bordered sc_button_size_small" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'hoverex'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>