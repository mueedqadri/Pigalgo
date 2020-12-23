<?php
if (!class_exists('VC_Extensions_ProfileCard')) {

    class VC_Extensions_ProfileCard {
        function __construct() {
          vc_map( array(
            "name" => __("Profile Card", 'vc_profilecard_cq'),
            "base" => "cq_vc_profilecard",
            "class" => "wpb_cq_vc_extension_profilecard",
            "controls" => "full",
            "icon" => "cq_allinone_profilecard",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('Card with unfold effect', 'js_composer' ),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Image", "vc_profilecard_cq"),
                "param_name" => "image",
                "value" => "",
                "description" => __("Select image from media library.", "vc_profilecard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Thumbnail width", "vc_profilecard_cq"),
                "param_name" => "width",
                "value" => __("240", 'vc_profilecard_cq'),
                "description" => __("", "vc_profilecard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Thumbnail height", "vc_profilecard_cq"),
                "param_name" => "height",
                "value" => __("180", 'vc_profilecard_cq'),
                "description" => __("", "vc_profilecard_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_profilecard_cq",
                "heading" => __("Icons", 'vc_profilecard_cq'),
                "param_name" => "icons",
                "value" => __("twitter,dribbble,facebook-square,google-plus-square,smile-o", 'vc_profilecard_cq'),
                "description" => __("Enter title for each icon here, you can find <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>all the available icons here</a>. Put the name (without the fa-) here, divide each with linebreaks (Enter).", 'vc_profilecard_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_profilecard_cq",
                "heading" => __("Icon tooltip", 'vc_profilecard_cq'),
                "param_name" => "icon_title",
                "value" => __("Follow me on twitter,Dribbble,Facebook,Google Plus,I'm happy", 'vc_profilecard_cq'),
                "description" => __("Enter title for each icon here. Divide each with linebreaks (Enter).", 'vc_profilecard_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilecard_cq",
                "heading" => __("Icon tooltip position", "vc_profilecard_cq"),
                "param_name" => "tooltipposition",
                "value" => array(__("top", "vc_profilecard_cq") => "top", __("bottom", "vc_profilecard_cq") => "bottom", __("left", "vc_profilecard_cq") => "left", __("right", "vc_profilecard_cq") => "right"/*, __("top-left", "vc_profilecard_cq") => "top-left", __("top-right", "vc_profilecard_cq") => "top-right", __("bottom-left", "vc_profilecard_cq") => "bottom-left", __("bottom-right", "vc_profilecard_cq") => "bottom-right"*/),
                "description" => __("Choose where to display the icons.", "vc_profilecard_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "heading" => __("Custom links", "vc_profilecard_cq"),
                "param_name" => "custom_links",
                "value" => "http://twitter.com,http://dribbble.com,http://facebook.com,https://plus.google.com,http://codecanyon.net/user/sike?ref=sike",
                "description" => __('Enter links for each icon here. Divide links with linebreaks (Enter).', 'vc_profilecard_cq')
              ),
              array(
                "type" => "colorpicker",
                "heading" => __("Icon color", "vc_profilecard_cq"),
                "param_name" => "color",
                "value" => "#333333",
                "description" => __("Select global color for the icon, you can customize each icon with individual color below too.", "vc_profilecard_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "heading" => __("Individual color for each icon", "vc_profilecard_cq"),
                "param_name" => "individual_color",
                "value" => "#00ACED,#E14782,#3B5998,#E14107,#333333",
                "description" => __('Enter color for each icon here. Divide links with linebreaks (Enter).', 'vc_profilecard_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Icon opacity", "vc_profilecard_cq"),
                "param_name" => "opacity",
                "value" => "0.8",
                "description" => __("", "vc_profilecard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Icon magin", "vc_profilecard_cq"),
                "param_name" => "margin",
                "value" => "20px 0 0 15px",
                "description" => __("Each icon margin, default is 20px 0 0 15px", "vc_profilecard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilecard_cq",
                "heading" => __("Display the icons on the:", "vc_profilecard_cq"),
                "param_name" => "iconposition",
                "value" => array(__("bottom", "vc_profilecard_cq") => "bottom", __("top", "vc_profilecard_cq") => "top", __("right", "vc_profilecard_cq") => "right", __("left", "vc_profilecard_cq") => "left"),
                "description" => __("Choose where to display the icons.", "vc_profilecard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_profilecard_cq",
                "heading" => __("Display the icon panel when user:", "vc_profilecard_cq"),
                "param_name" => "icontrigger",
                "value" => array(__("hover", "vc_profilecard_cq") => "mouseover", __("click", "vc_profilecard_cq") => "click"),
                "description" => __("Choose where to display the icons.", "vc_profilecard_cq")
              ),
              array(
                "type" => "dropdown",
                "heading" => __("Custom link target", "vc_profilecard_cq"),
                "param_name" => "custom_links_target",
                "description" => __('Select how to open icon links.', 'vc_profilecard_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
                'value' => array(__("Same window", "vc_profilecard_cq") => "_self", __("New window", "vc_profilecard_cq") => "_blank")
              ),
              // array(
              //   "type" => "checkbox",
              //   "holder" => "",
              //   "class" => "vc_profilecard_cq",
              //   "heading" => __("Animate the icons when open it?", 'vc_profilecard_cq'),
              //   "param_name" => "iconanimate",
              //   "value" => array(__("Yes", "vc_profilecard_cq") => 'on'),
              //   "description" => __("You can choose the animate style below.", 'vc_profilecard_cq')
              // ),
              // array(
              //   "type" => "dropdown",
              //   "heading" => __("Animate style", "vc_profilecard_cq"),
              //   "param_name" => "animatestyle",
              //   "description" => __('', 'vc_profilecard_cq'),
              //   'value' => array(__("fade", "vc_profilecard_cq") => "fade", __("fadeInLeft", "vc_profilecard_cq") => "fadeInLeft", __("fadeInRight", "vc_profilecard_cq") => "fadeInRight", __("fadeInUp", "vc_profilecard_cq") => "fadeInUp", __("fadeInDown", "vc_profilecard_cq") => "fadeInDown", __("bounceInLeft", "vc_profilecard_cq") => "bounceInLeft", __("bounceInRight", "vc_profilecard_cq") => "bounceInRight", __("bounceInUp", "vc_profilecard_cq") => "bounceInUp", __("bounceInDown", "vc_profilecard_cq") => "bounceInDown", __("rollIn", "vc_profilecard_cq") => "rollIn")
              // ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_profilecard_cq",
                "heading" => __("Make the icons visible by default?", 'vc_profilecard_cq'),
                "param_name" => "iconvisible",
                "value" => array(__("Yes", "vc_profilecard_cq") => 'on'),
                "description" => __("Check to make the icons visible when page is loaded.", 'vc_profilecard_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_profilecard_cq",
                "heading" => __("Make the thumbnails retina?", 'vc_profilecard_cq'),
                "param_name" => "retina",
                "value" => array(__("Yes", "vc_profilecard_cq") => 'on'),
                "description" => __("For example a 640x480 thumbnail will display as 320x240 in retina mode.", 'vc_profilecard_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the icon", "vc_profilecard_cq"),
                "param_name" => "icon_class",
                "description" => __("You can append extra class to the font awesome icon, for example, fa-spin will make the icon spin.", "vc_profilecard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the thumbnail", "vc_profilecard_cq"),
                "param_name" => "thumb_class",
                "description" => __("You can append extra class to the thumbnail (li tag here).", "vc_profilecard_cq")
              )
            )

        ));


        add_shortcode('cq_vc_profilecard', array($this,'cq_vc_profilecard_func'));
      }

      function cq_vc_profilecard_func($atts, $content=null, $tag) {
          extract( shortcode_atts( array(
            'image' => '',
            'width' => '240',
            'height' => '168',
            'icons' => 'twitter',
            'color' => '#0066FF',
            'background' => '#00BFFF',
            'opacity' => '0.8',
            'margin' => '20px 0 0 15px',
            'iconposition' => 'bottom',
            'icontrigger' => 'click',
            // 'iconanimate' => 'on',
            // 'animatestyle' => 'fadeInLeft',
            'individual_color' => '',
            'thumb_class' => '',
            'icon_class' => '',
            'iconvisible' => 'off',
            'retina' => 'off',
            'custom_links' => '',
            'icon_title' => '',
            'tooltipposition' => 'top',
            'custom_links_target' => '_self'
            // 'content' => ''
          ), $atts ) );


          wp_register_style( 'profilecard_style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'profilecard_style' );
          // wp_register_style('animate.css', plugins_url('css/animate.css', __FILE__));
          // wp_enqueue_style('animate.css');
          wp_register_style('tooltipster', plugins_url('css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');

          wp_register_script('profilecard_script', plugins_url('js/script.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('profilecard_script');
          wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
          wp_enqueue_style( 'font-awesome' );
          wp_register_script('tooltipster', plugins_url('js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $image_full = wp_get_attachment_image_src($image, 'full');
          $icons = explode(',', $icons);
          $custom_links = explode( ',', $custom_links);
          $icon_title = explode( ',', $icon_title);
          $individual_color = explode( ',', $individual_color);

          $image_temp = $profileimage = "";
          $fullimage = $image_full[0];
          $profileimage = $fullimage;
          if($width!=""){
              if(function_exists('wpb_resize')){
                  $image_temp = wpb_resize($image, null, $width*2, $height*2, true);
                  $profileimage = $image_temp['url'];
                  if($profileimage=="") $profileimage = $fullimage;
              }
          }


          $output = '';
          $output .= '<div class = "profilecard-container '.$thumb_class.'" style="width:'.$width.'px;height:'.$height.'px;" data-image="'.$profileimage.'" data-width="'.$width.'" data-height="'.$height.'" data-color="'.$color.'" data-opacity="'.$opacity.'" data-margin="'.$margin.'" data-trigger="'.$icontrigger.'" data-iconvisible="'.$iconvisible.'"  data-tooltipposition="'.$tooltipposition.'">';

          if($iconposition=="right"){
            $output .= '<div class = "profilecard-cover right1"></div>
                        <div class = "profilecard-cover right2"><span></span></div>';
            $output .= '<div class = "profilecard-controlsright">';
          }else if($iconposition=="bottom"){
            $output .= '<div class = "profilecard-cover bottom1"></div>
                        <div class = "profilecard-cover bottom2"><span></span></div>';
            $output .= '<div class = "profilecard-controlsbottom">';
          }else if($iconposition=="left"){
            $output .= '<div class = "profilecard-cover left1"><span></span></div>
                        <div class = "profilecard-cover left2"></div>';
            $output .= '<div class = "profilecard-controlsleft">';
          }else{
            $output .= '<div class = "profilecard-cover top1"><span></span></div>
                        <div class = "profilecard-cover top2"></div>';
            $output .= '<div class = "profilecard-controlstop">';
          }

          $i = -1;
          foreach ($icons as $key => $value) {
            $i++;
            if(!isset($custom_links[$i])) $custom_links[$i] = "";
            if(!isset($icon_title[$i])) $icon_title[$i] = "";
            if(!isset($individual_color[$i])) $individual_color[$i] = "";
            if($custom_links[$i]!=""){
              $output .= '<a href="'.$custom_links[$i].'" target="'.$custom_links_target.'" class="profilecard-icon-link">';
              if(!isset($icon_title[$i])) $icon_title[$i] = "";
              if(!isset($individual_color[$i])) $individual_color[$i] = "";
              $output .= '<i class="profilecard-icon fa fa-'.trim($value).' '.$icon_class.'" title="'.$icon_title[$i].'" data-color="'.$individual_color[$i].'"></i>';
              $output .= '</a>';
            }else{
              $output .= '<i class="profilecard-icon fa fa-'.trim($value).' '.$icon_class.'" title="'.$icon_title[$i].'" data-color="'.$individual_color[$i].'"></i>';
            }
          }

          $output .= '</div>';
          $output .= '</div>';
          return $output;

        }

  }


}

?>
