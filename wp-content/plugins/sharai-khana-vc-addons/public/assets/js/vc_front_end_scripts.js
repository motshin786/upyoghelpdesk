;
(function ($) {

    "use strict";

    // MutationSelectorObserver represents a selector and it's associated initialization callback.
    var MutationSelectorObserver = function (selector, callback) {
        this.selector = selector;
        this.callback = callback;
    };

    // List of MutationSelectorObservers.
    var msobservers = [];
    msobservers.initialize = function (selector, callback) {

        // Wrap the callback so that we can ensure that it is only
        // called once per element.
        var seen = [];
        var callbackOnce = function () {
            if (seen.indexOf(this) == -1) {
                seen.push(this);
                $(this).each(callback);
            }
        };

        // See if the selector matches any elements already on the page.
        $(selector).each(callbackOnce);

        // Then, add it to the list of selector observers.
        this.push(new MutationSelectorObserver(selector, callbackOnce));
    };

    // The MutationObserver watches for when new elements are added to the DOM.
    var observer = new MutationObserver(function (mutations) {

        // For each MutationSelectorObserver currently registered.
        for (var j = 0; j < msobservers.length; j++) {
            $(msobservers[j].selector).each(msobservers[j].callback);
        }
    });

    // Observe the entire document.
    observer.observe(document.documentElement, {
        childList: true,
        subtree: true,
        attributes: true
    });

    // Deprecated API (does not work with jQuery >= 3.1.1):
    $.fn.initialize = function (callback) {
        msobservers.initialize(this.selector, callback);
    };
    $.initialize = function (selector, callback) {
        msobservers.initialize(selector, callback);
    };
})(jQuery);

jQuery(document).ready(function ($) {

    /*--  Generate Custom CSS In Front End --*/

    $(".sharai_khana_custom").initialize(function () {

        var sharai_khana_css_string = "";

        $(".sharai_khana_custom").each(function () {

            if ($(this).data('custom_style') != "") {

                sharai_khana_css_string += $(this).data('custom_style');

            }

        });

        if ($('#sharai_khana-custom-css').length) {
            $('#sharai_khana-custom-css').remove();
        }

        $("<style data-type='sharai_khana-custom-css' id='sharai_khana-custom-css'>" + sharai_khana_css_string + "</style>").appendTo('head');
    });

});