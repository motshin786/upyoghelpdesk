<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'social_link/shortcodes/social_link_shortcode.php' );

// VC Elements.

function sharai_khana_social_link_vc_function() {
 
    vc_map(array(
        "name" => __("Social Link", 'sharai_khana_vc'),
        "description" => __( "Place Social Info In Page.", 'sharai_khana_vc'),
        "base" => "sharai_khana_social_link",
        "icon" => "icon-sharai-khana-vc-addon",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "params" => array(
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Twitter", 'sharai_khana_vc'),
                "param_name" => "twitter_link",
                "value" => "",
                "description" =>"",
                "group" => "General",
            ),  
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Facebook", 'sharai_khana_vc'),
                "param_name" => "facebook_link",
                "value" => "",
                "description" =>"",
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("instagram", 'sharai_khana_vc'),
                "param_name" => "instagram_link",
                "value" => "",
                "description" =>"",
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Pinterest", 'sharai_khana_vc'),
                "param_name" => "pinterest_link",
                "value" => "",
                "description" =>"",
                "group" => "General",
            ),
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class for social link layout.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
   
        )
    ));    
    
}

sharai_khana_social_link_vc_function();