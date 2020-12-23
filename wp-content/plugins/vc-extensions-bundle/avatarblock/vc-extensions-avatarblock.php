<?php
if (!class_exists('VC_Extensions_AvatarBlock')){
    class VC_Extensions_AvatarBlock{
        function __construct() {
            vc_map(array(
            "name" => __("Avatar Block", 'cq_allinone_vc'),
            "base" => "cq_vc_avatarblock",
            "class" => "cq_vc_avatarblock",
            "icon" => "cq_vc_avatarblock",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "is_container" => true,
            "show_settings_on_create" => true,
            'description' => __('Avatar with text block', 'js_composer'),
            "params" => array(
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                 "heading" => __("Display the avatar on the", "cq_allinone_vc"),
                 "param_name" => "avatarposition",
                 "value" => array("left", "right"),
                 "std" => "left",
                 "group" => "Avatar",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                 "heading" => __("Avatar size (in pixel)", "cq_allinone_vc"),
                 "param_name" => "avatarsize",
                 "value" => array("80", "100", "120", "160"),
                 "std" => "100",
                 "group" => "Avatar",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Display the avatar with", "cq_allinone_vc"),
                 "param_name" => "avatartype",
                 "value" => array("icon", "image", "none"),
                 "std" => "icon",
                 "group" => "Avatar",
                 "description" => __("", "cq_allinone_vc")
              ),
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
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Resize the image?", "cq_allinone_vc"),
                 "param_name" => "isresize",
                 "value" => array("yes", "no"),
                 "std" => "no",
                 "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                 "description" => __("Default we will use the original image for the avatar, you can specify a value (like <strong>200</strong>) to resize it if the original image is too large.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "cq_allinone_vc"),
                "param_name" => "imagewidth",
                "value" => "",
                "group" => "Avatar",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "description" => __("Specify a width for the resize above, like <strong>200</strong>", "cq_allinone_vc")
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
                'param_name' => 'avataricon',
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
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "heading" => __("Icon font-size", "cq_allinone_vc"),
                "param_name" => "iconsize",
                "value" => "",
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "description" => __("Default (leave to be blank) is 2.4em, support a value like <strong>36px</strong> or <strong>3.2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column cqadmin-col-offset",
                "heading" => __("Color of the icon", "cq_allinone_vc"),
                "param_name" => "iconcolor",
                "value" => "",
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                "description" => __("Default is white", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "heading" => __("Border color for the avatar", "cq_allinone_vc"),
                "param_name" => "bordercolor",
                "value" => "",
                "group" => "Avatar",
                "description" => __("Default is same as the background color with image avatar, white with icon avatar.", "cq_allinone_vc")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'Link for the avatar (optional)', 'cq_allinone_vc' ),
                'param_name' => 'avatarlink',
                // "dependency" => Array('element' => "avatartype", 'value' => array('image', 'icon')),
                'group' => 'Avatar',
                'description' => __( '', 'cq_allinone_vc' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the avatar (optional)", "cq_allinone_vc"),
                "param_name" => "tooltip",
                "value" => "",
                "group" => "Avatar",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Title (optional)", "cq_allinone_vc"),
                "param_name" => "texttitle",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 cqadmin-col-offset",
                "heading" => __("Title font-size", "cq_allinone_vc"),
                "param_name" => "titlesize",
                "value" => "",
                "group" => "Text",
                "description" => __("Default (leave to be blank) is 1.6em, support a value like <strong>16px</strong> or <strong>2em</strong>", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 cqadmin-col-offset",
                "heading" => __("Color of the title", "cq_allinone_vc"),
                "param_name" => "titlecolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is white", "cq_allinone_vc")
              ),
              array(
                "type" => "textarea_html",
                "heading" => __("Text content", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                "heading" => __("Background color of the avatar and text block:", "cq_allinone_vc"),
                "param_name" => "bgcolor",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "White" => "white", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent", "Customized color:" => "customized"),
                'std' => 'white',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "edit_field_class" => "vc_col-xs-6 cqadmin-firstcol-offset",
                 "heading" => __("Content shape", "cq_allinone_vc"),
                 "param_name" => "elementshape",
                 "value" => array("Square" => "square", "Rounded" => "rounded"),
                 "std" => "square",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Content height", "cq_allinone_vc"),
                "param_name" => "contentheight",
                "value" => "",
                "description" => __("The content height is auto by default, you can customize it with a fixed value, for example to keep all elements in a same height.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Custom background color of the avatar and text block", 'cq_allinone_vc'),
                "param_name" => "custombgcolor",
                "value" => "",
                "dependency" => Array('element' => "bgcolor", 'value' => array('customized')),
                "description" => __("", 'cq_allinone_vc')
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

        add_shortcode('cq_vc_avatarblock', array($this,'cq_vc_avatarblock_func'));

      }

      function cq_vc_avatarblock_func($atts, $content=null) {
        $css_class = $css = $bgcolor = $custombgcolor = $avatartype = $avatarsize = $avatarimage = $avatarlink = $tooltip = $isresize = $imagewidth = $texttitle = $contentheight = $bordercolor = $extraclass = '';
        $avataricon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_monosocial = $icon_material = "";
        extract(shortcode_atts(array(
          "avatarposition" => "left",
          "avatarsize" => "100",
          "avatartype" => "icon",
          "avataricon" => "entypo",
          "icon_fontawesome" => "fa fa-user",
          "icon_openiconic" => "vc-oi vc-oi-dial",
          "icon_typicons" => "typcn typcn-adjust-brightness",
          "icon_entypo" => "entypo-icon entypo-icon-user",
          "icon_linecons" => "vc_li vc_li-heart",
          "icon_material" => 'vc-material vc-material-cake',
          "icon_pixelicons" => "",
          "icon_monosocial" => "",
          "bgcolor" => "white",
          "custombgcolor" => "",
          "avatarimage" => "",
          "avatarlink" => "",
          "iconsize" => "",
          "iconcolor" => "",
          "elementshape" => "square",
          "tooltip" => "",
          "titlesize" => "",
          "titlecolor" => "",
          "texttitle" => "",
          "isresize" => "no",
          "imagewidth" => "",
          "contentheight" => "",
          "bordercolor" => "",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_avatarblock', $atts);
        wp_register_style( 'vc-extensions-avatarblock-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-avatarblock-style' );

        wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
        wp_enqueue_style('tooltipster');

        wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('tooltipster');


        wp_register_script('vc-extensions-avatarblock-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
        wp_enqueue_script('vc-extensions-avatarblock-script');

        vc_icon_element_fonts_enqueue($avataricon);
        $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

        $avatarimg = $avatarthumbnail = "";
        $avatarfullimage = wp_get_attachment_image_src($avatarimage, 'full');
        $avatarthumbnail = $avatarfullimage[0];
        $attachment = get_post($avatarimage);
        if($imagewidth!=""&&$isresize=="yes"){
            if(function_exists('wpb_resize')){
                $avatarimg = wpb_resize($avatarimage, null, $imagewidth, $imagewidth,  true);
                $avatarthumbnail = $avatarimg['url'];
                if($avatarthumbnail=="") $avatarthumbnail = $avatarfullimage[0];
            }
        }

        $avatarlink = vc_build_link($avatarlink);

        $output = "";
        $avatar_str = $link_start = $link_end = $content_str = "";
        $output .= '<div class="cq-avatarblock '.$bgcolor.' cq-avatarblock-'.$avatarposition.' cq-avatarblock-'.$avatarsize.' '.$css_class.' '.$extraclass.'" data-tooltip="'.esc_html($tooltip).'" data-bgcolor="'.$bgcolor.'" data-custombgcolor="'.$custombgcolor.'" data-contentheight="'.$contentheight.'" data-bordercolor="'.$bordercolor.'">';
        $avatar_str .= '<div class="cq-avatarblock-avatarcontainer">';

        if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
            $link_start .= '<a href="'.$avatarlink['url'].'" class="cq-avatarblock-link" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'">';
        }

        if($avatartype=="image"){
          if($avatarthumbnail!=""){
              $avatar_str .= '<div class="cq-avatarblock-avatar" style="background-image:url('.$avatarthumbnail.')">';
          }
        }else if($avatartype=="icon"){
          $avatar_str .= '<div class="cq-avatarblock-avatar">';
          if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $avataricon})&&esc_attr(${'icon_' . $avataricon})!=""&&$avatartype=="icon"){
            $avatar_str .= '<i class="cq-avatarblock-icon '.esc_attr(${'icon_' . $avataricon}).'" style="color:'.$iconcolor.';font-size:'.$iconsize.'"></i>';
          }
        }else{
            $avatar_str .= '<div class="cq-avatarblock-avatar">';
        }

        if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
            $link_end .= '</a>';
        }


        $avatar_str .= '</div>';
        $avatar_str .= '</div>';
        $content_str .= '<div class="cq-avatarblock-contentcontainer cq-avatarblock-'.$elementshape.'">';
        $content_str .= '<div class="cq-avatarblock-content">';
        if($texttitle!=""){
            $content_str .= '<h3 class="cq-avatarblock-title" style="font-size:'.$titlesize.';color:'.$titlecolor.'">';
            $content_str .= $texttitle;
            $content_str .= '</h3>';
        }
        $content_str .= do_shortcode($content);
        $content_str .= '</div>';
        $content_str .= '</div>';
        if($avatarposition=="left"){
            $output .= $link_start.$avatar_str.$link_end.$content_str;
        }else{
            $output .= $content_str.$link_start.$avatar_str.$link_end;
        }
        $output .= '</div>';
        return $output;

      }




  }
}

?>
