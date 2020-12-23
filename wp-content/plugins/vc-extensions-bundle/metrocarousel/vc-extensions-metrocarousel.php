<?php
if (!class_exists('VC_Extensions_MetroCarousel')) {

    class VC_Extensions_MetroCarousel {
        function __construct() {
          vc_map(array(
            "name" => __("Metro Carousel and Tile", 'vc_metrocarousel_cq'),
            "base" => "cq_vc_metrocarousel",
            "class" => "wpb_cq_vc_extension_metrocarousel",
            "controls" => "full",
            "icon" => "cq_allinone_metrocarousel",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('with slideshow', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Display the image(s) in:", "vc_metrocarousel_cq"),
                "param_name" => "displaystyle",
                "value" => array(__("carousel (with the button and arrow navigation)", "vc_metrocarousel_cq") => "carousel", __("tiles (autoplay slideshow without buttons)", "vc_metrocarousel_cq") => "tiles"),
                "description" => __("", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "attach_images",
                "heading" => __("Image(s):", "vc_metrocarousel_cq"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Thumbnail on click", "vc_metrocarousel_cq"),
                "param_name" => "onclick",
                "value" => array(__("Open lightbox", "vc_metrocarousel_cq") => "lightbox", __("Do nothing", "vc_metrocarousel_cq") => "", __("Open custom link", "vc_metrocarousel_cq") => "customlink"),
                "description" => __("", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Custom link for each thumbnail", 'vc_metrocarousel_cq'),
                "param_name" => "customlinks",
                "value" => __("", 'vc_metrocarousel_cq'),
                "description" => __("Divide with linebreak (Enter), available with open custom link option.", 'vc_metrocarousel_cq')
              ),
              array(
                "type" => "dropdown",
                "heading" => __("Custom link target", "vc_metrocarousel_cq"),
                "param_name" => "customlinktarget",
                "description" => __('Choose how to open custom link.', 'vc_metrocarousel_cq'),
                'value' => array(__("Same window", "vc_metrocarousel_cq") => "_self", __("New window", "vc_metrocarousel_cq") => "_blank")
              ),
              array(
                "type" => "textarea",
                "heading" => __("Optional caption for the tile:", "vc_metrocarousel_cq"),
                "param_name" => "tilecaption",
                "value" => "This is the default tile caption",
                "dependency" => Array('element' => "displaystyle", 'value' => array('tiles')),
                "description" => __("Leave it to be blank if you don't want it.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Slide effect:", "vc_metrocarousel_cq"),
                "param_name" => "slideeffect",
                "value" => array(__("slideLeft", "vc_metrocarousel_cq") => "slideLeft", __("slideRight", "vc_metrocarousel_cq") => "slideRight", __("slideLeftRight", "vc_metrocarousel_cq") => "slideLeftRight", __("slideUp", "vc_metrocarousel_cq") => "slideUp", __("slideDown", "vc_metrocarousel_cq") => "slideDown", __("slideUpDown", "vc_metrocarousel_cq") => "slideUpDown"),
                "dependency" => Array('element' => "displaystyle", 'value' => array('tiles')),
                "description" => __("Choose how to move the thumbnails.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tile height", "vc_metrocarousel_cq"),
                "param_name" => "tileheight",
                "value" => "300",
                "dependency" => Array('element' => "displaystyle", 'value' => array('tiles')),
                "description" => __("", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("When tile width is smaller than this width:", "vc_metrocarousel_cq"),
                "param_name" => "mintilewidth",
                "value" => "320",
                "dependency" => Array('element' => "displaystyle", 'value' => array('tiles')),
                "description" => __("<span style='font-style:normal'>↓</span> The tile maybe too high when it is in is a small width, you can use this to trigger the responsive feature. You can set it to a very small (like 10) value if you don't want this feature.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Update the tile to this height:", "vc_metrocarousel_cq"),
                "param_name" => "mintileheight",
                "value" => "200",
                "dependency" => Array('element' => "displaystyle", 'value' => array('tiles')),
                "description" => __("Tile will change to this height when it's width is smaller than the value above.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Autoplay speed in milliseconds for the tile", "vc_metrocarousel_cq"),
                "param_name" => "tileautoplayspeed",
                "value" => "4000",
                "dependency" => Array('element' => "displaystyle", 'value' => array('tiles')),
                "description" => __("The speed of the auto delay slideshow, default is 4000, which stand for 4 seconds.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Carousel height", "vc_metrocarousel_cq"),
                "param_name" => "carouselheight",
                "value" => "300",
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("Height of the whole carousel.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Navigation button position:", "vc_metrocarousel_cq"),
                "param_name" => "position",
                "value" => array(__("bottom-left", "vc_metrocarousel_cq") => "bottom-left", __("bottom-center", "vc_metrocarousel_cq") => "bottom-center", __("bottom-right", "vc_metrocarousel_cq") => "bottom-right", __("top-left", "vc_metrocarousel_cq") => "top-left", __("top-center", "vc_metrocarousel_cq") => "top-center", __("top-right", "vc_metrocarousel_cq") => "top-right"),
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("Choose where to display the buttons.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Navigation button type:", "vc_metrocarousel_cq"),
                "param_name" => "buttontype",
                "value" => array(__("default", "vc_metrocarousel_cq") => "default", __("cycle", "vc_metrocarousel_cq") => "cycle", __("square", "vc_metrocarousel_cq") => "square"),
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("Choose the buttons style.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Slide animation:", "vc_metrocarousel_cq"),
                "param_name" => "animation",
                "value" => array(__("slide", "vc_metrocarousel_cq") => "slide", __("fade", "vc_metrocarousel_cq") => "fade", __("switch", "vc_metrocarousel_cq") => "switch", __("slowdown", "vc_metrocarousel_cq") => "slowdown"),
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("Choose the animation of changing thumbnails.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Active button color:", "vc_metrocarousel_cq"),
                "param_name" => "buttoncolor",
                "value" => array(__("lime", "vc_metrocarousel_cq") => "fg-lime", __("green", "vc_metrocarousel_cq") => "fg-green", __("blue", "vc_metrocarousel_cq") => "fg-blue", __("pink", "vc_metrocarousel_cq") => "fg-pink", __("red", "vc_metrocarousel_cq") => "fg-red", __("lighterBlue", "vc_metrocarousel_cq") => "fg-lighterBlue", __("lightTeal", "vc_metrocarousel_cq") => "fg-lightTeal", __("lightOlive", "vc_metrocarousel_cq") => "fg-lightOlive", __("lightOrange", "vc_metrocarousel_cq") => "fg-lightOrange", __("lightPink", "vc_metrocarousel_cq") => "fg-lightPink", __("lightRed", "vc_metrocarousel_cq") => "fg-lightRed", __("lightGreen", "vc_metrocarousel_cq") => "fg-lightGreen"),
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("Choose the active color of the current button.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("When carousel width is smaller than this width:", "vc_metrocarousel_cq"),
                "param_name" => "mincarouselwidth",
                "value" => "450",
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("<span style='font-style:normal'>↓</span> The carousel maybe too high when it is in is a small width, you can use this to trigger the responsive feature. You can set it to a very small (like 10) value if you don't want this feature.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Update the carousel to this height:", "vc_metrocarousel_cq"),
                "param_name" => "mincarouselheight",
                "value" => "200",
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("Carousel will change to this height when it's width is smaller than the value above.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Do not show the arrow navigation?", 'vc_metrocarousel_cq'),
                "param_name" => "isarrow",
                "value" => array(__("Yes, hide them", "vc_metrocarousel_cq") => 'no'),
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("The arrow navigaion is visible by default, you can check this to hide them.", 'vc_metrocarousel_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_metrocarousel_cq",
                "heading" => __("Auto delay slideshow for the carousel?", "vc_metrocarousel_cq"),
                "param_name" => "autoplay",
                "value" => array(__("no", "vc_metrocarousel_cq") => "no", __("yes", "vc_metrocarousel_cq") => "yes"),
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Autoplay speed in milliseconds", "vc_metrocarousel_cq"),
                "param_name" => "autoplayspeed",
                "value" => "4000",
                "dependency" => Array('element' => "autoplay", 'value' => array('yes')),
                "description" => __("The speed of the auto delay slideshow, default is 4000, which stand for 4 seconds.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Optional carousel background color:", 'vc_metrocarousel_cq'),
                "param_name" => "carouselbgcolor",
                "value" => '',
                "dependency" => Array('element' => "displaystyle", 'value' => array('carousel')),
                "description" => __("Default is transparent without color.", 'vc_metrocarousel_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS margin of current container:", "vc_metrocarousel_cq"),
                "param_name" => "containermagin",
                "value" => "10px 0 0 0",
                "description" => __("Default is margin-top for 10px, customize it with other value as you like.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize all the images to this width:", "vc_metrocarousel_cq"),
                "param_name" => "resizewidth",
                "value" => "",
                "description" => __("Default we will use the original image in the carousel and tile, you can specify a width here to resize them if your original image is too large.", "vc_metrocarousel_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_metrocarousel_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it is in your css file.", "vc_metrocarousel_cq")
             )

           )
       ));

       add_shortcode('cq_vc_metrocarousel', array($this,'cq_vc_metrocarousel_func'));

      }

      function cq_vc_metrocarousel_func($atts, $content=null, $tag) {
          extract(shortcode_atts(array(
            'images' => '',
            'displaystyle' => 'carousel',
            'position' => 'bottom-left',
            'buttontype' => 'default',
            'isarrow' => '',
            'animation' => 'slide',
            'slideeffect' => 'slideLeft',
            'carouselheight' => '300',
            'mintilewidth' => '320',
            'mintileheight' => '200',
            'containermagin' => '10px 0 0 0',
            'carouselheight' => '300',
            'tileheight' => '300',
            'mincarouselwidth' => '450',
            'mincarouselheight' => '200',
            'buttoncolor' => 'fg-lime',
            'onclick' => 'lightbox',
            'customlinks' => '',
            'customlinktarget' => '',
            'tilecaption' => '',
            'autoplay' => 'no',
            'autoplayspeed' => '',
            'tileautoplayspeed' => '',
            'carouselbgcolor' => '',
            'resizewidth' => '',
            'extra_class' => ''
          ), $atts));


          wp_register_style('iconfont', plugins_url('css/iconfont.min.css', __FILE__));
          wp_enqueue_style('iconfont');
          wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');
          wp_register_style('metro-carousel-tile', plugins_url('css/metro-carousel-tile.css', __FILE__));
          wp_enqueue_style('metro-carousel-tile');

          // wp_register_script('metro-core', plugins_url('js/metro-core.js', __FILE__), array("jquery"));
          // wp_enqueue_script('metro-core');
          // wp_register_script('metro-live-tile', plugins_url('js/metro-live-tile.js', __FILE__), array("jquery", "jquery.widget", "jquery.easing"));
          // wp_enqueue_script('metro-live-tile');
          wp_register_script('jquery.widget', plugins_url('js/jquery.widget.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('jquery.widget');
          wp_register_script('jquery.easing', plugins_url('js/jquery.easing.1.3.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('jquery.easing');
          wp_register_script('metro-carousel-tile', plugins_url('js/metro-carousel-tile.min.js', __FILE__), array("jquery", "jquery.widget"));
          wp_enqueue_script('metro-carousel-tile');

          wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');

          wp_register_script('vc-extensions-metrocarousel-init', plugins_url('js/init.min.js', __FILE__), array("jquery", "metro-carousel-tile", "fs.boxer"));
          wp_enqueue_script('vc-extensions-metrocarousel-init');


          $i = -1;
          // $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $imagesarr = explode(',', $images);
          $customlinks = explode( ',', $customlinks);
          $output_start = $output_content = $output_end = '';
          $image_str = '';
          $output = '';
          if($displaystyle=="carousel"){
            $output_start .= '<div class="carousel '.$extra_class.' '.$buttoncolor.'" data-position="'.$position.'" data-buttontype="'.$buttontype.'" data-carouselheight="'.$carouselheight.'" data-animation="'.$animation.'" data-containermagin="'.$containermagin.'" data-mincarouselwidth="'.$mincarouselwidth.'" data-mincarouselheight="'.$mincarouselheight.'" data-autoplay="'.$autoplay.'" data-autoplayspeed="'.$autoplayspeed.'" data-carouselbgcolor="'.$carouselbgcolor.'">';
          }else{
            $output_start .= '<div class="tile bg-cyan live '.$extra_class.'" data-slideeffect="'.$slideeffect.'" data-tileheight="'.$tileheight.'" data-mintilewidth="'.$mintilewidth.'" data-mintileheight="'.$mintileheight.'" data-containermagin="'.$containermagin.'" data-tileautoplayspeed="'.$tileautoplayspeed.'">';
          }
          foreach ($imagesarr as $key => $image) {
              $i++;
              $image_str = '';
              if(!isset($customlinks[$i])) $customlinks[$i] = '';
              $return_img_arr = wp_get_attachment_image_src(trim($image), 'full');
              $attachment = get_post($image);
              if($displaystyle=="carousel"){
                  $output_content .= '<div class="slide">';
              }else{
                  $output_content .= '<div class="tile-content">';
              }

              $img = $thumbnail = "";

              $fullimage = $return_img_arr[0];
              $thumbnail = $fullimage;
              if($resizewidth!=""){
                  if(function_exists('wpb_resize')){
                      $img = wpb_resize($image, null, $resizewidth, null);
                      $thumbnail = $img['url'];
                      if($thumbnail=="") $thumbnail = $fullimage;
                  }
              }


              if($return_img_arr[0]!=""){
                  // if($resizewidth!=""){
                      $image_str .= '<img src="'.$thumbnail.'" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />';
                  // }else{
                      // $image_str .= '<img src="'.$return_img_arr[0].'" alt="image" />';
                  // }
                  if($onclick=="lightbox"){
                      $output_content .= '<a href="'.$return_img_arr[0].'" class="carousel-item">';
                      // $output_content .= '<img src="'.$return_img_arr[0].'" alt="image" />';
                      $output_content .= $image_str;
                      $output_content .= '</a>';
                  }else if($onclick=="customlink"){
                      if($customlinks[$i]!="")$output_content .= '<a href="'.$customlinks[$i].'" target="'.$customlinktarget.'">';
                      // $output_content .= '<img src="'.$return_img_arr[0].'" alt="image" />';
                      $output_content .= $image_str;
                      if($customlinks[$i]!="")$output_content .= '</a>';
                  }else{
                      // $output_content .= '<img src="'.$return_img_arr[0].'" alt="image" />';
                      $output_content .= $image_str;
                  }
              }
              $output_content .= '</div>';

          }
          if($displaystyle!="carousel"){
              if($tilecaption!=""){
                  $output_content .= '<div class="brand bg-dark opacity"><span class="text">'.$tilecaption.'</span> </div>';
              }
          }
          if($isarrow!="no"&&$displaystyle=="carousel"){
              $output_content .= '<a class="controls left"><i class="icon-arrow-left-3"></i></a><a class="controls right"><i class="icon-arrow-right-3"></i></a>';
          }
          $output_end .= '</div>';

          $output = $output_start.$output_content.$output_end;


          return $output;

        }


  }


}

?>
