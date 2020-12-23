<?php
if (!class_exists('VC_Extensions_DAGallery')) {
    class VC_Extensions_DAGallery {
        function __construct() {
          vc_map( array(
            "name" => __("DA Gallery", 'vc_dagallery_cq'),
            "base" => "cq_vc_dagallery",
            "class" => "wpb_cq_vc_extension_dagallery",
            "controls" => "full",
            "icon" => "cq_allinone_dagallery",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __( 'Direction-aware gallery', 'js_composer' ),
            // 'admin_enqueue_css' => array(plugins_url('css/vc_extensions_cq_admin.css', __FILE__)),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Images", "vc_dagallery_cq"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "vc_dagallery_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Gallery width", "vc_dagallery_cq"),
                "param_name" => "gallerywidth",
                "value" => __("80%", 'vc_dagallery_cq'),
                "description" => __("Set the gallery width here, a percent value(responsive) or a fixed width like 800px", "vc_dagallery_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Thumbnail width", "vc_dagallery_cq"),
                "param_name" => "width",
                "value" => __("240", 'vc_dagallery_cq'),
                "description" => __("", "vc_dagallery_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Thumbnail height", "vc_dagallery_cq"),
                "param_name" => "height",
                "value" => __("180", 'vc_dagallery_cq'),
                "description" => __("", "vc_dagallery_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Thumbnail magin", "vc_dagallery_cq"),
                "param_name" => "margin",
                "value" => "5px",
                "description" => __("Each thumbnail margin, default is 5px", "vc_dagallery_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_dagallery_cq",
                "heading" => __("Thumbnail title", 'vc_dagallery_cq'),
                "param_name" => "thumbtitle",
                "value" => __("Thumbnail title", 'vc_dagallery_cq'),
                "description" => __("Enter title for each thumbnail here. Divide each with linebreaks (Enter).", 'vc_dagallery_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_dagallery_cq",
                "heading" => __("Thumbnail description", 'vc_dagallery_cq'),
                "param_name" => "thumbdesc",
                "value" => __("Thumbnail description", 'vc_dagallery_cq'),
                "description" => __("Enter description for each thumbnail here. Divide each with linebreaks (Enter).", 'vc_dagallery_cq')
              ),
              array(
                "type" => "colorpicker",
                "heading" => __("Caption text color", "vc_dagallery_cq"),
                "param_name" => "color",
                "value" => "#FFFFFF",
                "description" => __("Select color for the caption", "vc_dagallery_cq")
              ),
              array(
                "type" => "colorpicker",
                "heading" => __("Caption background color", "vc_dagallery_cq"),
                "param_name" => "background",
                "value" => "#00BFFF",
                "description" => __("Select color for the caption background", "vc_dagallery_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Caption background opacity", "vc_dagallery_cq"),
                "param_name" => "opacity",
                "value" => "0.8",
                "description" => __("", "vc_dagallery_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Caption padding", "vc_dagallery_cq"),
                "param_name" => "padding",
                "value" => "20px",
                "description" => __("Caption padding, default is 20px", "vc_dagallery_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_dagallery_cq",
                "heading" => __("On click", "vc_dagallery_cq"),
                "param_name" => "onclick",
                "value" => array(__("open large image (lightbox)", "vc_dagallery_cq") => "link_image", __("Open custom link", "vc_dagallery_cq") => "custom_link", __("Do nothing", "vc_dagallery_cq") => "link_no"),
                "description" => __("Define action for onclick event if needed.", "vc_dagallery_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "heading" => __("Custom links", "vc_dagallery_cq"),
                "param_name" => "custom_links",
                "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', 'vc_dagallery_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
              ),
              array(
                "type" => "dropdown",
                "heading" => __("Custom link target", "vc_dagallery_cq"),
                "param_name" => "custom_links_target",
                "description" => __('Select where to open  custom links.', 'vc_dagallery_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
                'value' => array(__("Same window", "vc_dagallery_cq") => "_self", __("New window", "vc_dagallery_cq") => "_blank")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_dagallery_cq",
                "heading" => __("Make the thumbnails retina?", 'vc_dagallery_cq'),
                "param_name" => "retina",
                "value" => array(__("Yes", "vc_dagallery_cq") => 'on'),
                "description" => __("For example a 640x480 thumbnail will display as 320x240 in retina mode.", 'vc_dagallery_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the thumbnail", "vc_dagallery_cq"),
                "param_name" => "thumb_class",
                "description" => __("You can append extra class to the thumbnail (li tag here).", "vc_dagallery_cq")
              )
            )

        ));

        vc_map( array(
            "name" => __("Fluidbox", 'vc_fluidbox_cq'),
            "base" => "cq_vc_fluidbox",
            "class" => "wpb_cq_vc_extension_fluidbox",
            "controls" => "full",
            "icon" => "cq_allinone_fluidbox",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('Image with smooth lightbox', 'js_composer' ),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __('Background Image', 'vc_fluidbox_cq'),
                "param_name" => "fluidimage",
                "description" => __("Select an image", "vc_fluidbox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Thumbnail width", "vc_fluidbox_cq"),
                "param_name" => "thumbwidth",
                "value" => __("240", 'vc_fluidbox_cq'),
                "description" => __("", "vc_fluidbox_cq")
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Image float:", "vc_fluidbox_cq"),
                  "param_name" => "float",
                  "description" => __('', 'vc_fluidbox_cq'),
                  "value" => array(__("none", "vc_fluidbox_cq") => 'none', __("left", "vc_fluidbox_cq") => 'left', __("right", "vc_fluidbox_cq") => 'right')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Margin", "vc_fluidbox_cq"),
                "param_name" => "margin",
                "value" => __("0 12px 0 12px", 'vc_fluidbox_cq'),
                "description" => __("The CSS margin value of the image, use it to control the image's position related to float.", "vc_fluidbox_cq")
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("z-index", "vc_fluidbox_cq"),
              //   "param_name" => "zindex",
              //   "value" => __("10", 'vc_fluidbox_cq'),
              //   "description" => __("The z-index of the image.", "vc_fluidbox_cq")
              // ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_fluidbox_cq",
                "heading" => __("Make the thumbnails retina?", 'vc_fluidbox_cq'),
                "param_name" => "retina",
                "value" => array(__("Yes", "vc_fluidbox_cq") => 'on'),
                "description" => __("For example a 640x480 thumbnail will display as 320x240 in retina mode.", 'vc_fluidbox_cq')
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Text", "vc_fluidbox_cq"),
                "param_name" => "content",
                "value" => __("<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>", "vc_fluidbox_cq")
              )
            )
        ));

          add_shortcode('cq_vc_dagallery', array($this,'cq_vc_dagallery_func'));
          add_shortcode('cq_vc_fluidbox', array($this,'cq_vc_fluidbox_func'));
      }

      function cq_vc_dagallery_func($atts, $content=null, $tag) {
          extract( shortcode_atts( array(
            'images' => '',
            'thumbtitle' => '',
            'thumbdesc' => '',
            'gallerywidth' => '80%',
            'width' => '240',
            'height' => '168',
            'color' => '#FFFFFF',
            'background' => '#00BFFF',
            'opacity' => '0.8',
            'padding' => '20px',
            'margin' => '5px',
            'thumb_class' => '',
            'retina' => 'off',
            'onclick' => 'link_image',
            'custom_links' => '',
            'custom_links_target' => '_self'
            // 'content' => ''
          ), $atts ) );

          // wp_register_script('prefixfree', plugins_url('js/prefixfree.js', __FILE__), array('jquery'));
          // wp_enqueue_script('prefixfree');
          wp_register_style( 'dagallery_style', plugins_url('css/style.min.css', __FILE__) );
          wp_enqueue_style( 'dagallery_style' );


          // if($onclick=='link_image'){
            wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
            wp_enqueue_script('fs.boxer');
            wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
            wp_enqueue_style('fs.boxer');
          // }else if($onclick=="custom_link"){
            $custom_links = explode( ',', $custom_links);
          // }

          wp_register_script('dagallery', plugins_url('js/jquery.gallery.min.js', __FILE__), array('jquery', 'fs.boxer'));
          wp_enqueue_script('dagallery');

          $imagesarr = explode(',', $images);
          $thumbtitles = explode( ',', $thumbtitle);
          $thumbdescs = explode( ',', $thumbdesc);



          global $post;
          $gallery_id = $post->ID.rand(0, 100);


          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $link_start = '';
          $output = '';
          $output .= '<div class="cq-dagallery-container" style="width:'.$gallerywidth.';margin:0 auto;">';
          $output .= '<ul class="cq-dagallery" data-gallerywidth="'.$gallerywidth.'" data-width="'.$width.'" data-height="'.$height.'" data-color="'.$color.'" data-background="'.$background.'" data-opacity="'.$opacity.'">';
          $i = -1;
          foreach ($imagesarr as $key => $value) {
              $i++;
              if($i<count($thumbtitles)){
                $thumb_title = $thumbtitles[$i];
              }else{
                $thumb_title = '';
              }
              if($i<count($thumbdescs)){
                $thumb_desc = $thumbdescs[$i];
              }else{
                $thumb_desc = '';
              }

              if(wp_get_attachment_image_src(trim($value), 'full')){
                $attachment = get_post($value);
                $return_img_arr = wp_get_attachment_image_src(trim($value), 'full');
                // $resized_img = aq_resize($return_img_arr[0], $retina=="on"?$width*2:$width, $retina=="on"?$height*2:$height, true, false);
                // if($resized_img[0]=="") $resized_img[0] = plugins_url('img/thumb.png', __FILE__);
                $img = $thumbnail = "";

                $fullimage = $return_img_arr[0];
                $thumbnail = $fullimage;
                if($width!=""){
                    if(function_exists('wpb_resize')){
                        $img = wpb_resize($value, null, $retina=="on"?$width*2:$width, $retina=="on"?$height*2:$height);
                        $thumbnail = $img['url'];
                        if($thumbnail=="") $thumbnail = $fullimage;
                    }
                }

                $output .= '<li class="'.$thumb_class.'" data-width="'.$width.'" data-height="'.$height.'" data-margin="'.$margin.'" style="margin:'.$margin.'">';
                // $output .= '<a class="normal" href="'.$return_img_arr[0].'" rel="'.$gallery_id.'">';
                if($onclick=='link_image'){
                  $output .= '<a class="normal" href="'.$return_img_arr[0].'" rel="'.$gallery_id.'">';
                }else if($onclick=='custom_link'){
                  if($i<count($custom_links)){
                    $output .= "<a href='".$custom_links[$i]."' target='".$custom_links_target."'>";
                  }
                }else{
                  $link_start .= "<a href='#'>";
                }

                $output .= "<img src='".$thumbnail."' width='".$width."' height='".$height."' alt='".get_post_meta($attachment->ID, "_wp_attachment_image_alt", true )."' />";
                $output .= '</a>';
                $output .= '<div class="dagallery-info" style="padding:'.$padding.';color:'.$color.';background-color:'.$background.'">';
                if($thumb_title!="") $output .= "<h3>".$thumb_title."</h3>";
                if($thumb_desc!="") $output .= "<p>".$thumb_desc."</p>";
                $output .= '';
                $output .= '';
                $output .= '</div>';
                $output .= '</li>';
              }
          }

          $output .= '</ul>';
          $output .= '</div>';
          return $output;

        }

        function cq_vc_fluidbox_func($atts, $content=null) {
          extract( shortcode_atts( array(
            'fluidimage' => '',
            'thumbwidth' => '240',
            'float' => 'none',
            // 'zindex' => '10',
            'retina' => 'off',
            'margin' => '0 12px 0 12px'
          ), $atts ) );

          wp_register_script('fluidbox', plugins_url('../mediumgallery/js/jquery.fluidbox.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fluidbox');
          wp_enqueue_script('fluidbox_init', plugins_url('js/fluidbox_init.js', __FILE__), array('jquery'));
          wp_register_style( 'fluidbox', plugins_url('../mediumgallery/css/fluidbox.min.css', __FILE__) );
          wp_enqueue_style( 'fluidbox' );

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';
          $fluid_image_attachment = get_post($fluidimage);
          $fluid_image = wp_get_attachment_image_src($fluidimage, 'full');
          $img = $thumbnail = "";

          $fullimage = $fluid_image[0];
          $thumbnail = $fullimage;
          if($thumbwidth!=""){
              if(function_exists('wpb_resize')){
                  $img = wpb_resize($fluidimage, null, $retina=="on"?$thumbwidth*2:$thumbwidth, null);
                  $thumbnail = $img['url'];
                  if($thumbnail=="") $thumbnail = $fullimage;
              }
          }

          if($fluidimage==""){
            $output .= '<a href="'.plugins_url('img/blank_image.jpg', __FILE__).'" class="fluidbox-image" data-margin="'.$margin.'" data-float="'.$float.'">';
            $output .= '<img src="'.plugins_url('img/blank_image.jpg', __FILE__).'" style="float:'.$float.';margin:'.$margin.'" width="'.$thumbwidth.'" alt="'.get_post_meta($fluidimage->ID, '_wp_attachment_image_alt', true ).'" />';
          }else{
            $output .= '<a href="'.$fluid_image[0].'" class="fluidbox-image" data-margin="'.$margin.'" data-float="'.$float.'">';
            $output .= '<img src="'.$thumbnail.'" width="'.$thumbwidth.'" style="float:'.$float.';margin:'.$margin.'" alt="'.get_post_meta($fluidimage->ID, '_wp_attachment_image_alt', true ).'" />';
          }
          $output .= '</a>';
          $output .= $content;
          return $output;

        }



  }



}

?>
