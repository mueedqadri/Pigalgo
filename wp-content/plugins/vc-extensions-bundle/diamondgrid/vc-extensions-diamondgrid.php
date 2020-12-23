<?php
if (!class_exists('VC_Extensions_DiamondGrid')){
    class VC_Extensions_DiamondGrid{
        function __construct() {
            vc_map(array(
            "name" => __("Diamond Grid", 'cq_allinone_vc'),
            "base" => "cq_vc_diamondgrid",
            "class" => "cq_vc_diamondgrid",
            "icon" => "cq_vc_diamondgrid",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_diamondgrid_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('max 4 images, support lightbox', 'js_composer'),
            "params" => array(
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Grid image size", "cq_allinone_vc"),
                 "param_name" => "gridsize",
                 "value" => array("small", "large"),
                 "std" => "small",
                 "description" => __("Customize the grid setting here first, then <a href='".plugins_url('img/griditem.png', __FILE__)."' target='_blank'>add the Grid Item</a> one by one.", "cq_allinone_vc")
              ),
              // array(
              //   "type" => "dropdown",
              //   "holder" => "",
              //   "class" => "",
              //   "heading" => __("Tooltip position", "cq_allinone_vc"),
              //   "param_name" => "tooltipposition",
              //   "value" => array("top", "4 position, depends on the image position"=>"position4"),
              //   "std" => "top",
              //   // "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
              //   "description" => __("Available when the grid has tooltip.", "cq_allinone_vc")
              // ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background color of all grid item, include the padding between each item.", 'cq_allinone_vc'),
                "param_name" => "itembgcolor",
                "value" => "",
                "description" => __("Default is transparent.", 'cq_allinone_vc')
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
             "base" => "cq_vc_diamondgrid_item",
             "class" => "cq_vc_diamondgrid_item",
             "icon" => "cq_vc_diamondgrid_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add image, icon and text","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_diamondgrid'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  "type" => "attach_image",
                  "heading" => __("Imag:", "cq_allinone_vc"),
                  "param_name" => "image",
                  "value" => "",
                  "group" => "Image",
                  "description" => __("Select from media library.", "cq_allinone_vc")
                ),
                array(
                  'type' => 'checkbox',
                  'heading' => __( 'Resize the image?', 'cq_allinone_vc' ),
                  'param_name' => 'isresize',
                  'description' => __( 'We will use the original image by default, you can specify a width below if the original image is too large.', 'cq_allinone_vc' ),
                  'std' => 'no',
                  "group" => "Image",
                  'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' ),
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Resize image to this width.", "cq_allinone_vc"),
                  "param_name" => "imagesize",
                  "value" => "",
                  "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                  "group" => "Image",
                  "description" => __('Enter image width in pixels, for example: 400. The image in the grid item then will be resized to 400. Leave empty to use original full image.', "cq_allinone_vc")
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
                  // __( 'Mono Social', 'js_composer' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'hovericon',
                "group" => "Icon",
                'description' => __( 'Select icon library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-heart', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'fontawesome',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                  'element' => 'hovericon',
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
                  'element' => 'hovericon',
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
                  'element' => 'hovericon',
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
                  'element' => 'hovericon',
                  'value' => 'material',
                ),
                "group" => "Icon",
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
              //     'element' => 'hovericon',
              //     'value' => 'monosocial',
              //   ),
              //   "group" => "Icon",
              //   'description' => __( 'Select icon from library.', 'js_composer' ),
              // ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color", 'cq_allinone_vc'),
                "param_name" => "iconcolor",
                "value" => "",
                "group" => "Icon",
                "description" => __("Default is white.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon hover color", 'cq_allinone_vc'),
                "param_name" => "iconhovercolor",
                "value" => "",
                "group" => "Icon",
                "description" => __("Default is same as the link.", 'cq_allinone_vc')
              ),
                // array(
                //   'type' => 'checkbox',
                //   'heading' => __( 'Display tooltip for the image?', 'cq_allinone_vc' ),
                //   'param_name' => 'istooltip',
                //   'description' => __( 'If checked, will display a tooltip when user hover the button. Customize the tooltip content below.', 'cq_allinone_vc' ),
                //   'std' => 'no',
                //   "group" => "Image",
                //   'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' ),
                // ),
                array(
                  "type" => "textfield",
                  "heading" => __("Tooltip", "cq_allinone_vc"),
                  "param_name" => "tooltip",
                  "value" => "",
                  // "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
                  "group" => "Tooltip",
                  "description" => __("", "cq_allinone_vc")
                ),
                array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Animation for the tooltip", "cq_allinone_vc"),
                "param_name" => "tooltipanimation",
                "value" => array("fade", "grow", "swing", "slide", "fall"),
                "std" => "grow",
                "group" => "Tooltip",
                "description" => __("Select how the tooltip will animate in.", "cq_allinone_vc")
              ),
                array(
                  'type' => 'checkbox',
                  'heading' => __( 'Display caption in the lightbox?', 'cq_allinone_vc' ),
                  'param_name' => 'iscaption',
                  'description' => __( 'If checked, the tooltip will be displayed as caption in the lightbox.', 'cq_allinone_vc' ),
                  'std' => 'no',
                  "dependency" => Array('element' => "linktype", 'value' => array('lightbox', 'lightbox_custom')),
                  "group" => "Tooltip",
                  // "dependency" => Array('element' => "istooltip", 'value' => array('yes')),
                  'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' ),
                ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Open the link as", "cq_allinone_vc"),
                "param_name" => "linktype",
                "value" => array(__("Open lightbox (same image in large size)", "cq_allinone_vc") => "lightbox", __("Custom lightbox, support different image or YouTube/Vimeo video too, specify URL below)", "cq_allinone_vc") => "lightbox_custom", __("Custom link, specify link below)", "cq_allinone_vc") => "url_custom",  __("Do nothing", "cq_allinone_vc") => "none"),
                "std" => "none",
                "group" => "Link",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Select lightbox mode", "cq_allinone_vc"),
                "param_name" => "lightboxmode",
                "value" => array(__("prettyPhoto", "cq_allinone_vc") => "prettyphoto", __("boxer", "cq_allinone_vc") => "boxer"),
                "std" => "boxer",
                "group" => "Link",
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox')),
                "description" => __("", "cq_allinone_vc")
              ),
              // array(
              //   'type' => 'checkbox',
              //   'heading' => __( 'Display the lightbox in gallery?', 'cq_allinone_vc' ),
              //   'param_name' => 'isgallery',
              //   'description' => __( 'If checked, will display the lightbox in gallery mode.', 'cq_allinone_vc' ),
              //   'std' => 'no',
              //   "group" => "Link",
              //   "dependency" => Array('element' => "linktype", 'value' => array('lightbox')),
              //   'value' => array( __( 'Yes', 'cq_allinone_vc' ) => 'yes' ),
              // ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'custom URL', 'cq_allinone_vc' ),
                'param_name' => 'custom_url',
                "dependency" => Array('element' => "linktype", 'value' => array('url_custom')),
                'group' => 'Link',
                'description' => __( '', 'cq_allinone_vc' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'lightbox URL, support image or YouTube/Vimeo video', 'cq_allinone_vc' ),
                'param_name' => 'lightbox_url',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'group' => 'Link',
                'description' => __( 'Just copy and paste the page URL of the <strong>YouTube</strong> or <strong>Vimeo</strong> video, something like <strong>https://www.youtube.com/watch?v=pNSKQ9Qp36M&autoplay=1</strong> or <strong>https://vimeo.com/127081676?autoplay=1</strong>. Add the <strong>autoplay=1</strong> in the URL to auto play the video. Also support custom image link. ', 'cq_allinone_vc' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'video width, default is 640', 'cq_allinone_vc' ),
                'param_name' => 'videowidth',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'value' => '640',
                'group' => 'Link',
                'description' => __( '', 'cq_allinone_vc' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("lightbox margin", "cq_allinone_vc"),
                "param_name" => "lightboxmargin",
                "value" => "",
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox', 'lightbox_custom')),
                'group' => 'Link',
                "description" => __("The margin of the lightbox image, default is <strong>20</strong> (in pixel).", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Background color of the grid item:", "cq_allinone_vc"),
                "param_name" => "bgstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'aqua',
                'group' => 'Background',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background color", 'cq_allinone_vc'),
                "param_name" => "backgroundcolor",
                "value" => "",
                'group' => 'Background',
                "dependency" => Array('element' => "bgstyle", 'value' => array('customized')),
                "description" => __("Default is transparent.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background hover color", 'cq_allinone_vc'),
                "param_name" => "backgroundhovercolor",
                "value" => "",
                'group' => 'Background',
                "dependency" => Array('element' => "bgstyle", 'value' => array('customized')),
                "description" => __("Default is transparent.", 'cq_allinone_vc')
              )

              ),
            )
        );


        add_shortcode('cq_vc_diamondgrid', array($this,'cq_vc_diamondgrid_func'));
        add_shortcode('cq_vc_diamondgrid_item', array($this,'cq_vc_diamondgrid_item_func'));

      }

      function cq_vc_diamondgrid_func($atts, $content=null) {
        $css_class =  $gridsize = $extraclass = '';
        $tooltipposition = "";
        extract(shortcode_atts(array(
          "gridsize" => "small",
          "itembgcolor" => "",
          "tooltipposition" => "top",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $output = "";
        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_diamondgrid', $atts);
        $output .= '<div class="cq-diamondgrid-container '.$extraclass.' '.$css_class.'" data-tooltipposition="'.$tooltipposition.'" data-itembgcolor="'.$itembgcolor.'">';
        $output .= '<div class="cq-diamondgrid">';
        $output .= '<ul class="cq-diamondgrid-ul cq-diamondgrid-'.$gridsize.'">';
        // $output .= $content;
        $output .= do_shortcode($content);
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }


      function cq_vc_diamondgrid_item_func($atts, $content=null, $tag) {
          $output = $hovericon = $image = $imagesize = $videowidth = $isresize = $tooltip =  $backgroundcolor = $backgroundhovercolor = $itembgcolor = $iconcolor = $iconhovercolor =  $linktype = $css = $custom_url = $lightbox_url = $bgstyle = $tooltipanimation = "";
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_monosocial = $icon_material = "";
          // if(version_compare(WPB_VC_VERSION,  "4.6") >= 0){
              // var_dump($tag, $atts);
              // $atts = vc_map_get_attributes($tag, $atts);
              // extract($atts);
          // }else{
            extract(shortcode_atts(array(
              "hovericon" => "fontawesome",
              "image" => "",
              "imagesize" => "",
              "isresize" => "no",
              "iscaption" => "",
              "linktarget" => "",
              "custom_url" => "",
              "tooltip" => "",
              "bgstyle" => "aqua",
              "backgroundcolor" => "",
              "backgroundhovercolor" => "",
              "itembgcolor" => "",
              "icon_fontawesome" => "fa fa-heart",
              "icon_openiconic" => "vc-oi vc-oi-dial",
              "icon_typicons" => "typcn typcn-adjust-brightness",
              "icon_entypo" => "entypo-icon entypo-icon-note",
              "icon_linecons" => "vc_li vc_li-heart",
              "icon_material" => "vc-material vc-material-cake",
              "icon_pixelicons" => "",
              "icon_monosocial" => "",
              "iconcolor" => "",
              "iconhovercolor" => "",
              // "isgallery" => "",
              "lightboxmargin" => "",
              "linktype" => "",
              "lightboxmode" => "boxer",
              "lightbox_url" => "",
              "videowidth" => "640",
              "tooltipanimation" => "grow",
              "css" => ""
            ), $atts));

          vc_icon_element_fonts_enqueue($hovericon);
          // $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          // $content = str_replace("<p></p>", "", $content);

          $img = $thumbnail = "";

          $fullimage = wp_get_attachment_image_src($image, 'full');

          if($isresize=="yes"&&$imagesize!=""){
              if(function_exists('wpb_resize')){
                  $img = wpb_resize($image, null, $imagesize, null);
                  $thumbnail = $img['url'];
                  if($thumbnail=="") $thumbnail = $fullimage[0];
              }else{
                  $thumbnail = $fullimage[0];
              }
          }else{
              $thumbnail = $fullimage[0];
          }

          // if(!isset($thumbnail)) $thumbnail = "";

          $custom_url = vc_build_link($custom_url);

          $color_style_arr = array("grapefruit" => array("#ED5565", "#DA4453"), "bittersweet" => array("#FC6E51", "#E9573F"), "sunflower" => array("#FFCE54", "#F6BB42"), "grass" => array("#A0D468", "#8CC152"), "mint" => array("#48CFAD", "#37BC9B"), "aqua" => array("#4FC1E9", "#3BAFDA"), "bluejeans" => array("#5D9CEC", "#4A89DC"), "lavender" => array("#AC92EC", "#967ADC"), "pinkrose" => array("#EC87C0", "#D770AD"), "lightgray" => array("#F5F7FA", "#E6E9ED"), "mediumgray" => array("#CCD1D9", "#AAB2BD"), "darkgray" => array("#656D78", "#434A54"), "customized" => array("$backgroundcolor", "$backgroundhovercolor") );

          $bgstyle_arr = $color_style_arr[$bgstyle];


          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');

          wp_register_style('formstone-lightbox', plugins_url('../videocover/css/lightbox.css', __FILE__));
          wp_enqueue_style('formstone-lightbox');
          wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');
          wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');

          wp_register_style('prettyphoto', vc_asset_url( 'lib/prettyphoto/css/prettyPhoto.min.css' ), array(), WPB_VC_VERSION );
          wp_enqueue_style('prettyphoto');

          wp_register_style( 'vc-extensions-diamondgrid-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-diamondgrid-style' );

          wp_register_script('formstone-lightbox', plugins_url('../videocover/js/lightbox.js', __FILE__));
          wp_enqueue_script('formstone-lightbox');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_script('prettyphoto', vc_asset_url( 'lib/prettyphoto/js/prettyPhoto.min.js' ), array(), WPB_VC_VERSION );
          wp_enqueue_script('prettyphoto');

          wp_register_script('vc-extensions-diamondgrid-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "tooltipster", "fs.boxer", "formstone-lightbox", "prettyphoto"));
          wp_enqueue_script('vc-extensions-diamondgrid-script');

          // $gallery_rand_id = "prettyPhoto[rel-". get_the_ID() . '-' . rand() . "]";
          $gallery_rand_id = "prettyPhoto";

          $output = '';
          $output .= '<li class="cq-diamondgrid-itemcontainer" title="'.esc_html($tooltip).'" data-iconcolor="'.$iconcolor.'" data-iconhovercolor="'.$iconhovercolor.'" data-backgroundcolor="'.$bgstyle_arr[0].'" data-backgroundhovercolor="'.$bgstyle_arr[1].'" data-lightboxmode="'.$lightboxmode.'" data-tooltipanimation="'.$tooltipanimation.'">';
          if($linktype=="lightbox"){
              if($iscaption=="yes"){
                  if($lightboxmode=="prettyphoto"){
                      $output .= '<a href="'.$fullimage[0].'" data-rel="'.$gallery_rand_id.'" class="cq-diamondgrid-link cq-diamondgrid-prettyphoto" title="'.esc_html($tooltip).'" rel="'.$gallery_rand_id.'" data-linktype="'.$linktype.'">';
                  }else{
                      $output .= '<a href="'.$fullimage[0].'" class="cq-diamondgrid-link cq-diamondgrid-lightbox" title="'.esc_html($tooltip).'" data-linktype="'.$linktype.'">';
                  }
              }else{
                  if($lightboxmode=="prettyphoto"){
                        $output .= '<a href="'.$fullimage[0].'" data-rel="'.$gallery_rand_id.'" class="cq-diamondgrid-link cq-diamondgrid-prettyphoto" rel="'.$gallery_rand_id.'" data-linktype="'.$linktype.'">';
                  }else{
                        $output .= '<a href="'.$fullimage[0].'" class="cq-diamondgrid-link cq-diamondgrid-lightbox" data-linktype="'.$linktype.'">';
                   }
              }
          }else if($linktype=="lightbox_custom"){
              if(isset($lightbox_url)){
                  $output .= '<a href="'.$lightbox_url.'" class="cq-diamondgrid-link cq-diamondgrid-lightbox" data-linktype="'.$linktype.'" data-videowidth="'.$videowidth.'">';
              }
          }else if($linktype=="url_custom"){
              if(isset($custom_url['url'])){
                  $output .= '<a href="'.$custom_url['url'].'" class="cq-diamondgrid-link" title="'.$custom_url["title"].'" target="'.$custom_url["target"].'">';
              }
          }


          if(isset($thumbnail)){
              $output .= '<div class="cq-diamondgrid-item" data-image="'.$thumbnail.'"></div>';
          }else{
              $output .= '<div class="cq-diamondgrid-item"></div>';
          }
          if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $hovericon})){
              $output .= '<i class="cq-diamondgrid-icon '.esc_attr(${'icon_' . $hovericon}).'"></i>';
          }

          if($linktype=="lightbox" || $linktype=="lightbox_custom" || $linktype=="url_custom"){
            $output .= '</a>';
          }
          $output .= '</li>';
          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_diamondgrid')) {
    class WPBakeryShortCode_cq_vc_diamondgrid extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_diamondgrid_item')) {
    class WPBakeryShortCode_cq_vc_diamondgrid_item extends WPBakeryShortCode {
    }
}

?>
