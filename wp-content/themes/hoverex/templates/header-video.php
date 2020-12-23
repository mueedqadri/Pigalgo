<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.14
 */
$hoverex_header_video = hoverex_get_header_video();
$hoverex_embed_video = '';
if (!empty($hoverex_header_video) && !hoverex_is_from_uploads($hoverex_header_video)) {
	if (hoverex_is_youtube_url($hoverex_header_video) && preg_match('/[=\/]([^=\/]*)$/', $hoverex_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$hoverex_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($hoverex_header_video) . '[/embed]' ));
			$hoverex_embed_video = hoverex_make_video_autoplay($hoverex_embed_video);
		} else {
			$hoverex_header_video = str_replace('/watch?v=', '/embed/', $hoverex_header_video);
			$hoverex_header_video = hoverex_add_to_url($hoverex_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$hoverex_embed_video = '<iframe src="' . esc_url($hoverex_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php hoverex_show_layout($hoverex_embed_video); ?></div><?php
	}
}
?>