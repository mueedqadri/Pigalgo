<?php
if (!class_exists('VC_Extensions_HoverCardV2')){
    class VC_Extensions_HoverCardV2{
        function __construct() {
            vc_map(array(
            "name" => __("Hover Card V2", 'cq_allinone_vc'),
            "base" => "cq_vc_hovercardv2",
            "class" => "cq_vc_hovercardv2",
            "icon" => "cq_vc_hovercardv2",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_hovercardv2_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('hover card with social icon', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_image",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Cover Image", "cq_allinone_vc"),
                "param_name" => "coverimage",
                "value" => "",
                "group" => "Image",
                "description" => __("Select image from media library.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Resize the image?", "cq_allinone_vc"),
                "param_name" => "isresize",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "group" => "Image",
                "description" => __("Choose to resize the image or not, useful if your original image is too large.", "cq_allinone_vc"),
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "cq_allinone_vc"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "group" => "Image",
                "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. ", "cq_allinone_vc")
              ),
              array(
                "type" => "vc_link",
                "heading" => __("URL (Optional link for the image)", "vc_colorblock_cq"),
                "param_name" => "imagelink",
                "value" => "",
                "group" => "Image",
                "description" => __("You can apply a link for the image.", "vc_colorblock_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Title", "cq_allinone_vc"),
                "param_name" => "title",
                "value" => "",
                "group" => "Text",
                "description" => __('', "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("title font-size", "cq_allinone_vc"),
                "param_name" => "titlefontsize",
                "value" => "",
                "group" => "Text",
                "description" => __("Default (leave to blank) is 1.5em, support a value like <strong>12px</strong> or <strong>1.2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("title color", 'cq_allinone_vc'),
                "param_name" => "titlecolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label under the name", "cq_allinone_vc"),
                "param_name" => "label",
                "value" => "",
                "group" => "Text",
                "description" => __('Label under the name, can be a role, like Web Developer or any other thing as you like.', "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Label font-size", "cq_allinone_vc"),
                "param_name" => "labelfontsize",
                "value" => "",
                "group" => "Text",
                "description" => __("Default (leave to blank) is 1em, support a value like <strong>12px</strong> or <strong>1.2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Label color", 'cq_allinone_vc'),
                "param_name" => "labelcolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textarea",
                "heading" => __("More information under the title", "cq_allinone_vc"),
                "param_name" => "description",
                "value" => "",
                "group" => "Text",
                "description" => __("It's under the label, you can put more details about the card.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Description font-size", "cq_allinone_vc"),
                "param_name" => "desfontsize",
                "value" => "",
                "group" => "Text",
                "description" => __("Default (leave to blank) is 1em, support a value like <strong>12px</strong> or <strong>1.2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Description color", 'cq_allinone_vc'),
                "param_name" => "descolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Avatar type", "cq_allinone_vc"),
                "param_name" => "avatartype",
                "value" => array("image", "icon", "none"),
                "std" => "icon",
                "group" => "Avatar",
                "description" => __("Select avatar type.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Size of the whole avatar", "cq_allinone_vc"),
                "param_name" => "avatarwidth",
                "value" => "",
                "group" => "Avatar",
                'dependency' => array('element' => 'avatartype', 'value' => array("image", "icon"),
                ),
                "description" => __('The avatar will be displayed in circle. Default is 80 (in pixel).', "cq_allinone_vc")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Avatar image", "cq_allinone_vc"),
                "param_name" => "avatarimage",
                "value" => "",
                'dependency' => array('element' => 'avatartype', 'value' => 'image',
                 ),
                "group" => "Avatar",
                "description" => __("Select image from media library.", "cq_allinone_vc")
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'js_composer' ),
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
                'value' => 'fa fa-user', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'fontawesome',
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
                'value' => 'entypo-icon entypo-icon-user', // default value to backend editor admin_label
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
                  'element' => 'avataricon',
                  'value' => 'material',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("icon size of the Avatar", "cq_allinone_vc"),
                "param_name" => "iconsize",
                "value" => array("small (24px)" => "small", "medium (36px)" => "medium", "large (48px)" => "large"),
                'std' => 'small',
                "group" => "Avatar",
                'dependency' => array('element' => 'avatartype', 'value' => array("icon"),
                ),
                "description" => __("Select the icon size of the Avatar.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("icon color", 'cq_allinone_vc'),
                "param_name" => "iconcolor",
                "value" => "",
                "group" => "Avatar",
                'dependency' => array('element' => 'avatartype', 'value' => array("icon"),
                ),
                "description" => __("Color of the avatar icon, default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("icon background color", 'cq_allinone_vc'),
                "param_name" => "iconbgcolor",
                "value" => "",
                "group" => "Avatar",
                'dependency' => array('element' => 'avatartype', 'value' => array("icon"),
                ),
                "description" => __("Background color of the avatar icon, default is gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("size of the hover panel", "cq_allinone_vc"),
                "param_name" => "panelsize",
                "value" => array("100%" => "ps1", "90%" => "ps2", "80%" => "ps3", "70%" => "ps4", "60%" => "ps5", "50%" => "ps6", "40%" => "ps7", "30%" => "ps8"),
                'std' => 'ps4',
                "description" => __("Select the panel size, default is 70%.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Hover panel background color", "cq_allinone_vc"),
                 "param_name" => "bgstyle",
                 "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent", "or customize :" => "customized"),
                'std' => 'white',
                "description" => __("Select the built in background color for the hover panel.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("customize background color for the hover panel", 'cq_allinone_vc'),
                "param_name" => "bgcustomcolor",
                "value" => "",
                'dependency' => array('element' => 'bgstyle', 'value' => 'customized',
                ),
                "description" => __("", 'cq_allinone_vc')
              ),
              // array(
              //   "type" => "colorpicker",
              //   "class" => "",
              //   "heading" => __("Social media icon color", 'cq_allinone_vc'),
              //   "param_name" => "socialiconcolor",
              //   "value" => "",
              //   "description" => __("Default is white", 'cq_allinone_vc')
              // ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Auto delay hover", "cq_allinone_vc"),
                "param_name" => "autodelay",
                'value' => array(2, 3, 4, 5, 7, 10, __( 'Disable', 'cq_allinone_vc' ) => 0 ),
                'std' => 0,
                "description" => __("Auto hover the panel in each X seconds.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("transition direction when hover", "cq_allinone_vc"),
                "param_name" => "direction",
                "value" => array("horizontal 1" => "horizontal1", "horizontal 2" => "horizontal2", "vertical 1" => "vertical1", "vertical 2" => "vertical2"),
                'std' => 'horizontal1',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Element height", "cq_allinone_vc"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("The height of the whole element. Default is auto, same as the image, and the minimal height is 200px.", "cq_allinone_vc")
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
             "name" => __("Social Media Icon","cq_allinone_vc"),
             "base" => "cq_vc_hovercardv2_item",
             "class" => "cq_vc_hovercardv2_item",
             "icon" => "cq_vc_hovercardv2_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add icon","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_hovercardv2'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
              // array(
              //   "type" => "dropdown",
              //   "holder" => "",
              //   "heading" => __("Display Icon for this item?", "cq_allinone_vc"),
              //   "param_name" => "isicon",
              //   "value" => array("Yes" => "yes", "No" => "no"),
              //   'std' => 'yes',
              //   "description" => __("", "cq_allinone_vc")
              // ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'js_composer' ),
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
                'param_name' => 'listicon',
                // 'dependency' => array('element' => 'isicon', 'value' => 'yes'),
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
                  'element' => 'listicon',
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
                  'element' => 'listicon',
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
                  'element' => 'listicon',
                  'value' => 'typicons',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-twitter', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'listicon',
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
                  'element' => 'listicon',
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
                  'element' => 'listicon',
                  'value' => 'material',
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              // array(
              //   "type" => "colorpicker",
              //   "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
              //   "class" => "",
              //   "heading" => __("Icon background color", 'cq_allinone_vc'),
              //   "param_name" => "iconbgcolor",
              //   "value" => "",
              //   "description" => __("", 'cq_allinone_vc')
              // ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Title", "cq_allinone_vc"),
              //   "param_name" => "title",
              //   "value" => "",
              //   "description" => __("Title for the item, append to the icon.", "cq_allinone_vc")
              // ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "heading" => __("Icon background color", "cq_allinone_vc"),
                 "param_name" => "socialiconbg",
                 "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent", "or customize :" => "customized"),
                'std' => 'darkgray',
                "description" => __("Select the built in background color for the icon.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("customize background color for icon", 'cq_allinone_vc'),
                "param_name" => "socialiconbgcolor",
                "value" => "",
                'dependency' => array('element' => 'socialiconbg', 'value' => 'customized',
                ),
                "description" => __("", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Icon color", 'cq_allinone_vc'),
                "param_name" => "iconcolor",
                "value" => "",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Icon background color when user hover", 'cq_allinone_vc'),
                "param_name" => "iconhoverbg",
                "value" => "",
                // 'dependency' => array('element' => 'isicon', 'value' => 'yes'),
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Icon color when user hover", 'cq_allinone_vc'),
                "param_name" => "iconhovercolor",
                "value" => "",
                // 'dependency' => array('element' => 'isicon', 'value' => 'yes'),
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              // array(
              //   "type" => "textfield",
              //   "edit_field_class" => "vc_col-xs-6 vc_column",
              //   "heading" => __("font-size of the icon", "cq_allinone_vc"),
              //   "param_name" => "iconsize",
              //   "value" => "",
              //   "description" => __("Default is 1.1em. You can specify it with other value like <strong>24px</strong> or <strong>1.5em</strong> etc.", "cq_allinone_vc")
              // ),
              array(
                "type" => "vc_link",
                "heading" => __("URL (Optional link for the current icon)", "vc_colorblock_cq"),
                "param_name" => "itemlink",
                "value" => "",
                "description" => __("", "vc_colorblock_cq")
              )
              // array(
              //   "type" => "textarea_html",
              //   "heading" => __("Description under the icon and title", "cq_allinone_vc"),
              //   "param_name" => "content",
              //   "value" => "",
              //   "description" => __("You can put more details about the title.", "cq_allinone_vc")
              // ),
              ),
            )
        );

          add_shortcode('cq_vc_hovercardv2', array($this,'cq_vc_hovercardv2_func'));
          add_shortcode('cq_vc_hovercardv2_item', array($this,'cq_vc_hovercardv2_item_func'));

      }

      function cq_vc_hovercardv2_func($atts, $content=null) {
        $css_class = $css = $bgstyle = $bgcustomcolor = $titlecolor = $titlefontsize = $labelfontsize = $labelcolor = $desfontsize = $descolor = $nextbtncolor = $listicon = $title = $description = $coverimage = $isresize = $imagewidth = $iconsize = $title = $label = $description = $avatartype = $avatarimage = $avataricon = $avatarwidth = $backboxbg = $direction = $elementheight = $autodelay = $imagelink = $iconcolor = $iconbgcolor = $panelsize = $extraclass = '';
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = '';
        extract(shortcode_atts(array(
          "coverimage" => "",
          "isresize" => "",
          "imagewidth" => "",
          "title" => "",
          "label" => "",
          "description" => "",
          "descolor" => "",
          "bgstyle" => "white",
          "bgcustomcolor" => "",
          "titlefontsize" => "",
          "css" => "",
          "titlecolor" => "",
          "labelfontsize" => "",
          "labelcolor" => "",
          "desfontsize" => "",
          "descolor" => "",
          "nextbtncolor" => "",
          "iconsize" => "small",
          "avatartype" => "icon",
          "avatarimage" => "",
          "avataricon" => "",
          "avatarwidth" => "80",
          "avataricon" => "entypo",
          "iconcolor" => "",
          "iconbgcolor" => "",
          "icon_fontawesome" => "fa fa-user",
          "icon_openiconic" => "vc-oi vc-oi-dial",
          "icon_typicons" => "typcn typcn-adjust-brightness",
          "icon_entypo" => "entypo-icon entypo-icon-user",
          "icon_linecons" => "vc_li vc_li-heart",
          "icon_material" => "vc-material vc-material-arrow_forward",
          "direction" => "horizontal1",
          "imagelink" => "",
          "backboxbg" => "",
          "autodelay" => "",
          "elementheight" => "",
          "iconcolor" => "",
          "panelsize" => "ps4",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_hovercardv2', $atts);
        wp_register_style( 'vc-extensions-hovercardv2-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-hovercardv2-style' );

        wp_register_script('vc-extensions-hovercardv2-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
        wp_enqueue_script('vc-extensions-hovercardv2-script');

        $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

        $imagelink = vc_build_link($imagelink);

        $cover_attachment = get_post($coverimage);
        $coverimagearr = wp_get_attachment_image_src(trim($coverimage), 'full');
        $cover_image_temp = $cover_image_url = "";
        $cover_full_image = $coverimagearr[0];
        $cover_image_url = $cover_full_image;
        if( $isresize=="yes" && $imagewidth!="" ){
            if(function_exists('wpb_resize')){
                $cover_image_temp = wpb_resize($coverimage, null, $imagewidth, null);
                $cover_image_url = $cover_image_temp['url'];
                if($cover_image_url=="") $cover_image_url = $cover_full_image;
            }
        }

        vc_icon_element_fonts_enqueue($avataricon);

        $attachment = get_post($avatarimage);
        $avatarimagearr = wp_get_attachment_image_src(trim($avatarimage), 'full');
        $avatar_image_temp = $avatarimage_url = "";
        $avatar_full_image = $avatarimagearr[0];
        $avatarimage_url = $avatar_full_image;
        if($avatarwidth!=""){
            if(function_exists('wpb_resize')){
                $avatar_image_temp = wpb_resize($avatarimage, null, $avatarwidth*2, $avatarwidth*2, true);
                $avatarimage_url = $avatar_image_temp['url'];
                if($avatarimage_url=="") $avatarimage_url = $avatar_full_image;
            }
        }
        if($elementheight!="")$elementheight = (int) preg_replace('/[^0-9]/', '', $elementheight);
        $output = "";
        $output .= '<div class="cq-hovercardv2 cq-hovercardv2-'.$direction.' cq-hovercardv2-icon'.$iconsize.' cq-hovercardv2-'.$panelsize.' cq-hovercardv2-'.$bgstyle.' '.$extraclass.' '.$css_class.'" data-direction="'.$direction.'" data-autodelay="'.$autodelay.'" data-avatarwidth="'.$avatarwidth.'" style="height:'.$elementheight.'px">';
        $output .= '<div class="cq-hovercardv2-imagecontainer">';
        if($imagelink["url"]!=="") $output .= '<a href="'.$imagelink["url"].'" title="'.$imagelink["title"].'" target="'.$imagelink["target"].'" rel="'.$imagelink["rel"].'" class="cq-hovercardv2-imagelink" onclick="">';
        if($cover_image_url!=""){
            $output .= '<img src="'.$cover_image_url.'" class="cq-hovercardv2-img" alt="'.get_post_meta($cover_attachment->ID, '_wp_attachment_image_alt', true ).'" />';
        }
        if($imagelink["url"]!=="") $output .= '</a>';
        $output .= '</div>';
        $output .= '<div class="cq-hovercardv2-content" style="background-color:'.$bgcustomcolor.'">';


        $output .= '<div class="cq-hovercardv2-contentcontainer">';

        if($avatartype=="image" && $avatarimage_url!=""){
           $output .= '<div class="cq-hovercardv2-avatar">
                          <img src="'.$avatarimage_url.'" class="cq-hovercardv2-avatarimage" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />
                       </div>';
        }else if($avatartype=="icon" && isset(${'icon_' . $avataricon})){
            $output .= '<div class="cq-hovercardv2-avatar" style="background-color:'.$iconbgcolor.';">';
            $output .= '<i class="cq-hovercardv2-avataricon '.esc_attr(${'icon_' . $avataricon}).'" style="color:'.$iconcolor.';"></i>';
            $output .= '</div>';
        }



        if($title!=""){
            $output .= '<h3 class="cq-hovercardv2-title" style="font-size:'.$titlefontsize.';color:'.$titlecolor.'">';
            $output .= $title;
            if($label!=""){
                $output .= '<br />';
                $output .= '<span class="cq-hovercardv2-label" style="font-size:'.$labelfontsize.';color:'.$labelcolor.'">'.$label.'</span>';
            }
            $output .= '</h3>';
        }
        if($description!=""){
            $output .= '<p class="cq-hovercardv2-description" style="color:'.$descolor.'">'.$description.'</p>';
        }
        $output .= '<ul class="cq-hovercardv2-listcontainer">';
        $output .= do_shortcode($content);
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }


      function cq_vc_hovercardv2_item_func($atts, $content=null, $tag) {
          $iconcolor = $iconbgcolor = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = $title = $contentcolor = $itemlink = $iconcolor = $iconhoverbg = $iconhovercolor = $socialiconbg = $socialiconbgcolor = $iconsize = $isicon = "";
          extract(shortcode_atts(array(
            "listicon" => "entypo",
            "iconcolor" => "",
            "socialiconbg" => "",
            "socialiconbgcolor" => "",
            "iconbgcolor" => "",
            "icon_fontawesome" => "fa fa-user",
            "icon_openiconic" => "vc-oi vc-oi-dial",
            "icon_typicons" => "typcn typcn-adjust-brightness",
            "icon_entypo" => "entypo-icon entypo-icon-twitter",
            "icon_linecons" => "vc_li vc_li-heart",
            "icon_material" => "vc-material vc-material-arrow_forward",
            "title" => "",
            "contentcolor" => "",
            "itemlink" => "",
            "iconsize" => "",
            "isicon" => "yes",
            "iconhoverbg" => "",
            "iconhovercolor" => "",
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          vc_icon_element_fonts_enqueue($listicon);
          $itemlink = vc_build_link($itemlink);

          $output = '';
          $output .= '<li class="cq-hovercardv2-listitem cq-hovercardv2-item'.$socialiconbg.'" data-iconcolor="'.$iconcolor.'" data-iconbgcolor="'.$iconbgcolor.'" data-contentcolor="'.$contentcolor.'" data-iconhoverbg="'.$iconhoverbg.'" data-iconhovercolor="'.$iconhovercolor.'" data-socialiconbg="'.$socialiconbg.'" data-socialiconbgcolor="'.$socialiconbgcolor.'">';
          if($itemlink["url"]!=="") $output .= '<a href="'.$itemlink["url"].'" title="'.$itemlink["title"].'" target="'.$itemlink["target"].'" rel="'.$itemlink["rel"].'" class="cq-hovercardv2-itemlink" onclick="">';
          $output .='<div class="cq-hovercardv2-iconcontainer">';
          if($isicon=="yes"){
            $output .= '<i class="cq-hovercardv2-icon '.esc_attr(${'icon_' . $listicon}).'" style="color:'.$iconcolor.';font-size:'.$iconsize.';line-height:'.$iconsize.'"></i> ';
          }
          // $output .= '<span class="cq-hovercardv2-itemtitle" style="color:'.$iconcolor.';font-size:'.$iconsize.';line-height:'.$iconsize.'">'.$title.'</span>';
          $output .= "</div>";
          if($itemlink["url"]!=="") $output .= '</a>';
          // if($content!=""){
          //   $output .= '<div class="cq-hovercardv2-itemdesc" style="color:'.$contentcolor.'">';
          //   $output .= $content;
          //   $output .= '</div>';
          // }
          $output .= '</li>';
          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_hovercardv2')) {
    class WPBakeryShortCode_cq_vc_hovercardv2 extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_hovercardv2_item')) {
    class WPBakeryShortCode_cq_vc_hovercardv2_item extends WPBakeryShortCode {
    }
}

?>
