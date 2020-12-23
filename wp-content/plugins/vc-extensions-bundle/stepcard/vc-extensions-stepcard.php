<?php
if (!class_exists('VC_Extensions_StepCard')){
    class VC_Extensions_StepCard{
        private $nextstep_str = "";
        function __construct() {
            vc_map(array(
            "name" => __("Step Card", 'cq_allinone_vc'),
            "base" => "cq_vc_stepcard",
            "class" => "cq_vc_stepcard",
            "icon" => "cq_vc_stepcard",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_stepcard_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('auto delay step instruction', 'js_composer'),
            "params" => array(
              array(
                "type" => "textfield",
                "heading" => __("Customize item height", "cq_allinone_vc"),
                "param_name" => "itemheight",
                "value" => "",
                "description" => __('Enter item height in pixels, for example: 400. Leave empty to use default 300 (pixels).', "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "heading" => __("Auto delay slideshow", "cq_allinone_vc"),
                 "param_name" => "autoslide",
                 "value" => array("no", "2", "3", "4", "5", "6", "7", "8"),
                 "std" => "no",
                 "description" => __("In seconds, default is no, which is disabled.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Card style (color of the card in the background)", "cq_allinone_vc"),
                 "param_name" => "cardstyle",
                 "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent (no colored background and the step bar below)" => "transparent"),
                'std' => 'aqua',
                 "std" => "60",
                 "description" => __("Select the built in background card color style.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Next step button", "cq_allinone_vc"),
                "param_name" => "steplabel",
                "value" => "Next Step",
                "description" => __("The next step button.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                 "heading" => __("Display the next step button on the:", "cq_allinone_vc"),
                 "param_name" => "stepbtnposition",
                 "value" => array("left", "right"),
                 "std" => "left",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                 "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                "class" => "",
                "heading" => __("Color of the next step button", 'cq_allinone_vc'),
                "param_name" => "nextbtncolor",
                "value" => "",
                "description" => __("Default is same as the link color of the theme.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Label font-size", "cq_allinone_vc"),
                "param_name" => "labelfontsize",
                "value" => "",
                "description" => __("Default (leave to blank) is 1em, support a value like <strong>12px</strong> or <strong>1.2em</strong>", "cq_allinone_vc")
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library (append to the next step button)', 'js_composer' ),
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
                'param_name' => 'stepicon',
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
                  'element' => 'stepicon',
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
                  'element' => 'stepicon',
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
                  'element' => 'stepicon',
                  'value' => 'typicons',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-right-open-big', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'stepicon',
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
                  'element' => 'stepicon',
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
                  'element' => 'stepicon',
                  'value' => 'material',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "class" => "",
                "heading" => __("Icon size", "cq_allinone_vc"),
                "param_name" => "iconsize",
                "value" => "",
                "description" => __('Default is 28px (leave to blank). Support a value like <strong>2em</strong> or <strong>32px</strong>', "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "class" => "",
                "heading" => __("Icon color", 'cq_allinone_vc'),
                "param_name" => "iconcolor",
                "value" => "",
                "description" => __("Default is gray.", 'cq_allinone_vc')
              ),
              array(
                'type' => 'checkbox',
                'heading' => __('Display the item background color same as the bar?', 'cq_allinone_vc' ),
                'param_name' => 'bgstyle',
                'std' => 'no',
                'description' => __("Check this if you want to display the item background color same as the bar. Default is white. Or you can customize the background color below.", 'cq_allinone_vc' ),
                'value' => array( __( 'Yes, display the colored background', 'cq_allinone_vc' ) => 'yes' ),
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Background color of the card item", 'cq_allinone_vc'),
                "param_name" => "backgroundcolor",
                "value" => "",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Text color of the card", 'cq_allinone_vc'),
                "param_name" => "textcolor",
                "value" => "",
                "description" => __("Default is gray.", 'cq_allinone_vc')
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
             "name" => __("Step Item","cq_allinone_vc"),
             "base" => "cq_vc_stepcard_item",
             "class" => "cq_vc_stepcard_item",
             "icon" => "cq_vc_stepcard_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add image, icon and text","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_stepcard'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
              array(
                "type" => "textarea_html",
                "heading" => __("Content", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "group" => "Text",
                "description" => __("The slide in content.", "cq_allinone_vc")
              )
              ),
            )
        );

          add_shortcode('cq_vc_stepcard', array($this,'cq_vc_stepcard_func'));
          add_shortcode('cq_vc_stepcard_item', array($this,'cq_vc_stepcard_item_func'));

      }

      function cq_vc_stepcard_func($atts, $content=null) {
        $css_class = $css = $transparentitem = $autoslide = $itemsize = $itemheight = $cardstyle = $openfirst = $labelfontsize = $nocircular = $bgstyle = $backgroundcolor = $textcolor = $nextbtncolor = $steplabel = $stepbtnposition = $stepicon = $iconcolor = $extraclass = '';
        $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = "";
        extract(shortcode_atts(array(
          "autoslide" => "no",
          "transparentitem" => "yes",
          "itemsize" => "",
          "cardstyle" => "aqua",
          "itemheight" => "",
          "openfirst" => "no",
          "labelfontsize" => "",
          "nocircular" => "",
          "css" => "",
          "bgstyle" => "",
          "backgroundcolor" => "",
          "textcolor" => "",
          "nextbtncolor" => "",
          "steplabel" => "Next Step",
          "stepbtnposition" => "left",
          "stepicon" => "entypo",
          "iconcolor" => "",
          "icon_fontawesome" => "fa fa-user",
          "icon_openiconic" => "vc-oi vc-oi-dial",
          "icon_typicons" => "typcn typcn-adjust-brightness",
          "icon_entypo" => "entypo-icon entypo-icon-right-open-big",
          "icon_linecons" => "vc_li vc_li-heart",
          "icon_material" => "vc-material vc-material-arrow_forward",
          "extraclass" => ""
        ),$atts));

        $output = "";
        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_stepcard', $atts);
        wp_register_style( 'vc-extensions-stepcard-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-stepcard-style' );

        wp_register_style('perfect-scrollbar', plugins_url('../draggabletimeline/css/perfect-scrollbar.min.css', __FILE__));
        wp_enqueue_style('perfect-scrollbar');

        wp_register_script('perfect-scrollbar', plugins_url('../draggabletimeline/js/perfect-scrollbar.jquery.min.js', __FILE__), array("jquery"));
         wp_enqueue_script('perfect-scrollbar');
        wp_register_script('vc-extensions-stepcard-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "perfect-scrollbar"));
        wp_enqueue_script('vc-extensions-stepcard-script');
        vc_icon_element_fonts_enqueue($stepicon);
        if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $stepicon})&&esc_attr(${'icon_' . $stepicon})!=""){
            $this -> nextstep_str = '<p class="cq-stepcard-nextstep cq-stepcard-btn'.$stepbtnposition.'"><a class="cq-stepcard-button" href="#">'.$steplabel.' <i class="cq-stepcard-icon '.esc_attr(${'icon_' . $stepicon}).'"></i></a></p>';
        }else{

          $this -> nextstep_str = '<p class="cq-stepcard-nextstep cq-stepcard-btn'.$stepbtnposition.'"><a class="cq-stepcard-button" href="#">'.$steplabel.'</a></p>';
        }


        $output .= '<div class="cq-stepcard  cq-stepcard-samebg-'.$bgstyle.' cq-stepcard-'.$cardstyle.' '.$extraclass.' '.$css_class.'" data-itemheight="'.$itemheight.'" data-autoslide="'.$autoslide.'" data-itemsize="'.$itemsize.'" data-transparentitem="'.$transparentitem.'" data-openfirst="'.$openfirst.'" data-labelfontsize="'.$labelfontsize.'" data-nocircular="'.$nocircular.'" data-cardstyle="'.$cardstyle.'" data-bgstyle="'.$bgstyle.'" data-backgroundcolor="'.$backgroundcolor.'" data-textcolor="'.$textcolor.'" data-nextbtncolor="'.$nextbtncolor.'" data-iconcolor="'.$iconcolor.'">';
          $output .= '<div class="cq-stepcard-cardcontainer">';
          $output .= do_shortcode($content);
          $output .= '<div class="cq-stepcard-stepcontainer">
                        <div class="cq-stepcard-step"></div>
                    </div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }


      function cq_vc_stepcard_item_func($atts, $content=null, $tag) {
          extract(shortcode_atts(array(
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          $output = '';
          $output .= '<div class="cq-stepcard-item">';
          $output .= '<div class="cq-stepcard-content">';
          $output .= '<div class="cq-stepcard-text">';
          $output .= do_shortcode($content);
          $output .= '</div>';
          $output .= '</div>';
          $output .= $this -> nextstep_str;
          $output .= '</div>';
          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_stepcard')) {
    class WPBakeryShortCode_cq_vc_stepcard extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_stepcard_item')) {
    class WPBakeryShortCode_cq_vc_stepcard_item extends WPBakeryShortCode {
    }
}

?>
