<?php
if (!class_exists('VC_Extensions_ImageWithArrow')) {

    class VC_Extensions_ImageWithArrow {
        function __construct() {
          vc_map( array(
            "name" => __("Image with Arrow", 'vc_imagewitharrow_cq'),
            "base" => "cq_vc_imagewitharrow",
            "class" => "wpb_cq_vc_extension_imagearrow",
            "controls" => "full",
            "icon" => "cq_allinone_imagearrow",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('Arrow point to caption', 'js_composer' ),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Image:", "vc_imagewitharrow_cq"),
                "param_name" => "image",
                "value" => "",
                "description" => __("Select images from media library.", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_imagewitharrow_cq",
                "heading" => __("Resize the image?", "vc_imagewitharrow_cq"),
                "param_name" => "isresize",
                "value" => array("no", "yes"),
                "std" => "no",
                "description" => __("", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width:", "vc_imagewitharrow_cq"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "description" => __("Default we will use the original image, specify a width here. For example, 600 will resize the image to width 600.", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_imagewitharrow_cq",
                "heading" => __("Open image as:", "vc_imagewitharrow_cq"),
                "param_name" => "openimageas",
                "value" => array(__("lightbox", "vc_imagewitharrow_cq") => "lightbox", __("link", "vc_imagewitharrow_cq") => "link", __("none", "vc_imagewitharrow_cq") => "none"),
                "description" => __("", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Display current image in a gallery:", "vc_imagewitharrow_cq"),
                "param_name" => "gallery",
                "value" => "",
                "description" => __("You can specify the same gallery name for the image if you want the lightbox image display in same gallery.", "vc_imagewitharrow_cq"),
                "dependency" => Array('element' => "openimageas", 'value' => array('lightbox'))
              ),
              array(
                "type" => "vc_link",
                "heading" => __("Image link", "vc_imagewitharrow_cq"),
                "param_name" => "imagelink",
                "value" => "",
                "dependency" => Array('element' => "openimageas", 'value' => array('link')),
                "description" => __("", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_imagewitharrow_cq",
                "heading" => __("Display the text content on the:", "vc_imagewitharrow_cq"),
                "param_name" => "captionalign",
                "value" => array(__("left", "vc_imagewitharrow_cq") => "left", __("right", "vc_imagewitharrow_cq") => "right", __("top", "vc_imagewitharrow_cq") => "top", __("bottom", "vc_imagewitharrow_cq") => "bottom"),
                "group" => "Text",
                "description" => __("", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Text", "vc_imagewitharrow_cq"),
                "param_name" => "content",
                "value" => __("Here is the content. You can change the background, content width, arrow position etc in the editor. Mauris ac lectus ut nullam.", "vc_imagewitharrow_cq"),
                "group" => "Text",
                "description" => __("", "vc_imagewitharrow_cq")
              ),

              // array(
              //   "type" => "dropdown",
              //   "heading" => __("Image link target", "vc_imagewitharrow_cq"),
              //   "param_name" => "image_link_target",
              //   "description" => __('Select where to open image link.', 'vc_imagewitharrow_cq'),
              //   "dependency" => Array('element' => "openimageas", 'value' => array('link')),
              //   'value' => array(__("Same window", "vc_imagewitharrow_cq") => "_self", __("New window", "vc_imagewitharrow_cq") => "_blank")
              // ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text color", 'vc_imagewitharrow_cq'),
                "param_name" => "textcolor",
                "value" => '#FFF',
                "group" => "Text",
                "description" => __("", 'vc_imagewitharrow_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text background color", 'vc_imagewitharrow_cq'),
                "param_name" => "textbg",
                "value" => '#4FC1E9',
                "group" => "Text",
                "description" => __("", 'vc_imagewitharrow_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Text content width, the percent value of the container width:", "vc_imagewitharrow_cq"),
                "param_name" => "twidth",
                "value" => "35%",
                "description" => __("You can specify the width the text content here, default is 35%, which means 35% of the whole container width. And the <strong>text width</strong> + <strong>image width</strong> (below) = <strong>100%</strong>.", "vc_imagewitharrow_cq"),
                "group" => "Text",
                "dependency" => Array('element' => "captionalign", 'value' => array('left', 'right'))
              ),
              array(
                "type" => "textfield",
                "heading" => __("Image width, the percent value of the container width:", "vc_imagewitharrow_cq"),
                "param_name" => "iwidth",
                "value" => "65%",
                "description" => __("You can specify the width the image here, default is 65%, which means 65% of the whole container width.", "vc_imagewitharrow_cq"),
                "group" => "Text",
                "dependency" => Array('element' => "captionalign", 'value' => array('left', 'right'))
              ),
              array(
                "type" => "textfield",
                "heading" => __("Text content height, the percent value of the container height:", "vc_imagewitharrow_cq"),
                "param_name" => "theight",
                "value" => "35%",
                "description" => __("You can specify the height the text content here, default is 35%, which means 35% of the whole container height. And the <strong>text height</strong> + <strong>image height</strong> (below) = <strong>100%</strong>.", "vc_imagewitharrow_cq"),
                "group" => "Text",
                "dependency" => Array('element' => "captionalign", 'value' => array('top', 'bottom'))
              ),
              array(
                "type" => "textfield",
                "heading" => __("Image height, the percent value of the container height:", "vc_imagewitharrow_cq"),
                "param_name" => "iheight",
                "value" => "65%",
                "description" => __("You can specify the height the image here, default is 65%, which means 65% of the whole container height.", "vc_imagewitharrow_cq"),
                "group" => "Text",
                "dependency" => Array('element' => "captionalign", 'value' => array('top', 'bottom'))
              ),
              array(
                "type" => "textfield",
                "heading" => __("Arrow position top", "vc_imagewitharrow_cq"),
                "param_name" => "arrowtop",
                "value" => "45%",
                "description" => __("Where to display the arrow, default is in the 45% height of the container.", "vc_imagewitharrow_cq"),
                "group" => "Text",
                "dependency" => Array('element' => "captionalign", 'value' => array('left', 'right'))
              ),
              array(
                "type" => "textfield",
                "heading" => __("Arrow position left", "vc_imagewitharrow_cq"),
                "param_name" => "arrowleft",
                "value" => "45%",
                "description" => __("Where to display the arrow, default is in the 45% width of the container.", "vc_imagewitharrow_cq"),
                "group" => "Text",
                "dependency" => Array('element' => "captionalign", 'value' => array('top', 'bottom'))
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_imagewitharrow_cq",
                "heading" => __("Arrow size:", "vc_imagewitharrow_cq"),
                "param_name" => "arrowsize",
                "value" => array(__("large", "vc_imagewitharrow_cq") => "large", __("small", "vc_imagewitharrow_cq") => ""),
                "description" => __("Default is large (20px), you can choose small (10px) too.", "vc_imagewitharrow_cq")
              ),
              // array(
              //   "type" => "checkbox",
              //   "holder" => "",
              //   "class" => "vc_imagewitharrow_cq",
              //   "heading" => __("Do not display hover label in thumbnail in small screen.", 'vc_imagewitharrow_cq'),
              //   "param_name" => "nothumblabel",
              //   "value" => array(__("Yes", "vc_imagewitharrow_cq") => 'on'),
              //   "description" => __("You may have to check this if you have a lot of thumbnails, otherwise the label may overlay the thumbnial.", 'vc_imagewitharrow_cq')
              // ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_imagewitharrow_cq",
                "heading" => __("Shape of whole element:", "vc_imagewitharrow_cq"),
                "param_name" => "elementshape",
                "value" => array(__("square", "vc_imagewitharrow_cq") => "", __("rounded (small)", "vc_imagewitharrow_cq") => "cq-imagewitharrow-smallround", __("rounded (large)", "vc_imagewitharrow_cq") => "cq-imagewitharrow-largeround"),
                "description" => __("Default is square.", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Container height", "vc_imagewitharrow_cq"),
                "param_name" => "height",
                "description" => __("The height of the whole container. For example 420px.", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Container margin", "vc_imagewitharrow_cq"),
                "param_name" => "containermargin",
                "description" => __("The CSS margin for the whole container. For example, 12px 0 0 0 will move the container 12px lower.", "vc_imagewitharrow_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Font size of the text.", "vc_imagewitharrow_cq"),
                "param_name" => "fontsize1",
                "value" => "",
                "group" => "Text",
                "description" => __("Font size for the main text content. Default is 1.1em.", "vc_imagewitharrow_cq")
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Font size in small container.", "vc_imagewitharrow_cq"),
              //   "param_name" => "fontsize2",
              //   "value" => "11px",
              //   "group" => "Text",
              //   "description" => __("Font size for the main text content when the container is in a small mode.", "vc_imagewitharrow_cq")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_imagewitharrow_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_imagewitharrow_cq")
              )

            )
        ));

        add_shortcode('cq_vc_imagewitharrow', array($this,'cq_vc_imagewitharrow_func'));

      }

      function cq_vc_imagewitharrow_func($atts, $content=null, $tag) {
          extract( shortcode_atts( array(
            'image' => '',
            'height' => '',
            'textcolor' => '#FFF',
            'textbg' => '#4FC1E9',
            'captionalign' => 'left',
            'twidth' => '35%',
            'theight' => '35%',
            'iwidth' => '65%',
            'iheight' => '65%',
            'arrowtop' => '45%',
            'arrowleft' => '45%',
            'containermargin' => '',
            'fontsize1' => '',
            // 'fontsize2' => '',
            'openimageas' => 'lightbox',
            'gallery' => '',
            'imagelink' => '',
            'isresize' => 'no',
            'imagewidth' => '',
            'image_link_target' => '',
            'elementshape' => 'square',
            'arrowsize' => 'large',
            'extra_class' => ''
          ), $atts ) );


          // wp_register_style( 'entypo', plugins_url('css/entypo.css', __FILE__) );
          // wp_enqueue_style( 'entypo' );
          wp_register_style( 'vc_imagewitharrow_cq_style', plugins_url('css/style.css', __FILE__));
          wp_enqueue_style( 'vc_imagewitharrow_cq_style' );

          wp_register_script('vc_imagewitharrow_cq_script', plugins_url('js/script.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('vc_imagewitharrow_cq_script');


          // if($openimageas=="lightbox"){
              wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
              wp_enqueue_script('fs.boxer');
              wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
              wp_enqueue_style('fs.boxer');
          // }

          $imageurl = wp_get_attachment_image_src($image, 'full');

          if($captionalign=="left"||$captionalign=="right") {
             $theight = '100%';
             $iheight = '100%';
          }

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';
          $px_height = strrpos($height, "px");
          if ($px_height === false) {
              $height = $height.'px';
          }
          $imagelink = vc_build_link($imagelink);
          $output .= '<div style="height:'.$height.';margin:'.$containermargin.';" class="cq-imgwitharrow-container '.$elementshape.' '.$captionalign.' '.$extra_class.'" data-color="'.$textcolor.'" data-background="'.$textbg.'" data-captionalign="'.$captionalign.'" data-arrowtop="'.$arrowtop.'" data-arrowleft="'.$arrowleft.'" data-fontsize1="'.$fontsize1.'" data-iwidth="'.$iwidth.'" data-iheight="'.$iheight.'" data-twidth="'.$twidth.'" data-theight="'.$theight.'" data-arrowsize="'.$arrowsize.'">';
          $gallery = str_replace(' ', '_', trim($gallery));
          $rel_for_lightbox = '';
          // $real_image_url = '';
          if($gallery!="") $rel_for_lightbox = 'rel='.$gallery;


          $img = $thumbnail = "";
          $fullimage = $imageurl[0];
          $thumbnail = $fullimage;
          if($isresize=="yes"&&$imagewidth!=""){
              if(function_exists('wpb_resize')){
                  $img = wpb_resize($image, null, $imagewidth, null);
                  $thumbnail = $img['url'];
                  if($thumbnail=="") $thumbnail = $fullimage;
              }
          }

          // if($isresize=="yes"&&$imagewidth!=""){
          //    $real_image_url = aq_resize($imageurl[0], $imagewidth, null, true, true, true);
          // }else{
          //    $real_image_url = $imageurl[0];
          // }

          if($captionalign=="left"||$captionalign=="right"){
              if($openimageas=="lightbox"){
                $output .= '<a href="'.$imageurl[0].'" class="cq-lightbox" '.$rel_for_lightbox.'><div class="cq-imgwitharrow-photo" data-url="'.$thumbnail.'" style="width:'.$iwidth.';height:'.$iheight.';"></div></a>';
              }else if($openimageas=="link"){
                if($imagelink["url"]!=="") $output .= '<a href="'.$imagelink["url"].'" target="'.$imagelink["target"].'" title="'.$imagelink["title"].'">';
                $output .= '<div class="cq-imgwitharrow-photo" data-url="'.$thumbnail.'" style="width:'.$iwidth.';height:'.$iheight.';"></div>';
                if($imagelink["url"]!=="") $output .= '</a>';
              }else{
                $output .= '<div class="cq-imgwitharrow-photo" data-url="'.$thumbnail.'" style="width:'.$iwidth.';height:'.$iheight.';"></div>';
              }
              $output .= '<div class="cq-imgwitharrow-box" style="width:'.$twidth.';height:'.$theight.';">';
          }else{
              if($openimageas=="lightbox"){
                $output .= '<a href="'.$imageurl[0].'" class="cq-lightbox" '.$rel_for_lightbox.'><div class="cq-imgwitharrow-photo" data-url="'.$thumbnail.'" style="height:'.$iheight.';"></div></a>';
              }else if($openimageas=="link"){
                // $output .= '<a href="'.$imagelink.'" target="'.$image_link_target.'"><div class="cq-imgwitharrow-photo" data-url="'.$thumbnail.'" style="height:'.$iheight.';"></div></a>';
                if($imagelink["url"]!=="") $output .= '<a href="'.$imagelink["url"].'" target="'.$imagelink["target"].'" title="'.$imagelink["title"].'">';
                $output .= '<div class="cq-imgwitharrow-photo" data-url="'.$thumbnail.'" style="height:'.$iheight.';"></div>';
                if($imagelink["url"]!=="") $output .= '</a>';

              }else{
                $output .= '<div class="cq-imgwitharrow-photo" data-url="'.$thumbnail.'" style="height:'.$iheight.';"></div>';
              }
              $output .= '<div class="cq-imgwitharrow-box" style="height:'.$theight.';">';
          }
          $output .= '<div class="cq-imgwitharrow-content"><p class="cq-content">
                        '.$content.'
                      </p></div>
                      ';

          $output .= '<div class="cq-arrowborder-container">
                            <div class="cq-arrowborder1"></div>
                            <div class="cq-arrowborder2"></div>
                            <div class="cq-arrowborder3"></div>
                          </div>';
          $output .= '</div>';
          $output .= '</div>';
          return $output;

        }


  }

}

?>
