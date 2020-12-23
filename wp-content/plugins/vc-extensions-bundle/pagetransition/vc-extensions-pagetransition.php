<?php
if (!class_exists('VC_Extensions_PageTransition')) {
    class VC_Extensions_PageTransition{
        function __construct() {
          vc_map(array(
            "name" => __("Page Transition", 'vc_pagetransition_cq'),
            "base" => "cq_vc_pagetransition",
            "class" => "wpb_cq_vc_extension_pagetransition",
            // "as_parent" => array('only' => 'cq_vc_pagetransition_item'),
            "icon" => "cq_allinone_pagetransition",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Loading page with animation', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_pagetransition_cq",
                "heading" => __("Display the animation in:", "vc_pagetransition_cq"),
                "param_name" => "animationmode",
                "value" => array(__("normal mode (animate the page only)", "vc_pagetransition_cq") => "normal", __("overlay mode (animate a solid background overlay of the page)", "vc_pagetransition_cq") => "overlay"),
                "description" => __("", "vc_pagetransition_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Overlay color", 'vc_pagetransition_cq'),
                "param_name" => "overlaycolor",
                "value" => '',
                "dependency" => Array('element' => "animationmode", 'value' => array('overlay')),
                "description" => __("", 'vc_pagetransition_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_pagetransition_cq",
                "heading" => __("Page in animation:", "vc_pagetransition_cq"),
                "param_name" => "pagein",
                "value" => array("fade-in", "fade-in-up-sm", "fade-in-up", "fade-in-up-lg", "fade-in-down-sm", "fade-in-down", "fade-in-down-lg", "fade-in-left-sm", "fade-in-left", "fade-in-left-lg", "fade-in-right-sm", "fade-in-right", "fade-in-right-lg", "rotate-in-sm", "rotate-in", "rotate-in-lg", "flip-in-x-fr", "flip-in-x", "flip-in-x-nr", "flip-in-y-fr", "flip-in-y", "flip-in-y-nr", "zoom-in-sm", "zoom-in", "zoom-in-lg"),
                "dependency" => Array('element' => "animationmode", 'value' => array('normal')),
                "description" => __("", "vc_pagetransition_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_pagetransition_cq",
                "heading" => __("Page out animation:", "vc_pagetransition_cq"),
                "param_name" => "pageout",
                "value" => array("fade-out", "fade-out-up-sm", "fade-out-up", "fade-out-up-lg", "fade-out-down-sm", "fade-out-down", "fade-out-down-lg", "fade-out-left-sm", "fade-out-left", "fade-out-left-lg", "fade-out-right-sm", "fade-out-right", "fade-out-right-lg", "rotate-out-sm", "rotate-out", "rotate-out-lg", "flip-out-x-fr", "flip-out-x", "flip-out-x-nr", "flip-out-y-fr", "flip-out-y", "flip-out-y-nr", "zoom-out-sm", "zoom-out", "zoom-out-lg"),
                "dependency" => Array('element' => "animationmode", 'value' => array('normal')),
                "description" => __("", "vc_pagetransition_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_pagetransition_cq",
                "heading" => __("Page in animation:", "vc_pagetransition_cq"),
                "param_name" => "overlayin",
                "value" => array("overlay-slide-in-top", "overlay-slide-in-bottom", "overlay-slide-in-left", "overlay-slide-in-right"),
                "dependency" => Array('element' => "animationmode", 'value' => array('overlay')),
                "description" => __("", "vc_pagetransition_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_pagetransition_cq",
                "heading" => __("Page out animation:", "vc_pagetransition_cq"),
                "param_name" => "overlayout",
                "value" => array("overlay-slide-out-top", "overlay-slide-out-bottom", "overlay-slide-out-left", "overlay-slide-out-right"),
                "dependency" => Array('element' => "animationmode", 'value' => array('overlay')),
                "description" => __("", "vc_pagetransition_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Page in speed:", "vc_pagetransition_cq"),
                "param_name" => "pageinspeed",
                "value" => "1500",
                "description" => __("", "vc_pagetransition_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Page out speed:", "vc_pagetransition_cq"),
                "param_name" => "pageoutspeed",
                "value" => "800",
                "description" => __("", "vc_pagetransition_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Specify the div class of the site wrapper:", "vc_pagetransition_cq"),
                "param_name" => "sitewrapper",
                "value" => "",
                "description" => __("Defautl we will consider first div of the page as site wrapper and hide it. But you can specify it here too.", "vc_pagetransition_cq")
              ),
              array(
                "type" => "textarea",
                "heading" => __("Apply page out animation to these links:", "vc_pagetransition_cq"),
                "param_name" => "linkelement",
                "value" => "",
                "description" => __("The jQuery selector of the links, you can use tool like <a href='http://getfirebug.com/html' target='_blank'>FireBug</a> to inspect the element. Default is all links except the new window link and anchor link in current page. For example, <strong>li.menu-item > a</strong> will enable the page out animation only with the link in menu-item, <strong>a:not(.fluidbox):not(.lightbox-link)</strong> will will disable the page out animation in the lightbox image link.", "vc_pagetransition_cq")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_pagetransition_cq",
                "heading" => __("Do not display the page transition temporarily?", 'vc_pagetransition_cq'),
                "param_name" => "isdisplay",
                "value" => array(__("Yes, hide the transition", "vc_pagetransition_cq") => 'no'),
                "description" => __("The page transition is available by default, you can check this to disable it temporarily.", 'vc_pagetransition_cq')
              )
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Extra class name for the container", "vc_pagetransition_cq"),
              //   "param_name" => "extraclass",
              //   "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it is in your css file.", "vc_pagetransition_cq")
              // )

           )
        ));

        add_shortcode('cq_vc_pagetransition', array($this,'cq_vc_pagetransition_func'));
      }

      function cq_vc_pagetransition_func($atts, $content=null, $tag) {
          extract(shortcode_atts(array(
            'animationmode' => 'normal',
            'pagein' => 'fade-in',
            'pageout' => 'fade-out',
            'overlayin' => 'overlay-slide-in-top',
            'overlayout' => 'overlay-slide-out-top',
            'pageinspeed' => '1500',
            'pageoutspeed' => '800',
            'linkelement' => '',
            'isdisplay' => 'yes',
            'sitewrapper' => '',
            'overlaycolor' => ''
            // 'extraclass' => ''
          ), $atts));

          $i = -1;
          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          // if($animationmode=="normal"&&$pagein!="zoom-in"){
          //   $pagein_arr = Array("fade-in", "fade-in-up-sm", "fade-in-up", "fade-in-up-lg", "fade-in-down-sm", "fade-in-down", "fade-in-down-lg", "fade-in-left-sm", "fade-in-left", "fade-in-left-lg", "fade-in-right-sm", "fade-in-right", "fade-in-right-lg", "rotate-in-sm", "rotate-in", "rotate-in-lg", "flip-in-x-fr", "flip-in-x", "flip-in-x-nr", "flip-in-y-fr", "flip-in-y", "flip-in-y-nr", "zoom-in-sm", "zoom-in", "zoom-in-lg");
          //   $pagein = $pagein_arr[array_rand($pagein_arr)];
          // }
          $output = '';
          if($isdisplay!="no"){
              // wp_register_style('vc-extensions-pagetransition-style', plugins_url('css/style.css', __FILE__));
              // wp_enqueue_style('vc-extensions-pagetransition-style');
              wp_register_style( 'animsition', plugins_url('css/animsition.min.css', __FILE__) );
              wp_enqueue_style( 'animsition' );
              wp_register_script('animsition', plugins_url('js/jquery.animsition.min.js', __FILE__), array("jquery"));
              wp_enqueue_script('animsition');

              wp_register_script('vc-extensions-pagetransition-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
              wp_enqueue_script('vc-extensions-pagetransition-script');
              $output .= '<div class="cq-animsition" data-animationmode="'.$animationmode.'" data-pagein="'.$pagein.'" data-pageout="'.$pageout.'" data-overlayin="'.$overlayin.'" data-overlayout="'.$overlayout.'" data-pageinspeed="'.$pageinspeed.'" data-pageoutspeed="'.$pageoutspeed.'" data-linkelement="'.$linkelement.'" data-overlaycolor="'.$overlaycolor.'" data-sitewrapper="'.$sitewrapper.'">';
              $output .= '</div>';
          }
          return $output;

        }


  }

}

?>
