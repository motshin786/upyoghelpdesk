<?php
// DEFINE THEME CONSTANTS
define('SHARAI_KHANA_THEME_VER', '20230104-1.3.0');
define('SHARAI_KHANA_THEME_PRIMARY_COLOR', '#80B435');
define('SHARAI_KHANA_THEME_TEXT_COLOR', '#555555');
define('SHARAI_KHANA_THEME_LINK_HOVER_COLOR', '#80B435');

// Register all the theme options
require_once(get_template_directory() . '/inc/redux-config.php');

// Theme options functions
require_once(get_template_directory() . '/inc/theme-default-options.php');

if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

if (!function_exists('sharai_khana_add_editor_styles')) :

    function sharai_khana_add_editor_styles()
    {
        add_editor_style('custom-editor-style.css');
    }

endif;
add_action('admin_init', 'sharai_khana_add_editor_styles');

if (!function_exists('sharai_khana_setup')) :

    function sharai_khana_setup()
    {

        define('SHARAI_KHANA_CMB_PREFIX', 'sharai_khana_'); // custom meta box prefix.

        load_theme_textdomain('sharai-khana', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        //For Blog Single Post Thumb.

        add_image_size('sharai_khana-blog-single-large', 850, 430); // Soft proprtional crop to max 720px width, max 340px height

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'sharai-khana'),
        ));

        register_nav_menus(array(
            'footer-menu' => esc_html__('Footer Menu', 'sharai-khana'),
        ));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'one-page-menu' => esc_html__('One Page Menu', 'sharai-khana'),
        ));

        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ));

        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('sharai_khana_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Support For WooCommerce.

        if (class_exists('WooCommerce')) {

            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
        }
    }

endif; // sharai_khana_setup
add_action('after_setup_theme', 'sharai_khana_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sharai_khana_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'sharai-khana'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Main Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'sharai_khana_widgets_init');


/**
 * Register Google Fonts
 */
function sharai_khana_fonts_url()
{

    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'sharai-khana')) {
        $font_url = add_query_arg('family', urlencode('Fjalla+One|Lato:300,400,400i,700,700i'), "//fonts.googleapis.com/css");
    }

    return $font_url;
}

/**
 * Enqueue scripts and styles.
 */
function sharai_khana_scripts()
{

    if (!class_exists('Redux')) {

        wp_enqueue_style('sharai-khana-fonts', sharai_khana_fonts_url(), array(), '1.0.0');
    }

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');

    wp_enqueue_style('font-awesome-5', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '5.11.2', 'all');
    wp_enqueue_style('font-awesome-5-shims', get_template_directory_uri() . '/css/v4-shims.min.css', array(), '5.11.2', 'all');

    if (!class_exists('Redux')) {

        wp_enqueue_style('sharai-khana-defaults', get_template_directory_uri() . '/css/option-panel-default.css', array(), '1.0.0', 'all');
    }

    wp_enqueue_style('sharai-khana-style', get_stylesheet_uri());

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.4', TRUE);

    wp_enqueue_script('jquery-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), SHARAI_KHANA_THEME_VER, true);

    wp_enqueue_script('sharai-khana-custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array(), SHARAI_KHANA_THEME_VER, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'sharai_khana_scripts');

/**
 * WooCommerce Integration
 */
add_action('after_setup_theme', 'sharai_khana_woocommerce_support');

function sharai_khana_woocommerce_support()
{
    add_theme_support('woocommerce');
}


// Total Number of products display per page.

add_filter('loop_shop_per_page', 'sharai_khana_loop_shop_per_page', 20);

function sharai_khana_loop_shop_per_page()
{
    $cols = 6;
    return $cols;
}

// Total Number of products display per row.

add_filter('loop_shop_columns', 'sharai_khana_loop_shop_columns', 20);

function sharai_khana_loop_shop_columns()
{
    return 3;
}

/** remove redux menu under the tools * */
add_action('admin_menu', 'sharai_khana_remove_redux_menu', 12);

function sharai_khana_remove_redux_menu()
{
    remove_submenu_page('tools.php', 'redux-about');
}

/** remove VC Front End & Custom CSS Settings* */

if (defined('WPB_VC_VERSION')) {

    function sharai_khana_vcSetAsTheme()
    {
        vc_set_as_theme();
    }

    add_action('vc_before_init', 'sharai_khana_vcSetAsTheme');
}

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack.php';

/**
 * Load Bootstrap Menu.
 */
require_once get_template_directory() . '/inc/bootstrap-walker.php';

/**
 * Comments Callback.
 */
require_once get_template_directory() . '/inc/comments-callback.php';

/**
 * Search Results - Highlight.
 */
require_once get_template_directory() . '/inc/search-highlight.php';

/**
 * Template Home Page - dynamic widget.
 */
require_once get_template_directory() . '/inc/custom-widgets.php';

/**
 * Set custom metabox for sharai_khana
 */
require_once get_template_directory() . '/inc/theme-custom-meta-box.php';

//ADD CUSTOM CSS.
require_once get_template_directory() . '/inc/admin-custom-css.php';

//ADD EXTERNAL PLUGINS
require_once get_template_directory() . '/inc/required-plugin-tgm.php';

//ADD ONE CLICK DEMO IMPORTER
require_once get_template_directory() . '/inc/one-click-importer.php';



add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
  wp_safe_redirect( home_url() );
  exit;
}

function get_tickets_list_page_url() {
    if (function_exists('wpas_get_tickets_list_page_url')) {
        return wpas_get_tickets_list_page_url();
    } else {
        return '';
    }
}

function print_tickets_list_page_url() {
    $tickets_list_page_url = get_tickets_list_page_url();
    if ($tickets_list_page_url) {
        echo '<a href="' . esc_url($tickets_list_page_url) . '">View Your Tickets</a>';
    } else {
        echo 'Tickets list page URL is not available.';
    }
}

function replace_howdy_greeting($wp_admin_bar) {
    $my_account = $wp_admin_bar->get_node('my-account');
    $newtitle = str_replace('Howdy,', 'Welcome,', $my_account->title); // Change "Welcome" to any text you prefer
    $wp_admin_bar->add_node(array(
        'id' => 'my-account',
        'title' => $newtitle,
    ));
}
add_filter('admin_bar_menu', 'replace_howdy_greeting', 25);

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}


add_action('init', 'register_ticket_custom_taxonomy', 0);

function register_ticket_custom_taxonomy() {
    // Labels for the custom taxonomy
    $labels = array(
        'name'                       => _x('Project', 'taxonomy general name', 'textdomain'),
        'singular_name'              => _x('Project Category', 'taxonomy singular name', 'textdomain'),
        'search_items'               => __('Search Project Categories', 'textdomain'),
        'all_items'                  => __('All Project Categories', 'textdomain'),
        'parent_item'                => __('Parent Project Category', 'textdomain'),
        'parent_item_colon'          => __('Parent Project Category:', 'textdomain'),
        'edit_item'                  => __('Edit Project Category', 'textdomain'),
        'update_item'                => __('Update Project Category', 'textdomain'),
        'add_new_item'               => __('Add New Project Category', 'textdomain'),
        'new_item_name'              => __('New Project Category Name', 'textdomain'),
        'menu_name'                  => __('Project Categories', 'textdomain'),
    );

    // Arguments for the custom taxonomy
    $args = array(
        'hierarchical'               => true,
        'labels'                     => $labels,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );

    // Register the taxonomy for the 'ticket' post type
    register_taxonomy('projects', array('ticket'), $args);
}


add_action('awesome_support_ticket_created', 'save_custom_field_value', 10, 2);

function save_custom_field_value($ticket_id, $ticket_data) {
    if (isset($_POST['projects'])) {
        $custom_field_value = sanitize_text_field($_POST['projects']);
        update_post_meta($ticket_id, 'projects', $custom_field_value);
    }
}

wpas_add_custom_taxonomy('projects', array(
    'label' => __('Projects', 'Projects'),
    'hierarchical' => true,
    'required' => true,
    'order' => 1,
    'show_ui' => true, // Make sure this is set to true
));


function register_custom_ticket_fields() {
    $custom_field = new WPAS_Custom_Field();
    $custom_field->set('name', 'custom_field')
                 ->set('label', __('Custom Field', 'text-domain'))
                 ->set('type', 'text')
                 ->set('required', false)
                 ->set('default', '')
                 ->set('sanitize', 'sanitize_text_field');
    
    WPAS()->fields->register_field($custom_field);
}
add_action('wpas_register_custom_fields', 'register_custom_ticket_fields');


/*/
add_action('plugins_loaded', 'wpas_user_custom_fields');
if ( function_exists( 'wpas_add_custom_field' ) ) {
    wpas_add_custom_field( 'my_custom_field',  
    array('title' => __( 'Assignee New', 'awesome-support', ) ,'order' => 2, 'attribute' => 'value','another-attribute' => 'another-value'));
}*/

add_action('wp_head', 'hide_priority_field_with_css');
function hide_priority_field_with_css() {
    echo '<style>#wpas_ticket_priority_wrapper { display: none !important; }</style>';
}


wpas_add_custom_taxonomy('States', array(
    'label' => __('State', 'State'),
    'hierarchical' => true,
    'required' => true,
    'order' => 4,
    'show_ui' => true, // Make sure this is set to true
));


if ( function_exists( 'wpas_add_custom_field' ) ) {
    wpas_add_custom_field( 'City',  array( 'title' => __( 'City', 'awesome-support' ), 'required' => true, 'input_type' => 'text', 'order' => 5) );
}


function add_inline_wpas_department_validation_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // On form submit, check if the department is selected
            $('form').on('submit', function(e) {
                var departmentField = $('select[name="wpas_department"]');  // Adjust this selector to match the field name/ID
                if (departmentField.val() === '' || departmentField.val() === 'Please select') {
                    e.preventDefault();  // Prevent the form from submitting
                    alert('Please select a department.');  // Show an alert
                    departmentField.focus();  // Focus on the department field
                    departmentField.css('border', '2px solid red');  // Highlight the field with a red border
                }
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'add_inline_wpas_department_validation_script' );

/*
if ( function_exists( 'wpas_add_custom_field' ) ) {
    wpas_add_custom_field( 'Country',  array( 'title' => __( 'Country', 'awesome-support' ), 'order' => 40 ) );
}  */


if ( function_exists( 'wpas_add_custom_field' ) ) { 
 wpas_add_custom_field( 'Other',  array( 'title' => __( 'Other Department', 'awesome-support' ), 'order' => 23) );
} 




if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'issue_id',  array( 'title' => __( 'Issue ID', 'awesome-support' ), 'order' => 24) );
	}
}


