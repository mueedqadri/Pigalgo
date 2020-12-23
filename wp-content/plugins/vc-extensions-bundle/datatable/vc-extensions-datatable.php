<?php
if (!class_exists('VC_Extensions_DataTable')){
    class VC_Extensions_DataTable{
        function __construct() {
            vc_map(array(
            "name" => __("Data Table", 'cq_allinone_vc'),
            "base" => "cq_vc_datatable",
            "class" => "cq_vc_datatable",
            "icon" => "cq_vc_datatable",
            "category" => __('Sike Extensions', 'js_composer'),
            "as_parent" => array('only' => 'cq_vc_datatable_item'),
            // "content_element" => false,
            // "is_container" => true,
            "js_view" => 'VcColumnView',
            "show_settings_on_create" => true,
            'description' => __('Information table', 'js_composer'),
            "params" => array(
              array(
                "type" => "textfield",
                "heading" => __("Label 1", "cq_allinone_vc"),
                "param_name" => "label1",
                "group" => "Label",
                "value" => "",
                "description" => __("label for first column, for example, Name", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 2", "cq_allinone_vc"),
                "param_name" => "label2",
                "value" => "",
                "group" => "Label",
                "description" => __("label for second column, for example, Occupation", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 3 (optional)", "cq_allinone_vc"),
                "param_name" => "label3",
                "value" => "",
                "group" => "Label",
                "description" => __("label for third column, for example, Location", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 4 (optional)", "cq_allinone_vc"),
                "param_name" => "label4",
                "value" => "",
                "group" => "Label",
                "description" => __("label for fourth column", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 5 (optional)", "cq_allinone_vc"),
                "param_name" => "label5",
                "value" => "",
                "group" => "Label",
                "description" => __("label for fifth column", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 6 (optional)", "cq_allinone_vc"),
                "param_name" => "label6",
                "value" => "",
                "group" => "Label",
                "description" => __("label for sixth column", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 7 (optional)", "cq_allinone_vc"),
                "param_name" => "label7",
                "value" => "",
                "group" => "Label",
                "description" => __("label for seventh column", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 8 (optional)", "cq_allinone_vc"),
                "param_name" => "label8",
                "value" => "",
                "group" => "Label",
                "description" => __("label for eighth column", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 9 (optional)", "cq_allinone_vc"),
                "param_name" => "label9",
                "value" => "",
                "group" => "Label",
                "description" => __("label for ninth column", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Label 10 (optional)", "cq_allinone_vc"),
                "param_name" => "label10",
                "value" => "",
                "group" => "Label",
                "description" => __("label for tenth column", "cq_allinone_vc")
              ),

              // array(
              //   "type" => "textarea_html",
              //   "heading" => __("More description under the title", "cq_allinone_vc"),
              //   "param_name" => "content",
              //   "value" => "",
              //   "group" => "Text",
              //   "description" => __("", "cq_allinone_vc")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("width of the whole table", "cq_allinone_vc"),
                "param_name" => "elementwidth",
                "value" => "",
                "description" => __("Default is 100%, you can specify other value like <strong>80%</strong> etc here.", "cq_allinone_vc")
              ),
              array(
                   "type" => "dropdown",
                   "edit_field_class" => "vc_col-xs-6 vc_column",
                   "holder" => "",
                   "heading" => __("padding size of the cell", "cq_allinone_vc"),
                   "param_name" => "paddingsize",
                   "value" => array("small", "medium", "large"),
                  'std' => 'medium',
                  "description" => __("Select the padding size for the text in the cell.", "cq_allinone_vc")
              ),
              array(
                   "type" => "dropdown",
                   "edit_field_class" => "vc_col-xs-6 vc_column",
                   "holder" => "",
                   "heading" => __("Table row style", "cq_allinone_vc"),
                   "param_name" => "rowbg",
                   "value" => array("All white" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "gray", "Dark Gray" => "darkgray", "Transparent" => "transparent"),
                  'std' => 'gray',
                  "description" => __("Select the row background style.", "cq_allinone_vc")
              ),
              array(
                   "type" => "dropdown",
                   "edit_field_class" => "vc_col-xs-6 vc_column",
                   "holder" => "",
                   "heading" => __("Table header background color", "cq_allinone_vc"),
                   "param_name" => "headerbg",
                   "value" => array("White" => "white", "Aqua" => "aqua", "Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Transparent" => "transparent", "Customize color below" => "customized"),
                  'std' => 'bluejeans',
                  "description" => __("Select the table header background.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize panel background color", 'cq_allinone_vc'),
                "param_name" => "headerbgcolor",
                "value" => '',
                "dependency" => Array('element' => "headerbg", 'value' => array('customized')),
                "description" => __("", 'cq_allinone_vc')
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
                "description" => __("It's recommended to use this to customize the padding/margin only.", "cq_allinone_vc"),
                "group" => __( "Design options", "cq_allinone_vc" ),
             )
           )
        ));

        vc_map(
          array(
             "name" => __("Row value","cq_allinone_vc"),
             "base" => "cq_vc_datatable_item",
             "class" => "cq_vc_datatable_item",
             "icon" => "cq_vc_datatable_item",
             "category" => __('Sike Extensions', 'js_composer'),
             "description" => __("Add data for each column","cq_allinone_vc"),
             "as_child" => array('only' => 'cq_vc_datatable'),
             "show_settings_on_create" => true,
             "content_element" => true,
             "params" => array(
                array(
                  "type" => "textfield",
                  "heading" => __("Data 1", "cq_allinone_vc"),
                  "param_name" => "data1",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in first column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 2", "cq_allinone_vc"),
                  "param_name" => "data2",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in second column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 3 (optional)", "cq_allinone_vc"),
                  "param_name" => "data3",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in third column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 4 (optional)", "cq_allinone_vc"),
                  "param_name" => "data4",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in fourth column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 5 (optional)", "cq_allinone_vc"),
                  "param_name" => "data5",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in fifth column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 6 (optional)", "cq_allinone_vc"),
                  "param_name" => "data6",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in sixth column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 7 (optional)", "cq_allinone_vc"),
                  "param_name" => "data7",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in seventh column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 8 (optional)", "cq_allinone_vc"),
                  "param_name" => "data8",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in eighth column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 9 (optional)", "cq_allinone_vc"),
                  "param_name" => "data9",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in ninth column", "cq_allinone_vc")
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Data 10 (optional)", "cq_allinone_vc"),
                  "param_name" => "data10",
                  "value" => "",
                  "group" => "Data",
                  "description" => __("data in tenth column", "cq_allinone_vc")
                )

              ),
            )
        );

          add_shortcode('cq_vc_datatable', array($this,'cq_vc_datatable_func'));
          add_shortcode('cq_vc_datatable_item', array($this,'cq_vc_datatable_item_func'));

      }

      function cq_vc_datatable_func($atts, $content=null) {
        $label1 = $label2 = $label3 = $label4 = $label5 = $label6 = $label7 = $label8 = $label9 = $label10 = $headerbg = $headerbgcolor = $paddingsize = $rowbg = "";
        $css_class = $css = $title = $extraclass = $elementwidth = '';

        extract(shortcode_atts(array(
          "label1" => "",
          "label2" => "",
          "label3" => "",
          "label4" => "",
          "label5" => "",
          "label6" => "",
          "label7" => "",
          "label8" => "",
          "label9" => "",
          "label10" => "",
          "headerbg" => "bluejeans",
          "paddingsize" => "medium",
          "headerbgcolor" => "",
          "rowbg" => "gray",
          "title" => "",
          "elementwidth" => "",
          "css" => "",
          "extraclass" => ""
        ),$atts));

        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_datatable', $atts);
        wp_register_style( 'vc-extensions-datatable-style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'vc-extensions-datatable-style' );

        wp_register_script('vc-extensions-datatable-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
        wp_enqueue_script('vc-extensions-datatable-script');

        $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content


        // $header_attachment = get_post($image);
        // $headerimagearr = wp_get_attachment_image_src(trim($image), 'full');
        // $header_image_temp = $header_image_url = "";
        // $header_orgi_image = $headerimagearr[0];
        // $header_image_url = $header_orgi_image;
        // if( $imagewidth!="" ){
        //     if(function_exists('wpb_resize')){
        //         $header_image_temp = wpb_resize($image, null, $imagewidth, null);
        //         $header_image_url = $header_image_temp['url'];
        //         if($header_image_url=="") $header_image_url = $header_orgi_image;
        //     }
        // }

        $output = '';
        if($elementwidth!=""){
            $output .= '<div class="cq-datatable '.$css_class.' '.$extraclass.' cq-datatable-'.$paddingsize.' cq-datatable-'.$rowbg.'" style="width:'.$elementwidth.';margin:0 auto;">';
        }else{
            $output .= '<div class="cq-datatable '.$css_class.' '.$extraclass.' cq-datatable-'.$paddingsize.' cq-datatable-'.$rowbg.'">';
        }
        if($headerbgcolor!=""){
            $output .= '<div class="cq-datatable-row cq-datatable-header cq-datatable-bg-'.$headerbg.'" style="background:'.$headerbgcolor.'">';
        }else{
            $output .= '<div class="cq-datatable-row cq-datatable-header cq-datatable-bg-'.$headerbg.'">';
        }
        if($label1!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label1.'"> '.$label1.' </div>';
        if($label2!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label2.'"> '.$label2.' </div>';
        if($label3!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label3.'"> '.$label3.' </div>';
        if($label4!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label4.'"> '.$label4.' </div>';
        if($label5!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label5.'"> '.$label5.' </div>';
        if($label6!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label6.'"> '.$label6.' </div>';
        if($label7!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label7.'"> '.$label7.' </div>';
        if($label8!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label8.'"> '.$label8.' </div>';
        if($label9!="") $output .= '<div class="cq-datatable-cell" data-title="'.$label9.'"> '.$label9.' </div>';
        if($label10!="") $output .= '<div class="cq-datatable-cell" data-title=""'.$label10.'> '.$label10.' </div>';

        $output .= '</div>';

        $output .= do_shortcode($content);

        $output .= '</div>';
        return $output;

      }


      function cq_vc_datatable_item_func($atts, $content=null, $tag) {
          $data1 = $data2 = $data3 = $data4 = $data5 = $data6 = $data7 = $data8 = $data9 = $data10 = "";

          extract(shortcode_atts(array(
            "data1" => "",
            "data2" => "",
            "data3" => "",
            "data4" => "",
            "data5" => "",
            "data6" => "",
            "data7" => "",
            "data8" => "",
            "data9" => "",
            "data10" => "",
            "css" => ""
          ), $atts));

          $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content


          $output = '';
          $output .= '<div class="cq-datatable-row cq-datatable-data">';
          if($data1!="") $output .= '<div class="cq-datatable-cell"> '.$data1.' </div>';
          if($data2!="") $output .= '<div class="cq-datatable-cell"> '.$data2.' </div>';
          if($data3!="") $output .= '<div class="cq-datatable-cell"> '.$data3.' </div>';
          if($data4!="") $output .= '<div class="cq-datatable-cell"> '.$data4.' </div>';
          if($data5!="") $output .= '<div class="cq-datatable-cell"> '.$data5.' </div>';
          if($data6!="") $output .= '<div class="cq-datatable-cell"> '.$data6.' </div>';
          if($data7!="") $output .= '<div class="cq-datatable-cell"> '.$data7.' </div>';
          if($data8!="") $output .= '<div class="cq-datatable-cell"> '.$data8.' </div>';
          if($data9!="") $output .= '<div class="cq-datatable-cell"> '.$data9.' </div>';
          if($data10!="") $output .= '<div class="cq-datatable-cell"> '.$data10.' </div>';
          $output .= '</div>';

          return $output;

        }

  }
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_cq_vc_datatable')) {
    class WPBakeryShortCode_cq_vc_datatable extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_cq_vc_datatable_item')) {
    class WPBakeryShortCode_cq_vc_datatable_item extends WPBakeryShortCode {
    }
}

?>
