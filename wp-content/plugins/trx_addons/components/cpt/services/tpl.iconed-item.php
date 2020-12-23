<?php
/**
 * The style "iconed" of the Services item
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

$args = get_query_var('trx_addons_args_sc_services');
$number = get_query_var('trx_addons_args_item_number');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = empty($args['no_links']) ? get_permalink() : '';

if (empty($args['id'])) $args['id'] = 'sc_services_'.str_replace('.', '', mt_rand());
if (empty($args['featured'])) $args['featured'] = 'icon';
if (empty($args['featured_position'])) $args['featured_position'] = 'top';

$svg_present = false;
$image = '';
if ( has_post_thumbnail() ) {
	$image = trx_addons_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), trx_addons_get_thumb_size('masonry') );
}

$terms = false;

if (!empty($args['slider'])) {
	?><div class="slider-slide swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?> "><?php
}
?>
<div <?php post_class( 'sc_services_item'
			. (empty($post_link) ? ' no_links' : '')
			. (isset($args['hide_excerpt']) && $args['hide_excerpt'] ? ' without_content' : ' with_content')
			. (!empty($image) ? ' with_image' : '')
			. ($args['featured']=='icon' ? ' with_icon' : '')
			. ($args['featured']=='pictogram' ? ' with_pictogram' : '')
			. ($args['featured']=='number' ? ' with_number' : '')
			. (' sc_services_item_featured_'.esc_attr($args['featured_position']))
			);
	if (!empty($args['popup'])) {
		?> data-post_id="<?php echo esc_attr(get_the_ID()); ?>"<?php
		?> data-post_type="<?php echo esc_attr(TRX_ADDONS_CPT_SERVICES_PT); ?>"<?php
	}
?>>
	<div class="sc_services_item_header"<?php if (!empty($image)) echo ' style="background-image: url('.esc_url($image).');"'; ?>>
		<?php
		if ($args['featured']=='icon' && !empty($meta['icon'])) {
			$svg = $img = '';
			if (trx_addons_is_url($meta['icon'])) {
				$img = $meta['icon'];
				$meta['icon'] = basename($meta['icon']);
			} else if (!empty($args['icons_animation']) && $args['icons_animation'] > 0 && ($svg = trx_addons_get_file_dir('css/icons.svg/'.trx_addons_esc($meta['icon']).'.svg')) != '') {
				$svg_present = true;
			}
			if (!empty($link)) {
				?><a href="<?php echo esc_url($link); ?>"><?php
			}
				?><span id="<?php echo esc_attr($args['id'].'_'.trim($meta['icon']).'_'.trim($number)); ?>"
					 class="sc_services_item_icon <?php 
							echo !empty($svg) 
									? 'sc_icon_type_svg'
									: (!empty($img) 
										? 'sc_icon_type_img'
										: esc_attr($meta['icon'])
										);
							?>"
					 ><?php
					if (!empty($svg)) {
						trx_addons_show_layout(trx_addons_get_svg_from_file($svg));
					} else if (!empty($img)) {
						$attr = trx_addons_getimagesize($img);
						?><img class="sc_icon_as_image" src="<?php echo esc_url($img); ?>" alt=""<?php echo (!empty($attr[3]) ? ' '.trim($attr[3]) : ''); ?>><?php
					}
				?></span><?php
			if (!empty($link)) {
				?></a><?php
			}
		} else if ($args['featured']=='pictogram' && !empty($meta['image'])) {
			echo !empty($link) 
				? '<a href="'.esc_url($link).'"' 
				: '<span';
			?> class="sc_services_item_pictogram"><?php
			$attr = trx_addons_getimagesize($meta['image']);
			?><img src="<?php echo esc_url($meta['image']); ?>" alt=""<?php echo (!empty($attr[3]) ? ' '.trim($attr[3]) : ''); ?>><?php
			echo !empty($link) 
				? '</a>' 
				: '</span>';
		} else if ($args['featured']=='number') {
			?><span class="sc_services_item_number"><?php
				printf("%02d", $number);
			?></span><?php
		}	
		if (isset($args['hide_excerpt']) && $args['hide_excerpt']==1) {
			?><h6 class="sc_services_item_title"><?php
				if (!empty($link)) {
					?><a href="<?php echo esc_url($link); ?>"><?php
				}
				the_title();
				if (!empty($link)) {
					?></a><?php
				}
			?></h6>
			<div class="sc_services_item_subtitle"><?php
				$terms = trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_SERVICES_TAXONOMY);
				if (empty($link)) $terms = trx_addons_links_to_span($terms);
				trx_addons_show_layout($terms);
			?></div>
			<?php
		}
	?></div><?php
	
	if (!isset($args['hide_excerpt']) || $args['hide_excerpt']==0) {
		?><div class="sc_services_item_content">
			<h6 class="sc_services_item_title<?php if (!empty($meta['price'])) echo ' with_price'; ?>"><?php
				if (!empty($link)) {
					?><a href="<?php echo esc_url($link); ?>"><?php
				}
				the_title();
				// Price
				if (!empty($meta['price'])) {
					?><div class="sc_services_item_price"><?php echo esc_html($meta['price']); ?></div><?php
				}
				if (!empty($link)) {
					?></a><?php
				}
			?></h6>
			<div class="sc_services_item_subtitle"><?php
				if ($terms === false) {
					$terms = trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_SERVICES_TAXONOMY);
					if (empty($link)) $terms = trx_addons_links_to_span($terms);
				}
				trx_addons_show_layout($terms);
			?></div>
			<div class="sc_services_item_text"><?php the_excerpt(); ?></div><?php
			if (!empty($link)) {
				?><div class="sc_services_item_button sc_item_button"><a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_button sc_button_simple', 'sc_services', $args)); ?>"><?php esc_html_e('Learn more', 'trx_addons'); ?></a></div><?php
			}
		?></div><?php
	}
?></div><?php
if (!empty($args['slider']) || $args['columns'] > 1) {
	?></div><?php
}
if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && $svg_present) {
	wp_enqueue_script( 'vivus', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'icons/vivus.js'), array('jquery'), null, true );
	wp_enqueue_script( 'trx_addons-sc_icons', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'icons/icons.js'), array('jquery'), null, true );
}
?>