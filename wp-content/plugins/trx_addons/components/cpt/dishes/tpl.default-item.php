<?php
/**
 * The style "default" of the Dishes
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.09
 */

$args = get_query_var('trx_addons_args_sc_dishes');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();
$featured_position = !empty($args['featured_position']) ? $args['featured_position'] : 'top';

if (!empty($args['slider'])) {
	?><div class="slider-slide swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_dishes_item with_image<?php
	if (isset($args['hide_excerpt']) && $args['hide_excerpt']) echo ' without_content';
	echo ' sc_dishes_item_featured_'.esc_attr($featured_position);
	?>"<?php
	if (!empty($args['popup'])) {
		?> data-post_id="<?php echo esc_attr(get_the_ID()); ?>"<?php
		?> data-post_type="<?php echo esc_attr(TRX_ADDONS_CPT_DISHES_PT); ?>"<?php
	}
	?>>
	<?php
	// Featured image
	if ( has_post_thumbnail() && (empty($args['featured']) || $args['featured']=='image')) {
		?><div class="sc_dishes_item_image"><?php
			trx_addons_get_template_part('templates/tpl.featured.php',
										'trx_addons_args_featured',
										apply_filters('trx_addons_filter_args_featured', array(
														'class' => 'sc_dishes_item_thumb',
														'hover' => 'zoomin',
														'thumb_size' => apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size($args['columns'] > 2 ? 'medium' : 'big'), 'dishes-default')
														),
														'dishes-default'
													)
										);
			// Spicy level
			if (trim($meta['spicy']) != '') {
				$meta['spicy'] = max(1, min(5, $meta['spicy']));
				?><span class="dishes_page_spicy dishes_page_spicy_<?php echo esc_html($meta['spicy']); ?>">
					<span class="dishes_page_spicy_label"><?php esc_html_e('Spicy Level:', 'trx_addons'); ?></span>
					<span class="dishes_page_spicy_value"><?php echo esc_html($meta['spicy']); ?></span>
				</span><?php
			}
			// Price
			if (trim($meta['price']) != '') {
				?><div class="sc_dishes_item_price"><?php echo esc_html($meta['price']); ?></div><?php
			}
		?></div><?php
	}
	?>	
	<div class="sc_dishes_item_info">
		<div class="sc_dishes_item_header">
			<h4 class="sc_dishes_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h4>
			<div class="sc_dishes_item_subtitle"><?php trx_addons_show_layout(trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_DISHES_TAXONOMY));?></div>
		</div>
		<?php if (!isset($args['hide_excerpt']) || $args['hide_excerpt']==0) { ?>
			<div class="sc_dishes_item_content"><?php the_excerpt(); ?></div>
			<div class="sc_dishes_item_button sc_item_button">
				<a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_button sc_button_simple sc_dishes_button_more', 'sc_dishes', $args)); ?>"><?php esc_html_e('Learn more', 'trx_addons'); ?></a>
				<?php
				if ($meta['product'] > 0) {
					?><a href="<?php echo esc_url(get_permalink($meta['product'])); ?>" class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_button sc_button_simple sc_dishes_button_order', 'sc_dishes', $args)); ?>"><?php esc_html_e('Order now', 'trx_addons'); ?></a><?php
				}
				?>
			</div>
		<?php } ?>
	</div>
</div>
<?php
if (!empty($args['slider']) || $args['columns'] > 1) {
	?></div><?php
}
?>