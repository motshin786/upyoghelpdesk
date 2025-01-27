(function($) {
    $(document).ready(function() {
        // Attach a click event handler to the logout link
        $('a[href*="wp-login.php?action=logout"]').on('click', function(event) {
            // Show confirmation dialog
            var confirmation = confirm("Are you sure you want to log out?");
            
            // If the user clicks "Cancel", prevent the default action
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });
})(jQuery);
