<?php
if (!class_exists('VC_Extensions_BorderHover')){
    class VC_Extensions_BorderHover{
        function __construct() {
            vc_map(array(
            "name" => __("Border Hover", 'cq_allinone_vc'),
            "base" => "cq_vc_borderhover",
            "class" => "cq_vc_borderhover",
            "controls" => "full",
            "icon" => "cq_vc_borderhover",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            "show_settings_on_create" => true,
            'description' => __('Hover image with border', 'js_composer'),
            "params" => array(
              array(
                "type" => "textfield",
                "heading" => __("Element height", "cq_allinone_vc"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("The height of the image (in pixel), default is <strong>240</strong>(px) (leave it to be blank). min-height is 200px.", "cq_allinone_vc")
              ),
              array(
                  "type" => "attach_image",
                  "heading" => __("Image", "cq_allinone_vc"),
                  "param_name" => "image",
                  "value" => "",
                  "description" => __("Select from media library.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Resize the image?", "cq_allinone_vc"),
                 "param_name" => "isresize",
                 "value" => array("no", "yes"),
                 "std" => "no",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this size: ", "cq_allinone_vc"),
                "param_name" => "imagesize",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "description" => __("Width in pixel.", "cq_allinone_vc")
      		    ),
	            array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Border type when user hover", "cq_allinone_vc"),
                 "param_name" => "bordertype",
                 "value" => array("solid", "dashed", "dotted", "none"),
                 "std" => "solid",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Border animation style", "cq_allinone_vc"),
                 "param_name" => "borderanimation",
                 "value" => array("cross hand 1" => "crosshand1", "cross hand 2" => "crosshand3", "clock wise" => "crosshand2", "anti clock wise" => "crosshand4"),
                 "std" => "crosshand1",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Border color", "cq_allinone_vc"),
                "param_name" => "bordercolor",
                "value" => "",
                "description" => __("Default is white.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Titile (optional).", "cq_allinone_vc"),
                "param_name" => "title",
                "value" => "",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("font size of the title", "cq_allinone_vc"),
                "param_name" => "titlesize",
                "value" => "",
                "description" => __("Default is 14px, support other value like 1.2em etc.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Title color", "cq_allinone_vc"),
                "param_name" => "titlecolor",
                "value" => "",
                "description" => __("Default is dark gray.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label under the title (optional).", "cq_allinone_vc"),
                "param_name" => "label",
                "value" => "",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("font size of the label", "cq_allinone_vc"),
                "param_name" => "labelsize",
                "value" => "",
                "description" => __("Default is 14px, support other value like 1.2em etc.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Label color", "cq_allinone_vc"),
                "param_name" => "labelcolor",
                "value" => "",
                "description" => __("Default is dark gray.", "cq_allinone_vc")
              ),
              array(
                "type" => "checkbox",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Hide the short border under the title?", "cq_allinone_vc"),
                "param_name" => "hidetitleborder",
                "value" => "no",
                "description" => __("There is small border under the title by default. You can check here to hide them.", "cq_allinone_vc")
              ),
              array(
                "type" => "checkbox",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Hide the caption by default?", "cq_allinone_vc"),
                "param_name" => "hidetext",
                "value" => "no",
                "description" => __("The caption is displayed by default. You can check here to hide them, and display while user mouse hover.", "cq_allinone_vc")
              ),
              array(
                "type" => "checkbox",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Add transparent gray overlay to the image when user hover?", "cq_allinone_vc"),
                "param_name" => "isoverlay",
                "value" => "no",
                "dependency" => Array('element' => "hidetext", 'value' => array('true')),
                "description" => __("There is no transparent gray overlay by default. Check here is you want it.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Overlay color", "cq_allinone_vc"),
                "param_name" => "overlaycolor",
                "dependency" => Array('element' => "isoverlay", 'value' => array('true')),
                "value" => "",
                "description" => __("Default is transparent gray.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "cq_allinone_vc"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Open the link as", "cq_allinone_vc"),
                "param_name" => "linktype",
                "value" => array(__("Open lightbox (same image in large size)", "cq_allinone_vc") => "lightbox", __("Custom lightbox (support different image or YouTube/Vimeo video too, specify URL below)", "cq_allinone_vc") => "lightbox_custom", __("Custom link (specify link below)", "cq_allinone_vc") => "url_custom",  __("Do nothing", "cq_allinone_vc") => "none"),
                "std" => "none",
                "group" => "Link",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Select lightbox mode", "cq_allinone_vc"),
                "param_name" => "lightboxmode",
                "value" => array(__("prettyPhoto", "cq_allinone_vc") => "prettyphoto", __("boxer", "cq_allinone_vc") => "boxer"),
                "std" => "boxer",
                "group" => "Link",
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox')),
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'custom URL', 'cq_allinone_vc' ),
                'param_name' => 'custom_url',
                "dependency" => Array('element' => "linktype", 'value' => array('url_custom')),
                'group' => 'Link',
                'description' => __( '', 'cq_allinone_vc' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'lightbox URL, support image or YouTube/Vimeo video', 'cq_allinone_vc' ),
                'param_name' => 'lightbox_url',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'group' => 'Link',
                'description' => __( 'Just copy and paste the page URL of the <strong>YouTube</strong> or <strong>Vimeo</strong> video, something like <strong>https://www.youtube.com/watch?v=pNSKQ9Qp36M&autoplay=1</strong> or <strong>https://vimeo.com/127081676?autoplay=1</strong>. Add the <strong>autoplay=1</strong> in the URL to auto play the video. Also support custom image link. ', 'cq_allinone_vc' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'video width, default is 640', 'cq_allinone_vc' ),
                'param_name' => 'videowidth',
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox_custom')),
                'value' => '640',
                'group' => 'Link',
                'description' => __( '', 'cq_allinone_vc' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("lightbox margin", "cq_allinone_vc"),
                "param_name" => "lightboxmargin",
                "value" => "",
                "dependency" => Array('element' => "linktype", 'value' => array('lightbox', 'lightbox_custom')),
                'group' => 'Link',
                "description" => __("The margin of the lightbox image, default is <strong>20</strong> (in pixel).", "cq_allinone_vc")
              ),
              array(
                "type" => "css_editor",
                "heading" => __( "CSS", "cq_allinone_vc" ),
                "param_name" => "css",
                "description" => __("It's recommended to use this to customize the background only.", "cq_allinone_vc"),
                "group" => __( "Design options", "cq_allinone_vc" ),
             )
           )
        ));


        add_shortcode('cq_vc_borderhover', array($this,'cq_vc_borderhover_func'));

      }

      function cq_vc_borderhover_func($atts, $content=null) {
        $titlesize = $labelsize = $elementheight = $title = $titlecolor = $label = $labelsize = $labelcolor = $tolerance = $css_class = $css = $hidetext = $linktype = $lightboxmode = $custom_url = $lightboxmargin = $lightbox_url = $videowidth = $bordertype = $borderanimation = $isoverlay = $overlaycolor = $bordercolor = $hidetitleborder = $extraclass = '';
        extract(shortcode_atts(array(
          "image" => "",
          "isresize" => "",
          "imagesize" => "",
          "title" => "",
          "label" => "",
          "titlesize" => "",
          "titlecolor" => "",
          "labelsize" => "",
          "labelcolor" => "",
          "elementheight" => "",
          "tolerance" => "14",
          "link" => "",
          "css" => "",
          "hidetext" => "",
          "linktype" => "none",
          "lightboxmargin" => "",
          "lightboxmode" => "boxer",
          "lightbox_url" => "",
          "videowidth" => "640",
          "custom_url" => "",
          "bordertype" => "solid",
          "borderanimation" => "crosshand1",
          "isoverlay" => "",
          "overlaycolor" => "",
          "bordercolor" => "",
          "hidetitleborder" => "",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_borderhover', $atts);
        wp_register_style( 'vc-extensions-borderhover-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-borderhover-style' );

        wp_register_style('formstone-lightbox', plugins_url('../videocover/css/lightbox.css', __FILE__));
        wp_enqueue_style('formstone-lightbox');
        wp_register_style('fs.boxer', plugins_url('../depthmodal/css/jquery.fs.boxer.css', __FILE__));
        wp_enqueue_style('fs.boxer');

        wp_register_style('prettyphoto', vc_asset_url( 'lib/prettyphoto/css/prettyPhoto.min.css' ), array(), WPB_VC_VERSION );
        wp_enqueue_style('prettyphoto');

        wp_register_script('fs.boxer', plugins_url('../depthmodal/js/jquery.fs.boxer.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('fs.boxer');
        wp_register_script('formstone-lightbox', plugins_url('../videocover/js/lightbox.js', __FILE__));
        wp_enqueue_script('formstone-lightbox');
        wp_register_script('prettyphoto', vc_asset_url( 'lib/prettyphoto/js/prettyPhoto.min.js' ), array(), WPB_VC_VERSION );
        wp_enqueue_script('prettyphoto');

        // wp_register_script('modernizr-custom-objectfit', plugins_url('js/modernizr-custom.min.js', __FILE__));
        // wp_enqueue_script('modernizr-custom-objectfit');

        wp_register_script('vc-extensions-borderhover-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "fs.boxer", "formstone-lightbox", "prettyphoto"));
        wp_enqueue_script('vc-extensions-borderhover-script');

        $custom_url = vc_build_link($custom_url);

        $img1 = $thumb_image = "";

        $full_image = wp_get_attachment_image_src($image, 'full');
        $thumb_image = $full_image[0];
        if($isresize=="yes"&&$imagesize!=""){
            if(function_exists('wpb_resize')){
                $img1 = wpb_resize($image, null, $imagesize, null);
                $thumb_image = $img1['url'];
                if($thumb_image=="") $thumb_image = $full_image[0];
            }
        }


        $output = "";
      	$output .= '<div class="cq-borderhover cq-bordertype-'.$bordertype.' cq-borderhover-hidetext'.$hidetext.' '.$extraclass.' '.$css_class.'" data-tolerance="'.$tolerance.'" data-elementheight="'.$elementheight.'" data-titlesize="'.$titlesize.'" data-labelsize="'.$labelsize.'" data-titlecolor="'.$titlecolor.'" data-overlaycolor="'.$overlaycolor.'" data-lightboxmargin="'.$lightboxmargin.'" data-bordercolor="'.$bordercolor.'">';
        $output .= '<div class="cq-borderhover-item cq-'.$borderanimation.'">';
        $output .= '<div class="cq-borderhover-background" style="background:url('.$thumb_image.');background-size:cover;background-position:center center;"></div>';
        $gallery_rand_id = "prettyPhoto";
        if($linktype=="lightbox"){
              // if($iscaption=="yes"){
              //     if($lightboxmode=="prettyphoto"){
              //         $output .= '<a href="'.$full_image[0].'" data-rel="'.$gallery_rand_id.'" class="cq-borderhover-link cq-borderhover-prettyphoto" title="'.esc_html($tooltip).'" rel="'.$gallery_rand_id.'" data-linktype="'.$linktype.'">';
              //     }else{
              //         $output .= '<a href="'.$full_image[0].'" class="cq-borderhover-link cq-borderhover-lightbox" title="'.esc_html($tooltip).'" data-linktype="'.$linktype.'">';
              //     }
              // }else{
                  if($lightboxmode=="prettyphoto"){
                        $output .= '<a href="'.$full_image[0].'" data-rel="'.$gallery_rand_id.'" class="cq-borderhover-link cq-borderhover-prettyphoto" rel="'.$gallery_rand_id.'" data-linktype="'.$linktype.'">';
                  }else{
                        $output .= '<a href="'.$full_image[0].'" class="cq-borderhover-link cq-borderhover-lightbox" data-linktype="'.$linktype.'">';
                   }
              // }
          }else if($linktype=="lightbox_custom"){
              if(isset($lightbox_url)){
                  $output .= '<a href="'.$lightbox_url.'" class="cq-borderhover-link cq-borderhover-lightbox" data-linktype="'.$linktype.'" data-videowidth="'.$videowidth.'">';
              }
          }else {
              if(isset($custom_url['url'])){
                  $output .= '<a href="'.$custom_url['url'].'" class="cq-borderhover-link" title="'.$custom_url["title"].'" target="'.$custom_url["target"].'" rel="'.$custom_url["rel"].'">';
              }else{

                  $output .= '<a href="" class="cq-borderhover-link">';
              }
          }

        if($isoverlay!=""&&$hidetext!="")$output .= '<div class="cq-borderhover-overlay" style="background-color:'.$overlaycolor.'">';

        $output .= '<span class="cq-borderhover-leftborder"></span>
                    <span class="cq-borderhover-topborder"></span>
                    <span class="cq-borderhover-rightborder"></span>
                    <span class="cq-borderhover-bottomborder"></span>';
        $output .= '<div class="cq-borderhover-textcontainer">';
        if($title!=""){
            $output .= '<h3 class="cq-borderhover-title" style="color:'.$titlecolor.';font-size:'.$titlesize.'">'.$title.'</h3>';
            if(!$hidetitleborder)$output .= '<span class="cq-borderhover-titleborder" style="border-bottom-color:'.$titlecolor.';"></span>';
        }
        if($label!=""){
            $output .= '<p class="cq-borderhover-label" style="color:'.$labelcolor.';font-size:'.$labelsize.'">'.$label.'</p>';
        }
        if($isoverlay!="")$output .= '</div>';
        $output .= '</div>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }



  }
}
?>
