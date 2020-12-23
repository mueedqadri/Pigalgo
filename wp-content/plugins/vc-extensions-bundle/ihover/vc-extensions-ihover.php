<?php
if (!class_exists('VC_Extensions_iHover')) {

    class VC_Extensions_iHover {
        function __construct() {
          vc_map( array(
            "name" => __("iHover", 'vc_ihover_cq'),
            "base" => "cq_vc_ihover",
            "class" => "wpb_cq_vc_extension_ihover",
            "controls" => "full",
            "icon" => "cq_allinone_ihover",
            // "deprecated" => "4.5",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('Caption with transition', 'js_composer' ),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Image", "vc_ihover_cq"),
                "param_name" => "image",
                "value" => "",
                "description" => __("", "vc_ihover_cq")
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Resize image to this width", 'vc_ihover_cq'),
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "param_name" => "itemwidth",
                "value" => __("640", 'vc_ihover_cq'),
                "description" => __("Required for the circle shape. For example <strong>640</strong> will resize the image to be 640x640 in circle shape or 640 width with square shape. Leave it to be blank will use the original image (works fine with square shape).", 'vc_ihover_cq')
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Apply border to the image?", "vc_ihover_cq"),
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "param_name" => "imageborder",
                  "value" => array(__("No Border", "vc_ihover_cq") => 'none', __("Mini Border (2px)", "vc_ihover_cq") => 'mini', __("Small Border (4px)", "vc_ihover_cq") => 'small', __("Large Border (8px)", "vc_ihover_cq") => 'large', __("Extra Large Border (12px)", "vc_ihover_cq") => 'xlarge'),
                  "std" => "mini",
                  "description" => __('', 'vc_ihover_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Background color of the text:", "cq_allinone_vc"),
                "param_name" => "bgstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "White" => "white", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'darkgray',
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                  "class" => "vc_ihover_cq",
                  "type" => "colorpicker",
                  "heading" => __("Background color", "vc_ihover_cq"),
                  "param_name" => "bgcolor",
                  "value" => "",
                  "dependency" => Array('element' => "bgstyle", 'value' => array('customized')),
                  "group" => "Text",
                  "description" => __('Customize the background color', 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Title (optional)", 'vc_ihover_cq'),
                "param_name" => "thumbtitle",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("", 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("font-size of the title", 'vc_ihover_cq'),
                "param_name" => "titlesize",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("Default is <strong>22px</strong> (leave it to be blank), support other value like <strong>1.2em</strong>", 'vc_ihover_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-3 vc_column",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("title color", 'vc_ihover_cq'),
                "param_name" => "titlecolor",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("Default is white", 'vc_ihover_cq')
              ),
              array(
                  "type" => "dropdown",
                  "edit_field_class" => "vc_col-xs-3 vc_column",
                  "heading" => __("title underline", "vc_ihover_cq"),
                  "param_name" => "titleunderline",
                  "group" => "Text",
                  "value" => array(__("solid", "vc_ihover_cq") => 'solid', __("dotted", "vc_ihover_cq") => 'dotted', __("dashed", "vc_ihover_cq") => 'dashed', __("none", "vc_ihover_cq") => 'none'),
                  "std" => "solid",
                  "description" => __('Select the title underline', 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Description under the title (optional)", 'vc_ihover_cq'),
                "param_name" => "thumbdesc",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("", 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("font-size of the description", 'vc_ihover_cq'),
                "param_name" => "descsize",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("Default is <strong>12px</strong> (leave it to be blank), support other value like <strong>1em</strong>", 'vc_ihover_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("description color", 'vc_ihover_cq'),
                "param_name" => "desccolor",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("Default is white", 'vc_ihover_cq')
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'js_composer' ),
                'value' => array(
                  __( 'Entypo', 'js_composer' ) => 'entypo',
                  __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                  __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                  __( 'Typicons', 'js_composer' ) => 'typicons',
                  __( 'Linecons', 'js_composer' ) => 'linecons',
                  __( 'Material', 'js_composer' ) => 'material',
                  // __( 'Mono Social', 'js_composer' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'hovericon',
                "group" => "Text",
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
                  'element' => 'hovericon',
                  'value' => 'fontawesome',
                ),
                "group" => "Text",
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
                  'element' => 'hovericon',
                  'value' => 'openiconic',
                ),
                "group" => "Text",
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
                  'element' => 'hovericon',
                  'value' => 'typicons',
                ),
                "group" => "Text",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-export', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                "group" => "Text",
                'dependency' => array(
                  'element' => 'hovericon',
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
                  'element' => 'hovericon',
                  'value' => 'linecons',
                ),
                "group" => "Text",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_material',
                'value' => 'vc-material vc-material-cake',
                // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false,
                  // default true, display an "EMPTY" icon?
                  'type' => 'material',
                  'iconsPerPage' => 4000,
                  // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'hovericon',
                  'value' => 'material',
                ),
                "group" => "Text",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("font-size of the icon", 'vc_ihover_cq'),
                "param_name" => "iconsize",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("Default is <strong>1.8em</strong> (leave it to be blank)", 'vc_ihover_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("icon color", 'vc_ihover_cq'),
                "param_name" => "iconcolor",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("Default is white", 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("margin-top of the whole text", 'vc_ihover_cq'),
                "param_name" => "captionmargintop",
                "value" => __("", 'vc_ihover_cq'),
                "group" => "Text",
                "description" => __("The text will stay at middle by default. But you may have to specify the margin-top of it with some theme to align it middle. For example <strong>20px</strong> will move it down for 20px, and <strong>-20px</strong> will move it up (20px).", 'vc_ihover_cq')
              ),
              array(
                  "type" => "dropdown",
                  "edit_field_class" => "vc_col-xs-6 vc_column",
                  "heading" => __("Shape", "vc_ihover_cq"),
                  "param_name" => "shape",
                  "description" => __('Select the image shape.', 'vc_ihover_cq'),
                  "value" => array(__("square", "vc_ihover_cq") => 'square', __("circle", "vc_ihover_cq") => 'circle')
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Effect", "vc_ihover_cq"),
                "param_name" => "effect",
                "value" => array(__("effect1", "vc_ihover_cq") => "effect1", __("effect2", "vc_ihover_cq") => "effect2", __("effect3", "vc_ihover_cq") => "effect3", __("effect4", "vc_ihover_cq") => "effect4", __("effect5", "vc_ihover_cq") => "effect5", __("effect6", "vc_ihover_cq") => "effect6", __("effect7", "vc_ihover_cq") => "effect7", __("effect8", "vc_ihover_cq") => "effect8", __("effect9", "vc_ihover_cq") => "effect9", __("effect10", "vc_ihover_cq") => "effect10", __("effect11", "vc_ihover_cq") => "effect11", __("effect12", "vc_ihover_cq") => "effect12", __("effect13", "vc_ihover_cq") => "effect13", __("effect14", "vc_ihover_cq") => "effect14", __("effect15", "vc_ihover_cq") => "effect15", __("effect16 (available with circle only)", "vc_ihover_cq") => "effect16", __("effect17 (available with circle only)", "vc_ihover_cq") => "effect17", __("effect18 (available with circle only)", "vc_ihover_cq") => "effect18", __("effect19 (available with circle only)", "vc_ihover_cq") => "effect19", __("effect20 (available with circle only)", "vc_ihover_cq") => "effect20"),
                "std" => "effect1",
                "description" => __("Choose the hover effect.", "vc_ihover_cq")
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "vc_ihover_cq"),
                  "param_name" => "direction1",
                  "description" => __('The animaion direction', 'vc_ihover_cq'),
                  "value" => array(__("left_to_right", "vc_ihover_cq") => 'left_to_right', __("right_to_left", "vc_ihover_cq") => 'right_to_left', __("top_to_bottom", "vc_ihover_cq") => 'top_to_bottom', __("bottom_to_top", "vc_ihover_cq") => 'bottom_to_top'),
                  "std" => "left_to_right",
                  "description" => "Available with some direction-aware effect only.",
                  "dependency" => Array('element' => "effect", 'value' => array('effect1', 'effect2', 'effect3', 'effect4', 'effect5', 'effect7', 'effect8', 'effect9', 'effect10', 'effect11', 'effect12', 'effect13', 'effect14', 'effect15', 'effect16', 'effect17', 'effect18', 'effect19'))
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "vc_ihover_cq"),
                  "param_name" => "direction2",
                  "description" => __('The animaion direction', 'vc_ihover_cq'),
                  "value" => array(__("top_to_bottom", "vc_ihover_cq") => 'top_to_bottom', __("bottom_to_top", "vc_ihover_cq") => 'bottom_to_top'),
                  "std" => "top_to_bottom",
                  "description" => "Available with some direction-aware only.",
                  "dependency" => Array('element' => "effect", 'value' => array('effect20'))
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "vc_ihover_cq"),
                  "param_name" => "direction3",
                  "description" => __('The animaion direction', 'vc_ihover_cq'),
                  "value" => array(__("from_top_and_bottom", "vc_ihover_cq") => 'from_top_and_bottom', __("from_left_and_right", "vc_ihover_cq") => 'from_left_and_right', __("top_to_bottom", "vc_ihover_cq") => 'top_to_bottom', __("bottom_to_top", "vc_ihover_cq") => 'bottom_to_top'),
                  "std" => "from_top_and_bottom",
                  "description" => "Available with some direction-aware only.",
                  "dependency" => Array('element' => "effect", 'value' => array('effect6'))
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("On click", "vc_ihover_cq"),
                "param_name" => "onclick",
                "value" => array(__("open original image as large image (lightbox)", "vc_ihover_cq") => "link_image", __("open YouTube or Vimeo video (lightbox)", "vc_ihover_cq") => "link_video",  __("Open custom link", "vc_ihover_cq") => "custom_link", __("Do nothing", "vc_ihover_cq") => "link_no"),
                "group" => "Link",
                "description" => __("Define action for onclick event if needed.", "vc_ihover_cq")
              ),
              array(
                "type" => "vc_link",
                "heading" => __("Custom link", "vc_ihover_cq"),
                "param_name" => "custom_link",
                "description" => __('', 'vc_ihover_cq'),
                "group" => "Link",
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Video URL", 'vc_ihover_cq'),
                "param_name" => "videourl",
                "value" => __("", 'vc_ihover_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('link_video')),
                "group" => "Link",
                "description" => __("Just copy and paste the page URL of the <strong>YouTube</strong> or <strong>Vimeo</strong> video, something like <strong>https://www.youtube.com/watch?v=pNSKQ9Qp36M&autoplay=1</strong> or <strong>https://vimeo.com/127081676?autoplay=1</strong>. Add the <strong>autoplay=1</strong> in the URL to auto play the video.", 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Video width", 'vc_ihover_cq'),
                "param_name" => "videowidth",
                "value" => __("", 'vc_ihover_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('link_video')),
                "group" => "Link",
                "description" => __("The width of the popup video. Default is <strong>800</strong> (leave it to be blank).", 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Display the lightbox image in this same gallery:", 'vc_ihover_cq'),
                "param_name" => "galleryid",
                "value" => __("", 'vc_ihover_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('link_image')),
                "group" => "Link",
                "description" => __("You can specify a unique string for the lightbox gallery. For example <strong>gallery-1</strong>, then all the image with this string will open as a lightbox gallery.", 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_ihover_cq",
                "heading" => __("Element width", 'vc_ihover_cq'),
                "param_name" => "containerwidth",
                "value" => __("", 'vc_ihover_cq'),
                "description" => __("Default the image is <strong>100%</strong> width as the container, you can specify value like <strong>80%</strong> or <strong>240px</strong> etc", 'vc_ihover_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the element", "vc_ihover_cq"),
                "param_name" => "el_class",
                "description" => __("If you wish to style the element differently, then use this field to add a class name and then refer to it in your css file.", "vc_ihover_cq")
              )

            )
        ));

        add_shortcode('cq_vc_ihover', array($this,'cq_vc_ihover_func'));
      }

      function cq_vc_ihover_func($atts, $content=null, $tag) {
            $custom_link = $images = $thumbtitle = $thumbdesc = $effect = $direction1 = $containerwidth = $itemwidth = $margin = $shape = $bgstyle = $bgcolor = $titlesize = $titlecolor = $descsize = $desccolor = $imageborder = $titleunderline = $captionmargintop = $videourl = $videowidth = $galleryid = $el_class = "";
            $hovericon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_monosocial = $icon_material = $iconsize = $iconcolor = "";
            extract( shortcode_atts( array(
              'image' => '',
              'thumbtitle' => '',
              'thumbdesc' => '',
              'shape' => 'square',
              'effect' => 'effect1',
              'direction1' => 'left_to_right',
              'direction2' => 'top_to_bottom',
              'direction3' => 'from_top_and_bottom',
              'itemwidth' => '640',
              'margin' => '0',
              'containerwidth' => '',
              'onclick' => 'link_image',
              'custom_link' => '',
              'background' => '',
              'bgstyle' => 'darkgray',
              'bgcolor' => '',
              'titlesize' => '',
              'titlecolor' => '',
              'descsize' => '',
              'desccolor' => '',
              "hovericon" => 'entypo',
              "icon_fontawesome" => "fa fa-user",
              "icon_openiconic" => "vc-oi vc-oi-dial",
              "icon_typicons" => "typcn typcn-adjust-brightness",
              "icon_entypo" => "entypo-icon entypo-icon-export",
              "icon_linecons" => "vc_li vc_li-heart",
              "icon_material" => 'vc-material vc-material-cake',
              "icon_pixelicons" => "",
              "icon_monosocial" => "",
              "iconsize" => "",
              "iconcolor" => "",
              "imageborder" => "mini",
              "titleunderline" => "solid",
              "captionmargintop" => "",
              "videourl" => "",
              "videowidth" => "",
              "galleryid" => "",
              'el_class' => ''
            ), $atts ) );

          // wp_enqueue_style('cq_ihover_grid', plugins_url('css/ihover_grid.css', __FILE__));
          wp_register_style( 'vc_ihover_cq_style', plugins_url('css/ihover.css', __FILE__) );
          wp_enqueue_style( 'vc_ihover_cq_style' );
          wp_register_style('fs.boxer', plugins_url('css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');
          wp_register_style('formstone-lightbox', plugins_url('../videocover/css/lightbox.css', __FILE__));
          wp_enqueue_style('formstone-lightbox');
          wp_register_script('fs.boxer', plugins_url('js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');

          wp_register_script('formstone-lightbox', plugins_url('../videocover/js/lightbox.js', __FILE__));
          wp_enqueue_script('formstone-lightbox');
          wp_register_script('ihover.init', plugins_url('js/ihover.init.min.js', __FILE__), array('jquery', 'fs.boxer', 'formstone-lightbox'));
          wp_enqueue_script('ihover.init');

          vc_icon_element_fonts_enqueue($hovericon);

          $custom_link = vc_build_link($custom_link);
          global $post;
          // $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

          $direction = '';
          if($effect=="effect20"){
            $direction = $direction2;
          }else if($effect=="effect6"){
            $direction = $direction3;
          }else{
            $direction = $direction1;
          }
          $img_container = '';
          $info_container = '';
          $info_text = '';
          $thumb_title = '';
          $thumb_desc = '';
          $link_start = '';
          $link_end = '';
          $shape_start = '';
          $shape_end = '';
          $output = '';
          $output .= '<div class="cq-ihover '.$el_class.' cq-style-'.$bgstyle.' cq-ihover-border'.$imageborder.'"  data-effect="'.$effect.'" data-shape="'.$shape.'" data-bgcolor="'.$bgcolor.'" data-titlesize="'.$titlesize.'" data-titlecolor="'.$titlecolor.'" data-descsize="'.$descsize.'" data-desccolor="'.$desccolor.'" data-iconsize="'.$iconsize.'" data-iconcolor="'.$iconcolor.'" data-containerwidth="'.$containerwidth.'" data-captionmargintop="'.$captionmargintop.'" data-videowidth="'.$videowidth.'" data-bgstyle="'.$bgstyle.'">';
          // $gallery_id = $post->ID.rand(0, 100);
          $output .= '<div class="cq-ihover-container">';
          $return_img_arr = wp_get_attachment_image_src($image, 'full');
          if($return_img_arr){
                $attachment = get_post($image);
                if($shape=="circle"&&$effect=="effect13"){
                  if($direction=="left_to_right"||$direction=="right_to_left") $direction = "from_left_and_right";
                }
                if($shape=="circle"&&$effect=="effect1"){
                  $direction = "";
                }
                if($shape=="circle"&&$effect=="effect10"){
                  if($direction=="left_to_right") $direction = "top_to_bottom";
                  if($direction=="right_to_left") $direction = "bottom_to_top";
                }

                if($shape=="square"&&$effect=="effect1"){
                  if($direction=="left_to_right"||$direction=="right_to_left") $direction = "left_and_right";
                }
                if($shape=="square"&&$effect=="effect3"){
                  if($direction=="left_to_right") $direction = "top_to_bottom";
                  if($direction=="right_to_left") $direction = "bottom_to_top";
                }


                if($effect=="effect6" || $effect=="effect8"){
                  $shape_start .= "<div class='cq-ihover-item ".$shape." ".$effect." ".$direction." scale_up'>";
                }else{
                  $shape_start .= "<div class='cq-ihover-item ".$shape." ".$effect." ".$direction."'>";
                }
                // if($effect=="effect1"){
                //   if($shape=="circle") $img_container .= "<div class='spinner'></div>";
                // }
                if($effect=="effect8"){
                  $img_container .= "<div class='cq-ihover-imagecontainer'>";
                }
                $img_container .= "<div class='cq-ihover-imageitem'>";

                $img = $thumbnail = "";

                $fullimage = $return_img_arr[0];
                $thumbnail = $fullimage;
                if($itemwidth!=""){
                    if(function_exists('wpb_resize')){
                        if($shape=="circle"){
                          $img = wpb_resize($image, null, $itemwidth, $itemwidth, true);
                        }else{
                          $img = wpb_resize($image, null, $itemwidth, null, true);
                        }
                        $thumbnail = $img['url'];
                        if($thumbnail=="") $thumbnail = $fullimage;
                    }
                }else{

                    $thumbnail = $fullimage;
                }

                $img_container .= "<img src='".$thumbnail."' alt='".get_post_meta($attachment->ID, '_wp_attachment_image_alt', true )."' class='cq-ihover-image' />";
                $img_container .= "</div>";
                if($effect=="effect8"){
                  $img_container .= "</div>";
                }
                if($shape=="square"&&$effect=="effect4"){
                  $img_container .= "<div class='mask1'></div><div class='mask2'></div>";
                }
                if(($effect=="effect1"||$effect=="effect3")&&$shape=="square"){
                }else{
                    $info_text .= "<div class='cq-ihover-text'>";
                }
                if($thumbtitle!="")$info_text .= "<h3><span class='cq-ihover-title cq-title-".$titleunderline."'>".$thumbtitle."</span></h3>";
                if($thumbdesc!="")$info_text .= "<p class='cq-ihover-desc'>".$thumbdesc."</p>";
                if(($effect=="effect1"||$effect=="effect3")&&$shape=="square"){
                }else{
                  if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $hovericon})&&esc_attr(${'icon_' . $hovericon})!=""){
                        $info_text .= '<p class="cq-ihover-icontext"><i class="cq-ihover-icon '.esc_attr(${'icon_' . $hovericon}).'"></i></p>';
                  }

                }
                if(($effect=="effect1"||$effect=="effect3")&&$shape=="square"){
                }else{
                    $info_text .= "</div>";
                }

                if($shape=="circle"){
                  if($effect=="effect8"){
                    $info_container .= "<div class='info-container'>";
                    $info_container .= "<div class='cq-ihover-info'>";
                    $info_container .= $info_text;
                    $info_container .= "</div>";
                    $info_container .= "</div>";
                  }else{
                    $info_container .= "<div class='cq-ihover-info'>";
                    if($effect=="effect5"||$effect=="effect13"||$effect=="effect18"||$effect=="effect20"){
                      $info_container .= "<div class='cq-ihover-infoback'>";
                      $info_container .= $info_text;
                      $info_container .= "</div>";
                    }else{
                      $info_container .= $info_text;
                    }
                    $info_container .= "</div>";
                  }
                }else{
                  // specify element for the square
                  $info_container .= "<div class='cq-ihover-info'>";
                    if($effect=="effect9"){
                      $info_container .= "<div class='cq-ihover-infoback'>";
                      $info_container .= $info_text;
                      $info_container .= "</div>";
                    }else{
                      $info_container .= $info_text;
                    }
                    $info_container .= "</div>";

                }

                if($onclick=='link_image'){
                    if($galleryid!=""){
                        $link_start .= "<a href='".$return_img_arr[0]."' class='cq-ihover-lightbox' rel='".$galleryid."'>";
                    }else{
                        $link_start .= "<a href='".$return_img_arr[0]."' class='cq-ihover-lightbox'>";
                    }
                }else if($onclick=="link_video"){
                  $link_start .= "<a href='".$videourl."' class='cq-ihover-lightbox'>";
                }else if($onclick=='custom_link'){
                    $link_start .= "<a href='".$custom_link['url']."' title='".$custom_link['title']."' target='".$custom_link['target']."' rel='".$custom_link['rel']."'>";
                }else{
                  $link_start .= "<a href='#' class='ihover-nothing'>";
                }

          }
          $link_end .= "</a>";
          $shape_end .= "</div>";
          $output .= $shape_start.$link_start.$img_container.$info_container.$link_end.$shape_end;
          $output .= '</div>';

          $output .= '</div>';
          // $output .= '</div>';

          return $output;

        }


  }


}

?>
