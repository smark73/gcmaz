<?php

// Content Area
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'page_loop' );



function page_loop() {

    global $post;
    global $paged;

    ?>

    <article class="entry">

        <?php if( have_posts() ) : the_post(); ?>

        <div class="entry-content" itemprop="text">

            <?php if( has_post_thumbnail() ) : ?>

                <div class="featured-image">
                    <?php
                        //get image details
                        $img_id = get_post_thumbnail_id( $post->ID );
                        $img_details = get_posts( array( 'p' => $img_id, 'post_type' => 'attachment' ) );
                        $img_src = wp_get_attachment_image_src( $img_id, 'full' );
                        $img_width = $img_src[1];
                    ?>
                    <a href="<?php echo $img_src[0]; ?>" title="<?php the_title_attribute(); ?>" target="_blank">
                        <?php the_post_thumbnail('large'); ?>
                    </a>
                    <?php
                        //show caption if exists
                        if ( !empty( $img_details[0]->post_excerpt ) ) {
                            echo '<p class="featured-image-caption">';
                            echo $img_details[0]->post_excerpt;
                            echo '</p>';
                        }
                    ?>
                </div>

            <?php endif; ?>

            <header class="entry-header">
                <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
            </header>
            
            <?php if (get_post_custom_values('event_start_date')) : ?>
                <p class="event-date">
                    <?php
                        // echo date
                        $startdate = get_post_custom_values('event_start_date');
                        echo $startdate[0];
                        // if has end date, add it
                        $enddate = get_post_custom_values('event_end_date');
                        if($enddate[0]){
                            echo " - " . $enddate[0];
                        }
                     ?>
                </p>
            <?php endif; ?>

            <?php the_content(); ?>


            <?php

                // Add Author to KAFF News
                if( check_if_in_news() === true ) {

                    // AUTHOR
                    // Just for News
                    ?>
                    <section class="post-meta-info">
                        <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date() . ", " . get_the_time(); ?></time>
                        <p class="byline author vcard"><?php echo __('By'); ?> 
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="author-link">
                                <?php echo get_the_author(); ?>
                            </a>
                        </p>
                    </section>
                    <?php
                }


                // Add Tags to KAFF News
                if( check_if_in_news() === true ) {
                    
                    // TAGS
                    // if post has tags list them
                    if( get_the_tag_list() ) {
                        ?>
                        <section class="entry-tags">
                            <?php echo get_the_tag_list('<ul><span>Tags: </span><li class="">', '</li><li class=""> ', '</li></ul>');?>
                        </section>
                        <?php
                    }

                }

                // Add Comments to KAFF News & Events
                if( check_if_in_news() === true || $post->post_type === 'gcmaz-event' ) {

                    // COMMENTS
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        ?>
                        <section class="entry-comments">
                            <?php comments_template( $post->ID );?>
                        </section>
                        <?php
                    }

                }

            ?>

        </div>

        <?php else: ?>

            <div class="alert">
                <?php _e('Sorry, no results were found.'); ?>
            </div>

        <?php endif;?>

    </article>

<?php
}


// genesis child theme
genesis();