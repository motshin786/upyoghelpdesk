<?php

add_shortcode('sharai_khana_vc_video', 'sharai_khana_vc_video');

function sharai_khana_vc_video($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'id' => '',
            'custom_class_id' => wp_rand(),
            'video_link' => '#',
            'video_bg' => '',
            'icon' => 'fa fa-play',
            'icon_tag' => 'span',
            'layout' => 'layout_1',
            'content_alignment' => 'center',
            'icon_type' => 'vbox_icon_rounded',
            'icon_alignment' => 'vbox_center_center',
            'cont_ext_class' => '',
            'theme' => '',
            'theme_color' => SHARAI_KHANA_PRIMARY_COLOR,
            'animation' => ''
        ),
        $atts
    );

    extract($atts);

    // For Custom Theme.

    $custom_class = "";
    $custom_class_data = "";

    $custom_class .= " sharai_khana_custom kc_" . $custom_class_id;

    if (isset($theme) && !empty($theme) && $theme == "custom") {
        $custom_class_data .= ".kc_" . $custom_class_id . " .video-box-layout-1 .video-icon-container{border-color: " . $theme_color . " !important;}";
    }

    // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }

    // Animation Class

    $get_link_class = "venobox";
    $sharai_khana_video_animation = "";

    if (isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button(array('base' => 'sharai_khana_vc_video'));
        $sharai_khana_video_animation = " " . $animate_class->getCSSAnimation($animation);
    }

    $get_link_class = $get_link_class . ' ' . $sharai_khana_video_animation;

    $get_video_link = vc_build_link($video_link);

    $content_alignment_class = sharai_khana_alignment_class($content_alignment) . ' ' . $icon_alignment . ' ' . $icon_type . ' ' . $cont_ext_class;

    if (isset($get_video_link['url']) && $get_video_link['url'] != "") {

        $video_link_url = $get_video_link['url'];
    } else {

        $video_link_url = "#";
    }

    $video_bg_html = "";

    if ($layout == 'layout_2') {

        $video_bg_html .= "";
        $video_box_container_class = "video-box-container only-video-icon";
    } else {

        $video_bg_url = wp_get_attachment_url($video_bg);

        if ($video_bg_url != "") {
            $video_bg_html .=  '<img src="' . $video_bg_url . '" alt="img">';
        }

        $video_box_container_class = "video-box-container";
    }

    $video_bg_html .= '<span class="video-icon-container ' . $sharai_khana_video_animation . '"><i class="' . $icon . '"></i></span>';

    $output = '<div class="' . $content_alignment_class . $custom_class . '" ' . $custom_class_data . '>
                                 <div class="' . $video_box_container_class . '">
                                    <a class="video-box-layout-1 video-box" data-vbtype="youtube" href="' . $video_link_url . '">
                                     ' . $video_bg_html . '
                                    </a>
                                 </div> <!-- end .video-box-container  -->
                         </div>';

    return do_shortcode(sharai_khana_cleanup_shortcode($output));
}