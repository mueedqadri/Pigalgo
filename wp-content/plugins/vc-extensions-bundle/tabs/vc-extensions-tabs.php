<?php
if (!class_exists('VC_Extensions_Tabs')) {

    class VC_Extensions_Tabs {
        private $tabsstyle, $titlebg, $titlecolor, $titlehoverbg, $contentbg, $contentcolor,  $content_str;
        private $menu_str = '';
        function __construct() {
          vc_map( array(
            "name" => __("Tabs", 'vc_tabs_cq'),
            "base" => "cq_vc_tabs",
            "class" => "wpb_cq_vc_extension_tab",
            "controls" => "full",
            "icon" => "cq_allinone_tab",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_tab_item'),
            "js_view" => 'VcColumnView',
            'description' => __( 'Tabbed content', 'js_composer' ),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_tabs_cq",
                "heading" => __("Select tabs style", "vc_tabs_cq"),
                "param_name" => "tabsstyle",
                "value" => array(__("style 1", "vc_tabs_cq") => "style1", __("style 2", "vc_tabs_cq") => "style2", __("style 3", "vc_tabs_cq") => "style3"),
                "description" => __("", "vc_tabs_cq")
              ),
              // array(
              //   "type" => "textarea_html",
              //   "holder" => "div",
              //   "heading" => __("Tabs content, divide(wrap) each one with [tabitem][/tabitem], please edit in text mode:", "vc_tabs_cq"),
              //   "param_name" => "content",
              //   "value" => __("[tabitem]
              //     You have to wrap each tabs block with <strong>tabitem</strong>.
              //     So you can put anything in it, like a image, video and other shortcode.
              //     [/tabitem]
              //     [tabitem]
              //       Tab content 2, please edit it in the text editor.
              //     [/tabitem]
              //     [tabitem]
              //       Tab content 3, please edit it in the text editor.
              //       <a href='http://codecanyon.net/user/sike?ref=sike'>Visit my profile</a> for more works.
              //     [/tabitem]
              //     [tabitem]
              //       Yet another content, please edit it in the text editor.
              //     [/tabitem]", "vc_tabs_cq"), "description" => __("Please try to edit in the <strong>Text</strong> mode.", "vc_tabs_cq") ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content font color", 'vc_tabs_cq'),
                "param_name" => "contentcolor1",
                "value" => '',
                "dependency" => Array('element' => "tabsstyle", 'value' => array('style1', 'style3')),
                "description" => __("The color of tabs content.", 'vc_tabs_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content font color", 'vc_tabs_cq'),
                "param_name" => "contentcolor2",
                "value" => '',
                "dependency" => Array('element' => "tabsstyle", 'value' => array('style2')),
                "description" => __("The color of tabs content.", 'vc_tabs_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content background color", 'vc_tabs_cq'),
                "param_name" => "contentbg1",
                "dependency" => Array('element' => "tabsstyle", 'value' => array('style1','style3')),
                "value" => '',
                "description" => __("The background color of tabs content.", 'vc_tabs_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content background color", 'vc_tabs_cq'),
                "param_name" => "contentbg2",
                "dependency" => Array('element' => "tabsstyle", 'value' => array('style2')),
                "value" => '',
                "description" => __("The background color of tabs content.", 'vc_tabs_cq')
              ),

              // array(
              //   "type" => "exploded_textarea",
              //   "holder" => "",
              //   "class" => "vc_tabs_cq",
              //   "heading" => __("Tab menu", 'vc_tabs_cq'),
              //   "param_name" => "tabstitle",
              //   "value" => __("Tab 1,Tab 2,Tab 3,Another Tab", 'vc_tabs_cq'),
              //   "description" => __("Menu title for each tabs, divide with linebreak (Enter).", 'vc_tabs_cq')
              // ),
              // array(
              //   "type" => "dropdown",
              //   "holder" => "",
              //   "class" => "vc_tabs_cq",
              //   "heading" => __("Menu support Font Awesome icon?", "vc_tabs_cq"),
              //   "param_name" => "iconsupport",
              //   "value" => array(__("yes", "vc_tabs_cq") => "yes", __("no", "vc_tabs_cq") => "no"),
              //   "description" => __("", "vc_tabs_cq")
              // ),
              // array(
              //   "type" => "exploded_textarea",
              //   "holder" => "",
              //   "class" => "vc_tabs_cq",
              //   "heading" => __("Icon for each tab menu", 'vc_tabs_cq'),
              //   "param_name" => "tabsicon",
              //   "value" => __("fa-cloud,fa-image,fa-coffee,fa-comment", 'vc_tabs_cq'),
              //   "dependency" => Array('element' => "iconsupport", 'value' => array('yes')),
              //   "description" => __("Put the <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a> here, divide with linebreak (Enter).", 'vc_tabs_cq')
              // ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Tab menu color", 'vc_tabs_cq'),
                "param_name" => "titlecolor",
                "value" => '',
                "description" => __("The font color of tab in normal mode.", 'vc_tabs_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Tab menu background color", 'vc_tabs_cq'),
                "param_name" => "titlebg",
                "value" => '',
                "description" => __("The background color of tab in normal mode.", 'vc_tabs_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Tab menu hover font color", 'vc_tabs_cq'),
                "param_name" => "titlehovercolor",
                // "dependency" => Array('element' => "tabsstyle", 'value' => array('style2')),
                "value" => '',
                "description" => __("The font color of tab when user hover or in current mode.", 'vc_tabs_cq')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Tab menu background hover color", 'vc_tabs_cq'),
                "param_name" => "titlehoverbg",
                // "dependency" => Array('element' => "tabsstyle", 'value' => array('style2')),
                "value" => '',
                "description" => __("The background color of tab when user hover or in current mode.", 'vc_tabs_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_tabs_cq",
                "heading" => __("Auto rotate tabs", "vc_tabs_cq"),
                "param_name" => "rotatetabs",
                'value' => array( 3, 5, 10, 15, __( 'Disable', 'vc_tabs_cq' ) => 0 ),
                'std' => 0,
                "description" => __("Auto rotate tabs each X seconds.", "vc_tabs_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Container width", "vc_tabs_cq"),
                "param_name" => "contaienrwidth",
                "value" => "",
                "description" => __("The width of the whole contaienr, default is 100%. You can specify it with a smaller value, like 80%, and it will align center automatically.", "vc_tabs_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_tabs_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_tabs_cq")
              )

            )
        ));


        vc_map(
          array(
             "name" => __("Tab Item","cq_allinone_vc"),
             "base" => "cq_vc_tab_item",
             "class" => "cq_vc_tab_item",
             "icon" => "cq_allinone_tab_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add the title and content","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_tabs'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  'type' => 'dropdown',
                  'heading' => __( 'Icon library', 'js_composer' ),
                  'value' => array(
                    __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                    __( 'Entypo', 'js_composer' ) => 'entypo',
                    __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                    __( 'Typicons', 'js_composer' ) => 'typicons',
                    __( 'Linecons', 'js_composer' ) => 'linecons',
                    __( 'Material', 'js_composer' ) => 'material',
                    // __( 'Mono Social', 'js_composer' ) => 'monosocial',
                  ),
                  'admin_label' => true,
                  'param_name' => 'tabicon',
                  'description' => __( 'Select icon library.', 'js_composer' ),
                ),
                array(
                  'type' => 'iconpicker',
                  'heading' => __( 'Icon', 'js_composer' ),
                  'param_name' => 'icon_fontawesome',
                  'value' => '', // default value to backend editor admin_label
                  'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                  ),
                  'dependency' => array(
                    'element' => 'tabicon',
                    'value' => 'fontawesome',
                  ),
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
                    'element' => 'tabicon',
                    'value' => 'openiconic',
                  ),
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
                    'element' => 'tabicon',
                    'value' => 'typicons',
                  ),
                  'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                  'type' => 'iconpicker',
                  'heading' => __( 'Icon', 'js_composer' ),
                  'param_name' => 'icon_entypo',
                  'value' => 'entypo-icon entypo-icon-user', // default value to backend editor admin_label
                  'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                  ),
                  'dependency' => array(
                    'element' => 'tabicon',
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
                    'element' => 'tabicon',
                    'value' => 'linecons',
                  ),
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
                    'element' => 'tabicon',
                    'value' => 'material',
                  ),
                  'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                  "type" => "textfield",
                  "holder" => "",
                  "class" => "vc_tab_cq",
                  "heading" => __("Tab title", 'vc_tab_cq'),
                  "param_name" => "tabtitle",
                  "value" => __("", 'vc_tab_cq'),
                  "description" => __("", 'vc_tab_cq')
                ),
                array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Tab content", "vc_tab_cq"),
                "param_name" => "content",
                "value" => __("", "vc_tab_cq"), "description" => __("", "vc_tab_cq") )


              ),
            )
        );
        add_shortcode('cq_vc_tabs', array($this,'cq_vc_tabs_func'));
        add_shortcode('cq_vc_tab_item', array($this,'cq_vc_tab_item_func'));
      }

      function cq_vc_tabs_func($atts, $content=null, $tag) {
          $tabsstyle = $titlebg = $titlecolor = $titlehoverbg = $contentbg = $contentcolor = "";
          extract( shortcode_atts( array(
            'tabsstyle' => 'style1',
            'titlecolor' => '',
            'titlebg' => '',
            'titlehoverbg' => '',
            'titlehovercolor' => '',
            'tabstitlesize2' => '',
            'contentcolor1' => '',
            'contentbg1' => '',
            'contentcolor2' => '',
            'contentbg2' => '',
            'contaienrwidth' => '',
            'rotatetabs' => '0',
            'iconsupport' => 'yes',
            'extra_class' => ''
          ), $atts ) );


          if($tabsstyle=="style2"){
            $contentcolor = $contentcolor2;
            $contentbg = $contentbg2;
          }else{
            $contentcolor = $contentcolor1;
            $contentbg = $contentbg1;
          }


          $this -> tabsstyle = $tabsstyle;
          $this -> titlebg = $titlebg;
          $this -> titlecolor = $titlecolor;
          $this -> titlehoverbg = $titlehoverbg;
          $this -> contentbg = $contentbg;
          $this -> contentcolor = $contentcolor;
          $this -> menu_str = '';

          if($iconsupport=="yes"){
            wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
            wp_enqueue_style( 'font-awesome' );
          }

          wp_register_style( 'vc_tabs_cq_style', plugins_url('css/style.css', __FILE__));
          wp_enqueue_style( 'vc_tabs_cq_style' );

          wp_register_script('vc_tabs_cq_script', plugins_url('js/script.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc_tabs_cq_script');


          $i = -1;


          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

          // $content = preg_replace( '#<p>\s*</p>#', '', $content );
          // if(strpos($content, '[/tabitem]')===false){
          //     $content = str_replace('</div>', '', trim($content));
          //     $contentarr = explode('<div class="tabs-content">', trim($content));
          // }else{
          //     $content = str_replace('[/tabitem]', '', trim($content));
          //     $contentarr = explode('[tabitem]', trim($content));
          // }
          // array_shift($contentarr);
          // $tabstitle = explode(',', $tabstitle);
          $output = '';
          $all_start = $all_end = '';
          $menu_start = $menu_content = $menu_end = '';
          $container_start = $container_content = $container_end = '';

          $output .= '<div class="cq-tabs '.$extra_class.'" style="width:'.$contaienrwidth.'" data-tabsstyle="'.$tabsstyle.'" data-titlebg="'.$titlebg.'" data-titlecolor="'.$titlecolor.'" data-titlehoverbg="'.$titlehoverbg.'" data-titlehovercolor="'.$titlehovercolor.'" data-rotatetabs="'.$rotatetabs.'">';


          if($tabsstyle=="style1"){
              $output .= '<ul class="cq-tabmenu '.$tabsstyle.'" style="background-color:'.$titlebg.';border-bottom-color:'.$titlehoverbg.';">';
          }else if($tabsstyle=="style2"){
              $output .= '<ul class="cq-tabmenu '.$tabsstyle.'">';
          }else{
              $output .= '<ul class="cq-tabmenu '.$tabsstyle.'">';
          }
          $output .= $this -> menu_str;
          $output .= '</ul>';

          $output .= '<div class="cq-tabcontent '.$tabsstyle.'" style="background:'.$contentbg.';">';
          $output .= do_shortcode($content);
          $output .= '</div>';
          $output .= '</div>';

          return $output;

        }
        function cq_vc_tab_item_func($atts, $content=null, $tag) {
          $tabicon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = $icon_monosocial = "";
          extract(shortcode_atts(array(
              "tabicon" => "fontawesome",
              "icon_fontawesome" => "",
              "icon_openiconic" => "vc-oi vc-oi-dial",
              "icon_typicons" => "typcn typcn-adjust-brightness",
              "icon_entypo" => "entypo-icon entypo-icon-user",
              "icon_linecons" => "vc_li vc_li-heart",
              "icon_material" => 'vc-material vc-material-cake',
              "icon_pixelicons" => "",
              "icon_monosocial" => "",
              "tabtitle" => ""
            ), $atts));

          vc_icon_element_fonts_enqueue($tabicon);

          $output = '';

          $menu_str = $this -> menu_str;
          // if($this->tabsstyle=="style1"){
          //     $menu_str .= '<ul class="cq-tabmenu '.$this->tabsstyle.'" style="background-color:'.$this->titlebg.';border-bottom-color:'.$this->titlehoverbg.';">';
          // }else if($this->tabsstyle=="style2"){
          //     $menu_str .= '<ul class="cq-tabmenu '.$this->tabsstyle.'">';
          // }else{
          //     $menu_str .= '<ul class="cq-tabmenu '.$this->tabsstyle.'">';
          // }

          if(!isset($tabtitle) || $tabtitle == "") $tabtitle = 'Tab';
          if($this->tabsstyle=="style3"){
              $menu_str .= '<li style="background-color:'.$this->titlebg.';">';
              $menu_str .= '<a href="#" style="color:'.$this->titlecolor.';">';
              $menu_str .= '<span>';
              // if($tabsicon[$i]!="")$menu_str .= '<i class="fa pull-left fa-1x '.$tabsicon[$i].'"></i>';
              if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $tabicon})&&esc_attr(${'icon_' . $tabicon})!=""){
                  $menu_str .= '<i class="cq-tab-icon '.esc_attr(${'icon_' . $tabicon}).'"></i> ';
              }
              $menu_str .= $tabtitle;
              $menu_str .= '</span>';
              $menu_str .= '</a>';
              $menu_str .= '</li>';
          }else if($this->tabsstyle=="style2"){
              $menu_str .= '<li>';
              $menu_str .= '<a href="#" style="background-color:'.$this->titlebg.';color:'.$this->titlecolor.';">';
              if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $tabicon})&&esc_attr(${'icon_' . $tabicon})!=""){
                  $menu_str .= '<i class="cq-tab-icon '.esc_attr(${'icon_' . $tabicon}).'"></i> ';
              }
              $menu_str .= $tabtitle;
              $menu_str .= '</a>';
              $menu_str .= '</li>';
          }else{
              $menu_str .= '<li style="background-color:'.$this->titlebg.';">';
              $menu_str .= '<a href="#" style="color:'.$this->titlecolor.';">';
              if(version_compare(WPB_VC_VERSION,  "4.4")>=0&&isset(${'icon_' . $tabicon})&&esc_attr(${'icon_' . $tabicon})!=""){
                  $menu_str .= '<i class="cq-tab-icon '.esc_attr(${'icon_' . $tabicon}).'"></i> ';
              }
              $menu_str .= $tabtitle;
              $menu_str .= '</a>';
              $menu_str .= '</li>';

          }
          // $menu_str .= '</ul>';
          // $menu_str .= $menu_str;
          $this -> menu_str = $menu_str;


          // $output .= '<div class="cq-tabcontent '.$this->tabsstyle.'" style="background:'.$this->contentbg.';">';

          $output .= '<div class="cq-tabitem" style="color:'.$this->contentcolor.';">';
          // $thecontent = preg_replace('/^(<br \/>)*/', "", $thecontent);
          $output .= $content;
          $output .= '</div>';
          // $output .= '</div>';

          return $output;

        }


  }

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_tabs')) {
    class WPBakeryShortCode_cq_vc_tabs extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_tab_item')) {
    class WPBakeryShortCode_cq_vc_tab_item extends WPBakeryShortCode {
    }
}


?>
