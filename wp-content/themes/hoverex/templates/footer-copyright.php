<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap<?php
				if (!hoverex_is_inherit(hoverex_get_theme_option('copyright_scheme')))
					echo ' scheme_' . esc_attr(hoverex_get_theme_option('copyright_scheme'));
 				?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				$hoverex_copyright = hoverex_get_theme_option('copyright');
				if (!empty($hoverex_copyright)) {
					// Replace {{Y}} or {Y} with the current year
					$hoverex_copyright = str_replace(array('{{Y}}', '{Y}'), date('Y'), $hoverex_copyright);
					// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
					$hoverex_copyright = hoverex_prepare_macros($hoverex_copyright);
					// Display copyright
					echo wp_kses_data(nl2br($hoverex_copyright));
				}
			?></div>
		</div>
	</div>
</div>
