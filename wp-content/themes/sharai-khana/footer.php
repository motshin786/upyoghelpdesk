<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package sharai-khana
 */
?>

</div><!-- #content / .container end-->

<div class="bottom-footer-container">
    
        <div class="bottom-footer-container-overlay">
            
            <?php

                if (is_active_sidebar('bottom-jumbo-widget')  || is_active_sidebar('bottom-1') || is_active_sidebar('bottom-2') || is_active_sidebar('bottom-3') || is_active_sidebar('bottom-4') ) {
                    
                     // Footer Display Status.

                    global $post;

                    if (empty($post)) {
                        $post_id = 0;
                    } else {
                        $post_id = $post->ID;
                    }
                        
                    $sharai_khana_page_footer_status = get_post_meta( $post_id, SHARAI_KHANA_CMB_PREFIX . 'page_footer_status', $single = true);

                    if (isset($sharai_khana_page_footer_status) && $sharai_khana_page_footer_status == "") {
                        $sharai_khana_page_footer_status = 1;
                    }

                    if( $sharai_khana_page_footer_status == 1 ) {
                            
            ?>
        
                    <div id="bottom">

                        <div class="container">

                            <?php
                            
                                sharai_khana_jumbo_bottom_sidebar();

                                sharai_khana_count_bottom_sidebar();
                                
                            ?>

                        </div>

                    </div><!-- #bottom-->
                    
            <?php

                    } 
                    
                }

            ?>
        


    <footer id="colophon" class="site-footer">

        <div class="container">
            

               <?php if (sharai_khana_wp_option('enable_disable_custom_social') != '0') : ?>

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        
                        
                        <div class="social-icons">

                           <?php

                               if ($custom_social = sharai_khana_wp_option('custom_social')) :

                                   echo do_shortcode(wp_kses($custom_social, sharai_khana_allowed_tags()));

                               endif;

                           ?>

                       </div> <!-- end .custom_social  -->                      


                    </div> <!-- end .col-md-12  -->


                </div><!-- .row -->

<?php endif; ?>            

               <?php 
               
                if (sharai_khana_wp_option('enable_disable_footer_copyright') != '0') : 
                    
                   $footer_menu_display_status = sharai_khana_wp_option('footer_menu_display_status');
                   
                   if( $footer_menu_display_status == 1 ) {
                       
                       $site_footer_col_class = 'col-md-6 col-lg-6 text-left';
                        
                       
                   } else {
                       
                       $site_footer_col_class = 'col-lg-12 col-md-12 col-sm-12 text-center';
                       
                   }
                    
                ?>

                <div class="row">

                    <div class="<?php echo $site_footer_col_class; ?>">

                        <div class="copyright">

                            <?php
                                if ($copyright_text = sharai_khana_wp_option('custom_copyright')) :

                                    echo html_entity_decode(esc_attr($copyright_text));

                                else:

                                    echo html_entity_decode(esc_attr('Copyright &copy; '.date('Y').' - Sharai Khana. All Rights Reserved.'));

                                endif;

                                /* Theme Credit Notes */

                                $credit_notes = " Theme By <a href='https://bluewindlab.net/' target='_blank'>BlueWindLab</a>.";

                                if (1 == sharai_khana_wp_option('disable_theme_credit')) {
                                    $credit_notes = "";
                                }

                                echo $credit_notes;
                        ?>

                        </div> <!-- end .copyright  -->

                    </div> <!-- end .col-md-12  -->
                    
                    <?php if( $footer_menu_display_status == 1 ) : ?>

                        <div class="<?php echo $site_footer_col_class; ?>">

                            <?php if (has_nav_menu('footer-menu', 'sharai-khana')) : ?>

                                <nav>
                                    <?php
                                    wp_nav_menu(array(
                                        'container' => '',
                                        'menu_class' => 'footer-menu',
                                        'theme_location' => 'footer-menu')
                                    );
                                    ?>
                                </nav>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>


                </div><!-- .row -->

<?php endif; ?>

        </div> <!-- .container end -->

    </footer><!-- #colophon -->
    
    </div> <!-- end .bottom-footer-container-overlay  -->

</div> <!-- end .bottom-footer-container  -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>