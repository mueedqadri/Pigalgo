<?php
if (!class_exists('VC_Extensions_Accordion')) {

    class VC_Extensions_Accordion {
        private $accordionstyle, $arrowcolor, $titlecolor, $accordiontitlesize1, $titlepadding1, $contentbg, $contentcolor, $accordioncontentsize1, $withborder, $titlebg, $backgroundimage_url, $titlepadding2, $accordiontitlesize2, $withbordercolor, $accordioncontentsize2;
        function __construct() {
          vc_map( array(
            "name" => __("Accordion", 'vc_accordion_cq'),
            "base" => "cq_vc_accordion",
            "class" => "wpb_cq_vc_extension_accordion",
            "controls" => "full",
            "icon" => "cq_allinone_accordion",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_accordion_item'),
            "js_view" => 'VcColumnView',
            'description' => __( 'CSS3 accordion', 'js_composer' ),
            "params" => array(
              // array(
              //   "type" => "textarea_html",
              //   "holder" => "div",
              //   "heading" => __("Accordion content, divide(wrap) each one with [accordionitem][/accordionitem], please edit in text mode:", "vc_accordion_cq"),
              //   "param_name" => "content",
              //   "value" => __("[accordionitem]
              //     You have to wrap each accordion block in <strong>accordionitem</strong>.
              //     So you can put anything in it, like a image, video or other shortcode.
              //     [/accordionitem]
              //     [accordionitem]
              //     Hello accordion 2
              //     You can customize the title, color, font-size, accordion content etc in the backend.
              //     Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              //     [/accordionitem]
              //     [accordionitem]
              //     Hello accordion 3
              //     Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              //     [/accordionitem]
              //     [accordionitem]
              //     Yet another accordion.
              //     Hi amco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              //     <a href='http://codecanyon.net/user/sike?ref=sike'>Visit my profile</a> for more works.
              //     [/accordionitem]", "vc_accordion_cq"), "description" => __("Please try to edit in the <strong>Text</strong> mode.", "vc_accordion_cq") ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_accordion_cq",
                "heading" => __("Select accordion style", "vc_accordion_cq"),
                "param_name" => "accordionstyle",
                "value" => array(__("style 1", "vc_accordion_cq") => "style1", __("style 2", "vc_accordion_cq") => "style2"),
                "description" => __("", "vc_accordion_cq")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Accordion content font color", 'vc_accordion_cq'),
                "param_name" => "contentcolor",
                "value" => '#333',
                "description" => __("The color of accordion content.", 'vc_accordion_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Accordion content background color", 'vc_accordion_cq'),
                "param_name" => "contentbg",
                // "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "value" => '',
                "description" => __("The background color of accordion content.", 'vc_accordion_cq')
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Global title", "vc_accordion_cq"),
                "param_name" => "title",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style1')),
                "description" => __("The title of the whole element.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("font size of global title", "vc_accordion_cq"),
                "param_name" => "titlesize",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style1')),
                "description" => __("The size of the container title. Default is 1.4em.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("font size of each accordion item title", "vc_accordion_cq"),
                "param_name" => "accordiontitlesize1",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style1')),
                "description" => __("The font size of each accordion title. Default is 1.3em.", "vc_accordion_cq")
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("margin-top of the plus/close icon", "vc_accordion_cq"),
              //   "param_name" => "iconmargintop",
              //   "value" => "",
              //   "dependency" => Array('element' => "accordionstyle", 'value' => array('style1')),
              //   "description" => __("The margin-top of the plus/close icon, default is -8px, you may have to specify with other value if you change the title size/padding.", "vc_accordion_cq")
              // ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("font size of each accordion item content", "vc_accordion_cq"),
                "param_name" => "accordioncontentsize1",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style1')),
                "description" => __("The font size of each accordion content. Default is 1em.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("font size of each accordion item title", "vc_accordion_cq"),
                "param_name" => "accordiontitlesize2",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "description" => __("The font size of each accordion title. Default is 20px.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("font size of each accordion item content", "vc_accordion_cq"),
                "param_name" => "accordioncontentsize2",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "description" => __("The font size of each accordion content. Default is 1em.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS padding of the accordion title", "vc_accordion_cq"),
                "param_name" => "titlepadding1",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style1')),
                "description" => __("The CSS padding of the accordion title. Default is 18px 0, which stand for padding-top and padding-bottom is 18px.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS padding of the accordion title", "vc_accordion_cq"),
                "param_name" => "titlepadding2",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "description" => __("The CSS padding of the accordion title. Default is 1em.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS padding of the accordion content", "vc_accordion_cq"),
                "param_name" => "contentpadding",
                "value" => "",
                "description" => __("The CSS padding of the accordion content.", "vc_accordion_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Optional repeat pattern for the accordion title", "vc_accordion_cq"),
                "param_name" => "pattern",
                "value" => "",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "description" => __("Select image pattern from media library.", "vc_accordion_cq")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Accordion title color", 'vc_accordion_cq'),
                "param_name" => "titlecolor",
                "value" => '',
                "description" => __("The color of each accordion title.", 'vc_accordion_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Accordion title background color", 'vc_accordion_cq'),
                "param_name" => "titlebg",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "value" => '',
                "description" => __("", 'vc_accordion_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Accordion title hover font color", 'vc_accordion_cq'),
                "param_name" => "titlehovercolor",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "value" => '#fff',
                "description" => __("", 'vc_accordion_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Accordion title background hover color", 'vc_accordion_cq'),
                "param_name" => "titlehoverbg",
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "value" => '#00ACED',
                "description" => __("", 'vc_accordion_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_accordion_cq",
                "heading" => __("Border under each accordion Accordion?", "vc_accordion_cq"),
                "param_name" => "withborder",
                "value" => array(__("no", "vc_accordion_cq") => "", __("yes", "vc_accordion_cq") => "withBorder"),
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "description" => __("", "vc_accordion_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Color of border under each accordion title", 'vc_accordion_cq'),
                "param_name" => "withbordercolor",
                "dependency" => Array('element' => "withborder", 'value' => array('withBorder')),
                "value" => '',
                "description" => __("", 'vc_accordion_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_accordion_cq",
                "heading" => __("Display extra border under whole accordion?", "vc_accordion_cq"),
                "param_name" => "extraborder",
                "value" => array(__("no", "vc_accordion_cq") => "no", __("yes", "vc_accordion_cq") => "yes"),
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style2')),
                "description" => __("", "vc_accordion_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Extra border color", 'vc_accordion_cq'),
                "param_name" => "extrabordercolor",
                "dependency" => Array('element' => "extraborder", 'value' => array('yes')),
                "value" => '',
                "description" => __("", 'vc_accordion_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_accordion_cq",
                "heading" => __("Select arrow color", "vc_accordion_cq"),
                "param_name" => "arrowcolor",
                "value" => array(__("Default", "vc_accordion_cq") => "", __("red", "vc_accordion_cq") => "red", __("green", "vc_accordion_cq") => "green", __("yellow", "vc_accordion_cq") => "yellow", __("blue", "vc_accordion_cq") => "blue", __("orange", "vc_accordion_cq") => "orange", __("purple", "vc_accordion_cq") => "purple"),
                "dependency" => Array('element' => "accordionstyle", 'value' => array('style1')),
                "description" => __("You can select the arrow color here, default is gray.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Display how many words form the content if you don't specify the title", "vc_accordion_cq"),
                "param_name" => "titlewords",
                "value" => "4",
                "description" => __("We will fetch the words from the content if you don't specify title for the accordion. Default will fetch 4 words.", "vc_accordion_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Element width", "vc_accordion_cq"),
                "param_name" => "contaienrwidth",
                "value" => "",
                "description" => __("The width of the whole element, default is 100%. You can specify it with a smaller value, like 80%, and it will align center automatically.", "vc_accordion_cq")
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_accordion_cq",
                "heading" => __("Display first accordion by default?", 'vc_accordion_cq'),
                "param_name" => "displayfirst",
                "value" => array(__("Yes, display first accordion", "vc_accordion_cq") => 'on'),
                "description" => __("", 'vc_accordion_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_accordion_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_accordion_cq")
              )

            )
        ));


        vc_map(
          array(
             "name" => __("Accordion Item","cq_allinone_vc"),
             "base" => "cq_vc_accordion_item",
             "class" => "cq_vc_accordion_item",
             "icon" => "cq_vc_accordion_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add the title and content","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_accordion'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  "type" => "textfield",
                  "holder" => "",
                  "class" => "vc_accordion_cq",
                  "heading" => __("Accordion title", 'vc_accordion_cq'),
                  "param_name" => "accordiontitle",
                  "value" => __("", 'vc_accordion_cq'),
                  "description" => __("", 'vc_accordion_cq')
                ),
                array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Accordion content", "vc_accordion_cq"),
                "param_name" => "content",
                "value" => __("", "vc_accordion_cq"), "description" => __("", "vc_accordion_cq") )


              ),
            )
        );

        add_shortcode('cq_vc_accordion', array($this,'cq_vc_accordion_func'));
        add_shortcode('cq_vc_accordion_item', array($this,'cq_vc_accordion_item_func'));

      }

      function cq_vc_accordion_func($atts, $content=null, $tag) {
            $accordionstyle = "style1";
            $arrowcolor = $titlecolor = $accordiontitlesize1 = $titlepadding1 = $contentbg = $contentcolor = $accordioncontentsize1 = $withborder = $titlebg = $pattern = $titlepadding2 = $accordiontitlesize2 = $accordioncontentsize2 = "";
            extract( shortcode_atts( array(
              'accordionstyle' => 'style1',
              'title' => '',
              'titlebg' => '',
              'pattern' => '',
              'titlehoverbg' => '',
              'titlehovercolor' => '',
              'titlesize' => '',
              'accordiontitle' => '',
              'accordiontitlesize1' => '',
              'accordiontitlesize2' => '',
              'accordioncontentsize1' => '',
              'accordioncontentsize2' => '',
              'titlecolor' => '',
              'contentcolor' => '',
              'contentbg' => '',
              'arrowcolor' => '',
              'titlepadding1' => '',
              'titlepadding2' => '',
              'titlewords' => '4',
              'extraborder' => '',
              'withborder' => '',
              'withbordercolor' => '',
              'extrabordercolor' => '',
              'contaienrwidth' => '',
              'displayfirst' => '',
              'extra_class' => ''
            ), $atts ) );

          wp_register_style( 'vc_accordion_cq_style', plugins_url('css/style.css', __FILE__));
          wp_enqueue_style( 'vc_accordion_cq_style' );

          wp_register_script('vc_accordion_cq_script', plugins_url('js/script.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc_accordion_cq_script');

          $pattern = wp_get_attachment_image_src($pattern, 'full');
          $this -> accordionstyle = $accordionstyle;
          $this -> arrowcolor = $arrowcolor;
          $this -> titlecolor = $titlecolor;
          $this -> accordiontitlesize1 = $accordiontitlesize1;
          $this -> titlepadding1 = $titlepadding1;
          $this -> contentbg = $contentbg;
          $this -> contentcolor = $contentcolor;
          $this -> accordioncontentsize1 = $accordioncontentsize1;
          $this -> withborder = $withborder;
          $this -> titlebg = $titlebg;
          $this -> titlepadding2 = $titlepadding2;
          $this -> accordiontitlesize2 = $accordiontitlesize2;
          $this -> withbordercolor = $withbordercolor;
          $this -> accordioncontentsize2 = $accordioncontentsize2;
          $this -> backgroundimage_url = $pattern[0];
          $i = -1;
          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

          $output = '';
          if($accordionstyle=="style1"){
            $output = '<div class="cq-accordion '.$extra_class.'" style="width:'.$contaienrwidth.';" data-displayfirst="'.$displayfirst.'">';
            if($title!=""){
                $output .= '<h3 style="color:'.$titlecolor.';font-size:'.$titlesize.';">';
                $output .= $title;
                $output .= '</h3>';
              }

            $output .= '<ul>';
            $output .= do_shortcode($content);
            $output .= '</ul>';
            $output .= '</div>';
          }else{
            $output .= '<div class="cq-accordion2 '.$extra_class.'" style="width:'.$contaienrwidth.';" data-titlecolor="'.$titlecolor.'" data-titlebg="'.$titlebg.'" data-titlehoverbg="'.$titlehoverbg.'" data-titlehovercolor="'.$titlehovercolor.'" data-displayfirst="'.$displayfirst.'">';
            if($extraborder=="yes"){
                  $output .= '<div class="extraborder" style="background-color:'.$extrabordercolor.';"></div>';
              }
            $output .= '<dl>';
            $output .= do_shortcode($content);
            $output .= '</dl>';
            $output .= '</div>';

          }

          return $output;

        }

        function cq_vc_accordion_item_func($atts, $content=null) {
            extract(shortcode_atts(array(
              "accordiontitle" => ""
            ), $atts));

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

          $output = "";
          if($this->accordionstyle=="style1"){
              $output .= '<li>';
              $output .= '<input type="checkbox" checked>';
              $output .= '<i class="'.$this->arrowcolor.'"></i>';
              $output .= '<h4 style="color:'.$this->titlecolor.';font-size:'.$this->accordiontitlesize1.';padding:'.$this->titlepadding1.';">'.$accordiontitle.'</h4>';
              $output .= '<div class="accordion-content" style="background-color:'.$this->contentbg.';color:'.$this->contentcolor.';font-size:'.$this->accordioncontentsize1.';">';
              $output .= do_shortcode($content);
              $output .= '</div>';
              $output .= '</li>';

          }else{
              $output .= '<dt>';
              $output .= '<a class="accordionTitle '.$this->withborder.'" style="background-color:'.$this->titlebg.';background-image:url('.$this->backgroundimage_url.');padding:'.$this->titlepadding2.';color:'.$this->titlecolor.';border-color:'.$this->withbordercolor.';" href="#">';
              $output .= '<i class="accordion-icon">+</i>';

              $output .= '<span style="font-size:'.$this->accordiontitlesize2.';">';
              $output .= $accordiontitle;
              $output .= '</span>';
              $output .= '</a>';

              $output .= '</dt>';
              $output .= '<dd class="accordionItem accordionItemCollapsed">';
              $output .= '<div class="accordion-content" style="background-color:'.$this->contentbg.';color:'.$this->contentcolor.';font-size:'.$this->accordioncontentsize2.';">';
              $output .= do_shortcode($content);
              $output .= '</div>';
              $output .= '</dd>';

          }


          return $output;

        }




  }


}

if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_accordion')) {
    class WPBakeryShortCode_cq_vc_accordion extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_accordion_item')) {
    class WPBakeryShortCode_cq_vc_accordion_item extends WPBakeryShortCode {
    }
}


?>
