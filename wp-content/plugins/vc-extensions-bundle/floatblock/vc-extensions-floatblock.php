<?php
if (!class_exists('VC_Extensions_FloatBlock')) {
    class VC_Extensions_FloatBlock{
        function __construct() {
            vc_map(array(
            "name" => __("Float Block", 'cq_allinone_vc'),
            "base" => "cq_vc_floatblock",
            "class" => "wpb_cq_vc_extension_floatblock",
            // "as_parent" => array('only' => 'cq_vc_floatblock_item'),
            "icon" => "cq_vc_floatblock",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Fixed button with popup content', 'js_composer'),
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
                "heading" => __("Element position", "cq_allinone_vc"),
                "param_name" => "position",
                "value" => array("left top" => "left_top", "left center" => "left_center", "left bottom" => "left_bottom", "right top" => "right_top", "right center"=>"right_center", "right bottom" => "right_bottom"),
                "std" => "right_center",
                "description" => __("Choose where to put the element.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Whole element shape", "cq_allinone_vc"),
                "param_name" => "elementshape",
                "value" => array('Rounded' => 'rounded', 'Square' => 'square', 'Round' => 'round'),
                'std' => 'square',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Element width", "cq_allinone_vc"),
                "param_name" => "elementwidth",
                "value" => "",
                "description" => __("Default is <strong>300px</strong>, you can customize it with other value (like <strong>420px</strong> etc).", "cq_allinone_vc")
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
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Display the float block after seconds:", "cq_allinone_vc"),
                "param_name" => "autodelay",
                'value' => array(2, 3, 4, 5, 7, 10, __( 'Disable (hide it by default)', 'cq_allinone_vc' ) => 0 ),
                'std' => 0,
                "description" => __("Display the float block after X seconds.", "cq_allinone_vc")
              ),
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
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Title background color", "cq_allinone_vc"),
                 "param_name" => "titlebg",
                 "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent"),
                'std' => 'aqua',
                "group" => "Text",
                "description" => __("Select the built-in background color for the title.", "cq_allinone_vc")
              ),
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
                'group' => 'Text',
                "description" => __("Optional button under the content", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Button color", "cq_allinone_vc"),
                 "param_name" => "buttoncolor",
                 "value" => array('Blue' => 'blue', 'Turquoise' => 'turquoise', 'Pink' => 'pink', 'Violet' => 'violet', 'Peacoc' => 'peacoc', 'Chino' => 'chino', 'Vista Blue' => 'vista_blue', 'Black' => 'black', 'Grey' => 'grey', 'Orange' => 'orange', 'Sky' => 'sky', 'Green' => 'green', 'Sandy brown' => 'sandy_brown', 'Purple' => 'purple', 'White' => 'white'),
                'std' => 'blue',
                'group' => 'Text',
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
                 'group' => 'Text',
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
                'group' => 'Text',
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
                'group' => 'Text',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "vc_link",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("URL (Optional link for the button)", "cq_allinone_vc"),
                "param_name" => "buttonlink",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Toggle button size", "cq_allinone_vc"),
                "param_name" => "closebtnsize",
                "value" => array('small', 'medium', 'large'),
                'std' => 'medium',
                "group" => "Icon",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Icon library (select an icon for the toggle button)', 'js_composer' ),
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
                  'param_name' => 'buttonicon',
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
                    'element' => 'buttonicon',
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
                    'element' => 'buttonicon',
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
                    'element' => 'buttonicon',
                    'value' => 'typicons',
                  ),
                  "group" => "Icon",
                  'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                  'type' => 'iconpicker',
                  'heading' => __( 'Icon', 'js_composer' ),
                  'param_name' => 'icon_entypo',
                  'value' => 'entypo-icon entypo-icon-comment', // default value to backend editor admin_label
                  'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                  ),
                  "group" => "Icon",
                  'dependency' => array(
                    'element' => 'buttonicon',
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
                    'element' => 'buttonicon',
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
                    'element' => 'buttonicon',
                    'value' => 'material',
                  ),
                  "group" => "Icon",
                  'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color", 'cq_allinone_vc'),
                "param_name" => "togglebtncolor",
                "value" => "#FFF",
                "group" => "Icon",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Toggle button background color", 'cq_allinone_vc'),
                "param_name" => "togglebtnbg",
                "value" => "",
                "group" => "Icon",
                "description" => __("Default is blue.", 'cq_allinone_vc')
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

        add_shortcode('cq_vc_floatblock', array($this,'cq_vc_floatblock_func'));

      }

      function cq_vc_floatblock_func($atts, $content=null, $tag) {
          $headerimage = $imagewidth = $position = $buttoncolor = $buttontext = $buttonshape = $buttonsize = $buttonlink = $align = $closebtnsize = $isdisplay = $titlecolor = $titlebg = $elementshape = $elementwidth = $autodelay = "";
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = '';
          extract(shortcode_atts(array(
            "headerimage" => "",
            "position" => "right_center",
            "imagewidth" => "",
            "buttontext" => "",
            "buttoncolor" => "blue",
            "buttonsize" => "xs",
            "buttonshape" => "rounded",
            "buttonstyle" => "modern",
            "buttonlink" => "",
            "align" => "center",
            "autodelay" => "0",
            "closebtnsize" => "medium",
            "titlecolor" => "",
            "titlebg" => "aqua",
            "elementshape" => "square",
            "elementwidth" => "",
            "buttonicon" => "entypo",
            "icon_fontawesome" => 'fa fa-share',
            "icon_openiconic" => 'vc-oi vc-oi-dial',
            "icon_typicons" => 'typcn typcn-adjust-brightness',
            "icon_entypo" => 'entypo-icon entypo-icon-comment',
            "icon_linecons" => 'vc_li vc_li-heart',
            "icon_material" => 'vc-material vc-material-cake',
            "isresize" => "no",
            "isdisplay" => "",
            "togglebtncolor" => "",
            "togglebtnbg" => "",
            "bgheight" => "240",
            "title" => "",
            "subtitle" => "",
            "contentcolor" => "",
            "iconcolor" => "",
            "captionoffset" => "",
            "captiontype" => "hideicon",
            "lightboxmargin" => "",
            "linktype" => "",
            "lightbox_url" => "",
            "videowidth" => "640",
            "cardlink" => "",
            "extraclass" => ""
          ), $atts));


          vc_icon_element_fonts_enqueue('entypo');
          vc_icon_element_fonts_enqueue($buttonicon);

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



          wp_register_style( 'vc-extensions-floatblock-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-floatblock-style' );


          wp_register_script('vc-extensions-floatblock-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-floatblock-script');

          $output = "";
          $output .= '<div class="cq-floatblock cq-floatblock-position-'.$position.' cq-floatblock-shape-'.$elementshape.' cq-floatblock-btn-'.$closebtnsize.'" data-position="'.$position.'" data-isdisplay="'.$isdisplay.'" style="width:'.$elementwidth.'" data-elementwidth="'.$elementwidth.'" data-autodelay="'.$autodelay.'">';
          $output .= '<div class="cq-floatblock-header">';
          if($resizedimage!=""){
              $output .= '<img src="'.$resizedimage.'" class="cq-floatblock-image" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />';
          }
          $output .= '<div class="cq-floatblock-button" style="color:'.$togglebtncolor.';background:'.$togglebtnbg.'">';
          if(isset(${'icon_' . $buttonicon})){
            $output .= '<div class="cq-floatblock-iconcontainer">';
            $output .= '<i class="cq-floatblock-icon '.esc_attr(${'icon_' . $buttonicon}).'" style="color:'.$togglebtncolor.';"></i>';
            $output .= '</div>';
        }

          $output .= '</div>';
          $output .= '</div>';
          if($title!=""){
              $output .= '<div class="cq-floatblock-title cq-floatblock-'.$titlebg.'">
                          <h3 style="color:'.$titlecolor.'">'.$title.'</h3>
                          </div>';

          }
          $output .= '<div class="cq-floatblock-content">';
          if($content!=""){
              $output .= do_shortcode($content);
          }
          if($buttontext!=""){
              $output .= do_shortcode('[vc_btn title="'.$buttontext.'" color="'.$buttoncolor.'" style="'.$buttonstyle.'" shape="'.$buttonshape.'" link="'.$buttonlink.'" align="'.$align.'" size="'.$buttonsize.'"]');
          }
          $output .= '</div>';

          $output .= '</div>';
          return $output;

        }

  }

}

?>
