<?php
if (!class_exists('VC_Extensions_CoverAnimation')) {
    class VC_Extensions_CoverAnimation{
        function __construct() {
            vc_map(array(
            "name" => __("Cover Animation", 'cq_allinone_vc'),
            "base" => "cq_vc_coveranimation",
            "class" => "wpb_cq_vc_extension_coveranimation",
            // "as_parent" => array('only' => 'cq_vc_coveranimation_item'),
            "icon" => "cq_vc_coveranimation",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Image hover effect', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Image:", "cq_allinone_vc"),
                "param_name" => "headerimage",
                "value" => "",
                "description" => __("Select image from media library.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Resize the image?", "cq_allinone_vc"),
                "param_name" => "isresize",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "description" => __("Choose to resize the image or not, useful if your original image is too large.", "cq_allinone_vc"),
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "cq_allinone_vc"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. ", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Animation direction", "cq_allinone_vc"),
                "param_name" => "direction",
                "value" => array("From Left" => "left", "From Right" => "right"),
                "std" => "right",
                "description" => __("Choose the hover animation direction.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Caption position", "cq_allinone_vc"),
                "param_name" => "captionpos",
                "value" => array("Upper Left" => "upperleft", "Upper Right" => "upperright", "Lower Left" => "lowerleft", "Lower Right" => "lowerright"),
                "std" => "lowerleft",
                "description" => __("Choose where to put the caption.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Display the caption area in:", "cq_allinone_vc"),
                "param_name" => "captionby",
                "value" => array('Always' => 'always', 'Only on user hover' => 'hover'),
                'std' => 'always',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Whole element shape", "cq_allinone_vc"),
                "param_name" => "elementshape",
                "value" => array('Square' => 'square', 'Rounded' => 'rounded', 'Round' => 'round'),
                'std' => 'square',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "checkbox",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Enter hover animation?", "cq_allinone_vc"),
                "param_name" => "enteranimation",
                "value" => "no",
                "description" => __("Display when it \"enters\" the browsers viewport (Note: works only in modern browsers).", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background color 1", 'cq_allinone_vc'),
                "param_name" => "bgcolor1",
                "value" => "",
                "description" => __("Backgroun color for the hover animation background.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background color 2", 'cq_allinone_vc'),
                "param_name" => "bgcolor2",
                "value" => "",
                "description" => __("Backgroun color for the hover animation background.", 'cq_allinone_vc')
              ),

              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Element height", "cq_allinone_vc"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("Default is auto, depends on the image, you can customize it with other value (like <strong>320px</strong> etc).", "cq_allinone_vc")
              ),
              // array(
              //     "type" => "checkbox",
              //     "edit_field_class" => "vc_col-xs-6 vc_column",
              //     "holder" => "",
              //     "heading" => __("Display the float block by default?", "cq_allinone_vc"),
              //     "param_name" => "isdisplay",
              //     "value" => "",
              //     "description" => __("The float block is hidden by default, check this if you want to display it by default.", "cq_allinone_vc")
              // ),
              // array(
              //   "type" => "dropdown",
              //   "edit_field_class" => "vc_col-xs-6 vc_column",
              //   "holder" => "",
              //   "class" => "cq_allinone_vc",
              //   "heading" => __("Display the text block below after:", "cq_allinone_vc"),
              //   "param_name" => "autodelay",
              //   'value' => array(2, 3, 4, 5, 7, 10, __( 'Disable (hide it by default)', 'cq_allinone_vc' ) => 0 ),
              //   'std' => 0,
              //   "description" => __("Display the text block after X seconds.", "cq_allinone_vc")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("Caption over the image (optional)", "cq_allinone_vc"),
                "param_name" => "title",
                "value" => "",
                "group" => "Caption",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "vc_link",
                "heading" => __( "Link for the caption (optional)", "cq_allinone_vc" ),
                "param_name" => "captionlink",
                "group" => "Caption",
                "description" => __( "", "cq_allinone_vc" )
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Caption color", 'cq_allinone_vc'),
                "param_name" => "titlecolor",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default is white.", 'cq_allinone_vc')
             ),
             array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Caption Background Color", 'cq_allinone_vc'),
                "param_name" => "captionbg",
                "value" => "",
                "group" => "Caption",
                "description" => __("", 'cq_allinone_vc')
            ),

             array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Caption font size", "cq_allinone_vc"),
                "param_name" => "titlesize",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default is 1.5em. You can customize it with other value, like <strong>14px</strong> or <strong>1.2em</strong> etc.", "cq_allinone_vc")
             ),
             // array(
             //    "type" => "textarea_html",
             //    "heading" => __("Content", "cq_allinone_vc"),
             //    "param_name" => "content",
             //    "value" => "",
             //    "group" => "Caption",
             //    "description" => __("", "cq_allinone_vc")
             //  ),
              array(
                "type" => "textfield",
                "heading" => __("Button text (optional button after the caption)", "cq_allinone_vc"),
                "param_name" => "buttontext",
                "value" => "",
                'group' => 'Button',
                "description" => __("Optional button under the title and description.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Button color", "cq_allinone_vc"),
                 "param_name" => "buttoncolor",
                 "value" => array('Blue' => 'blue', 'Turquoise' => 'turquoise', 'Pink' => 'pink', 'Violet' => 'violet', 'Peacoc' => 'peacoc', 'Chino' => 'chino', 'Vista Blue' => 'vista_blue', 'Black' => 'black', 'Grey' => 'grey', 'Orange' => 'orange', 'Sky' => 'sky', 'Green' => 'green', 'Sandy brown' => 'sandy_brown', 'Purple' => 'purple', 'White' => 'white'),
                'std' => 'blue',
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Button size", "cq_allinone_vc"),
                 "param_name" => "buttonsize",
                 "value" => array('Mini' => 'xs', 'Small' => 'sm', 'Large' => 'lg'),
                 'std' => 'xs',
                 'group' => 'Button',
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Button shape", "cq_allinone_vc"),
                "param_name" => "buttonshape",
                "value" => array('Rounded' => 'rounded', 'Square' => 'square', 'Round' => 'round'),
                'std' => 'rounded',
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
              // array(
              //   "type" => "dropdown",
              //   "edit_field_class" => "vc_col-xs-6 vc_column",
              //   "holder" => "",
              //   "heading" => __("Button alignment", "cq_allinone_vc"),
              //   "param_name" => "align",
              //   "value" => array('Inline' => 'inline', 'Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
              //   'std' => 'center',
              //   'group' => 'Button',
              //   "description" => __("", "cq_allinone_vc")
              // ),
              array(
                "type" => "vc_link",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("URL (Optional link for the button)", "cq_allinone_vc"),
                "param_name" => "buttonlink",
                "value" => "",
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "cq_allinone_vc"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "cq_allinone_vc")
              )

           )
        ));

        add_shortcode('cq_vc_coveranimation', array($this,'cq_vc_coveranimation_func'));

      }

      function cq_vc_coveranimation_func($atts, $content=null, $tag) {
          $headerimage = $imagewidth = $direction = $buttoncolor = $buttontext = $buttonshape = $buttonsize = $buttonlink = $align = $isdisplay = $titlecolor = $titlesize = $captionbg = $captionlink = $elementshape = $elementheight = $autodelay = $captionby = $captionpos = "";
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = '';
          extract(shortcode_atts(array(
            "headerimage" => "",
            "bgcolor" => "",
            "bgcolor1" => "",
            "bgcolor2" => "",
            "enteranimation" => "no",
            "captionby" => "always",
            "captionpos" => "lowerleft",
            "direction" => "right",
            "imagewidth" => "",
            "buttontext" => "",
            "buttoncolor" => "blue",
            "buttonsize" => "xs",
            "buttonshape" => "rounded",
            "buttonstyle" => "modern",
            "buttonlink" => "",
            "align" => "center",
            "autodelay" => "0",
            "titlecolor" => "",
            "captionbg" => "",
            "captionlink" => "",
            "titlesize" => "",
            "title" => "",
            "elementshape" => "square",
            "elementheight" => "",
            "icon_fontawesome" => 'fa fa-share',
            "icon_openiconic" => 'vc-oi vc-oi-dial',
            "icon_typicons" => 'typcn typcn-adjust-brightness',
            "icon_entypo" => 'entypo-icon entypo-icon-comment',
            "icon_linecons" => 'vc_li vc_li-heart',
            "icon_material" => 'vc-material vc-material-cake',
            "isresize" => "no",
            "isdisplay" => "",
            "bgheight" => "240",
            "contentcolor" => "",
            "captionoffset" => "",
            "captiontype" => "hideicon",
            "lightboxmargin" => "",
            "linktype" => "",
            "lightbox_url" => "",
            "videowidth" => "640",
            "cardlink" => "",
            "extraclass" => ""
          ), $atts));


          // $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

          $imagewidth = intval($imagewidth);
          $attachment = get_post($headerimage);
          $imageurl = wp_get_attachment_image_src($headerimage, 'full');
          $attachment = get_post($headerimage);
          $resizedimage = $imageurl[0];
          if($imagewidth>0){
              if(function_exists('wpb_resize')){
                  $resizedimage = wpb_resize($headerimage, null, $imagewidth, null);
                  $resizedimage = $resizedimage['url'];
                  if($resizedimage=="") $resizedimage = $imageurl[0];
              }
          }



          wp_register_style( 'vc-extensions-coveranimation-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-coveranimation-style' );


          wp_register_script('vc-extensions-coveranimation-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-coveranimation-script');

          $output = "";
          $text_str = "";
          $image_str = "";
          $style_str = "";

          $captionlink = vc_build_link($captionlink);
          $output .= '<div class="cq-coveranimation cq-coveranimation-direction-'.$direction.' cq-coveranimation-caption-'.$captionpos.' cq-coveranimation-'.$captionby.' cq-coveranimation-shape-'.$elementshape.' '.$extraclass.'" data-direction="'.$direction.'" data-bgcolor="'.$bgcolor.'" data-isdisplay="'.$isdisplay.'" data-elementheight="'.$elementheight.'" style="height:'.$elementheight.'" data-enter="'.$enteranimation.'">';

          $output .= '<div class="cq-coveranimation-caption" data-scroll="" style="background-color:'.$captionbg.';">';
          if($title != ""){
            if(isset($captionlink['url'])&&$captionlink['url']!=""){
                $output .= '<a href="'.$captionlink['url'].'" class="cq-coveranimation-link" title="'.$captionlink["title"].'" target="'.$captionlink["target"].'" style="color:'.$titlecolor.';font-size:'.$titlesize.';">';
            }
              $output .= $title;
            if(isset($captionlink['url'])&&$captionlink['url']!=""){
              $output .= '</a>';
            }

          }
          if($buttontext!=""){
              $output .= do_shortcode('[vc_btn title="'.$buttontext.'" color="'.$buttoncolor.'" style="'.$buttonstyle.'" shape="'.$buttonshape.'" link="'.$buttonlink.'" align="'.$align.'" size="'.$buttonsize.'"]');
          }
          $output .= '</div>';


          $text_str .= '<div class="cq-coveranimation-text" style="background-color:'.$bgcolor.'">';
          if($title != ""){
            $text_str .= '<h3 class="cq-coveranimation-title" style="color:'.$titlecolor.';font-size:'.$titlesize.'">'.$title.'</h3>';
          }
          if($buttontext!=""){
              $text_str .= do_shortcode('[vc_btn title="'.$buttontext.'" color="'.$buttoncolor.'" style="'.$buttonstyle.'" shape="'.$buttonshape.'" link="'.$buttonlink.'" align="'.$align.'" size="'.$buttonsize.'"]');
          }
          $text_str .= '<div class="cq-coveranimation-arrowcontainer"><div class="cq-coveranimation-arrow" style="'.$style_str.'"></div></div>';
          $text_str .= '</div>';
          // $image_str .= '<div class="cq-coveranimation-imagecontainer" style="background-image:url('.$resizedimage.');"></div>';


          $enter_class = "";
          // $enter_class = $enteranimation != "no" ? "wpb_animate_when_almost_visible" : "";
          $animate_class = $enteranimation != "no" ? "cq-coveranimation-slide" : "";
          $output .= '<div class="cq-coveranimation-beforecover '.$enter_class.' '.$animate_class.' " style="background-color:'.$bgcolor1.';"></div>';
          $output .= '<img class="cq-coveranimation-img" src="'.$resizedimage.'" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />';

          $output .= '<div class="cq-coveranimation-aftercover '.$animate_class.'" style="background-color:'.$bgcolor2.';"></div>';

          $output .= '</div>';
          return $output;

        }

  }

}

?>
