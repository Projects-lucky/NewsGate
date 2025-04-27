<?php
require_once('../../../wp-load.php'); // Load WordPress

$args = array(
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC'
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<ul>';
    while ($query->have_posts()) {
        $query->the_post();
        echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    echo '</ul>';
} else {
    echo 'No posts found.';
}
