<?php
if (!class_exists('VC_Extensions_StackGallery')) {

    class VC_Extensions_StackGallery{
        function __construct() {
          vc_map( array(
            "name" => __("Stack Gallery", 'vc_stackgallery_cq'),
            "base" => "cq_vc_stackgallery",
            "class" => "wpb_cq_vc_extension_stackgallery",
            "controls" => "full",
            "icon" => "cq_allinone_stackgallery",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('Gallery in stack order', 'js_composer' ),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Images", "vc_stackgallery_cq"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "vc_stackgallery_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Container background color", 'vc_extend'),
                "param_name" => "background",
                "value" => '',
                "description" => __("", 'vc_extend')
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Container background image", "vc_stackgallery_cq"),
                "param_name" => "image",
                "value" => "",
                "description" => __("Select background from media library.", "vc_stackgallery_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Background image repeat", "vc_stackgallery_cq"),
                "param_name" => "repeat",
                "value" => array(__("repeat", "vc_stackgallery_cq") => "repeat", __("no-repeat", "vc_stackgallery_cq") => "no-repeat", __("repeat-x", "vc_stackgallery_cq") => "repeat-x", __("repeat-y", "vc_stackgallery_cq") => "repeat-y"),
                "description" => __("", "vc_stackgallery_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Tooltip for each image", 'vc_stackgallery_cq'),
                "param_name" => "tooltips",
                "value" => __("Hello tooltip 1,Hello tooltip 2,Hello tooltip 3", 'vc_stackgallery_cq'),
                "description" => __("Enter tooltip for each image here. Divide each with linebreaks (Enter).", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Image width", 'vc_stackgallery_cq'),
                "param_name" => "width",
                "value" => __("320", 'vc_stackgallery_cq'),
                "description" => __("The image will be resized to this size (x2 in retina mode).", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Image height", 'vc_stackgallery_cq'),
                "param_name" => "height",
                "value" => __("240", 'vc_stackgallery_cq'),
                "description" => __("The image will be resized to this size (x2 in retina mode).", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "dropdown",
                "heading" => __("ease in", "vc_stackgallery_cq"),
                "param_name" => "easein",
                "description" => __('Select the ease in animation', 'vc_stackgallery_cq'),
                'value' => array(__("easeInBack", "vc_stackgallery_cq") => "easeInBack", __("easeInOutCubic", "vc_stackgallery_cq") => "easeInOutCubic", __("easeInCirc", "vc_stackgallery_cq") => "easeInCirc", __("easeInOutCirc", "vc_stackgallery_cq") => "easeInOutCirc", __("easeInExpo", "vc_stackgallery_cq") => "easeInExpo", __("easeInOutExpo", "vc_stackgallery_cq") => "easeInOutExpo", __("easeInQuad", "vc_stackgallery_cq") => "easeInQuad", __("easeInOutQuad", "vc_stackgallery_cq") => "easeInOutQuad", __("easeInQuart", "vc_stackgallery_cq") => "easeInQuart", __("easeInOutQuart", "vc_stackgallery_cq") => "easeInOutQuart", __("easeInQuint", "vc_stackgallery_cq") => "easeInQuint", __("easeInOutQuint", "vc_stackgallery_cq") => "easeInOutQuint", __("easeInSine", "vc_stackgallery_cq") => "easeInSine", __("easeInOutSine", "vc_stackgallery_cq") => "easeInOutSine", __("easeInOutBack", "vc_stackgallery_cq") => "easeInOutBack"),__("linear", "vc_stackgallery_cq") => "linear", __("ease", "vc_stackgallery_cq") => "ease", __("in", "vc_stackgallery_cq") => "in", __("in-out", "vc_stackgallery_cq") => "in-out", __("snap", "vc_stackgallery_cq") => "snap"),
              array(
                "type" => "dropdown",
                "heading" => __("ease out", "vc_stackgallery_cq"),
                "param_name" => "easeout",
                "description" => __('Select the ease out animation', 'vc_stackgallery_cq'),
                // "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
                'value' => array(__("easeOutCubic", "vc_stackgallery_cq") => "easeOutCubic", __("easeInOutCubic", "vc_stackgallery_cq") => "easeInOutCubic", __("easeOutCirc", "vc_stackgallery_cq") => "easeOutCirc", __("easeInOutCirc", "vc_stackgallery_cq") => "easeInOutCirc", __("easeOutExpo", "vc_stackgallery_cq") => "easeOutExpo", __("easeInOutExpo", "vc_stackgallery_cq") => "easeInOutExpo", __("easeOutQuad", "vc_stackgallery_cq") => "easeOutQuad", __("easeInOutQuad", "vc_stackgallery_cq") => "easeInOutQuad", __("easeOutQuart", "vc_stackgallery_cq") => "easeOutQuart", __("easeInOutQuart", "vc_stackgallery_cq") => "easeInOutQuart", __("easeOutQuint", "vc_stackgallery_cq") => "easeOutQuint", __("easeInOutQuint", "vc_stackgallery_cq") => "easeInOutQuint", __("easeOutSine", "vc_stackgallery_cq") => "easeOutSine", __("easeInOutSine", "vc_stackgallery_cq") => "easeInOutSine", __("easeOutBack", "vc_stackgallery_cq") => "easeOutBack", __("easeInOutBack", "vc_stackgallery_cq") => "easeInOutBack"),__("linear", "vc_stackgallery_cq") => "linear", __("ease", "vc_stackgallery_cq") => "ease", __("out", "vc_stackgallery_cq") => "out", __("in-out", "vc_stackgallery_cq") => "in-out", __("snap", "vc_stackgallery_cq") => "snap"),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Auto delay slideshow?", "vc_stackgallery_cq"),
                "param_name" => "slideshow",
                "value" => array(__("no", "vc_stackgallery_cq") => "no", __("yes", "vc_stackgallery_cq") => "yes"),
                "description" => __("", "vc_stackgallery_cq")
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Sliseshow delay", 'vc_stackgallery_cq'),
                "param_name" => "slideshowdelay",
                "value" => __("5000", 'vc_stackgallery_cq'),
                "dependency" => Array('element' => "slideshow", 'value' => array('yes')),
                "description" => __("Delay time for the slideshow, default is 5000, stand for 5 seconds.", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Do not display tooltip for the image?", 'vc_stackgallery_cq'),
                "param_name" => "notooltip",
                "value" => array(__("No tooltip, please", "vc_stackgallery_cq") => 'on'),
                "description" => __("Default you can put each tooltip for image, check this if you do not want it.", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Do not display the image in retina?", 'vc_stackgallery_cq'),
                "param_name" => "noretina",
                "value" => array(__("No retina, please", "vc_stackgallery_cq") => 'on'),
                "description" => __("Default is retina, check this if you do not want it.", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Do not display the arrow?", 'vc_stackgallery_cq'),
                "param_name" => "noarrow",
                "value" => array(__("No arrow, please", "vc_stackgallery_cq") => 'on'),
                "description" => __("Default there are arrow for the next/previous, check this if you do not want it.", 'vc_stackgallery_cq')
              ),
              // array(
              //   "type" => "checkbox",
              //   "holder" => "",
              //   "class" => "vc_stackgallery_cq",
              //   "heading" => __("Do not crop the image?", 'vc_stackgallery_cq'),
              //   "param_name" => "nocrop",
              //   "value" => array(__("No crop, please", "vc_stackgallery_cq") => 'on'),
              //   "description" => __("Default images are cropped to the height, check this if you do not want it.", 'vc_stackgallery_cq')
              // ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Container height", 'vc_stackgallery_cq'),
                "param_name" => "containerheight",
                "value" => __("", 'vc_stackgallery_cq'),
                "description" => __("Specify the container height, default is image height + 80 (leave it to blank here).", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Image border", 'vc_stackgallery_cq'),
                "param_name" => "border",
                "value" => __("", 'vc_stackgallery_cq'),
                "description" => __("Specify the image border, default is 0.", 'vc_stackgallery_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_stackgallery_cq",
                "heading" => __("Arrow color", "vc_stackgallery_cq"),
                "param_name" => "arrowcolor",
                "value" => array(__("black", "vc_stackgallery_cq") => "", __("white", "vc_stackgallery_cq") => "white"),
                "description" => __("", "vc_stackgallery_cq")
              )

            )
        ));


        add_shortcode('cq_vc_stackgallery', array($this,'cq_vc_stackgallery_func'));

      }

      function cq_vc_stackgallery_func($atts, $content = null) {
          extract( shortcode_atts( array(
            'images' => '',
            'image' => '',
            'background' => '',
            'repeat' => '',
            'tooltips' => '',
            'width' => '320',
            'height' => '240',
            'noretina' => 'off',
            // 'nocrop' => 'off',
            'notooltip' => 'off',
            'noarrow' => 'off',
            'slideshow' => 'off',
            'slideshowdelay' => 'off',
            'easein' => 'easeInBack',
            'easeout' => 'easeOutBack',
            'border' => '',
            'arrowcolor' => '',
            'containerheight' => ''
          ), $atts ) );



          wp_register_style( 'vc_stackgallery_cq_style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc_stackgallery_cq_style' );

          wp_register_script('transit', plugins_url('js/jquery.transit.min.js', __FILE__));
          wp_enqueue_script('transit');
          wp_register_script('vc_stackgallery_cq_script', plugins_url('js/jquery.stackgallery.min.js', __FILE__), array("jquery", "transit"));
          wp_enqueue_script('vc_stackgallery_cq_script');

          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');


          $imagesarr = explode(',', $images);
          $tooltiparr = explode(',', $tooltips);
          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';

          $i = count($imagesarr);
          $backgroundimage = wp_get_attachment_image_src($image, 'full');
          $output .= '<div class="cq-stackgallery" data-width="'.$width.'" data-height="'.$height.'" data-easein="'.$easein.'" data-easeout="'.$easeout.'" data-containerheight="'.$containerheight.'" data-slideshow="'.$slideshow.'" data-slideshowdelay="'.$slideshowdelay.'" data-notooltip="'.$notooltip.'" style="background:'.$background.' url('.$backgroundimage[0].') '.$repeat.'">';
          foreach ($imagesarr as $key => $value) {
              $i--;
              if(!isset($tooltiparr[$i])) $tooltiparr[$i] = '';
              $return_img_arr = wp_get_attachment_image_src(trim($imagesarr[$i]), 'full');
              $image_temp = $stackimage = "";
              $fullimage = $return_img_arr[0];
              $stackimage = $fullimage;
              $attachment = get_post($imagesarr[$i]);
              if($width!=""){
                  if(function_exists('wpb_resize')){
                      $image_temp = wpb_resize($imagesarr[$i], null, $noretina=="off"?$width*2:$width, $noretina=="off"?$height*2:$height, true);
                      $stackimage = $image_temp['url'];
                      if($stackimage=="") $stackimage = $fullimage;
                  }
              }

              $output .= '<img class="stackgallery-item" style="border: '.$border.'px solid #FFF" src="'.$stackimage.'" width="'.$width.'" height="'.$height.'" title="'.$tooltiparr[$i].'" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />';

          }
          if($noarrow!="on"){
            $output .= '<div><a href="#"><span class="'.$arrowcolor.' stackgallery-prev"></span></a></div>';
            $output .= '<div><a href="#"><span class="'.$arrowcolor.' stackgallery-next"></span></a></div>';
          }
          $output .= '</div>';
          return $output;

        }

  }

}

?>
