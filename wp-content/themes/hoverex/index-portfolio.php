<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

hoverex_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	hoverex_show_layout(get_query_var('blog_archive_start'));

	$hoverex_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$hoverex_sticky_out = hoverex_get_theme_option('sticky_style')=='columns' 
							&& is_array($hoverex_stickies) && count($hoverex_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$hoverex_cat = hoverex_get_theme_option('parent_cat');
	$hoverex_post_type = hoverex_get_theme_option('post_type');
	$hoverex_taxonomy = hoverex_get_post_type_taxonomy($hoverex_post_type);
	$hoverex_show_filters = hoverex_get_theme_option('show_filters');
	$hoverex_tabs = array();
	if (!hoverex_is_off($hoverex_show_filters)) {
		$hoverex_args = array(
			'type'			=> $hoverex_post_type,
			'child_of'		=> $hoverex_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $hoverex_taxonomy,
			'pad_counts'	=> false
		);
		$hoverex_portfolio_list = get_terms($hoverex_args);
		if (is_array($hoverex_portfolio_list) && count($hoverex_portfolio_list) > 0) {
			$hoverex_tabs[$hoverex_cat] = esc_html__('All', 'hoverex');
			foreach ($hoverex_portfolio_list as $hoverex_term) {
				if (isset($hoverex_term->term_id)) $hoverex_tabs[$hoverex_term->term_id] = $hoverex_term->name;
			}
		}
	}
	if (count($hoverex_tabs) > 0) {
		$hoverex_portfolio_filters_ajax = true;
		$hoverex_portfolio_filters_active = $hoverex_cat;
		$hoverex_portfolio_filters_id = 'portfolio_filters';
		?>
		<div class="portfolio_filters hoverex_tabs hoverex_tabs_ajax">
			<ul class="portfolio_titles hoverex_tabs_titles">
				<?php
				foreach ($hoverex_tabs as $hoverex_id=>$hoverex_title) {
					?><li><a href="<?php echo esc_url(hoverex_get_hash_link(sprintf('#%s_%s_content', $hoverex_portfolio_filters_id, $hoverex_id))); ?>" data-tab="<?php echo esc_attr($hoverex_id); ?>"><?php echo esc_html($hoverex_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$hoverex_ppp = hoverex_get_theme_option('posts_per_page');
			if (hoverex_is_inherit($hoverex_ppp)) $hoverex_ppp = '';
			foreach ($hoverex_tabs as $hoverex_id=>$hoverex_title) {
				$hoverex_portfolio_need_content = $hoverex_id==$hoverex_portfolio_filters_active || !$hoverex_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $hoverex_portfolio_filters_id, $hoverex_id)); ?>"
					class="portfolio_content hoverex_tabs_content"
					data-blog-template="<?php echo esc_attr(hoverex_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(hoverex_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($hoverex_ppp); ?>"
					data-post-type="<?php echo esc_attr($hoverex_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($hoverex_taxonomy); ?>"
					data-cat="<?php echo esc_attr($hoverex_id); ?>"
					data-parent-cat="<?php echo esc_attr($hoverex_cat); ?>"
					data-need-content="<?php echo (false===$hoverex_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($hoverex_portfolio_need_content) 
						hoverex_show_portfolio_posts(array(
							'cat' => $hoverex_id,
							'parent_cat' => $hoverex_cat,
							'taxonomy' => $hoverex_taxonomy,
							'post_type' => $hoverex_post_type,
							'page' => 1,
							'sticky' => $hoverex_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		hoverex_show_portfolio_posts(array(
			'cat' => $hoverex_cat,
			'parent_cat' => $hoverex_cat,
			'taxonomy' => $hoverex_taxonomy,
			'post_type' => $hoverex_post_type,
			'page' => 1,
			'sticky' => $hoverex_sticky_out
			)
		);
	}

	hoverex_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>