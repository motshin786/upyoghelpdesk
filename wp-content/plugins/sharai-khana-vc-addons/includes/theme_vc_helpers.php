<?php

function sharai_khana_addon_get_img( $attachment_id, $img_size="" ){
    
    $img_width = ( isset($img_size) && $img_size != "" ) ? $img_size : 'full';
    
    $img_string = wp_get_attachment_image($attachment_id, $img_width);
    
    return $img_string;
    
}

function sharai_khana_img_dimension( $attachment_id, $img_size="" ){
    
    $img_string = '';
    
    // thumbnail, medium, large, full
    
    $img_width = ( isset($img_size) && $img_size != "" ) ? $img_size : 'full';
    
    $image_info = wp_get_attachment_image_src( $attachment_id, $img_width);
    
    $image_srcset = wp_get_attachment_image_srcset( $attachment_id );
    
    if (isset( $image_info ) && !empty( $image_info ) ){

        $img_string.='src="' . $image_info[0] . '"';
        $img_string.=' width="'.$image_info[1].'" height="'.$image_info[2].'" ';
        $img_string.=' srcset="' .$image_srcset .'"';
    
    }
    
    return $img_string;
    
}

function sharai_khana_content_alignment(){
    
    $alignment = array(
       __('Select', 'sharai_khana_vc') => '', 
       __('Left', 'sharai_khana_vc') => 'left', 
       __('Center', 'sharai_khana_vc') => 'center', 
       __('Right', 'sharai_khana_vc') => 'right'
    );
    
    return $alignment;
}

function sharai_khana_content_tag(){
    
    $tags = array(
       __('Select', 'sharai_khana_vc') => '', 
       'h1' => 'h1', 
       'h2' => 'h2', 
       'h3' => 'h3', 
       'h4' => 'h4', 
       'h5' => 'h5', 
       'h6' => 'h6',
       'p' => 'p',
    );
    
    return $tags;
    
}

function sharai_khana_boolean_term(){
    
    $boolean_term = array(
       __('Select', 'sharai_khana_vc') => '', 
        __('Yes', 'sharai_khana_vc') => '1', 
        __('No', 'sharai_khana_vc') => '0'
    );
    
    return $boolean_term;
    
}

function sharai_khana_order_type(){
    
    $order_type_term = array(
       __('Select', 'sharai_khana_vc') => '', 
       __('Ascending', 'sharai_khana_vc') => 'ASC', 
       __('Descending', 'sharai_khana_vc') => 'DESC'
    );
    
    return $order_type_term;
    
}

function sharai_khana_order_by(){
    
    $order_by_term = array(
       __('Select', 'sharai_khana_vc') => '', 
       __('ID', 'sharai_khana_vc') => 'ID', 
       __('TITLE', 'sharai_khana_vc') => 'TITLE', 
       __('Date', 'sharai_khana_vc') => 'DATE',
       __('Random', 'sharai_khana_vc') => 'RAND'
    );
    
    return $order_by_term;
    
}

function sharai_khana_layout(){
    
    $layout_term = array(
       __('Select', 'sharai_khana_vc') => '',        
       __('Layout 01', 'sharai_khana_vc') => 'layout_1', 
       __('Layout 02', 'sharai_khana_vc') => 'layout_2'
    );
    
    return $layout_term;
    
}

function sharai_khana_counter_delay() {
    
    $counter_delay = array(
       '5' => '5', 
       '10' => '10', 
       '15' => '15', 
       '20' => '20', 
       '25' => '25', 
       '30' => '30', 
       '35' => '35', 
       '40' => '40', 
       '45' => '45', 
       '50' => '50', 
       '60' => '60', 
       '100' => '100'
    );
    
    return $counter_delay;
    
}

function sharai_khana_counter_time() {
    
     $wiz_counter_time = array(
       '1 Second' => '1000', 
       '2 Seconds' => '2000', 
       '3 Seconds' => '3000', 
       '5 Seconds' => '5000', 
       '10 Seconds' => '10000', 
       '20 Seconds' => '20000', 
       '30 Seconds' => '30000'
    );
     
     return $wiz_counter_time;
    
}

function sharai_khana_hex_to_rgb($hex) {

    $hex = str_replace("#", "", $hex);
    $color = array();

    if (strlen($hex) == 3) {
        $color['r'] = hexdec(substr($hex, 0, 1) . $r);
        $color['g'] = hexdec(substr($hex, 1, 1) . $g);
        $color['b'] = hexdec(substr($hex, 2, 1) . $b);
    } else if (strlen($hex) == 6) {
        $color['r'] = hexdec(substr($hex, 0, 2));
        $color['g'] = hexdec(substr($hex, 2, 2));
        $color['b'] = hexdec(substr($hex, 4, 2));
    }

    return implode(',', $color);
    
}

function sharai_khana_overlay_opacity() {
    
    $overlay_opacity = array(
       '0.9' => '0.9', 
       '0.8' => '0.8', 
       '0.7' => '0.7', 
       '0.6' => '0.6', 
       '0.5' => '0.5', 
       '0.4' => '0.4', 
       '0.3' => '0.3', 
       '0.2' => '0.2', 
       '0.1' => '0.1'
    );
    
    return $overlay_opacity;
    
}



// Added in version 1.0.1

function sharai_khana_items_per_row( $start=6, $end=1, $default_key="", $extra_item=array(), $position="") {
    
     $items_per_row = array();
     
     for( $i=$start; $i>=$end; $i--){
         
         $key_value = $i;
         
         if( $default_key !="" && $default_key == $key_value ) {
             $key_value = $key_value. __(' (Default)', 'sharai_khana_vc');
         }
         
         $items_per_row[$key_value] =  $i;
         
     }
     
     if( sizeof($extra_item) > 0 ) {
         
         if( $position == 'append') {
             
             $items_per_row = array_merge($items_per_row,$extra_item);
             
         } else {
             
            $items_per_row = array_merge($extra_item, $items_per_row);
            
         }
     }
     
     return $items_per_row;
    
}

