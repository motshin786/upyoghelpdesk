<?php

add_shortcode('sharai_khana_social_link', 'sharai_khana_social_link');

function sharai_khana_social_link( $atts, $content ) {
    
    extract(shortcode_atts(
            array(
                    'id'=> '',
                    'twitter_link' => '',
                    'facebook_link' => '',
                    'instagram_link' => '',
                    'pinterest_link' => '',
                    'cont_ext_class' => '',
                  ), $atts));

    
    $social_icon_class = 'social-icons margin-top-11 clearfix '. $cont_ext_class;
    
    $output ='<div class="'.$social_icon_class.'">
                    <a title="Tweet It" href="' . sharai_khana_addhttp ( $twitter_link ) . '" target="_blank" class="btn btn-social-icon">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a title="Share at Facebook" href="' . sharai_khana_addhttp ( $facebook_link ) . '" target="_blank" class="btn btn-social-icon">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a title="Share at Instagram" href="' . sharai_khana_addhttp ( $instagram_link ) . '" target="_blank" class="btn btn-social-icon">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a title="Share at Pinterest" href="' . sharai_khana_addhttp ( $pinterest_link ) . '" target="_blank" class="btn btn-social-icon">
                        <i class="fa fa-pinterest"></i>
                    </a>
             </div>';
    
    return do_shortcode( sharai_khana_cleanup_shortcode( $output ) ); 
    
    
}