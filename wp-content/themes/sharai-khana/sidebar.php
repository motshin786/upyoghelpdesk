<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package sharai-khana
 */
if (!is_active_sidebar('sidebar-1')) {
    ?>
    </div> <!-- .row -->
    <?php
    return;
}
?>

<div id="secondary" class="widget-area col-md-4 col-sm-12 kb-sidebar" role="complementary">
     
    <?php dynamic_sidebar('sidebar-1'); ?>
  
</div><!-- #secondary -->

</div> <!-- .row -->