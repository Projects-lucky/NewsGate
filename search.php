<?php
/**
 * The template for displaying search results.
 */

include_once get_template_directory() . '/partials/header.php';

?>

<section class="fetch-cat-post-sec">
    <div class="fetch-post-container-first">
    <h2 class="fetch-cat-titile-cnt">
        <a class="fc-search-title" href="">
            <?php
            printf(esc_html__('Search Results for: %s', 'your-theme'), '<span>' . get_search_query() . '</span>');
            ?>
        </a>
    </h2>

    <div class="fetch-cat-post-cnt">

                <?php
                    // Get the current page number
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    // Define the custom query
                    $custom_query = new WP_Query(array(
                        's'              => get_search_query(), // Search query
                        'post_type'      => 'post', // Post type to search
                        'posts_per_page' => 10, // Number of posts per page
                        'paged'          => $paged, // Current page number
                    ));

                    if ($custom_query->have_posts()) :
                    while ($custom_query->have_posts()) : $custom_query->the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" class="fcp-article-cnt">
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
            <p>No posts found for this search.</p>
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
