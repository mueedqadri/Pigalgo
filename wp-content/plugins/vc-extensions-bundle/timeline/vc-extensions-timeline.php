<?php
if (!class_exists('VC_Extensions_TimeLine')){
    class VC_Extensions_TimeLine{
        function __construct() {
            vc_map(array(
            "name" => __("TimeLine", 'cq_allinone_vc'),
            "base" => "cq_vc_timeline",
            "class" => "cq_vc_timeline",
            "icon" => "cq_vc_timeline",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_timeline_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('responsive timeline', 'js_composer'),
            "params" => array(
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Timeline content rounded radius", "cq_allinone_vc"),
                 "param_name" => "roundradius",
                 "value" => array("small (4px)" => "small", "medium (8px)" => "medium", "large (16px)" => "large", "square (0px)" => "square"),
                'std' => 'small',
                "description" => __("Select the built in rounded radius for the timeline content.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Timeline border color", "cq_allinone_vc"),
                 "param_name" => "bordercolor",
                 "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent"),
                'std' => 'aqua',
                "description" => __("Select the built-in color for the border.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Timeline border size", "cq_allinone_vc"),
                 "param_name" => "bordersize",
                 "value" => array("small (2px)" => "small", "large (4px)" => "large", "tiny (1px)" => "tiny"),
                'std' => 'small',
                "description" => __("Select the built in border size for the timeline.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("customize background color for the border", 'cq_allinone_vc'),
                "param_name" => "bordercustomcolor",
                "value" => "",
                'dependency' => array('element' => 'bordercolor', 'value' => 'customized',
                ),
                "description" => __("", 'cq_allinone_vc')
              ),
              array(
                "type" => "checkbox",
                "heading" => __("Move the timeline item when user hover?", "cq_allinone_vc"),
                "param_name" => "ismove",
                "value" => "no",
                "description" => __("", "cq_allinone_vc")
              ),
              // array(
              //   "type" => "checkbox",
              //   "heading" => __("Display the timeline content on the right side only?", "cq_allinone_vc"),
              //   "param_name" => "isright",
              //   "value" => "no",
              //   "description" => __("", "cq_allinone_vc")
              // ),
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
             "name" => __("TimeLine Item","cq_allinone_vc"),
             "base" => "cq_vc_timeline_item",
             "class" => "cq_vc_timeline_item",
             "icon" => "cq_vc_timeline_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add timeline content","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_timeline'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  'type' => 'dropdown',
                  'heading' => __( 'Icon library', 'js_composer' ),
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
                  "group" => "Icon",
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
                  "group" => "Icon",
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
                  "group" => "Icon",
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
                  "group" => "Icon",
                  'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                  'type' => 'iconpicker',
                  'heading' => __( 'Icon', 'js_composer' ),
                  'param_name' => 'icon_entypo',
                  'value' => 'entypo-icon entypo-icon-user', // default value to backend editor admin_label
                  'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                  ),
                  "group" => "Icon",
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
                  "group" => "Icon",
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
                  "group" => "Icon",
                  'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                   "type" => "dropdown",
                   "edit_field_class" => "vc_col-xs-6 vc_column",
                   "holder" => "",
                   "heading" => __("Icon background color", "cq_allinone_vc"),
                   "param_name" => "iconbgstyle",
                   "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent"),
                  'std' => 'mediumgray',
                  'group' => 'Icon',
                  "description" => __("Select the built in background color for the icon.", "cq_allinone_vc")
                ),
                array(
                  "type" => "colorpicker",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "class" => "",
                  "heading" => __("Icon color", 'cq_allinone_vc'),
                  "param_name" => "iconcolor",
                  "value" => "",
                  'group' => 'Icon',
                  "description" => __("Default is white.", 'cq_allinone_vc')
                ),
                array(
                   "type" => "dropdown",
                   "holder" => "",
                   "heading" => __("Background color", "cq_allinone_vc"),
                   "param_name" => "itembackground",
                   "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent", "or customize :" => "customized"),
                  'std' => 'aqua',
                  "description" => __("Select the built in background color for the timeline content.", "cq_allinone_vc")
                ),
                array(
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => __("customize background color for icon", 'cq_allinone_vc'),
                  "param_name" => "itembackgroundcolor",
                  "value" => "",
                  'dependency' => array('element' => 'itembackground', 'value' => 'customized',
                  ),
                  "description" => __("", 'cq_allinone_vc')
                ),
              array(
                "type" => "textfield",
                "heading" => __("Main label around the icon(optional)", "cq_allinone_vc"),
                "param_name" => "itemdate",
                "value" => "",
              "description" => __("Main label around the icon, can be a date (like <strong>Dec 5, 2017</strong>) or name.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Main label font size", "cq_allinone_vc"),
                "param_name" => "datesize",
                "value" => "",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Main label color", 'cq_allinone_vc'),
                "param_name" => "datecolor",
                "value" => "",
                "description" => __("", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Sub label (optional)", "cq_allinone_vc"),
                "param_name" => "itemlabel",
                "value" => "",
                "description" => __("Optional sub label under the main label. Can be a role like <strong>Web Developer</strong>.", "cq_allinone_vc")
              ),

              // array(
              //   "type" => "vc_link",
              //   "heading" => __("URL (Optional link for the current icon)", "vc_colorblock_cq"),
              //   "param_name" => "itemlink",
              //   "value" => "",
              //   "description" => __("", "vc_colorblock_cq")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("Title of the timeline (optional)", "cq_allinone_vc"),
                "param_name" => "itemtitle",
                "value" => "",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Title font size", "cq_allinone_vc"),
                "param_name" => "titlesize",
                "value" => "",
                "description" => __("Optional title in the timeline content.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Title color", 'cq_allinone_vc'),
                "param_name" => "titlecolor",
                "value" => "",
                "description" => __("", 'cq_allinone_vc')
              ),
              array(
                "type" => "textarea_html",
                "heading" => __("Timeline content", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "description" => __("You can put more details about the title.", "cq_allinone_vc")
              )
              ),
            )
        );

          add_shortcode('cq_vc_timeline', array($this,'cq_vc_timeline_func'));
          add_shortcode('cq_vc_timeline_item', array($this,'cq_vc_timeline_item_func'));

      }

      function cq_vc_timeline_func($atts, $content=null) {
        $css_class = $css = $ismove = $isright = $bordercolor = $roundradius = $bordersize = $bordercustomcolor = $extraclass = '';
        extract(shortcode_atts(array(
          "roundradius" => "small",
          "bordersize" => "small",
          "ismove" => "",
          "isright" => "",
          "bordercolor" => "aqua",
          "bordercustomcolor" => "",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_timeline', $atts);
        wp_register_style( 'vc-extensions-timeline-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-timeline-style' );

        // wp_register_script('vc-extensions-timeline-script', plugins_url('js/init.js', __FILE__), array("jquery"));
        // wp_enqueue_script('vc-extensions-timeline-script');

        $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

        $output = '';
        $output .= '<div class="cq-timeline cq-timeline-border-'.$bordersize.' cq-timeline-round-'.$roundradius.' cq-timeline-move'.$ismove.' cq-timeline-border'.$bordercolor.' '.$extraclass.' '.$css_class.'" data-bordercustomcolor="'.$bordercustomcolor.'">';
        $output .= '<ul class="cq-timeline-list">';
        $output .= do_shortcode($content);
        $output .= '</ul>';
        $output .= '</div>';
        return $output;

      }


      function cq_vc_timeline_item_func($atts, $content=null, $tag) {
          $title = $contentcolor = $itemtitle = $itemdate = $itemlabel = $itemlink = $itembackground = $itembackgroundcolor = $timelineicon = $titlesize = $titlecolor = $datesize = $datecolor = "";
          $iconbgstyle = $iconcolor = $iconbgcolor = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = '';
          extract(shortcode_atts(array(
            "itembackground" => "aqua",
            "itembackgroundcolor" => "",
            "title" => "",
            "itemtitle" => "",
            "itemdate" => "",
            "itemlabel" => "",
            "titlecolor" => "",
            "titlesize" => "",
            "datecolor" => "",
            "datesize" => "",
            "contentcolor" => "",
            "itemlink" => "",
            "iconcolor" => "",
            "iconbgstyle" => "mediumgray",
            "icon_fontawesome" => "fa fa-user",
            "icon_openiconic" => "vc-oi vc-oi-dial",
            "icon_typicons" => "typcn typcn-adjust-brightness",
            "icon_entypo" => "entypo-icon entypo-icon-user",
            "icon_linecons" => "vc_li vc_li-heart",
            "icon_material" => "vc-material vc-material-arrow_forward",
            "timelineicon" => "entypo",
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          // $itemlink = vc_build_link($itemlink);

          vc_icon_element_fonts_enqueue($timelineicon);
          $output = '';
          $output .= '<li class="cq-timeline-row cq-timeline-style-'.$itembackground.'" data-contentcolor="'.$contentcolor.'">';
          $output .= '<div class="cq-timeline-item">';
          $output .= '<div class="cq-timeline-contentcontainer">';
          if(isset(${'icon_' . $timelineicon})){
            $output .= '<div class="cq-timeline-icon-'.$iconbgstyle.' cq-timeline-iconcontainer">';
            $output .= '<i class="cq-timeline-icon '.esc_attr(${'icon_' . $timelineicon}).'" style="color:'.$iconcolor.';background-color:'.$iconbgcolor.';"></i>';
            $output .= '</div>';
        }

          $output .= '<div class="cq-timeline-content">';
          if($itemtitle!=""){
              $output .= '<h4 class="cq-timeline-title" style="color:'.$titlecolor.';font-size:'.$titlesize.';"> '.$itemtitle.'</h4>';
          }
          if($content!=""){
              $output .= '<p class="cq-timeline-text"> '.do_shortcode($content).'</p>';
          }
          $output .= '</div>';

          $output .= '</div>';
          $output .= '<div class="cq-timeline-label">';
          $output .= '<p class="cq-timeline-text" style="color:'.$titlecolor.';font-size:'.$titlesize.';">';
          if($itemlabel!=""){
              $output .= $itemlabel;
              $output .= '<br />';
          }
          if($itemdate!=""){
              $output .= $itemdate;
          }
          $output .= '</p>';
          $output .= '</div>';

          $output .= '</div>';

          $output .= '</li>';
          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_timeline')) {
    class WPBakeryShortCode_cq_vc_timeline extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_timeline_item')) {
    class WPBakeryShortCode_cq_vc_timeline_item extends WPBakeryShortCode {
    }
}

?>
