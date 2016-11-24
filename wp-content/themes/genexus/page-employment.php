<?php

// Content Area
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'page_loop' );


function page_loop() {

    global $post;
    global $paged;

    // create post loop for "employment page"
    // gets overridden for listings
    the_post();

    ?>

    <div class="employment-page">

        <div class="entry-header">
            <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
        </div>

        <div class="entry">

            <div class="entry-content" itemprop="text">

                <?php the_content();?>


                <?php
                    //get station-content CPT's 
                    $the_query = new WP_Query(array(
                    'post_type' => 'station-content',
                    //'category_name' => 'employment',
                    'posts_per_archive_page' => '100',
                    //'order' => 'DESC',
                    'posts_per_page' => get_option('posts_per_page'),
                    'paged' => $paged,
                    ));
                ?>
            
                <?php if( $the_query->have_posts() ) : ?>

                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

                        <?php
                            // check if in "Hide Post" category
                            if( in_category( array( 'employment' ) ) ) :
                        ?>

                            <section class="employment-listing">
                                <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                                    <?php the_title(); ?>
                                </a>
                            </section>

                        <?php endif;?>
                
                    <?php endwhile;?>

                    <?php if ( function_exists('base_pagination') ) { base_pagination(); } else if ( is_paged() ) { ?>
                        <div class="navigation clearfix">
                            <div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
                            <div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
                        </div>
                    <?php } ?>

                    <?php
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    ?>

                <?php else: ?>

                    <div class="alert">
                        <?php _e('Sorry, no results were found.'); ?>
                    </div>

                <?php endif;?>

            </div>

        </div>

    </div>

<?php
}


// genesis child theme
genesis();

