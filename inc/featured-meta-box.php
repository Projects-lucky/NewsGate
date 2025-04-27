<?php

// Add Featured Checkbox in Admin
function add_featured_meta_box() {
    add_meta_box('featured_post', 'Featured Post', 'featured_meta_box_callback', 'post', 'side');
}
add_action('add_meta_boxes', 'add_featured_meta_box');

function featured_meta_box_callback($post) {
    $value = get_post_meta($post->ID, 'featured', true);
    ?>
    <label for="featured_checkbox">
        <input type="checkbox" id="featured_checkbox" name="featured" value="1" <?php checked($value, '1'); ?>>
        Mark as Featured
    </label>
    <?php
}

// Save Featured Meta Field
function save_featured_meta($post_id) {
    if (isset($_POST['featured'])) {
        update_post_meta($post_id, 'featured', '1');
    } else {
        delete_post_meta($post_id, 'featured');
    }
}
add_action('save_post', 'save_featured_meta');