if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Project_Key',  array( 'title' => __( 'Project Key', 'awesome-support' ), 'order' => 25) );
	}
}



if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'project_name',  array( 'title' => __( 'Project Name', 'awesome-support' ), 'order' => 26) );
	}
}




if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Resolution',  array( 'title' => __( 'Resolution', 'awesome-support' ), 'order' => 27) );
	}
}

if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Assignee_Jira',  array( 'title' => __( 'Assignee', 'awesome-support' ), 'order' => 28) );
	}
}


if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Assignee_Jira_id',  array( 'title' => __( 'Assignee ID', 'awesome-support' ), 'order' => 29) );
	}
}

if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Reporter_Jira',  array( 'title' => __( 'Reporter', 'awesome-support' ), 'order' => 30) );
	}
}


if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Reporter_Jira_id',  array( 'title' => __( 'Reporter ID', 'awesome-support' ), 'order' => 31) );
	}
}


if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Creator',  array( 'title' => __( 'Creator', 'awesome-support' ), 'order' => 32) );
	}
}

if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'Creator_Jira_id',  array( 'title' => __( 'Creator ID', 'awesome-support' ), 'order' => 33) );
	}
}


if ( function_exists( 'wpas_add_custom_field' ) ) { 
	if ( is_super_admin() ) {
 wpas_add_custom_field( 'status_category',  array( 'title' => __( 'Status Category', 'awesome-support' ), 'order' => 34) );
	}
}

function custom_login_redirect($redirect_to, $request, $user) {
    // Check if the user object is valid
    if (isset($user->roles) && is_array($user->roles)) {
        // Check if the user has the 'administrator' role
        if (in_array('administrator', $user->roles)) {
            // Redirect to the admin dashboard
            return admin_url();
        } 
        // Check if the user has the 'editor' role
        elseif (in_array('editor', $user->roles)) {
            // Redirect to the editor dashboard
            return admin_url();
        } 
        // Check if the user has the 'author' role
        elseif (in_array('author', $user->roles)) {
            // Redirect to the author dashboard
            return admin_url();
        } 
        // Check if the user has the 'contributor' role
        elseif (in_array('contributor', $user->roles)) {
            // Redirect to the contributor dashboard
            return admin_url();
        } 
        // Check if the user has the 'subscriber' role
        elseif (in_array('subscriber', $user->roles)) {
            // Redirect to the homepage or another page for subscribers
            return home_url();
        } 
        // Add additional roles as needed
        else {
            // Default redirect for other roles
            return home_url();
        }
    } else {
        // Redirect to the homepage if no valid user object is found
        return home_url();
    }
}

// Hook the custom login redirect function to the login redirect filter
add_filter('login_redirect', 'custom_login_redirect', 10, 3);


function hide_admin_notices_css() {
echo '<style>
        .notice, .update-nag { display: none !important; }
        .alignright {display: none;}
        #wpfooter {margin-left: 245px;display:none;}
        .updated {display:none;}
        #screen-meta-links {display: none;}
        #dashboard-widgets-wrap{display:none;}
        tr.user-admin-color-wrap {display:none;}
        a.page-title-action {display: none !important;}
        li#wp-admin-bar-archive {display: none;}
        li[data-tab-order="4"],
        li[data-tab-order="5"] {display: none;}
        #wp-admin-bar-p404_free_top_button {display: none;}
       .trash {display: none !important;}
       .view {display: none !important;}
       #ac-table-actions {
  display: none;
}
        .closeticket{display:none !important}
        .wpas_print{display:none !important}
        .dpp{display:none !important}
        .widefat td {min-height: auto !important;padding: 10px;}
        #is_ticket_template {display: none;}
        .is_ticket_template.column-is_ticket_template {display: none !important;}
		   #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
		  width: 150px;
		  background-color: #1a1a1a;
		}
		#adminmenuwrap .logo-overlay, #adminmenuwrap::before, .folded #adminmenuwrap::before {
		  content: " ";
		  width: 100%;
		  height: 40px;
		  display: block;
		  background-repeat: no-repeat;
		  background-size: contain;
		  background-color: transparent;
		  padding-top: 23px;
		  background-position: 0 23px;
		}
		
		#adminmenu .wp-not-current-submenu .wp-submenu, .folded #adminmenu .wp-has-current-submenu .wp-submenu {
  min-width: 140px;
  box-shadow: 1px 3px 6px rgba(0,0,0,.1);
  -webkit-box-shadow: 1px 3px 6px rgba(0,0,0,.1);
  -moz-box-shadow: 1px 3px 6px rgba(0,0,0,.1);
  -o-box-shadow: 1px 3px 6px rgba(0,0,0,.1);
  -ms-box-shadow: 1px 3px 6px rgba(0,0,0,.1);
}
		#wpcontent, #wpfooter {
		  margin-left: 140px;
		  margin-top: -40px;
		}
		#wpas-activity {
		  display: none;
		}
		.row-actions {
  display: block ruby;
}    
#wpas-mb-version{display:none;}

#tagsdiv-ticket-tag {
  display: none;
}
#toplevel_page_vc-welcome {
  display: none;
}

