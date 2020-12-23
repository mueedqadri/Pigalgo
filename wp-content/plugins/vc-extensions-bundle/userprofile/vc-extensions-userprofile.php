<?php
if (!class_exists('VC_Extensions_UserProfile')){
    class VC_Extensions_UserProfile{
        private $slidenum = 1;
        function __construct() {
            vc_map(array(
            "name" => __("User Profile", 'cq_allinone_vc'),
            "base" => "cq_vc_userprofile",
            "class" => "cq_vc_userprofile",
            "icon" => "cq_vc_userprofile",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_userprofile_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('with social media icon', 'js_composer'),
            "params" => array(
              // array(
              //   "type" => "textarea_html",
              //   "heading" => __("More description under the title", "cq_allinone_vc"),
              //   "param_name" => "content",
              //   "value" => "",
              //   "group" => "Text",
              //   "description" => __("", "cq_allinone_vc")
              // ),

            array(
              "type" => "textfield",
              "heading" => __("Name", "cq_allinone_vc"),
              "param_name" => "name",
              "value" => "",
              "group" => "Text",
              "description" => __("Name of the user.", "cq_allinone_vc")
            ),
            array(
              "type" => "textfield",
              "heading" => __("User role", "cq_allinone_vc"),
              "param_name" => "userrole",
              "value" => "",
              "group" => "Text",
              "description" => __("Role for the user, like Web Developer, or something else.", "cq_allinone_vc")
            ),
            array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Text color", 'cq_allinone_vc'),
                "param_name" => "textcolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is gray.", 'cq_allinone_vc')
              ),
            array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Name font size", "cq_allinone_vc"),
                "param_name" => "namesize",
                "value" => "",
                "group" => "Text",
                "description" => __("font-size for the Name, default is 1.3em.", "cq_allinone_vc")
            ),
            array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Text background color", 'cq_allinone_vc'),
                "param_name" => "textbg",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
            array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Role font size", "cq_allinone_vc"),
                "param_name" => "rolesize",
                "value" => "",
                "group" => "Text",
                "description" => __("font-size for the Role.", "cq_allinone_vc")
            ),
            array(
              "type" => "attach_image",
              "heading" => __("Avatar image (optional)", "cq_allinone_vc"),
              "param_name" => "image",
              "value" => "",
              "group" => "Avatar",
              "description" => __("", "cq_allinone_vc")
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "cq_allinone_vc",
                "heading" => __("Avatar shadow", "cq_allinone_vc"),
                "param_name" => "avatarshadow",
                'value' => array('none', 'light', 'dark'),
                'std' => 'light',
                "group" => "Avatar",
                "description" => __("Select the default shadow style.", "cq_allinone_vc")
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Avatar size", "cq_allinone_vc"),
                "param_name" => "imagewidth",
                'value' => array('small (80px)' => 80, 'medium (100px)' => 100, 'large (120px)' => 120),
                'std' => '100',
                "group" => "Avatar",
                "description" => __("Select the size for the avatar, it will define the box height too.", "cq_allinone_vc")
            ),
            // array(
            //   "type" => "textfield",
            //   "edit_field_class" => "vc_col-xs-6 vc_column",
            //   "heading" => __("Resize avatar image to this width?", "cq_allinone_vc"),
            //   "param_name" => "imagewidth",
            //   "value" => "",
            //   "group" => "Avatar",
            //   "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. ", "cq_allinone_vc")
            // ),
            array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Avatar background color", 'cq_allinone_vc'),
                "param_name" => "avatarbg",
                "value" => "",
                "group" => "Avatar",
                "description" => __("Default is white.", 'cq_allinone_vc')
            ),
            array(
              "type" => "vc_link",
              "edit_field_class" => "vc_col-xs-6 vc_column",
              "heading" => __("URL (Optional link for the avatar)", "cq_allinone_vc"),
              "param_name" => "avatarlink",
              "value" => "",
              "group" => "Avatar",
              "description" => __("", "cq_allinone_vc")
            ),
            array(
              "type" => "textfield",
              "edit_field_class" => "vc_col-xs-6 vc_column",
              "heading" => __("Tooltip for the avatar (optional)", "cq_allinone_vc"),
              "param_name" => "avatartooltip",
              "value" => "",
              "group" => "Avatar",
              "description" => __("Optional tooltip for the avatar.", "cq_allinone_vc")
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Icon size (the popup social media icon)", "cq_allinone_vc"),
                "param_name" => "iconsize",
                'value' => array('small', 'large'),
                'std' => 'small',
                "group" => "Icon",
                "description" => __("Select the default icon size.", "cq_allinone_vc")
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Icon radius", "cq_allinone_vc"),
                "param_name" => "iconradius",
                'value' => array('small', 'medium', 'large'),
                'std' => 'medium',
                "group" => "Icon",
                "description" => __("Select the default popup social media icon radius, this is how the icons be displayed in a circle.", "cq_allinone_vc")
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Auto open the icons?", "cq_allinone_vc"),
                "param_name" => "autoslide",
                'value' => array(2, 3, 4, 5, 6, 8, 10, __( 'Disable', 'cq_allinone_vc' ) => 0 ),
                'std' => 0,
                "description" => __("Auto open the icons in each X seconds.", "cq_allinone_vc")
              ),
            array(
              "type" => "textfield",
              "heading" => __("width of the whole element", "cq_allinone_vc"),
              "param_name" => "elementwidth",
              "value" => "",
              "description" => __("Default is 70%, you can specify other value like <strong>80%</strong> etc here. Note, require some space to display the icons circle.", "cq_allinone_vc")
            ),
            // array(
            //   "type" => "textfield",
            //   "heading" => __("min-height of the whole element", "cq_allinone_vc"),
            //   "param_name" => "minheight",
            //   "value" => "",
            //   "description" => __("Default is 240px.", "cq_allinone_vc")
            // ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Display box shadow?", "cq_allinone_vc"),
                "param_name" => "boxshadow",
                'value' => array('none', 'medium', 'large'),
                'std' => 'none',
                "description" => __("Select the default box shadow for the whole element.", "cq_allinone_vc")
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "class" => "cq_allinone_vc",
                "heading" => __("Shadow size for the socia icon", "cq_allinone_vc"),
                "param_name" => "iconshadow",
                'value' => array('none', 'medium', 'large'),
                'std' => 'none',
                "group" => "Icon",
                "description" => __("Select the default shadow size.", "cq_allinone_vc")
            ),
            array(
              "type" => "dropdown",
              "holder" => "",
              "edit_field_class" => "vc_col-xs-6 vc_column",
              "heading" => __("Social icon hover shadow color", "cq_allinone_vc"),
              "param_name" => "iconbgstyle",
              "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent"),
              'std' => 'aqua',
              "group" => "Icon",
              "description" => __("Select the default hover shadow color for the social icon.", "cq_allinone_vc")
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
             "name" => __("Icon","cq_allinone_vc"),
             "base" => "cq_vc_userprofile_item",
             "class" => "cq_vc_userprofile_item",
             "icon" => "cq_vc_userprofile_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("add icon, link, tooltip etc","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_userprofile'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  'type' => 'dropdown',
                  'heading' => __( 'Icon library (select an icon for the button)', 'js_composer' ),
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
                "type" => "textfield",
                "heading" => __("Tooltip (optional)", "cq_allinone_vc"),
                "param_name" => "tooltip",
                "value" => "",
                "description" => __("Optional tooltip for the icon.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "class" => "",
                "heading" => __("Icon background color", 'cq_allinone_vc'),
                "param_name" => "iconbg",
                "value" => "",
                "group" => "Icon",
                "description" => __("Default is dark gray.", 'cq_allinone_vc')
              ),
              array(
                "type" => "vc_link",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("URL (Optional link for the button)", "cq_allinone_vc"),
                "param_name" => "buttonlink",
                "value" => "",
                "description" => __("", "cq_allinone_vc")
              )

              ),
            )
        );

          add_shortcode('cq_vc_userprofile', array($this,'cq_vc_userprofile_func'));
          add_shortcode('cq_vc_userprofile_item', array($this,'cq_vc_userprofile_item_func'));

      }

      function cq_vc_userprofile_func($atts, $content=null) {
        $iconsize = $iconnum = $iconradius = $css_class = $css = $extraclass = $elementwidth = $minheight = $image = $imagewidth = $name = $userrole = $iconbgstyle = $textbg = $textcolor = $boxshadow = $iconshadow = $iconshadowcolor = $avatarshadow = $avatarbg = $namesize = $rolesize = $autoslide = $avatarlink = $avatartooltip = '';
        $this -> slidenum = 1;
        extract(shortcode_atts(array(
          "iconsize" => "small",
          "iconradius" => "medium",
          "iconnum" => "3",
          "elementwidth" => "",
          // "minheight" => "",
          "image" => "",
          "imagewidth" => "100",
          "name" => "",
          "userrole" => "",
          "iconbgstyle" => "aqua",
          "textcolor" => "",
          "textbg" => "",
          "boxshadow" => "",
          "iconshadow" => "none",
          "iconshadowcolor" => "lightgray",
          "avatarshadow" => "light",
          "avatarbg" => "",
          "css" => "",
          "autoslide" => "",
          "namesize" => "",
          "rolesize" => "",
          "avatarlink" => "",
          "avatartooltip" => "",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_userprofile', $atts);
        wp_register_style( 'vc-extensions-userprofile-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-userprofile-style' );

        wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
        wp_enqueue_style('tooltipster');
        wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('tooltipster');

        wp_register_script('vc-extensions-userprofile-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "tooltipster"));
        wp_enqueue_script('vc-extensions-userprofile-script');

        $content = wpb_js_remove_wpautop($content, false); // fix unclosed/unwanted paragraph tags in $content


        $avatar_attachment = get_post($image);
        $avatarimagearr = wp_get_attachment_image_src(trim($image), 'full');
        $avatar_image_temp = $avatar_image_url = "";
        $avatar_orgi_image = $avatarimagearr[0];
        $avatar_image_url = $avatar_orgi_image;
        if( $imagewidth!="" ){
            if(function_exists('wpb_resize')){
                $avatar_image_temp = wpb_resize($image, null, $imagewidth*2, $imagewidth*2, true);
                $avatar_image_url = $avatar_image_temp['url'];
                if($avatar_image_url=="") $avatar_image_url = $avatar_orgi_image;
            }
        }

        $avatarlink = vc_build_link($avatarlink);
        $output = '';
        $output .= '<div class="cq-userprofile cq-userprofile-icon-'.$iconsize.' cq-userprofile-radius-'.$iconradius.' cq-userprofile-'.$iconbgstyle.' cq-userprofile-shadow-'.$boxshadow.' cq-userprofile-avatar-'.$imagewidth.'" data-autoslide="'.$autoslide.'">';
        $output .= '<div class="cq-userprofile-container '.$avatarshadow.'-shadow">';
        if($avatar_image_url!=""){
            if($avatarbg!=""){
                $output .= '<div class="cq-userprofile-avatar" style="background:'.$avatarbg.';border:4px solid '.$avatarbg.'">';
                if($avatarlink["url"]!=""){
                    $output .= '<a href="'.$avatarlink["url"].'" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'" rel="'.$avatarlink["rel"].'" class="cq-userprofile-avatarlink" data-avatartooltip="'.$avatartooltip.'">';
                }
                $output .= '<img src="'.$avatar_image_url.'" alt="'.get_post_meta($avatar_attachment->ID, '_wp_attachment_image_alt', true ).'" /> ';
                if($avatarlink["url"]!=""){ $output .= '</a>';}
                $output .= '</div> ';
            }else{
                $output .= '<div class="cq-userprofile-avatar" style="background:'.$avatarbg.';">';
                if($avatarlink["url"]!=""){
                    $output .= '<a href="'.$avatarlink["url"].'" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'" rel="'.$avatarlink["rel"].'" class="cq-userprofile-avatarlink" data-avatartooltip="'.$avatartooltip.'">';
                }

                $output .= '<img src="'.$avatar_image_url.'" alt="'.get_post_meta($avatar_attachment->ID, '_wp_attachment_image_alt', true ).'" />';
                if($avatarlink["url"]!=""){ $output .= '</a>';}
                $output .= '</div> ';
            }
        }
        $output .= '<div class="cq-userprofile-content" style="color:'.$textcolor.';background:'.$textbg.'">';
        $output .= '<div class="cq-userprofile-user">';
        if($name!=""){
            $output .= '<span class="cq-userprofile-name" style="font-size:'.$namesize.'">'.$name.'</span class="cq-userprofile-name">';
        }
        if($userrole!=""){
            $output .= '<span class="cq-userprofile-role" style="font-size:'.$rolesize.'">'.$userrole.'</span class="cq-userprofile-role">';
        }
        $output .= '</div>';
        $output .= '<div class="cq-userprofile-btn"><span></span></div>';
        $output .= '</div>';
        $output .= '<div class="cq-userprofile-iconcontainer cq-userprofile-iconshadow-'.$iconshadow.' cq-userprofile-iconcontainer-'.($this -> slidenum - 1).'">';
        $output .= do_shortcode($content);
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }


      function cq_vc_userprofile_item_func($atts, $content=null, $tag) {
          $buttonicon = $buttonlink = $align = $iconbg = $tooltip = "";
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = '';

          extract(shortcode_atts(array(
            "buttonicon" => "entypo",
            "icon_fontawesome" => 'fa fa-share',
            "icon_openiconic" => 'vc-oi vc-oi-dial',
            "icon_typicons" => 'typcn typcn-adjust-brightness',
            "icon_entypo" => 'entypo-icon entypo-icon-comment',
            "icon_linecons" => 'vc_li vc_li-heart',
            "icon_material" => 'vc-material vc-material-cake',
            "buttonlink" => "",
            "iconbg" => "",
            "tooltip" => "",
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          vc_icon_element_fonts_enqueue($buttonicon);

          $slidenum = $this -> slidenum;

          $buttonlink = vc_build_link($buttonlink);
          $output = '';
          $output .= '<a href="'.$buttonlink["url"].'" title="'.$buttonlink["title"].'" target="'.$buttonlink["target"].'" rel="'.$buttonlink["rel"].'" class="cq-userprofile-buttonlink" style="background:'.$iconbg.'" data-icontooltip="'.$tooltip.'">';
          if(isset(${'icon_' . $buttonicon})){
            $output .= '<i class="cq-userprofile-icon '.esc_attr(${'icon_' . $buttonicon}).'"></i>';
          }
          $output .= '</a>';
          $slidenum++;
          $this -> slidenum = $slidenum;

          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_userprofile')) {
    class WPBakeryShortCode_cq_vc_userprofile extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_userprofile_item')) {
    class WPBakeryShortCode_cq_vc_userprofile_item extends WPBakeryShortCode {
    }
}

?>
