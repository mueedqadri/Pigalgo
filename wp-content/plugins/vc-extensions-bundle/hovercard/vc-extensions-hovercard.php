<?php
if (!class_exists('VC_Extensions_HoverCard')) {
    class VC_Extensions_HoverCard{
        function __construct() {
            vc_map(array(
            "name" => __("Hover Card", 'vc_hovercard_cq'),
            "base" => "cq_vc_hovercard",
            "class" => "wpb_cq_vc_extension_hovercard",
            // "as_parent" => array('only' => 'cq_vc_hovercard_item'),
            "icon" => "cq_allinone_hovercard",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Animate caption with lightbox', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Display the background as:", "vc_hovercard_cq"),
                "param_name" => "bgtype",
                "value" => array("image", "solid color"=>"solidcolor", "radial gradient color"=>"radialgradient", "linear gradient color"=>"lineargradient"),
                "std" => "image",
                "group" => "Background",
                "description" => __("", "vc_hovercard_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Cover image:", "vc_hovercard_cq"),
                "param_name" => "image",
                "value" => "",
                "group" => "Background",
                "dependency" => Array('element' => "bgtype", 'value' => array('image')),
                "description" => __("Select image(s) from media library, support multiple images.", "vc_hovercard_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Resize the image?", "vc_hovercard_cq"),
                "param_name" => "isresize",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "group" => "Background",
                "dependency" => Array('element' => "bgtype", 'value' => array('image')),
                "description" => __("Select image(s) from media library, support multiple images.", "vc_hovercard_cq"),
                "description" => __("", "vc_hovercard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_hovercard_cq"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "group" => "Background",
                "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. ", "vc_hovercard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background color", 'vc_hovercard_cq'),
                "param_name" => "bgcolor",
                "value" => "#E6E9ED",
                "dependency" => Array('element' => "bgtype", 'value' => array('solidcolor')),
                "group" => "Background",
                "description" => __("Default is light gray.", 'vc_hovercard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background gradient color start with", 'vc_hovercard_cq'),
                "param_name" => "startcolor",
                "value" => "#499FCD",
                "dependency" => Array('element' => "bgtype", 'value' => array('radialgradient')),
                "group" => "Background",
                "description" => __("Default is #499FCD", 'vc_hovercard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background gradient color end with", 'vc_hovercard_cq'),
                "param_name" => "endcolor",
                "value" => "#1A69AA",
                "dependency" => Array('element' => "bgtype", 'value' => array('radialgradient')),
                "group" => "Background",
                "description" => __("Default is #1A69AA", 'vc_hovercard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background gradient color start with", 'vc_hovercard_cq'),
                "param_name" => "linearcolor1",
                "value" => "#499FCD",
                "dependency" => Array('element' => "bgtype", 'value' => array('lineargradient')),
                "group" => "Background",
                "description" => __("Default is #499FCD", 'vc_hovercard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background gradient color end with", 'vc_hovercard_cq'),
                "param_name" => "linearcolor2",
                "value" => "#1A69AA",
                "dependency" => Array('element' => "bgtype", 'value' => array('lineargradient')),
                "group" => "Background",
                "description" => __("Default is #1A69AA", 'vc_hovercard_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hovercard_cq",
                "heading" => __("Open the card as", "vc_hovercard_cq"),
                "param_name" => "linktype",
                "value" => array(__("Open lightbox (same image in large size)", "vc_hovercard_cq") => "lightbox", __("Open lightbox (custom URL, e.g. different image or YouTube/Vimeo video, specify URL below)", "vc_hovercard_cq") => "lightbox_custom",  __("Do nothing", "vc_hovercard_cq") => "none", __("Open custom link", "vc_hovercard_cq") => "customlink"),
                "std" => "none",
                "group" => "Link",
                "description" => __("", "vc_hovercard_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the whole card)', 'vc_hovercard_cq' ),
                'param_name' => 'cardlink',
                "dependency" => Array('element' => "linktype", 'value' => array('customlink')),
                'group' => 'Link',
                'description' => __( '', 'vc_hovercard_cq' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'lightbox URL, support image or YouTube/Vimeo video', 'vc_hovercard_cq' ),
                'param_name' => 'lightbox_url',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'group' => 'Link',
                'description' => __( 'Just copy and paste the page URL of the <strong>YouTube</strong> or <strong>Vimeo</strong> video, something like <strong>https://www.youtube.com/watch?v=pNSKQ9Qp36M&autoplay=1</strong> or <strong>https://vimeo.com/127081676?autoplay=1</strong>. Add the <strong>autoplay=1</strong> in the URL to auto play the video. Also support custom image link.', 'vc_hovercard_cq' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'video width, default is 640', 'vc_hovercard_cq' ),
                'param_name' => 'videowidth',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'value' => '640',
                'group' => 'Link',
                'description' => __( '', 'vc_hovercard_cq' )
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hovercard_cq",
                "heading" => __("How to display the caption", "vc_hovercard_cq"),
                "param_name" => "captiontype",
                "value" => array(__("Display the title and subtitle, hide the icon (visible when user hover)", "vc_hovercard_cq") => "hideicon", __("Hide them all (visible when user hover)", "vc_hovercard_cq") => "hideall", __("Display all without hover effect", "vc_hovercard_cq") => "showall"),
                "std" => "hideicon",
                "group" => "Caption",
                "description" => __("", "vc_hovercard_cq")
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_hovercard_cq",
                "heading" => __("Title (optional)", 'vc_hovercard_cq'),
                "param_name" => "title",
                "value" => __("", 'vc_hovercard_cq'),
                "group" => "Caption",
                "description" => __("", 'vc_hovercard_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_hovercard_cq",
                "heading" => __("Sub title (optional)", 'vc_hovercard_cq'),
                "param_name" => "subtitle",
                "value" => __("", 'vc_hovercard_cq'),
                "group" => "Caption",
                "description" => __("", 'vc_hovercard_cq')
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'js_composer' ),
                'value' => array(
                  __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                  __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                  __( 'Typicons', 'js_composer' ) => 'typicons',
                  __( 'Entypo', 'js_composer' ) => 'entypo',
                  __( 'Linecons', 'js_composer' ) => 'linecons',
                  __( 'Material', 'js_composer' ) => 'material',
                ),
                'admin_label' => true,
                'param_name' => 'captionicon',
                "group" => "Caption",
                'description' => __( 'Select icon library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-share', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'fontawesome',
                ),
                "group" => "Caption",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'openiconic',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'openiconic',
                ),
                "group" => "Caption",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'typicons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'typicons',
                ),
                "group" => "Caption",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                "group" => "Caption",
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'entypo',
                ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'linecons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'linecons',
                ),
                "group" => "Caption",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_material',
                'value' => 'vc-material vc-material-cake',
                // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false,
                  // default true, display an "EMPTY" icon?
                  'type' => 'material',
                  'iconsPerPage' => 4000,
                  // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'material',
                ),
                "group" => "Caption",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Icon animation", "vc_hovercard_cq"),
                "param_name" => "iconanimation",
                "value" => array("rotate", "rotateY", "rotateX"),
                "std" => "rotateY",
                "group" => "Caption",
                "description" => __("", "vc_hovercard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text color of the caption", 'vc_hovercard_cq'),
                "param_name" => "contentcolor",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default is white.", 'vc_hovercard_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color of the caption", 'vc_hovercard_cq'),
                "param_name" => "iconcolor",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default is white.", 'vc_hovercard_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Caption offset", "vc_hovercard_cq"),
                "param_name" => "captionoffset",
                "value" => "",
                "group" => "Caption",
                "description" => __("Default the caption is align middle (<strong>50%</strong>), you can specify other value to move it upper(e.g. <strong>30%</strong>) or lower(e.g. <strong>70%</strong>)", "vc_hovercard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Element height", "vc_hovercard_cq"),
                "param_name" => "bgheight",
                "value" => "240",
                "description" => __("The height of whole element, only available with color background, default is <strong>240</strong> (in pixel).", "vc_hovercard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("margin of the lightbox margin", "vc_hovercard_cq"),
                "param_name" => "lightboxmargin",
                "value" => "",
                "description" => __("The margin of the lightbox image, default is <strong>20</strong> (in pixel).", "vc_hovercard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_hovercard_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_hovercard_cq")
              )

           )
        ));

        add_shortcode('cq_vc_hovercard', array($this,'cq_vc_hovercard_func'));

      }

      function cq_vc_hovercard_func($atts, $content=null, $tag) {
          $captionicon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_material = '';
          extract(shortcode_atts(array(
            "image" => "",
            "imagewidth" => "",
            "bgtype" => "image",
            "iconanimation" => "rotateY",
            "startcolor" => "#499FCD",
            "endcolor" => "#1A69AA",
            "linearcolor1" => "#499FCD",
            "linearcolor2" => "#1A69AA",
            "captionicon" => "fontawesome",
            "icon_fontawesome" => 'fa fa-share',
            "icon_openiconic" => 'vc-oi vc-oi-dial',
            "icon_typicons" => 'typcn typcn-adjust-brightness',
            "icon_entypo" => 'entypo-icon entypo-icon-note',
            "icon_linecons" => 'vc_li vc_li-heart',
            "icon_material" => 'vc-material vc-material-cake',
            "isresize" => "no",
            "bgcolor" => "#E6E9ED",
            "bgheight" => "240",
            "title" => "",
            "subtitle" => "",
            "contentcolor" => "",
            "iconcolor" => "",
            "captionoffset" => "",
            "captiontype" => "hideicon",
            "lightboxmargin" => "",
            "linktype" => "",
            "lightbox_url" => "",
            "videowidth" => "640",
            "cardlink" => "",
            "extraclass" => ""
          ), $atts));


          vc_icon_element_fonts_enqueue('linecons');
          if(version_compare(WPB_VC_VERSION,  "4.4")>= 0){
              vc_icon_element_fonts_enqueue($captionicon);
          }else{
              // wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
              // wp_enqueue_style( 'font-awesome' );
          }


          // $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          // $content = str_replace("<p></p>", "", $content);

          wp_register_style('formstone-lightbox', plugins_url('../videocover/css/lightbox.css', __FILE__));
          wp_enqueue_style('formstone-lightbox');
          wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('fs.boxer');
          wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
          wp_enqueue_style('fs.boxer');

          wp_register_style( 'vc-extensions-hovercard-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-hovercard-style' );

          wp_register_script('formstone-lightbox', plugins_url('../videocover/js/lightbox.js', __FILE__));
          wp_enqueue_script('formstone-lightbox');

          wp_register_script('vc-extensions-hovercard-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "fs.boxer", "formstone-lightbox"));
          wp_enqueue_script('vc-extensions-hovercard-script');

          $attachment = get_post($image);
          $image_full = wp_get_attachment_image_src($image, 'full');
          $cardlink = vc_build_link($cardlink);
          $content = str_replace('[/captionitem]', '', trim($content));
          $contentarr = explode('[captionitem]', trim($content));
          array_shift($contentarr);

          $i = -1;
          $output = "";
          if($bgtype=="solidcolor"){
              $output .= '<div class="cq-hovercard cq-'.$iconanimation.' '.$extraclass.' cq-hovercard-'.$captiontype.'" data-contentcolor="'.$contentcolor.'" data-iconcolor="'.$iconcolor.'" data-bgheight="'.$bgheight.'" data-captionoffset="'.$captionoffset.'" data-videowidth="'.$videowidth.'" data-linktype="'.$linktype.'" style="background:'.$bgcolor.';height:'.$bgheight.'px" data-bgtype="'.$bgtype.'" data-lightboxmargin="'.$lightboxmargin.'">';
          }else if($bgtype=="radialgradient"){
              $output .= '<div class="cq-hovercard cq-'.$iconanimation.' '.$extraclass.' cq-hovercard-'.$captiontype.'" data-contentcolor="'.$contentcolor.'" data-iconcolor="'.$iconcolor.'" data-bgheight="'.$bgheight.'" data-captionoffset="'.$captionoffset.'" data-videowidth="'.$videowidth.'" data-linktype="'.$linktype.'" style="background:'.$startcolor.';background:-ms-radial-gradient(center, ellipse cover, '.$startcolor.' 0%, '.$endcolor.' 100%);background:-moz-radial-gradient(center, ellipse cover, '.$startcolor.' 0%, '.$endcolor.' 100%);background:-webkit-radial-gradient(center, ellipse cover, '.$startcolor.' 0%, '.$endcolor.' 100%);background:radial-gradient(center, ellipse cover, '.$startcolor.' 0%, '.$endcolor.' 100%);height:'.$bgheight.'px" data-bgtype="'.$bgtype.'" data-lightboxmargin="'.$lightboxmargin.'">';
          }else if($bgtype=="lineargradient"){
              $output .= '<div class="cq-hovercard cq-'.$iconanimation.' '.$extraclass.' cq-hovercard-'.$captiontype.'" data-contentcolor="'.$contentcolor.'" data-iconcolor="'.$iconcolor.'" data-bgheight="'.$bgheight.'" data-captionoffset="'.$captionoffset.'" data-videowidth="'.$videowidth.'" data-linktype="'.$linktype.'" style="background:'.$startcolor.';background-image: linear-gradient( '.$linearcolor1.', '.$linearcolor2.');height:'.$bgheight.'px" data-bgtype="'.$bgtype.'" data-lightboxmargin="'.$lightboxmargin.'">';
          }else{
              $output .= '<div class="cq-hovercard cq-'.$iconanimation.' '.$extraclass.' cq-hovercard-'.$captiontype.'" data-contentcolor="'.$contentcolor.'" data-iconcolor="'.$iconcolor.'" data-bgheight="'.$bgheight.'" data-captionoffset="'.$captionoffset.'" data-videowidth="'.$videowidth.'" data-linktype="'.$linktype.'" data-bgtype="'.$bgtype.'" data-lightboxmargin="'.$lightboxmargin.'">';
          }
          if($linktype=="lightbox"){
              $output .= '<a href="'.$image_full[0].'" class="cq-hovercard-lightbox">';
          }else if($linktype=="lightbox_custom"){
              $output .= '<a href="'.$lightbox_url.'" class="cq-hovercard-lightbox" title="">';
          }else if($linktype=="customlink"){
            if($cardlink["url"]!=="") $output .= '<a href="'.$cardlink["url"].'" title="'.$cardlink["title"].'" target="'.$cardlink["target"].'" class="cq-hovercard-customlink">';
          }

          $image_temp = $imagethumb = "";
          $fullimage = $image_full[0];
          $imagethumb = $fullimage;
          if($imagewidth!=""&&$isresize=="yes"){
              if(function_exists('wpb_resize')){
                  $image_temp = wpb_resize($image, null, $imagewidth, null);
                  $imagethumb = $image_temp['url'];
                  if($imagethumb=="") $imagethumb = $fullimage;
              }
          }

          if($image_full[0]!=""){
              $output .= '<img src="'.$imagethumb.'" class="cq-hovercard-background" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />';

          }
          $output .= '<div class="cq-hovercard-textcontainer">';
          if($title!=""){
              $output .= '<div class="cq-hovercard-title">';
              $output .= $title;
              $output .= '</div>';
          }
          if($subtitle!=""){
              $output .= '<div class="cq-hovercard-content">';
              $output .= $subtitle;
              $output .= '</div>';
          }
          if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $captionicon})){
              $output .= '<i class="cq-hovercard-icon '.esc_attr(${'icon_' . $captionicon}).'"></i>';
          }
          $output .= '</div>';


          if($linktype=="lightbox" || $linktype=="lightbox_custom" || $linktype=="customlink"){
              $output .= '</a>';
          }
          $output .= '</div>';
          return $output;

        }

  }

}

?>
