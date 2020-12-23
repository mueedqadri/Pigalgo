<?php
if (!class_exists('VC_Extensions_BackgroundButton')&&class_exists('WPBakeryShortCode')) {
    class VC_Extensions_BackgroundButton extends WPBakeryShortCode{
        function __construct() {
            $pixel_icons = '';
            if(function_exists('vc_pixel_icons')) $pixel_icons = vc_pixel_icons();
            vc_map(array(
            "name" => __("Background Button", 'vc_backgroundbutton_cq'),
            "base" => "cq_vc_backgroundbutton",
            "class" => "wpb_cq_vc_extension_backgroundbutton",
            // "as_parent" => array('only' => 'cq_vc_backgroundbutton_item'),
            "icon" => "cq_allinone_backgroundbutton",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Animate image button with icon', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Button background image:", "vc_backgroundbutton_cq"),
                "param_name" => "buttonimage",
                "value" => "",
                "group" => "Background",
                "description" => __("Select image(s) from media library, support multiple images.", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Resize the image?", "vc_backgroundbutton_cq"),
                "param_name" => "isresize",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "group" => "Background",
                "description" => __("", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_backgroundbutton_cq"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "group" => "Background",
                "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. ", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background overlay gradient color start with", 'vc_backgroundbutton_cq'),
                "param_name" => "startcolor",
                "value" => "rgba(73,159,205,0.70)",
                "group" => "Background",
                "description" => __("Default is rgba(73,159,205,0.70)", 'vc_backgroundbutton_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background overlay gradient color end with", 'vc_backgroundbutton_cq'),
                "param_name" => "endcolor",
                "value" => "rgba(26,105,170,0.70)",
                "group" => "Background",
                "description" => __("Default is rgba(26,105,170,0.70)", 'vc_backgroundbutton_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_backgroundbutton_cq",
                "heading" => __("Text", 'vc_backgroundbutton_cq'),
                "param_name" => "buttonlabel",
                "value" => __("", 'vc_backgroundbutton_cq'),
                "std" => "Hello Button",
                "group" => "Text",
                "description" => __("", 'vc_backgroundbutton_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_backgroundbutton_cq",
                "heading" => __("font-size", 'vc_backgroundbutton_cq'),
                "param_name" => "fontsize",
                "value" => __("", 'vc_backgroundbutton_cq'),
                "group" => "Text",
                "description" => __("Default is <strong>1.2em</strong>, customize it with other value as you like, for example, <strong>1.5em</strong> or <strong>14px</strong>.", 'vc_backgroundbutton_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text color", 'vc_backgroundbutton_cq'),
                "param_name" => "textcolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is white.", 'vc_backgroundbutton_cq')
              ),
              // array(
              //   "type" => "textfield",
              //   "holder" => "",
              //   "class" => "vc_backgroundbutton_cq",
              //   "heading" => __("Tooltip for the button (optional)", 'vc_backgroundbutton_cq'),
              //   "param_name" => "tooltip",
              //   "value" => __("", 'vc_backgroundbutton_cq'),
              //   "std" => "",
              //   "group" => "Text",
              //   "description" => __("", 'vc_backgroundbutton_cq')
              // ),
              array(
                'type' => 'checkbox',
                'heading' => __( 'Display tooltip for the button?', 'vc_backgroundbutton_cq' ),
                'param_name' => 'istooltip',
                'description' => __( 'If checked, will display a tooltip when user hover the button. Customize the tooltip content below.', 'vc_backgroundbutton_cq' ),
                'std' => 'no',
                "group" => "Text",
                'value' => array( __( 'Yes', 'vc_backgroundbutton_cq' ) => 'yes' ),
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Tooltip content", "vc_backgroundbutton_cq"),
                "param_name" => "content",
                "value" => __("", "vc_backgroundbutton_cq"),
                "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
                "group" => "Text",
                "description" => __("", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_backgroundbutton_cq",
                "heading" => __("min width for the tooltip", 'vc_backgroundbutton_cq'),
                "param_name" => "minwidth",
                "value" => __("", 'vc_backgroundbutton_cq'),
                "std" => "",
                "group" => "Text",
                "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
                "description" => __("Default is 360, you can change it to a larger value (for example 600) if you want to display the tooltip in a larger popup.", 'vc_backgroundbutton_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Animation for the tooltip", "vc_backgroundbutton_cq"),
                "param_name" => "tooltipanimation",
                "value" => array("fade", "grow", "swing", "slide", "fall"),
                "std" => "fade",
                "group" => "Text",
                "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
                "description" => __("Select how the tooltip will animate in.", "vc_backgroundbutton_cq")
              ),
              array(
                'type' => 'checkbox',
                'heading' => __( 'Auto close the tooltip when user mouse out', 'vc_backgroundbutton_cq' ),
                'param_name' => 'autoclose',
                'description' => __( 'If checked, the tooltip will be auto closed when user mouse out, uncheck this if you want it to stay visible, for example display a google map.', 'vc_backgroundbutton_cq' ),
                'std' => 'yes',
                "group" => "Text",
                "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
                'value' => array( __( 'Yes', 'vc_backgroundbutton_cq' ) => 'yes' ),
              ),
              array(
                'type' => 'checkbox',
                'heading' => __( 'Display the tooltip by default?', 'vc_backgroundbutton_cq' ),
                'param_name' => 'autoloaded',
                'description' => __( 'If checked, the tooltip will be diplayed by default when page loaded.', 'vc_backgroundbutton_cq' ),
                'std' => 'no',
                "group" => "Text",
                "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
                'value' => array( __( 'Yes', 'vc_backgroundbutton_cq' ) => 'yes' ),
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Display the icon?", "vc_backgroundbutton_cq"),
                "param_name" => "isicon",
                "value" => array("Put icon on the left"=>"icon-left", "Put icon on the right"=>"icon-right", "No icon"=>"no-icon"),
                "std" => "icon-left",
                "group" => "Icon",
                "description" => __("", "vc_backgroundbutton_cq")
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
                  __( 'Pixel', 'js_composer' ) => 'pixelicons',
                  __( 'Material', 'js_composer' ) => 'material',
                  __( 'Mono Social', 'js_composer' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'buttonicon',
                "group" => "Icon",
                "dependency" => Array('element' => "isicon", 'value' => array('icon-left', 'icon-right')),
                'description' => __( 'Select icon library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-heart', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
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
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
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
                'param_name' => 'icon_pixelicons',
                'settings' => array(
                  'emptyIcon' => false,
                  // default true, display an "EMPTY" icon?
                  'type' => 'pixelicons',
                  'source' => $pixel_icons,
                ),
                'dependency' => array(
                  'element' => 'buttonicon',
                  'value' => 'pixelicons',
                ),
                "group" => "Icon",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_monosocial',
                'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'monosocial',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'buttonicon',
                  'value' => 'monosocial',
                ),
                "group" => "Icon",
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
                  'element' => 'buttonicon',
                  'value' => 'material',
                ),
                "group" => "Icon",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Icon animation", "vc_backgroundbutton_cq"),
                "param_name" => "iconanimation",
                "value" => array("Scale up"=>"style1", "Rotate"=>"style2", "Fade out"=>"style3", "Drop down"=>"style4"),
                "std" => "style1",
                "group" => "Icon",
                "dependency" => Array('element' => "isicon", 'value' => array('icon-left', 'icon-right')),
                "description" => __("", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color", 'vc_backgroundbutton_cq'),
                "param_name" => "iconcolor",
                "value" => "#FFFFFF",
                "group" => "Icon",
                "dependency" => Array('element' => "isicon", 'value' => array('icon-left', 'icon-right')),
                "description" => __("Default is white.", 'vc_backgroundbutton_cq')
              ),
              array(
                'type' => 'checkbox',
                'heading' => __( 'Append a large transparent to the other side?', 'vc_backgroundbutton_cq' ),
                'param_name' => 'extraicon',
                'description' => __( 'If checked, will append a large transparent icon to the other side, displayed when user hover.', 'vc_backgroundbutton_cq' ),
                'std' => 'yes',
                "dependency" => Array('element' => "isicon", 'value' => array('icon-left', 'icon-right')),
                "group" => "Icon",
                'value' => array( __( 'Yes', 'vc_backgroundbutton_cq' ) => 'yes' ),
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_backgroundbutton_cq",
                "heading" => __("font size of the extra icon", 'vc_backgroundbutton_cq'),
                "param_name" => "icon2size",
                "value" => __("", 'vc_backgroundbutton_cq'),
                "std" => "",
                "dependency" => Array('element' => "extraicon", 'value' => array('yes')),
                "group" => "Icon",
                "description" => __("Default is <strong>100px</strong>, change to other value as you like. For example <strong>3em</strong>, <strong>120px</strong> etc", 'vc_backgroundbutton_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_backgroundbutton_cq",
                "heading" => __("Open the button as", "vc_backgroundbutton_cq"),
                "param_name" => "linktype",
                "value" => array(__("Open lightbox (same image in large size)", "vc_backgroundbutton_cq") => "lightbox", __("Open lightbox (custom URL, e.g. different image or YouTube/Vimeo video, specify URL below)", "vc_backgroundbutton_cq") => "lightbox_custom",  __("Do nothing", "vc_backgroundbutton_cq") => "none", __("Open custom link", "vc_backgroundbutton_cq") => "customlink"),
                "std" => "none",
                "group" => "Link",
                "description" => __("", "vc_backgroundbutton_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (link for the button)', 'vc_backgroundbutton_cq' ),
                'param_name' => 'buttonlink',
                "dependency" => Array('element' => "linktype", 'value' => array('customlink')),
                'group' => 'Link',
                'description' => __( '', 'vc_backgroundbutton_cq' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'lightbox URL, support image or YouTube/Vimeo video', 'vc_backgroundbutton_cq' ),
                'param_name' => 'lightbox_url',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'group' => 'Link',
                'description' => __( 'Just copy and paste the page URL of the <strong>YouTube</strong> or <strong>Vimeo</strong> video, something like <strong>https://www.youtube.com/watch?v=pNSKQ9Qp36M&autoplay=1</strong> or <strong>https://vimeo.com/127081676?autoplay=1</strong>. Add the <strong>autoplay=1</strong> in the URL to auto play the video. Also support custom image link.', 'vc_backgroundbutton_cq' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'video width, default is 640', 'vc_backgroundbutton_cq' ),
                'param_name' => 'videowidth',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'value' => '640',
                'group' => 'Link',
                'description' => __( '', 'vc_backgroundbutton_cq' )
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Alignment/size", "vc_backgroundbutton_cq"),
                "param_name" => "alignment",
                "value" => array("Left (auto width)"=>"left", "Center (auto width)"=>"center", "Right (auto width)"=>"right", "Full width"=>"fullwidth"),
                "std" => "fullwidth",
                "description" => __("Choose how to display the button.", "vc_backgroundbutton_cq")
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("padding", "vc_backgroundbutton_cq"),
              //   "param_name" => "padding",
              //   "value" => "",
              //   "description" => __("The padding of the button, default is 20px. You can specify other value to get a different looking.", "vc_backgroundbutton_cq")
              // ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Element height", "vc_backgroundbutton_cq"),
              //   "param_name" => "bgheight",
              //   "value" => "240",
              //   "description" => __("The height of whole element, only available with color background, default is <strong>240</strong> (in pixel).", "vc_backgroundbutton_cq")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("margin of the lightbox margin", "vc_backgroundbutton_cq"),
                "param_name" => "lightboxmargin",
                "value" => "",
                'group' => 'Link',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                "description" => __("The margin of the lightbox image, default is <strong>20</strong> (in pixel).", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_backgroundbutton_cq",
                "heading" => __("Shape", "vc_backgroundbutton_cq"),
                "param_name" => "bgshape",
                "value" => array("Rounded" => "roundsmall", "Round" => "roundlarge", "Square" => "square"),
                "std" => "roundsmall",
                "description" => __("", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_backgroundbutton_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_backgroundbutton_cq")
              ),
              array(
                "type" => "css_editor",
                "heading" => __( "Css", "vc_backgroundbutton_cq" ),
                "param_name" => "css",
                "description" => __("It's recommended to use this to customize the button padding/margin only. The default padding is 30px, you can use the padding to control the size of the button.", "vc_backgroundbutton_cq"),
                "group" => __( "Design options", "vc_backgroundbutton_cq" ),
            )

           )
        ));

        add_shortcode('cq_vc_backgroundbutton', array($this,'cq_vc_backgroundbutton_func'));

      }

      function cq_vc_backgroundbutton_func($atts, $content=null, $tag) {
          $buttonicon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_monosocial = $icon_material = $css = '';
          $isicon = "icon-left";
          $buttonlabel = "Hello Button";
          $buttonimage = $isresize = $buttonlink = $extraclass = $startcolor = $endcolor = $fontsize = $iconcolor = $textcolor = $icon2size = $linktype = $lightboxmargin = $istooltip = $autoclose = $iconanimation = $minwidth = $tooltipanimation = $autoloaded = $linktype = $bgshape = $isicon = $extraicon = $buttonlabel = "";
          // $alignment = "fullwidth";
          extract(shortcode_atts(array(
            "icon_fontawesome" => 'fa fa-bullhorn',
            "icon_openiconic" => 'vc-oi vc-oi-dial',
            "icon_typicons" => 'typcn typcn-adjust-brightness',
            "icon_entypo" => 'entypo-icon entypo-icon-note',
            "icon_linecons" => 'vc_li vc_li-heart',
            "icon_material" => 'vc-material vc-material-cake',
            "icon_monosocial" => 'vc-mono vc-mono-fivehundredpx',
            "icon_pixelicons" => 'vc_pixel_icon vc_pixel_icon-alert',

            "buttonimage" => "",
            "startcolor" => "",
            "endcolor" => "",
            "imagewidth" => "",
            "isresize" => "no",
            "iconanimation" => "",
            "alignment" => "fullwidth",
            // "padding" => "",
            "isicon" => "icon-left",
            "buttonlabel" => "Hello Button",
            "css" => "",
            "extraicon" => "yes",
            "icon2size" => "",
            "istooltip" => "",
            "autoloaded" => "",
            "autoclose" => "",
            "minwidth" => "",
            "tooltipanimation" => "",
            "bgshape" => "roundsmall",
            // "tooltip" => "",
            "fontsize" => "",
            "buttonicon" => "fontawesome",
            "textcolor" => "",
            "iconcolor" => "",
            "lightboxmargin" => "",
            "linktype" => "",
            "lightbox_url" => "",
            "videowidth" => "640",
            "buttonlink" => "",
            "extraclass" => ""
          ), $atts));

          $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_backgroundbutton', $atts);

          vc_icon_element_fonts_enqueue('linecons');
          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
              vc_icon_element_fonts_enqueue($buttonicon);
          }else{
              // wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
              // wp_enqueue_style( 'font-awesome' );
          }


          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $content = str_replace("<p></p>", "", $content);
          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_style('formstone-lightbox', plugins_url('../videocover/css/lightbox.css', __FILE__));
          wp_enqueue_style('formstone-lightbox');
          wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');
          wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');
          wp_register_script('formstone-lightbox', plugins_url('../videocover/js/lightbox.js', __FILE__));
          wp_enqueue_script('formstone-lightbox');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_style( 'vc-extensions-backgroundbutton-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-backgroundbutton-style' );
          wp_register_script('vc-extensions-backgroundbutton-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "formstone-lightbox", "fs.boxer", "tooltipster"));
          wp_enqueue_script('vc-extensions-backgroundbutton-script');

          $realimage = $img = $thumbnail = "";
          $realimage = wp_get_attachment_image_src($buttonimage, 'full');

          $fullimage = $realimage[0];
          $thumbnail = $fullimage;
          if($isresize=="yes"&&$imagewidth!=""){
              if(function_exists('wpb_resize')){
                  $img = wpb_resize($buttonimage, null, $imagewidth, null);
                  $thumbnail = $img['url'];
                  if($thumbnail=="") $thumbnail = $fullimage;
              }
          }

          // if($buttonimage[0]!=""){
          //     if($isresize=="yes"&&$imagewidth!=""){
          //         $realimage = aq_resize($buttonimage[0], $imagewidth, null, true, true, true);
          //     }else{
          //         $realimage = $buttonimage[0];
          //     }

          // }


          $buttonlink = vc_build_link($buttonlink);


          $i = -1;
          $output = '';
          $output .= '<div class="cq-bgbutton-container  '.$extraclass.' cq-bgbutton-align'.$alignment.'" data-buttonimage="'.$thumbnail.'" data-startcolor="'.$startcolor.'" data-endcolor="'.$endcolor.'" data-fontsize="'.$fontsize.'" data-iconcolor="'.$iconcolor.'" data-textcolor="'.$textcolor.'" data-icon2size="'.$icon2size.'" data-linktype="'.$linktype.'" data-lightboxmargin="'.$lightboxmargin.'" data-videowidth="'.$videowidth.'" data-tooltip="'.esc_html($content).'" data-istooltip="'.$istooltip.'" data-autoclose="'.$autoclose.'" data-iconanimation="'.$iconanimation.'" data-minwidth="'.$minwidth.'" data-tooltipanimation="'.$tooltipanimation.'" data-autoloaded="'.$autoloaded.'">';

          if($linktype=="lightbox"){
              $output .= '<a href="'.$buttonimage[0].'" class="cq-bgbutton '.$bgshape.' cq-bgbutton-link cq-bgbutton-lightbox '.$css_class.' cq-bgbutton-'.$iconanimation.'" title="'.esc_html($content).'">';
          }else if($linktype=="lightbox_custom"){
              $output .= '<a href="'.$lightbox_url.'" class="cq-bgbutton '.$bgshape.' cq-bgbutton-link cq-bgbutton-lightbox '.$css_class.' cq-bgbutton-'.$iconanimation.'" title="'.esc_html($content).'">';
          }else if($linktype=="customlink"){
            if($buttonlink["url"]!=="") $output .= '<a href="'.$buttonlink["url"].'" title="'.$buttonlink["title"].'" target="'.$buttonlink["target"].'" class="cq-bgbutton '.$bgshape.' cq-bgbutton-link '.$css_class.' cq-bgbutton-'.$iconanimation.'">';
          }else{
              $output .= '<button class="cq-bgbutton '.$bgshape.' '.$css_class.' cq-bgbutton-'.$iconanimation.'" title="'.esc_html($content).'">';
          }

          if($isicon=="icon-left"){
              // if($iconanimation=="style4"){
              //     if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $buttonicon})){
              //         $output .= '<i class="cq-bgbutton-icon3 cq-bgbutton-iconleft '.esc_attr(${'icon_' . $buttonicon}).'"></i>';
              //     }
              // }
              if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $buttonicon})){
                  $output .= '<i class="cq-bgbutton-icon1 cq-bgbutton-iconleft '.esc_attr(${'icon_' . $buttonicon}).'"></i>';
              }

          }
          if($extraicon=="yes"&&$isicon=="icon-right"){
              // $output .= '<i class="cq-bgbutton-icon2 fa fa-heart"></i>';
            if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $buttonicon})){
                  $output .= '<i class="cq-bgbutton-icon2 cq-bgbutton-iconleft '.esc_attr(${'icon_' . $buttonicon}).'"></i>';
              }

          }


          $output .= $buttonlabel;
          if($extraicon=="yes"&&$isicon=="icon-left"){
            if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $buttonicon})){
                  $output .= '<i class="cq-bgbutton-icon2 cq-bgbutton-iconright '.esc_attr(${'icon_' . $buttonicon}).'"></i>';
              }

          }
          if($isicon=="icon-right"){
              if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $buttonicon})){
                  $output .= '<i class="cq-bgbutton-icon1 cq-bgbutton-iconright '.esc_attr(${'icon_' . $buttonicon}).'"></i>';
              }
          }

          if($linktype=="lightbox" || $linktype=="lightbox_custom" || $linktype=="customlink"){
              $output .= '</a>';
          }else{
              $output .= '</button>';
          }

          $output .= '</div>';
          return $output;

        }


  }
}

?>
