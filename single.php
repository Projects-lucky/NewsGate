<?php
// Include the header.php file from the partials folder
get_template_part('./partials/header');
?>








<section class="single-post-main-cnt">

    <div class="single-post-and-comment-item">
        <div class="single-post-cnt">
             <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Post Title -->
        <h1 class="post-title"><?php the_title(); ?></h1>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <!-- Post Content -->
        <div class="post-content">
            <?php the_content(); ?>
        </div>

    <?php endwhile; endif; ?>
        </div>
        <div class="single-post-comment-cnt">
            <?php
            // Display comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>
    </div>





    <aside class="single-post-aside-cnt">
          <?php if (is_active_sidebar('custom-sidebar')) : ?>
        <?php dynamic_sidebar('custom-sidebar'); ?>
    <?php endif; ?>
    </aside>

</section>


         









<?php
// Include the header.php file from the partials folder
get_template_part('./partials/footer');
?>
