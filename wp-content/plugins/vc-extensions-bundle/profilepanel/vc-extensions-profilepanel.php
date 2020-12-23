<?php
if (!class_exists('VC_Extensions_ProfilePanel')) {
    class VC_Extensions_ProfilePanel{
        function __construct() {
          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
            vc_map(array(
            "name" => __("Profile Panel", 'vc_profilepanel_cq'),
            "base" => "cq_vc_profilepanel",
            "class" => "wpb_cq_vc_extension_profilepanel",
            // "as_parent" => array('only' => 'cq_vc_profilepanel_item'),
            "icon" => "cq_allinone_profilepanel",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('With avatar and text', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Header image", "vc_profilepanel_cq"),
                "param_name" => "headerimage",
                "value" => "",
                "group" => 'Header',
                "description" => __("Select image from media library.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Resize the header image?", "vc_profilepanel_cq"),
                "param_name" => "resizeheaderimage",
                "value" => array("no", "yes"),
                "std" => "no",
                "group" => 'Header',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize header image to this width", "vc_profilepanel_cq"),
                "param_name" => "headerwidth",
                "value" => "",
                "dependency" => Array('element' => "resizeheaderimage", 'value' => array('yes')),
                "group" => 'Header',
                "description" => __("Default we will use the original image, specify a width here. For example, 800 will resize the image to width 800.", "vc_profilepanel_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the header)', 'vc_imageoverlay2_cq' ),
                'param_name' => 'headerlink',
                'group' => 'Header',
                'description' => __( '', 'vc_imageoverlay2_cq' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Header height", "vc_profilepanel_cq"),
                "param_name" => "headerheight",
                "value" => "",
                "group" => 'Header',
                "description" => __("Default is <strong>200</strong> in pixel, specify a width here. For example, 320 will set the header for 320 in pixel.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Display the avatar as:", "vc_profilepanel_cq"),
                "param_name" => "avatartype",
                "value" => array("image", "icon"),
                "std" => "icon",
                "group" => 'Avatar',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Select icon for the avatar, Icon library:', 'js_composer' ),
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
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "group" => 'Avatar',
                'description' => __( 'Select icon library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-arrows-h', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                  'element' => 'avataricon',
                  'value' => 'fontawesome',
                ),
                "group" => 'Avatar',
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'openiconic',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'avataricon',
                  'value' => 'openiconic',
                ),
                "group" => 'Avatar',
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'typicons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'avataricon',
                  'value' => 'typicons',
                ),
                "group" => 'Avatar',
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                "group" => 'Avatar',
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
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'linecons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'avataricon',
                  'value' => 'linecons',
                ),
                "group" => 'Avatar',
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
                "heading" => __("Avatar icon size", "vc_profilepanel_cq"),
                "param_name" => "avatariconsize",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "group" => 'Avatar',
                "description" => __("Default is <strong>32px</strong> in pixel. You can specify other value here. Like 32px or 2em.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Avatar background color", 'vc_profilepanel_cq'),
                "param_name" => "avatarbackgroundcolor",
                "value" => '',
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "group" => 'Avatar',
                "description" => __("Default is gray #656D78.", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Avatar icon color", 'vc_profilepanel_cq'),
                "param_name" => "avatariconcolor",
                "value" => '',
                "group" => 'Avatar',
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "description" => __("Default is white.", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Avatar image", "vc_profilepanel_cq"),
                "param_name" => "avatarimage",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "group" => 'Avatar',
                "description" => __("Select image from media library.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Avatar size", "vc_profilepanel_cq"),
                "param_name" => "avatarsize",
                "value" => "",
                "group" => 'Avatar',
                "description" => __("Default is <strong>100</strong> in pixel. You can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Place the avatar on the:", "vc_profilepanel_cq"),
                "param_name" => "avatarposition",
                "value" => array("middle", "left", "right"),
                "std" => "middle",
                "group" => 'Avatar',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Avatar position offset", "vc_profilepanel_cq"),
                "param_name" => "avataroffset",
                "value" => "",
                "dependency" => Array('element' => "avatarposition", 'value' => array('left', 'right')),
                "group" => 'Avatar',
                "description" => __("Default is 10%, for example when you choose to place the avatar on the left, and it will place to left with 10% element's width. You can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Resize the avatar image?", "vc_profilepanel_cq"),
                "param_name" => "resizeavatarimage",
                "value" => array("no", "yes"),
                "std" => "no",
                "group" => 'Avatar',
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize avatar image to this width", "vc_profilepanel_cq"),
                "param_name" => "avatarimagewidth",
                "value" => "",
                "dependency" => Array('element' => "resizeavatarimage", 'value' => array('yes')),
                "group" => 'Avatar',
                "description" => __("Default we will use the original image, specify a width here. For example, 200 will resize the image to width 200.", "vc_profilepanel_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the avatar)', 'vc_imageoverlay2_cq' ),
                'param_name' => 'avatarlink',
                'group' => 'Avatar',
                'description' => __( '', 'vc_imageoverlay2_cq' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the avatar (optional)", "vc_profilepanel_cq"),
                "param_name" => "avatartooltip",
                "value" => "",
                "group" => 'Avatar',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Caption title (optional, under the avatar in style1, beside the avatar in style2)", "vc_profilepanel_cq"),
                "param_name" => "captiontitle",
                "value" => "",
                "group" => 'Text',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title color", 'vc_profilepanel_cq'),
                "param_name" => "titlecolor",
                "value" => '',
                "group" => 'Text',
                "dependency" => Array('element' => "panelstyle", 'value' => array('style2')),
                "description" => __("Default is white.", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the caption title", "vc_profilepanel_cq"),
                "param_name" => "titlesize",
                "value" => "",
                "group" => 'Text',
                "description" => __("Default is <strong>1.6em</strong>, you can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Caption content under the image", "vc_profilepanel_cq"),
                "param_name" => "content",
                "group" => 'Text',
                "value" => __("", "vc_profilepanel_cq"), "description" => __("", "vc_profilepanel_cq") ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text color", 'vc_profilepanel_cq'),
                "param_name" => "contentcolor",
                "value" => '',
                "group" => 'Text',
                "description" => __("Default is white.", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the caption content", "vc_profilepanel_cq"),
                "param_name" => "contentsize",
                "value" => "",
                "group" => 'Text',
                "description" => __("Default is <strong>1.1em</strong>, you can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Choose panel style:", "vc_profilepanel_cq"),
                "param_name" => "panelstyle",
                "value" => array("Style1, avatar in the middel, title under it" => "style1", "Style2, avatar and title on the header, title beside it" => "style2"),
                'std' => 'style1',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Choose panel background:", "vc_profilepanel_cq"),
                "param_name" => "panelbackground",
                "value" => array("White" => "white", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'white',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize panel background color", 'vc_profilepanel_cq'),
                "param_name" => "panelbackgroundcolor",
                "value" => '',
                "dependency" => Array('element' => "panelbackground", 'value' => array('customized')),
                "description" => __("", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Whole element shape", "vc_profilepanel_cq"),
                "param_name" => "elementshape",
                "value" => array("square", "rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge"),
                "std" => "no",
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Apply shadow to the whole element?", 'vc_profilepanel_cq'),
                "param_name" => "isshadow",
                "value" => array(__("Yes", "vc_profilepanel_cq") => 'on'),
                "description" => __("You can check this if you want to display the whole element with shadow.", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Padding for the text block (include title and content)", "vc_profilepanel_cq"),
                "param_name" => "contentpadding",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is <strong>40px</strong>, you can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Margin for the text block (include title and content)", "vc_profilepanel_cq"),
                "param_name" => "contentmargin",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is <strong>24px 0 0 0</strong>, which stand for margin-top for 24px. You can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_profilepanel_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_profilepanel_cq")
              )

           )
        ));

        }else{

          vc_map(array(
            "name" => __("Profile Panel", 'vc_profilepanel_cq'),
            "base" => "cq_vc_profilepanel",
            "class" => "wpb_cq_vc_extension_profilepanel",
            // "as_parent" => array('only' => 'cq_vc_profilepanel_item'),
            "icon" => "cq_allinone_profilepanel",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('With avatar and text', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Header image", "vc_profilepanel_cq"),
                "param_name" => "headerimage",
                "value" => "",
                "group" => 'Header',
                "description" => __("Select image from media library.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Resize the header image?", "vc_profilepanel_cq"),
                "param_name" => "resizeheaderimage",
                "value" => array("no", "yes"),
                "std" => "no",
                "group" => 'Header',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize header image to this width", "vc_profilepanel_cq"),
                "param_name" => "headerwidth",
                "value" => "",
                "dependency" => Array('element' => "resizeheaderimage", 'value' => array('yes')),
                "group" => 'Header',
                "description" => __("Default we will use the original image, specify a width here. For example, 800 will resize the image to width 800.", "vc_profilepanel_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the header)', 'vc_imageoverlay2_cq' ),
                'param_name' => 'headerlink',
                'group' => 'Header',
                'description' => __( '', 'vc_imageoverlay2_cq' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Header height", "vc_profilepanel_cq"),
                "param_name" => "headerheight",
                "value" => "",
                "group" => 'Header',
                "description" => __("Default is <strong>200</strong> in pixel, specify a width here. For example, 320 will set the header for 320 in pixel.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Avatar image", "vc_profilepanel_cq"),
                "param_name" => "avatarimage",
                "value" => "",
                "group" => 'Avatar',
                "description" => __("Select image from media library.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Avatar size", "vc_profilepanel_cq"),
                "param_name" => "avatarsize",
                "value" => "",
                "group" => 'Avatar',
                "description" => __("Default is <strong>100</strong> in pixel. You can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Place the avatar on the:", "vc_profilepanel_cq"),
                "param_name" => "avatarposition",
                "value" => array("middle", "left", "right"),
                "std" => "no",
                "group" => 'Avatar',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Avatar position offset", "vc_profilepanel_cq"),
                "param_name" => "avataroffset",
                "value" => "",
                "dependency" => Array('element' => "avatarposition", 'value' => array('left', 'right')),
                "group" => 'Avatar',
                "description" => __("Default is 10%, for example when you choose to place the avatar on the left, and it will place to left with 10% element's width. You can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Resize the avatar image?", "vc_profilepanel_cq"),
                "param_name" => "resizeavatarimage",
                "value" => array("no", "yes"),
                "std" => "no",
                "group" => 'Avatar',
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize avatar image to this width", "vc_profilepanel_cq"),
                "param_name" => "avatarimagewidth",
                "value" => "",
                "dependency" => Array('element' => "resizeavatarimage", 'value' => array('yes')),
                "group" => 'Avatar',
                "description" => __("Default we will use the original image, specify a width here. For example, 200 will resize the image to width 200.", "vc_profilepanel_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the avatar)', 'vc_imageoverlay2_cq' ),
                'param_name' => 'avatarlink',
                'group' => 'Avatar',
                'description' => __( '', 'vc_imageoverlay2_cq' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the avatar (optional)", "vc_profilepanel_cq"),
                "param_name" => "avatartooltip",
                "value" => "",
                "group" => 'Avatar',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Caption title under the image (optional)", "vc_profilepanel_cq"),
                "param_name" => "captiontitle",
                "value" => "",
                "group" => 'Text',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the caption title", "vc_profilepanel_cq"),
                "param_name" => "titlesize",
                "value" => "",
                "group" => 'Text',
                "description" => __("Default is <strong>1.6em</strong>, you can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Caption content under the image", "vc_profilepanel_cq"),
                "param_name" => "content",
                "group" => 'Text',
                "value" => __("", "vc_profilepanel_cq"), "description" => __("", "vc_profilepanel_cq") ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the caption content", "vc_profilepanel_cq"),
                "param_name" => "contentsize",
                "value" => "",
                "group" => 'Text',
                "description" => __("Default is <strong>1.1em</strong>, you can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Choose panel background:", "vc_profilepanel_cq"),
                "param_name" => "panelbackground",
                "value" => array("White" => "white", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'white',
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize panel background color", 'vc_profilepanel_cq'),
                "param_name" => "panelbackgroundcolor",
                "value" => '',
                "dependency" => Array('element' => "panelbackground", 'value' => array('customized')),
                "description" => __("", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text color (title and content color)", 'vc_profilepanel_cq'),
                "param_name" => "contentcolor",
                "value" => '',
                // "group" => 'Text',
                "description" => __("Default is white.", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Whole element shape", "vc_profilepanel_cq"),
                "param_name" => "elementshape",
                "value" => array("square", "rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge"),
                "std" => "square",
                "description" => __("", "vc_profilepanel_cq")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_profilepanel_cq",
                "heading" => __("Apply shadow to the whole element?", 'vc_profilepanel_cq'),
                "param_name" => "isshadow",
                "value" => array(__("Yes", "vc_profilepanel_cq") => 'on'),
                "description" => __("You can check this if you want to display the whole element with shadow.", 'vc_profilepanel_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Padding for the text block (include title and content)", "vc_profilepanel_cq"),
                "param_name" => "contentpadding",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is <strong>40px</strong>, you can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Margin for the text block (include title and content)", "vc_profilepanel_cq"),
                "param_name" => "contentmargin",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is <strong>24px 0 0 0</strong>, which stand for margin-top for 24px. You can specify other value here.", "vc_profilepanel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_profilepanel_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_profilepanel_cq")
              )

           )
        ));





        }

        add_shortcode('cq_vc_profilepanel', array($this,'cq_vc_profilepanel_func'));


      }

      function cq_vc_profilepanel_func($atts, $content=null, $tag) {
          $avataricon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_material = '';
          extract(shortcode_atts(array(
            "icon_fontawesome" => "fa fa-user",
            "icon_openiconic" => "vc-oi vc-oi-dial",
            "icon_typicons" => "typcn typcn-adjust-brightness",
            "icon_entypo" => "entypo-icon entypo-icon-export",
            "icon_linecons" => "vc_li vc_li-heart",
            "icon_material" => 'vc-material vc-material-cake',
            "panelstyle" => 'style1',
            "headerimage" => '',
            "avatarimage" => '',
            "captiontitle" => '',
            "titlesize" => '',
            "contentsize" => '',
            "headerlink" => '',
            "avatarlink" => '',
            "panelbackground" => 'white',
            "contentcolor" => '',
            "titlecolor" => '',
            "panelbackgroundcolor" => '',
            "contentmargin" => '',
            "contentpadding" => '',
            "resizeavatarimage" => 'no',
            "resizeheaderimage" => 'no',
            "headerheight" => '',
            "headerwidth" => '',
            "avatartype" => 'icon',
            "avataricon" => 'fontawesome',
            "avatariconsize" => '',
            "avatarsize" => '',
            "avatarimagewidth" => '',
            "avataroffset" => '',
            "avatartooltip" => '',
            "avatarposition" => 'middle',
            "avatariconcolor" => '',
            "avatarbackgroundcolor" => '',
            "elementshape" => 'square',
            "headerheight" => '',
            "isshadow" => '',
            "extraclass" => ""
          ), $atts));


          vc_icon_element_fonts_enqueue($avataricon);

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';

          $avatarlink = vc_build_link($avatarlink);
          $headerlink = vc_build_link($headerlink);


          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_style( 'vc-extensions-profilepanel-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-profilepanel-style' );
          wp_register_script('vc-extensions-profilepanel-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-profilepanel-script');
          $color_style_arr = array("white" => array("", ""), "grapefruit" => array("#ED5565", "#DA4453"), "bittersweet" => array("#FC6E51", "#E9573F"), "sunflower" => array("#FFCE54", "#F6BB42"), "grass" => array("#A0D468", "#8CC152"), "mint" => array("#48CFAD", "#37BC9B"), "aqua" => array("#4FC1E9", "#3BAFDA"), "bluejeans" => array("#5D9CEC", "#4A89DC"), "lavender" => array("#AC92EC", "#967ADC"), "pinkrose" => array("#EC87C0", "#D770AD"), "lightgray" => array("#F5F7FA", "#E6E9ED"), "mediumgray" => array("#CCD1D9", "#AAB2BD"), "darkgray" => array("#656D78", "#000000"), "customized" => array("$panelbackgroundcolor", "$panelbackgroundcolor") );

          $panelbg_arr = $color_style_arr[$panelbackground];

          $headerimage_full = wp_get_attachment_image_src($headerimage, 'full');
          $avatarimage_full = wp_get_attachment_image_src($avatarimage, 'full');

          $realheaderimage = '';
          $realavatarimage = '';

          $header_image_temp = "";
          $realheaderimage = $headerimage_full[0];
          if($resizeheaderimage=="yes"&&$headerwidth!=""){
              if(function_exists('wpb_resize')){
                  $cover_image_temp = wpb_resize($headerimage, null, $headerwidth, null);
                  $realheaderimage = $cover_image_temp['url'];
                  if($realheaderimage=="") $realheaderimage = $headerimage_full[0];
              }
          }

          $avatar_image_temp = "";
          $realavatarimage = $avatarimage_full[0];
          if($resizeavatarimage=="yes"&&$avatarimagewidth!=""){
              if(function_exists('wpb_resize')){
                  $cover_image_temp = wpb_resize($avatarimage, null, $avatarimagewidth, null);
                  $realavatarimage = $cover_image_temp['url'];
                  if($realavatarimage=="") $realavatarimage = $avatarimage_full[0];
              }
          }


          // if($resizeheaderimage=="yes"&&$headerwidth!=""){
              // $realheaderimage .= aq_resize($headerimage[0], $headerwidth, null, true, true, true);
          // }else{
              // $realheaderimage .= $headerimage[0];
          // }
          // if($resizeavatarimage=="yes"&&$avatarimagewidth!=""){
          //     $realavatarimage .= aq_resize($avatarimage[0], $avatarimagewidth, null, true, true, true);
          // }else{
          //     $realavatarimage .= $avatarimage[0];
          // }


          // $panelstyle = "style2";
          $output = '';
          if($panelstyle=="style1"){
              $output .= '<div class="cq-profilepanel cq-profilepanel-shadow'.$isshadow.' cq-profilepanel-shape'.$elementshape.' '.$extraclass.'" data-headerheight="'.$headerheight.'" data-headerimage="'.$realheaderimage.'" data-avatartype="'.$avatartype.'" data-avatarimage="'.$realavatarimage.'" data-avatarposition="'.$avatarposition.'" data-avatarsize="'.$avatarsize.'" data-headerheight="'.$headerheight.'" data-avataroffset="'.$avataroffset.'" data-avatariconsize="'.$avatariconsize.'" data-contentpadding="'.$contentpadding.'" data-contentcolor="'.$contentcolor.'" data-avatariconcolor="'.$avatariconcolor.'" data-avatarbackgroundcolor="'.$avatarbackgroundcolor.'" data-panelbackground="'.$panelbg_arr[1].'" data-contentmargin="'.$contentmargin.'" data-titlesize="'.$titlesize.'" data-contentsize="'.$contentsize.'">';
              if($headerlink["url"]!=="") $output .= '<a href="'.$headerlink["url"].'" title="'.$headerlink["title"].'" target="'.$headerlink["target"].'" class="cq-profilepanel-headerlink">';
              $output .= '<div class="cq-profilepanel-header"></div>';
              if($headerlink["url"]!=="") $output .= '</a>';
              if($avatarlink["url"]!=="") $output .= '<a href="'.$avatarlink["url"].'" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'" class="cq-profilepanel-avatarlink">';
              $output .= '<div class="cq-profilepanel-avatar cq-profilepanel-icon'.$avatarposition.'" title="'.$avatartooltip.'">';
              if($avatartype=="icon"){
                  if(isset(${'icon_' . $avataricon})){
                      $output .= '<i class="cq-profilepanel-icon '.esc_attr(${'icon_' . $avataricon}).'"></i> ';
                  }else{
                  }
              }
              $output .= '</div>';
              if($avatarlink["url"]!=="") $output .= '</a>';
              $output .= '<div class="cq-profilepanel-text">';
              if($captiontitle!=""){
                  $output .= '<h3 class="cq-profilepanel-title">'.$captiontitle.'</h3>';
              }
              if($content!=""){
                  $output .= '<div class="cq-profilepanel-content">';
                  $output .= $content;
                  $output .= '</div>';
              }
              $output .= '</div>';
              $output .= '</div>';

          }else{
              $output .= '<div class="cq-profilepanel cq-profilepanel-style2 cq-profilepanel-shadow'.$isshadow.' cq-profilepanel-shape'.$elementshape.' '.$extraclass.'" data-headerheight="'.$headerheight.'" data-headerimage="'.$realheaderimage.'" data-avatartype="'.$avatartype.'" data-avatarimage="'.$realavatarimage.'" data-avatarposition="'.$avatarposition.'" data-avatarsize="'.$avatarsize.'" data-headerheight="'.$headerheight.'" data-avataroffset="'.$avataroffset.'" data-avatariconsize="'.$avatariconsize.'" data-contentpadding="'.$contentpadding.'" data-contentcolor="'.$contentcolor.'" data-titlecolor="'.$titlecolor.'" data-avatariconcolor="'.$avatariconcolor.'" data-avatarbackgroundcolor="'.$avatarbackgroundcolor.'" data-panelbackground="'.$panelbg_arr[1].'" data-contentmargin="'.$contentmargin.'" data-titlesize="'.$titlesize.'" data-contentsize="'.$contentsize.'">';
              if($headerlink["url"]!=="") $output .= '<a href="'.$headerlink["url"].'" title="'.$headerlink["title"].'" target="'.$headerlink["target"].'" class="cq-profilepanel-headerlink">';
              $output .= '<div class="cq-profilepanel-header"></div>';
              if($headerlink["url"]!=="") $output .= '</a>';
              $output .= '<div class="cq-profilepanel-avatarcontainer cq-avatarcontainer-style2">';
              if($avatarlink["url"]!=="") $output .= '<a href="'.$avatarlink["url"].'" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'" class="cq-profilepanel-avatarlink">';
              $output .= '<div class="cq-profilepanel-style2avatar cq-profilepanel-icon'.$avatarposition.'" title="'.$avatartooltip.'">';
              if($avatartype=="icon"){
                  if(isset(${'icon_' . $avataricon})){
                      $output .= '<i class="cq-profilepanel-icon '.esc_attr(${'icon_' . $avataricon}).'"></i> ';
                  }else{
                  }
              }
              $output .= '</div>';
              if($captiontitle!=""){
                  $output .= '<h3 class="cq-profilepanel-style2title">'.$captiontitle.'</h3>';
              }
              if($avatarlink["url"]!=="") $output .= '</a>';
              $output .= '</div>'; // end of avatar container
              $output .= '<div class="cq-profilepanel-text">';
              if($content!=""){
                  $output .= '<div class="cq-profilepanel-content">';
                  $output .= $content;
                  $output .= '</div>';
              }
              $output .= '</div>';
              $output .= '</div>';
          }

          return $output;

        }

  }

}

?>
