<?php
if (!class_exists('VC_Extensions_FloatCaption')) {
    class VC_Extensions_FloatCaption{
        function __construct() {
            vc_map(array(
            "name" => __("Float Caption", 'cq_allinone_vc'),
            "base" => "cq_vc_floatcaption",
            "class" => "wpb_cq_vc_extension_floatcaption",
            // "as_parent" => array('only' => 'cq_vc_floatcaption_item'),
            "icon" => "cq_vc_floatcaption",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Text block with image', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Header image (optional):", "cq_allinone_vc"),
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
                "heading" => __("Image / Text percent", "cq_allinone_vc"),
                "param_name" => "percent",
                "value" => array("60% / 40%" => "64", "50% / 50%" => "55", "40% / 60%" => "46", "70% / 30%" => "73", "30% / 70%" => "37", "80% / 20%" => "82", "20% / 80%" => "28"),
                "std" => "64",
                "description" => __("Choose where to put the image.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Caption position", "cq_allinone_vc"),
                "param_name" => "position",
                "value" => array("Left" => "left", "Right" => "right"),
                "std" => "right",
                "description" => __("Choose where to float the caption.", "cq_allinone_vc")
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
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background color for the caption", 'cq_allinone_vc'),
                "param_name" => "bgcolor",
                "value" => "",
                "description" => __("Background color for the title and description.", 'cq_allinone_vc')
              ),
              // array(
              //   "type" => "textfield",
              //   "edit_field_class" => "vc_col-xs-6 vc_column",
              //   "heading" => __("Element height", "cq_allinone_vc"),
              //   "param_name" => "elementheight",
              //   "value" => "",
              //   "description" => __("Default is <strong>300px</strong>, you can customize it with other value (like <strong>420px</strong> etc).", "cq_allinone_vc")
              // ),
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
                "heading" => __("Title (optional)", "cq_allinone_vc"),
                "param_name" => "title",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title color", 'cq_allinone_vc'),
                "param_name" => "titlecolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is white.", 'cq_allinone_vc')
             ),
             array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Title font size", "cq_allinone_vc"),
                "param_name" => "titlesize",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is 1.5em. You can customize it with other value, like <strong>14px</strong> or <strong>1.2em</strong> etc.", "cq_allinone_vc")
             ),
             // array(
             //    "type" => "textfield",
             //    "heading" => __("Description (optional)", "cq_allinone_vc"),
             //    "param_name" => "subtitle",
             //    "value" => "",
             //    "group" => "Text",
             //    "description" => __("Description under the title", "cq_allinone_vc")
             //  ),
             //  array(
             //    "type" => "colorpicker",
             //    "edit_field_class" => "vc_col-xs-6 vc_column",
             //    "holder" => "div",
             //    "class" => "",
             //    "heading" => __("Sub Title color", 'cq_allinone_vc'),
             //    "param_name" => "subtitlecolor",
             //    "value" => "",
             //    "group" => "Text",
             //    "description" => __("Default is white.", 'cq_allinone_vc')
             //  ),
             //  array(
             //    "type" => "textfield",
             //    "edit_field_class" => "vc_col-xs-6 vc_column",
             //    "heading" => __("Sub title font size", "cq_allinone_vc"),
             //    "param_name" => "subtitlesize",
             //    "value" => "",
             //    "group" => "Text",
             //    "description" => __("Default is 1em. You can customize it with other value, like <strong>14px</strong> or <strong>1.2em</strong> etc.", "cq_allinone_vc")
             //  ),
              array(
                "type" => "textarea_html",
                "heading" => __("Content", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Button text", "cq_allinone_vc"),
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
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Button alignment", "cq_allinone_vc"),
                "param_name" => "align",
                "value" => array('Inline' => 'inline', 'Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
                'std' => 'center',
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
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

        add_shortcode('cq_vc_floatcaption', array($this,'cq_vc_floatcaption_func'));

      }

      function cq_vc_floatcaption_func($atts, $content=null, $tag) {
          $headerimage = $imagewidth = $position = $buttoncolor = $buttontext = $buttonshape = $buttonsize = $buttonlink = $align = $isdisplay = $titlecolor = $titlesize = $elementshape =  $percent = "";
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = '';
          extract(shortcode_atts(array(
            "headerimage" => "",
            "percent" => "64",
            "bgcolor" => "",
            "position" => "right",
            "imagewidth" => "",
            "buttontext" => "",
            "buttoncolor" => "blue",
            "buttonsize" => "xs",
            "buttonshape" => "rounded",
            "buttonstyle" => "modern",
            "buttonlink" => "",
            "align" => "center",
            "titlecolor" => "",
            "titlesize" => "",
            "title" => "",
            "elementshape" => "square",
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



          wp_register_style( 'vc-extensions-floatcaption-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-floatcaption-style' );



          $output = "";
          $text_str = "";
          $image_str = "";

          $output .= '<div class="cq-floatcaption cq-floatcaption-position-'.$position.' cq-floatcaption-shape-'.$elementshape.' cq-floatcaption-percent-'.$percent.' '.$extraclass.'" data-position="'.$position.'">';

          $text_str .= '<div class="cq-floatcaption-text" style="background-color:'.$bgcolor.'">';
          if($title != ""){
            $text_str .= '<h3 class="cq-floatcaption-title" style="color:'.$titlecolor.';font-size:'.$titlesize.'">'.$title.'</h3>';
          }
          if($content != ""){
            $text_str .= '<p class="cq-floatcaption-description">'.$content.'</p>';
          };
          if($buttontext!=""){
              $text_str .= do_shortcode('[vc_btn title="'.$buttontext.'" color="'.$buttoncolor.'" style="'.$buttonstyle.'" shape="'.$buttonshape.'" link="'.$buttonlink.'" align="'.$align.'" size="'.$buttonsize.'"]');
          }
          $text_str .= '</div>';
          $image_str .= '<div class="cq-floatcaption-imagecontainer">';
          $image_str .= '<img class="cq-floatcaption-image" src="'.$resizedimage.'" />';
          $image_str .= '</div>';
          $output .= $image_str . $text_str;
          $output .= '</div>';
          return $output;

        }

  }

}

?>
