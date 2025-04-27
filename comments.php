<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                printf(__('One Comment', 'your-theme'));
            } else {
                printf(__('%d Comments', 'your-theme'), $comments_number);
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 42,
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        // Comment pagination
        the_comments_navigation();
        ?>
    <?php endif; ?>

    <?php
    // Display the comment form
    comment_form(array(
        'title_reply' => __('Leave a Comment', 'your-theme'),
        'title_reply_to' => __('Leave a Reply to %s', 'your-theme'),
        'cancel_reply_link' => __('Cancel Reply', 'your-theme'),
        'label_submit' => __('Post Comment', 'your-theme'),
    ));
    ?>
</div><!-- #comments -->