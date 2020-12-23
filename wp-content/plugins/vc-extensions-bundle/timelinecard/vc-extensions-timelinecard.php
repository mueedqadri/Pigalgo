<?php
if (!class_exists('VC_Extensions_TimelineCard')){
    class VC_Extensions_TimelineCard{
        function __construct() {
            vc_map(array(
            "name" => __("Timeline Card", 'cq_allinone_vc'),
            "base" => "cq_vc_timelinecard",
            "class" => "cq_vc_timelinecard",
            "icon" => "cq_vc_timelinecard",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_timelinecard_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('Timeline in a card', 'js_composer'),
            "params" => array(
              array(
                "type" => "textfield",
                "heading" => __("Title of the card", "cq_allinone_vc"),
                "param_name" => "title",
                "value" => "",
                "description" => __('Title of the whole timeline.', "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Title font-size", "cq_allinone_vc"),
                "param_name" => "titlefontsize",
                "value" => "",
                "description" => __("Default (leave to blank) is 1.6em, support a value like <strong>12px</strong> or <strong>1.2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Title color", 'cq_allinone_vc'),
                "param_name" => "titlecolor",
                "value" => "",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Sub title of the card", "cq_allinone_vc"),
                "param_name" => "subtitle",
                "value" => "",
                "description" => __('Sub title under the main title.', "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Sub title font-size", "cq_allinone_vc"),
                "param_name" => "subtitlefontsize",
                "value" => "",
                "description" => __("Default (leave to blank) is 1em, support a value like <strong>12px</strong> or <strong>1.2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Sub title color", 'cq_allinone_vc'),
                "param_name" => "subtitlecolor",
                "value" => "",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("icon size (icon in the timeline item)", "cq_allinone_vc"),
                "param_name" => "iconsize",
                "value" => array("small (24px)" => "small", "medium (36px)" => "medium", "large (48px)" => "large"),
                'std' => 'small',
                "description" => __("Select the icon size for the timeline content.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("shadow for the whole element", "cq_allinone_vc"),
                "param_name" => "shadowsize",
                "value" => array("large", "small", "none"),
                'std' => 'small',
                "description" => __("Select element shadow.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("overlay style (color of the header overlay)", "cq_allinone_vc"),
                 "param_name" => "overlaystyle",
                 "value" => array("Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent"),
                'std' => 'aqua',
                "description" => __("Select the built in header overlay color.", "cq_allinone_vc")
              ),
              array(
                "type" => "attach_image",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Background image for the header (optional)", "cq_allinone_vc"),
                "param_name" => "headerimage",
                "value" => "",
                "description" => __("Select image from media library.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("overlay color for the header", 'cq_allinone_vc'),
                "param_name" => "overlaycolor",
                "value" => "",
                "description" => __("", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("color of the border under the icons", 'cq_allinone_vc'),
                "param_name" => "bordercolor",
                "value" => "",
                "description" => __("Default is light gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "cq_allinone_vc"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "cq_allinone_vc")
              ),
              array(
                "type" => "css_editor",
                "heading" => __( "CSS", "cq_allinone_vc" ),
                "param_name" => "css",
                "description" => __("It's recommended to use this to customize the padding/margin only.", "cq_allinone_vc"),
                "group" => __( "Design options", "cq_allinone_vc" ),
             )
           )
        ));

        vc_map(
          array(
             "name" => __("Timeline Item","cq_allinone_vc"),
             "base" => "cq_vc_timelinecard_item",
             "class" => "cq_vc_timelinecard_item",
             "icon" => "cq_vc_timelinecard_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add icon, date, text etc","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_timelinecard'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
              array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library (for the timeline item)', 'js_composer' ),
                'value' => array(
                  __( 'Entypo', 'js_composer' ) => 'entypo',
                  __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                  __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                  __( 'Typicons', 'js_composer' ) => 'typicons',
                  __( 'Material', 'js_composer' ) => 'material',
                  __( 'Linecons', 'js_composer' ) => 'linecons',
                  // __( 'Mono Social', 'js_composer' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'timelineicon',
                'description' => __( 'Select icon library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-user', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'fontawesome',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                  'element' => 'timelineicon',
                  'value' => 'fontawesome',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'openiconic',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'timelineicon',
                  'value' => 'openiconic',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'typicons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'timelineicon',
                  'value' => 'typicons',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-vcard', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'timelineicon',
                  'value' => 'entypo',
                ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'linecons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'timelineicon',
                  'value' => 'linecons',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_material',
                'value' => 'vc-material vc-material-arrow_forward',
                // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false,
                  // default true, display an "EMPTY" icon?
                  'type' => 'material',
                  'iconsPerPage' => 4000,
                  // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'timelineicon',
                  'value' => 'material',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "class" => "",
                "heading" => __("Icon color", 'cq_allinone_vc'),
                "param_name" => "iconcolor",
                "value" => "",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "class" => "",
                "heading" => __("Icon background color", 'cq_allinone_vc'),
                "param_name" => "iconbgcolor",
                "value" => "",
                "description" => __("", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-8 vc_column",
                "heading" => __("Date", "cq_allinone_vc"),
                "param_name" => "date",
                "value" => "",
                "description" => __("For example: Feb 2015 to Apr 2016", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-4 vc_column",
                "class" => "",
                "heading" => __("date color", 'cq_allinone_vc'),
                "param_name" => "datecolor",
                "value" => "",
                "description" => __("Default is gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-8 vc_column",
                "heading" => __("Title", "cq_allinone_vc"),
                "param_name" => "title",
                "value" => "",
                "description" => __("Title for the timeline item, for example your job title: Web Developer", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-4 vc_column",
                "class" => "",
                "heading" => __("title color", 'cq_allinone_vc'),
                "param_name" => "titlecolor",
                "value" => "",
                "description" => __("Default is gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textarea_html",
                "heading" => __("More information for the timeline item", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "description" => __("It's under the title, you can put more details about the title.", "cq_allinone_vc")
              )
              ),
            )
        );

          add_shortcode('cq_vc_timelinecard', array($this,'cq_vc_timelinecard_func'));
          add_shortcode('cq_vc_timelinecard_item', array($this,'cq_vc_timelinecard_item_func'));

      }

      function cq_vc_timelinecard_func($atts, $content=null) {
        $css_class = $css = $autoslide = $overlaystyle = $titlecolor = $titlefontsize = $subtitlefontsize = $subtitlecolor = $nextbtncolor = $timelineicon = $subtitle = $title = $headerimage = $headerwidth = $overlaycolor = $iconsize = $shadowsize = $bordercolor = $extraclass = '';
        extract(shortcode_atts(array(
          "headerimage" => "",
          "headerwidth" => "",
          "title" => "",
          "subtitle" => "",
          "autoslide" => "no",
          "overlaystyle" => "aqua",
          "titlefontsize" => "",
          "css" => "",
          "titlecolor" => "",
          "subtitlefontsize" => "",
          "subtitlecolor" => "",
          "nextbtncolor" => "",
          "iconsize" => "small",
          "overlaycolor" => "",
          "shadowsize" => "large",
          "bordercolor" => "",
          "extraclass" => ""
        ),$atts));

        $output = "";
        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_timelinecard', $atts);
        wp_register_style( 'vc-extensions-timelinecard-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-timelinecard-style' );

        wp_register_script('vc-extensions-timelinecard-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
        wp_enqueue_script('vc-extensions-timelinecard-script');

        $headearimagearr = wp_get_attachment_image_src(trim($headerimage), 'full');
        $header_image_temp = $headerimage = "";
        $header_full_image = $headearimagearr[0];
        $headerimage = $header_full_image;
        $header_attachment = get_post($headerimage);
        if($headerwidth!=""){
            if(function_exists('wpb_resize')){
                $header_image_temp = wpb_resize($image, null, $headerwidth, null);
                $headerimage = $header_image_temp['url'];
                if($headerimage=="") $headerimage = $header_full_image;
            }
        }


        $output .= '<div class="cq-timelinecard '.$overlaystyle.' cq-timelinecard-shadow'.$shadowsize.' cq-timelinecard-icon'.$iconsize.' '.$extraclass.' '.$css_class.'" data-autoslide="'.$autoslide.'" data-overlaystyle="'.$overlaystyle.'" data-nextbtncolor="'.$nextbtncolor.'" data-titlecolor="'.$titlecolor.'" data-subtitlecolor="'.$subtitlecolor.'" data-titlefontsize="'.$titlefontsize.'" data-subtitlefontsize="'.$subtitlefontsize.'" data-bordercolor="'.$bordercolor.'">';
        $output .= '<div class="cq-timelinecard-container">';
        $output .= '<div class="cq-timelinecard-header" style="background-image:url('.$headerimage.');">';
        $output .= '<div class="cq-timelinecard-overlay" style="background-color:'.$overlaycolor.'">';
        $output .= '<div class="cq-timelinecard-headertitle">'.$title.'</div>';
        $output .= '<div class="cq-timelinecard-headersub">'.$subtitle.'</div> ';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="cq-timelinecard-content">';
        $output .= '<div class="cq-timelinecard-border"></div>';
        $output .= '<ul class="cq-timelinecard-list">';
        $output .= do_shortcode($content);
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }


      function cq_vc_timelinecard_item_func($atts, $content=null, $tag) {
          $iconcolor = $iconbgcolor = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = $date = $datecolor = $title = $titlecolor = "";
          extract(shortcode_atts(array(
            "timelineicon" => "entypo",
            "iconcolor" => "",
            "iconbgcolor" => "",
            "icon_fontawesome" => "fa fa-user",
            "icon_openiconic" => "vc-oi vc-oi-dial",
            "icon_typicons" => "typcn typcn-adjust-brightness",
            "icon_entypo" => "entypo-icon entypo-icon-vcard",
            "icon_linecons" => "vc_li vc_li-heart",
            "icon_material" => "vc-material vc-material-arrow_forward",
            "date" => "",
            "title" => "",
            "datecolor" => "",
            "titlecolor" => "",
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          vc_icon_element_fonts_enqueue($timelineicon);

          $output = '';
          $output .= '<li class="cq-timelinecard-listitem" data-iconcolor="'.$iconcolor.'" data-iconbgcolor="'.$iconbgcolor.'" data-titlecolor="'.$titlecolor.'" data-datecolor="'.$datecolor.'">';
          $output .= '<div class="cq-timelinecard-iconcontainer"><i class="cq-timelinecard-icon '.esc_attr(${'icon_' . $timelineicon}).'"></i></div>';
          $output .= '<div class="cq-timelinecard-date">';
          $output .= $date;
          $output .= '</div>';
          $output .= '<div class="cq-timelinecard-text">';
          $output .= '<h3 class="cq-timelinecard-title">';
          $output .= $title;
          $output .= '</h3>';
          $output .= do_shortcode($content);
          $output .= '</div>';
          $output .= '</li>';
          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_timelinecard')) {
    class WPBakeryShortCode_cq_vc_timelinecard extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_timelinecard_item')) {
    class WPBakeryShortCode_cq_vc_timelinecard_item extends WPBakeryShortCode {
    }
}

?>
