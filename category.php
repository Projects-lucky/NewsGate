<?php include_once get_template_directory() . '/partials/header.php'; ?>

<section class="fetch-cat-post-sec">
    <div class="fetch-post-container-first">
    <h2 class="fetch-cat-titile-cnt">
        <a class="fc-title" href="<?php echo get_category_link(get_queried_object_id()); ?>">
            <?php single_cat_title(); ?>
        </a>
    </h2>

    <div class="fetch-cat-post-cnt">
        <?php
        // Current category ka ID lo
        $category_id = get_queried_object_id();

        // Paged value get karo taaki pagination work kare
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Custom query jo sirf current category ke posts fetch kare
        $args = array(
            'cat'            => $category_id, // Category-specific posts
            'posts_per_page' => 10, // 10 posts per page
            'paged'          => $paged, // Pagination support
        );
        $custom_query = new WP_Query($args);
        ?>

        <?php if ($custom_query->have_posts()) : ?>
            <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                <article class="fcp-article-cnt">
                    <figure class="fcp-fig-cnt">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="https://via.placeholder.com/300" alt="Default Image">
                            <?php endif; ?>
                        </a>
                    </figure>

                    <div class="fcp-details-cnt">
                        <h3 class="fcp-details-title-cnt">
                            <a class="fcp-details-title" href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <div class="fcp-meta-data-cnt">
                            <span class="fcp-cat">
                                <?php
                                $category = get_the_category();
                                if (!empty($category)) {
                                    echo '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '">' . esc_html($category[0]->name) . '</a>';
                                }
                                ?>
                            </span>
                            <span class="fcp-date"><?php echo get_the_date('jM y'); ?></span>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>

            <!-- Proper Pagination -->
            <div class="ftch-pagination">
                <?php
                echo paginate_links(array(
                    'total'     => $custom_query->max_num_pages,
                    'current'   => max(1, get_query_var('paged')),
                    'mid_size'  => 2,
                    'prev_text' => '&laquo; Prev',
                    'next_text' => 'Next &raquo;',
                ));
                ?>
            </div>

            <?php wp_reset_postdata(); // Query reset karna zaroori hai ?>
        <?php else : ?>
            <p>No posts found in this category.</p>
        <?php endif; ?>
    </div>
</div>

    
    <aside class="fetch-post-container-second">
         <?php if (is_active_sidebar('custom-sidebar')) : ?>
        <?php dynamic_sidebar('custom-sidebar'); ?>
    <?php endif; ?>
    </aside>
</section>

<?php include_once get_template_directory() . '/partials/footer.php'; ?>
