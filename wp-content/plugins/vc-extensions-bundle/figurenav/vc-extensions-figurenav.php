<?php
if (!class_exists('VC_Extensions_FigureNav')) {

    class VC_Extensions_FigureNav {
        function __construct() {
          vc_map( array(
            "name" => __("Figure Navigation", 'vc_figurenav_cq'),
            "base" => "cq_vc_figurenav",
            "class" => "wpb_cq_vc_extension_figurenav",
            "controls" => "full",
            "icon" => "cq_allinone_figurenav",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __('Price table like list', 'js_composer' ),
            "params" => array(
              array(
                "type" => "attach_images",
                "heading" => __("Header images", "vc_figurenav_cq"),
                "param_name" => "images",
                "value" => "",
                "group" => "Header",
                "description" => __("Select images from media library.", "vc_figurenav_cq")
              ),
              array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Content text", "vc_figurenav_cq"),
                "param_name" => "content",
                "group" => "Content",
                "value" => __("<ul><li>I am Content text 1. Edit the content in the setting.</li> <li>You can put the VC button here. [vc_button2 title='My Profile' style='outlined' color='pink' size='md' link='url:http%3A%2F%2Fcodecanyon.net%2Fuser%2Fsike%3Fref%3Dsike||']</li></ul> \n\n Yet another text block, you can use this add-on as a price table. You can customize to display which block by default in the backend.[vc_button2 title='Text on the button' style='rounded' color='blue' size='md' link='url:http%3A%2F%2Fcodecanyon.net%2Fuser%2Fsike%3Fref%3Dsike||'] \n\n You can select the figure background color, figure font color, customize the border color, block background, each button's margin-top etc in the setting.[vc_button2 title='Text on the button' style='3d' color='vista_blue' size='md' link='url:http%3A%2F%2Fcodecanyon.net%2Fuser%2Fsike%3Fref%3Dsike||target:%20_blank'] \n\n Text block 4, you'll notice that there is no title and description for this.", "vc_figurenav_cq"),
                "description" => __("Enter content for each block here. Divide each with paragraph (Enter).", "vc_figurenav_cq")
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Label for each block", 'vc_figurenav_cq'),
                "param_name" => "labels",
                "value" => __("1,2,3,4", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Enter tooltip for each image here. Divide each with linebreaks (Enter).", 'vc_figurenav_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Title for each block", 'vc_figurenav_cq'),
                "param_name" => "titles",
                "value" => __("Hello title 1,Hello title 2,Hello title 3", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Enter title for each image here. Divide each with linebreaks (Enter).", 'vc_figurenav_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Title font sizee", 'vc_figurenav_cq'),
                "param_name" => "titlefontsize",
                "value" => __("16px", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Specify the title font size here, default is your 16px.", 'vc_figurenav_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Description for each block", 'vc_figurenav_cq'),
                "param_name" => "descriptions",
                "value" => __("Hello Description 1,Hello Description 2,Hello Description 3", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Enter Description for each image here. Divide each with linebreaks (Enter).", 'vc_figurenav_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Description font sizee", 'vc_figurenav_cq'),
                "param_name" => "descfontsize",
                "value" => __("13px", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Specify the Description font size here, default is 13px.", 'vc_figurenav_cq')
              ),

              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Header image width", 'vc_figurenav_cq'),
                "param_name" => "imagewidth",
                "value" => __("320", 'vc_figurenav_cq'),
                "group" => "Header",
                "description" => __("", 'vc_figurenav_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Header image height", 'vc_figurenav_cq'),
                "param_name" => "imageheight",
                "value" => __("240", 'vc_figurenav_cq'),
                "group" => "Header",
                "description" => __("", 'vc_figurenav_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Block text content width", 'vc_figurenav_cq'),
                "param_name" => "contentwidth",
                "value" => __("90%", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Specify the content width, default is 90%.", 'vc_figurenav_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Button width", 'vc_figurenav_cq'),
                "param_name" => "buttonwidth",
                "value" => __("90%", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Specify the button (inside the text block) width, default is 90%.", 'vc_figurenav_cq')
              ),
              array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Margin top of the button", 'vc_figurenav_cq'),
                "param_name" => "btnmargintop",
                "value" => __("", 'vc_figurenav_cq'),
                "group" => "Content",
                "description" => __("Specify the margin-top of the button in the content, default is 8px. Divide each with linebreaks (Enter).", 'vc_figurenav_cq')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Do not display the thumbnail in retina?", 'vc_figurenav_cq'),
                "param_name" => "noretina",
                "value" => array(__("No retina, please", "vc_figurenav_cq") => 'on'),
                "group" => "Header",
                "description" => __("Default is retina, check this if you do not want it.", 'vc_figurenav_cq')
              ),
              // array(
              //   "type" => "textfield",
              //   "holder" => "",
              //   "class" => "vc_figurenav_cq",
              //   "heading" => __("Margin top of each block", 'vc_figurenav_cq'),
              //   "param_name" => "blockmargintop",
              //   "value" => __("", 'vc_figurenav_cq'),
              //   "description" => __("Specify margin-top of each block, default is image 200px.", 'vc_figurenav_cq')
              // ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Item height when hover", 'vc_figurenav_cq'),
                "param_name" => "itemheight",
                "value" => __("480", 'vc_figurenav_cq'),
                "description" => __("Specify the height of each item, default is <strong>480</strong> (px).", 'vc_figurenav_cq')
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Min width of each block", 'vc_figurenav_cq'),
                "param_name" => "mintemwidth",
                "value" => __("", 'vc_figurenav_cq'),
                "description" => __("Specify the min-width of each item, default is 240px.", 'vc_figurenav_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Block background color", 'vc_figurenav_cq'),
                "param_name" => "itembackground",
                "value" => '',
                "description" => __("Specify the background color of each block here, default is transparent.", 'vc_figurenav_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content font color", 'vc_figurenav_cq'),
                "param_name" => "itemfontcolor",
                "value" => '',
                "description" => __("Specify the font color of the content.", 'vc_figurenav_cq')
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Block background image", "vc_figurenav_cq"),
                "param_name" => "itembgimage",
                "value" => "",
                "description" => __("Select background from media library.", "vc_figurenav_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Block background image repeat", "vc_figurenav_cq"),
                "param_name" => "repeat",
                "value" => array(__("repeat", "vc_figurenav_cq") => "repeat", __("no-repeat", "vc_figurenav_cq") => "no-repeat", __("repeat-x", "vc_figurenav_cq") => "repeat-x", __("repeat-y", "vc_figurenav_cq") => "repeat-y"),
                "description" => __("", "vc_figurenav_cq")
              ),
             array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Content text-align center", 'vc_figurenav_cq'),
                "param_name" => "aligncenter",
                "value" => array(__("Yes align center, please", "vc_figurenav_cq") => 'center'),
                "description" => __("Default align left, check this if you do not want it.", 'vc_figurenav_cq')
              ),
             array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Container width", 'vc_figurenav_cq'),
                "param_name" => "containerwidth",
                "value" => __("", 'vc_figurenav_cq'),
                "description" => __("Specify width of the whole container, default is 100%.", 'vc_figurenav_cq')
              ),
             array(
                "type" => "textfield",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Display which block by default", 'vc_figurenav_cq'),
                "param_name" => "displaynum",
                "value" => __("2", 'vc_figurenav_cq'),
                "description" => __("Specify to display which block by default, for example 1 will display first block, 2 will display second block.", 'vc_figurenav_cq')
              ),
             array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Select the figure background color", "vc_figurenav_cq"),
                "param_name" => "figurecolor",
                "value" => array(__("blue", "vc_figurenav_cq") => "", __("pink", "vc_figurenav_cq") => "pink", __("green", "vc_figurenav_cq") => "green", __("blue", "vc_figurenav_cq") => "blue", __("black", "vc_figurenav_cq") => "black", __("gray", "vc_figurenav_cq") => "gray", __("red", "vc_figurenav_cq") => "red", __("orange", "vc_figurenav_cq") => "orange", __("yellow", "vc_figurenav_cq") => "yellow"),
                "description" => __("", "vc_figurenav_cq")
              ),
             array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Figure font color", 'vc_figurenav_cq'),
                "param_name" => "figurefontcolor",
                "value" => '',
                "description" => __("Specify the border color of the figure.", 'vc_figurenav_cq')
              ),
             array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Figure border color", 'vc_figurenav_cq'),
                "param_name" => "bordercolor",
                "value" => '#87CEFA',
                "description" => __("Specify the border color of the figure.", 'vc_figurenav_cq')
              ),
             array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Background color for each block", 'vc_figurenav_cq'),
                "param_name" => "eachblockbg",
                "value" => __("", 'vc_figurenav_cq'),
                "description" => __("Enter background color for each block here. Divide each with linebreaks (Enter), leave here to blank if you want a global background.", 'vc_figurenav_cq')
              ),
             array(
                "type" => "exploded_textarea",
                "holder" => "",
                "class" => "vc_figurenav_cq",
                "heading" => __("Font color for each block", 'vc_figurenav_cq'),
                "param_name" => "eachblockcolor",
                "value" => __("", 'vc_figurenav_cq'),
                "description" => __("Enter font color for each block here. Divide each with linebreaks (Enter), leave here to blank if you want a global background.", 'vc_figurenav_cq')
              )


            )
        ));

        add_shortcode('cq_vc_figurenav', array($this,'cq_vc_figurenav_func'));

      }

      function cq_vc_figurenav_func($atts, $content=null, $tag) {
          $aligncenter = $images = $labels = $titles = $descriptions = $eachblockbg = $eachblockcolor = $btnmargintop = $itembgimage = $containerwidth = $buttonwidth = $contentwidth = $blockmargintop = $itemheight = $mintemwidth = $displaynum = $bordercolor = $imagewidth = $imageheight = $itemfontcolor = $itembackground = $repeat = $figurecolor = $figurefontcolor = "";

          extract( shortcode_atts( array(
            'images' => '',
            'itembgimage' => '',
            'itembackground' => '',
            'itemfontcolor' => '',
            'repeat' => '',
            'labels' => '1,2,3,4',
            'titles' => 'Hello title 1,Hello title 2,Hello title 3',
            'descriptions' => '',
            'imagewidth' => '320',
            'imageheight' => '240',
            'buttonwidth' => '90%',
            'contentwidth' => '90%',
            'itemheight' => '480',
            'mintemwidth' => '240',
            'btnmargintop' => '',
            'blockmargintop' => '',
            'containerwidth' => '',
            'aligncenter' => '',
            'displaynum' => '2',
            'bordercolor' => '#87CEFA',
            'eachblockbg' => '',
            'eachblockcolor' => '',
            'figurecolor' => '',
            'figurefontcolor' => '',
            'titlefontsize' => '',
            'descfontsize' => '',
            'noretina' => 'off'
          ), $atts ) );

          wp_register_style( 'vc_figurenav_cq_style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc_figurenav_cq_style' );

          wp_register_script('vc_figurenav_cq_script', plugins_url('js/jquery.figurenav.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc_figurenav_cq_script');


          $aligncenter = $aligncenter == 'center' ? 'center' : '';
          $imagesarr = explode(',', $images);
          $labelarr = explode(',', $labels);
          $titlearr = explode(',', $titles);
          $descarr = explode(',', $descriptions);
          $eachblockbgarr = explode(',', $eachblockbg);
          $eachblockcolorarr = explode(',', $eachblockcolor);
          $btnmargintoparr = explode(',', $btnmargintop);
          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';
          // $figurecontentarr = preg_split("/\r\n|\n|\r/", $content);
          // $figurecontentarr = preg_split('#(\r\n?|\n)+#', $content);
          $content = str_replace('</p>', '', trim($content));
          $figurecontentarr = explode('<p>', $content);

          $itembgimage = wp_get_attachment_image_src($itembgimage, 'full');

          $i = -1;
          $descstr = '';
          $titlestr = '';
          $output .= '<div class="cq-figure-cover" style="width:'.$containerwidth.'" data-buttonwidth="'.$buttonwidth.'" data-contentwidth="'.$contentwidth.'" data-blockmargintop="'.$blockmargintop.'" data-itemheight="'.$itemheight.'" data-mintemwidth="'.$mintemwidth.'" data-displaynum="'.$displaynum.'" data-bordercolor="'.$bordercolor.'">';
          foreach ($figurecontentarr as $key => $value) {
              $descstr = '';
              $titlestr = '';
              $i++;
              if(!isset($figurecontentarr[$i])) {
                $figurecontent = '';
              }else{
                $figurecontent = $figurecontentarr[$i];
              }
              if(!isset($imagesarr[$i])) $imagesarr[$i] = '';
              if(!isset($labelarr[$i])) $labelarr[$i] = '';
              if(!isset($titlearr[$i])) $titlearr[$i] = '';
              if(!isset($descarr[$i])) $descarr[$i] = '';
              if(!isset($btnmargintoparr[$i])) $btnmargintoparr[$i] = '';
              if(!isset($eachblockcolorarr[$i])) $eachblockcolorarr[$i] = '';
              if(!isset($eachblockbgarr[$i])) $eachblockbgarr[$i] = '';

              $return_img_arr = wp_get_attachment_image_src(trim($imagesarr[$i]), 'full');

              $img = $thumbnail = "";
              $fullimage = $return_img_arr[0];
              $thumbnail = $fullimage;
              if($imagewidth!=""){
                  if(function_exists('wpb_resize')){
                      $img = wpb_resize($imagesarr[$i], null, $noretina=="on"?$imagewidth:$imagewidth*2, $noretina=="on"?$imageheight:$imageheight*2);
                      $thumbnail = $img['url'];
                      if($thumbnail=="") $thumbnail = $fullimage;
                  }
              }


              $output .= '<div class="cq-figure-item" style="text-align:'.$aligncenter.';min-width:'.$mintemwidth.';color:'.$itemfontcolor.';background:'.$itembackground.' url('.$itembgimage[0].') '.$repeat.'"" data-btnmargintop="'.$btnmargintoparr[$i].'" data-bgcolor="'.$eachblockbgarr[$i].'" data-fontcolor="'.$eachblockcolorarr[$i].'">';
              $output .= '<figure class="cq-figure" style="border-bottom:4px solid '.$bordercolor.';background-image: url('.$thumbnail.');background-size:cover"></figure>';
              $output .= '<div class="handle '.$figurecolor.'" style="color:'.$figurefontcolor.';"><span class="label">'.$labelarr[$i].'</span></div>';
              $output .= '<div class="cq-figure-content">';
              $output .= $figurecontent;
              $output .= '</div>';
              if($descarr[$i]!=' '&&$descarr[$i]!='') $descstr .= '<span style="font-size:'.$descfontsize.';color:'.$itemfontcolor.';">'.$descarr[$i].'</span>';
              if($titlearr[$i]!=' '&&$titlearr[$i]!='') $titlestr .= '<h4 class="cq-figure-title" style="font-size:'.$titlefontsize.';color:'.$itemfontcolor.';">'.$titlearr[$i].$descstr.'</h4>';
              // $output .= '<h4 style="color:'.$itemfontcolor.';">'.$titlearr[$i].'</h4>';
              $output .= $titlestr;

              $output .= '</div>';

          }

          $output .= '</div>';

          return $output;

        }



  }


}

?>
