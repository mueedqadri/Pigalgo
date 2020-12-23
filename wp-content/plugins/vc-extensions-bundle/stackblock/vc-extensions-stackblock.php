<?php
if (!class_exists('VC_Extensions_StackBlock')) {
    class VC_Extensions_StackBlock{
        function __construct() {
            vc_map(array(
            "name" => __("Stack Block", 'vc_stackblock_cq'),
            "base" => "cq_vc_stackblock",
            "class" => "wpb_cq_vc_extension_stackblock",
            // "as_parent" => array('only' => 'cq_vc_stackblock_item'),
            "icon" => "cq_allinone_stackblock",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Place any content inside it', 'js_composer'),
            "params" => array(
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Stack content", "vc_stackblock_cq"),
                "param_name" => "content",
                "value" => __("", "vc_stackblock_cq"), "description" => __("", "vc_stackblock_cq") ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_stackblock_cq",
                "heading" => __("Stack background", "vc_stackblock_cq"),
                "param_name" => "panelbackground",
                "value" => array("White" => "white", "Gray" => "gray", "Orange" => "orange", "Red" => "red", "Green" => "green", "Mint" => "mint", "Aqua" => "aqua", "Blue" => "blue", "Lavender" => "lavender", "Pink" => "pink", "Yellow" => "yellow"),
                'std' => 'white',
                "description" => __("", "vc_stackblock_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_stackblock_cq",
                "heading" => __("Text align", "vc_stackblock_cq"),
                "param_name" => "textalign",
                "value" => array("left", "center", "right"),
                "description" => __("", "vc_stackblock_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Tooltip for the whole stack (optional)", "vc_stackblock_cq"),
                "param_name" => "tooltip",
                "value" => "",
                "description" => __("", "vc_stackblock_cq")
              ),
              array(
                "type" => "vc_link",
                "heading" => __("Link for the whole stack (optional)", "vc_stackblock_cq"),
                "param_name" => "link",
                "value" => "",
                "description" => __("", "vc_stackblock_cq")
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("font-size for the content", "vc_stackblock_cq"),
              //   "param_name" => "fontsize",
              //   "value" => "",
              //   "description" => __("Default is <strong>1.1em</strong>.", "vc_stackblock_cq")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("height of whole stack", "vc_stackblock_cq"),
                "param_name" => "elementheight",
                "value" => "",
                "description" => __("The height is auto by default, you can specify a value for it here, the content will align center vertically.", "vc_stackblock_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Text content width", "vc_stackblock_cq"),
                "param_name" => "contentwidth",
                "value" => "",
                "description" => __("Default is <strong>100%</strong>. You can specify other value here, like <strong>80%</strong>, and it'll align center automatically.", "vc_stackblock_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name", "vc_stackblock_cq"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_stackblock_cq")
              )

           )
        ));

        add_shortcode('cq_vc_stackblock', array($this,'cq_vc_stackblock_func'));

      }

      function cq_vc_stackblock_func($atts, $content=null, $tag) {
          extract(shortcode_atts(array(
            "panelbackground" => "gray",
            "textalign" => "left",
            "elementheight" => "",
            "contentwidth" => "",
            // "fontsize" => "",
            "tooltip" => "",
            "link" => "",
            "extraclass" => ""
          ), $atts));



          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';

          $link = vc_build_link($link);

          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_style( 'vc-extensions-stackblock-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-stackblock-style' );
          wp_enqueue_script('vc-extensions-stackblock-script');
          wp_register_script('vc-extensions-stackblock-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "tooltipster"));
          wp_enqueue_script('vc-extensions-stackblock-script');

          $i = -1;
          $output = '';
          $output .= '<div class="cq-stackblock" data-elementheight="'.$elementheight.'" data-contentwidth="'.$contentwidth.'" data-textalign="'.$textalign.'" data-tooltip="'.$tooltip.'">';
          if($link["url"]!=="") $output .= '<a href="'.$link["url"].'" title="'.$link["title"].'" target="'.$link["target"].'" class="cq-stackblock-link">';
          $output .= '<div class="cq-stackblock-card card-'.$panelbackground.'">';
          $output .= '<div class="cq-stackblock-content">';
          $output .= $content;
          $output .= '</div>';
          $output .= '</div>';
          if($link["url"]!=="") $output .= '</a>';
          $output .= '</div>';
          return $output;

        }

  }

}

?>
