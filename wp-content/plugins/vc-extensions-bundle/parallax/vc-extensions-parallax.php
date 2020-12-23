<?php
if (!class_exists('VC_Extensions_Parallax')) {

    class VC_Extensions_Parallax {
        function __construct() {
          vc_map( array(
            "name" => __("Parallax", 'vc_parallax_cq'),
            "base" => "cq_vc_parallax",
            "class" => "wpb_cq_vc_extension_parallax",
            "controls" => "full",
            "icon" => "cq_allinone_parallax",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('Parallax image and text', 'js_composer' ),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Parallax Images:", "vc_parallax_cq"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "vc_parallax_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Parallax content text, divide each one with [parallaxitem][/parallaxitem], please try to edit in Text mode:", "vc_parallax_cq"),
                "param_name" => "content",
                "value" => __("[parallaxitem]You have to wrap each text block inside <strong>parallaxitem</strong>.
                You can customize the text color, background, container width etc in the backend.
                The parallax is disable in mobile, and keep all the image and text readable.
                <a href='http://codecanyon.net/user/sike?ref=sike'>Visit my profile</a> for more works. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.[/parallaxitem]
                [parallaxitem]
                <h4>Text block 2</h4>
                Ecepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. [/parallaxitem]
                [parallaxitem]
                <h4>Text block 3</h4>
                qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. [/parallaxitem]", "vc_parallax_cq"),
                "description" => __("", "vc_parallax_cq") ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Resize images to this width:", "vc_parallax_cq"),
              //   "param_name" => "imagewidth",
              //   "value" => "1280",
              //   "description" => __("Leave it to be blank if you want to use the original image.", "vc_parallax_cq")
              // ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text color", 'vc_parallax_cq'),
                "param_name" => "textcolor",
                "value" => '',
                "description" => __("", 'vc_parallax_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text background color", 'vc_parallax_cq'),
                "param_name" => "textbackground",
                "value" => '',
                "description" => __("", 'vc_parallax_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Padding of the content:", "vc_parallax_cq"),
                "param_name" => "padding",
                "value" => "2% 5%",
                "description" => __("The CSS padding for the text content, default is 2% 5%.", "vc_parallax_cq")
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Margin of thumbnails", "vc_parallax_cq"),
              //   "param_name" => "thumbmargin",
              //   "value" => "",
              //   "description" => __("The CSS margin of the thumbnails, default is 0. You can use it to customize the position of the thumbnails sometime.", "vc_parallax_cq")
              // ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_parallax_cq",
                "heading" => __("Image on click", "vc_parallax_cq"),
                "param_name" => "onclick",
                "value" => array(__("Do nothing", "vc_parallax_cq") => "link_no", __("Open custom link", "vc_parallax_cq") => "custom_link"),
                "description" => __("Define action for onclick event if needed.", "vc_parallax_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "heading" => __("Custom link for each image", "vc_parallax_cq"),
                "param_name" => "custom_links",
                "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', 'vc_parallax_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
              ),
              array(
                "type" => "dropdown",
                "heading" => __("How to open the custom link", "vc_parallax_cq"),
                "param_name" => "custom_links_target",
                "description" => __('Select how to open custom links.', 'vc_parallax_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
                'value' => array(__("Same window", "vc_parallax_cq") => "_self", __("New window", "vc_parallax_cq") => "_blank")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_parallax_cq",
                "heading" => __("Display text content first?", 'vc_parallax_cq'),
                "param_name" => "textfirst",
                "value" => array(__("Yes", "vc_parallax_cq") => 'on'),
                "description" => __("You can check this if you want to display the text content in the beginning, otherwise the image will be displayed first.", 'vc_parallax_cq')
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Width of the container", "vc_parallax_cq"),
              //   "param_name" => "containerwidth",
              //   "value" => "100%",
              //   "description" => __("The width of the whole container, default is 100%. You can specify it with a smaller value, like 80%, and it will be align center.", "vc_parallax_cq")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("The speed of the parallax effect.", "vc_parallax_cq"),
                "param_name" => "speed",
                "value" => "",
                "description" => __("A floating number between 0 and 1, where a higher number will move the images faster upwards. Default is 0.2", "vc_parallax_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Cover ratio", "vc_parallax_cq"),
                "param_name" => "coverratio",
                "value" => "",
                "description" => __("How many percent of the screen each image should cover
, default is 0.75, stand for 75% of the browser.", "vc_parallax_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("minimal height of the image", "vc_parallax_cq"),
                "param_name" => "holderminheight",
                "value" => "",
                "description" => __("The minimal height of the image in pixels. Default is 200.", "vc_parallax_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("maximum height of the image", "vc_parallax_cq"),
                "param_name" => "holdermaxheight",
                "value" => "",
                "description" => __("The maximum height of the image in pixels. Default is not set, you can use this value or the cover ratio to control the height of the image.", "vc_parallax_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra height of the image", "vc_parallax_cq"),
                "param_name" => "extraheight",
                "value" => "",
                "description" => __("Extra height added to the image. Can be useful if you want to show more of the top image. Default is 0.", "vc_parallax_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize images to this width in mobile view:", "vc_parallax_cq"),
                "param_name" => "mobilewidth",
                "value" => "640",
                "description" => __("In mobile view, the parallax is disabled, and we will embed the images in this width. Default is 640, leave it to blank if you want to use the original image.", "vc_parallax_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_parallax_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_parallax_cq")
              )

            )
        ));

        add_shortcode('cq_vc_parallax', array($this,'cq_vc_parallax_func'));

      }

      function cq_vc_parallax_func($atts, $content=null, $tag) {
          extract( shortcode_atts( array(
            'images' => '',
            'imagewidth' => '',
            'padding' => '2% 5%',
            'textfirst' => '',
            'textcolor' => '#333',
            'textbackground' => '#FFF',
            // 'containerwidth' => '',
            'mobilewidth' => '640',
            'onclick' => 'link_no',
            'speed' => '',
            'coverratio' => '',
            'holderminheight' => '',
            'holdermaxheight' => '',
            'extraheight' => '',
            'custom_links' => '',
            'custom_links_target' => '',
            'extra_class' => ''
          ), $atts ) );


          wp_register_style( 'vc_parallax_cq_style', plugins_url('css/style.css', __FILE__));
          wp_enqueue_style( 'vc_parallax_cq_style' );

          wp_register_script('modernizr', plugins_url('js/modernizr.js', __FILE__));
          wp_enqueue_script('modernizr');
          wp_register_script('imagescroll', plugins_url('js/jquery.imagescroll.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('imagescroll');
          wp_register_script('vc_parallax_cq_script', plugins_url('js/init.min.js', __FILE__), array('jquery', 'modernizr', 'imagescroll'));
          wp_enqueue_script('vc_parallax_cq_script');


          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          // $content = str_replace('</div>', '', trim($content));
          // $contentarr = explode('<div class="parallax-content">', $content);
          if(strpos($content, '[/parallaxitem]')===false){
              $content = str_replace('</div>', '', trim($content));
              $contentarr = explode('<div class="parallax-content">', trim($content));
          }else{
              $content = str_replace('[/parallaxitem]', '', trim($content));
              $contentarr = explode('[parallaxitem]', trim($content));
          }

          $imagesarr = explode(',', $images);
          $customlinkarr  = explode(',', $custom_links);
          $output = '';
          $output .= '<div class="cq-parallaxcontainer '.$extra_class.'"  data-speed="'.$speed.'" data-coverratio="'.$coverratio.'" data-holderminheight="'.$holderminheight.'" data-holdermaxheight="'.$holdermaxheight.'" data-extraheight="'.$extraheight.'" data-target="'.$custom_links_target.'">';
          $i = -1;
          $imagewidth = null;
          foreach ($imagesarr as $key => $image) {
              $i++;
              if(!isset($contentarr[$i+1])) $contentarr[$i+1] = '';
              if(!isset($customlinkarr[$i])) $customlinkarr[$i] = '';
              if(wp_get_attachment_image_src(trim($image), 'full')){
                  $return_img_arr = wp_get_attachment_image_src(trim($image), 'full');
                  // $_height = aq_resize($return_img_arr[0], $imagewidth, null, true, false, true);
                  $img = $thumbnail = "";

                  $fullimage = $return_img_arr[0];
                  $thumbnail = $fullimage;
                  if($mobilewidth!=""){
                      if(function_exists('wpb_resize')){
                          $img = wpb_resize($image, null, $mobilewidth, null);
                          $thumbnail = $img['url'];
                          // $_height = $img['height'];
                          if($thumbnail=="") $thumbnail = $fullimage;
                      }
                  }


                  if($textfirst=="on"){
                      if($contentarr[$i+1]!=""){
                          $output .= '<section class="cq-parallaxsection" style="color:'.$textcolor.';background:'.$textbackground.';padding:'.$padding.';">';
                          $output .= $contentarr[$i+1];
                          $output .= '</section>';
                      }
                      $output .= '<div class="cq-parallaximage" data-image="'.$return_img_arr[0].'" data-width="'.$return_img_arr[1].'" data-height="'.$return_img_arr[2].'" data-image-mobile="'.$thumbnail.'" data-link="'.$customlinkarr[$i].'"></div>';
                  }else{
                      $output .= '<div class="cq-parallaximage" data-image="'.$return_img_arr[0].'" data-width="'.$return_img_arr[1].'" data-height="'.$return_img_arr[2].'" data-image-mobile="'.$thumbnail.'" data-link="'.$customlinkarr[$i].'"></div>';
                      if($contentarr[$i+1]!=""){
                          $output .= '<section class="cq-parallaxsection" style="color:'.$textcolor.';background:'.$textbackground.';padding:'.$padding.';">';
                          $output .= $contentarr[$i+1];
                          $output .= '</section>';
                      }
                  }

              }
          }
          $output .= '</div>';
          return $output;

        }


  }


}

?>
