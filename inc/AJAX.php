<?php

function load_recent_posts() {
    $cat_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    $query = new WP_Query([
        'cat' => $cat_id,
        'posts_per_page' => 5
    ]);

    if ($query->have_posts()) {
        echo '<ul class="bg-white p-4 shadow-lg">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li class="p-2 border-b hover:bg-gray-200"><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p class="p-2 text-gray-500">No posts found.</p>';
    }

    wp_die();
}

add_action('wp_ajax_load_recent_posts', 'load_recent_posts');
add_action('wp_ajax_nopriv_load_recent_posts', 'load_recent_posts');
