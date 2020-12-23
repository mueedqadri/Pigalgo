<?php
if (!class_exists('VC_Extensions_HomeSlider')) {
    class VC_Extensions_HomeSlider{
        function __construct() {
            vc_map(array(
            "name" => __("Home Slider", 'vc_homeslider_cq'),
            "base" => "cq_vc_homeslider",
            "class" => "wpb_cq_vc_extension_homeslider",
            // "as_parent" => array('only' => 'cq_vc_homeslider_item'),
            "icon" => "cq_allinone_homeslider",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Full width slider for homepage', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Slide images:", "vc_homeslider_cq"),
                "param_name" => "images",
                "value" => "",
                "group" => "Image",
                "description" => __("Select image(s) from media library, support multiple images.", "vc_homeslider_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_homeslider_cq",
                "heading" => __("Image stretch", "vc_homeslider_cq"),
                "param_name" => "imagestretch",
                "value" => array(__("Default", "vc_homeslider_cq") => "default", __("Stretch to full width", "vc_homeslider_cq") => "fullwidth"),
                "std" => "default",
                "group" => "Image",
                "description" => __("", "vc_homeslider_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("max-height for the images", "vc_homeslider_cq"),
                "param_name" => "maxheight",
                "value" => "",
                "group" => "Image",
                "description" => __("Default is 640px", "vc_homeslider_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_homeslider_cq",
                "heading" => __("Image on click", "vc_homeslider_cq"),
                "param_name" => "onclick",
                "value" => array(/*__("Open lightbox", "vc_homeslider_cq") => "lightbox",*/__("Do nothing", "vc_homeslider_cq") => "none", __("Open custom link", "vc_homeslider_cq") => "customlink"),
                "std" => "none",
                "group" => "Image",
                "description" => __("", "vc_homeslider_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_homeslider_cq",
                "heading" => __("Custom link for each image", 'vc_homeslider_cq'),
                "param_name" => "customlinks",
                "value" => __("", 'vc_homeslider_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('customlink')),
                "group" => "Image",
                "description" => __("Divide with linebreak (Enter), available with open custom link option.", 'vc_homeslider_cq')
              ),
              array(
                "type" => "dropdown",
                "heading" => __("Custom link target", "vc_homeslider_cq"),
                "param_name" => "customlinktarget",
                "description" => __('Select how to open custom link.', 'vc_homeslider_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('customlink')),
                "group" => "Image",
                'value' => array(__("Same window", "vc_homeslider_cq") => "_self", __("New window", "vc_homeslider_cq") => "_blank")
              ),
              // array(
              //   "type" => "dropdown",
              //   "holder" => "",
              //   "heading" => __("Resize the avatar image?", "vc_homeslider_cq"),
              //   "param_name" => "isresize",
              //   "value" => array("no", "yes (specify the image width below)"=>"yes"),
              //   "std" => "no",
              //   "group" => "Image",
              //   "description" => __("", "vc_homeslider_cq")
              // ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Resize image to this width", "vc_homeslider_cq"),
              //   "param_name" => "imagewidth",
              //   "value" => "",
              //   "dependency" => Array('element' => "isresize", 'value' => array('yes')),
              //   "group" => "Image",
              //   "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. Please use it carefully, may not work with some server setup.", "vc_homeslider_cq")
              // ),
              array(
                "type" => "exploded_textarea",
                "heading" => __("Optional title for each slide", "vc_homeslider_cq"),
                "param_name" => "titles",
                "value" => "",
                "group" => "Caption",
                "description" => __("Divide with linebreak (Enter)", "vc_homeslider_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Caption content, divide each one with <strong>[captionitem][/captionitem]</strong>, please try to edit in the <strong>text mode</strong>:", "vc_homeslider_cq"),
                "param_name" => "content",
                "group" => "Caption",
                "value" => __("", "vc_homeslider_cq"), "description" => __("", "vc_homeslider_cq"),
                "description" => __("Please keep the caption item number is same as the image number.", "vc_homeslider_cq"),
                "std" => '[captionitem]item caption 1[/captionitem]
[captionitem]item caption 2[/captionitem]
[captionitem]item caption 3[/captionitem]'
              ),
              array(
                "type" => "textfield",
                "heading" => __("width for the caption", "vc_homeslider_cq"),
                "param_name" => "captionwidth",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default is 360px", "vc_homeslider_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("min-height for the caption", "vc_homeslider_cq"),
                "param_name" => "minheight",
                "value" => "",
                "group" => "Caption",
                "description" => __("You can customize the caption with a min-height to keep all caption in same height, for example <strong>400px</strong>", "vc_homeslider_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_homeslider_cq",
                "heading" => __("The caption style", "vc_homeslider_cq"),
                "param_name" => "navstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Or you can customized color below:" => "customized"),
                'std' => 'lavender',
                "group" => "Caption",
                "description" => __("", "vc_homeslider_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize caption background color", 'vc_homeslider_cq'),
                "param_name" => "contentbackground",
                "value" => '',
                'dependency' => array('element' => 'navstyle', 'value' => 'customized'),
                "group" => "Caption",
                "description" => __("Both 2 buttons in same background color.", 'vc_homeslider_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Font color of the caption", 'vc_homeslider_cq'),
                "param_name" => "contentcolor",
                "value" => "",
                'dependency' => array('element' => 'navstyle', 'value' => 'customized'),
                "group" => "Caption",
                "description" => __("Default is white.", 'vc_homeslider_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS top for the caption", "vc_homeslider_cq"),
                "param_name" => "captiontop",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default is 0. You can specif a value like <strong>12px</strong> or <strong>10%</strong> here.", "vc_homeslider_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS left for the caption", "vc_homeslider_cq"),
                "param_name" => "captionleft",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default is 0. You can specif a value like <strong>12px</strong> or <strong>10%</strong> here.", "vc_homeslider_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_homeslider_cq",
                "heading" => __("Select the auto delay time", "vc_homeslider_cq"),
                "param_name" => "delaytime",
                "value" => array("No slideshow" => "no", "2", "3", "4", "5", "6", "7", "8", "10"),
                'std' => 'no',
                "description" => __("Choose to display the slider with auto delay slideshow or not, the number is in second.", "vc_homeslider_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_homeslider_cq",
                "heading" => __("Display image and caption with shadow?", "vc_homeslider_cq"),
                "param_name" => "isshadow",
                "value" => array("Yes (tiny shadow)" => "tinyshadow", "Yes (long shadow)" => "longshadow", "No" => "noshadow"),
                "std" => "tinyshadow",
                "description" => __("", "vc_homeslider_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_homeslider_cq",
                "heading" => __("Content bottom shape", "vc_homeslider_cq"),
                "param_name" => "bottomshape",
                "value" => array("rounded (small)" => "roundsmall", "rounded (large)" => "roundlarge", "square" => "square"),
                "std" => "square",
                "description" => __("", "vc_homeslider_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_homeslider_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_homeslider_cq")
              )

           )
        ));

        add_shortcode('cq_vc_homeslider', array($this,'cq_vc_homeslider_func'));
      }

      function cq_vc_homeslider_func($atts, $content=null, $tag) {
          extract(shortcode_atts(array(
            "images" => "",
            "imagewidth" => "",
            "captiontop" => "",
            "captionleft" => "",
            "minheight" => "",
            "maxheight" => "",
            "captionwidth" => "",
            "imagestretch" => "default",
            // "isresize" => "no",
            "titles" => "",
            "contentcolor" => "",
            "delaytime" => "no",
            "avatarlink" => "",
            "isshadow" => "tinyshadow",
            "onclick" => "none",
            "customlinks" => "",
            "customlinktarget" => "",
            // "backgroundimage" => "",
            // "backgroundimagetype" => "cover",
            "contentstyle" => "",
            "contentbackground" => "",
            "bottomshape" => "",
            "navstyle" => "lavender",
            // "buttonsize" => "btn-large",
            "extraclass" => ""
          ), $atts));

          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
            vc_icon_element_fonts_enqueue('entypo');
          }else{
            // wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
            // wp_enqueue_style( 'font-awesome' );
          }


          // $color_style_arr = array("grapefruit" => array("#ED5565", "#DA4453"), "bittersweet" => array("#FC6E51", "#E9573F"), "sunflower" => array("#FFCE54", "#F6BB42"), "grass" => array("#A0D468", "#8CC152"), "mint" => array("#48CFAD", "#37BC9B"), "aqua" => array("#4FC1E9", "#3BAFDA"), "bluejeans" => array("#5D9CEC", "#4A89DC"), "lavender" => array("#AC92EC", "#967ADC"), "pinkrose" => array("#EC87C0", "#D770AD"), "lightgray" => array("#F5F7FA", "#E6E9ED"), "mediumgray" => array("#CCD1D9", "#AAB2BD"), "darkgray" => array("#656D78", "#434A54"), "customized" => array("$buttonbackground", "$buttonbackground") );


          wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');
          wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');

          wp_register_style( 'vc-extensions-homeslider-style', plugins_url('css/style.min.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-homeslider-style' );
          wp_register_style('slick', plugins_url('../testimonialcarousel/slick/slick.css', __FILE__));
          wp_enqueue_style('slick');

          wp_register_script('slick', plugins_url('../testimonialcarousel/slick/slick.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('slick');
          wp_enqueue_script('vc-extensions-homeslider-script');
          wp_register_script('vc-extensions-homeslider-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "slick", "fs.boxer"));

          wp_enqueue_script('vc-extensions-homeslider-script');

          $content = str_replace('[/captionitem]', '', trim($content));
          $contentarr = explode('[captionitem]', trim($content));
          array_shift($contentarr);
          $imagesArr = explode(',', $images);
          $titles = explode(',', $titles);

          $output = "";
          $navigation_str = '';
          $image_str = '';
          $content_str = '';
          $area_str = '';

          $customlinks = explode( ',', $customlinks);

          $output .= '<div class="cq-homeslider '.$navstyle.' '.$isshadow.' '.$extraclass.'" data-captiontop="'.$captiontop.'" data-captionleft="'.$captionleft.'" data-delaytime="'.$delaytime.'" data-minheight="'.$minheight.'" data-maxheight="'.$maxheight.'" data-contentbackground="'.$contentbackground.'" data-vc-stretch-content="true" data-captionwidth="'.$captionwidth.'" data-imagestretch="'.$imagestretch.'" data-contentcolor="'.$contentcolor.'">';

          $navigation_str .= '<div class="cq-homeslider-navigation btn-medium">';
          $navigation_str .= '<div class="homeslider-navigation-prev">';
          $navigation_str .= '<i class="cq-homeslider-icon entypo-icon entypo-icon-left-open-big"></i>';
          $navigation_str .= '</div>';
          $navigation_str .= '<div class="homeslider-navigation-next">';
          $navigation_str .= '<i class="cq-homeslider-icon entypo-icon entypo-icon-right-open-big"></i>';
          $navigation_str .= '</div>';
          $navigation_str .= '</div>';

          // $output .= '<div class="cq-homeslider-area '.$bottomshape.'">';

          $image_str .= '<div class="cq-homeslider-cover">';
          $image_str .= '<div class="cq-homeslider-itemcontainer">';
          $content_str .= '<div class="cq-homeslider-contentcontainer '.$bottomshape.'">';
          $content_str .= '<div class="cq-homeslider-content">';


          $i = -1;
          $j = -1;
          foreach ($contentarr as $key => $thecontent) {
              $j++;
              if(!isset($thecontent)) $thecontent = "";
              $thecontent = preg_replace("/(^)?(<br\s*\/?>\s*)+$/", "", $thecontent);
              $thecontent = preg_replace('/^(<br \/>)*/', "", $thecontent);
              $thecontent = preg_replace('/^(<\/p>)*/', "", $thecontent);
              $content_str .= '<div class="cq-homeslider-contentitem">';
              if(isset($titles[$j])){
                $content_str .= '<h4 class="cq-homeslider-title">';
                $content_str .= $titles[$j];
                $content_str .= '</h4>';
              }
              $content_str .= wpb_js_remove_wpautop($thecontent);
              $content_str .= '</div>';
          }

          foreach ($imagesArr as $key => $theimage) {
              $i++;
              if(!isset($customlinks[$i])) $customlinks[$i] = '';
              if(!isset($contentarr[$i])){
                  $content_str .= '<div class="cq-homeslider-contentitem">';
                  $content_str .= '</div>';
              }

              $imageLocation = wp_get_attachment_image_src($theimage, 'full');
              $attachment = get_post($theimage);
              $image_str .= '<div class="cq-homeslider-imageitem">';
              if($onclick=="customlink"){
                if($customlinks[$i]!="") $image_str .= '<a href="'.$customlinks[$i].'" target="'.$customlinktarget.'" class="cq-homeslider-link">';
              }else if($onclick=="lightbox"){
                if($imageLocation[0]!="") $image_str .= '<a href="'.$imageLocation[0].'" class="cq-homeslider-link cq-homeslider-lightbox">';
              }
              // if($isresize=="yes"&&$imagewidth!=""){
              //     if($imageLocation[0]!="") $image_str .= '<img src="'.aq_resize($imageLocation[0], $imagewidth, null, true, true, true).'" class="cq-homeslider-image" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'">';
              // }else{
              if($imageLocation[0]!=""){
                $image_str .= '<img src="'.$imageLocation[0].'" class="cq-homeslider-image" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'"
>';
              }
              // }
              if($onclick=="customlink"){
                if($customlinks[$i]!="") $image_str .= '</a>';
              }else if($onclick=="lightbox"){
                if($imageLocation[0]!="") $image_str .= '</a>';
              }

              // if(isset($imagelinks[$i])&&$imagelinks[$i]!="") $image_str .= '<a href="'.$imagelinks[$i].'" target="'.$imagelinktarget.'" class="cq-imageaccordion-link">';

              $image_str .= '</div>';

          }

          $image_str .= '</div>';
          $image_str .= '</div>';

          $content_str .= '</div>';
          $content_str .= $navigation_str;
          $content_str .= '</div>';  // end of the contentcontainer

          $area_str .= '<div class="cq-homeslider-area btn-medium">';
          $area_str .= $image_str.$content_str;

          $area_str .= '</div>';

          // $output .= $area_str.$navigation_str;
          $output .= $area_str;

          // $output .= $navigation_str;

          $output .= '</div>';

          return $output;

        }

  }

}

?>
