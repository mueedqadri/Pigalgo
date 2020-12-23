<?php
if (!class_exists('VC_Extensions_ShadowCard')){
    class VC_Extensions_ShadowCard{
        private $covernum = 1;
        function __construct() {
            vc_map(array(
            "name" => __("Shadow Card", 'cq_allinone_vc'),
            "base" => "cq_vc_shadowcard",
            "class" => "cq_vc_shadowcard",
            "controls" => "full",
            "icon" => "cq_vc_shadowcard",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            "show_settings_on_create" => true,
            'description' => __('Hover image with tilt', 'js_composer'),
            "params" => array(
              array(
                "type" => "textfield",
                "heading" => __("Element height", "cq_allinone_vc"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("The height of the image (in pixel), default is <strong>240</strong>(px) (leave it to be blank). ", "cq_allinone_vc")
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
                "type" => "vc_link",
                "heading" => __("Link for the element (optional)", "cq_allinone_vc"),
                "param_name" => "link",
                "value" => "",
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
                "type" => "textfield",
                "heading" => __("Titile under the image (optional).", "cq_allinone_vc"),
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
                 "type" => "dropdown",
                 "holder" => "",
                 "heading" => __("Tile tolerance of the hover transition", "cq_allinone_vc"),
                 "param_name" => "tolerance",
                 "value" => array("4", "8", "12", "14", "18", "24"),
                 "std" => "14",
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "cq_allinone_vc"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "cq_allinone_vc")
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


        add_shortcode('cq_vc_shadowcard', array($this,'cq_vc_shadowcard_func'));

      }

      function cq_vc_shadowcard_func($atts, $content=null) {
        $titlesize = $labelsize = $elementheight = $title = $titlecolor = $link = $tolerance = $css_class = $css = $extraclass = '';
        $covernum = 0;
        extract(shortcode_atts(array(
          "image" => "",
          "isresize" => "",
          "imagesize" => "",
          "title" => "",
          "titlesize" => "",
          "titlecolor" => "",
          "labelsize" => "",
          "elementheight" => "",
          "tolerance" => "14",
          "link" => "",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_shadowcard', $atts);
        wp_register_style( 'vc-extensions-shadowcard-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-shadowcard-style' );

        // wp_register_script('modernizr-custom-objectfit', plugins_url('js/modernizr-custom.min.js', __FILE__));
        // wp_enqueue_script('modernizr-custom-objectfit');

        wp_register_script('vc-extensions-shadowcard-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
        wp_enqueue_script('vc-extensions-shadowcard-script');

        $link = vc_build_link($link);
        if($link["url"]=="") $link["url"] = "#";

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


        $this -> covernum = $covernum;
        $output = "";
        $output .= '<div class="cq-shadowcard '.$extraclass.' '.$css_class.'" data-tolerance="'.$tolerance.'" data-elementheight="'.$elementheight.'" data-titlesize="'.$titlesize.'" data-labelsize="'.$labelsize.'" data-titlecolor="'.$titlecolor.'">';
        $output .= '<div class="cq-shadowcard-item">';
        $output .= '<a href="'.$link["url"].'" title="'.$link["title"].'" rel="'.$link["rel"].'" target="'.$link["target"].'" class="cq-shadowcard-link">';
        // if($thumb_image!=""){
        //     $output .= '<img src="'.$thumb_image.'" alt="" class="cq-shadowcard-image" />';
        // }
        $output .= '<div style="width:100%;height:100%;background-position:center center;background-size:cover;background-image:url('.$thumb_image.')" class="cq-shadowcard-imageblock"></div>';
        $output .= '</a>';
        if($title!=""){
            $output .= '<h2 class="cq-shadowcard-title">'.$title.'</h2>';
        }
        $output .= '</div>';
        $output .= '</div>';
        return $output;

      }



  }
}
?>
