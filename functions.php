<?php 
require_once get_template_directory() . '/inc/class-custom-nav-walker.php';
require_once get_template_directory() . '/inc/custom-date.php';
require_once get_template_directory() . '/inc/featured-meta-box.php';
require_once get_template_directory() . '/inc/dont-miss-meta-box.php';
// require_once get_template_directory() . '/inc/side-nav-ajax.php';
require_once get_template_directory() . '/inc/AJAX.php';


// enques the necessary CSS and JS files for the theme
function enqueue_files_for_templates() {
    if (is_page_template('index.php')) {
        wp_enqueue_style( 'template1-style', get_template_directory_uri() . '/assets/css/main.css', array(),'1.0.0');
        wp_enqueue_script( 'template1-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
        wp_enqueue_script( 'caraousel-script', get_template_directory_uri() . '/assets/js/caraousel.js', array(), '1.0.0', true);
        wp_enqueue_script( 'fetch-script', get_template_directory_uri() . '/assets/js/fetch-post.js', array(), '1.0.0', true);
        wp_enqueue_script( 'fetch-sidenav-script', get_template_directory_uri() . '/assets/js/fetch-post-sidenav.js', array(), '1.0.0', true);

    }
}
// Hook into the 'wp_enqueue_scripts' action to enqueue the scripts
add_action('wp_enqueue_scripts', 'enqueue_files_for_templates');



// function call after setup theme
function mytheme_setup() {
    // Register a navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mytheme'), // Primary menu
        'footer'  => __('Footer Menu', 'mytheme'),  // Footer menu
        'all'   => __('All Menu', 'mytheme'),   // All menu
    ));
}
add_action('after_setup_theme', 'mytheme_setup');

// custome logo 
function theme_custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'theme_custom_logo_setup');




// add the custom widget sidebar styles
function custom_sidebar() {
    register_sidebar(array(
        'name'          => __('Custom Sidebar', 'textdomain'),
        'id'            => 'custom-sidebar',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'custom_sidebar');



// Add support for post  thumbnails 
add_theme_support('post-thumbnails');


// custom ajax admin

function my_ajax_script() {
    wp_enqueue_script('custom-login', get_template_directory_uri() . '/js/custom-login.js', array('jquery'), null, true);

    wp_localize_script('custom-login', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'my_ajax_script');



// custome registration and login form handling
function custom_register_user() {
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);

    if (email_exists($email)) {
        wp_send_json(['success' => false, 'message' => 'Email already registered.']);
    } else {
        $user_id = wp_create_user($email, $password, $email);
        wp_update_user(['ID' => $user_id, 'first_name' => $first_name, 'last_name' => $last_name]);

        wp_send_json(['success' => true, 'message' => 'Registration successful!']);
    }
}
add_action('wp_ajax_custom_register_user', 'custom_register_user');
add_action('wp_ajax_nopriv_custom_register_user', 'custom_register_user');

function custom_login_user() {
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);

    $user = get_user_by('email', $email);
    
    if ($user && wp_check_password($password, $user->user_pass, $user->ID)) {
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        wp_send_json(['success' => true, 'redirect' => home_url()]);
    } else {
        wp_send_json(['success' => false, 'message' => 'Invalid login credentials.']);
    }
}
add_action('wp_ajax_custom_login_user', 'custom_login_user');
add_action('wp_ajax_nopriv_custom_login_user', 'custom_login_user');



// For comment restrictions
function restrict_commenting_to_logged_in_users($defaults) {
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . __('You must be logged in to post a comment.', 'your-theme') . '</label></p>';
        $defaults['title_reply'] = '';
        $defaults['logged_in_as'] = '';
        $defaults['comment_notes_before'] = '';
        $defaults['comment_notes_after'] = '';
        $defaults['label_submit'] = '';
        $defaults['submit_button'] = '';
    }
    return $defaults;
}
add_filter('comment_form_defaults', 'restrict_commenting_to_logged_in_users');