li#wp-admin-bar-view {
    display: none;
}
.wrap {
  margin: 50px 23px 0 0;
}
#adminmenuwrap{margin-top:0px !important;}
div#wpas_help_desk_ticket_id_wrapper { display: none;}
div#wpas_ticket_channel_wrapper {display: none;}
#adminmenu .current div.wp-menu-image:before {color: #FFF;}
.wp-menu-name {color: #FFF;}
span.collapse-button-label {color: #FFF;}
span.collapse-button-icon {color: #FFF;}
#wpas_admin_tabs_ticket_main_custom_fields .wpas-custom-fields h2 {font-weight: 700;display: none;}
li[rel="wpas_admin_tabs_ticket_main_statistics"] {display: none;}
#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu{color:#FFF !important;}
#wpbody-content .wrap{margin-top:50px !important;}
.wpas-toolbar li .wpas-icon{display:none;}
.acp-smartfilters{display:none;}
input#post-query-submit {
    background-color: #8551a5;
    color: #FFF;
}

input#filter_action{ background-color: #8551a5;
    color: #FFF;}
        #toplevel_page_hide-admin-menu {display: none;}
    </style>';  
}
add_action('admin_head', 'hide_admin_notices_css');
 
 
function add_logout_link_to_menu($items, $args) { ?>
<style>
    /* Basic styling for the button and dropdown menu */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 999;
    }

    .dropdown-content a {
      color: black;
      padding: 10px 10px !important;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .show {
      display: block;
    }
    
    button#btns {
    margin-top: 30px;
    background-color: transparent;
    border: none;
    color: red;
}
  </style>
  <script>
  function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown button')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
</script>
<script>
        function confirmLogout(event) {
            // Display a confirmation dialog
            const confirmation = confirm("Are you sure you want to log out?");
            
            // If the user clicks "Cancel", prevent the default action
            if (!confirmation) {
                event.preventDefault();
            }
        }
    </script>
<?php   if ($args->theme_location == 'primary') {
        // Add a logout link if the user is logged in
        if (is_user_logged_in()) {
        	$current_user = wp_get_current_user();
            $logout_url = wp_logout_url(home_url());
            $username = $current_user->display_name;
           if (!current_user_can('administrator')) {
            $items .= '<div class="dropdown"><button id="btns" onclick="toggleDropdown()">Welcome : '.$username.'</button><div id="myDropdown" class="dropdown-content"><a href="'.get_permalink(43).'" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a><div class="divider dropdown-divider"></div><a onclick="confirmLogout(event)" href="' . $logout_url . '" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
</div>';
			}
            
        }
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_logout_link_to_menu', 10, 2);

function awesome_support_login_redirect($user_login, $user) {
    // Check if the user has the administrator or super_viewer role
    if (in_array('administrator', $user->roles) || in_array('super_viewer', $user->roles)) {
        // Set the URL to redirect to
        $redirect_url = site_url().'/wp-admin/edit.php?post_type=ticket';
        
        // Perform the redirection
        wp_safe_redirect($redirect_url);
        exit();
    }
}

// Hook into the wp_login action to perform the redirection
add_action('wp_login', 'awesome_support_login_redirect', 10, 2);





// Hide specific roles in the user list table
function hide_specific_user_roles_from_list($views) {
	unset($views['wpas_manager']);
	unset($views['wpas_support_manager']);
	unset($views['subscriber']);
    unset($views['author']);
    unset($views['editor']);
    unset($views['contributor']);
    return $views;
}
add_filter('views_users', 'hide_specific_user_roles_from_list');

// Hide specific roles in the user list dropdown
function hide_specific_user_roles_dropdown() {
    global $wp_roles;

    if (!isset($wp_roles)) {
        $wp_roles = new WP_Roles();
    }

    if (is_object($wp_roles)) {
    	$wp_roles->remove_role('wpas_manager');
    	$wp_roles->remove_role('wpas_support_manager');
    	$wp_roles->remove_role('subscriber');
        $wp_roles->remove_role('author');
        $wp_roles->remove_role('editor');
        $wp_roles->remove_role('contributor');
    }
}
add_action('admin_init', 'hide_specific_user_roles_dropdown');

// Hide role selection in user profile and edit user pages
function hide_specific_roles_from_profile() {
    ?>
    <style>
        option[value='wpas_support_manager'],
        option[value='wpas_manager'],
        option[value='subscriber'],
        option[value='author'],
        option[value='editor'],
        option[value='contributor'] {
            display: none !important;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
        	 $('#role option[value="wpas_manager"]').remove();
        	 $('#role option[value="wpas_support_manager"]').remove();
        	 $('#role option[value="subscriber"]').remove();
            $('#role option[value="author"]').remove();
            $('#role option[value="editor"]').remove();
            $('#role option[value="contributor"]').remove();
        });
    </script>
    <?php
}
add_action('admin_head-user-edit.php', 'hide_specific_roles_from_profile');
add_action('admin_head-profile.php', 'hide_specific_roles_from_profile');






function awesome_support_login_redirect_new($user_login, $user) {
	  
    if (in_array('wpas_agent', $user->roles)) {
        // Set the URL to redirect to
          $redirect_url = site_url().'/wp-admin/edit.php?post_type=ticket'; 
        // Perform the redirection
        wp_safe_redirect($redirect_url);
        exit();
    }
}

// Hook into the wp_login action to perform the redirection
add_action('wp_login', 'awesome_support_login_redirect_new', 10, 2);


function restrict_wp_admin_access() {
    if (is_admin() && current_user_can('wpas_user')) {
        wp_redirect(home_url()); // Redirect to home page or any other URL
        exit;
    }
}
add_action('admin_init', 'restrict_wp_admin_access');







function hide_close_button_for_support_agents() {
    if (current_user_can('wpas_agent')) {
        ?>
        <style>
            #delete-action {display: none !important;}
            .openticket{display: none !important;}
            div#application-passwords-section {display: none;}
            div#wpas_user_profile_segment {display: none;}
             .user-rich-editing-wrap {display: none;}
              .show-admin-bar {display: none;}
             .user-comment-shortcuts-wrap {display: none;}
             .user-url-wrap {display: none;}
             .user-twitter-wrap {display: none;}
             .user-facebook-wrap {display: none;}
             .user-gplus-wrap {display: none;}
             .user-description-wrap {display: none;}
              .user-profile-picture {display: none;}
        </style>
        <?php
    }
}
add_action('admin_head', 'hide_close_button_for_support_agents');
add_action('wp_head', 'hide_close_button_for_support_agents'); // In case the button appears on the front end.


function remove_close_ticket_capability_for_support_agents() {
    if (current_user_can('support_agent')) {
        remove_action('wpsp_ticket_row_actions', 'wpsp_close_ticket_action', 10);
    }
}
add_action('admin_init', 'remove_close_ticket_capability_for_support_agents');




function enqueue_custom_admin_scripts() {
    // Enqueue the custom JavaScript file for the admin area
    wp_enqueue_script(
        'admin-logout-confirmation',
        get_template_directory_uri() . '/js/admin-logout-confirmation.js', // Update this path as necessary
        array('jquery'),
        null,
        true
    );
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_scripts');


function send_admin_email_on_agent_reply($reply_id, $ticket_id) {
    // Get the reply details
    $reply = wpas_get_reply($reply_id);
    $ticket = wpas_get_ticket($ticket_id);

    // Check if the reply was made by a support agent
    $agent_role = 'wpas_agent';
    $user = get_user_by('id', $reply->user_id);
    if (in_array($agent_role, (array) $user->roles)) {
        // Set the administrator email
        $admin_email = get_option('admin_email');
        
        // Set the email subject and body
        $subject = 'New Reply to Ticket #' . $ticket->id;
        $message = 'A new reply has been made by ' . $user->display_name . ' to the ticket #' . $ticket->id . '.

Reply:
' . $reply->content . '

You can view the ticket here: ' . get_permalink($ticket->id);

        // Send the email to the administrator
        wp_mail($admin_email, $subject, $message);
    }
}

add_action('wpas_reply_inserted', 'send_admin_email_on_agent_reply', 10, 2);




function add_date_filters_to_admin_post_list() {
    global $typenow;

    // Check if we're on the post list page (change 'post' to your custom post type if needed)
    if ($typenow == 'ticket') {
        // Start Date
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        echo '<input class="start_date" type="date" name="start_date" value="' . esc_attr($start_date) . '" placeholder="Start Date" />';

        // End Date
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
        echo '<input class="end_date" type="date" name="end_date" value="' . esc_attr($end_date) . '" placeholder="End Date" />';

        submit_button('Filter', '', 'filter_action', false);
    }
}
add_action('restrict_manage_posts', 'add_date_filters_to_admin_post_list');


function filter_posts_by_date_range($query) {
    global $pagenow, $typenow;

    // Only apply this filter on the admin post list page for the correct post type
    if ($pagenow == 'edit.php' && $typenow == 'ticket' && isset($_GET['filter_action'])) {

        // Get the start and end dates from the URL parameters
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        // If both dates are provided, modify the query to filter by date range
        if (!empty($start_date) && !empty($end_date)) {
            $query->query_vars['date_query'] = array(
                array(
                    'after'     => $start_date,
                    'before'    => $end_date,
                    'inclusive' => true,
                ),
            );
        } elseif (!empty($start_date)) {
            // If only the start date is provided, filter posts from that date onward
            $query->query_vars['date_query'] = array(
                array(
                    'after'     => $start_date,
                    'inclusive' => true,
                ),
            );
        } elseif (!empty($end_date)) {
            // If only the end date is provided, filter posts up to that date
            $query->query_vars['date_query'] = array(
                array(
                    'before'    => $end_date,
                    'inclusive' => true,
                ),
            );
        }
    }
}
add_filter('pre_get_posts', 'filter_posts_by_date_range');






function add_export_buttons_to_ticket_page() {
    $screen = get_current_screen();

    if ($screen->id !== 'edit-ticket') {
        return;
    }

    echo '<a href="' . esc_url(admin_url('edit.php?export_filtered_tickets_csv=1&post_type=ticket&post_status=queued')) . '" class="button button-primary exporttkt" style="margin-right: 10px;">Export New Tickets</a>';
    
      echo '<a href="' . esc_url(admin_url('edit.php?export_filtered_tickets_csv=1&post_type=ticket&post_status=processing')) . '" class="button button-primary exporttkt" style="margin-right: 10px;">Export In-Progress Tickets</a>';
      
       echo '<a href="' . esc_url(admin_url('edit.php?export_filtered_tickets_csv=1&post_type=ticket&post_status=hold')) . '" class="button button-primary exporttkt" style="margin-right: 10px;">Export Done Tickets</a>';
       
       
      echo '<a href="' . esc_url(admin_url('edit.php?export_filtered_tickets_csv_closed=1&post_type=ticket&status=closed')) . '" class="button button-primary exporttkt" style="margin-right: 10px;">Export Closed Tickets</a>';
      
      
        echo '<a href="' . esc_url(admin_url('edit.php?export_filtered_tickets_csv=1&post_type=ticket&post_status=any')) . '" class="button button-primary exporttkt" style="margin-right: 10px;">Export All Tickets</a>';
       
            
       echo do_shortcode('[ticket_search]');
      
   
}





add_action('restrict_manage_posts', 'add_export_buttons_to_ticket_page');


function export_custom_status_tickets_csv() {
    // Check for the specific URL parameters
    if (isset($_GET['export_filtered_tickets_csv']) && $_GET['export_filtered_tickets_csv'] == '1' 
        && isset($_GET['post_type']) && $_GET['post_type'] == 'ticket' 
        && isset($_GET['post_status'])) {

        if (!current_user_can('manage_options')) {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        // Define the statuses you want to export
          $statuses = array('queued', 'processing','hold','any');

        // Check if the requested post status is in the allowed statuses
	        $requested_status = $_GET['post_status'];
	        if (!in_array($requested_status, $statuses)) {
	            wp_die('Invalid ticket status.');
	        }

        // Define query arguments
     


	        header('Content-Type: text/csv');
	         $current_date =  date('d-m-Y');
	        header('Content-Disposition: attachment; filename="NUDM-UPYOG-Helpdesk-' . $current_date . '.csv"');

	        // Open the output stream
	        $csv_file = fopen('php://output', 'w');
            $headers = array('Ticket ID', 'Ticket-Title','Project Key' ,'Ticket-Description','Ticket-Type','Projects','States','City','Status', 'Priority', 'Assignee-ID', 'Assignee-Name','Reporter-ID','Reporter-Name','Department','Other-Department','Created Date', 'Modified Date','Resolved Date');
     
        fputcsv($csv_file, $headers);
        
        if (!current_user_can('manage_options')) {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        // Define the statuses you want to export
        

        // Check if the requested post status is in the allowed statuses
        $requested_status = $_GET['post_status'];
         $args = array(
            'post_type'      => 'ticket',
            'posts_per_page' => -1,
            'post_status'    => $requested_status,
        );
        
        
         $tickets = new WP_Query($args);

      
           global $post;
		   $author_id = $post->post_author;
           if ($tickets->have_posts()) {
            while ($tickets->have_posts()) {
                $tickets->the_post();
                $ticket_id = get_the_ID();
                $ticket_ids = 'NUDM-'.$ticket_id;
                $title = get_the_title();
                $content = get_the_content();
                $status = get_post_meta($ticket_id, '_wpas_status', true);
                 if($status =='open')
                {
                	$status ='In-Progress';
                }
               
                $agent = get_post_meta($ticket_id, '_wpas_assignee', true);
                $agents = get_userdata($agent);
				$agent_name = $agents->display_name;
				$agent_id = $agents->ID;
				$agentsid = 'Assignee-'.$agent_id;
                $created_date = get_the_date('Y-m-d H:i:s');
                $modified_date = get_the_modified_date('Y-m-d H:i:s');
                if($status == 'closed') {
    			$resolved_date = get_the_modified_date('Y-m-d H:i:s', $ticket_id); 
				} else {
                $resolved_date = null; // or another default value
                }           
                global $post;
                
                 $author_id = $post->post_author;
                $author_name = get_the_author_meta( 'display_name', $author_id );
                $author_ids =  'Reporter-'.get_the_author_meta('ID');
                $otherdept = get_post_meta($ticket_id, '_wpas_Other', true);
                $priority_names = array();  
                $priority_terms = get_the_terms( $ticket->ID, 'ticket_priority' );
                
                
		        foreach ( $priority_terms as $priority ) {
		        $priority_names[] = $priority->name;
		        }
               
                $priority_namesss = implode( ', ', $priority_names );
                
                $city = get_post_meta($ticket_id, '_wpas_City', true);
              
                
                
                $alltickettype = array(); 
                $ticket_type = get_the_terms($ticket_id, 'ticket_type');
                
                foreach($ticket_type as $ticket_types)
                {
                	  $alltickettype[] = $ticket_types->name; 
                } 
                $alltickettype = implode(', ', $alltickettype);
                
                
                $allprojects = array(); 
                $projects = get_the_terms($ticket_id, 'projects');
                
                foreach($projects as $project)
                {
                	  $allprojects[] = $project->name; 
                } 
                $allprojects = implode(', ', $allprojects);
                
                
                $allStates = array(); 
                $states = get_the_terms($ticket_id, 'States');
                
                foreach($states as $state)
                {
                	  $allStates[] = $state->name; 
                } 
                $allStates = implode(', ', $allStates);   
                
                     
                                              
                $alldept = array(); 
                $departments = get_the_terms($ticket_id, 'department');
                
                foreach($departments as $department)
                {
                   $alldept[] = $department->name; 
                } 
                $alldept = implode(', ', $alldept);  
                
                $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $queued = 'queued'; 
                $new = 'New';
                $processing = 'processing'; 
                $inprogress = 'In-Progress'; 
                $hold = 'hold';
                $done = 'Done';
                $any =  'any';
                $any ='Closed';
				if ($requested_status == $queued) {
			    $row = array($ticket_ids, $title, 'NUDM', $content,$alltickettype,$allprojects,$allStates, $city, $new , $priority_namesss,$agentsid,$agent_name,$author_ids,$author_name,$alldept,$otherdept,$created_date, $modified_date,$resolved_date);
                fputcsv($csv_file, $row);
				} elseif ($requested_status == $processing) {
			    $row = array($ticket_ids, $title, 'NUDM', $content,$alltickettype,$allprojects,$allStates, $city, $inprogress, $priority_namesss,$agentsid,$agent_name,$author_ids,$author_name,$alldept,$otherdept,$created_date, $modified_date,$resolved_date);
                fputcsv($csv_file, $row);
				} elseif ($requested_status == $hold) {
			    $row = array($ticket_ids, $title, 'NUDM', $content,$alltickettype,$allprojects,$allStates, $city, $done, $priority_namesss,$agentsid,$agent_name,$author_ids,$author_name,$alldept,$otherdept,$created_date, $modified_date,$resolved_date);
                fputcsv($csv_file, $row); }
                elseif ($requested_status == 'any') {
			    $row = array($ticket_ids, $title, 'NUDM', $content,$alltickettype,$allprojects,$allStates, $city, $status, $priority_namesss,$agentsid,$agent_name,$author_ids,$author_name,$alldept,$otherdept,$created_date, $modified_date,$resolved_date);
                fputcsv($csv_file, $row); }
                 else {
				 $row = array($ticket_ids, $title, 'NUDM', $content,$alltickettype,$allprojects,$allStates, $city, $status, $priority_namesss,$agentsid,$agent_name,$author_ids,$author_name,$alldept,$otherdept,$created_date, $modified_date,$resolved_date);	
				}
                
          
                             
           }
            wp_reset_postdata();
        }

        fclose($csv_file);
        exit();
    }
}
add_action('init', 'export_custom_status_tickets_csv');


function export_closed_tickets_csv_closednew() {
    // Check if the specific URL parameters are set
    if (isset($_GET['export_filtered_tickets_csv_closed']) && $_GET['export_filtered_tickets_csv_closed'] == '1' 
        && isset($_GET['post_type']) && $_GET['post_type'] == 'ticket' 
        && isset($_GET['status']) && $_GET['status'] == 'closed') {

        // Ensure the user has the right permissions
        if (!current_user_can('manage_options')) {
            wp_die('You do not have sufficient permissions to access this page.');
        }
        
        
        
	        header('Content-Type: text/csv');
	         $current_date =  date('d-m-Y');
	        header('Content-Disposition: attachment; filename="NUDM-UPYOG-Helpdesk-' . $current_date . '.csv"');

	        // Open the output stream
	        $csv_file = fopen('php://output', 'w');
            $headers = array('Ticket ID', 'Ticket-Title','Project Key' ,'Ticket-Description','Ticket-Type','Projects','States','City','Status', 'Priority', 'Assignee-ID', 'Assignee-Name','Reporter-ID','Reporter-Name','Department','Other-Department','Created Date', 'Modified Date','Resolved Date');
     
        fputcsv($csv_file, $headers);
        
        

        // Define query arguments to get closed tickets
        $args = array(
            'post_type'      => 'ticket',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => '_wpas_status',
                    'value'   => 'closed',
                    'compare' => '=',
                ),
            ),
            'post_status'    => 'any', // Consider all post statuses
        );

          $tickets = new WP_Query($args);


        if (empty($tickets)) {
            wp_die('No closed tickets found.');
        }

        
        
        global $post;
		   $author_id = $post->post_author;
           if ($tickets->have_posts()) {
            while ($tickets->have_posts()) {
                $tickets->the_post();
                $ticket_id = get_the_ID();
                $ticket_ids = 'NUDM-'.$ticket_id;
                $title = get_the_title();
                $content = get_the_content();
                $status = get_post_meta($ticket_id, '_wpas_status', true);
                 if($status =='open')
                {
                	$status ='In-Progress';
                }
               
                $agent = get_post_meta($ticket_id, '_wpas_assignee', true);
                $agents = get_userdata($agent);
				$agent_name = $agents->display_name;
				$agent_id = $agents->ID;
				$agentsid = 'Assignee-'.$agent_id;
                $created_date = get_the_date('Y-m-d H:i:s');
                $modified_date = get_the_modified_date('Y-m-d H:i:s');
                if($status == 'closed') {
    			$resolved_date = get_the_modified_date('Y-m-d H:i:s', $ticket_id); 
				} else {
                $resolved_date = null; // or another default value
                }           
                global $post;
                
                 $author_id = $post->post_author;
                $author_name = get_the_author_meta( 'display_name', $author_id );
                $author_ids =  'Reporter-'.get_the_author_meta('ID');
                $otherdept = get_post_meta($ticket_id, '_wpas_Other', true);
                $priority_names = array();  
                $priority_terms = get_the_terms( $ticket->ID, 'ticket_priority' );
                
                
		        foreach ( $priority_terms as $priority ) {
		        $priority_names[] = $priority->name;
		        }
               
                $priority_namesss = implode( ', ', $priority_names );
                
                $city = get_post_meta($ticket_id, '_wpas_City', true);
              
                
                
                $alltickettype = array(); 
                $ticket_type = get_the_terms($ticket_id, 'ticket_type');
                
                foreach($ticket_type as $ticket_types)
                {
                	  $alltickettype[] = $ticket_types->name; 
                } 
                $alltickettype = implode(', ', $alltickettype);
                
                
                $allprojects = array(); 
                $projects = get_the_terms($ticket_id, 'projects');
                
                foreach($projects as $project)
                {
                	  $allprojects[] = $project->name; 
                } 
                $allprojects = implode(', ', $allprojects);
                
                
                $allStates = array(); 
                $states = get_the_terms($ticket_id, 'States');
                
                foreach($states as $state)
                {
                	  $allStates[] = $state->name; 
                } 
                $allStates = implode(', ', $allStates);   
                
                     
                                              
                $alldept = array(); 
                $departments = get_the_terms($ticket_id, 'department');
                
                foreach($departments as $department)
                {
                   $alldept[] = $department->name; 
                } 
                $alldept = implode(', ', $alldept); 
                
                
                 $row = array($ticket_ids, $title, 'NUDM', $content,$alltickettype,$allprojects,$allStates, $city, 'closed', $priority_namesss,$agentsid,$agent_name,$author_ids,$author_name,$alldept,$otherdept,$created_date, $modified_date,$resolved_date);
                fputcsv($csv_file, $row); 
                
                
        
           }
            wp_reset_postdata();
        }

        fclose($csv_file);
        exit();
        
    }
}
add_action('init', 'export_closed_tickets_csv_closednew');






function custom_admin_menu() {
    add_menu_page(
       'Pervious Data',        // Page title
        'Pervious Data',        // Menu title
        'manage_options',     // Capability
        'custom-data',        // Menu slug
        'custom_data_page',   // Callback function
        'dashicons-database', // Icon
       106                     // Position
    );
}
add_action('admin_menu', 'custom_admin_menu');


function custom_data_page() {  ?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 5px;
  width: 100px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

#myModal{margin-top: 50px;}
</style>
        <?php 
         global $wpdb;
     $table_name = 'wp_jira_tickets';

    // Fetch the current data based on ID
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if ($row) {
        echo '<h2>Edit Data</h2>';
        echo '<form method="post">';
        echo '<input type="hidden" name="id" value="' . esc_attr($row->id) . '">';
        echo '<p><label for="name">Issue Key</label>';
        echo '<input type="text" name="Issue_key" value="' . esc_attr($row->Issue_key) . '" ></p>';
        echo '<p><label for="email">Summary</label>';
        echo '<input type="text" name="Summary" value="' . esc_attr($row->Summary) . '" ></p>';
        echo '<p><label for="email">Issue Id </label>';
        echo '<input type="text" name="Issue_id" value="' . esc_attr($row->Issue_id) . '" ></p>';
        echo '<p><label for="email">Issue Type</label>';
        echo '<input type="text" name="Issue_type" value="' . esc_attr($row->Issue_type) . '" ></p>';
        echo '<p><label for="email">status </label>';
        echo '<input type="text" name="status" value="' . esc_attr($row->status) . '" ></p>';
        echo '<p><label for="email">Project Key  </label>';
        echo '<input type="text" name="Project_key" value="' . esc_attr($row->Project_key) . '" ></p>';
        echo '<p><label for="email">Project Name   </label>';
        echo '<input type="text" name="Project_name" value="' . esc_attr($row->Project_name) . '" ></p>';
        echo '<p><label for="email">Priority   </label>';
        echo '<input type="text" name="Priority" value="' . esc_attr($row->Priority) . '" ></p>';
        echo '<p><label for="email">Resolution   </label>';
        echo '<input type="text" name="Resolution" value="' . esc_attr($row->Resolution) . '" ></p>';
        echo '<p><label for="email">Assignee </label>';
        echo '<input type="text" name="Assignee" value="' . esc_attr($row->Assignee) . '" ></p>';
        echo '<p><label for="email">Assignee_Id  </label>';
        echo '<input type="text" name="Assignee_Id" value="' . esc_attr($row->Assignee_Id) . '" ></p>';
        echo '<p><label for="email">Reporter   </label>';
        echo '<input type="text" name="Reporter" value="' . esc_attr($row->Reporter) . '" ></p>';
        echo '<p><label for="email">Reporter   </label>';
        echo '<input type="text" name="Reporter_Id" value="' . esc_attr($row->Reporter_Id) . '" ></p>';
        echo '<p><label for="email">Creator    </label>';
        echo '<input type="text" name="Creator" value="' . esc_attr($row->Creator) . '" ></p>';
        echo '<p><label for="email">Creator_Id     </label>';
        echo '<input type="text" name="Creator_Id" value="' . esc_attr($row->Creator_Id) . '" ></p>';
        echo '<p><label for="email">Created Date </label>';
        echo '<input type="text" name="Created_date" value="' . esc_attr($row->Created_date) . '" ></p>';
        echo '<p><label for="email">Updated Date </label>';
        echo '<input type="text" name="Updated_date" value="' . esc_attr($row->Updated_date) . '" ></p>';
        echo '<p><label for="email">Resloved Date </label>';
        echo '<input type="text" name="Resolved_date" value="' . esc_attr($row->Resolved_date) . '" ></p>';
        echo '<p><label for="email">States  </label>';
        echo '<input type="text" name="States" value="' . esc_attr($row->States) . '" ></p>';
        echo '<p><label for="email">Description  </label>';
        echo '<input type="text" name="Description" value="' . esc_attr($row->Description) . '" ></p>';
        echo '<p><label for="email">Status Category   </label>';
        echo '<input type="text" name="Status_Category" value="' . esc_attr($row->Status_Category) . '" ></p>';
        
        echo '<p><input type="submit" name="update_data" value="Update Data" class="button button-primary"></p>';
        
        
        echo '</form>';
    } else {
        echo '<p>Data not found.</p>';
    }
         
         ?>
   
  

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<?php 
    global $wpdb;
    $table_name = 'wp_jira_tickets'; // Replace 'custom_data' with your actual table name
    $results = $wpdb->get_results("SELECT * FROM $table_name");
    echo '<h1>All Previous Ticket</h1>';
    echo '<a href="https://upyog-helpdesk.niua.org/wp-content/uploads/2024/09/Jira-Updated-1.csv" class="button button-primary" style="margin-right: 10px; float:right;">Export All Tickets</a>';
    echo '<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Issue Key.." title="Type in a Issue Key" style="width:50%">';
    if ($results) {
        echo '<table id="myTable" class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>ID</th><th>Issue Key</th><th>Summary</th><th>Issue Id</th><th>Issue Type</th><th>status</th><th>Project Key</th><th>Project Name </th><th>Priority</th><th>Resolution</th><th>Assignee </th><th> 	Assignee Id  </th><th>Reporter  </th>	<th>Reporter ID  </th><th>Creator</th><th>Creator ID</th><th>Creator Date</th> 	<th>Update Date</th> <th>Resolved Date</th>	<th>States </th>	<th>Description  </th>	<th>Status Category  </th>	<th>Actions</th></tr></thead>';
        echo '<tbody>';

        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . esc_html($row->id) . '</td>';
            echo '<td>' . esc_html($row->Issue_key ) . '</td>';
            echo '<td>' . esc_html($row->Summary ) . '</td>';
            echo '<td>' . esc_html($row->Issue_id  ) . '</td>';
            echo '<td>' . esc_html($row->Issue_type ) . '</td>';
            echo '<td>' . esc_html($row->status ) . '</td>';
            echo '<td>' . esc_html($row->Project_key  ) . '</td>';
            echo '<td>' . esc_html($row->Project_name   ) . '</td>';
            echo '<td>' . esc_html($row->Priority) . '</td>';
            echo '<td>' . esc_html($row->Resolution) . '</td>';
            echo '<td>' . esc_html($row->Assignee) . '</td>';
            echo '<td>' . esc_html($row->Assignee_Id ) . '</td>';
            echo '<td>' . esc_html($row->Reporter) . '</td>';
            echo '<td>' . esc_html($row->Reporter_Id ) . '</td>';
            echo '<td>' . esc_html($row->Creator) . '</td>';
            echo '<td>' . esc_html($row->Creator_Id ) . '</td>';
            echo '<td>' . esc_html($row->Created_date ) . '</td>';
            echo '<td>' . esc_html($row->Updated_date) . '</td>';
            echo '<td>' . esc_html($row->Resolved_date) . '</td>';
            echo '<td>' . esc_html($row->States ) . '</td>';
            echo '<td>' . esc_html($row->Description ) . '</td>'; 
            echo '<td>' . esc_html($row->Status_Category ) . '</td>'; 
            echo '<td>';
            ///echo '<a href="?page=custom-data&action=edit&id=' . esc_attr($row->id) . '" data-toggle="modal" data-target="#myModal">Edit</a> | ';
           // echo '<a href="?page=custom-data&action=edit&id=' . esc_attr($row->id) . '">Edit</a> | ';
            echo '<a href="?page=custom-data&action=delete&id=' . esc_attr($row->id) . '" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No data found.</p>';
    }

    // Handle actions (Edit, Update, Delete)
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
            custom_data_edit_form(intval($_GET['id']));
        } elseif ($_GET['action'] == 'delete' && isset($_GET['id'])) {
            custom_data_delete(intval($_GET['id']));
        }
    }

    // Handle the form submission for editing or updating
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_data'])) {
        custom_data_update();
    }
}


