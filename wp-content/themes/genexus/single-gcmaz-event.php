<?php

// Content Area
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'page_loop' );



function page_loop() {

    global $post;
    global $paged;

    ?>

    <div class="archive-description taxonomy-archive-description taxonomy-description">
        <h1 class="entry-title" itemprop="headline">Local Events and Information</h1>
    </div>
        
    <div class="entry archive-page">

        <?php
            $the_query = new WP_Query( array(
                'post_type' => 'gcmaz-event',
                'orderby' => 'meta_value',
                'meta_key' => 'event_start_date_comp',
                'order' => 'ASC',
                'posts_per_page' => 100000,
                'paged' => $paged,
                ));
        ?>
        
        <?php if( $the_query->have_posts() ) : ?>

            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
        
                <?php
                // for position - use start date (event_start_date_comp)
                // for kill date - use end date (event_end_date_comp)
                // check for past dated posts or non-dated posts (default date for undated posts is 20000101)
                $expDate = get_post_custom_values('event_end_date_comp');
                if (!$expDate[0]){
                    // if no end date set, use start date or default value
                    $expDate = get_post_custom_values('event_start_date_comp');
                }
                
                if( ( $expDate[0] == '20000101' ) || ( strtotime($expDate[0]) ) >= ( strtotime('now') ) ) : ?>

                    <section class="archive-listing <?php if( has_post_thumbnail() ) { echo 'has-img'; } ?>">
                        
                        <div class="archive-listing-text">
                            <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="archive-listing-title">
                                <?php the_title(); ?>
                            </a>
                            <br>
                            <span class="listing-date">
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
                            </span>
                            <?php the_excerpt(); ?>
                        </div>

                        <?php if( has_post_thumbnail() ) : ?>
                            <div class="archive-listing-image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail('thumbnail');?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="clearfix"></div>
                        <hr>

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

            <div class="alert alert-warning">
                <?php _e('Sorry, no results were found.', 'roots'); ?>
            </div>

        <?php endif;?>

    </div>

<?php
}


// genesis child theme
genesis();