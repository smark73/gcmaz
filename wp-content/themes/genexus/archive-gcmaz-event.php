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
            $todays_date = date('Ymd');

            $the_query = new WP_Query(array(
                'post_type' => 'gcmaz-event',
                'meta_key' => 'event_start_date_comp',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'posts_per_page' => 10,
                'paged' => $paged,
                'meta_query' => array(
                    //start and end dates
                    //'relation' => 'AND',
                    array(
                        // end date is >= todays date OR ..
                        'relation' => 'OR',
                        array(
                            'key' => 'event_end_date_comp',
                            'value' => $todays_date,
                            'type' => 'numeric',
                            'compare' => '>=',
                        ),
                        // end date is null AND ...
                        array(
                            'relation' => 'AND',
                            array(
                                'key' => 'event_end_date_comp',
                                'value' => null,
                                'compare' => '=',
                            ),
                            // start date is >= todays date OR default 20000101
                            array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'event_start_date_comp',
                                    'value' => $todays_date,
                                    'type' => 'numeric',
                                    'compare' => '>=',
                                ),
                                array(
                                    'key' => 'event_start_date_comp',
                                    'value' => '20000101',
                                    //'type' => 'numeric',
                                    'compare' => '=',
                                ),
                            ),
                        ),
                    ),
                ),
            ));
        ?>
        
        <?php if( $the_query->have_posts() ) : ?>

            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

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
        
            <?php endwhile;?>

        <?php if ( function_exists('base_pagination') ) { base_pagination( $the_query ); } else if ( is_paged() ) { ?>
            <div class="navigation clearfix">
                <div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
                <div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
            </div>
        <?php } ?>

        <?php else: ?>

            <div class="alert">
                <?php _e('Sorry, no results were found.'); ?>
            </div>
            
        <?php endif;?>

        <?php
            /* Restore original Post Data */
            wp_reset_postdata();
        ?>

    </div>

<?php
}


// genesis child theme
genesis();