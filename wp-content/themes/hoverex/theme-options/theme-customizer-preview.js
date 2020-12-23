/**
 * Live-update changed settings in real time in the Customizer preview.
 */
( function( $ ) {

	"use strict";

	var $style = $('#hoverex-customizer-inline-css'),
		api = wp.customize;

	// Prepare inline styles in the preview window
	if ( $style.length == 0 ) {
		var style_container = '<'+'style type="text/css" id="hoverex-customizer-inline-css" />',
			$theme_css = $('#hoverex-main-inline-css');
		if ($theme_css.length == 0)
			$theme_css = $('#hoverex-main-css');
		if ($theme_css.length == 0)
			$('head').append(style_container);
		else
			$theme_css.after(style_container);
		$style = $('#hoverex-customizer-inline-css');
	}

	// Refresh preview without page reload when controls are changed
	api.bind( 'preview-ready', function() {

		// Change css when color scheme or separate color controls are changed
		api.preview.bind( 'refresh-color-scheme-css', function( css ) {
			$style.html( css );
		} );

		// Any other controls are changed
		api.preview.bind( 'refresh-other-controls', function( obj ) {
			var id = obj.id, val = obj.value;

			if (id.indexOf('body_style') == 0) {
				change_class($('body'), 'body_style_', val);
				$(window).trigger('resize');

			} else if (id == 'color_scheme') {
				change_class($('body,html'), 'scheme_', val);

			} else if (id == 'header_scheme') {
				change_class($('.top_panel'), 'scheme_', val);

			} else if (id == 'menu_scheme') {
				change_class($('.menu_side_wrap, .menu_mobile'), 'scheme_', val);

			} else if (id == 'sidebar_scheme') {
				change_class($('.sidebar'), 'scheme_', val);

			} else if (id == 'footer_scheme') {
				change_class($('.footer_wrap, .footer_widgets_wrap, .footer_copyright_wrap'), 'scheme_', val);

			} else if (id == 'reviews_area_scheme') {
				change_class($('.single-product .trx-stretch-width-wrap'), 'scheme_', val);

			} else if (id == 'logo_zoom') {
				$('.custom-logo-link, .sc_layouts_logo').css('font-size', val+'em');

			} else if (id == 'header_zoom') {
				$('.sc_layouts_title_title').css('font-size', val+'em');

			} else if (id.indexOf('expand_content') == 0) {
				if ( $('body').hasClass('sidebar_hide') ) {
					if (val == 1)
						$('body').addClass('expand_content');
					else
						$('body').removeClass('expand_content');
				}

			} else if (id.indexOf('remove_margins') == 0) {
				if (val == 1)
					$('body').addClass('remove_margins');
				else
					$('body').removeClass('remove_margins');

			} else if (id.indexOf('sidebar_position') == 0) {
				if ($('body').hasClass('sidebar_show'))
					$('body').removeClass('sidebar_left sidebar_right').addClass('sidebar_'+val);

			} else if (id == 'blogname') {
				$('.sc_layouts_logo .logo_text').html( hoverex_prepare_macros(val) );

			} else if (id == 'blogdescription') {
				$( '.sc_layouts_logo .logo_slogan' ).html( hoverex_prepare_macros(val) );

			} else if (id == 'copyright') {
				$( '.copyright_text' ).html( hoverex_prepare_macros(val) );

			} else if ($('body').hasClass('frontpage')) {

				if (id == 'front_page_bg_image') {
					$('body').css('backgroundImage', 'url('+val+')');
				
				} else if (id.indexOf('front_page_')==0 && id.substr(-7)=='_scheme') {
					var section = id.replace('front_page_', '').replace('_scheme', '');
					change_class($('.front_page_section_'+section), 'scheme_', val);
	
				} else if (id.indexOf('front_page_')==0 && (id.substr(-9)=='_bg_color' || id.substr(-8)=='_bg_mask')) {
					var section = id.replace('front_page_', '').replace('_bg_color', '').replace('_bg_mask', '');
					var mask = id.indexOf('_bg_mask')>0 ? val : api('front_page_'+section+'_bg_mask')();
					var color = id.indexOf('_bg_color')>0 ? val : api('front_page_'+section+'_bg_color')();
					if (color)
						$('.front_page_section_'+section+'_inner').css('background-color', mask == 1 ? color : hoverex_hex2rgba(color, mask));
	
				} else if (id.indexOf('front_page_')==0 && id.substr(-9)=='_paddings') {
					var section = id.replace('front_page_', '').replace('_paddings', '');
					change_class($('.front_page_section_'+section), 'front_page_section_paddings_', val);

				} else if (id.indexOf('front_page_title_button')==0 && id.substr(-8)=='_caption') {
					$('.'+id.replace('_caption', '')).addClass('front_page_block_'+(val ? 'filled' : 'empty')).html(val);
	
				} else if (id.indexOf('front_page_')==0 && id.substr(-8)=='_caption') {
					$('.'+id.replace('front_page_', 'front_page_section_')).addClass('front_page_block_'+(val ? 'filled' : 'empty')).html(val);

				} else if (id.indexOf('front_page_')==0 && id.substr(-12)=='_description') {
					$('.'+id.replace('front_page_', 'front_page_section_')).addClass('front_page_block_'+(val ? 'filled' : 'empty')).html(val);

				} else if (id.indexOf('front_page_')==0 && id.substr(-8)=='_content') {
					$('.'+id.replace('front_page_', 'front_page_section_')).addClass('front_page_block_'+(val ? 'filled' : 'empty')).html(val);

				} else if (id.indexOf('front_page_')==0 && id.substr(-11)=='_fullheight') {
					$('.'+id.replace('front_page_', 'front_page_section_').replace('_fullheight', '_inner'))
							.height('auto')
							.toggleClass('hoverex-full-height sc_layouts_flex sc_layouts_columns_middle', val);
					$(window).trigger('resize');
				}
			}
		} );
		
		// Change class, started with 'prefix', on the new value
		function change_class(obj, prefix, val) {
			if (obj.length == 0) return;
			obj.each(function() {
				var c = $(this).attr('class').split(' ');
				var found = false;
				for (var i=0; i < c.length; i++) {
					if (c[i].indexOf(prefix) == 0) {
						if (val != '' && val != 'inherit')
							c[i] = prefix+val;
						else
							delete c[i];
						found = true;
						break;
					}
				}
				if (!found) c.push(prefix+val);
				$(this).attr('class', c.join(' '));
			});
		}
				
	} );

} )( jQuery );