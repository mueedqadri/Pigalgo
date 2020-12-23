<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

$hoverex_blog_style = explode('_', hoverex_get_theme_option('blog_style'));
$hoverex_columns = empty($hoverex_blog_style[1]) ? 1 : max(1, $hoverex_blog_style[1]);
$hoverex_expanded = !hoverex_sidebar_present() && hoverex_is_on(hoverex_get_theme_option('expand_content'));
$hoverex_post_format = get_post_format();
$hoverex_post_format = empty($hoverex_post_format) ? 'standard' : str_replace('post-format-', '', $hoverex_post_format);
$hoverex_animation = hoverex_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($hoverex_columns).' post_format_'.esc_attr($hoverex_post_format) ); ?>
	<?php echo (!hoverex_is_off($hoverex_animation) ? ' data-animation="'.esc_attr(hoverex_get_animation_classes($hoverex_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($hoverex_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'" icon="'.esc_attr(hoverex_get_post_icon()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	hoverex_show_post_featured( array(
											'class' => $hoverex_columns == 1 ? 'hoverex-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => hoverex_get_thumb_size(
																	strpos(hoverex_get_theme_option('body_style'), 'full')!==false
																		? ( $hoverex_columns > 1 ? 'huge' : 'original' )
																		: (	$hoverex_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('hoverex_action_before_post_title');

				do_action('hoverex_action_before_post_meta');

				// Post meta
				$hoverex_components = hoverex_array_get_keys_by_value(hoverex_get_theme_option('meta_parts'));
				$hoverex_counters = hoverex_array_get_keys_by_value(hoverex_get_theme_option('counters'));
				$hoverex_post_meta = empty($hoverex_components)
					? ''
					: hoverex_show_post_meta(apply_filters('hoverex_filter_post_meta_args', array(
							'components' => $hoverex_components,
							'counters' => $hoverex_counters,
							'seo' => false,
							'echo' => false
						), $hoverex_blog_style[0], $hoverex_columns)
					);
				hoverex_show_layout($hoverex_post_meta);

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			

		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$hoverex_show_learn_more = !in_array($hoverex_post_format, array('link', 'aside', 'status', 'quote'));
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
					echo (wp_trim_words(get_the_excerpt(), 20, '...' ));
				}
				?>
			</div>
			<?php
			// Post meta
			if (in_array($hoverex_post_format, array('link', 'aside', 'status', 'quote'))) {
				hoverex_show_layout($hoverex_post_meta);
			}
			// More button
			if ( $hoverex_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'hoverex'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>