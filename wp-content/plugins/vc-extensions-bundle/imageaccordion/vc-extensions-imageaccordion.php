<?php
if (!class_exists('VC_Extensions_ImageAccordion')) {
    class VC_Extensions_ImageAccordion{
        function __construct() {
            vc_map(array(
            "name" => __("Image Accordion", 'vc_imageaccordion_cq'),
            "base" => "cq_vc_imageaccordion",
            "class" => "wpb_cq_vc_extension_imageaccordion",
            // "as_parent" => array('only' => 'cq_vc_imageaccordion_item'),
            "icon" => "cq_allinone_imageaccordion",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Optional caption', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Images", "vc_imageaccordion_cq"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select all the images for accordion from media library.", "vc_imageaccordion_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_imageaccordion_cq",
                "heading" => __("Resize the image?", "vc_imageaccordion_cq"),
                "param_name" => "isresize",
                "value" => array("no", "yes"),
                "std" => "no",
                "description" => __("", "vc_imageaccordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_imageaccordion_cq"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "description" => __("Default we will use the original image, specify a width here. For example, 600 will resize the image to width 600.", "vc_imageaccordion_cq")
              ),
              // array(
              //   "type" => "dropdown",
              //   "holder" => "",
              //   "class" => "vc_imageaccordion_cq",
              //   "heading" => __("Auto slide?", "vc_imageaccordion_cq"),
              //   "param_name" => "autoslide",
              //   'value' => array(2, 3, 4, 5, 6, 8, 10, __( 'Disable', 'vc_imageaccordion_cq' ) => 0 ),
              //   'std' => 0,
              //   "description" => __("Auto slide in each X seconds.", "vc_imageaccordion_cq")
              // ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_imageaccordion_cq",
                "heading" => __("Caption title (optional) for each image", 'vc_imageaccordion_cq'),
                "param_name" => "captiontitles",
                "value" => __("", 'vc_imageaccordion_cq'),
                "group" => 'Caption',
                "description" => __("Optional caption title for each image. Divide each with linebreaks (Enter)", 'vc_imageaccordion_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Font size of the caption title", "vc_imageaccordion_cq"),
                "param_name" => "titlesize",
                "value" => "",
                "group" => 'Caption',
                "description" => __("Default is 1.5em, you can specify other value here.", "vc_imageaccordion_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Optional caption content under each image, wrap each one inside the [accordiondesc][/accordiondesc].", "vc_imageaccordion_cq"),
                "param_name" => "content",
                "group" => 'Caption',
                "value" => __("", "vc_imageaccordion_cq"), "description" => __("Please try to edit in the text mode.", "vc_imageaccordion_cq"),
                "description" => __("Please try to edit in the text mode.", "vc_imageaccordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Font size of the caption content", "vc_imageaccordion_cq"),
                "param_name" => "contentsize",
                "value" => "",
                "group" => 'Caption',
                "description" => __("Default is 1em, you can specify other value here.", "vc_imageaccordion_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_imageaccordion_cq",
                "heading" => __("Link (optional) for each image", 'vc_imageaccordion_cq'),
                "param_name" => "imagelinks",
                "value" => __("", 'vc_imageaccordion_cq'),
                "description" => __("Optional link for each image. Divide each with linebreaks (Enter)", 'vc_imageaccordion_cq')
              ),
              array(
                "type" => "dropdown",
                "heading" => __("How to open the link", "vc_imageaccordion_cq"),
                "param_name" => "imagelinktarget",
                "description" => __('Select how to open the image link', 'vc_imageaccordion_cq'),
                'value' => array(__("Same window", "vc_imageaccordion_cq") => "_self", __("New window", "vc_imageaccordion_cq") => "_blank")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_imageaccordion_cq",
                "heading" => __("Caption background style:", "vc_imageaccordion_cq"),
                "param_name" => "captionbgstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'darkgray',
                "group" => 'Caption',
                "description" => __("", "vc_imageaccordion_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Caption background color", 'vc_imageaccordion_cq'),
                "param_name" => "captionbgcolor",
                "value" => '',
                "dependency" => Array('element' => "captionbgstyle", 'value' => array('customized')),
                "group" => 'Caption',
                "description" => __("", 'vc_imageaccordion_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Caption text color", 'vc_imageaccordion_cq'),
                "param_name" => "captiontextcolor",
                "value" => '',
                "group" => 'Caption',
                "description" => __("Default is white.", 'vc_imageaccordion_cq')
              ),
              // array(
              //   "type" => "dropdown",
              //   "heading" => __("When user hover, display other accordion in:", "vc_imageaccordion_cq"),
              //   "param_name" => "accordionsize",
              //   'value' => array(__("small", "vc_imageaccordion_cq") => "", __("large", "vc_imageaccordion_cq") => "cq-accordion-large", __("none (display current accordion in full width without other accordion)", "vc_imageaccordion_cq") => "cq-accordion-none"),
              //   "description" => __('', 'vc_imageaccordion_cq')
              // ),
              // array(
              //   "type" => "checkbox",
              //   "holder" => "",
              //   "class" => "vc_imageaccordion_cq",
              //   "heading" => __("Unfold first accordion?", 'vc_imageaccordion_cq'),
              //   "param_name" => "unfoldfirst",
              //   "value" => array(__("Yes, unfold first accordion.", "vc_imageaccordion_cq") => 'cq-imageaccordion-unfoldfirst'),
              //   "dependency" => Array('element' => "accordionsize", 'value' => array('', 'cq-accordion-large')),
              //   "description" => __("All accordions are folded by default, you can check this to unfold first accordion by default.", 'vc_imageaccordion_cq')
              // ),
              array(
                "type" => "textfield",
                "heading" => __("Element height", "vc_imageaccordion_cq"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("The height of the whole element(image). Default is 450. You can specify other value here.", "vc_imageaccordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_imageaccordion_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_imageaccordion_cq")
              )

           )
        ));

        add_shortcode('cq_vc_imageaccordion', array($this,'cq_vc_imageaccordion_func'));

      }


    function cq_vc_imageaccordion_func($atts, $content=null, $tag) {
          extract(shortcode_atts(array(
            "images" => '',
            "link" => '',
            // "autoslide" => '',
            "captionbgstyle" => 'darkgray',
            "imagelinks" => '',
            "imagelinktarget" => '',
            "isresize" => 'no',
            "imagewidth" => '',
            "captiontitles" => '',
            "titlesize" => '',
            "contentsize" => '',
            "elementheight" => '',
            "accordionsize" => 'cq-accordion-none',
            "unfoldfirst" => '',
            "captionbgcolor" => '',
            "captiontextcolor" => '',
            "extraclass" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $content = str_replace('[/accordiondesc]', '', trim($content));
          $contentarr = explode('[accordiondesc]', trim($content));
          array_shift($contentarr);
          $output = '';

          // omit these options first, waiting for fixing IE width bug
          $accordionsize = 'cq-accordion-none';
          $unfoldfirst = 'no';

          $color_style_arr = array("grapefruit" => array("#ED5565", "#DA4453"), "bittersweet" => array("#FC6E51", "#E9573F"), "sunflower" => array("#FFCE54", "#F6BB42"), "grass" => array("#A0D468", "#8CC152"), "mint" => array("#48CFAD", "#37BC9B"), "aqua" => array("#4FC1E9", "#3BAFDA"), "bluejeans" => array("#5D9CEC", "#4A89DC"), "lavender" => array("#AC92EC", "#967ADC"), "pinkrose" => array("#EC87C0", "#D770AD"), "lightgray" => array("#F5F7FA", "#E6E9ED"), "mediumgray" => array("#CCD1D9", "#AAB2BD"), "darkgray" => array("#656D78", "#000000"), "customized" => array("$captionbgcolor", "$captionbgcolor") );

          $captionstyle_arr = $color_style_arr[$captionbgstyle];

          // $link = vc_build_link($link);

          wp_register_style( 'vc-extensions-imageaccordion-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-imageaccordion-style' );
          wp_enqueue_script('vc-extensions-imageaccordion-script');
          wp_register_script('vc-extensions-imageaccordion-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-imageaccordion-script');
          $imagesArr = explode(',', $images);
          $imagelinks = explode(',', $imagelinks);
          $captiontitles = explode(',', $captiontitles);
          $output = '';
          $output .= '<div class="cq-imageaccordion cq-imageaccordion-itemnum'.count($imagesArr).' '.$accordionsize.' '.$unfoldfirst.' '.$extraclass.'" data-titlesize="'.$titlesize.'" data-contentsize="'.$contentsize.'" data-elementheight="'.$elementheight.'" data-unfoldfirst="'.$unfoldfirst.'" data-captionbgstyle="'.$captionbgstyle.'" data-captionbgcolor="'.$captionstyle_arr[1].'" data-captiontextcolor="'.$captiontextcolor.'">';
          $output .= '<ul class="cq-imageaccordion-list">';
          $i = -1;
          foreach ($imagesArr as $key => $theimage) {
              $i++;
              $imageLocation = wp_get_attachment_image_src($theimage, 'full');
              $img = $thumbnail = "";
              $fullimage = $imageLocation[0];
              $thumbnail = $fullimage;
              if($imagewidth!=""&&$isresize=="yes"){
                  if(function_exists('wpb_resize')){
                      $img = wpb_resize($theimage, null, $imagewidth, null);
                      $thumbnail = $img['url'];
                      if($thumbnail=="") $thumbnail = $fullimage;
                  }
              }

              if($isresize=="yes"&&$imagewidth!=""){
                  $output .= '<li class="cq-imageaccordion-listitem" data-image="'.$thumbnail.'">';
              }else{
                  $output .= '<li class="cq-imageaccordion-listitem" data-image="'.$imageLocation[0].'">';
              }
              $output .= '<div class="cq-imageaccordion-itemcontainer">';
              if(isset($imagelinks[$i])&&$imagelinks[$i]!="") $output .= '<a href="'.$imagelinks[$i].'" target="'.$imagelinktarget.'" class="cq-imageaccordion-link">';
              if(isset($contentarr[$i])){
                  $accordiondesc = preg_replace("/(^)?(<br\s*\/?>\s*)+$/", "", $contentarr[$i]);
                  $accordiondesc = preg_replace('/^(<br \/>)*/', "", $accordiondesc);
                  $accordiondesc = preg_replace('/^(<\/p>)*/', "", $accordiondesc);
                  if($accordiondesc!=""||(isset($captiontitles[$i])&&$captiontitles[$i]!="")){
                      $output .= '<div class="cq-imageaccordion-caption">';
                      if(isset($captiontitles[$i])&&$captiontitles[$i]!=""){
                        $output .= '<h3 class="cq-imageaccordion-title">'.$captiontitles[$i].'</h3>';
                      }
                      if(isset($contentarr[$i])&&$contentarr[$i]!=""){
                        $output .= '<p class="cq-imageaccordion-content">'.$contentarr[$i].'</p>';
                      }
                      $output .= '</div>';

                  }

              }

              if(isset($imagelinks[$i])&&$imagelinks[$i]!="") $output .= '</a>';
              $output .= '</div>';
              $output .= '</li>';

          }

          $output .= '</ul>';
          $output .= '</div>';
          return $output;

        }



  }

}

?>
