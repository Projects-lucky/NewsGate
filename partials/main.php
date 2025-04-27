

<main class="main">
    <section class="First-section">
        <h1 class="feat-title-cnt"><a class="ftc-link" href="">Latest post</a> </h1>
        <div class="post-lyt-cnt">
            <?php
            $args = array(
                'posts_per_page' => 5, // Fetch latest 5 posts
                'post_status' => 'publish'
            );

            $query = new WP_Query($args);
            $count = 0;

            // Define classes for each post dynamically
            $post_classes = ['big-featured', 'quarter-width-one', 'quarter-width-two', 'quarter-width-three', 'quarter-widt-four'];

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $custom_class = isset($post_classes[$count]) ? $post_classes[$count] : 'default-layout';
                    $count++;
                    ?>
                        <div class="feat-post-container <?php echo esc_attr($custom_class); ?>">
                            <figure class="fp-fig-cnt">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" class="fp-image">
                            </figure>
                            <div class="fp-details">
                                <h2 class="fp-title"><a class="fp-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="fp-meta-data">
                                    <p class="fp-cat">
                                        <?php
                                        $category = get_the_category();
                                        if (!empty($category)) {
                                            echo the_category($category[0]->name);
                                        }
                                        ?>
                                    </p>
                                    <p class="fp-date"><?php echo get_the_date('jM y'); ?></p>
                                </div>
                            </div>
                        </div>
                

                <?php endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No posts found.</p>';
                endif;
            ?>
        </div>
    </section>

    <section class="second-section">
        <div class="video-post-cnt">
            <?php
                $category = get_category_by_slug('videos'); // Replace 'featured' with your category slug
                if ($category) :
            ?>
            <h2 class="vp-title-cnt"> 
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"> <?php echo esc_html($category->name); ?></a>
            </h2>
            <?php endif; ?>
            <div class="vp-video-cnt">
                <div class="vp-navigator-cnt">
                    <button class="prev-btn" id="left">&#10094;</button>
                    <button class="next-btn" id="right">&#10095;</button>
                </div>
                <div class="vp-slide-post-container">
                <?php
                        // Define the category name and number of posts to display
                        $category_name = 'videos'; // Replace with your category name
                        $number_of_posts = 3; // Number of posts to display

                        // Create a new WP_Query instance
                        $args = array(
                            'category_name' => $category_name, // Fetch posts from the 'video' category
                            'posts_per_page' => $number_of_posts, // Limit to 3 posts
                        );

                        $query = new WP_Query($args);

                        // Check if there are posts
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                // Get the post thumbnail URL
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                ?>
                                <article id="post-<?php the_ID(); ?>" class="vp-post-container">
                                    <figure class="vp-fig-cnt">
                                        <img src="<?php echo esc_url($thumbnail_url ? $thumbnail_url : 'https://img.freepik.com/free-vector/no-data-concept-illustration_114360-536.jpg?t=st=1740761103~exp=1740764703~hmac=47385edc207c6b63ecf1bbda9b713bcd8a64aa25c020c9c16817f5bffc528915&w=740'); ?>" alt="<?php the_title_attribute(); ?>" class="vp-image">
                                    </figure>
                                    <div class="vp-details">
                                        <h2 class="vp-title"><a class="vp-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="vp-meta-data">
                                            <p class="vp-cat"><?php the_category(', '); ?></p>
                                            <p class="vp-date"><?php echo get_the_date('jM y'); ?></p>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                        else :
                            // If no posts are found
                            echo '<p>No posts found in the ' . esc_html($category_name) . ' category.</p>';
                        endif;

                        // Reset the post data
                        wp_reset_postdata();
                        ?>
                </div>
            </div>
        </div>
        <div class="editors-pick-cnt">
            <div class="edtr-title-cnt"><a href="">featured</a></div>
            <div class="edtr-post-container">
                <?php
                    // Define the number of posts to display
                    $number_of_posts = 3; // Change this as needed

                    // Create a new WP_Query instance
                    $args = array(
                        'meta_key'   => 'featured', // Meta key to check
                        'meta_value' => 1,             // Meta value to check
                        'posts_per_page' => $number_of_posts, // Number of posts to display
                    );

                    $query = new WP_Query($args);

                    // Check if there are posts
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            // Get the post thumbnail URL
                            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                            ?>
                            <article class="edtr-post-container">
                                <figure class="edtr-fig-cnt">
                                    <img src="<?php echo esc_url($thumbnail_url ? $thumbnail_url : 'https://img.freepik.com/premium-vector/welcome-japan-mount-fuji_24877-17774.jpg?w=740'); ?>" alt="<?php the_title_attribute(); ?>" class="fp-image">
                                </figure>
                                <div class="edtr-details">
                                    <h2 class="edtr-title"><a class="edtr-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="edtr-meta-data">
                                        <p class="edtr-cat"><?php the_category(', '); ?></p>
                                        <p class="edtr-date"><?php echo get_the_date(); ?></p>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                    else :
                        // If no posts are found
                        echo '<p>No featured posts found.</p>';
                    endif;

                    // Reset the post data
                    wp_reset_postdata();
                    ?>
            </div>
        </div>
    </section>

    <section class="fourth-section">
        <div class="frth-title-cnt">
            <h2 class="frth-title">
                <a class="frth-title-a" href="<?php echo esc_url(get_permalink(get_page_by_path('editors-picks'))); ?>">don't miss</a>
            </h2>
        </div>
        <div class="frth-post-cnt">
            <?php
            // Define the number of posts to display
            $number_of_posts = 4; // Change this as needed

            // Create a new WP_Query instance
            $args = array(
                'meta_key'   => '_dont_miss', // Meta key to check
                'meta_value' => 1,             // Meta value to check
                'posts_per_page' => $number_of_posts, // Number of posts to display
            );

            $query = new WP_Query($args);

            // Check if there are posts
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    // Get the post thumbnail URL
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    ?>
                    <article class="frth-post-wpr-cnt">
                        <figure class="frth-fig-cnt">
                            <img class="frth-post-img" src="<?php echo esc_url($thumbnail_url ? $thumbnail_url : 'https://img.freepik.com/free-vector/no-data-concept-illustration_114360-536.jpg?t=st=1740761103~exp=1740764703~hmac=47385edc207c6b63ecf1bbda9b713bcd8a64aa25c020c9c16817f5bffc528915&w=740'); ?>" alt="<?php the_title_attribute(); ?>">
                        </figure>
                        <div class="frth-details">
                            <h2 class="fth-post-title"><a class="frth-post-title-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <span class="frth-meta-details">
                                <p class="frth-cat"><?php the_category(', '); ?></p>
                                <p class="frth-date"><?php echo get_the_date('j M y'); ?></p>
                            </span>
                        </div>
                    </article>
                    <?php
                endwhile;
            else :
                // If no posts are found
                echo '<p>No featured posts found.</p>';
            endif;

            // Reset the post data
            wp_reset_postdata();
            ?>
        </div>
    </section>

    <section class="fifth-section">
        <div class="all-post-cnt">
            <h2 class="ap-title-cnt">
                <?php
                    $category = get_category_by_slug('world');
                    if ($category) :
                ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                <?php endif; ?>
            </h2>
            
            <div class="ap-post-cnt">
                <div class="ap-big-post-cnt">
                    <?php
                        $args = [
                            'category_name'  => 'world',
                            'posts_per_page' => 1,
                        ];
                        $query = new WP_Query($args);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                        <article class="ap-post-wpr-cnt">
                            <figure class="ap-figure-cnt">
                                <img class="ap-post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php the_title_attribute(); ?>">
                            </figure>
                            <div class="ap-details-cnt">
                                <h2 class="ap-post-title">
                                    <a class="ap-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <span class="ap-meta-details">
                                    <p class="ap-cat">
                                        <?php 
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                        ?>
                                    </p>
                                    <p class="ap-date"><?php echo get_the_date('j M y'); ?></p>
                                </span>
                            </div>
                        </article>
                    <?php
                            endwhile;
                        else :
                            echo '<p>No posts found in the World category.</p>';
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>

                <div class="ap-small-post-cnt">
                    <?php
                        $query = new WP_Query([
                            'category_name'  => 'world',
                            'posts_per_page' => 5,
                        ]);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                        <article class="ap-sm-art-wpt-cnt">
                            <div class="ap-sm-details-cnt">
                                <h2 class="ap-sm-post-title">
                                    <a class="ap-sm-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <span class="ap-sm-meta-details">
                                    <p class="ap-sm-cat">
                                        <?php 
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                        ?>
                                    </p>
                                    <p class="ap-sm-date"><?php echo get_the_date(); ?></p>
                                </span>
                            </div>
                        </article>
                    <?php
                            endwhile;
                        else :
                            echo '<p>No posts found in the World category.</p>';
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>

        <div class="latest-post-cnt">
            <div class="ltsp-title-cnt">
                <?php
                    $category = get_category_by_slug('sports');
                    if ($category) :
                ?>
                    <h2 class="ltsp-title">
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </h2>
                <?php endif; ?>
            </div>
            
            <div class="ltsp-post-cnt">
                <div class="ltsp-big-post-cnt">
                    <?php
                        $query = new WP_Query([
                            'category_name'  => 'sports',
                            'posts_per_page' => 1,
                        ]);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                        <article class="ltsp-post-wpr-cnt">
                            <figure class="ltsp-figure-cnt">
                                <img class="ltsp-post-img" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title_attribute(); ?>">
                            </figure>
                            <div class="ltsp-details-cnt">
                                <h2 class="ltsp-post-title">
                                    <a class="ltsp-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <span class="ltsp-meta-details">
                                    <p class="ltsp-cat">
                                        <?php 
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                        ?>
                                    </p>
                                    <p class="ltsp-date"><?php echo get_the_date('j M Y'); ?></p>
                                </span>
                            </div>
                        </article>
                    <?php
                            endwhile;
                        else :
                            echo '<p>No posts found in the Sports category.</p>';
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
                
                <div class="ltsp-small-post-cnt">
                    <?php
                        $query = new WP_Query([
                            'category_name'  => 'sports',
                            'posts_per_page' => 5,
                        ]);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                        <article class="ltsp-sm-art-wpt-cnt">
                            <div class="ltsp-sm-details-cnt">
                                <h2 class="ltsp-sm-post-title">
                                    <a class="ltsp-sm-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <span class="ltsp-sm-meta-details">
                                    <p class="ltsp-sm-cat">
                                        <?php 
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                        ?>
                                    </p>
                                    <p class="ltsp-sm-date"><?php echo get_the_date('jM y'); ?></p>
                                </span>
                            </div>
                        </article>
                    <?php
                            endwhile;
                        else :
                            echo '<p>No posts found in the Sports category.</p>';
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="sixth-sec">
        <div class="sxth-first">
            <?php
                $category = get_category_by_slug('lifestyle'); // Replace 'featured' with your category slug
                if ($category) :
            ?>
            <div class="sxth-title-sec">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                    <?php echo esc_html($category->name); ?>
            </a>
            </div>
            <?php endif; ?>

            <div class="sxth-content-sec">
                <div class="sxth-content-sec-1">
                    <?php
                        $args = array(
                            'category_name' => 'lifestyle', // Change as per your category slug
                            'posts_per_page' => 1, 
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                    <article class="scs1-post-container">
                        <figure class="scs1-fig-cnt">
                            <img  src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="scs1-image">
                        </figure>
                        <div class="scs1-detaiscs1">
                            <h2 class="scs1-title"><a class="scs1-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="scs1-meta-data">
                                <p class="scs1-cat"><?php the_category(', '); ?></p>
                                <p class="scs1-date"><?php echo get_the_date('jM y'); ?></p>
                            </div>
                        </div>
                    </article>
                    <?php 
                    endwhile; 
                    wp_reset_postdata();
                endif;
                ?>
                </div>
                <div class="sxth-content-sec-2">
                    <?php
                        $args = array(
                            'category_name' => 'lifestyle', // Change as per your category slug
                            'posts_per_page' => 5, 
                            'offset' => 1, // Change as per your requirement
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                    <article class="scs2-post-container">
                        <figure class="scs2-fig-cnt">
                            <img  src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="scs2-image">
                        </figure>
                        <div class="scs2-detaiscs2">
                            <h2 class="scs2-title"><a class="scs2-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="scs2-meta-data">
                                <p class="scs2-cat"><?php the_category(', '); ?></p>
                                <p class="scs2-date"><?php echo get_the_date('jM y'); ?></p>
                            </div>
                        </div>
                    </article>
                    <?php 
                    endwhile; 
                    wp_reset_postdata();
                endif;
                ?>
                </div>
            </div>
        </div>
        <div class="sxth-second">
            <?php
                $category = get_category_by_slug('tech'); // Replace 'featured' with your category slug
                if ($category) :
                ?>
            <div class="sxthsec-title-sec">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                    <?php echo esc_html($category->name); ?>
            </a>
            </div>
            <?php endif;?>
            <div class="sxthsec-content-sec">
                <div class="sxthsec-content-sec-1">
                    <?php
                        $args = array(
                            'category_name' => 'tech', // Change as per your category slug
                            'posts_per_page' => 1, 
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                    <article class="sscs1-post-container">
                        <figure class="sscs1-fig-cnt">
                            <img  src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="sscs1-image">
                        </figure>
                        <div class="sscs1-detaiscs1">
                            <h2 class="sscs1-title"><a class="scs1-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="sscs1-meta-data">
                                <p class="sscs1-cat"><?php the_category(', '); ?></p>
                                <p class="sscs1-date"><?php echo get_the_date('jM y'); ?></p>
                            </div>
                        </div>
                    </article>
                    <?php 
                    endwhile; 
                    wp_reset_postdata();
                endif;
                ?>
                </div>
                <div class="sxthsec-content-sec-2">
                    <?php
                        $args = array(
                            'category_name' => 'tech', // Change as per your category slug
                            'posts_per_page' => 5, 
                            'offset' => 1, // Change as per your requirement
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>
                    <article class="sscs2-post-container">
                        <figure class="sscs2-fig-cnt">
                            <img  src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="scs2-image">
                        </figure>
                        <div class="sscs2-detaiscs2">
                            <h2 class="sscs2-title"><a class="scs2-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="sscs2-meta-data">
                                <p class="sscs2-cat"><?php the_category(', '); ?></p>
                                <p class="sscs2-date"><?php echo get_the_date('jM y'); ?></p>
                            </div>
                        </div>
                    </article>
                    <?php 
                    endwhile; 
                    wp_reset_postdata();
                endif;
                ?>
                </div>
            </div>
        </div>
    </section>
</main>