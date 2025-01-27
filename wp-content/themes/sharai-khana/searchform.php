<?php
/**
 * Search Form Template
 *
 */
?>

<form action="<?php echo esc_url(home_url('/')); ?>" id="search-form" class="search-form" role="form" method="get">

    <div class="input-group">
        <input type="text" class="form-control search-query" name="s" placeholder="<?php esc_html_e('Search', 'sharai-khana'); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
        <span class="input-group-addon"><i class="fa fa-search"></i></span>
    </div>

    <input type="hidden" value="<?php esc_html_e('submit', 'sharai-khana'); ?>" />

</form> <!-- end #search-form  -->