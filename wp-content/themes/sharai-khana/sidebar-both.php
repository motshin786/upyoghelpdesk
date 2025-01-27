<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package sharai-khana
 */
if ((!is_active_sidebar('sidebar-1')) || (!is_active_sidebar('sidebar-left'))) {
    ?>
    </div> <!-- .row -->
    <?php
    return;
}
?>

<div id="secondary" class="widget-area col-md-3 col-lg-3 col-md-pull-6" role="complementary">

        <?php dynamic_sidebar('sidebar-left'); ?>

</div><!-- #secondary -->

<div id="secondary_2" class="widget-area col-md-3 col-lg-3" role="complementary">
 
        <?php dynamic_sidebar('sidebar-1'); ?>
 
</div><!-- #secondary -->

</div> <!-- .row -->