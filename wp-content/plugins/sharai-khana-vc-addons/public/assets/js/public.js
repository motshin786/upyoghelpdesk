/*-------------------------------------------------------------------*/
/* Project: Sharai Khana - Computer Service Center WordPress Theme */
/* Author: xenioushk*/
/*-------------------------------------------------------------------*/

/*========================================================================*/
/*   TABLE OF CONTENT
/*========================================================================*/
/*
/*  00. RTL STATUS CHECK.
/*  01. HELPER FUNCTIONS.
/*  02. SLIDER FUNCTIONS.
/*  02.1. STATIC BANNER.
/*  03. IMAGE GALLERY & GALLERY CAROUSEL.
/*  04. HIGHLIGHT
/*  05. EVENTS
/*  06. PROCESS BLOCK
/*  07. SERVICE BLOCK
/*  08. COUNTER BLOCK
/*  09. TEAMS BLOCK
/*  10. LOGOS BLOCK
/*  11. TESTIMONIAL BLOCK
/*  12. CTA BLOCK
/*  13. BACK TO TOP BUTTON.
/*  14. PRELOADER
/*
/*========================================================================*/

;(function ($) {
  "use strict"

  $(function () {
    // 00. RTL STATUS CHECK.
    var rtl_status = false
    if ($("html").is("[dir]")) {
      rtl_status = true
    }

    // 01. HELPER FUNCTIONS.

    // Adjust slider content according to screen size.
    function slider_resize() {
      if ($(window).width() > 991 && $(".header-style1").length > 0) {
        setTimeout(function () {
          var header_style_outer_height = $(".header-style1").outerHeight()
          $(".slider-content").attr("style", "margin-top: " + parseInt((header_style_outer_height - 24) / 2, 10) + "px;")
          $(".owl-nav div").attr("style", "margin-top: " + parseInt((header_style_outer_height - 24) / 2, 10) + "px;")
        }, 500)
      } else {
        $(".slider-content").first().attr("style", "margin-top: 0px;")
      }
    }

    // Convert hex value to RGBA.
    function hexToRgbA(hex, opacity) {
      var c
      if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
        c = hex.substring(1).split("")
        if (c.length == 3) {
          c = [c[0], c[0], c[1], c[1], c[2], c[2]]
        }
        c = "0x" + c.join("")
        return "rgba(" + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(",") + "," + opacity + ")"
      } else {
        return 'rgba("0,0,0,' + opacity + '")'
      }
    }

    // Custom scripts to generate dynamic css.
    function sharai_khana_custom_style() {
      if ($(".sharai_khana_custom").length > 0) {
        var sharai_khana_css_string = ""

        $(".sharai_khana_custom").each(function () {
          if ($(this).data("custom_style") != "") {
            sharai_khana_css_string += $(this).data("custom_style")
          }
        })

        $("<style data-type='sharai_khana-custom-css' id='sharai_khana-custom-css'>" + sharai_khana_css_string + "</style>").appendTo("head")
      }
    }

    // add animate.css class(es) to the elements to be animated
    function setAnimation(_elem, _InOut) {
      // Store all animationend event name in a string.
      // cf animate.css documentation
      var animationEndEvent = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend"

      _elem.each(function () {
        var $elem = $(this)
        var $animationType = "animated " + $elem.data("animation-" + _InOut)

        $elem.addClass($animationType).one(animationEndEvent, function () {
          $elem.removeClass($animationType) // remove animate.css Class at the end of the animations
        })
      })
    }

    var current_screen_size
    current_screen_size = $(window).width()

    $(window).resize(function () {
      current_screen_size = $(window).width()
    })

    // nav menu smooth scroll
    function smooth_scrolling() {
      $(".nav_menu").on("click", function () {
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
          var target = $(this.hash)
          target = target.length ? target : $("[name=" + this.hash.slice(1) + "]")
          var offset = $(".header-style1").outerHeight()

          if ($(".header-style1").length === 1) {
            offset = $(".header-style1").outerHeight()
          } else {
            offset = parseInt(offset, 0)
          }

          if (target.length) {
            var scrollTopValue

            scrollTopValue = target.offset().top

            $("html,body").animate(
              {
                scrollTop: scrollTopValue - parseInt(100),
              },
              1300
            )

            return false
          }
        }
      })
    }

    /*----- One Page Menu ----*/

    $(".one_page_menu")
      .find("a")
      .on("click", function () {
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
          var target = $(this.hash)
          target = target.length ? target : $("[name=" + this.hash.slice(1) + "]")
          var offset = $(".header-sticky").outerHeight()

          var $wpadminbar_height = 0

          if ($("#wpadminbar").length > 0) {
            $wpadminbar_height = $("#wpadminbar").outerHeight() - 5
          }

          if ($(".header-static").length === 1) {
            offset = $(".header-static").outerHeight()
          } else if ($(".sticky-header").length === 1) {
            offset = $(".sticky-header").outerHeight()
          } else {
            offset = parseInt(offset, 0) * 2
          }

          if (target.length) {
            var scrollTopValue

            if (current_screen_size < 752) {
              scrollTopValue = target.offset().top
            } else {
              scrollTopValue = target.offset().top - parseInt(offset, 0) - parseInt($wpadminbar_height, 0)
            }

            $("html,body").animate(
              {
                scrollTop: scrollTopValue,
              },
              1300
            )

            return false
          }
        }
      })

    // 02. SLIDER FUNCTIONS.

    // SLIDER 1

    function slider_resize() {
      if ($(window).width() > 991) {
        $(".slider-content").first().attr("style", "margin-top: 0px;")
      } else {
        $(".slider-content").first().attr("style", "margin-top: 0px;")
      }
    }

    // SLIDER 1

    if ($(".slider-wrap")) {
      var $this = $(".slider-wrap")

      if ($this.is("[data-bg_img]")) {
        var bg_img = 'url("' + $this.data("bg_img") + '")'
        $this.css({
          "background-image": bg_img,
          "background-repeat": "repeat",
          "background-position": "center center",
          "background-size": "cover",
        })
      }
    }

    function sharai_khana_slider() {
      if ($(".sharai_khana_slider").length) {
        // BG & Color Settings.
        $(".sharai_khana_slider")
          .find(".slider_item_container")
          .each(function () {
            var $this = $(this)
            var bg_img = "",
              bg_color = "#000000",
              bg_opacity = "0.1"
            if ($this.is("[data-bg_img]")) {
              bg_img = ', url("' + $this.data("bg_img") + '")'
            }
            if ($this.is("[data-bg_color]")) {
              bg_color = $this.data("bg_color")
            }
            if ($this.is("[data-bg_opacity]")) {
              bg_opacity = $this.data("bg_opacity")
            }
            var $color_overlay = hexToRgbA(bg_color, bg_opacity)

            $this.find(".item").before('<div class="slide-bg"></div>')

            $this.find(".slide-bg").attr("style", "background:linear-gradient( " + $color_overlay + ",  " + $color_overlay + " )" + bg_img + "; background-position: center center; background-repeat: no-repeat; background-attachment: inherit; background-size: cover; overflow:hidden;")
          })

        slider_resize()

        $(window).on("resize", function () {
          if ($(window).width() > 767) {
            slider_resize()
          } else {
            $(".slider-content").removeAttr("style")
          }
        })

        // Carousel.

        var $slider_1 = $("#slider_1")

        var $this = $slider_1

        var items_val = 1,
          bg_effect_val = true,
          nav_val = false,
          dots_val = true,
          autoplay_val = true,
          autoplaytimeout_val = 10000
        // Status.
        if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
          $this.removeClass("owl-carousel")
          return ""
        }

        // Status.
        if ($this.attr("data-bg_effect") && !isNaN($this.data("bg_effect"))) {
          bg_effect_val = $this.data("bg_effect")
        }

        // navigation status.
        if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
          nav_val = $this.data("nav")
        }

        // navigation status.
        if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
          dots_val = $this.data("dots")
        }
        // Autoplay status.
        if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
          autoplay_val = $this.data("autoplay")
        }
        // Autoplay status.
        if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
          autoplaytimeout_val = $this.data("autoplaytimeout")
        }

        $slider_1.owlCarousel({
          rtl: rtl_status,
          callbacks: true,
          margin: 0,
          items: items_val,
          loop: true,
          autoplay: autoplay_val,
          autoplayTimeout: autoplaytimeout_val,
          autoplayHoverPause: false,
          dots: dots_val,
          nav: nav_val,
          responsive: {
            0: {
              items: items_val,
              nav: false,
              loop: true,
              dots: false,
            },
            600: {
              items: items_val,
              nav: false,
              loop: true,
              dots: false,
            },
            1000: {
              items: items_val,
            },
          },
          navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        })

        var $slider_animation = $slider_1

        // Fired before current slide change
        $slider_animation.on("change.owl.carousel", function (event) {
          var $currentItem = $(".owl-item", $slider_animation).eq(event.item.index)
          var $elemsToanim = $currentItem.find("[data-animation-out]")
          setAnimation($elemsToanim, "out")
        })

        // Fired after current slide has been changed

        $slider_animation.on("changed.owl.carousel", function (event) {
          var $currentItem = $(".owl-item", $slider_animation).eq(event.item.index)
          var $elemsToanim = $currentItem.find("[data-animation-in]")
          setAnimation($elemsToanim, "in")
        })

        if (bg_effect_val === true) {
          $slider_animation.on("translated.owl.carousel", function (e) {
            $(".active .slide-bg").addClass("slidezoom")
          })

          $slider_animation.on("translate.owl.carousel", function (e) {
            $(".active .slide-bg").removeClass("slidezoom")
          })
        }
      }
    }

    // 02.1. STATIC BANNER.

    function sharai_khana_banner() {
      if ($(".static-banner").length) {
        $(".static-banner").each(function () {
          var $this = $(this)

          var bg_img = "images/home_1_slider_1.jpg",
            bg_color = "#555555",
            bg_opacity = "0.3",
            bg_color_2 = "#111111",
            bg_opacity_2 = "0.9"

          if ($this.is("[data-bg_img]")) {
            bg_img = ', url("' + $this.data("bg_img") + '")'
          } else {
            bg_img = ', url("' + bg_img + '")'
          }

          if ($this.is("[data-bg_color]")) {
            bg_color = $this.data("bg_color")
          }

          if ($this.is("[data-bg_opacity]")) {
            bg_opacity = $this.data("bg_opacity")
          }

          var $color_overlay = hexToRgbA(bg_color, bg_opacity)

          $color_overlay_2 = $color_overlay

          if ($this.is("[data-gradient]") && $this.data("gradient") == 1) {
            if ($this.is("[data-bg_color_2]")) {
              bg_color_2 = $this.data("bg_color_2")
            }

            if ($this.is("[data-bg_opacity_2]")) {
              bg_opacity_2 = $this.data("bg_opacity_2")
            }

            var $color_overlay_2 = hexToRgbA(bg_color_2, bg_opacity_2)
          }

          $this
            .closest(".vc_row-fluid")
            .addClass("section-banner")
            .attr("style", "background:linear-gradient( " + $color_overlay + ",  " + $color_overlay_2 + " )" + bg_img + "; background-position: center center; background-repeat: repeat; background-attachment: inherit; background-size: cover; overflow:hidden;")
        })
      }
    }

    // 03. IMAGE GALLERY & GALLERY CAROUSEL.

    if ($(".gallery-light-box").length) {
      $(document).ready(function () {
        $(".gallery-light-box").venobox()
      })
    }

    // Gallery Carousel.

    function sharai_khana_gallery() {
      if ($(".gallery-carousel").length > 0) {
        var $parent_gallery_container = $(".gallery-carousel")

        $parent_gallery_container.each(function () {
          var $this = $(this) // Each Carousel.

          var items_val = 1,
            nav_val = true,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000

          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            return ""
          }

          // no of items

          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }

          // navigation status.

          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // navigation status.

          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots")
          }

          // Autoplay status.

          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }

          // Autoplay status.

          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            dots: dots_val,
            nav: nav_val,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
              0: {
                items: 1,
                dots: false,
              },
              600: {
                items: 1,
                dots: false,
              },
              1000: {
                items: items_val,
                dots: nav_val,
                nav: false,
              },
            },
          })
        })
      }
    }

    // 04. BREADCRUMB

    if ($(".sharai_khana-breadcrumb-container").length > 0 && $(".woocommerce-breadcrumb").length > 0) {
      var $woocommerce_breadcrumb = $(".woocommerce-breadcrumb"),
        $woocommerce_breadcrumb_text = $woocommerce_breadcrumb.html()

      $woocommerce_breadcrumb.remove()
      $(".page-breadcrumb").html("").html($woocommerce_breadcrumb_text)
    }

    // 04. HIGHLIGHT

    function sharai_khana_highlight() {
      if ($(".highlight-carousel").length) {
        var $highlight_carousel = $(".highlight-carousel")
        $highlight_carousel.each(function () {
          var $this = $(this)

          var items_val = 3,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000
          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel")
            return ""
          }
          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }
          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots")
          }
          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }
          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            dots: dots_val,
            nav: nav_val,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
              0: {
                items: 1,
                nav: false,
                dots: false,
              },
              600: {
                items: 1,
                nav: false,
              },
              1000: {
                items: items_val,
              },
            },
          })
        })
      }
    }

    // 06. PROCESS BLOCK

    if ($(".process-block").length > 0) {
      var count = 1

      $(".process-block").each(function () {
        $(this)
          .find(".step")
          .each(function () {
            $(this)
              .html("")
              .html("<h3>" + count + "</h3>")
            count++
          })

        // Reset Counter
        count = 1
      })
    }

    function sharai_khana_process() {
      if ($(".process-carousel").length > 0) {
        var $parent_process_block_carousel = $(".process-carousel")

        $parent_process_block_carousel.each(function () {
          var $this = $(this) // Each Carousel.

          var items_val = 1,
            nav_val = false,
            autoplay_val = true,
            autoplaytimeout_val = 5000

          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            return ""
          }

          // no of items

          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }

          // navigation status.

          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // Autoplay status.

          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }

          // Autoplay status.

          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            responsive: {
              0: {
                items: 1,
                nav: false,
              },
              600: {
                items: 1,
                nav: false,
              },
              1000: {
                items: items_val,
                nav: nav_val,
                navText: ["<i class='nav-icon'></i>", "<i class='nav-icon'></i>"],
                loop: true,
              },
            },
          })
        })
      }
    }

    // 07. SERVICE BLOCK

    function sharai_khana_service() {
      if ($(".service-carousel").length) {
        var $service_carousel = $(".service-carousel")
        $service_carousel.each(function () {
          var $this = $(this)

          var items_val = 3,
            nav_val = true,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000
          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel")
            return ""
          }
          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }
          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots")
          }
          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }
          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            dots: dots_val,
            nav: nav_val,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
              0: {
                items: 1,
                nav: false,
              },
              600: {
                items: 1,
                nav: false,
              },
              1000: {
                items: items_val,
              },
            },
          })
        })
      }
    }

    // 08. COUNTER BLOCK

    function sharai_khana_counter() {
      if ($(".sharai_khana_counter_num").length > 0) {
        $(".sharai_khana_counter_num").each(function () {
          var $this = $(this),
            $disable_countup = $this.data("disable_countup"),
            $time = $this.data("time"),
            $delay = $this.data("delay")

          if (typeof $disable_countup !== "undefined" && $disable_countup == 1) {
            return ""
          } else {
            $this.counterUp({
              time: $time,
              delay: $delay,
            })
          }
        })
      }
    }

    // 09. TEAMS BLOCK

    function sharai_khana_team() {
      if ($(".team-carousel").length) {
        var $team_carousel = $(".team-carousel")

        $team_carousel.each(function () {
          var $this = $(this)

          var items_val = 3,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000

          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel")
            return ""
          }

          // No of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }

          // Navigation Arrow status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // Navigation Dots status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots")
          }

          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }

          // Autoplay Timeout status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            dots: dots_val,
            nav: nav_val,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
              0: {
                items: 1,
                nav: false,
              },
              600: {
                items: 1,
                nav: false,
              },
              1000: {
                items: items_val,
              },
            },
          })
        })
      }
    }

    // 10. LOGOS BLOCK

    function sharai_khana_logo() {
      if ($(".logo-items").length) {
        var $logo_items = $(".logo-items")

        $logo_items.each(function () {
          var $this = $(this)

          var items_val = 6,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000

          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel")
            return ""
          }

          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }

          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots")
          }

          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }

          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            dots: dots_val,
            nav: nav_val,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
              0: {
                items: 2,
                nav: false,
              },
              600: {
                items: 3,
                nav: false,
              },
              1000: {
                items: items_val,
              },
            },
          })
        })
      }
    }

    // 11. TESTIMONIAL BLOCK

    function sharai_khana_testimonial() {
      if ($(".testimonial-container").length > 0) {
        var $parent_testimonial_container = $(".testimonial-container")

        $parent_testimonial_container.each(function () {
          var $this = $(this) // Each Carousel.

          var items_val = 1,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 7000

          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            return ""
          }

          // No of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }

          // Navigation Arrow status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // Navigation Dots status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots")
          }

          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }

          // Autoplay Timeout status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            dots: dots_val,
            nav: nav_val,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
              0: {
                items: 1,
                nav: false,
              },
              600: {
                items: 1,
                nav: false,
              },
              1000: {
                items: items_val,
              },
            },
          })
        })
      }
    }

    // 12. CTA BLOCK

    if ($(".venobox").length) {
      $(".venobox").venobox()
    }

    // 12.1. VIDEO BOX

    if ($(".video-box").length) {
      $(document).ready(function () {
        $(".video-box").venobox()
      })
    }

    // 13. Latest News Block

    function sharai_khana_news() {
      if ($(".latest-news-carousel").length) {
        var $latest_news_carousel = $(".latest-news-carousel")
        $latest_news_carousel.each(function () {
          var $this = $(this)

          var items_val = 3,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000
          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel")
            return ""
          }
          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items")
          }
          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav")
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots")
          }
          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay")
          }
          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout")
          }

          $this.owlCarousel({
            rtl: rtl_status,
            items: items_val,
            loop: true,
            autoplay: autoplay_val,
            autoplayTimeout: autoplaytimeout_val,
            autoplayHoverPause: true,
            dots: dots_val,
            nav: nav_val,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
              0: {
                items: 1,
                nav: false,
                dots: false,
              },
              600: {
                items: 1,
                nav: false,
              },
              1000: {
                items: items_val,
              },
            },
          })
        })
      }
    }

    //Calling Smooth Scroll Function.

    smooth_scrolling()

    // 13. BACK TO TOP BUTTON.

    if ($("#backTop").length === 1) {
      $("#backTop").backTop({
        rtl: rtl_status,
        theme: "custom",
      })
    }

    // Check If VC in front end mode.

    function sharai_khana_getUrlParam(name) {
      var results = new RegExp("[\\?&]" + name + "=([^&#]*)").exec(window.location.href)
      return (results && results[1]) || undefined
    }

    var sharai_khana_vc_editable_status = sharai_khana_getUrlParam("vc_editable")

    if (sharai_khana_vc_editable_status === "true") {
      setTimeout(function () {
        sharai_khana_slider()
        sharai_khana_banner()
        sharai_khana_gallery()
        sharai_khana_highlight()
        sharai_khana_process()
        sharai_khana_service()
        sharai_khana_counter()
        sharai_khana_team()
        sharai_khana_logo()
        sharai_khana_testimonial()
        sharai_khana_news()
        sharai_khana_custom_style()
      }, 1000)
    } else {
      sharai_khana_slider()
      sharai_khana_banner()
      sharai_khana_gallery()
      sharai_khana_highlight()
      sharai_khana_process()
      sharai_khana_service()
      sharai_khana_counter()
      sharai_khana_team()
      sharai_khana_logo()
      sharai_khana_testimonial()
      sharai_khana_news()
      sharai_khana_custom_style()
    }
  })

  // 14. PRELOADER

  $(window).on("load", function () {
    if ($("#preloader").length) {
      $("#preloader").fadeOut(500)
    }
  })
})(jQuery)
