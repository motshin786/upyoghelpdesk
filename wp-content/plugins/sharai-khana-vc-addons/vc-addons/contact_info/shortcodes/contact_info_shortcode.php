<?php

add_shortcode('sharai_khana_contact_info', 'sharai_khana_contact_info');

function sharai_khana_contact_info( $atts, $content ) {
    
    extract(shortcode_atts(
            array(
                    'id' => 'logo_'.wp_rand(),
                    'custom_class_id' => wp_rand(),
                    'layout' => 'square-layout',
                    'contact_address_status'=> 1,
                    'contact_address' => '',
                    'contact_address_status'=> 1,
                    'contact_phone' => '',
                    'contact_email_status'=> 1,
                    'contact_email' => '',
                    'contact_web_status'=> 1,
                    'contact_web' => '',
                    'theme' => '',
                    'theme_color'=> SHARAI_KHANA_PRIMARY_COLOR,
                    'theme_icon_color'=> SHARAI_KHANA_LIGHT_TEXT_COLOR,
                    'cont_ext_class' => '',
                  ), $atts));
    
       $contact_info_class = $layout . ' ' . $cont_ext_class;
       
       // For Custom Theme.

        $custom_class = "";
        $custom_class_data = "";

        if (isset($theme) && !empty($theme) && $theme == "custom") {

            $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
            $custom_class_data.=".kc_" . $custom_class_id . " .contact-info .icon-container{background:" . $theme_color . " !important; color:" . $theme_icon_color . " !important;}";
        }

        // Wrapped By Data Attribute.

        if ($custom_class != "") {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }
       
        // Contact Info Block.
       
       $contact_address_html = "";
       if( !empty( $contact_address ) ) {
       $contact_address_html .= '<li class="'.$contact_info_class.'">
                                                    <span class="icon-container"><i class="fa fa-home"></i></span>
                                                    <address>' . $contact_address . '</address>
                                                </li>';
       }
       
       // Phone Info Block.
       
       $contact_phone_html = "";
       if( !empty( $contact_phone ) ) {
       $contact_phone_html .= '<li class="'.$contact_info_class.'">
                                                <span class="icon-container"><i class="fa fa-phone"></i></span>
                                                <address>' . $contact_phone . '</address>
                                            </li>';
       }
       
       // Email Block.
       
       $contact_email_html = "";
       
        if( !empty( $contact_email ) ) {
        
            $explode_contact_email = explode(',', trim($contact_email));
                
            foreach ($explode_contact_email as $value) {
                $contact_email_html .= '<a href="mailto:' . $value . '">' . $value . '</a>, ';
            }

            $contact_email_html = '<li class="'.$contact_info_class.'">
                                                    <span class="icon-container"><i class="fa fa-envelope"></i></span>
                                                    <address>' . substr( $contact_email_html, 0, strlen($contact_email_html)-2 ) . '</address>
                                                </li>';
        
        }
        
        // Web Block.
       
       $contact_web_html = "";
       
       if( !empty( $contact_web ) ) {
           
        $explode_contact_web = explode(',', trim($contact_web));
                
            foreach ($explode_contact_web as $value) {
                $contact_web_html .= '<a href="' . sharai_khana_addhttp($value) . '" target="_blank">' . $value . '</a>, ';
            }   
           
       $contact_web_html = '<li class="'.$contact_info_class.'">
                                                <span class="icon-container"><i class="fa fa-globe"></i></span>
                                                <address>' . substr( $contact_web_html, 0, strlen($contact_web_html)-2 ) . '</address>
                                            </li>';
       }
       
    
        $output ='<div class="row '.$custom_class.'" '.$custom_class_data.'>
        
                            <div class="col-md-12">

                                <ul class="contact-info">'.
                                    $contact_address_html.
                                    $contact_phone_html.
                                    $contact_email_html.
                                    $contact_web_html.'
                                </ul>                        

                            </div>
                </div>';
    
    return do_shortcode( sharai_khana_cleanup_shortcode( $output ) ); 
    
}