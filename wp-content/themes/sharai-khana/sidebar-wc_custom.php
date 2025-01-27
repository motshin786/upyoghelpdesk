<?php
/**
 * The sidebar containing the woocommerce widget area.
 *
 * @package restore
 */
if (!is_active_sidebar('sidebar-wc_custom')) {
?>

</div> <!-- .row -->
    
<?php
   return;
}
?>

<div id="secondary" class="widget-area col-md-4 col-lg-4" role="complementary">
   
        <?php dynamic_sidebar('sidebar-wc_custom'); ?>
	
</div><!-- #secondary -->

</div> <!-- .row -->