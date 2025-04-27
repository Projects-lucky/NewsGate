<?php

function custom_date_format($post_date) {
    $current_time = current_time('timestamp'); // Current time in Unix timestamp
    $post_time = strtotime($post_date); // Post publish time in Unix timestamp
    $time_diff = $current_time - $post_time; // Difference in seconds

    // Define time intervals in seconds
    $minute = 60;
    $hour = 60 * $minute;
    $day = 24 * $hour;
    $month = 30 * $day;
    $year = 365 * $day;


    
    if ($time_diff < $minute) {
        return 'Just now';
    } elseif ($time_diff < $hour) {
        $minutes = floor($time_diff / $minute);
        return $minutes . 'M ago';
    } elseif ($time_diff < $day) {
        $hours = floor($time_diff / $hour);
        return $hours . 'H ago';
    } elseif ($time_diff < $month) {
        $days = floor($time_diff / $day);
        return $days . 'D ago';
    } elseif ($time_diff < $year) {
        $months = floor($time_diff / $month);
        return $months . 'M ago';
    } else {
        // For posts older than a year, display the full date in "20FAB" format
        return date('jM Y', $post_time); // Example: 20FAB 2025
    }
}