function custom_data_edit_form($id) {
    global $wpdb;
     $table_name = 'wp_jira_tickets';

    // Fetch the current data based on ID
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if ($row) {
        echo '<h2>Edit Data</h2>';
        echo '<form method="post">';
        echo '<input type="hidden" name="id" value="' . esc_attr($row->id) . '">';
        echo '<p><label for="name">Issue Key</label>';
        echo '<input type="text" name="Issue_key" value="' . esc_attr($row->Issue_key) . '" ></p>';
        echo '<p><label for="email">Summary</label>';
        echo '<input type="text" name="Summary" value="' . esc_attr($row->Summary) . '" ></p>';
        echo '<p><label for="email">Issue Id </label>';
        echo '<input type="text" name="Issue_id" value="' . esc_attr($row->Issue_id) . '" ></p>';
        echo '<p><label for="email">Issue Type</label>';
        echo '<input type="text" name="Issue_type" value="' . esc_attr($row->Issue_type) . '" ></p>';
        echo '<p><label for="email">status </label>';
        echo '<input type="text" name="status" value="' . esc_attr($row->status) . '" ></p>';
        echo '<p><label for="email">Project Key  </label>';
        echo '<input type="text" name="Project_key" value="' . esc_attr($row->Project_key) . '" ></p>';
        echo '<p><label for="email">Project Name   </label>';
        echo '<input type="text" name="Project_name" value="' . esc_attr($row->Project_name) . '" ></p>';
        echo '<p><label for="email">Priority   </label>';
        echo '<input type="text" name="Priority" value="' . esc_attr($row->Priority) . '" ></p>';
        echo '<p><label for="email">Resolution   </label>';
        echo '<input type="text" name="Resolution" value="' . esc_attr($row->Resolution) . '" ></p>';
        echo '<p><label for="email">Assignee </label>';
        echo '<input type="text" name="Assignee" value="' . esc_attr($row->Assignee) . '" ></p>';
        echo '<p><label for="email">Assignee_Id  </label>';
        echo '<input type="text" name="Assignee_Id" value="' . esc_attr($row->Assignee_Id) . '" ></p>';
        echo '<p><label for="email">Reporter   </label>';
        echo '<input type="text" name="Reporter" value="' . esc_attr($row->Reporter) . '" ></p>';
        echo '<p><label for="email">Reporter   </label>';
        echo '<input type="text" name="Reporter_Id" value="' . esc_attr($row->Reporter_Id) . '" ></p>';
        echo '<p><label for="email">Creator    </label>';
        echo '<input type="text" name="Creator" value="' . esc_attr($row->Creator) . '" ></p>';
        echo '<p><label for="email">Creator_Id     </label>';
        echo '<input type="text" name="Creator_Id" value="' . esc_attr($row->Creator_Id) . '" ></p>';
        echo '<p><label for="email">Created Date </label>';
        echo '<input type="text" name="Created_date" value="' . esc_attr($row->Created_date) . '" ></p>';
        echo '<p><label for="email">Updated Date </label>';
        echo '<input type="text" name="Updated_date" value="' . esc_attr($row->Updated_date) . '" ></p>';
        echo '<p><label for="email">Resloved Date </label>';
        echo '<input type="text" name="Resolved_date" value="' . esc_attr($row->Resolved_date) . '" ></p>';
        echo '<p><label for="email">States  </label>';
        echo '<input type="text" name="States" value="' . esc_attr($row->States) . '" ></p>';
        echo '<p><label for="email">Description  </label>';
        echo '<input type="text" name="Description" value="' . esc_attr($row->Description) . '" ></p>';
        echo '<p><label for="email">Status Category   </label>';
        echo '<input type="text" name="Status_Category" value="' . esc_attr($row->Status_Category) . '" ></p>';
        
        echo '<p><input type="submit" name="update_data" value="Update Data" class="button button-primary"></p>';
        
        
        echo '</form>';
    } else {
        echo '<p>Data not found.</p>';
    }
}

