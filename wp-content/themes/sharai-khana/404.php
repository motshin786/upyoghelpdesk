<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package sharai-khana
 */

global $sharai_khana_wp_option;

$theme_default_header_style = sharai_khana_wp_option('theme_default_header_style');

if( $theme_default_header_style == "" ) {
    $theme_default_header_style = "";
}

get_header($theme_default_header_style);

?>

<div class="row">

    <div id="primary" class="col-md-12 col-lg-12">
        <main id="main" class="site-main">

            <section class="error-404 not-found">

                <div class="page-content">
                    
                    <div class="row">

                        <div class="col-sm-12 message-container-404">

                            <div class="text-404">
                                <?php esc_html_e('4', 'sharai-khana'); ?><span class="light-color"><?php esc_html_e('0', 'sharai-khana'); ?></span><?php esc_html_e('4', 'sharai-khana'); ?>
                            </div> 

                            <p class="message-text-404">
                                <?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'sharai-khana'); ?>
                            </p> <!-- end 404-message-text  -->
                            
                            <div class="search-form-404">
                                
                                <form action="<?php echo esc_url(home_url('/')); ?>" id="search-form" class="search-form" method="get">

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control search-query" name="s" placeholder="<?php esc_html_e('Search', 'sharai-khana'); ?>">
                                    </div>

                                    <input type="hidden" value="<?php esc_html_e('submit', 'sharai-khana'); ?>" />

                                </form> <!-- end #search-form  -->
                                
                            </div> <!-- end .search-form-404  -->


                        </div> <!--  end col-sm-12  -->

                    </div> <!-- end row  -->
                    

                    <div class="row" id="secondary">
                        
                        <div class="col-md-4 col-sm-4">
                            <?php the_widget('WP_Widget_Recent_Posts'); ?>
                        </div> <!-- end .col-sm-6  -->
                        
                        <div class="col-md-4 col-sm-4">
                            <?php if (sharai_khana_categorized_blog()) : // Only show the widget if site has multiple categories. ?>
                                <div class="widget widget_categories">
                                    <h3 class="widget-title"><?php esc_html_e('Most Used Categories', 'sharai-khana'); ?></h3>
                                    <ul>
                                        <?php
                                        wp_list_categories(array(
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'show_count' => 1,
                                            'title_li' => '',
                                            'number' => 10,
                                        ));
                                        ?>
                                    </ul>
                                </div><!-- .widget -->
                            <?php endif; ?>
                        </div> <!-- end .col-sm-6  -->


                        <div class="col-md-4 col-sm-4">
                            <?php the_widget('WP_Widget_Tag_Cloud'); ?>
                        </div> <!-- end .col-sm-12  -->

                    </div> <!-- end .row  -->

                </div><!-- .page-content -->
            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

</div> <!-- .row -->

<?php get_footer(); ?>