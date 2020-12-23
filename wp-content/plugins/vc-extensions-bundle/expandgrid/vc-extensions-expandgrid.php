<?php
if (!class_exists('VC_Extensions_ExpandGrid')){
    class VC_Extensions_ExpandGrid{
        function __construct() {
            vc_map(array(
            "name" => __("Expand Grid", 'cq_allinone_vc'),
            "base" => "cq_vc_expandgrid",
            "class" => "cq_vc_expandgrid",
            "icon" => "cq_vc_expandgrid",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_expandgrid_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('Expandable and responsive grid', 'js_composer'),
            "params" => array(
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                 "heading" => __("Grid column", "cq_allinone_vc"),
                 "param_name" => "gridnumber",
                 "value" => array("1", "2", "3", "4", "5"),
                 "std" => "3",
                 "description" => __("Customize the grid setting here first, then <a href='".plugins_url('img/griditem.png', __FILE__)."' target='_blank'>add the Grid Item</a> one by one.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                 "heading" => __("Auto delay slideshow", "cq_allinone_vc"),
                 "param_name" => "autoslide",
                 "value" => array("no", "2", "3", "4", "5", "6", "7", "8"),
                 "std" => "no",
                 "description" => __("In seconds, default is no, which is disabled.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Item height", "cq_allinone_vc"),
                 "param_name" => "itemsize",
                 "value" => array("80", "100", "120", "160", "200", "240", "280", "320", "400", "customize below" => "customized"),
                 "std" => "160",
                 "description" => __("Select the built in item height (in pixels) or customize it below.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Customize item height", "cq_allinone_vc"),
                "param_name" => "itemheight",
                "value" => "",
                "dependency" => Array('element' => "itemsize", 'value' => array('customized')),
                "description" => __('Enter item height in pixels, for example: 400. Leave empty to use default 160 (pixels).', "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Avatar image size", "cq_allinone_vc"),
                 "param_name" => "avatarsize",
                 "value" => array("40", "60", "80", "100", "120", "160", "200", "240", "320", "400"),
                 "std" => "60",
                 "description" => __("Select the built in avatar image size (in pixels).", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 cqadmin-col-offset",
                "heading" => __("Label font-size", "cq_allinone_vc"),
                "param_name" => "labelfontsize",
                "value" => "",
                "description" => __("Default (leave to blank) is 1em, support a value like <strong>12px</strong> or <strong>1.2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 cqadmin-col-offset",
                "heading" => __("Sub title font-size", "cq_allinone_vc"),
                "param_name" => "subfontsize",
                "value" => "",
                "description" => __("Default (leave to blank) is 0.9em", "cq_allinone_vc")
              ),
              array(
                'type' => 'checkbox',
                'heading' => __('Do not open first grid by default? ', 'cq_allinone_vc' ),
                'param_name' => 'openfirst',
                'std' => 'no',
                'description' => __("Check this if you don't want to open the first grid by default.", 'cq_allinone_vc' ),
                'value' => array( __( 'Yes, hide them all by default', 'cq_allinone_vc' ) => 'yes' ),
              ),
              array(
                'type' => 'checkbox',
                'heading' => __('Make the items a little transparent while not selected', 'cq_allinone_vc' ),
                'param_name' => 'transparentitem',
                'std' => 'yes',
                'description' => __("un-check this if you don't want to apply the transparent effect to the items not selected.", 'cq_allinone_vc' ),
                'value' => array( __( 'Yes, apply the focus effect', 'cq_allinone_vc' ) => 'yes' ),
              ),
              array(
                'type' => 'checkbox',
                'heading' => __('Append the close button to the popup content?', 'cq_allinone_vc' ),
                'param_name' => 'closebutton',
                'std' => 'yes',
                'description' => __("un-check this if you don't want to add the close button to the popup content.", 'cq_allinone_vc' ),
                'value' => array( __( 'Yes, I like the close button', 'cq_allinone_vc' ) => 'yes' ),
              ),
              array(
                'type' => 'checkbox',
                'heading' => __('Do not apply circular to the avatar image? ', 'cq_allinone_vc' ),
                'param_name' => 'nocircular',
                'std' => 'no',
                'description' => __("Check this if you don't want to make the avatar image circularly.", 'cq_allinone_vc' ),
                'value' => array( __( 'Yes, keep it in original', 'cq_allinone_vc' ) => 'nocircular' ),
              ),
              array(
                'type' => 'checkbox',
                'heading' => __('Scroll to the opened item? ', 'cq_allinone_vc' ),
                "edit_field_class" => "vc_col-xs-6 vc_column",
                'param_name' => 'scrollto',
                'std' => 'no',
                'description' => __("Check this if you want to the browser scroll to the current opend item.", 'cq_allinone_vc' ),
                'value' => array( __( 'Yes, scroll to', 'cq_allinone_vc' ) => 'yes' ),
              ),
              array(
                "type" => "textfield",
                "heading" => __("Scroll to offset", "cq_allinone_vc"),
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "param_name" => "scrolloffset",
                "value" => "",
                "dependency" => Array('element' => "scrollto", 'value' => array('yes')),
                "description" => __("You can customize the scroll offset too. For example 100 will move it 100px lower, -100 will be 100px upper.", "cq_allinone_vc")
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
             "name" => __("Grid Item","cq_allinone_vc"),
             "base" => "cq_vc_expandgrid_item",
             "class" => "cq_vc_expandgrid_item",
             "icon" => "cq_vc_expandgrid_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add image, icon and text","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_expandgrid'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  "type" => "dropdown",
                  "holder" => "",
                  "heading" => __("Display the avatar with", "cq_allinone_vc"),
                  "param_name" => "avatartype",
                  "value" => array("None (no avatar)"=>"none", "Image" => "image", "Icon" => "icon"),
                  "std" => "icon",
                  "group" => "Avatar",
                  "description" => __("", "cq_allinone_vc")
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
                'param_name' => 'faceicon',
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
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
                  'element' => 'faceicon',
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
                  'element' => 'faceicon',
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
                  'element' => 'faceicon',
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
                  'element' => 'faceicon',
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
                  'element' => 'faceicon',
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
                  'element' => 'faceicon',
                  'value' => 'material',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              // array(
              //   'type' => 'iconpicker',
              //   'heading' => __( 'Icon', 'js_composer' ),
              //   'param_name' => 'icon_monosocial',
              //   'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
              //   'settings' => array(
              //     'emptyIcon' => false, // default true, display an "EMPTY" icon?
              //     'type' => 'monosocial',
              //     'iconsPerPage' => 4000, // default 100, how many icons per/page to display
              //   ),
              //   'dependency' => array(
              //     'element' => 'faceicon',
              //     'value' => 'monosocial',
              //   ),
              //   "group" => "Avatar",
              //   'description' => __( 'Select icon from library.', 'js_composer' ),
              // ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "class" => "",
                "heading" => __("Icon size", "cq_allinone_vc"),
                "param_name" => "iconsize",
                "value" => "",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "group" => "Avatar",
                "description" => __('Default is 28px (leave to blank). Support a value like <strong>2em</strong> or <strong>32px</strong>', "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "class" => "",
                "heading" => __("Icon color", 'cq_allinone_vc'),
                "param_name" => "iconcolor",
                "value" => "",
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              // array(
              //   "type" => "colorpicker",
              //   "holder" => "div",
              //   "class" => "",
              //   "heading" => __("Icon hover color", 'cq_allinone_vc'),
              //   "param_name" => "iconhovercolor",
              //   "value" => "",
              //   "group" => "Avatar",
              //   "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
              //   "description" => __("Default is same as the link.", 'cq_allinone_vc')
              //   ),

              array(
                "type" => "attach_image",
                "heading" => __("Avatar image:", "cq_allinone_vc"),
                "param_name" => "avatarimage",
                "value" => "",
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "description" => __("Select from media library.", "cq_allinone_vc")
              ),
              array(
                'type' => 'checkbox',
                'heading' => __( 'Resize the avatar image?', 'cq_allinone_vc' ),
                'param_name' => 'avatarresize',
                'description' => __( 'We will use the original image by default, you can specify a width below if the original image is too large.', 'cq_allinone_vc' ),
                'std' => 'no',
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' ),
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width.", "cq_allinone_vc"),
                "param_name" => "avatarimagesize",
                "value" => "",
                "dependency" => Array('element' => "avatarresize", 'value' => array('yes')),
                "group" => "Avatar",
                "description" => __('Enter image width in pixels, for example: 400. The image then will be resized to 400. Leave empty to use original full image.', "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-8 cqadmin-col-offset",
                "heading" => __("Label for the item (optional, under the avatar)", "cq_allinone_vc"),
                "param_name" => "gridlabel",
                "value" => "",
                "group" => "Text",
                "description" => __("For example, a name, John Smith", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-4 cqadmin-col-offset",
                "heading" => __("Label color", 'cq_allinone_vc'),
                "param_name" => "labelcolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-8 cqadmin-col-offset",
                "heading" => __("Sub title for the item (optional, under the label)", "cq_allinone_vc"),
                "param_name" => "gridsublabel",
                "value" => "",
                "group" => "Text",
                "description" => __("For example, a job title, Web Developer", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-4 cqadmin-col-offset",
                "heading" => __("Sub title color", 'cq_allinone_vc'),
                "param_name" => "subtitlecolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the item (optional)", "cq_allinone_vc"),
                "param_name" => "tooltip",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textarea_html",
                "heading" => __("Content", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "group" => "Text",
                "description" => __("The slide in content.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Text color", 'cq_allinone_vc'),
                "param_name" => "contentcolor",
                "value" => "",
                "group" => "Text",
                "description" => __("", 'cq_allinone_vc')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Background color of the grid item:", "cq_allinone_vc"),
                "param_name" => "bgstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent (content with white background)" => "cq-transparent", "Customized color:" => "customized"),
                'std' => 'aqua',
                'group' => 'Background',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Background color of the grid item", 'cq_allinone_vc'),
                "param_name" => "backgroundcolor",
                "value" => "",
                'group' => 'Background',
                "dependency" => Array('element' => "bgstyle", 'value' => array('customized')),
                "description" => __("Default is medium gray. Note, the content only support white background with customized gird item background.", 'cq_allinone_vc')
              ),
              // array(
              //   "type" => "colorpicker",
              //   "holder" => "div",
              //   "class" => "",
              //   "heading" => __("Hover background color of the grid item", 'cq_allinone_vc'),
              //   "param_name" => "backgroundhovercolor",
              //   "value" => "",
              //   'group' => 'Background',
              //   "dependency" => Array('element' => "bgstyle", 'value' => array('customized')),
              //   "description" => __("Default is transparent. Note, the content only support white background with customized gird item background.", 'cq_allinone_vc')
              // ),
              array(
                  "type" => "attach_image",
                  "heading" => __("Background image:", "cq_allinone_vc"),
                  "param_name" => "image",
                  "value" => "",
                  "group" => "Background",
                  "description" => __("Select from media library.", "cq_allinone_vc")
              ),
              array(
                'type' => 'checkbox',
                'heading' => __( 'Resize the image?', 'cq_allinone_vc' ),
                'param_name' => 'isresize',
                'description' => __( 'We will use the original image by default, you can specify a width below if the original image is too large.', 'cq_allinone_vc' ),
                'std' => 'no',
                "group" => "Background",
                'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' ),
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width.", "cq_allinone_vc"),
                "param_name" => "imagesize",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "group" => "Background",
                "description" => __('Enter image width in pixels, for example: 400. The image then will be resized to 400. Leave empty to use original full image.', "cq_allinone_vc")
              )

              ),
            )
        );

          add_shortcode('cq_vc_expandgrid', array($this,'cq_vc_expandgrid_func'));
          add_shortcode('cq_vc_expandgrid_item', array($this,'cq_vc_expandgrid_item_func'));

      }

      function cq_vc_expandgrid_func($atts, $content=null) {
        $css_class = $css =  $gridnumber = $transparentitem = $autoslide = $itemsize = $itemheight = $avatarsize = $openfirst = $closebutton = $labelfontsize = $subfontsize = $nocircular = $scrollto = $scrolloffset = $extraclass = '';
        extract(shortcode_atts(array(
          "gridnumber" => "3",
          "autoslide" => "no",
          "closebutton" => "yes",
          "transparentitem" => "yes",
          "itemsize" => "",
          "avatarsize" => "",
          "itemheight" => "",
          "openfirst" => "no",
          "labelfontsize" => "",
          "subfontsize" => "",
          "nocircular" => "",
          "scrollto" => "no",
          "scrolloffset" => "0",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $output = "";
        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_expandgrid', $atts);
        wp_register_style( 'vc-extensions-expandgrid-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-expandgrid-style' );

        wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
        wp_enqueue_style('tooltipster');

        wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('tooltipster');


        wp_register_script('vc-extensions-expandgrid-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "tooltipster"));
        wp_enqueue_script('vc-extensions-expandgrid-script');
        if($closebutton=="") {
          $closebutton = 'no';
        }else{
          vc_icon_element_fonts_enqueue('fontawesome');
        }
        $output .= '<div class="cq-expandgrid cq-circular-'.$nocircular.' cq-expandgrid-'.$itemsize.' cq-expandgrid-avatar-'.$avatarsize.' cq-expandgrid-close-'.$closebutton.' cq-expandgrid-in'.$gridnumber.' '.$extraclass.' '.$css_class.'" data-itemheight="'.$itemheight.'" data-autoslide="'.$autoslide.'" data-itemsize="'.$itemsize.'" data-transparentitem="'.$transparentitem.'" data-openfirst="'.$openfirst.'" data-labelfontsize="'.$labelfontsize.'" data-nocircular="'.$nocircular.'" data-subfontsize="'.$subfontsize.'" data-scrollto="'.$scrollto.'" data-scrolloffset="'.$scrolloffset.'">';
        $output .= do_shortcode($content);
        $output .= '</div>';
        return $output;

      }


      function cq_vc_expandgrid_item_func($atts, $content=null, $tag) {
          $output = $faceicon = $image = $imagesize = $videowidth = $isresize = $tooltip =  $backgroundcolor = $backgroundhovercolor = $itembgcolor = $iconcolor = $iconsize =  $css = $bgstyle =  $gridlabel = $gridsublabel = $contentcolor = $labelcolor = $subtitlecolor =  "";
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = $icon_monosocial = "";
          // if(version_compare(WPB_VC_VERSION,  "4.6") >= 0){
              // var_dump($tag, $atts);
              // $atts = vc_map_get_attributes($tag, $atts);
              // extract($atts);
          // }else{
            extract(shortcode_atts(array(
              "faceicon" => "entypo",
              "image" => "",
              "imagesize" => "",
              "isresize" => "no",
              "avatarimage" => "",
              "avatartype" => "icon",
              "avatarimagesize" => "",
              "avatarresize" => "no",
              "iscaption" => "",
              "tooltip" => "",
              "bgstyle" => "aqua",
              "backgroundcolor" => "",
              "backgroundhovercolor" => "",
              "itembgcolor" => "",
              "icon_fontawesome" => "fa fa-user",
              "icon_openiconic" => "vc-oi vc-oi-dial",
              "icon_typicons" => "typcn typcn-adjust-brightness",
              "icon_entypo" => "entypo-icon entypo-icon-user",
              "icon_linecons" => "vc_li vc_li-heart",
              "icon_material" => "vc-material vc-material-cake",
              "icon_pixelicons" => "",
              "icon_monosocial" => "",
              "iconcolor" => "",
              "iconsize" => "",
              "gridlabel" => "",
              "gridsublabel" => "",
              "labelcolor" => "",
              "subtitlecolor" => "",
              "labelfontsize" => "",
              "subfontsize" => "",
              "contentcolor" => "",
              "css" => ""
            ), $atts));

          vc_icon_element_fonts_enqueue($faceicon);
          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          $img = $thumbnail = "";

          $fullimage = wp_get_attachment_image_src($image, 'full');
          $thumbnail = $fullimage[0];
          if($isresize=="yes"&&$imagesize!=""){
              if(function_exists('wpb_resize')){
                  $img = wpb_resize($image, null, $imagesize, null);
                  $thumbnail = $img['url'];
                  if($thumbnail=="") $thumbnail = $fullimage[0];
              }
          }

          $avatarimg = $avatarthumbnail = "";
          $avatarfullimage = wp_get_attachment_image_src($avatarimage, 'full');
          $avatarthumbnail = $avatarfullimage[0];
          if($avatarresize=="yes"&&$avatarimagesize!=""){
              if(function_exists('wpb_resize')){
                  $avatarimg = wpb_resize($avatarimage, null, $avatarimagesize, null);
                  $avatarthumbnail = $avatarimg['url'];
                  if($avatarthumbnail=="") $avatarthumbnail = $avatarfullimage[0];
              }
          }

          $arrowstyle_str = '';
          if($bgstyle == "customized" && $backgroundcolor != ""){
          	$arrowstyle_str = "border-bottom:15px solid $backgroundcolor";
          }
          $itembgstyle_str = '';
          if($bgstyle == "customized" && $backgroundcolor != ""){
          	$itembgstyle_str = "background-color: $backgroundcolor";
          }



          $output = '';
          $output .= '<div class="cq-expandgrid-item cq-expandgrid-initstate '.$bgstyle.'" data-image="'.$thumbnail.'" data-bgstyle="'.$bgstyle.'" data-backgroundcolor="'.$backgroundcolor.'" data-backgroundhovercolor="'.$backgroundhovercolor.'" data-avatartype="'.$avatartype.'" data-avatar="'.$avatarthumbnail.'" data-contentcolor="'.$contentcolor.'" data-iconcolor="'.$iconcolor.'" data-iconsize="'.$iconsize.'" data-labelcolor="'.$labelcolor.'" data-subtitlecolor="'.$subtitlecolor.'" title="'.esc_html($tooltip).'">';
          $output .= '<div class="cq-expandgrid-face cq-expandgrid-toggle" style="'.$itembgstyle_str.'">';
          $output .= '<div class="cq-expandgrid-facecontent">';
          if($avatarthumbnail!=""){
            $output .= '<div class="cq-expandgrid-avatar">';
            $output .= '</div>';
          }
          if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $faceicon})&&esc_attr(${'icon_' . $faceicon})!=""&&$avatartype=="icon"){
              $output .= '<i class="cq-expandgrid-icon '.esc_attr(${'icon_' . $faceicon}).'"></i>';
          }
          if($gridlabel!=""){
              $output .= '<span class="cq-expandgrid-title">'.$gridlabel.'</span> ';
          }
          if($gridsublabel!=""){
              $output .= '<span class="cq-expandgrid-subtitle">'.$gridsublabel.'</span> ';
          }
          $output .= '</div>';
          $output .= '<div class="cq-expandgrid-arrow" style="'.$arrowstyle_str.'"></div>';
          $output .= '</div>';
          $output .= '<div class="cq-expandgrid-content" style="'.$itembgstyle_str.'">';
          $output .= '<div class="cq-expandgrid-text">';
          $output .= do_shortcode($content);
          $output .= '</div>';
          $output .= '<i class="fa fa-close cq-expandgrid-close"></i>';
          $output .= '</div>';
          $output .= '</div>';
          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_expandgrid')) {
    class WPBakeryShortCode_cq_vc_expandgrid extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_expandgrid_item')) {
    class WPBakeryShortCode_cq_vc_expandgrid_item extends WPBakeryShortCode {
    }
}

?>