function custom_data_update() {
    global $wpdb;
    $table_name = 'wp_jira_tickets';

    $id = intval($_POST['id']);
    $Issue_key = sanitize_text_field($_POST['Issue_key ']);
    $Issue_key = sanitize_email($_POST['Issue_key']);

    // Update the data in the database
    $wpdb->update(
        $table_name,
        array(
            'Issue_key' => $name,
            'Issue_key' => $email
        ),
        array('id' => $id),
        array('%s', '%s'),
        array('%d')
    );

    // Redirect to the main page to avoid resubmission on page refresh
    wp_redirect(admin_url('admin.php?page=custom-data'));
    exit;
}


function custom_data_delete($id) {
    global $wpdb;
    $table_name = 'wp_jira_tickets';

    // Delete the data from the database
    $wpdb->delete($table_name, array('id' => $id), array('%d'));

    // Redirect to the main page after deletion
    wp_redirect(admin_url('admin.php?page=custom-data'));
    exit;
}








add_action('admin_menu', 'add_import_tickets_menu');

function add_import_tickets_menu() {
    add_menu_page(
        'Import Tickets',          // Page title
        'Import Tickets',          // Menu title
        'manage_options',          // Capability
        'import_tickets',          // Menu slug
        'import_tickets_page'      // Callback function
    );
}


