<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css">
   <script type="text/javascript">
    var my_ajax_object = {
        ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>'
    };
   const siteUrl = '<?php echo esc_url(home_url('/')); ?>';
</script>

    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<header id="my-Header" class="header-container">
    <section class="top-nav-cnt">
        <nav class="tnc-pages-navs-cnt">
            <?php
                $menu_name = 'Primary';
                $menu_items = wp_get_nav_menu_items($menu_name);

                if ($menu_items) {
                    echo  '<ul class="tnc-pages-ul">';
                        foreach ($menu_items as $item) {
                    echo '<li class="tnc-pages-li"><a href="' . $item->url . '">' . $item->title . '</a></li>';
                    }
                    echo '</ul>';
                }
            ?>
        </nav>

        <div class="tnc-user-profile-cnt">
            <svg id="tnc-profile-svg" fill="currentColor" width="20px" height="20px" viewBox="0 0 512 512" id="_x30_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,90  c37.02,0,67.031,35.468,67.031,79.219S293.02,248.438,256,248.438s-67.031-35.468-67.031-79.219S218.98,90,256,90z M369.46,402  H142.54c-11.378,0-20.602-9.224-20.602-20.602C121.938,328.159,181.959,285,256,285s134.062,43.159,134.062,96.398  C390.062,392.776,380.839,402,369.46,402z"/></svg>
            <div class="tnc-profile-info">
                <?php
                    // Check if the user is logged in
                    if (is_user_logged_in()) {
                        // Get the current user object
                        $current_user = wp_get_current_user();

                        // Display the username
                        echo '<p class="auth-msg tnc-user-name">' . esc_html($current_user->user_login) . '!</p>';

                        // Display additional user information (optional)
                        echo '<p class="auth-msg tnc-user-email">Email: ' . esc_html($current_user->user_email) . '</p>';
                    } else {
                        // User is not logged in
                        echo '<p class="auth-msg tnc-not-login">You are not logged in.</p>';
                    }
                    ?>

                    <?php if (is_user_logged_in()): ?>
                        <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="tnc-logout">Logout</a>
                    <?php else: ?>
                        <a href="<?php echo site_url('/login'); ?>" class="tnc-log-in-out">Login / Register</a>
                    <?php endif; ?>
            </div>
        </div>
    </section>
    <hr class="tnc-hr">


    <section class="navigation-container">
        <!-- logo -->
        <div class="logo-container">
            <span aria-colspan="logo-img-cnt" class="logo-img-cnt">
                    <?php 
                        if (has_custom_logo()) {
                            the_custom_logo(); // Dynamically fetch WordPress logo
                        } else {
                            echo '<img class="logo-image" src="' . esc_url(get_template_directory_uri() . '/T.png') . '" alt="Site Logo">';
                        }
                    ?>
                </span>
            <span aria-colspan="logo-text-cnt" class="logo-text-cnt"><p class="logo-text"><?php bloginfo('name'); ?></p></span>
        </div>

        <nav class="pages-navs-cnt">
            <?php
                $menu_name = 'Primary';
                $menu_items = wp_get_nav_menu_items($menu_name);

                if ($menu_items) {
                    echo  '<ul class="pages-ul">';
                        foreach ($menu_items as $item) {
                    echo '<li class="pages-li"><a href="' . $item->url . '">' . $item->title . '</a></li>';
                    }
                    echo '</ul>';
                }
            ?>
        </nav>

        <div class="search-dark-menu-cnt">
            <button class="search-cnt" id="search-icn">
                <svg fill="currentColor" width="30px" height="30px" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><path d="M23 36c-7.2 0-13-5.8-13-13s5.8-13 13-13 13 5.8 13 13-5.8 13-13 13zm0-24c-6.1 0-11 4.9-11 11s4.9 11 11 11 11-4.9 11-11-4.9-11-11-11z"/><path d="M32.682 31.267l8.98 8.98-1.414 1.414-8.98-8.98z"/></svg>
            </button>
            <button id="dark-mode-toggle" class="dark-mode-cnt">
                <svg width="30px" height="30px" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg" aria-labelledby="sunIconTitle" stroke="currentColor" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="currentColor" color="currentColor"> <title id="sunIconTitle">Sun</title> <circle cx="12" cy="12" r="4"/> <path d="M12 5L12 3M12 21L12 19M5 12L2 12 5 12zM22 12L19 12 22 12zM16.9497475 7.05025253L19.0710678 4.92893219 16.9497475 7.05025253zM4.92893219 19.0710678L7.05025253 16.9497475 4.92893219 19.0710678zM16.9497475 16.9497475L19.0710678 19.0710678 16.9497475 16.9497475zM4.92893219 4.92893219L7.05025253 7.05025253 4.92893219 4.92893219z"/> </svg>
            </button>
            <button class="hambrgr-menu-cnt">
                <svg id="hmbgr-svg" fill="currentColor" width="40px" height="40px" viewBox="0 -0.08 20 20" data-name="Capa 1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"><path d="M5.63,10.3h4.7a.38.38,0,1,0,0-.75H5.63a.38.38,0,0,0,0,.75Z"/><path d="M14.37,9.55H13a.38.38,0,0,0,0,.75h1.37a.38.38,0,0,0,0-.75Z"/><path d="M9.67,7.64h4.7a.38.38,0,0,0,.37-.38.37.37,0,0,0-.37-.37H9.67a.37.37,0,0,0-.38.37A.38.38,0,0,0,9.67,7.64Z"/><path d="M5.63,7.64H7a.38.38,0,0,0,.37-.38A.37.37,0,0,0,7,6.89H5.63a.37.37,0,0,0-.37.37A.38.38,0,0,0,5.63,7.64Z"/><path d="M14.37,12.21H9.67a.37.37,0,0,0-.38.37.38.38,0,0,0,.38.38h4.7a.38.38,0,0,0,.37-.38A.37.37,0,0,0,14.37,12.21Z"/><path d="M7,12.21H5.63a.37.37,0,0,0-.37.37.38.38,0,0,0,.37.38H7a.38.38,0,0,0,.37-.38A.37.37,0,0,0,7,12.21Z"/></svg>
                <svg id="res-dev-hmbgr-svg" fill="currentColor" width="40px" height="40px" viewBox="0 -0.08 20 20" data-name="Capa 1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"><path d="M5.63,10.3h4.7a.38.38,0,1,0,0-.75H5.63a.38.38,0,0,0,0,.75Z"/><path d="M14.37,9.55H13a.38.38,0,0,0,0,.75h1.37a.38.38,0,0,0,0-.75Z"/><path d="M9.67,7.64h4.7a.38.38,0,0,0,.37-.38.37.37,0,0,0-.37-.37H9.67a.37.37,0,0,0-.38.37A.38.38,0,0,0,9.67,7.64Z"/><path d="M5.63,7.64H7a.38.38,0,0,0,.37-.38A.37.37,0,0,0,7,6.89H5.63a.37.37,0,0,0-.37.37A.38.38,0,0,0,5.63,7.64Z"/><path d="M14.37,12.21H9.67a.37.37,0,0,0-.38.37.38.38,0,0,0,.38.38h4.7a.38.38,0,0,0,.37-.38A.37.37,0,0,0,14.37,12.21Z"/><path d="M7,12.21H5.63a.37.37,0,0,0-.37.37.38.38,0,0,0,.37.38H7a.38.38,0,0,0,.37-.38A.37.37,0,0,0,7,12.21Z"/></svg>
            </button>
        </div>
        
        <!-- aside-navs -->
        <aside  class="side-nav-cnt">
            <nav class="side-navs">
                <ul class="side-navs-main-categories">
                    <!-- WordPress will dynamically generate this list -->
                    <?php
                    $categories = get_categories(array('hide_empty' => false, 'parent' => 0));
                    foreach ($categories as $category) {
                        // echo '<li class="side-navs-main-categories-lst" data-category-id="' . $category->term_id . '">' . $category->name . '</li>';
                         echo '<li class="side-navs-main-categories-lst  category-item"  data-category-id="' . $category->term_id . '">';
                            echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                    }
                    ?>
                </ul>     
            </nav>

          <div class="fetch-posts-container" id="posts-container">
            <!-- Subcategories will be displayed here -->
            <div id="subcategories-container"></div><hr>

            <!-- Posts will be displayed here -->
            <div id="posts-list-container"></div>

            <!-- Pagination buttons will be displayed here -->
            <div id="pagination-container"></div>
          </div>
        </aside>

        <!-- mobile menu -->
        <section class="smartphone-sidebar">
            <div class="smartphone-sidebar-cnt">
                <nav class="ss-pages-nav-cnt">
                        <?php
                            $menu_name = 'Primary';
                            $menu_items = wp_get_nav_menu_items($menu_name);
    
                            if ($menu_items) {
                                echo  '<ul class="ss-pages-ul">';
                                    foreach ($menu_items as $item) {
                                echo '<li class="ss-pages-li"><a href="' . $item->url . '">' . $item->title . '</a></li>';
                                }
                                echo '</ul>';
                            }
                        ?>
                </nav><hr>
                <nav class="ss-cat-nav-cnt">
                   <ul class="ss-cat-nav-ul">
                       <?php
                        $categories = get_categories(array(
                            'taxonomy'   => 'category', // Fetch categories
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => false, // Show categories even if they have no posts
                        ));

                        foreach ($categories as $category) {
                            echo '<li class="ss-cat-nav-li"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                        }


                        ?>
                  </ul>
                </nav><hr>
                <div class="ss-profile-cnt">
                    <div class="user-info">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M12 22.01C17.5228 22.01 22 17.5329 22 12.01C22 6.48716 17.5228 2.01001 12 2.01001C6.47715 2.01001 2 6.48716 2 12.01C2 17.5329 6.47715 22.01 12 22.01Z" fill="#292D32"/>
                        <path d="M12 6.93994C9.93 6.93994 8.25 8.61994 8.25 10.6899C8.25 12.7199 9.84 14.3699 11.95 14.4299C11.98 14.4299 12.02 14.4299 12.04 14.4299C12.06 14.4299 12.09 14.4299 12.11 14.4299C12.12 14.4299 12.13 14.4299 12.13 14.4299C14.15 14.3599 15.74 12.7199 15.75 10.6899C15.75 8.61994 14.07 6.93994 12 6.93994Z" fill="#292D32"/>
                        <path d="M18.7807 19.36C17.0007 21 14.6207 22.01 12.0007 22.01C9.3807 22.01 7.0007 21 5.2207 19.36C5.4607 18.45 6.1107 17.62 7.0607 16.98C9.7907 15.16 14.2307 15.16 16.9407 16.98C17.9007 17.62 18.5407 18.45 18.7807 19.36Z" fill="#292D32"/>
                        </svg>
                        <?php
                            // Check if the user is logged in
                            if (is_user_logged_in()) {
                                // Get the current user object
                                $current_user = wp_get_current_user();

                                // Display the username
                                echo '<h3 class="ss-profile-name">' . esc_html($current_user->user_login) . '!</h3>';

                            } else {
                                // User is not logged in
                                echo '<p class="auth-msg">You are not logged in.</p>';
                            }
                            ?>
                        </h3>
                    </div>
                    <div class="logout-btn">
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="text-red-500">Logout</a>
                        <?php else: ?>
                            <a href="<?php echo site_url('/login'); ?>" class="text-blue-500">Login / Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form"  name="s" id="s">
            <label for="s"></label>
            <input id="s" type="text" name="s" placeholder="Search"  value="<?php echo get_search_query(); ?>">
            <button id="search-btn" type="submit">
              <svg id="search-btn-svg" fill="currentColor" width="30px" height="30px" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><path d="M23 36c-7.2 0-13-5.8-13-13s5.8-13 13-13 13 5.8 13 13-5.8 13-13 13zm0-24c-6.1 0-11 4.9-11 11s4.9 11 11 11 11-4.9 11-11-4.9-11-11-11z"/><path d="M32.682 31.267l8.98 8.98-1.414 1.414-8.98-8.98z"/></svg>
            </button>
        </form>
     </section>
</header>