<?php
if (!class_exists('VC_Extensions_ImageCompare')){
    class VC_Extensions_ImageCompare{
        private $imgnum = 1;
        private $caption_str = '';
        // private $imagewidth = '';
        function __construct() {
            vc_map(array(
            "name" => __("Image Compare", 'cq_allinone_vc'),
            "base" => "cq_vc_imagecompare",
            "class" => "cq_vc_imagecompare",
            "icon" => "cq_vc_imagecompare",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_imagecompare_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('Two image with caption', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Auto delay slide", "cq_allinone_vc"),
                "param_name" => "autodelay",
                'value' => array(2, 3, 4, 5, 7, 10, __( 'Disable', 'cq_allinone_vc' ) => 0 ),
                'std' => 0,
                "description" => __("Auto slide the image in each X seconds.", "cq_allinone_vc")
              ),
              // array(
              //    "type" => "dropdown",
              //    "edit_field_class" => "vc_col-xs-6 vc_column",
              //    "holder" => "",
              //    "heading" => __("Caption background color", "cq_allinone_vc"),
              //    "param_name" => "captionbg",
              //    "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent"),
              //   'std' => 'aqua',
              //   "description" => __("Select the built-in color for the caption background.", "cq_allinone_vc")
              // ),
              array(
                 "type" => "dropdown",
                 // "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Container shape", "cq_allinone_vc"),
                 "param_name" => "containershape",
                 "value" => array('Rounded' => 'rounded', 'Square' => 'square', 'Round' => 'round'),
                 'std' => 'square',
                 "description" => __("Select the built in shape for the container.", "cq_allinone_vc")
              ),
              // array(
              //   "type" => "colorpicker",
              //   "class" => "",
              //   "heading" => __("customize background color for the border", 'cq_allinone_vc'),
              //   "param_name" => "bgcolor",
              //   "value" => "",
              //   'dependency' => array('element' => 'captionbg', 'value' => 'customized',
              //   ),
              //   "description" => __("", 'cq_allinone_vc')
              // ),
              // array(
              //   "type" => "checkbox",
              //   "heading" => __("Move the imagecompare item when user hover?", "cq_allinone_vc"),
              //   "param_name" => "ismove",
              //   "value" => "no",
              //   "description" => __("", "cq_allinone_vc")
              // ),
              // array(
              //   "type" => "checkbox",
              //   "heading" => __("Display the imagecompare content on the right side only?", "cq_allinone_vc"),
              //   "param_name" => "isright",
              //   "value" => "no",
              //   "description" => __("", "cq_allinone_vc")
              // ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Minimal height of the element", "cq_allinone_vc"),
                "param_name" => "minheight",
                "value" => "",
                "description" => __("The minimal height of whole element, default is 270 (in pixel).", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
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
             "name" => __("Image Compare Item","cq_allinone_vc"),
             "base" => "cq_vc_imagecompare_item",
             "class" => "cq_vc_imagecompare_item",
             "icon" => "cq_vc_imagecompare_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add image and text","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_imagecompare'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  "type" => "attach_image",
                  "heading" => __("Image", "cq_allinone_vc"),
                  "param_name" => "image",
                  "value" => "",
                  "description" => __("Select image from media library.", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  // "edit_field_class" => "vc_col-xs-6 vc_column",
                  "heading" => __("Resize the image to this width?", "cq_allinone_vc"),
                  "param_name" => "imagewidth",
                  "value" => "",
                  "description" => __("You can specify a value (like 400) if want to resize the image. Leave it to be blank if you want to use the original image.", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Title (optional)", "cq_allinone_vc"),
                  "param_name" => "title",
                  "value" => "",
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "heading" => __("title font size", "cq_allinone_vc"),
                  "param_name" => "titlefontsize",
                  "value" => "",
                  "description" => __("default is 1.2em, you can specify other value like <strong>16px</strong> or <strong>1.5em</strong>.", "cq_allinone_vc")
                ),
                array(
                  "type" => "colorpicker",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "class" => "",
                  "heading" => __("title color", 'cq_allinone_vc'),
                  "param_name" => "titlecolor",
                  "value" => "",
                  "description" => __("default is white.", 'cq_allinone_vc')
                ),
                // array(
                //   "type" => "textarea",
                //   "heading" => __("Description", "cq_allinone_vc"),
                //   "param_name" => "description",
                //   "value" => "",
                //   "description" => __("", "cq_allinone_vc")
                // ),
                array(
                   "type" => "dropdown",
                   "holder" => "",
                   "heading" => __("Dispaly button under the text?", "cq_allinone_vc"),
                   "param_name" => "isbutton",
                   "value" => array("yes", "no"),
                  'std' => 'yes',
                  'group' => 'Button',
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Button text", "cq_allinone_vc"),
                  "param_name" => "buttontext",
                  "value" => "",
                  'group' => 'Button',
                  'dependency' => array('element' => 'isbutton', 'value' => 'yes'),
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                   "type" => "dropdown",
                   "edit_field_class" => "vc_col-xs-6 vc_column",
                   "holder" => "",
                   "heading" => __("Color", "cq_allinone_vc"),
                   "param_name" => "buttoncolor",
                   "value" => array('Blue' => 'blue', 'Turquoise' => 'turquoise', 'Pink' => 'pink', 'Violet' => 'violet', 'Peacoc' => 'peacoc', 'Chino' => 'chino', 'Vista Blue' => 'vista_blue', 'Black' => 'black', 'Grey' => 'grey', 'Orange' => 'orange', 'Sky' => 'sky', 'Green' => 'green', 'Juicy pink' => 'juicy_pink', 'Sandy brown' => 'sandy_brown', 'Purple' => 'purple', 'White' => 'white'),
                  'std' => 'blue',
                  'group' => 'Button',
                  'dependency' => array('element' => 'isbutton', 'value' => 'yes'),
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                   "type" => "dropdown",
                   "edit_field_class" => "vc_col-xs-6 vc_column",
                   "holder" => "",
                   "heading" => __("Size", "cq_allinone_vc"),
                   "param_name" => "buttonsize",
                   "value" => array('Mini' => 'xs', 'Small' => 'sm',),
                  'std' => 'xs',
                  'group' => 'Button',
                  'dependency' => array('element' => 'isbutton', 'value' => 'yes'),
                  "description" => __("", "cq_allinone_vc")
                ),
                // array(
                //    "type" => "dropdown",
                //    "edit_field_class" => "vc_col-xs-6 vc_column",
                //    "holder" => "",
                //    "heading" => __("Style", "cq_allinone_vc"),
                //    "param_name" => "buttonstyle",
                //    "value" => array('Flat' => 'falt', 'Modern' => 'modern', 'Classic' => 'classic', 'Outlined' => 'outlined', '3D' => '3d'),
                //   'std' => 'modern',
                //   'group' => 'Button',
                //   'dependency' => array('element' => 'isbutton', 'value' => 'yes'),
                //   "description" => __("", "cq_allinone_vc")
                // ),
                array(
                  "type" => "dropdown",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "holder" => "",
                  "heading" => __("Shape", "cq_allinone_vc"),
                  "param_name" => "buttonshape",
                  "value" => array('Rounded' => 'rounded', 'Square' => 'square', 'Round' => 'round'),
                  'std' => 'rounded',
                  'group' => 'Button',
                  'dependency' => array('element' => 'isbutton', 'value' => 'yes'),
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                  "type" => "vc_link",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "heading" => __("URL (Optional link for the button)", "cq_allinone_vc"),
                  "param_name" => "buttonlink",
                  "value" => "",
                  'group' => 'Button',
                  'dependency' => array('element' => 'isbutton', 'value' => 'yes'),
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                   "type" => "dropdown",
                   "holder" => "",
                   "heading" => __("Background color", "cq_allinone_vc"),
                   "param_name" => "itembackground",
                   "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent", "or customize :" => "customized"),
                  'std' => 'aqua',
                  'group' => 'Background',
                  "description" => __("Select the built in background color for the text area.", "cq_allinone_vc")
                ),
                array(
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => __("customize background color for icon", 'cq_allinone_vc'),
                  "param_name" => "itembackgroundcolor",
                  "value" => "",
                  'dependency' => array('element' => 'itembackground', 'value' => 'customized',
                  ),
                  'group' => 'Background',
                  "description" => __("", 'cq_allinone_vc')
                ),
              array(
                "type" => "textarea_html",
                "heading" => __("More description under the title", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "description" => __("You can put more description about the image.", "cq_allinone_vc")
              )
              ),
            )
        );

          add_shortcode('cq_vc_imagecompare', array($this,'cq_vc_imagecompare_func'));
          add_shortcode('cq_vc_imagecompare_item', array($this,'cq_vc_imagecompare_item_func'));

      }

      function cq_vc_imagecompare_func($atts, $content=null) {
        $css_class = $css = $ismove = $isright = $captionbg = $containershape = $bgcolor = $minheight = $extraclass = $autodelay = '';
        $this -> caption_str = '';
        $this -> imgnum = 1;

        extract(shortcode_atts(array(
          "autodelay" => "0",
          "containershape" => "square",
          "ismove" => "",
          "isright" => "",
          "captionbg" => "aqua",
          "bgcolor" => "",
          "minheight" => "",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_imagecompare', $atts);
        wp_register_style( 'vc-extensions-imagecompare-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-imagecompare-style' );

        wp_register_script('vc-extensions-imagecompare-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
        wp_enqueue_script('vc-extensions-imagecompare-script');

        $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

        $output = '';
        $output .= '<div class="cq-imagecompare cq-imagecompare-shape-'.$containershape.' cq-imagecompare-bg-'.$captionbg.' '.$extraclass.' '.$css_class.'" data-bgcolor="'.$bgcolor.'" data-autodelay="'.$autodelay.'" data-minheight="'.$minheight.'">';
        $output .= '<div class="cq-imagecompare-contentcontainer">';
        $output .= '<div class="cq-imagecompare-captioncontainer">
                    '.$this->caption_str.'
                    </div>';
        $output .= '<div class="cq-imagecompare-imagecontainer">
                      '.do_shortcode($content).'
                      <button class="cq-imagecompare-btn"><i class="cq-imagecompare-icon entypo-icon entypo-icon-left-open-big"></i></button>
                    </div> ';
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }


      function cq_vc_imagecompare_item_func($atts, $content=null, $tag) {
          $title = $contentcolor = $itemlink = $itembackground = $itembackgroundcolor = $image = $title = $buttoncolor = $buttontext = $buttonshape = $buttonsize = $buttonlink = $titlefontsize = $titlecolor = $imagewidth = "";
          $imagecompareicon = "entypo";
          $buttonstyle = "modern";

          extract(shortcode_atts(array(
            "image" => "",
            "imagewidth" => "",
            "title" => "",
            "titlefontsize" => "",
            "titlecolor" => "",
            "buttontext" => "",
            "buttoncolor" => "blue",
            "buttonsize" => "xs",
            "buttonshape" => "rounded",
            "buttonstyle" => "modern",
            "buttonlink" => "",
            "itembackground" => "aqua",
            "itembackgroundcolor" => "",
            "title" => "",
            "contentcolor" => "",
            "itemlink" => "",
            "icon_fontawesome" => "fa fa-user",
            "icon_openiconic" => "vc-oi vc-oi-dial",
            "icon_typicons" => "typcn typcn-adjust-brightness",
            "icon_entypo" => "entypo-icon entypo-icon-user",
            "icon_linecons" => "vc_li vc_li-heart",
            "icon_material" => "vc-material vc-material-arrow_forward",
            "imagecompareicon" => "entypo",
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          // $itemlink = vc_build_link($itemlink);

          vc_icon_element_fonts_enqueue($imagecompareicon);


          $imgnum = $this -> imgnum;
          $imagewidth = intval($imagewidth);

          $imageurl = wp_get_attachment_image_src($image, 'full');
          $attachment = get_post($image);
          $resizedimage = $imageurl[0];
          if($imagewidth>0){
              if(function_exists('wpb_resize')){
                  $resizedimage = wpb_resize($image, null, $imagewidth, null);
                  $resizedimage = $resizedimage['url'];
                  if($resizedimage=="") $resizedimage = $imageurl[0];
              }
          }


          $output = '';

          $caption_str = $this -> caption_str;
          if($imgnum<=2){
              $caption_str .= '<div class="cq-imagecompare-caption cq-imagecompare-item-'.$itembackground.'" style="background-color:'.$itembackgroundcolor.'">';
              if($title!="")$caption_str .= '<h4 class="cq-imagecompare-title" style="color:'.$titlecolor.';font-size:'.$titlefontsize.'">'.$title.'</h4>';
              if($content!="")$caption_str .= '<div class="cq-imagecompare-text">'.$content.'</div>';
              if($buttontext!="")$caption_str .= do_shortcode('[vc_btn title="'.$buttontext.'" color="'.$buttoncolor.'" style="'.$buttonstyle.'" shape="'.$buttonshape.'" link="'.$buttonlink.'" size="'.$buttonsize.'"]');
              $caption_str .= '</div>';
              $this -> caption_str = $caption_str;

              $output .= '<div class="cq-imagecompare-img'.$imgnum.'" style="background:url('.$resizedimage.') no-repeat center;background-position:center center;background-size:cover;"></div>';
          }
          $imgnum++;
          $this -> imgnum = $imgnum;
          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_imagecompare')) {
    class WPBakeryShortCode_cq_vc_imagecompare extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_imagecompare_item')) {
    class WPBakeryShortCode_cq_vc_imagecompare_item extends WPBakeryShortCode {
    }
}

?>
