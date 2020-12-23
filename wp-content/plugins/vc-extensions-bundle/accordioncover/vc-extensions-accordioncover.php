<?php
if (!class_exists('VC_Extensions_AccordionCover')) {
    class VC_Extensions_AccordionCover{
        function __construct() {
            vc_map(array(
            "name" => __("Accordion Cover", 'vc_accordioncover_cq'),
            "base" => "cq_vc_accordioncover",
            "class" => "wpb_cq_vc_extension_accordioncover",
            // "as_parent" => array('only' => 'cq_vc_accordioncover_item'),
            "icon" => "cq_allinone_accordioncover",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Image list with lightbox support', 'js_composer'),
            // 'front_enqueue_css' => plugins_url('css/accordioncover_frontend.css', __FILE__),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Cover images:", "vc_accordioncover_cq"),
                "param_name" => "images",
                "value" => "",
                "group" => "Image",
                "description" => __("Select image(s) from media library, support multiple images.", "vc_accordioncover_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_accordioncover_cq",
                "heading" => __("Image on click", "vc_accordioncover_cq"),
                "param_name" => "onclick",
                "value" => array(__("Open lightbox", "vc_accordioncover_cq") => "lightbox", __("Do nothing", "vc_accordioncover_cq") => "none", __("Open custom link", "vc_accordioncover_cq") => "customlink"),
                "std" => "none",
                "group" => "Image",
                "description" => __("", "vc_accordioncover_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_accordioncover_cq",
                "heading" => __("Custom link for each image", 'vc_accordioncover_cq'),
                "param_name" => "customlinks",
                "value" => __("", 'vc_accordioncover_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('customlink')),
                "group" => "Image",
                "description" => __("Divide with linebreak (Enter), available with open custom link option.", 'vc_accordioncover_cq')
              ),
              array(
                "type" => "dropdown",
                "heading" => __("Custom link target", "vc_accordioncover_cq"),
                "param_name" => "customlinktarget",
                "description" => __('Select how to open custom link.', 'vc_accordioncover_cq'),
                "dependency" => Array('element' => "onclick", 'value' => array('customlink')),
                "group" => "Image",
                'value' => array(__("Same window", "vc_accordioncover_cq") => "_self", __("New window", "vc_accordioncover_cq") => "_blank")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Resize the image?", "vc_accordioncover_cq"),
                "param_name" => "isresize",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "group" => "Image",
                "description" => __("", "vc_accordioncover_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_accordioncover_cq"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "group" => "Image",
                "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. ", "vc_accordioncover_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_accordioncover_cq",
                "heading" => __("Title for each caption (optional)", 'vc_accordioncover_cq'),
                "param_name" => "titles",
                "value" => __("", 'vc_accordioncover_cq'),
                "group" => "Caption",
                "description" => __("Divide with linebreak (Enter)", 'vc_accordioncover_cq')
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Caption content, divide each one with <strong>[captionitem][/captionitem]</strong>, please try to edit in text mode:", "vc_accordioncover_cq"),
                "param_name" => "content",
                "group" => "Caption",
                "value" => __("", "vc_accordioncover_cq"), "description" => __("", "vc_accordioncover_cq"),
                "std" => '[captionitem]item caption 1[/captionitem]
[captionitem]item caption 2[/captionitem]
[captionitem]item caption 3[/captionitem]'
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_accordioncover_cq",
                "heading" => __("The caption overlay background:", "vc_accordioncover_cq"),
                "param_name" => "overlaystyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Or you can customized background color below:" => "customized"),
                'std' => 'lavender',
                "description" => __("", "vc_accordioncover_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Font color the caption", 'vc_accordioncover_cq'),
                "param_name" => "contentcolor",
                "value" => "",
                'dependency' => array('element' => 'overlaystyle', 'value' => 'customized'),
                "description" => __("Default is white.", 'vc_accordioncover_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize caption overlay background color", 'vc_accordioncover_cq'),
                "param_name" => "captionbackground",
                "value" => '',
                'dependency' => array('element' => 'overlaystyle', 'value' => 'customized'),
                "description" => __("", 'vc_accordioncover_cq')
              ),array(
                "type" => "textfield",
                "heading" => __("Element height", "vc_accordioncover_cq"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("The height of whole element, default is <strong>320px</strong>. You can specify other value here, like <strong>100vh</strong>, which stand for 100% of viewport height of the browser.", "vc_accordioncover_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_accordioncover_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_accordioncover_cq")
              )

           )
        ));

        add_shortcode('cq_vc_accordioncover', array($this,'cq_vc_accordioncover_func'));

      }


      function cq_vc_accordioncover_func($atts, $content=null, $tag) {
          extract(shortcode_atts(array(
            "images" => "",
            "imagewidth" => "",
            "isresize" => "no",
            "contentcolor" => "",
            "isshadow" => "tinyshadow",
            "onclick" => "none",
            "customlinks" => "",
            "customlinktarget" => "",
            "titles" => "",
            "contentstyle" => "",
            "overlaystyle" => "lavender",
            "captionbackground" => "",
            "contentcolor" => "",
            "elementheight" => "",
            "extraclass" => ""
          ), $atts));

          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
            vc_icon_element_fonts_enqueue('entypo');
          }else{
            // wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
            // wp_enqueue_style( 'font-awesome' );
          }


          // $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          // $content = str_replace("<p></p>", "", $content);


          wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');
          wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');

          wp_register_style( 'vc-extensions-accordioncover-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-accordioncover-style' );

          wp_register_script('vc-extensions-accordioncover-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "fs.boxer"));
          wp_enqueue_script('vc-extensions-accordioncover-script');

          $content = str_replace('[/captionitem]', '', trim($content));
          $contentarr = explode('[captionitem]', trim($content));
          array_shift($contentarr);
          $imagesArr = explode(',', $images);

          $i = -1;
          $output = "";

          $customlinks = explode( ',', $customlinks);
          $titles = explode( ',', $titles);

          $image_str = '';

          $output .= '<div class="cq-accordioncover '.$overlaystyle.' '.$extraclass.'" data-overlaystyle="'.$overlaystyle.'" data-elementheight="'.$elementheight.'" data-captionbackground="'.$captionbackground.'" data-contentcolor="'.$contentcolor.'">';
          foreach ($imagesArr as $key => $theimage) {
              $i++;
              $imageLocation = wp_get_attachment_image_src($theimage, 'full');
              $img = $thumbnail = "";

              $fullimage = $imageLocation[0];
              $thumbnail = $fullimage;
              if($isresize=="yes"&&$imagewidth!=""){
                  if(function_exists('wpb_resize')){
                      $img = wpb_resize($theimage, null, $imagewidth, null);
                      $thumbnail = $img['url'];
                      if($thumbnail=="") $thumbnail = $fullimage;
                  }
              }

              $thecontent = "";
              $attachment = get_post($theimage);
              if($onclick=="customlink"){
                if(isset($customlinks[$i])&&$customlinks[$i]!="") $image_str .= '<a href="'.$customlinks[$i].'" target="'.$customlinktarget.'" class="cq-accordioncover-link">';
              }else if($onclick=="lightbox"){
                if($imageLocation[0]!="") $image_str .= '<a href="'.$imageLocation[0].'" class="cq-accordioncover-link cq-accordioncover-lightbox">';
              }
              if($imageLocation[0]!=""){
                    $image_str .= '<div class="cq-accordioncover-item cq'.count($imagesArr).'" data-image="'.$thumbnail.'">';
                      $image_str .= '<div class="cq-accordioncover-background"></div>';
                      $image_str .= '<div class="cq-accordioncover-overlay">';
                      $image_str .= '<div class="cq-accordioncover-textcontainer">';
                      if(isset($titles[$i])&&$titles[$i]!=""){
                          $image_str .= '<h4 class="cq-accordioncover-title">';
                          $image_str .= $titles[$i];
                          $image_str .= '</h4>';
                      }
                      if(isset($contentarr[$i])&&$contentarr[$i]!=""){
                        $thecontent = $contentarr[$i];
                        $thecontent = preg_replace("/(^)?(<br\s*\/?>\s*)+$/", "", $thecontent);
                        $thecontent = preg_replace('/^(<br \/>)*/', "", $thecontent);
                        $thecontent = preg_replace('/^(<\/p>)*/', "", $thecontent);
                        $image_str .= '<p class="cq-accordioncover-content">';
                        $image_str .= $thecontent;
                        $image_str .= '</p>';
                      }
                      $image_str .= '</div>';
                      $image_str .= '</div>';
                      $image_str .= '</div>';
              }

              if($onclick=="customlink"){
                if(isset($customlinks[$i])&&$customlinks[$i]!="") $image_str .= '</a>';
              }else if($onclick=="lightbox"){
                if($imageLocation[0]!="") $image_str .= '</a>';
              }


          }

          $output .= $image_str;

          $output .= '</div>';
          return $output;

        }
  }

}

?>
