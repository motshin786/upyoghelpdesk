<?php

$attributes = array(
    'type' => 'dropdown',
    'heading' => "Add Container Wrapper",
    'param_name' => 'acw',
    'value' => array("Enable" => "1", "Disable" => "0"),
    'description' => __("Disable it if you want to get full width row.", "sharai_khana_vc")
);

vc_add_param('vc_row', $attributes); // Note: 'vc_row' was used as a base for "ROW" element

// Custom Classes.

$sharai_khana_common_class = 'section-content-block';

$sharai_khana_custom_class = array(
                                    __("Select", 'sharai_khana_vc') => "",
                                    __("Section Layout Class", 'sharai_khana_vc') => 'section-content-block',
                                    __("No Padding Layout Class", 'sharai_khana_vc') => "no-padding",
                                    __("No Bottom Padding Layout Class", 'sharai_khana_vc') => "no-bottom-padding"
                                );

$custom_attributes = array(
    'type' => 'dropdown',
    'heading' => "Select Custom Class",
    'param_name' => 'sharai_khana_custom_class',
    'value' => $sharai_khana_custom_class,
    'description' => __("Select Custom Class For Row", "sharai_khana_vc")
);

vc_add_param('vc_row', $custom_attributes); // Note: 'vc_row' was used as a base for "ROW" element