// Added in version 1.0.1

function sharai_khana_border_radius($start = 0, $end = 10) {

    $border_radius = array();

    if ( $start > $end ) {
        
        for ($i = $start; $i >= $end; $i--) {

            $border_radius[$i . 'px'] = $i;
        }
        
    } else {
        
        for ($i = $start; $i <= $end; $i++) {

            $border_radius[$i . 'px'] = $i;
        }
        
    }
    
    return $border_radius;
    
}


function sharai_khana_carousel_timeout( $start=30, $end=5, $interval=5) {
    
     $carousel_timeout = array();
     
     for( $i=$start; $i>=$end; $i=$i-$interval){
         
         $carousel_timeout[$i . ' '.__('Seconds', 'sharai_khana_vc')] =  $i*1000;
         
     }
     
     return $carousel_timeout;
    
}

function sharai_khana_count_time( $start=50, $end=10, $interval=5) {
    
     $count_time = array();
     
     for( $i=$start; $i>=$end; $i=$i-$interval){
         
         $count_time[$i . ' '.__('Seconds', 'sharai_khana_vc')] =  $i*100;
         
     }
     
     return $count_time;
    
}

function sharai_khana_count_delay( $start=10, $end=1, $interval=1) {
    
     $count_delay = array();
     
     for( $i=$start; $i>=$end; $i=$i-$interval){
         
         $count_delay[$i . ' '.__('Milliseconds ', 'sharai_khana_vc')] =  $i;
         
     }
     
     return $count_delay;
    
}


function sharai_khana_column_class( $column = 3 ) {

    switch ($column) {

        case '1':
            return 'col-md-12 col-sm-12 col-xs-12';
            break;

        case '2':
            return 'col-md-6 col-sm-12 col-xs-12';
            break;

        case '3':
            return 'col-md-4 col-sm-6 col-xs-12';
            break;

        case '4':
            return 'col-md-3 col-sm-6 col-xs-12';
            break;
        
        case '6':
            return 'col-xs-12 col-sm-12 col-md-2';
            break;

        default:
            return 'col-md-3 col-sm-6 col-xs-12';
            break;
    }
    
}

function sharai_khana_counter_column_class( $column = 3 ) {

    switch ($column) {

        case '1':
            return 'col-md-12 col-sm-12 col-xs-12';
            break;

        case '2':
            return 'col-md-6 col-sm-12 col-xs-12';
            break;

        case '3':
            return 'col-md-4 col-sm-6 col-xs-12';
            break;

        case '4':
            return 'col-md-3 col-sm-6 col-xs-12';
            break;
        
        case '6':
            return 'col-md-2 col-sm-6 col-xs-12 ';
            break;

        default:
            return 'col-md-3 col-sm-6 col-xs-12';
            break;
    }
    
}

function sharai_khana_pricing_table_column_class( $column = 4 ) {

    switch ($column) {

        case '1':
            return 'col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0';
            break;

        case '2':
            return 'col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0';
            break;

        case '3':
            return 'col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0';
            break;

        case '4':
            return 'col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0';
            break;

        default:
            return 'col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0';
            break;
    }
    
}


function sharai_khana_gallery_column_class( $column = 4 ) {

    switch ($column) {

        case '1':
            return 'col-md-12 col-sm-12 col-xs-12';
            break;

        case '2':
            return 'col-md-6 col-sm-6 col-xs-12';
            break;

        case '3':
            return 'col-md-4 col-sm-6 col-xs-12';
            break;

        case '4':
            return 'col-md-3 col-sm-6 col-xs-12';
            break;

        default:
            return 'col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1';
            break;
    }
    
}

function sharai_khana_alignment_class( $alignment = "center" ) {

    switch ($alignment) {

        case 'left':
            return 'text-left';
            break;
        
        case 'right':
            return 'text-right';
            break;
        
        case 'justify':
            return 'text-justify';
            break;

        default:
            return 'text-center';
            break;
    }
}

function sharai_khana_price_table_title( $title = "" ) {

    switch ($title) {

        case 'year':
            return  __('Per Year', 'sharai_khana_vc');
            break;
        
        case 'day':
            return __('Per Day', 'sharai_khana_vc');
            break;
        
        case 'hour':
            return __('Per Hour', 'sharai_khana_vc');
            break;

        default:
            return __('Per Month', 'sharai_khana_vc');
            break;
    }
}

/*------------------------------  Fix & Clear Shortcode Isseus ---------------------------------*/

function sharai_khana_cleanup_shortcode( $shortcode ) {
    
    $shortcode_content = str_replace('`{`', '[', $shortcode);
    $clean_shortcode= str_replace('`}`', ']', $shortcode_content);
    return $clean_shortcode;
}

function sharai_khana_shortcode_empty_paragraph_fix($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}

add_filter('the_content', 'sharai_khana_shortcode_empty_paragraph_fix');


/*------------------------------  Create Custom Parameters ---------------------------------*/
 
if (function_exists('vc_add_shortcode_param')) {
    vc_add_shortcode_param('sharai_khana_hidden_field', 'cb_sharai_khana_hidden_field');
}

// Function generate param type "number"
function cb_sharai_khana_hidden_field($settings, $value) {
    
//    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';
    
    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}


/*------------------------------  Added http before URL ---------------------------------*/

function sharai_khana_addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}