function import_tickets_page() {
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        echo '<div class="updated"><p>CSV import complete.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Import Tickets</h1>
        <form method="post" enctype="multipart/form-data" action="<?php echo admin_url('admin-post.php'); ?>">
            <input type="hidden" name="action" value="import_csv_tickets">
            <input type="file" name="csv_file" required>
            <input type="submit" value="Import CSV" class="button-primary">
        </form>
    </div>
    <?php
}
add_action('admin_post_import_csv_tickets', 'import_tickets_from_csv');

function import_tickets_from_csv() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['csv_file']['tmp_name'];

        if (($handle = fopen($file, 'r')) !== FALSE) {
            $header = fgetcsv($handle); // Get CSV headers

            global $wpdb;

            while (($data = fgetcsv($handle)) !== FALSE) {
                $post_data = array_combine($header, $data);

                // Prepare post data
                $post_title = sanitize_text_field($post_data['post_title']);
                $post_content = sanitize_textarea_field($post_data['post_content']);
                $post_date = sanitize_text_field($post_data['post_date']);
                $post_date_gmt = sanitize_text_field($post_data['post_date_gmt']);
                $post_modified = sanitize_text_field($post_data['post_modified']);
                $post_modified_gmt = sanitize_text_field($post_data['post_modified_gmt']);
                $post_author = isset($post_data['post_author']) ? intval($post_data['post_author']) : get_current_user_id();
                $post_name = isset($post_data['post_name']) ? sanitize_title($post_data['post_name']) : sanitize_title($post_title);
                $post_status = isset($post_data['post_status']) ? sanitize_text_field($post_data['post_status']) : 'publish';

                // Validate post_status
                if (!post_status_exists($post_status)) {
                    $post_status = 'processing'; // Default to 'publish' if status is invalid
                }

                // Insert into wp_posts table
                $wpdb->insert(
                    $wpdb->posts,
                    array(
                        'post_title'    => $post_title,
                        'post_content'  => $post_content,
                        'post_date'     => $post_date,
                        'post_date_gmt' => $post_date_gmt,
                        'post_modified' => $post_modified,
                        'post_modified_gmt' => $post_modified_gmt,
                        'post_author'   => $post_author,
                        'post_name'     => $post_name,
                        'post_type'     => 'ticket',
                        'post_status'   => $post_status, // Use post status from CSV
                    )
                );

                $post_id = $wpdb->insert_id; // Get the ID of the inserted post

                // Generate a GUID dynamically based on the post ID
                $guid = home_url('?post_type=ticket&p=' . $post_id);

                // Update the GUID in the wp_posts table
                $wpdb->update(
                    $wpdb->posts,
                    array('guid' => $guid),
                    array('ID' => $post_id)
                );

                // Prepare and insert meta data
                $meta_keys = array(
                    '_wpas_issue_id', '_wpas_Project_Key', '_wpas_Resolution',
                    '_wpas_Assignee_Jira', '_wpas_Assignee_Jira_id', '_wpas_Reporter_Jira',
                    '_wpas_Reporter_Jira_id', '_wpas_Creator', '_wpas_Creator_Jira_id',
                    '_wpas_status_category', '_wpas_assignee', '_wpas_status', '_wpas_priority',
                    '_wpas_States', '_wpas_ticket_priority', '_wpas_projects'
                );

                foreach ($meta_keys as $key) {
                    if (isset($post_data[$key])) {
                        $meta_value = sanitize_text_field($post_data[$key]);

                        // Insert into wp_postmeta table
                        $wpdb->insert(
                            $wpdb->postmeta,
                            array(
                                'post_id'    => $post_id,
                                'meta_key'   => $key,
                                'meta_value' => $meta_value,
                            )
                        );
                    }
                }

                // Assign ticket_priority terms from the CSV (if using a taxonomy)
                if (isset($post_data['ticket_priority'])) {
                    $ticket_priority = explode(',', $post_data['ticket_priority']); // Split ticket_priority if there are multiple
                    wp_set_post_terms($post_id, $ticket_priority, 'ticket_priority'); // Assign the ticket_priority terms
                }
            }

            fclose($handle);
            wp_redirect(admin_url('admin.php?page=import_tickets&status=success'));
            exit;
        } else {
            wp_die('Error opening the CSV file.');
        }
    } else {
        wp_die('No file uploaded or there was an upload error.');
    }
}





function post_status_exists($status) {
    $statuses = get_post_stati(array('show_in_admin_status_list' => true));
    return in_array($status, $statuses);
}



function remove_required_attribute_ticket_type() {
    // Check if the current user is a super admin
    if (is_super_admin()) {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var ticketTypeField = document.getElementById('wpas_ticket_type');
                if (ticketTypeField) {
                    ticketTypeField.removeAttribute('required');
                }
            });
        </script>
        <?php
    }
}
add_action('admin_footer', 'remove_required_attribute_ticket_type'); // For admin area
add_action('wp_footer', 'remove_required_attribute_ticket_type'); // For frontend forms





