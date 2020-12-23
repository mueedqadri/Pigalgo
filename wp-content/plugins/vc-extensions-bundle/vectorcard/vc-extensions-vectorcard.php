<?php
if (!class_exists('VC_Extensions_VectorCard')) {
    class VC_Extensions_VectorCard{
        function __construct() {
          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
            vc_map(array(
            "name" => __("Vector Card", 'vc_vectorcard_cq'),
            "base" => "cq_vc_vectorcard",
            "class" => "wpb_cq_vc_extension_vectorcard",
            // "as_parent" => array('only' => 'cq_vc_vectorcard_item'),
            "icon" => "cq_allinone_vectorcard",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Card with diagonal', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Display avatar in:", "vc_vectorcard_cq"),
                "param_name" => "avatartype",
                "value" => array("Icon (select the icon below)" => "icon", "Image (choose the avatar image below)" => "image"),
                "std" => "icon",
                "group" => "Avatar",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Avatar Image", "vc_vectorcard_cq"),
                "param_name" => "avatarimage",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => 'image'),
                "group" => "Avatar",
                "description" => __("Select image from media library.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Resize the avatar image?", "vc_vectorcard_cq"),
                "param_name" => "resizeavatarimage",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "dependency" => Array('element' => "avatartype", 'value' => 'image'),
                "std" => "no",
                "group" => "Avatar",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_vectorcard_cq"),
                "param_name" => "avatarimagewidth",
                "value" => "",
                "dependency" => Array('element' => "resizeavatarimage", 'value' => array('yes')),
                "group" => "Avatar",
                "description" => __("Default we will use the original image, specify a width here. For example, 200 will resize the image to width 200. ", "vc_vectorcard_cq")
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
                'value' => 'fa fa-camera', // default value to backend editor admin_label
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
                "heading" => __("Size of the avatar icon", "vc_vectorcard_cq"),
                "param_name" => "iconsize",
                "value" => "",
                "group" => "Avatar",
                'dependency' => array('element' => 'avatartype', 'value' => 'icon'),
                "description" => __("The icon default is <strong>2em</strong>, you can specify other value as you like here.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the avatar(optional)", "vc_vectorcard_cq"),
                "param_name" => "avatartooltip",
                "value" => "",
                "group" => "Avatar",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon (or text) color", 'vc_vectorcard_cq'),
                "param_name" => "iconcolor",
                "value" => '',
                'dependency' => array('element' => 'avatartype', 'value' => 'icon'),
                "group" => "Avatar",
                "description" => __("Default is white.", 'vc_vectorcard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon (or text) background color", 'vc_vectorcard_cq'),
                "param_name" => "iconbgcolor",
                "value" => '',
                'dependency' => array('element' => 'avatartype', 'value' => 'icon'),
                "group" => "Avatar",
                "description" => __("Default is transparent black.", 'vc_vectorcard_cq')
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the Avatar)', 'vc_vectorcard_cq' ),
                'param_name' => 'avatarlink',
                "group" => "Avatar",
                'description' => __( '', 'vc_vectorcard_cq' )
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Card content", "vc_vectorcard_cq"),
                "param_name" => "content",
                'group' => 'Text',
                "value" => __("", "vc_vectorcard_cq"), "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Author name under the avatar", "vc_vectorcard_cq"),
                "param_name" => "authorname",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Author role under the name (optional)", "vc_vectorcard_cq"),
                "param_name" => "authorrole",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra Label (optional)", "vc_vectorcard_cq"),
                "param_name" => "buttonlabel",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the Extra Label)', 'vc_vectorcard_cq' ),
                'param_name' => 'extralink',
                'group' => 'Text',
                'description' => __( '', 'vc_vectorcard_cq' )
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Font color of the author, role and extra information", 'vc_vectorcard_cq'),
                "param_name" => "authorcolor",
                "value" => '',
                'group' => 'Text',
                "description" => __("Default is white.", 'vc_vectorcard_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Display the card top background in:", "vc_vectorcard_cq"),
                "param_name" => "backgroundtype",
                "value" => array("Solid Color (select the color below)" => "color", "Image (choose the image below)" => "image"),
                "std" => "color",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Card top background image", "vc_vectorcard_cq"),
                "param_name" => "backgroundimage",
                "value" => "",
                "dependency" => Array('element' => "backgroundtype", 'value' => 'image'),
                "description" => __("Select image from media library.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Card top background color", "vc_vectorcard_cq"),
                "param_name" => "cardstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'mediumgray',
                "dependency" => Array('element' => "backgroundtype", 'value' => 'color'),
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize card top background color", 'vc_vectorcard_cq'),
                "param_name" => "cardtopbgcolor",
                "value" => '',
                'dependency' => array('element' => 'cardstyle', 'value' => 'customized'),
                "description" => __("Default is white.", 'vc_vectorcard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize card bottom background color", 'vc_vectorcard_cq'),
                "param_name" => "cardbottombgcolor",
                "value" => '',
                "description" => __("Default is white.", 'vc_vectorcard_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Display the background image in:", "vc_vectorcard_cq"),
                "param_name" => "backgroundimagetype",
                "value" => array("Cover" => "cover", "Repeat" => "repeat", "No Repeat" => "no-repeat"),
                "std" => "cover",
                "dependency" => Array('element' => "backgroundtype", 'value' => 'image'),
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Line direction:", "vc_vectorcard_cq"),
                "param_name" => "linedirection",
                "value" => array("left (lower) to right" => "left_2_right", "right (lower) to left" => "right_2_left", "normal straight" => "straight"),
                "std" => "right_2_left",
                "description" => __("Choose how the line across the background.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Whole card shape", "vc_vectorcard_cq"),
                "param_name" => "boxshape",
                "value" => array("rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge", "square"),
                "std" => "square",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("min-height of whole element", "vc_vectorcard_cq"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("Default height is auto. You can specify a min-height here if you want all the cards have the same height in a row. For example, 320px.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_vectorcard_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_vectorcard_cq")
              )

           )
        ));

        }else{

        	vc_map(array(
            "name" => __("Vector Card", 'vc_vectorcard_cq'),
            "base" => "cq_vc_vectorcard",
            "class" => "wpb_cq_vc_extension_vectorcard",
            // "as_parent" => array('only' => 'cq_vc_vectorcard_item'),
            "icon" => "cq_allinone_vectorcard",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Card with diagonal', 'js_composer'),
            "params" => array(
              // array(
              //   "type" => "dropdown",
              //   "holder" => "",
              //   "class" => "vc_vectorcard_cq",
              //   "heading" => __("Display avatar in:", "vc_vectorcard_cq"),
              //   "param_name" => "avatartype",
              //   "value" => array("Icon (select the icon below)" => "icon", "Image (choose the avatar image below)" => "image"),
              //   "std" => "no",
              //   "group" => "Avatar",
              //   "description" => __("", "vc_vectorcard_cq")
              // ),
              array(
                "type" => "attach_image",
                "heading" => __("Avatar Image", "vc_vectorcard_cq"),
                "param_name" => "avatarimage",
                "value" => "",
                // "dependency" => Array('element' => "avatartype", 'value' => 'image'),
                "group" => "Avatar",
                "description" => __("Select image from media library.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Resize the avatar image?", "vc_vectorcard_cq"),
                "param_name" => "resizeavatarimage",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                // "dependency" => Array('element' => "avatartype", 'value' => 'image'),
                "std" => "no",
                "group" => "Avatar",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_vectorcard_cq"),
                "param_name" => "avatarimagewidth",
                "value" => "",
                "dependency" => Array('element' => "resizeavatarimage", 'value' => array('yes')),
                "group" => "Avatar",
                "description" => __("Default we will use the original image, specify a width here. For example, 200 will resize the image to width 200. ", "vc_vectorcard_cq")
              ),
              // array(
              //   'type' => 'dropdown',
              //   'heading' => __( 'Icon library', 'js_composer' ),
              //   'value' => array(
              //     __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
              //     __( 'Open Iconic', 'js_composer' ) => 'openiconic',
              //     __( 'Typicons', 'js_composer' ) => 'typicons',
              //     __( 'Entypo', 'js_composer' ) => 'entypo',
              //     __( 'Linecons', 'js_composer' ) => 'linecons',
              //   ),
              //   'admin_label' => true,
              //   'param_name' => 'avataricon',
              //   'dependency' => array('element' => 'avatartype', 'value' => 'icon',
              //   ),
              //   "group" => "Avatar",
              //   'description' => __( 'Select icon library.', 'js_composer' ),
              // ),
              // array(
              //   'type' => 'iconpicker',
              //   'heading' => __( 'Icon', 'js_composer' ),
              //   'param_name' => 'icon_fontawesome',
              //   'value' => 'fa fa-camera', // default value to backend editor admin_label
              //   'settings' => array(
              //     'emptyIcon' => false, // default true, display an "EMPTY" icon?
              //     'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
              //   ),
              //   'dependency' => array(
              //     'element' => 'avataricon',
              //     'value' => 'fontawesome',
              //   ),
              //   "group" => "Avatar",
              //   'description' => __( 'Select icon from library.', 'js_composer' ),
              // ),
              // array(
              //   'type' => 'iconpicker',
              //   'heading' => __( 'Icon', 'js_composer' ),
              //   'param_name' => 'icon_openiconic',
              //   'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
              //   'settings' => array(
              //     'emptyIcon' => false, // default true, display an "EMPTY" icon?
              //     'type' => 'openiconic',
              //     'iconsPerPage' => 4000, // default 100, how many icons per/page to display
              //   ),
              //   'dependency' => array(
              //     'element' => 'avataricon',
              //     'value' => 'openiconic',
              //   ),
              //   "group" => "Avatar",
              //   'description' => __( 'Select icon from library.', 'js_composer' ),
              // ),
              // array(
              //   'type' => 'iconpicker',
              //   'heading' => __( 'Icon', 'js_composer' ),
              //   'param_name' => 'icon_typicons',
              //   'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
              //   'settings' => array(
              //     'emptyIcon' => false, // default true, display an "EMPTY" icon?
              //     'type' => 'typicons',
              //     'iconsPerPage' => 4000, // default 100, how many icons per/page to display
              //   ),
              //   'dependency' => array(
              //     'element' => 'avataricon',
              //     'value' => 'typicons',
              //   ),
              //   "group" => "Avatar",
              //   'description' => __( 'Select icon from library.', 'js_composer' ),
              // ),
              // array(
              //   'type' => 'iconpicker',
              //   'heading' => __( 'Icon', 'js_composer' ),
              //   'param_name' => 'icon_entypo',
              //   'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
              //   'settings' => array(
              //     'emptyIcon' => false, // default true, display an "EMPTY" icon?
              //     'type' => 'entypo',
              //     'iconsPerPage' => 4000, // default 100, how many icons per/page to display
              //   ),
              //   "group" => "Avatar",
              //   'dependency' => array(
              //     'element' => 'avataricon',
              //     'value' => 'entypo',
              //   ),
              // ),
              // array(
              //   'type' => 'iconpicker',
              //   'heading' => __( 'Icon', 'js_composer' ),
              //   'param_name' => 'icon_linecons',
              //   'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
              //   'settings' => array(
              //     'emptyIcon' => false, // default true, display an "EMPTY" icon?
              //     'type' => 'linecons',
              //     'iconsPerPage' => 4000, // default 100, how many icons per/page to display
              //   ),
              //   'dependency' => array(
              //     'element' => 'avataricon',
              //     'value' => 'linecons',
              //   ),
              //   "group" => "Avatar",
              //   'description' => __( 'Select icon from library.', 'js_composer' ),
              // ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Size of the avatar icon", "vc_vectorcard_cq"),
              //   "param_name" => "iconsize",
              //   "value" => "",
              //   "group" => "Avatar",
              //   'dependency' => array('element' => 'avatartype', 'value' => 'icon'),
              //   "description" => __("The icon default is <strong>2em</strong>, you can specify other value as you like here.", "vc_vectorcard_cq")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the avatar(optional)", "vc_vectorcard_cq"),
                "param_name" => "avatartooltip",
                "value" => "",
                "group" => "Avatar",
                "description" => __("", "vc_vectorcard_cq")
              ),
              // array(
              //   "type" => "colorpicker",
              //   "holder" => "div",
              //   "class" => "",
              //   "heading" => __("Icon (or text) color", 'vc_vectorcard_cq'),
              //   "param_name" => "iconcolor",
              //   "value" => '',
              //   'dependency' => array('element' => 'avatartype', 'value' => 'icon'),
              //   "group" => "Avatar",
              //   "description" => __("Default is white.", 'vc_vectorcard_cq')
              // ),
              // array(
              //   "type" => "colorpicker",
              //   "holder" => "div",
              //   "class" => "",
              //   "heading" => __("Icon (or text) background color", 'vc_vectorcard_cq'),
              //   "param_name" => "iconbgcolor",
              //   "value" => '',
              //   'dependency' => array('element' => 'avatartype', 'value' => 'icon'),
              //   "group" => "Avatar",
              //   "description" => __("Default is transparent black.", 'vc_vectorcard_cq')
              // ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the Avatar)', 'vc_vectorcard_cq' ),
                'param_name' => 'avatarlink',
                "group" => "Avatar",
                'description' => __( '', 'vc_vectorcard_cq' )
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Card content", "vc_vectorcard_cq"),
                "param_name" => "content",
                'group' => 'Text',
                "value" => __("", "vc_vectorcard_cq"), "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Author name under the avatar", "vc_vectorcard_cq"),
                "param_name" => "authorname",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Author role under the name (optional)", "vc_vectorcard_cq"),
                "param_name" => "authorrole",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra Label (optional)", "vc_vectorcard_cq"),
                "param_name" => "buttonlabel",
                "value" => "",
                'group' => 'Text',
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the Extra Label)', 'vc_vectorcard_cq' ),
                'param_name' => 'extralink',
                'group' => 'Text',
                'description' => __( '', 'vc_vectorcard_cq' )
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Font color of the author, role and extra information", 'vc_vectorcard_cq'),
                "param_name" => "authorcolor",
                "value" => '',
                'group' => 'Text',
                "description" => __("Default is white.", 'vc_vectorcard_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Display the card top background in:", "vc_vectorcard_cq"),
                "param_name" => "backgroundtype",
                "value" => array("Solid Color (select the color below)" => "color", "Image (choose the image below)" => "image"),
                "std" => "color",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Card top background image", "vc_vectorcard_cq"),
                "param_name" => "backgroundimage",
                "value" => "",
                "dependency" => Array('element' => "backgroundtype", 'value' => 'image'),
                "description" => __("Select image from media library.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Card top background color", "vc_vectorcard_cq"),
                "param_name" => "cardstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'mediumgray',
                "dependency" => Array('element' => "backgroundtype", 'value' => 'color'),
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize card top background color", 'vc_vectorcard_cq'),
                "param_name" => "cardtopbgcolor",
                "value" => '',
                'dependency' => array('element' => 'cardstyle', 'value' => 'customized'),
                "description" => __("Default is white.", 'vc_vectorcard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize card bottom background color", 'vc_vectorcard_cq'),
                "param_name" => "cardbottombgcolor",
                "value" => '',
                "description" => __("Default is white.", 'vc_vectorcard_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Display the background image in:", "vc_vectorcard_cq"),
                "param_name" => "backgroundimagetype",
                "value" => array("Cover" => "cover", "Repeat" => "repeat", "No Repeat" => "no-repeat"),
                "std" => "cover",
                "dependency" => Array('element' => "backgroundtype", 'value' => 'image'),
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Line direction:", "vc_vectorcard_cq"),
                "param_name" => "linedirection",
                "value" => array("left (lower) to right" => "left_2_right", "right (lower) to left" => "right_2_left", "normal straight" => "straight"),
                "std" => "right_2_left",
                "description" => __("Choose how the line across the background.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_vectorcard_cq",
                "heading" => __("Whole card shape", "vc_vectorcard_cq"),
                "param_name" => "boxshape",
                "value" => array("rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge", "square"),
                "std" => "square",
                "description" => __("", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("min-height of whole element", "vc_vectorcard_cq"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("Default height is auto. You can specify a min-height here if you want all the cards have the same height in a row.", "vc_vectorcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_vectorcard_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_vectorcard_cq")
              )

           )
        ));



        }

        add_shortcode('cq_vc_vectorcard', array($this,'cq_vc_vectorcard_func'));
      }

      function cq_vc_vectorcard_func($atts, $content=null, $tag) {
          $avataricon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_material = '';
          extract(shortcode_atts(array(
            "icon_fontawesome" => 'fa fa-camera',
            "icon_openiconic" => 'vc-oi vc-oi-dial',
            "icon_typicons" => 'typcn typcn-adjust-brightness',
            "icon_entypo" => 'entypo-icon entypo-icon-note',
            "icon_linecons" => 'vc_li vc_li-heart',
            "icon_material" => 'vc-material vc-material-cake',
            "avatarimage" => '',
            "avatarimagewidth" => '',
            "resizeavatarimage" => 'no',
            "avataricon" => 'fontawesome',
            "linedirection" => 'right_2_left',
            "iconsize" => '',
            "iconcolor" => '',
            "iconbgcolor" => '',
            "avatartype" => '',
            "buttonlabel" => '',
            "authorname" => '',
            "authorrole" => '',
            "avatarlink" => '',
            "extralink" => '',
            "authorcolor" => '',
            "avatartooltip" => '',
            "avatartype" => 'icon',
            "cardtopbgcolor" => '',
            "cardbottombgcolor" => '',
            "cardstyle" => 'mediumgray',
            "backgroundtype" => 'color',
            "backgroundimage" => '',
            "backgroundimagetype" => 'cover',
            "boxshape" => '',
            "elementheight" => '',
            "extraclass" => ""
          ), $atts));


          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
            vc_icon_element_fonts_enqueue($avataricon);
          }else{
            // wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
            // wp_enqueue_style( 'font-awesome' );
          }

          $color_style_arr = array("grapefruit" => array("#ED5565", "#DA4453"), "bittersweet" => array("#FC6E51", "#E9573F"), "sunflower" => array("#FFCE54", "#F6BB42"), "grass" => array("#A0D468", "#8CC152"), "mint" => array("#48CFAD", "#37BC9B"), "aqua" => array("#4FC1E9", "#3BAFDA"), "bluejeans" => array("#5D9CEC", "#4A89DC"), "lavender" => array("#AC92EC", "#967ADC"), "pinkrose" => array("#EC87C0", "#D770AD"), "lightgray" => array("#F5F7FA", "#E6E9ED"), "mediumgray" => array("#CCD1D9", "#AAB2BD"), "darkgray" => array("#656D78", "#434A54"), "customized" => array("$cardtopbgcolor", "$cardtopbgcolor") );

          $cardstyle_arr = $color_style_arr[$cardstyle];


          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';

          $extralink = vc_build_link($extralink);
          $avatarlink = vc_build_link($avatarlink);


          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_style( 'vc-extensions-vectorcard-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-vectorcard-style' );
          wp_enqueue_script('vc-extensions-vectorcard-script');
          wp_register_script('vc-extensions-vectorcard-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "tooltipster"));
          wp_enqueue_script('vc-extensions-vectorcard-script');


          $avatarimage_full = wp_get_attachment_image_src($avatarimage, 'full');
          $backgroundimage = wp_get_attachment_image_src($backgroundimage, 'full');
          $image_temp =  "";
          $avatarimage_url = $avatarimage_full[0];
          if($resizeavatarimage=="yes"&&$avatarimagewidth!=""){
              if(function_exists('wpb_resize')){
                  $image_temp = wpb_resize($avatarimage, null, $avatarimagewidth, null, true);
                  $avatarimage_url = $image_temp['url'];
                  if($avatarimage_url=="") $avatarimage_url = $avatarimage_full[0];
              }
          }

          // if($resizeavatarimage=="yes"&&$avatarimagewidth!=""){
              // $avatarimage_url = aq_resize($avatarimage[0], $avatarimagewidth, null, true, true, true);
          // }

          $i = -1;
          $output = '';
          $link_str = '';
          $output .= '<div class="cq-vectorcard '.$linedirection.' '.$extraclass.' '.$boxshape.'" data-avatar="'.$avatarimage_url.'" data-backgroundimage="'.$backgroundimage[0].'" data-backgroundimagetype="'.$backgroundimagetype.'" data-backgroundcolor="'.$cardstyle_arr[1].'" data-avatartype="'.$avatartype.'" data-iconcolor="'.$iconcolor.'" data-cardtopbgcolor="'.$cardtopbgcolor.'" data-iconbgcolor="'.$iconbgcolor.'" data-avatartooltip="'.$avatartooltip.'" data-iconsize="'.$iconsize.'" data-cardbottombgcolor="'.$cardbottombgcolor.'" data-authorcolor="'.$authorcolor.'" data-elementheight="'.$elementheight.'">';

          $output .= '<div class="cq-vectorcard-top">';
          $output .= '<div class="cq-vectorcard-content">';
          $output .= $content;
          $output .= '</div>';

          // $output .= '<div class="cq-vectorcard-line">';
          // if($linedirection=="left_2_right"){
          //     $output .= '<img src="'.plugins_url( 'css/line_2_left.svg', __FILE__ ).'" />';
          // }else{
          //     $output .= '<img src="'.plugins_url( 'css/diagonal.svg', __FILE__ ).'" />';
          // }
          // $output .= '</div>';

          $output .= '</div>';

          if($avatarlink["url"]!=="") $output .= '<a href="'.$avatarlink["url"].'" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'" class="cq-vectorcard-avatarlink">';
          $output .= '<div class="cq-vectorcard-avatar">';
          if($avatartype=="icon"){
            // var_dump(esc_attr(${'icon_' . $avataricon}));
            if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $avataricon})){
                  $output .= '<i class="cq-vectorcard-icon '.esc_attr(${'icon_' . $avataricon}).'"></i>';
              }else{
                  $output .= '<i class="fa cq-vectorcard-icon '.$avataricon.'"></i>';
              }

          }
          $output .= '</div>';
          if($avatarlink["url"]!=="") $output .= '</a>';

          $output .= '<div class="cq-vectorcard-bottom">';
          if($authorname!=""){

          }
          $output .= '<p class="cq-vectorcard-author">';
          if($authorname!="") $output .= $authorname.'<br />';
          if($authorrole!="") $output .= '<span class="cq-vectorcard-authorrole">'.$authorrole.'</span>';
          $output .= '</p>';
          if($buttonlabel!=""){
              $output .= '<p class="cq-vectorcard-extrainfo">';
              if($extralink["url"]!=="") $output .= '<a href="'.$extralink["url"].'" title="'.$extralink["title"].'" target="'.$extralink["target"].'" class="cq-vectorcard-extralink">';
              $output .= $buttonlabel;
              if($extralink["url"]!=="") $output .= '</a>';
              $output .= '</p>';
          }
          $output .= '</div>';

          $output .= '</div>';

          return $output;

        }


  }

}

?>
