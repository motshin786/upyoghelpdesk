<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if( !function_exists('sharai_khana_admin_custom_css') ) {

    function sharai_khana_admin_custom_css() {
        echo '<style type="text/css">.redux-dev-mode-notice, .redux-notice, .rAds{ display:none !important; } .redux-main .color-transparency-check{margin: 12px 0 12px !important;} .redux-main input.color-transparency{margin-left: 0;}</style>';
    }

}

add_action('admin_head', 'sharai_khana_admin_custom_css');