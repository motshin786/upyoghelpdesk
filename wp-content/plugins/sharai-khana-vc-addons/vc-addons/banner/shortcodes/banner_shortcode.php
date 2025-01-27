<?php

add_shortcode('sharai_khana_vc_banner', 'sharai_khana_vc_banner');


function sharai_khana_vc_banner($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'id' => '',
            'sub_intro' => '',
            'sub_intro_tag' => 'h5',
            'main_intro' => '',
            'main_intro_tag' => 'h2',
            'main_intro_color' => '#FFFFFF',
            'banner_link' => '#',
            'banner_image' => '#',
            'icon' => 'fa-play',
            'icon_tag' => 'span',
            'button_text' => __('JOIN WITH US', 'sharai_khana_vc'),
            'layout' => 'layout_1',
            'content_alignment' => 'center',
            'theme' => '',

            'bg_type' => 'image',  // image/solid/gradient
            'banner_bg' => '',
            'bg_color' => '#555555',
            'bg_opacity' => '0.3',
            'bg_color_2' => '#111111',
            'bg_opacity_2' => '0.9',
            'gradient' => '0',
            'solid_bg' => '#555555',

            'ctrl_btn_1' => 0,
            'btn_1_cont_ext_class' => '',
            'btn_1_text' =>  __('BOOK APPOINTMENT', 'sharai_khana_vc'),
            'btn_1_url' => '#',
            'btn_1_theme' => '', //default, custom.
            'btn_1_border' => '0',
            'btn_1_border_radius' => '32',
            'btn_1_bg' => '#FFFFFF',
            'btn_1_color' => SHARAI_KHANA_PRIMARY_COLOR,
            'btn_1_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
            'btn_1_hover_bg' => SHARAI_KHANA_PRIMARY_COLOR,
            'btn_1_hover_color' => '#FFFFFF',
            'btn_1_hover_border_color' => SHARAI_KHANA_PRIMARY_COLOR,


            'ctrl_btn_2' => 0,
            'btn_2_cont_ext_class' => 'btn-theme margin-top-24',
            'btn_2_text' =>  __('JOIN WITH US', 'sharai_khana_vc'),
            'btn_2_url' => '#',
            'btn_2_theme' => '', //default, custom.
            'btn_2_border' => '0',
            'btn_2_border_radius' => '32',
            'btn_2_bg' => '#FFFFFF',
            'btn_2_color' => SHARAI_KHANA_PRIMARY_COLOR,
            'btn_2_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
            'btn_2_hover_bg' => SHARAI_KHANA_PRIMARY_COLOR,
            'btn_2_hover_color' => '#FFFFFF',
            'btn_2_hover_border_color' => SHARAI_KHANA_PRIMARY_COLOR,

            'animation' => '',
            'cont_ext_class' => ''

        ),
        $atts
    );

    extract($atts);

    // Animation Class

    $sharai_khana_banner_animation = "";

    if (isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button(array('base' => 'sharai_khana_vc_banner'));
        $sharai_khana_banner_animation = " " . $animate_class->getCSSAnimation($animation);
    }

    // Parse Button Links.

    /* ------------------------------  Generate Button#1 --------------------------------- */

    $btn_1_html = '';

    if ($ctrl_btn_1 == 1) {

        $btn_1_cont_ext_class = "btn btn-theme margin-top-24 " . $btn_1_cont_ext_class;

        if (isset($btn_1_theme) && $btn_1_theme == "custom") {

            $btn_1_html .= do_shortcode('[sharai_khana_vc_button title="' . $btn_1_text . '" '
                . 'theme="custom" '
                . 'cont_ext_class="' . $btn_1_cont_ext_class . '" '
                . 'btn_info="' . $btn_1_url . '" '
                . 'btn_border="' . $btn_1_border . '" '
                . 'btn_border_width="0" '
                . 'btn_border_radius="' . $btn_1_border_radius . '" '
                . 'btn_bg="' . $btn_1_bg . '" '
                . 'btn_color="' . $btn_1_color . '" '
                . 'btn_border_color="' . $btn_1_border_color . '" '
                . 'btn_hover_bg="' . $btn_1_hover_bg . '" '
                . 'btn_hover_color="' . $btn_1_hover_color . '" '
                . 'btn_hover_border_color="' . $btn_1_hover_border_color . '" '
                . '/]');
        } else {

            $btn_1_url_string = vc_build_link($btn_1_url);
            $btn_1_html .= '<a href="' . $btn_1_url_string['url'] . '" class="' . $btn_1_cont_ext_class . '">' . $btn_1_text . '</a>';
        }
    }

    /* ------------------------------  Generate Button#2 --------------------------------- */

    $btn_2_html = '';

    if ($ctrl_btn_2 == 1) {

        $btn_2_cont_ext_class = "btn btn-theme btn-theme-invert margin-top-24 " . $btn_2_cont_ext_class;

        if (isset($btn_2_theme) && $btn_2_theme == "custom") {

            $btn_2_html .= do_shortcode('[sharai_khana_vc_button title="' . $btn_2_text . '" '
                . 'theme="custom" '
                . 'cont_ext_class="' . $btn_2_cont_ext_class . '" '
                . 'btn_info="' . $btn_2_url . '" '
                . 'btn_border="' . $btn_2_border . '" '
                . 'btn_border_width="2" '
                . 'btn_border_radius="' . $btn_2_border_radius . '" '
                . 'btn_bg="' . $btn_2_bg . '" '
                . 'btn_color="' . $btn_2_color . '" '
                . 'btn_border_color="' . $btn_2_border_color . '" '
                . 'btn_hover_bg="' . $btn_2_hover_bg . '" '
                . 'btn_hover_color="' . $btn_2_hover_color . '" '
                . 'btn_hover_border_color="' . $btn_2_hover_border_color . '" '
                . '/]');
        } else {

            $btn_2_url_string = vc_build_link($btn_2_url);
            $btn_2_html .= '<a href="' . $btn_2_url_string['url'] . '" class="' . $btn_2_cont_ext_class . '">' . $btn_2_text . '</a>';
        }
    }

    // Button Wrapper.

    $output_btn_html = "";

    if ($btn_1_html != "" || $btn_2_html != "") {

        $output_btn_html .= '<div class="static-banner-button">';
        $output_btn_html .= $btn_1_html;
        $output_btn_html .= $btn_2_html;
        $output_btn_html .= '</div>';
    }


    // BG TYPE.

    if (isset($bg_type) && $bg_type == "solid") {
        $bg_color = $solid_bg;
        $bg_opacity = 1;
    }



    $alignment_class = sharai_khana_alignment_class($content_alignment);

    $banner_bg_url = wp_get_attachment_url($banner_bg);

    if ($banner_bg_url == "") {
        $banner_bg_url =  SHARAI_KHANA_VC_PLUGIN_DIR . 'public/images/banner_bg.jpg';
    }

    //

    $sharai_khana_container_class = 'static-banner banner-content ' . $cont_ext_class;

    $output = '<div class="' . $sharai_khana_container_class . $sharai_khana_banner_animation . '" data-bg_img="' . $banner_bg_url . '" data-gradient="' . $gradient . '" data-bg_color="' . $bg_color . '" data-bg_opacity="' . $bg_opacity . '" data-bg_color_2="' . $bg_color_2 . '" data-bg_opacity_2="' . $bg_opacity_2 . '" >       
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ' . $alignment_class . '">
                                    ' . $content . '
                                    ' . $output_btn_html . '

                                    </div> <!-- end .banner-content   -->
                                </div> <!-- end .col-md-12  -->
                            </div> <!-- end .container  -->
                        </div>';


    return do_shortcode(sharai_khana_cleanup_shortcode($output));
}