<?php

if (!class_exists('VC_Extensions_HotSpot')) {

    class VC_Extensions_HotSpot {
        function __construct() {
          vc_map( array(
            "name" => __("HotSpot", 'vc_hotspot_cq'),
            "base" => "cq_vc_hotspot",
            "class" => "wpb_cq_vc_extension_hotspot",
            "controls" => "full",
            "icon" => "cq_allinone_hotspot",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __( 'Image hotspot with tooltip', 'js_composer' ),
            'front_enqueue_js' => plugins_url('js/hotspot_frontend.min.js', __FILE__),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Image", "vc_hotspot_cq"),
                "param_name" => "image",
                "value" => "",
                "description" => __("Select image from media library.", "vc_hotspot_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize image to this width", "vc_hotspot_cq"),
                "param_name" => "width",
                "value" => __("", 'vc_hotspot_cq'),
                "description" => __("You can resize image to this width, or keep it to blank to use the original image.", "vc_hotspot_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Tooltip content, divide each one with [hotspotitem][/hotspotitem], please edit in text mode:", "vc_hotspot_cq"),
                "param_name" => "content",
                "value" => __("[hotspotitem]
                  You have to wrap each tooltip block in <strong>hotspotitem</strong>.
                [/hotspotitem]
                [hotspotitem]
                  Hello tooltip 2, you can customize the icon color, link, arrow position, tooltip content etc in the backend.
                [/hotspotitem]
                [hotspotitem]
                  Hello tooltip 3
                [/hotspotitem]
                [hotspotitem]
                You can customize the icon position in the frontend editor of Visual Composer.
                <a href='http://codecanyon.net/user/sike?ref=sike'>Visit my profile</a> for more works.
                [/hotspotitem]", "vc_hotspot_cq"), "description" => __("Enter content for each block here. Divide each with [hotspotitem].", "vc_hotspot_cq") ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("HotSpot icon size:", "vc_hotspot_cq"),
              //   "param_name" => "iconsize",
              //   "value" => "",
              //   "description" => __("", "vc_hotspot_cq")
              // ),
              array(
                "type" => "dropdown",
                "heading" => __("Display which tooltip by default?", "vc_hotspot_cq"),
                "param_name" => "isdisplayall",
                'value' => array(__("Display all of them when loaded", "vc_hotspot_cq") => "on", __("Display a specified one (customize it below:)", "vc_hotspot_cq") => "specify", __("Hide them all when loaded", "vc_hotspot_cq") => "off"),
                'std' => 'off',
                "description" => __('Default all the tooltips are hidden. Though you can choose to open all of them or a single one when page is loaded.', 'vc_hotspot_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Display this tooltip when page loaded:", "vc_hotspot_cq"),
                "param_name" => "displayednum",
                "value" => "1",
                "dependency" => Array('element' => "isdisplayall", 'value' => array('specify')),
                "description" => __("You can specify to display which tooltip in current image. Default is <strong>1</strong>, which stand for the number 1 tooltip will be opened when page is loaded.", "vc_hotspot_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Display the hotspot with?", "vc_hotspot_cq"),
                "param_name" => "icontype",
                "value" => array(__("single dot", "vc_hotspot_cq") => "dot", __("number", "vc_hotspot_cq") => "number", __("Font Awesome icon", "vc_hotspot_cq") => "icon"),
                "description" => __("", "vc_hotspot_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Numbers start from", "vc_hotspot_cq"),
                "param_name" => "startnumber",
                "value" => "1",
                "dependency" => Array('element' => "icontype", 'value' => array('number')),
                "description" => __("Default is start from 1, you can specify other value here, like 4.", "vc_hotspot_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Font Awesome icon for each hotspot:", 'vc_hotspot_cq'),
                "param_name" => "fonticon",
                "value" => __("fa-hand-o-right,fa-image,fa-coffee,fa-comment", 'vc_hotspot_cq'),
                "dependency" => Array('element' => "icontype", 'value' => array('icon')),
                "description" => __("Put the <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a> here, divide with linebreak (Enter).", 'vc_hotspot_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Each hotspot icon's position", 'vc_hotspot_cq'),
                "param_name" => "position",
                "value" => __("25%|30%,35%|20%,45%|60%,75%|20%", 'vc_hotspot_cq'),
                "description" => __("Position of each icon in <strong>top|left</strong> format. Please update via dragging the hotspot icon in the Visual Composer Frontend editor. See a <a href='http://youtu.be/9j1XhIQw9JE' target='_blank'>Youtube video demo</a>.", 'vc_hotspot_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Global hotspot icon color", 'vc_hotspot_cq'),
                "param_name" => "iconbackground",
                "value" => 'rgba(0,0,0,0.8)',
                "description" => __("Global color for the hotspot icon. Or you can specify different color for each icon below.", 'vc_hotspot_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Hotspot circle dot (or Font Awesome icon) color", 'vc_hotspot_cq'),
                "param_name" => "circlecolor",
                "value" => '#FFFFFF',
                "description" => __("Color for the hotspot circle dot. Default is white.", 'vc_hotspot_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Each hotspot icon's color", 'vc_hotspot_cq'),
                "param_name" => "color",
                "value" => __("", 'vc_hotspot_cq'),
                "description" => __("Color for each icon, you can use the value like #663399 or the name of the color like blue here. Divide each with linebreaks (Enter).", 'vc_hotspot_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Display pulse animation for the hotspot icon?", "vc_hotspot_cq"),
                "param_name" => "ispulse",
                "value" => array(__("yes", "vc_hotspot_cq") => "yes", __("no", "vc_hotspot_cq") => "no"),
                "description" => __("", "vc_hotspot_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Select pulse border color", "vc_hotspot_cq"),
                "param_name" => "pulsecolor",
                "value" => array(__("Default", "vc_hotspot_cq") => "pulse-white", __("gray", "vc_hotspot_cq") => "pulse-gray", __("red", "vc_hotspot_cq") => "pulse-red", __("green", "vc_hotspot_cq") => "pulse-green", __("yellow", "vc_hotspot_cq") => "pulse-yellow", __("blue", "vc_hotspot_cq") => "pulse-blue", __("purple", "vc_hotspot_cq") => "pulse-purple"),
                "dependency" => Array('element' => "ispulse", 'value' => array('yes')),
                "std" => "pulse-white",
                "description" => __("You can select the pulse border color here, default is white.", "vc_hotspot_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Tooltip arrow position for each hotspot", 'vc_hotspot_cq'),
                "param_name" => "arrowposition",
                "value" => __("", 'vc_hotspot_cq'),
                "description" => __("The arrow position for each tooltip, default is top. The available options are: <strong>top, right, bottom, left, top-right, top-left, bottom-right, bottom-left</strong>. Divide each with linebreaks (Enter)", 'vc_hotspot_cq')
              ),

              array(
                "type" => "textfield",
                "heading" => __("Hotspot icon opacity", "vc_hotspot_cq"),
                "param_name" => "opacity",
                "value" => "1",
                "description" => __("The opacity of each icon, default is 1", "vc_hotspot_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Tooltip style", "vc_hotspot_cq"),
                "param_name" => "tooltipstyle",
                "value" => array(__("shadow", "vc_hotspot_cq") => "shadow", __("light", "vc_hotspot_cq") => "light", __("noir", "vc_hotspot_cq") => "noir", __("punk", "vc_hotspot_cq") => "punk"),
                "description" => __("", "vc_hotspot_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Tooltip trigger when user", "vc_hotspot_cq"),
                "param_name" => "trigger",
                "value" => array(__("hover", "vc_hotspot_cq") => "hover", __("click", "vc_hotspot_cq") => "click"),
                "description" => __("Select how to trigger the tooltip.", "vc_hotspot_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Tooltip animation", "vc_hotspot_cq"),
                "param_name" => "tooltipanimation",
                "value" => array(__("grow", "vc_hotspot_cq") => "grow", __("fade", "vc_hotspot_cq") => "fade", __("swing", "vc_hotspot_cq") => "swing", __("slide", "vc_hotspot_cq") => "slide", __("fall", "vc_hotspot_cq") => "fall"),
                "description" => __("Choose the animation for the tooltip.", "vc_hotspot_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_hotspot_cq",
                "heading" => __("Link for each hotspot icon", 'vc_hotspot_cq'),
                "param_name" => "links",
                "value" => __("", 'vc_hotspot_cq'),
                "description" => __("Specify link for each icon, divide each with linebreaks (Enter).", 'vc_hotspot_cq')
              ),
              array(
                "type" => "dropdown",
                "heading" => __("How to open the link for the icon?", "vc_hotspot_cq"),
                "param_name" => "custom_links_target",
                "description" => __('Select how to open the links', 'vc_hotspot_cq'),
                'value' => array(__("Same window", "vc_hotspot_cq") => "_self", __("New window", "vc_hotspot_cq") => "_blank")
              ),
              array(
                "type" => "textfield",
                "heading" => __("maxWidth of the tooltip", "vc_hotspot_cq"),
                "param_name" => "maxwidth",
                "value" => "240",
                "description" => __("maxWidth for the tooltip, 0 is auto width, you can specify a value here, default is 240.", "vc_hotspot_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Container width", "vc_hotspot_cq"),
                "param_name" => "containerwidth",
                "value" => "",
                "description" => __("You can specify the container width here, default is 100%. You can try other value like 80%, it will be align center automatically.", "vc_hotspot_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Margin offset", "vc_hotspot_cq"),
                "param_name" => "marginoffset",
                "value" => "",
                "description" => __("The margin offset for the hotspot icon in small screen. For example <strong>-6px 0 0 -6px</strong> will move the icons upper left for 6px offset in small screen. Leave here to be blank if you do not want it.", "vc_hotspot_cq")
              ),
              // array(
              //   "type" => "checkbox",
              //   "holder" => "",
              //   "class" => "vc_hotspot_cq",
              //   "heading" => __("Display all tooltips by default?", 'vc_hotspot_cq'),
              //   "param_name" => "isdisplayall",
              //   "value" => array(__("Yes, display them when loaded", "vc_hotspot_cq") => 'on'),
              //   "description" => __("The tooltips are all hidden by default. You can check this on if you want them all visible when loaded.", 'vc_hotspot_cq')
              // ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_hotspot_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_hotspot_cq")
              )

            )
        ));

        add_shortcode('cq_vc_hotspot', array($this,'cq_vc_hotspot_func'));
      }

      function cq_vc_hotspot_func($atts, $content=null, $tag) {
          extract( shortcode_atts( array(
            'image' => '',
            'width' => '',
            'color' => '',
            'ispulse' => 'yes',
            'pulsecolor' => 'pulse-white',
            'icon' => '',
            'iconsize' => '',
            'tooltipstyle' => 'shadow',
            'iconbackground' => 'rgba(0,0,0,0.8)',
            'tooltipanimation' => 'grow',
            'circlecolor' => '#FFFFFF',
            'opacity' => '1',
            'arrowposition' => '',
            'trigger' => '',
            'links' => '',
            'maxwidth' => '240',
            'custom_links_target' => '',
            'position' => '25%|30%,35%|20%,45%|60%,75%|20%',
            'containerwidth' => '',
            'marginoffset' => '',
            'icontype' => 'dot',
            'fonticon' => '',
            'isdisplayall' => 'off',
            'displayednum' => '1',
            'startnumber' => '1',
            'extra_class' => ''
          ), $atts ) );

          if($icontype=="icon"){
            wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
            wp_enqueue_style( 'font-awesome' );
          }
          wp_register_style( 'vc_hotspot_cq_style', plugins_url('css/style.min.css', __FILE__));
          wp_enqueue_style( 'vc_hotspot_cq_style' );
          wp_register_style('tooltipster', plugins_url('../profilecard/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');

          wp_register_script('tooltipster', plugins_url('../profilecard/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_script('vc_hotspot_cq_script', plugins_url('js/script.min.js', __FILE__), array("jquery", "tooltipster"));
          wp_enqueue_script('vc_hotspot_cq_script');


          $image_full = wp_get_attachment_image_src($image, 'full');
          $position = explode(',', $position);
          $color = explode(',', $color);
          $arrowposition = explode(',', $arrowposition);
          $links = explode(',', $links);
          $fonticon = explode(',', $fonticon);
          $i = -1;
          $is_new_tag = false;
          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          if(strpos($content, '[/hotspotitem]')===false){
              $content = str_replace('</div>', '', trim($content));
              $contentarr = explode('<div class="tooltip-content">', trim($content));
          }else{
              $content = str_replace('[/hotspotitem]', '', trim($content));
              $contentarr = explode('[hotspotitem]', trim($content));
              $is_new_tag = true;
          }
          // $pulseborder = $ispulse == "yes" ? "cq-pulse" : "";
          $pulseborder = "";
          $ispulse = $ispulse == "yes" ? $pulsecolor : "";
          array_shift($contentarr);
          $output = $tooltipcontent = '';
          $output .= '<div style="width:'.$containerwidth.';" class="cqtooltip-wrapper '.$extra_class.'" data-opacity="'.$opacity.'" data-tooltipanimation="'.$tooltipanimation.'" data-tooltipstyle="'.$tooltipstyle.'" data-trigger="'.$trigger.'" data-maxwidth="'.$maxwidth.'" data-marginoffset="'.$marginoffset.'" data-isdisplayall="'.$isdisplayall.'" data-displayednum="'.$displayednum.'">';

            $image_temp = $imagethumb = "";
            $fullimage = $image_full[0];
            $imagethumb = $fullimage;
            $attachment = get_post($image);
            if($width!=""){
                if(function_exists('wpb_resize')){
                    $image_temp = wpb_resize($image, null, $width, null);
                    $imagethumb = $image_temp['url'];
                    if($imagethumb=="") $imagethumb = $fullimage;
                }
            }

          $output .= '<img src="'.$imagethumb.'" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />';
          $output .= '<div class="cq-hotspots">';
          // foreach ($position as $key => $positionarr) {
          foreach ($contentarr as $key => $thecontent) {
             $i++;
             $tooltipcontent = '';
             // $iconposition = explode('|', trim($positionarr));
             if(!isset($position[$i])) $position[$i] = '25%|25%';
             if(!isset($fonticon[$i])) $fonticon[$i] = '';
             $iconposition = explode('|', trim($position[$i]));
             // if(!isset($contentarr[$i+1])) $contentarr[$i+1] = '';
             if(!isset($iconposition[0])) $iconposition[0] = '25%';
             if(!isset($iconposition[1])) $iconposition[1] = '25%';
             if(!isset($color[$i])) $color[$i] = '';
             if(!isset($arrowposition[$i])) $arrowposition[$i] = 'top';
             if(!isset($links[$i])) $links[$i] = '';
             if($color[$i]!="") {
               $iconcolor = $color[$i];
             }else{
               $iconcolor = $iconbackground;
             }
             $tooltipcontent = trim($thecontent);
             if($is_new_tag){
                 // $tooltipcontent = ltrim($tooltipcontent, '<br />');
                 // $tooltipcontent = ltrim($tooltipcontent, '<p></p>');
             }
             // $tooltipcontent = rtrim($tooltipcontent, '<br />');
             $tooltipcontent = preg_replace("/(^)?(<br\s*\/?>\s*)+$/", "", $tooltipcontent);
             $tooltipcontent = preg_replace('/^(<br \/>)*/', "", $tooltipcontent);
             $tooltipcontent = preg_replace('/^(<\/p>)*/', "", $tooltipcontent);
             // $tooltipcontent = rtrim($tooltipcontent, '<p></p>');
             $output .= '<div class="hotspot-item '.$ispulse.' '.$pulseborder.'" style="top:'.$iconposition[0].';left:'.$iconposition[1].';" data-top="'.$iconposition[0].'" data-left="'.$iconposition[1].'">';
             if($links[$i]!=""){
                 $output .= '<a href="'.$links[$i].'" class="cq-tooltip" style="background:'.$iconcolor.';" data-tooltip="'.htmlspecialchars($tooltipcontent).'" data-arrowposition="'.trim($arrowposition[$i]).'" target="'.$custom_links_target.'">';
             }else{
                 $output .= '<a href="#" class="cq-tooltip" style="background:'.$iconcolor.';" data-tooltip="'.htmlspecialchars($tooltipcontent).'" data-arrowposition="'.trim($arrowposition[$i]).'">';
             }
             if($icontype=="number"){
                if($startnumber!=1){
                  $output .= '<i>';
                  $output .= $startnumber+$i;
                  $output .= '</i>';
                }else{
                  $output .= '<i>';
                  $output .= $i+1;
                  $output .= '</i>';
                }
             }else if($icontype=="icon"){
                if($fonticon[$i]!=""){
                    $output .= '<i class="fa '.$fonticon[$i].'" style="color:'.$circlecolor.';"></i>';
                }else{
                    $output .= '<span style="background:'.$circlecolor.';">';
                    $output .= '</span>';
                }
             }else{
                $output .= '<span style="background:'.$circlecolor.';">';
                $output .= '</span>';
             }

             $output .= '</a>';
             $output .= '</div>';
          }
          $output .= '</div>';
          $output .= '</div>';

          return $output;

        }


  }

}

?>
