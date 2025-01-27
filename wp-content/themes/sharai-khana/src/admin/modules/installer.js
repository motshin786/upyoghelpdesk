;(function ($) {
  function sharaiKhanaInstallationCounter() {
    return $.ajax({
      type: "POST",
      url: ajaxurl,
      data: {
        action: "sharai_khana_installation_counter", // this is the name of our WP AJAX function that we'll set up next
        product_id: SharaiKhanaAdminData.product_id, // change the localization variable.
      },
      dataType: "JSON",
    })
  }

  if (typeof SharaiKhanaAdminData.installation != "undefined" && SharaiKhanaAdminData.installation != 1) {
    $.when(sharaiKhanaInstallationCounter()).done(function (response_data) {
      // console.log(response_data)
    })
  }
})(jQuery)
