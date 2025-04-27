<?php

function add_dont_miss_meta_box() {
    add_meta_box(
        'dont_miss_post', // Meta Box ID
        'Don\'t Miss', // Title
        'dont_miss_meta_box_callback', // Callback function
        'post', // Post type
        'side' // Position
    );
}
add_action('add_meta_boxes', 'add_dont_miss_meta_box');

function dont_miss_meta_box_callback($post) {
    $value = get_post_meta($post->ID, '_dont_miss', true);
    ?>
    <label for="dont_miss_checkbox">
        <input type="checkbox" name="dont_miss_checkbox" id="dont_miss_checkbox" value="1" <?php checked($value, '1'); ?> />
        Mark this post as "Don't Miss"
    </label>
    <?php
}

// Save checkbox value
function save_dont_miss_meta($post_id) {
    if (isset($_POST['dont_miss_checkbox'])) {
        update_post_meta($post_id, '_dont_miss', '1');
    } else {
        delete_post_meta($post_id, '_dont_miss');
    }
}
add_action('save_post', 'save_dont_miss_meta');
