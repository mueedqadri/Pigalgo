<?php
if (!class_exists('VC_Extensions_AppMockup')) {

    class VC_Extensions_AppMockup {
        function __construct() {
          vc_map( array(
            "name" => __("App Mockup", 'vc_appmockup_cq'),
            "base" => "cq_vc_appmockup",
            "class" => "wpb_cq_vc_extension_appmockup",
            "controls" => "full",
            "icon" => "cq_allinone_appmockup",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __( '3D prototype gallery', 'js_composer' ),
            // 'admin_enqueue_css' => array(plugins_url('css/vc_extensions_cq_admin.css', __FILE__)),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Image", "vc_appmockup_cq"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "vc_appmockup_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("width", "vc_appmockup_cq"),
                "param_name" => "width",
                "value" => "240",
                "description" => __("", "vc_appmockup_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("height", "vc_appmockup_cq"),
                "param_name" => "height",
                "value" => "360",
                "description" => __("", "vc_appmockup_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("margin", "vc_appmockup_cq"),
                "param_name" => "margin",
                "value" => "20",
                "description" => __("", "vc_appmockup_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Container offset x", "vc_appmockup_cq"),
                "param_name" => "offsetx",
                "value" => "320",
                "description" => __("For example, 200 will move the whole container right for 200(px), -200 will move the whole container left for 200(px).", "vc_appmockup_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Container offset y", "vc_appmockup_cq"),
                "param_name" => "offsety",
                "value" => "200",
                "description" => __("For example, 200 will move the whole container lower for 200(px), -200 will move the whole container upper for 200(px).", "vc_appmockup_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_appmockup_cq",
                "heading" => __("rotateZ (deg) for the image 3D transform:", "vc_appmockup_cq"),
                "param_name" => "imagedirection",
                "value" => array(__("50", "vc_appmockup_cq") => "50", __("-50", "vc_appmockup_cq") => "-50"),
                "description" => __("Choose how to display the images.", "vc_appmockup_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_appmockup_cq",
                "heading" => __("Tooltip", 'vc_appmockup_cq'),
                "param_name" => "tooltip",
                "value" => __("", 'vc_appmockup_cq'),
                "description" => __("Enter tooltip title for each image here, divide each with linebreaks (Enter).", 'vc_appmockup_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip offset x", "vc_appmockup_cq"),
                "param_name" => "tooltipoffsetx",
                "value" => "0",
                "description" => __("", "vc_appmockup_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip offset y", "vc_appmockup_cq"),
                "param_name" => "tooltipoffsety",
                "value" => "0",
                "description" => __("", "vc_appmockup_cq")
              ),
              array(
                "type" => "dropdown",
                "heading" => __("On clcik", "vc_appmockup_cq"),
                "param_name" => "onclick",
                "description" => __('Select how to open icon links.', 'vc_appmockup_cq'),
                "value" => array(__("open large image (lightbox)", "vc_appmockup_cq") => "link_image", __("Do nothing", "vc_appmockup_cq") => "link_no", __("Open custom link", "vc_appmockup_cq") => "custom_link")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_appmockup_cq",
                "heading" => __("Custom links", 'vc_appmockup_cq'),
                "param_name" => "custom_links",
                "value" => __("", 'vc_appmockup_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
                "description" => __("Enter links for each slide here. Divide links with linebreaks (Enter).", 'vc_appmockup_cq')
              ),
              array(
                "type" => "dropdown",
                "heading" => __("Custom link target", "vc_appmockup_cq"),
                "param_name" => "custom_links_target",
                "description" => __('Select how to open icon links.', 'vc_appmockup_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
                'value' => array(__("Same window", "vc_appmockup_cq") => "_self", __("New window", "vc_appmockup_cq") => "_blank")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_appmockup_cq",
                "heading" => __("Transform each image instead of whole cotainer?", 'vc_appmockup_cq'),
                "param_name" => "transformimage",
                "value" => array(__("Yes.", "vc_appmockup_cq") => 'on'),
                "description" => __("The whole container is transformed to a 3D card view by default, but sometime you want to transform each image instead, which is responsive in small screen view.", 'vc_appmockup_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_appmockup_cq",
                "heading" => __("Do not display the image in retina?", 'vc_appmockup_cq'),
                "param_name" => "retina",
                "value" => array(__("Display in normal resolution.", "vc_appmockup_cq") => 'off'),
                "description" => __("For example a 640x480 thumbnail will display as 320x240 in retina mode by default, check this if you don't want this feature.", 'vc_appmockup_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_appmockup_cq",
                "heading" => __("Do not display the images in 3D?", 'vc_appmockup_cq'),
                "param_name" => "is2d",
                "value" => array(__("Display them in 2D", "vc_appmockup_cq") => 'on'),
                "description" => __("Check this if you only want to display the images in normal 2D grid.", 'vc_appmockup_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_appmockup_cq",
                "heading" => __("Put the images in a gradient background?", 'vc_appmockup_cq'),
                "param_name" => "isbackground",
                "value" => array(__("Yes", "vc_appmockup_cq") => 'on', __("No", "vc_appmockup_cq") => 'off'),
                "description" => __("You can check to display the images in a container, and set the height of the container below.", 'vc_appmockup_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Gradient background container height:", "vc_appmockup_cq"),
                "param_name" => "bgheight",
                "value" => "500",
                "dependency" => Array('element' => "isbackground", 'value' => array('on')),
                "description" => __("This background container will hiden the overflow.", "vc_appmockup_cq")
              )

            )

        ));

        add_shortcode('cq_vc_appmockup', array($this,'cq_vc_appmockup_func'));
      }

      function cq_vc_appmockup_func($atts, $content=null) {
          extract( shortcode_atts( array(
            'images' => '',
            'width' => '240',
            'height' => '168',
            'margin' => '20',
            'offsetx' => '320',
            'offsety' => '200',
            'imagedirection' => '50',
            'tooltip' => '',
            'tooltipoffsetx' => '',
            'tooltipoffsety' => '',
            'is2d' => 'off',
            'isbackground' => 'off',
            'bgheight' => '500',
            'transformimage' => 'off',
            'onclick' => 'link_image',
            'iconvisible' => 'off',
            'retina' => 'on',
            'custom_links' => '',
            'custom_links_target' => '_self'
            // 'content' => ''
          ), $atts ) );


          wp_register_style( 'vc_appmockup_cq_style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc_appmockup_cq_style' );
          wp_register_script('vc_appmockup_cq_script', plugins_url('js/jquery.appmockup.min.js', __FILE__), array('jquery', 'tooltipster'));
          wp_enqueue_script('vc_appmockup_cq_script');
          // wp_register_script('prefixfree', plugins_url('js/prefixfree.min.js', __FILE__), array('jquery'));
          // wp_enqueue_script('prefixfree');
          wp_register_style('tooltipster', plugins_url('css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_style('fs.boxer', plugins_url('css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');

          // wp_register_script('appmockup_script', plugins_url('js/script.min.js', __FILE__), array('jquery'));
          // wp_enqueue_script('appmockup_script');
          // wp_register_style( 'font-awesome', plugins_url('css/font-awesome.min.css', __FILE__) );
          // wp_enqueue_style( 'font-awesome' );
          wp_register_script('tooltipster', plugins_url('js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');
          wp_register_script('fs.boxer', plugins_url('js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

          $imagesarr = explode(',', $images);
          $tooltiparr = explode(',', $tooltip);

          global $post;
          $gallery_id = $post->ID.rand(0, 100);

          $custom_links = explode( ',', $custom_links);
          $imagedirection = $imagedirection == '50' ? 'l2r' : 'r2l';

          $output = '';
          $output .= '<div class="appmockup-outside-container">';
          $output .= '<div class="appmockup-grid-container" data-width="'.$width.'" data-height="'.$height.'" data-margin="'.$margin.'" data-offsetx="'.$offsetx.'" data-offsety="'.$offsety.'" data-imagedirection="'.$imagedirection.'" data-tooltipoffsetx="'.$tooltipoffsetx.'" data-tooltipoffsety="'.$tooltipoffsety.'" data-is2d="'.$is2d.'" data-isbackground="'.$isbackground.'" data-bgheight="'.$bgheight.'" data-retina="'.$retina.'" data-transformimage="'.$transformimage.'">';
          $output .= '<ul class="appmockup-grid">';

          $link_start = '';
          $link_end = '';

          foreach ($imagesarr as $key => $image_url) {
              $link_start = '';
              $link_end = '';
              if(!isset($tooltiparr[$key])){
                $tooltip = "";
              }else{
                $tooltip = $tooltiparr[$key];
              }
              // $tooltip = $tooltip == ""?"":$tooltip;
              $return_img_arr = wp_get_attachment_image_src(trim($image_url), 'full');
              // $resized_img = aq_resize($return_img_arr[0], $retina=="on"?$width*2:$width, $retina=="on"?$height*2:$height, true, false, true);
              $img = $resized_img = "";

              $fullimage = $return_img_arr[0];
              $resized_img = $fullimage;
              if($width!=""){
                  if(function_exists('wpb_resize')){
                      $img = wpb_resize($image_url, null, $retina=="on"?$width*2:$width, $retina=="on"?$height*2:$height);
                      $resized_img = $img['url'];
                      if($resized_img=="") $resized_img = $fullimage;
                  }
              }


              if($onclick=="link_image"){
                $link_start .= '<a href="'.$return_img_arr[0].'" class="appmockup-lightbox">';
                $link_end .= '</a>';
              }else if($onclick=="custom_link"){
                // $custom_link = $custom_links[$key] == ""?"#":$custom_links[$key];
                if(!isset($custom_links[$key])){
                  $custom_link = "";
                }else{
                  $custom_link = $custom_links[$key];
                }

                if($custom_link != ""){
                  $link_start .= '<a href="'.$custom_link.'" target="'.$custom_links_target.'">';
                  $link_end .= '</a>';
                }
              }else{
                $link_start .= '';
                $link_end .= '';
              }
              $output .= $link_start;
              $output .= '<li class="'.$imagedirection.'" data-image="'.$resized_img.'" data-title="'.$tooltip.'">';
              $output .= '<span class="appmockup-shadow"></span>';
              $output .= '</li>';
              $output .= $link_end;
              // $output .= '</a>';
          }
          $output .= '</ul>';
          $output .= '</div>';
          $output .= '</div>';

          return $output;

        }


  }

}

?>
