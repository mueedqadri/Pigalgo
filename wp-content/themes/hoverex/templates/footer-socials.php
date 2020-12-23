<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.10
 */


// Socials
if ( hoverex_is_on(hoverex_get_theme_option('socials_in_footer')) && ($hoverex_output = hoverex_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php hoverex_show_layout($hoverex_output); ?>
		</div>
	</div>
	<?php
}
?>