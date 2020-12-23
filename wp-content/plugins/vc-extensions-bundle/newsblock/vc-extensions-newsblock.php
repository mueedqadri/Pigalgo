<?php
if (!class_exists('VC_Extensions_NewsBlock')){
    class VC_Extensions_NewsBlock{
        private $title_color = "";
        private $label_color = "";
        private $content_color = "";
        function __construct() {
            vc_map(array(
            "name" => __("News Block", 'cq_allinone_vc'),
            "base" => "cq_vc_newsblock",
            "class" => "cq_vc_newsblock",
            "icon" => "cq_vc_newsblock",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_newsblock_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('News item one by one', 'js_composer'),
            "params" => array(
              // array(
              //   "type" => "textarea_html",
              //   "heading" => __("More description under the title", "cq_allinone_vc"),
              //   "param_name" => "content",
              //   "value" => "",
              //   "group" => "Text",
              //   "description" => __("", "cq_allinone_vc")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("Name for the cover:", "cq_allinone_vc"),
                "param_name" => "blockname",
                "value" => "",
                "description" => __("For example, NEWS. Can be displayed on the left or right. Default is empty.", "cq_allinone_vc")
              ),
              array(
                  "type" => "attach_image",
                  "heading" => __("Cover image for the name (optional):", "cq_allinone_vc"),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "param_name" => "image",
                  "value" => "",
                  "description" => __("Select from media library.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Cover width:", "cq_allinone_vc"),
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "param_name" => "coverwidth",
                "value" => "",
                "description" => __("Default is 120px, you can customize it with other value, like <strong>240px</strong> etc.", "cq_allinone_vc")
              ),
              array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "class" => "",
                  "heading" => __("Name color", 'cq_allinone_vc'),
                  "param_name" => "namecolor",
                  "value" => '',
                  "description" => __("", 'cq_allinone_vc')
              ),
              array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "class" => "",
                  "heading" => __("Cover background color", 'cq_allinone_vc'),
                  "param_name" => "namebgcolor",
                  "value" => '',
                  "description" => __("", 'cq_allinone_vc')
              ),
              array(
                  "type" => "dropdown",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "holder" => "",
                  "heading" => __("Display the name and cover on the:", "cq_allinone_vc"),
                  "param_name" => "namepos",
                  "value" => array("left", "right"),
                  'std' => 'left',
                  "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Element shape", "cq_allinone_vc"),
                "param_name" => "shape",
                "value" => array('Square' => 'square', 'Rounded' => 'rounded', 'Round' => 'round'),
                'std' => 'square',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                  "type" => "dropdown",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "holder" => "",
                  "heading" => __("Navigation arrow color:", "cq_allinone_vc"),
                  "param_name" => "arrowcolor",
                  "value" => array("black", "white", "blue"),
                  'std' => 'black',
                  "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Display next news after:", "cq_allinone_vc"),
                "param_name" => "autodelay",
                'value' => array(2, 3, 4, 5, 7, 10, __( 'Disable (hide it by default)', 'cq_allinone_vc' ) => 0 ),
                'std' => 0,
                "description" => __("Auto delay slideshow in X seconds.", "cq_allinone_vc")
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( 'Loop the news?', 'cq_allinone_vc' ),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  'param_name' => 'isloop',
                  'description' => __( 'Start to play first news after get the end or not.', 'cq_allinone_vc' ),
                  'std' => 'no',
                  'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' )
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( 'Hide the arrow navigation?', 'cq_allinone_vc' ),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  'param_name' => 'noarrow',
                  'description' => __( 'You can checked to hide the arrow navigation if slideshow is enabled.', 'cq_allinone_vc' ),
                  'std' => 'no',
                  'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' )
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( 'Disable slideshow after interation?', 'cq_allinone_vc' ),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  'param_name' => 'hoverdisable',
                  'description' => __( 'Disable the slideshow after user interaction with the element.', 'cq_allinone_vc' ),
                  'std' => 'no',
                  'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' )
              ),
              // array(
              //      "type" => "dropdown",
              //      "edit_field_class" => "vc_col-xs-6 vc_column",
              //      "holder" => "",
              //      "heading" => __("padding size of the cell", "cq_allinone_vc"),
              //      "param_name" => "paddingsize",
              //      "value" => array("small", "medium", "large"),
              //     'std' => 'small',
              //     "description" => __("Select the padding size for the text in the cell.", "cq_allinone_vc")
              // ),
              array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "class" => "",
                  "heading" => __("Title color", 'cq_allinone_vc'),
                  "param_name" => "titlecolor",
                  "value" => '',
                  "description" => __("Color for the news title", 'cq_allinone_vc')
                ),
              array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "class" => "",
                  "heading" => __("Content color", 'cq_allinone_vc'),
                  "param_name" => "contentcolor",
                  "value" => '',
                  "description" => __("Color for the news content.", 'cq_allinone_vc')
                ),
              array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "class" => "",
                  "heading" => __("Label color", 'cq_allinone_vc'),
                  "param_name" => "labelcolor",
                  "value" => '',
                  "description" => __("Color for the label.", 'cq_allinone_vc')
                ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Background color for whole element.", 'cq_allinone_vc'),
                "param_name" => "bgcolor",
                "value" => '',
                "description" => __("Default is transparent.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Height of the whole element", "cq_allinone_vc"),
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("Default is 160px, you can specify other value like <strong>240px</strong> etc here.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Width of the whole element", "cq_allinone_vc"),
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "param_name" => "elementwidth",
                "value" => "",
                "description" => __("Default is 100%, you can specify other value like <strong>80%</strong> etc here.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "cq_allinone_vc"),
                "edit_field_class" => "vc_col-xs-6 vc_column",
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
             "name" => __("News item","cq_allinone_vc"),
             "base" => "cq_vc_newsblock_item",
             "class" => "cq_vc_newsblock_item",
             "icon" => "cq_vc_newsblock_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add news content","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_newsblock'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  "type" => "textfield",
                  "heading" => __("Title", "cq_allinone_vc"),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "param_name" => "title",
                  "value" => "",
                  "group" => "Text",
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Title font size", "cq_allinone_vc"),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "param_name" => "titlesize",
                  "value" => "",
                  "group" => "Text",
                  "description" => __("Default is 1.5em. You can customize it with other value like <strong>1.8em</strong> or <strong>24px</strong>.", "cq_allinone_vc")
                ),
                array(
                  "type" => "vc_link",
                  "heading" => __("URL (Optional link for the item)", "cq_allinone_vc"),
                  "param_name" => "itemlink",
                  "value" => "",
                  "group" => "Text",
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                  "type" => "textarea_html",
                  "heading" => __("More description under the title", "cq_allinone_vc"),
                  "param_name" => "content",
                  "value" => "",
                  "group" => "Text",
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Label (optional)", "cq_allinone_vc"),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "param_name" => "label",
                  "value" => "",
                  "group" => "Text",
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Label font size", "cq_allinone_vc"),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "param_name" => "labelsize",
                  "value" => "",
                  "group" => "Text",
                  "description" => __("Default is 1em. You can customize it with other value like <strong>1.8em</strong> or <strong>24px</strong>.", "cq_allinone_vc")
                )

              ),
            )
        );

          add_shortcode('cq_vc_newsblock', array($this,'cq_vc_newsblock_func'));
          add_shortcode('cq_vc_newsblock_item', array($this,'cq_vc_newsblock_item_func'));

      }

      function cq_vc_newsblock_func($atts, $content=null) {
        $autodelay = $image = $namecolor = $coverwidth = $namepos = $arrowcolor = $isloop = $hoverdisable = $bgcolor = $shape = $titlecolor = $contentcolor = $labelcolor = $paddingsize = "";
        $css_class = $css = $title = $extraclass = $elementheight = $elementwidth = '';

        extract(shortcode_atts(array(
          "blockname" => "",
          "image" => "",
          "namecolor" => "",
          "coverwidth" => "",
          "namebgcolor" => "",
          "namepos" => "left",
          "titlecolor" => "",
          "contentcolor" => "",
          "labelcolor" => "",
          "arrowcolor" => "black",
          "autodelay" => "0",
          "isloop" => "no",
          "noarrow" => "no",
          "bgcolor" => "",
          "shape" => "square",
          "hoverdisable" => "no",
          "paddingsize" => "small",
          "title" => "",
          "elementheight" => "",
          "elementwidth" => "",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $this -> title_color = $titlecolor;
        $this -> label_color = $labelcolor;
        $this -> content_color = $contentcolor;

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_newsblock', $atts);

        wp_register_style('swiper', plugins_url('../cardslider/css/swiper.css', __FILE__));
        wp_enqueue_style('swiper');
        wp_register_style( 'vc-extensions-newsblock-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-newsblock-style' );

        wp_register_script('swiper', plugins_url('../cardslider/js/swiper.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('swiper');

        wp_register_script('vc-extensions-newsblock-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "swiper"));
        wp_enqueue_script('vc-extensions-newsblock-script');

        $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content


        $header_attachment = get_post($image);
        $headerimagearr = wp_get_attachment_image_src(trim($image), 'full');
        $header_image_temp = $header_image_url = "";
        $header_orgi_image = $headerimagearr[0];
        $header_image_url = $header_orgi_image;
        if( $imagewidth!="" ){
            if(function_exists('wpb_resize')){
                $header_image_temp = wpb_resize($image, null, $imagewidth, null);
                $header_image_url = $header_image_temp['url'];
                if($header_image_url=="") $header_image_url = $header_orgi_image;
            }
        }

        $output = '';
        $name_str = '';
        $content_str = '';
        $nav_str = '';


        $output .= '<div class="cq-newsblock cq-newsblock-padding-'.$paddingsize.' cq-newsblock-'.$shape.' cq-newsblock-align-'.$namepos.' '.$css_class.'" data-autodelay="'.$autodelay.'" data-isloop="'.$isloop.'" data-hoverdisable="'.$hoverdisable.'" style="height:'.$elementheight.';width:'.$elementwidth.';background-color:'.$bgcolor.';" >';

        $name_str .= '<div class="cq-newsblock-name" style="background-color:'.$namebgcolor.';background-image:url('.$header_image_url.');min-width:'.$coverwidth.'">';
        if($blockname != ""){
            $name_str .= '<h3 class="cq-newsblock-namelabel" style="color:'.$namecolor.'">';
            $name_str .= $blockname;
            $name_str .= '</h3>';
        }
        $name_str .= '</div>';
        $content_str .= '<div class="cq-newsblock-wrapper swiper-wrapper">';
        $content_str .= do_shortcode($content);
        $content_str .= '</div>';

        // $output .= '<div class="cq-newsblock-pagination"></div>';
        if($noarrow != "yes"){
          $nav_str .= '<div class="cq-newsblock-nav">';
          $nav_str .= '<div class="cq-newsblock-btnprev swiper-button-prev swiper-button-'.$arrowcolor.'">';
          $nav_str .= '</div>';
          $nav_str .= '<div class="cq-newsblock-btnnext swiper-button-next swiper-button-'.$arrowcolor.'">';
          $nav_str .= '</div>';
          $nav_str .= '</div>';
        }

        if($namepos == "left"){
           $output .= $name_str . $content_str . $nav_str;
        } else {
           $output .= $nav_str . $content_str . $name_str;
        }

        $output .= '</div>';
        return $output;

      }


      function cq_vc_newsblock_item_func($atts, $content=null, $tag) {
          $title = $itemlink = $titlesize = $labelsize = "";

          extract(shortcode_atts(array(
            "title" => "",
            "titlesize" => "",
            "label" => "",
            "labelsize" => "",
            "itemlink" => "",
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          $itemlink = vc_build_link($itemlink);


          $output = '';
          $output .= '<div class="cq-newsblock-item swiper-slide">';
          if($itemlink["url"]!=""){
              $output .= '<a href="'.$itemlink["url"].'" title="'.$itemlink["title"].'" target="'.$itemlink["target"].'" rel="'.$itemlink["rel"].'" class="cq-newsblock-link">';
          }else{
              $output .= '<div class="cq-newsblock-link">';
          }
          if($title!=""){
            $output .= '<h4 class="cq-newsblock-title" style="color:'.$this -> title_color.';font-size:'.$titlesize.';">';
            $output .= $title;
            $output .= '</h4>';
          }
          if($content != ""){
            $output .= '<div class="cq-newsblock-content" style="color:'.$this -> content_color.';">';
            $output .= $content;
            $output .= '</div>';
          }
          if($label != ""){
            $output .= '<span class="cq-newsblock-label" style="color:'.$this -> label_color.';font-size:'.$labelsize.';">';
            $output .= $label;
            $output .= '</span>';
          }

          if($itemlink["url"]!=""){
            $output .= '</a>';
          }else{
            $output .= '</div>';
          }
          $output .= '</div>';

          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_newsblock')) {
    class WPBakeryShortCode_cq_vc_newsblock extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_newsblock_item')) {
    class WPBakeryShortCode_cq_vc_newsblock_item extends WPBakeryShortCode {
    }
}

?>
