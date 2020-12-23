<?php
if (!class_exists('VC_Extensions_DraggableTimeline')) {

    class VC_Extensions_Draggabletimeline {
        function __construct() {
          vc_map(array(
            "name" => __("Draggable Timeline", 'vc_draggabletimeline_cq'),
            "base" => "cq_vc_draggabletimeline",
            "class" => "wpb_cq_vc_extension_timeline",
            "controls" => "full",
            "icon" => "cq_allinone_timeline",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('with autoplay', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Separate each timeline with:", "vc_draggabletimeline_cq"),
                "param_name" => "avatarstyle",
                "value" => array(__("image (will be resized to 80x80 in retina)", "vc_draggabletimeline_cq") => "image", __("icon (Font Awesome icon)", "vc_draggabletimeline_cq") => "icon", __("text (label) only", "vc_draggabletimeline_cq") => "text"),
                "description" => __("", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "attach_images",
                "heading" => __("Image for each timeline block:", "vc_draggabletimeline_cq"),
                "param_name" => "images",
                "value" => "",
                "dependency" => Array('element' => "avatarstyle", 'value' => array('image')),
                "description" => __("Select images from media library, will be resized to 80x80 (in retina) automatically.", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Icon for each timeline block:", 'vc_draggabletimeline_cq'),
                "param_name" => "avataricons",
                "value" => __("fa-twitter,fa-bank,fa-heart,fa-comment", 'vc_draggabletimeline_cq'),
                "dependency" => Array('element' => "avatarstyle", 'value' => array('icon')),
                "description" => __("<a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a> for each timeline, divide with linebreak (Enter).", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Display the image (or icon) in this shape:", "vc_draggabletimeline_cq"),
                "param_name" => "avatarshape",
                "value" => array(__("round", "vc_draggabletimeline_cq") => "round", __("circle", "vc_draggabletimeline_cq") => "circle", __("square", "vc_draggabletimeline_cq") => "square"),
                "dependency" => Array('element' => "avatarstyle", 'value' => array('image', 'icon')),
                "description" => __("Choose the image (or icon) shape here.", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Label for each timeline block:", 'vc_draggabletimeline_cq'),
                "param_name" => "avatarlabels",
                "value" => __("Debra Riley,Default label,Designer,2014", 'vc_draggabletimeline_cq'),
                "description" => __("Divide with linebreak (Enter). Will work as the timeline label (is required) in the text mode.", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Optional title for each timeline block content:", 'vc_draggabletimeline_cq'),
                "param_name" => "contenttitles",
                "value" => __("Hello title 1,Hi title 2,Designer,2014", 'vc_draggabletimeline_cq'),
                "group" => "Timeline content",
                "description" => __("Divide with linebreak (Enter).", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Timeline block content, divide each one with &lt;div class=&#039;timeline-content&#039;&gt;&lt;/div&gt;, please edit in text mode:", "vc_draggabletimeline_cq"),
                "param_name" => "content",
                "value" => __("
                  <div class='timeline-content'>

                  Hello timeline content 1.
                  You have to wrap each timeline block in a div with class <strong>timeline-content</strong>.
                So you can put anything in it, like a image or video.
                </div>

                <div class='timeline-content'>

                  Hello timeline 2, you can customize the dragging bar color, slideshow, icons, icon color, timeline content etc in the backend.
                  Long content will trigger the scrollbar automatically.
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>

                <div class='timeline-content'>
                  Hello timeline 3
                </div>

                <div class='timeline-content'>
                You can choose to display the timeline label with Font Awesome icon, image or text only.
                <a href='http://codecanyon.net/user/sike?ref=sike'>Visit my profile</a> for more works. </div>", "vc_draggabletimeline_cq"),
                "group" => "Timeline content",
                "description" => __("Enter content for each block here.", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Choose the popup content window color:", "vc_draggabletimeline_cq"),
                "param_name" => "windowcolor",
                "value" => array(__("gray", "vc_draggabletimeline_cq") => "gray", __("red", "vc_draggabletimeline_cq") => "red", __("green", "vc_draggabletimeline_cq") => "green", __("blue", "vc_draggabletimeline_cq") => "blue", __("yellow", "vc_draggabletimeline_cq") => "yellow", __("aqua", "vc_draggabletimeline_cq") => "aqua", __("mint", "vc_draggabletimeline_cq") => "mint", __("lavender", "vc_draggabletimeline_cq") => "lavender", __("pink", "vc_draggabletimeline_cq") => "pink"),
                "group" => "Color Settings",
                "description" => __("", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Optional font color for the label:", 'vc_draggabletimeline_cq'),
                "param_name" => "labelcolor",
                "value" => '',
                "group" => "Color Settings",
                "description" => __("Default is gray #333.", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Optional background color for each icon:", 'vc_draggabletimeline_cq'),
                "param_name" => "iconbgcolors",
                "value" => __("#00ACED,#E14782,#3B5998,#E14107,#333333", 'vc_draggabletimeline_cq'),
                "dependency" => Array('element' => "avatarstyle", 'value' => array('icon')),
                "group" => "Color Settings",
                "description" => __("Divide with linebreak (Enter).", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Optional default bar background color:", 'vc_draggabletimeline_cq'),
                "param_name" => "defaultbarbgcolor",
                "value" => '',
                "group" => "Color Settings",
                "description" => __("Default is light gray #EFEFEF, customize it with other color or change it to transparent if you don't want it.", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Optional dragging bar background color:", 'vc_draggabletimeline_cq'),
                "param_name" => "draggingbarbgcolor",
                "value" => '',
                "group" => "Color Settings",
                "description" => __("Default is light black, customize it with other color as you like.", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Auto delay move the timeline as slideshow?", "vc_draggabletimeline_cq"),
                "param_name" => "autoplay",
                "value" => array(__("no", "vc_draggabletimeline_cq") => "no", __("yes", "vc_draggabletimeline_cq") => "yes"),
                "group" => "Slideshow?",
                "description" => __("", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Autoplay speed in milliseconds", "vc_draggabletimeline_cq"),
                "param_name" => "autoplayspeed",
                "value" => "5000",
                "dependency" => Array('element' => "autoplay", 'value' => array('yes')),
                "group" => "Slideshow?",
                "description" => __("The speed of the auto delay slideshow, default is 5000, which stand for 5 seconds.", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Optional active background color for the icons:", 'vc_draggabletimeline_cq'),
                "param_name" => "activeiconcolor",
                "value" => '',
                "dependency" => Array('element' => "avatarstyle", 'value' => array('icon')),
                "group" => "Color Settings",
                "description" => __("Leave it to be blank if you don't want it.", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_draggabletimeline_cq",
                "heading" => __("Hide the drag button by default?", 'vc_draggabletimeline_cq'),
                "param_name" => "isdragbutton",
                "value" => array(__("Yes, hide it", "vc_draggabletimeline_cq") => 'no'),
                "description" => __("The drag button is visible in desktop view by default, you can check this to hide it.", 'vc_draggabletimeline_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Width of the drag button:", "vc_draggabletimeline_cq"),
                "param_name" => "dragbuttonwidth",
                "description" => __("The drag button is 20px be default, but you have to change it to larger value like 30px in some theme.", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Width of the whole container:", "vc_draggabletimeline_cq"),
                "param_name" => "contaienrwidth",
                "description" => __("Default is 80% and align cetenr automatically. You can customize it to other value like 100%.", "vc_draggabletimeline_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_draggabletimeline_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it is in your css file.", "vc_draggabletimeline_cq")
              )

           )
        ));

        add_shortcode('cq_vc_draggabletimeline', array($this,'cq_vc_draggabletimeline_func'));
      }

    function cq_vc_draggabletimeline_func($atts, $content=null, $tag) {
            extract(shortcode_atts(array(
              'images' => '',
              'avatarlabels' => '',
              'avatarstyle' => 'image',
              'avatarshape' => 'round',
              'windowcolor' => 'gray',
              'avataricons' => '',
              'draggingbarbgcolor' => 'rgba(0, 0, 0, 0.5)',
              'defaultbarbgcolor' => '',
              'iconbgcolors' => '',
              'contenttitles' => '',
              'labelcolor' => '',
              'activeiconcolor' => '',
              'autoplay' => 'no',
              'autoplayspeed' => '',
              'isdragbutton' => '',
              'dragbuttonwidth' => '',
              'contaienrwidth' => '',
              'extra_class' => ''
            ), $atts));


          if($avatarstyle=="icon"){
            wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
            wp_enqueue_style( 'font-awesome' );
          }

          wp_register_style('slick', plugins_url('../testimonialcarousel/slick/slick.css', __FILE__));
          wp_enqueue_style('slick');
          wp_register_style('perfect-scrollbar', plugins_url('css/perfect-scrollbar.min.css', __FILE__));
          wp_enqueue_style('perfect-scrollbar');

          wp_register_script('slick', plugins_url('../testimonialcarousel/slick/slick.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('slick');
          wp_register_script('perfect-scrollbar', plugins_url('js/perfect-scrollbar.jquery.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('perfect-scrollbar');

          wp_register_style('vc-extensions-draggabletimeline-style', plugins_url('css/style.css', __FILE__));
          wp_enqueue_style('vc-extensions-draggabletimeline-style');

          wp_register_script('vc-extensions-draggabletimeline-script', plugins_url('js/draggabletimeline.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-draggabletimeline-script');


          $i = -1;
          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $content = str_replace('</div>', '', trim($content));
          $contentarr = explode('<div class="timeline-content">', $content);
          array_shift($contentarr);

          $imagesarr = explode(',', $images);
          $avatarlabels = explode(',', $avatarlabels);
          $avataricons = explode(',', $avataricons);
          $contenttitles = explode(',', $contenttitles);
          $iconbgcolors = explode(',', $iconbgcolors);
          $imagewidth = 80;
          $retina = true;
          $output = '';
          $output .= '<div class="cq-draggable-container '.$extra_class.'" data-draggingbarbgcolor="'.$draggingbarbgcolor.'" data-defaultbarbgcolor="'.$defaultbarbgcolor.'" data-avatarstyle="'.$avatarstyle.'" data-activeiconcolor="'.$activeiconcolor.'" data-autoplay="'.$autoplay.'" data-autoplayspeed="'.$autoplayspeed.'" data-labelcolor="'.$labelcolor.'" data-dragbuttonwidth="'.$dragbuttonwidth.'" data-contaienrwidth="'.$contaienrwidth.'">';
          $output .= '<div class="cq-draggable-slider">';
          $output .= '<div class="cq-draggable-stripe">';
          $output .= '<div class="cq-draggable-handle">';
          $output .= '<div class="cq-infobox '.$windowcolor.'">';
          $output .= '<div class="cq-titlecontainer">';
            foreach ($contenttitles as $key => $contenttitle) {
                if(!isset($contenttitle)) $contenttitle = '';
                if($contenttitle!=""){
                  $output .= '<div class="cq-titlebar">';
                  $output .= $contenttitle;
                  $output .= '</div>';
                }
            }

          $output .= '</div>';
          $output .= '<div class="cq-innerbox">';
          $output .= '<div class="cq-carouselcontainer">';
            foreach ($contentarr as $key => $timelinecontent) {
                if(!isset($timelinecontent)) $timelinecontent = '';
                $output .= '<div class="cq-carouselcontent">';
                $output .= $timelinecontent;
                $output .= '</div>';
            }

          $output .= '</div>';
          $output .= '</div>';
          $output .= '</div>';
          if($isdragbutton!="no"){
            $output .= '<div class="cq-menu-square">
                            <span class="value"></span>
                            <span class="cq-menu-line"></span>
                            <span class="cq-menu-line"></span>
                            <span class="cq-menu-line"></span>
                      </div>';
          }
          $output .= '</div>';
          $output .= '</div>';
          $output .= '<div class="cq-barcontainer">';

          if($avatarstyle=="image"){
            foreach ($imagesarr as $key => $image) {
                $i++;
                if(!isset($avatarlabels[$i])) $avatarlabels[$i] = '';
                $attachment = get_post($image);
                $return_img_arr = wp_get_attachment_image_src(trim($image), 'full');

                $img = $thumbnail = "";
                $fullimage = $return_img_arr[0];
                $thumbnail = $fullimage;
                if($imagewidth!=""){
                    if(function_exists('wpb_resize')){
                        $img = wpb_resize($image, null, $retina=="on"?$imagewidth*2:$imagewidth, $retina=="on"?$imagewidth*2:$imagewidth, true);
                        $thumbnail = $img['url'];
                        if($thumbnail=="") $thumbnail = $fullimage;
                    }
                }


                $output .= '<div class="cq-highlight-container">';
                if($return_img_arr[0]){
                    $output .= '<div class="cq-highlight '.$avatarshape.'">';
                      $output .= '<img src="'.$thumbnail.'" width="'.$imagewidth.'" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ).'" />';
                    $output .= '</div>';
                    if($avatarlabels[$i]!="") $output .= '<span class="cq-highlight-label">'.$avatarlabels[$i].'</span>';
                }
                $output .= '</div>';
            }

          }else if($avatarstyle=="icon"){
            foreach ($avataricons as $key => $icon) {
                $i++;
                if(!isset($avatarlabels[$i])) $avatarlabels[$i] = '';
                if(!isset($iconbgcolors[$i])) $iconbgcolors[$i] = '';
                $output .= '<div class="cq-highlight-container '.$avatarstyle.'">';
                if($icon){
                    $output .= '<div class="cq-highlight '.$avatarshape.'" data-iconbgcolors="'.$iconbgcolors[$i].'">';
                      $output .= '<span class="fa fa-1x '.$icon.'"></span>';
                    $output .= '</div>';
                    if($avatarlabels[$i]!="") $output .= '<span class="cq-highlight-label">'.$avatarlabels[$i].'</span>';
                }
                $output .= '</div>';
            }

          }else{
            foreach ($avatarlabels as $key => $label) {
                $i++;
                // if(!isset($avatarlabels[$i])) $avatarlabels[$i] = '';
                $output .= '<div class="cq-highlight-container '.$avatarstyle.'">';
                // $output .= '<div class="cq-highlight text-only '.$avatarshape.'">';
                // $output .= '</div>';
                if($label!="") {
                    $output .= '<span class="cq-highlight-label">';
                    $output .= $label;
                    $output .= '</span>';
                  }

                $output .= '</div>';
            }


          }


          $output .= '</div>';
          $output .= '</div>'; // end of cq-draggable-slider

          $output .= '</div>';

          return $output;

        }

  }

}

?>
