<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package sharai-khana
 */
if (!is_active_sidebar('sidebar-left')) {
    ?>
    </div> <!-- .row -->
    <?php
    return;
}
?>

<div id="secondary" class="widget-area col-md-4 col-lg-4 col-md-pull-8" role="complementary">
 
        <?php dynamic_sidebar('sidebar-left'); ?>
 
</div><!-- #secondary -->

</div> <!-- .row -->