// Function to search Awesome Support tickets by title
function search_awesome_support_tickets_by_title( $title_keyword = '' ) {
    // Set up the custom query arguments
    $args = array(
        'post_type'      => 'ticket',  // Awesome Support's custom post type for tickets
        'posts_per_page' => -1,        // Get all matching tickets
        's'              => $title_keyword,  // Search keyword for ticket title
    );

    // Run the custom query
    $tickets_query = new WP_Query( $args );

    // Check if any tickets are found
    if ( $tickets_query->have_posts() ) {
        echo '<h3>Tickets Matching: "' . esc_html( $title_keyword ) . '"</h3>';
        echo '<ul>';
        while ( $tickets_query->have_posts() ) {
            $tickets_query->the_post();
            // Display each ticket with a link to view it
            ///echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a> (' . get_post_meta( get_the_ID(), '_status', true ) . ')</li>';
            
        echo '<li><a href="https://upyog-helpdesk.niua.org/wp-admin/post.php?post='.get_the_ID().'&action=edit">'.get_the_title().'</li>';
          
        }
        echo '</ul>';
    } else {
        echo 'No tickets found with the title containing "' . esc_html( $title_keyword ) . '".';
    }

    // Reset the post data
    wp_reset_postdata();
}

// Function to display the ticket search form
function display_ticket_search_form() {
    ?>
    <form method="get" action="">
        <label id="searchtktlbl" for="ticket-search" style="font-weight: bold;">Search Tickets by Title: </label>
        <input type="text" id="ticket-search" name="ticket_search" value="<?php echo isset($_GET['ticket_search']) ? esc_attr($_GET['ticket_search']) : ''; ?>" />
        <input class="button button-primary searchbts" type="submit" value="Search" />
    </form>
    <?php

    // If a search query is entered, run the search
    if ( isset($_GET['ticket_search']) && !empty($_GET['ticket_search']) ) {
        $search_term = sanitize_text_field( $_GET['ticket_search'] );
        search_awesome_support_tickets_by_title( $search_term );
    }
}

// Create a shortcode to display the ticket search form
function ticket_search_shortcode() {
    ob_start();
    display_ticket_search_form();
    return ob_get_clean();
}
add_shortcode( 'ticket_search', 'ticket_search_shortcode' );






// Hook into user registration
add_action( 'user_register', 'awesome_support_user_registration_email', 10, 1 );

