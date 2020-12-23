<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

$hoverex_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$hoverex_post_format = get_post_format();
$hoverex_post_format = empty($hoverex_post_format) ? 'standard' : str_replace('post-format-', '', $hoverex_post_format);
$hoverex_animation = hoverex_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($hoverex_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($hoverex_post_format) ); ?>
	<?php echo (!hoverex_is_off($hoverex_animation) ? ' data-animation="'.esc_attr(hoverex_get_animation_classes($hoverex_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	hoverex_show_post_featured(array(
		'thumb_size' => hoverex_get_thumb_size($hoverex_columns==1 ? 'big' : ($hoverex_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($hoverex_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			hoverex_show_post_meta(apply_filters('hoverex_filter_post_meta_args', array(), 'sticky', $hoverex_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>