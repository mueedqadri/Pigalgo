<?php
if (!class_exists('VC_Extensions_GradientBox')) {
    class VC_Extensions_GradientBox{
        function __construct() {
          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
            vc_map(array(
            "name" => __("Gradient Box", 'vc_gradientbox_cq'),
            "base" => "cq_vc_gradientbox",
            "class" => "wpb_cq_vc_extension_gradientbox",
            // "as_parent" => array('only' => 'cq_vc_gradientbox_item'),
            "icon" => "cq_allinone_gradientbox",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Content with image or icon', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Display avatar on the top:", "vc_gradientbox_cq"),
                "param_name" => "avatartype",
                "value" => array("None (text only)" => "none", "Icon (select icon below)" => "icon", "Image" => "image"),
                "group" => "Avatar",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Image", "vc_gradientbox_cq"),
                "param_name" => "avatarimage",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "group" => "Avatar",
                "description" => __("Select image from media library.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Resize the image?", "vc_gradientbox_cq"),
                "param_name" => "resizeavatarimage",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "group" => "Avatar",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_gradientbox_cq"),
                "param_name" => "avatarimagewidth",
                "value" => "",
                "dependency" => Array('element' => "resizeavatarimage", 'value' => array('yes')),
                "group" => "Avatar",
                "description" => __("For example, 800 will resize the image to width 800.", "vc_gradientbox_cq")
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'js_composer' ),
                'value' => array(
                  __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                  __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                  __( 'Typicons', 'js_composer' ) => 'typicons',
                  __( 'Entypo', 'js_composer' ) => 'entypo',
                  __( 'Linecons', 'js_composer' ) => 'linecons',
                  __( 'Material', 'js_composer' ) => 'material',
                ),
                'admin_label' => true,
                'param_name' => 'avataricon',
                'dependency' => array('element' => 'avatartype', 'value' => 'icon',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-heart', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                  'element' => 'avataricon',
                  'value' => 'fontawesome',
                ),
                "group" => "Avatar",
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
                  'element' => 'avataricon',
                  'value' => 'openiconic',
                ),
                "group" => "Avatar",
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
                  'element' => 'avataricon',
                  'value' => 'typicons',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                "group" => "Avatar",
                'dependency' => array(
                  'element' => 'avataricon',
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
                  'element' => 'avataricon',
                  'value' => 'linecons',
                ),
                "group" => "Avatar",
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
                  'element' => 'avataricon',
                  'value' => 'material',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the icon", "vc_gradientbox_cq"),
                "param_name" => "iconfontsize",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "group" => "Avatar",
                "description" => __("The font-size of the icon, default is <strong>56</strong> (in pixel). You can specify other value as you like here.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color", 'vc_gradientbox_cq'),
                "param_name" => "iconcolor",
                "value" => '',
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "group" => "Avatar",
                "description" => __("Default is white.", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon background color", 'vc_gradientbox_cq'),
                "param_name" => "iconbgcolor",
                "value" => '',
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "group" => "Avatar",
                "description" => __("Default is transparent.", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Avatar background shape", "vc_gradientbox_cq"),
                "param_name" => "avatarshape",
                "value" => array("circle", "rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge", "square"),
                "std" => "circle",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon', 'image')),
                "group" => "Avatar",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Size of the avatar background", "vc_gradientbox_cq"),
                "param_name" => "avatarbgsize",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon', 'image')),
                "group" => "Avatar",
                "description" => __("The avatar default is <strong>100</strong> (in pixel). Specify other value as you like here, like <strong>80</strong>.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Box title (optional)", "vc_gradientbox_cq"),
                "param_name" => "boxtitle",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Box title align", "vc_gradientbox_cq"),
                "param_name" => "titlealign",
                "value" => array("left", "center", "right"),
                "std" => "left",
                'group' => 'Text',
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size for the Box title", "vc_gradientbox_cq"),
                "param_name" => "titlesize",
                "value" => "",
                'group' => 'Text',
                "description" => __("Default is <strong>1.4em</strong>. You can specify other value here.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Box content", "vc_gradientbox_cq"),
                "param_name" => "content",
                'group' => 'Text',
                "value" => __("", "vc_gradientbox_cq"), "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content (and the title) text color", 'vc_gradientbox_cq'),
                "param_name" => "contentcolor",
                "value" => '',
                'group' => 'Text',
                "description" => __("Default is white.", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Gradient background of whole Box", "vc_gradientbox_cq"),
                "param_name" => "gradientbackground",
                "value" => array("White" => "white", "Gray" => "gray", "Orange" => "orange", "Red" => "red", "Green" => "green", "Mint" => "mint", "Aqua" => "aqua", "Blue" => "blue", "Lavender" => "lavender", "Pink" => "pink", "Yellow" => "yellow", "Teal" => "teal", "Customized (customize the color below)" => "customized"),
                'std' => 'aqua',
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Start color for the box gradient background", 'vc_gradientbox_cq'),
                "param_name" => "startcolor",
                "value" => '',
                'dependency' => array('element' => 'gradientbackground', 'value' => 'customized'),
                "description" => __("", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("End color for the box gradient background", 'vc_gradientbox_cq'),
                "param_name" => "endcolor",
                "value" => '',
                'dependency' => array('element' => 'gradientbackground', 'value' => 'customized'),
                "description" => __("", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the whole Box(optional)", "vc_gradientbox_cq"),
                "param_name" => "tooltip",
                "value" => "",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Optional background color for the content area", 'vc_gradientbox_cq'),
                "param_name" => "contentbgcolor",
                "value" => '',
                "description" => __("Default is transparent. You can choose a background here. Then the whole box will be displayed like a gradient border.", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Align the content center vertically?", "vc_gradientbox_cq"),
                "param_name" => "verticallycenter",
                "value" => array("No" => "", "Yes" => "vertically-center"),
                "description" => __("Content (avatar, text etc) default is with padding only. You can choose to align them vertically center.", "vc_gradientbox_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for whole Box)', 'vc_gradientbox_cq' ),
                'param_name' => 'link',
                // 'group' => 'Link',
                'description' => __( '', 'vc_gradientbox_cq' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Height of whole Box", "vc_gradientbox_cq"),
                "param_name" => "boxheight",
                "value" => "",
                "description" => __("Default is <strong>270</strong> (in pixel). You can specify other value here, like <strong>320</strong>.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Whole box shape", "vc_gradientbox_cq"),
                "param_name" => "boxshape",
                "value" => array("rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge", "square"),
                "std" => "square",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_gradientbox_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_gradientbox_cq")
              )

           )
        ));

        }else{

          vc_map(array(
            "name" => __("Gradient Box", 'vc_gradientbox_cq'),
            "base" => "cq_vc_gradientbox",
            "class" => "wpb_cq_vc_extension_gradientbox",
            // "as_parent" => array('only' => 'cq_vc_gradientbox_item'),
            "icon" => "cq_allinone_gradientbox",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Content with image or icon', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Display avatar on the top:", "vc_gradientbox_cq"),
                "param_name" => "avatartype",
                "value" => array("None (text only)" => "none", "Image" => "image"),
                "group" => "Avatar",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Image", "vc_gradientbox_cq"),
                "param_name" => "avatarimage",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "group" => "Avatar",
                "description" => __("Select image from media library.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Resize the image?", "vc_gradientbox_cq"),
                "param_name" => "resizeavatarimage",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "group" => "Avatar",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_gradientbox_cq"),
                "param_name" => "avatarimagewidth",
                "value" => "",
                "dependency" => Array('element' => "resizeavatarimage", 'value' => array('yes')),
                "group" => "Avatar",
                "description" => __("For example, 800 will resize the image to width 800.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Avatar background shape", "vc_gradientbox_cq"),
                "param_name" => "avatarshape",
                "value" => array("circle", "rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge", "square"),
                "std" => "circle",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "group" => "Avatar",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Size of the avatar background", "vc_gradientbox_cq"),
                "param_name" => "avatarbgsize",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "group" => "Avatar",
                "description" => __("The avatar default is <strong>100</strong> (in pixel). Specify other value as you like here, like <strong>80</strong>.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Box title (optional)", "vc_gradientbox_cq"),
                "param_name" => "boxtitle",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Box title align", "vc_gradientbox_cq"),
                "param_name" => "titlealign",
                "value" => array("left", "center", "right"),
                "std" => "left",
                'group' => 'Text',
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size for the Box title", "vc_gradientbox_cq"),
                "param_name" => "titlesize",
                "value" => "",
                'group' => 'Text',
                "description" => __("Default is <strong>1.4em</strong>. You can specify other value here.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Box content", "vc_gradientbox_cq"),
                "param_name" => "content",
                'group' => 'Text',
                "value" => __("", "vc_gradientbox_cq"), "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content (and the title) text color", 'vc_gradientbox_cq'),
                "param_name" => "contentcolor",
                "value" => '',
                'group' => 'Text',
                "description" => __("Default is white.", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Gradient background of whole Box", "vc_gradientbox_cq"),
                "param_name" => "gradientbackground",
                "value" => array("White" => "white", "Gray" => "gray", "Orange" => "orange", "Red" => "red", "Green" => "green", "Mint" => "mint", "Aqua" => "aqua", "Blue" => "blue", "Lavender" => "lavender", "Pink" => "pink", "Yellow" => "yellow", "Teal" => "teal", "Customized (customize the color below)" => "customized"),
                'std' => 'aqua',
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Start color for the box gradient background", 'vc_gradientbox_cq'),
                "param_name" => "startcolor",
                "value" => '',
                'dependency' => array('element' => 'gradientbackground', 'value' => 'customized'),
                "description" => __("", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("End color for the box gradient background", 'vc_gradientbox_cq'),
                "param_name" => "endcolor",
                "value" => '',
                'dependency' => array('element' => 'gradientbackground', 'value' => 'customized'),
                "description" => __("", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the whole Box(optional)", "vc_gradientbox_cq"),
                "param_name" => "tooltip",
                "value" => "",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Optional background color for the content area", 'vc_gradientbox_cq'),
                "param_name" => "contentbgcolor",
                "value" => '',
                "description" => __("Default is transparent. You can choose a background here. Then the whole box will be displayed like a gradient border.", 'vc_gradientbox_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Align the content center vertically?", "vc_gradientbox_cq"),
                "param_name" => "verticallycenter",
                "value" => array("No" => "", "Yes" => "vertically-center"),
                "description" => __("Content (avatar, text etc) default is with padding only. You can choose to align them vertically center.", "vc_gradientbox_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for whole Box)', 'vc_gradientbox_cq' ),
                'param_name' => 'link',
                // 'group' => 'Link',
                'description' => __( '', 'vc_gradientbox_cq' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Height of whole Box", "vc_gradientbox_cq"),
                "param_name" => "boxheight",
                "value" => "",
                "description" => __("Default is <strong>270</strong> (in pixel). You can specify other value here, like <strong>320</strong>.", "vc_gradientbox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_gradientbox_cq",
                "heading" => __("Whole box shape", "vc_gradientbox_cq"),
                "param_name" => "boxshape",
                "value" => array("rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge", "square"),
                "std" => "square",
                "description" => __("", "vc_gradientbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_gradientbox_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_gradientbox_cq")
              )

           )
        ));



        }

        add_shortcode('cq_vc_gradientbox', array($this,'cq_vc_gradientbox_func'));
      }

      function cq_vc_gradientbox_func($atts, $content=null, $tag) {
          $avataricon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_material = '';
            extract(shortcode_atts(array(
              "avatartype" => 'none',
              "startcolor" => '',
              "endcolor" => '',
              "gradientbackground" => '',
              "verticallycenter" => '',
              "boxtitle" => '',
              "titlealign" => '',
              "iconfontsize" => '',
              "contentbgcolor" => '',
              "contentcolor" => '',
              "titlesize" => '',
              "boxshape" => '',
              "boxheight" => '',
              "icon_fontawesome" => 'fa fa-heart',
              "icon_openiconic" => 'vc-oi vc-oi-dial',
              "icon_typicons" => 'typcn typcn-adjust-brightness',
              "icon_entypo" => 'entypo-icon entypo-icon-note',
              "icon_linecons" => 'vc_li vc_li-heart',
              "icon_material" => 'vc-material vc-material-cake',
              "avatarimage" => '',
              "avatarimagewidth" => '',
              "resizeavatarimage" => 'no',
              "avataricon" => 'fontawesome',
              "avatarshape" => '',
              "iconsize" => '',
              "avatarbgsize" => '',
              "iconcolor" => '',
              "iconbgcolor" => '',
              "link" => '',
              "tooltip" => '',
              "extraclass" => ""
            ), $atts));

          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
            vc_icon_element_fonts_enqueue($avataricon);
          }else{
            // wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
            // wp_enqueue_style( 'font-awesome' );
          }


          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';

          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_style( 'vc-extensions-gradientbox-style', plugins_url('css/style.min.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-gradientbox-style' );
          wp_enqueue_script('vc-extensions-gradientbox-script');
          wp_register_script('vc-extensions-gradientbox-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "tooltipster"));
          wp_enqueue_script('vc-extensions-gradientbox-script');


          $avatarimage_full = wp_get_attachment_image_src($avatarimage, 'full');
          $i = -1;
          $link = vc_build_link($link);
          $output = '';
          $avatar_temp = $avatarthumb = "";
          $fullimage = $avatarimage_full[0];
          $avatarthumb = $fullimage;
          if($avatarimagewidth!=""&&$resizeavatarimage=="yes"){
              if(function_exists('wpb_resize')){
                  $avatar_temp = wpb_resize($avatarimage, null, $avatarimagewidth, null);
                  $avatarthumb = $avatar_temp['url'];
                  if($avatarthumb=="") $avatarthumb = $fullimage;
              }
          }


          if($link["url"]!=="") $output .= '<a href="'.$link["url"].'" title="'.$link["title"].'" target="'.$link["target"].'" class="cq-gradientbox-link">';
          $output .= '<div class="cq-gradientbox '.$boxshape.' '.$extraclass.' gradient-'.$gradientbackground.'" data-startcolor="'.$startcolor.'" data-endcolor="'.$endcolor.'" data-avatartype="'.$avatartype.'" data-avatarimage="'.$avatarthumb.'" data-titlealign="'.$titlealign.'" data-gradientbackground="'.$gradientbackground.'" data-avatarbgsize="'.$avatarbgsize.'" data-iconfontsize="'.$iconfontsize.'" data-iconcolor="'.$iconcolor.'" data-iconbgcolor="'.$iconbgcolor.'" data-contentbgcolor="'.$contentbgcolor.'" data-contentcolor="'.$contentcolor.'" data-titlesize="'.$titlesize.'" data-tooltip="'.$tooltip.'" data-boxheight="'.$boxheight.'">';
          $output .= '<div class="cq-gradientbox-contentcontainer '.$boxshape.'">';
          $output .= '<div class="cq-gradientbox-content '.$verticallycenter.'">';
          if($avatartype=="icon"){
              if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $avataricon})){
                  $output .= '<div class="cq-gradientbox-avatarcontainer '.$avatarshape.'">';
                  $output .= '<i class="cq-gradientbox-icon '.esc_attr(${'icon_' . $avataricon}).'"></i>';
                  $output .= '</div>';
              }
          }else if($avatartype=="image"){
                  if($avatarimage[0]!=""){
                      $output .= '<div class="cq-gradientbox-avatarcontainer '.$avatarshape.'">';
                      // $output .= '<img src="'.$avatarimage[0].'" class="cq-gradientbox-avatarimage" /> ';
                      $output .= '</div>';
                  }
          }
          if($boxtitle!=""){
              $output .= '<h3 class="cq-gradientbox-title">';
              $output .= $boxtitle;
              $output .= '</h3>';
          }
          if($content!=""){
              $output .= $content;
          }
          $output .= '</div>';
          $output .= '</div>';
          $output .= '</div>';
          if($link["url"]!=="") $output .= '</a>';
          return $output;

        }

  }

}

?>