function awesome_support_user_registration_email( $user_id ) {
    // Get the user information
    $user_info = get_userdata( $user_id );
    $user_email = $user_info->user_email;
    $user_name  = $user_info->user_login;

    // Customize the email subject and message
    $subject = "New Registration to UPYOG- Helpdesk Ticketing Tool System!<br/>";
    
    
        // HTML email content
    $message = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { width: 100%; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; }
            h3 { color: #333; }
            p { color: #555; }
            .footer { font-size: 0.8em; color: #aaa; text-align: center; }
        </style>
    </head>
    <body>
        <div class="container">
            <h3>Dear, ' . esc_html( $user_name ) . '!</h3>
            <p>Greetings from the NUDM- UPYOG Helpdesk!.</p>
            <p>A new registration request has been received. The details are as follows:</p>
            <h3>User Email, ' . esc_html( $user_email ) . '</h3>
            <h3>NUDM- UPYOG Helpdesk: <a href="https://upyog-helpdesk.niua.org/" target="_blank">Click here</a></h3>
            <p>Your registration is in process and waiting for approval:</p>
            <p>Best regards,<br>NUDM-UPYOG Help Desk</p>
      
        </div>
    </body>
    </html>';
    
  
    // Set the email headers (optional, but recommended)
     $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Support Team <support-upyog@niua.org>'  // Replace with your sender email
    ); // Replace with your sender email

    // Send the email to the new user
    wp_mail( $user_email, $subject, $message, $headers );
}


function awesome_support_register_password_validation_script() {
    wp_enqueue_script('jquery');
    
    // Add inline JavaScript for frontend password validation
    wp_add_inline_script('jquery', '
        jQuery(document).ready(function($) {
            // Target the specific form by ID
            $("#wpas_form_registration").on("submit", function(e) {
                var passwordField = $(this).find("input[name=\'wpas_password\']"); // Adjust if password field has a different name
                var password = passwordField.val();

                // Check if password meets the required length
                if (password.length < 6 || password.length > 15) {
                    e.preventDefault();  // Stop the form from being submitted
                    alert("Password must be between 6 and 15 characters.");
                    passwordField.focus();  // Set focus back on the password field
                    passwordField.css("border", "2px solid red");  // Highlight the field with a red border
                }
            });
        });
    ');
}
add_action('wp_enqueue_scripts', 'awesome_support_register_password_validation_script');




function save_custom_dropdown_fields($user_id) {
    if (isset($_POST['wpas_dropdown'])) {
        update_user_meta($user_id, 'wpas_dropdown', sanitize_text_field($_POST['wpas_dropdown']));
    }

    if (isset($_POST['states_dropdown'])) {
        update_user_meta($user_id, 'wpas_states_dropdown', sanitize_text_field($_POST['states_dropdown']));
    }

    if (isset($_POST['empanelled_dropdown'])) {
        update_user_meta($user_id, 'wpas_empanelled_dropdown', sanitize_text_field($_POST['empanelled_dropdown']));
    }
    
    if (isset($_POST['niua_team_dropdown'])) {
        update_user_meta($user_id, 'wpas_niua_team_dropdown', sanitize_text_field($_POST['niua_team_dropdown']));
    }
}
add_action('user_register', 'save_custom_dropdown_fields');
add_action('profile_update', 'save_custom_dropdown_fields');



function show_custom_user_profile_fields($user) {
    if (is_super_admin()) {
    ?>
    <h3 id="emplaneds"><?php _e('User Additional Information', 'awesome-support'); ?></h3>

    <table id="emplaned" class="form-table">
        <tr>
            <th><label for="wpas_dropdown"><?php _e('States/Empanelled/Team', 'awesome-support'); ?></label></th>
            <td>
                <?php $dropdown_value = get_user_meta($user->ID, 'wpas_dropdown', true); ?>
                <input type="text" name="wpas_dropdown" id="wpas_dropdown" value="<?php echo esc_attr($dropdown_value); ?>" class="regular-text"/>
            </td>
        </tr>

        <tr>
            <th><label for="wpas_states_dropdown"><?php _e('States', 'awesome-support'); ?></label></th>
            <td>
                <?php $states_dropdown_value = get_user_meta($user->ID, 'wpas_states_dropdown', true); ?>
                <input type="text" name="states_dropdown" id="wpas_states_dropdown" value="<?php echo esc_attr($states_dropdown_value); ?>" class="regular-text"/>
            </td>
        </tr>

        <tr>
            <th><label for="wpas_empanelled_dropdown"><?php _e('Empanelled Agency', 'awesome-support'); ?></label></th>
            <td>
                <?php $empanelled_dropdown_value = get_user_meta($user->ID, 'wpas_empanelled_dropdown', true); ?>
                <input type="text" name="empanelled_dropdown" id="wpas_empanelled_dropdown" value="<?php echo esc_attr($empanelled_dropdown_value); ?>" class="regular-text"/>
            </td>
        </tr>

        <tr>
            <th><label for="wpas_niua_team_dropdown"><?php _e('Team', 'awesome-support'); ?></label></th>
            <td>
                <?php $niua_team_dropdown_value = get_user_meta($user->ID, 'wpas_niua_team_dropdown', true); ?>
                <input type="text" name="niua_team_dropdown" id="wpas_niua_team_dropdown" value="<?php echo esc_attr($niua_team_dropdown_value); ?>" class="regular-text"/>
            </td>
        </tr>
    </table>
    <?php
    }
}
add_action('show_user_profile', 'show_custom_user_profile_fields');
add_action('edit_user_profile', 'show_custom_user_profile_fields');


function add_custom_user_columns($columns) {
    $columns['wpas_dropdown'] = __('State/Empanelled/Team', 'awesome-support');
    $columns['wpas_states_dropdown'] = __('State', 'awesome-support');
    $columns['wpas_empanelled_dropdown'] = __('Empanelled Agency', 'awesome-support');
    $columns['wpas_niua_team_dropdown'] = __('Team', 'awesome-support');
    return $columns;
}
add_filter('manage_users_columns', 'add_custom_user_columns');



function show_custom_user_column_data($value, $column_name, $user_id) {
    if ($column_name == 'wpas_dropdown') {
        return get_user_meta($user_id, 'wpas_dropdown', true);
    }
    if ($column_name == 'wpas_states_dropdown') {
        return get_user_meta($user_id, 'wpas_states_dropdown', true);
    }
    if ($column_name == 'wpas_empanelled_dropdown') {
        return get_user_meta($user_id, 'wpas_empanelled_dropdown', true);
    }
    if ($column_name == 'wpas_niua_team_dropdown') {
        return get_user_meta($user_id, 'wpas_niua_team_dropdown', true);
    }
    return $value;
}
add_action('manage_users_custom_column', 'show_custom_user_column_data', 10, 3);




function save_custom_profile_fields($user_id) {
    if (isset($_POST['wpas_dropdown'])) {
        update_user_meta($user_id, 'wpas_dropdown', sanitize_text_field($_POST['wpas_dropdown']));
    }

    if (isset($_POST['states_dropdown'])) {
        update_user_meta($user_id, 'wpas_states_dropdown', sanitize_text_field($_POST['states_dropdown']));
    }

    if (isset($_POST['empanelled_dropdown'])) {
        update_user_meta($user_id, 'wpas_empanelled_dropdown', sanitize_text_field($_POST['empanelled_dropdown']));
    }
    
    if (isset($_POST['niua_team_dropdown'])) {
        update_user_meta($user_id, 'wpas_niua_team_dropdown', sanitize_text_field($_POST['niua_team_dropdown']));
    }
}
add_action('personal_options_update', 'save_custom_profile_fields');
add_action('edit_user_profile_update', 'save_custom_profile_fields');













// Add Export button to user listing page
add_action('restrict_manage_users', 'add_export_button');

function add_export_button() {
    ?>
    <input type="submit" name="export_users" id="export_users" class="button button-primary" value="Export Users" style="margin-left:10px;" />
    <?php
}




// Handle Export Users action
add_action('admin_init', 'export_users_to_csv');

function export_users_to_csv() {
    if (isset($_GET['export_users'])) {
        // Set the headers to download the file
        header('Content-Type: text/csv');
         $current_date =  date('d-m-Y');
         header('Content-Disposition: attachment; filename="NUDM-UPYOG-Helpdesk-UserList-' . $current_date . '.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Open output stream
        $output = fopen('php://output', 'w');

        // Set the CSV headers
        fputcsv($output, array('User ID','Username', 'Name', 'Email', 'Role', 'State/Empanelled', 'State', 'Empanelled','Team'));

        // Fetch users from the database
        $args = array(
            'role__in' => array('Administrator', 'wpas_user', 'wpas_agent','support_agent','none'), // Modify as per roles to export
        );
        $users = get_users($args);
        
        //echo "<pre>";
        //print_r($users);
        //echo "</pre>";

        foreach ($users as $user) {
            $username = $user->user_login;
            $name = $user->display_name;
            $email = $user->user_email;
            $role = implode(', ', $user->roles);

            // Fetch custom meta fields for States and Empanelled
            $dropdown_value = get_user_meta($user->ID, 'wpas_dropdown', true); // Custom dropdown selection
            $states = get_user_meta($user->ID, 'states_dropdown', true);
            $empanelled = get_user_meta($user->ID, 'empanelled_dropdown', true);
            $wpas_states_dropdown = get_user_meta($user->ID, 'wpas_states_dropdown', true);
            $wpas_empanelled_dropdown = get_user_meta($user->ID, 'wpas_empanelled_dropdown', true);
            $wpas_niua_team_dropdown = get_user_meta($user->ID, 'wpas_niua_team_dropdown', true);
            // Prepare row based on dropdown selection
            if ($dropdown_value == 'States') {
                $state = $wpas_states_dropdown;
                //$states = $wpas_states_dropdown;
            } elseif ($dropdown_value == 'Empanelled') {
                $empanelled = $wpas_empanelled_dropdown;
            } elseif ($dropdown_value == 'Team') {
                $Team = $wpas_niua_team_dropdown;
            } else {
                $state = '-';
                $empanelled = '-';
                $Team = '-';
            }
            
            if($role =='wpas_user')
            {
            	$role ='support_user';
            }elseif($role =='None')
            {
            	$role ='None';
            }elseif($role =='wpas_agent')
            {
            	$role ='support_agent';
            }elseif($role =='support_agent')
            {
            	$role ='support_agent';
            }elseif($role =='administrator')
            {
            	$role ='Administrator';
            }elseif($role =='super_viewer')
            {
            	$role ='super_viewer';
            }else { echo "no user found";}

            // Write the row data to CSV
            fputcsv($output, array($user->ID,$username, $name, $email, $role, $dropdown_value, $state, $empanelled,$Team));
        }

        // Close output stream
        fclose($output);
        exit;
    }
}




function add_closed_tickets_count() {
    global $wpdb;

    // Count the closed tickets
    $closed_count = $wpdb->get_var("
        SELECT COUNT(*) 
        FROM `wp_posts` 
        WHERE post_type = 'ticket' AND post_status = 'closed'
    ");

    // Use the closed count to construct the HTML
    echo '<li class="closed">
            <a href="edit.php?post_type=ticket&amp;post_status=closed">Closed <span class="count">(' . intval($closed_count) . ')</span></a> |
          </li>';
}

// Hook into the 'admin_footer' action to ensure the submenu is available
add_action('admin_footer', function() {
    if (isset($_GET['post_type']) && $_GET['post_type'] == 'ticket') {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var subsubsub = document.querySelector(".subsubsub");
                var li = document.createElement("li");
                li.className = "closed";
                li.innerHTML = \'| <a href="edit.php?post_type=ticket&amp;post_status=closed">Closed <span class="count">(' . intval(get_closed_ticket_count()) . ')</span></a> |\';
                subsubsub.appendChild(li);
            });
        </script>';
    }
});



function get_closed_ticket_count() {
global $wpdb;
return $wpdb->get_var("
SELECT COUNT(*) 
FROM `wp_posts` 
WHERE post_type = 'ticket' 
AND ID IN (
    SELECT post_id 
    FROM `wp_postmeta` 
    WHERE meta_key = '_wpas_status' 
    AND meta_value = 'closed'
) 
AND (
    post_date BETWEEN '2024-09-20' AND NOW() 
    OR post_modified BETWEEN '2024-09-20' AND NOW()
);
");
}





function add_total_ticket_count_to_admin_menu() {
    global $typenow, $wpdb;

    // Check if we're on the correct custom post type
    if ($typenow == 'ticket') {
        // Calculate the count of tickets that match the date range criteria
        $total_count = $wpdb->get_var("
            SELECT COUNT(*)
            FROM `{$wpdb->posts}`
            WHERE post_type = 'ticket'
            AND (
                post_date BETWEEN '2024-09-20' AND NOW()
                OR post_modified BETWEEN '2024-09-20' AND NOW()
            )
        ");

        // Output JavaScript to dynamically update the 'All' menu count
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Find the 'All' menu item link and update its text with the total count
                var allMenuItem = document.querySelector('.subsubsub .all a');
                if (allMenuItem) {
                    allMenuItem.innerHTML = 'All <span class=\"count\">(" . intval($total_count) . ")</span>';
                }
            });
        </script>
        ";
    }
}

// Hook the function to run in the admin footer of the custom post type listing page
add_action('admin_footer', 'add_total_ticket_count_to_admin_menu');




function update_ticket_menu_count_in_admin() {
    global $wpdb;

    // Fetch the ticket count with your desired criteria
    $total_count = $wpdb->get_var("
        SELECT COUNT(*)
        FROM `{$wpdb->posts}`
        WHERE post_type = 'ticket'
        AND (
            post_date BETWEEN '2024-09-20' AND NOW()
            OR post_modified BETWEEN '2024-09-20' AND NOW()
        )
    ");

    // Output JavaScript to update the menu item count
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Locate the element containing the current ticket count
            var menuNameElement = document.querySelector('.wp-menu-name');
            
            if (menuNameElement && menuNameElement.textContent.includes('Tickets')) {
                // Replace the count within the menu item using the retrieved PHP count value
                var awaitingModSpan = menuNameElement.querySelector('.awaiting-mod');
                var pendingCountSpan = menuNameElement.querySelector('.pending-count');

                // Update the count value
                if (awaitingModSpan && pendingCountSpan) {
                    awaitingModSpan.classList.replace('count-6', 'count-{$total_count}');
                    pendingCountSpan.textContent = '{$total_count}';
                }
            }
        });
    </script>
    ";
}

// Hook into the admin footer to ensure the script runs in the WordPress admin area
add_action('admin_footer', 'update_ticket_menu_count_in_admin');



function create_super_viewer_role() {
    // Check if the role already exists to prevent duplicates
    if (!get_role('super_viewer')) {
        // Get the Administrator role to copy its capabilities
        $admin_role = get_role('administrator');
        
        // Create a new role with the name Super_Viewer
        $super_viewer_role = add_role('super_viewer', 'Super Viewer', $admin_role->capabilities);

        if ($super_viewer_role) {
            echo 'Super Viewer role created successfully!';
        } else {
            echo 'Failed to create Super Viewer role!';
        }
    } else {
        //	echo 'Super Viewer role already exists!';
    }
}
add_action('init', 'create_super_viewer_role');




function add_super_viewer_body_class($classes) {
    if (current_user_can('super_viewer')) { ?>
        <style>
        	#wpas-mb-details{display: none;}
        	#wpas-mb-user-profile{display: none;}
        	#wpas-collapse-replies-bottom{display:none;}
        	#wpas_admin_tabs_after_reply_wysiwyg{display:none;}
        	.wpas-reply-actions{display: none;}
        	.post-type-ticket #posts-filter .tablenav.top {height: auto;display: block;}
            table#emplaned{display: none;}
            #emplaneds{display: none;}
            .acp-ba-row{display: none;} 
			#wpas_admin_tabs_ticket_main_custom_fields .wpas-custom-fields h2 {font-weight: 700;display: none;}
			#poststuff #post-body.columns-2 {margin-right: 0;}
			#wpas_user_profile_segment{display: none;}
			#your-profile .form-table .user-visual-editor-wrap,
#your-profile .form-table .user-syntax-highlighting-wrap,
#your-profile .form-table .user-comment-shortcuts-wrap,
#your-profile .form-table .show-admin-bar {display: none !important;}
.user-rich-editing-wrap{display: none;}
li[data-tab-order="2"].wpas_tab_name {display: none !important;}
.form-table .description a {display: none;}
#application-passwords-section {display: none;}
.user-url-wrap {display: none;}
.start_date{display: none;}
.end_date{display:none;}
#filter_action{display: none;}
.button.button-primary.exporttkt{display: none;}
#searchtktlbl{display: none;}
#ticket-search{display: none;}
.button.button-primary.searchbts{display: none;}
        </style>
<?php    
}}
add_filter('admin_body_class', 'add_super_viewer_body_class');
