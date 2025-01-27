<?php

add_shortcode('sharai_khana_team', 'sharai_khana_team');
add_shortcode('sharai_khana_team_item', 'sharai_khana_team_item');

//Main Team Block
        
function sharai_khana_team( $atts, $content ){

     $atts = shortcode_atts(array(
                        'id' => '',
                        'custom_class_id' => wp_rand(),
                        'layout' => 'layout_1',
                        'carousel'=> 0,
                        'carousel_items' => 3,
                        'carousel_nav' => 0,
                        'carousel_dots' => 0,
                        'carousel_autoplay' => 'true',
                        'carousel_autoplaytimeout' => 5000,
                        'theme' => '',
                        'theme_color'=> SHARAI_KHANA_PRIMARY_COLOR,
                        'social_icon_color'=> SHARAI_KHANA_LIGHT_TEXT_COLOR,
                        'social_icon_style'=> '',
                        'theme_team_name_color'=> '#1a1a1a',
                        'theme_team_desg_color'=> '#808080',
                        'cont_ext_class' => '',
                        'animation' => ''
                     ), $atts);
     
     extract($atts);

    // For Custom Theme.
     
     // Column.
     
     $columns = ( $carousel_items == "" ) ? 3 : $carousel_items;

    $custom_class = "";
    $custom_class_data = "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {
        
        
        $social_icon_style_css = ( isset( $social_icon_style ) && $social_icon_style=='square' ) ?  ' border-radius: 0px !important;' : '';

        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data.=".kc_" . $custom_class_id . " .team-layout-1 .team-meta h3{color: " . $theme_team_name_color . " ;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .team-layout-1 .team-meta h4{color: " . $theme_team_desg_color . " ;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .team-social-share a{background: " . $theme_color . "!important; color: " . $social_icon_color . "!important;".$social_icon_style_css."}";
        $custom_class_data.=".kc_" . $custom_class_id . " .team-social-share a:hover{background: " . $social_icon_color . "!important; color: " . $theme_color . "!important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .teams-container .owl-nav  i.nav-icon {background: " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .teams-container .owl-nav  i.nav-icon:hover {color: " . $theme_color . ";}";
    }
    
    // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        
    }

    $output ='<div class="item_'.$columns.' row ' . $custom_class.'" '.$custom_class_data.'>';
     
      // Starting div condition for carousel.
        if( $carousel == 1 ) {
            
            $carousel_nav_status = ( $carousel_nav ==1) ? 'false' : 'true';
            $carousel_dots_status = ( $carousel_dots ==1) ? 'false' : 'true';
            
           $output.='<div class="team-carousel owl-carousel" data-carousel="1" data-items="' . $carousel_items . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '"  data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
        }
     
            // Modified shortcode.

            $content = str_replace('[sharai_khana_team_item', '[sharai_khana_team_item layout="'.$layout.'" cont_ext_class="'.$cont_ext_class.'" animation="'.$animation.'" columns="'.$columns.'" ', $content);

            $output .=do_shortcode($content);
     
        // Ending div condition for carousel.    
        if( $carousel == 1 ) {
            $output .= '</div>';
        }
        
     $output .= '</div>';
     
     return $output;
    
}

// Generate Each Team Block.

function sharai_khana_team_item( $atts, $content ) {
    
    $atts = shortcode_atts(array(
        'layout' => 'layout_1',
        'columns' => '3',
        'content_alignment' => 'left',
        'team_name' => '',
        'team_info' => '',
        'team_image' => '',
        'team_custom_link' => '#',
        'social_link_status'=> 0,
        'team_facebook' => '#',
        'team_twitter' => '#',
        'team_google_plus' => '#',
        'team_linkedin' => '#',
        'animation' => '',
        'cont_ext_class' => ''        
     ), $atts);
    
    extract($atts);
    
    // Animation Class
    
    $sharai_khana_team_animation = "";
    
    if( isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button( array( 'base' => 'sharai_khana_team_item' ) );
        $sharai_khana_team_animation = " ".$animate_class->getCSSAnimation( $animation );
    }
    
    // Featured Image For Team.

    $feat_image_url_string = "";

    $feat_image_info = sharai_khana_addon_get_img( $team_image );

    if ( !empty( $feat_image_info ) ) {

        $feat_image_url_string.= $feat_image_info;

    }
    
    
    $get_column_class = sharai_khana_column_class($columns);
    
    if( $layout == "layout_2" ) {
        $layout_class = "team-layout-1 team-layout-2";
    } else {
        $layout_class = "team-layout-1";
    }
        
    $layout_class = $layout_class . " " .sharai_khana_alignment_class($content_alignment);
    
    // Generate Output.
    
    $team_custom_url = $team_custom_link;
    
    $team_custom_url_target = "";
            
    if( isset($team_custom_link) && $team_custom_link !="#") {

        $team_custom_string = vc_build_link($team_custom_link);
        $team_custom_url = esc_url( $team_custom_string['url'] );
        $team_custom_url_target = ( isset( $team_custom_string['target'] ) && $team_custom_string['target'] !="" ) ? ' target="_blank"' : '';
        
    }
    
    
    // Social Links.
    
    if ( isset( $social_link_status ) && $social_link_status == 1 ) {
        
        $social_link_html = "";
        
    } else {
        
        $social_link_html =  '<div class="team-social-share clearfix">
                                            <a class="fa fa-facebook rectangle" href="' . sharai_khana_addhttp( $team_facebook ) . '" title="Facebook" target="_blank"></a>
                                            <a class="fa fa-twitter rectangle" href="' . sharai_khana_addhttp( $team_twitter ) . '" title="Twitter" target="_blank"></a>
                                            <a class="fa fa-google-plus rectangle" href="' . sharai_khana_addhttp( $team_google_plus ) . '" title="Google Plus" target="_blank"></a>
                                            <a class="fa fa-linkedin rectangle" href="' . sharai_khana_addhttp( $team_linkedin ) . '" title="Linkedin" target="_blank"></a>
                                        </div> <!-- end .author-social-box  -->';
    }
    
    $layout_class.= ' ' . $cont_ext_class . ' ' . $sharai_khana_team_animation;
    
    $output ='<div class="'.$get_column_class.'">
                                <div class="'.$layout_class.'">       

                                    <figure class="team-member">
                                        <a href="' . $team_custom_url . '" title="' . $team_name . '" ' . $team_custom_url_target . '>
                                            ' . $feat_image_url_string . '
                                        </a>
                                    </figure> <!-- end. team-member  -->
                                    
                                    <article class="team-info">
                                    
                                         ' . $social_link_html . '

                                        <div class="team-meta">
                                            <h3><a href="' . $team_custom_url . '" title="' . $team_name . '" ' . $team_custom_url_target . '>' . $team_name . '</a></h3> 
                                            <h4>' . $team_info . '</h4> 
                                        </div><!-- end .team-meta  -->
                                    
                                    </article>   

                                </div>
                         </div>';
    
    return $output;
    
}