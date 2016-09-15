<?php


// Content Area
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'page_loop' );


function page_loop() {

	global $post;
    global $paged;
	
    // create array to store post ID's of featured stories so we don't show them again below
    $temp_featured_ids = array();

	?>

	<div class="news-featured-section">

        <div class="featured-slider">
            <?php genesis_widget_area( 'kaff-news-slider' );?>
        </div>
        
        <section class="featured-article">
            <article>

                <?php
                    $featured_query = new WP_Query( array(
                        'category_name' => 'featured',
                        'posts_per_page' => 1,
                        'no_found_rows' => true, //decr overhead when pagination not used
                    ));
                ?>

                <?php if($featured_query->have_posts()) : ?>

                    <?php while($featured_query->have_posts()) : $featured_query->the_post(); ?>

                        <?php
                            /*store id in temp var */
                            $temp_featured_ids[0] = $post->ID ;
                        ?>
                        <section class="news-post">
                            <?php if( has_post_thumbnail() ) : ?>

                                <?php //get img src, echo as bg of link ?>
                                <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="img-link" style="background-image:url('<?php echo $img_src[0];?>'); background-position: center center; background-size: cover;">
                                </a>

                            <?php else : ?>

                                <div class="no-img">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/kaff-news-logo.png">
                                </div>

                            <?php endif; ?>

                            <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="news-post-title">
                                <?php the_title(); ?>
                            </a>

                            <?php
                                echo '<div class="news-post-content">';
                                the_excerpt();
                                echo '</div>';
                            ?>
                        </section>
                    <?php endwhile;?>

                <?php else: ?>
                    <div class="alert">
                        <p>Sorry, no results were found</p>
                    </div>
                <?php endif;?>

                <?php
                    /* Restore original Post Data */
                    wp_reset_postdata();
                ?>

            </article>
        </section>
        
        <section class="featured-article">
            <article>

                <?php
                    $sports_query = new WP_Query( array(
                        'category_name' => 'sports',
                        'posts_per_page' => 1,
                        'no_found_rows' => true, //decr overhead when pagination not used
                    ));
                ?>

                <?php if( $sports_query->have_posts() ) : ?>

                    <?php while( $sports_query->have_posts() ) : $sports_query->the_post(); ?>
                    
                        <?php
                            /*store id in temp var */ 
                            $temp_featured_ids[1] = $post->ID ;
                        ?>
                        <section class="news-post">
                            <?php if( has_post_thumbnail() ) : ?>

                                <?php //get img src, echo as bg of link ?>
                                <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="img-link" style="background-image:url('<?php echo $img_src[0];?>'); background-position: center center; background-size: cover;">
                                </a>

                            <?php else : ?>

                                <div class="no-img">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/kaff-news-logo.png">
                                </div>
                                
                            <?php endif; ?>

                            <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="news-post-title">
                                <?php the_title(); ?>
                            </a>

                            <?php
                                echo '<div class="news-post-content">';
                                the_excerpt();
                                echo '</div>';
                            ?>
                        </section>
                    <?php endwhile;?>

                <?php else: ?>
                    <div class="alert">
                        <p>Sorry, no results were found</p>
                    </div>
                <?php endif;?>

                <?php
                    /* Restore original Post Data */
                    wp_reset_postdata();
                ?>

            </article>
        </section>
        
    </div>
    
    <section class="news-latest-section">

        <div class="news-latest-hdr">
            <h5>Latest News Stories</h5>
        </div>

        <?php
            $the_query = new WP_Query( array(
                'category_name' => 'news',
                'posts_per_page' => 7, // get 7 posts, showing 5 below, need 2 extra in case in temp_feat_ids
                'nopaging' => true,
                'no_found_rows' => true, //decr overhead when pagination not used
            ));
        ?>

        <?php if( $the_query->have_posts() ) : ?>

            <?php $latest_count_var = 1; //count up to 6 posts ?>
        
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                
                <?php
                    // check if id is stored in our temp array of featured id's - dont display post if it is
                    if( !in_array( $post->ID, $temp_featured_ids ) && $latest_count_var <= 5 ) :
                ?>

                    <section class="news-listing <?php if(has_post_thumbnail()){echo 'has-img';} ?> ">
                        <p class="news-date"><?php echo get_the_date() . ", " . get_the_time();?></p>

                            <div class="latest-posts-text">
                                <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="news-post-title">
                                    <?php the_title(); ?>
                                </a>
                                <?php the_excerpt(); ?>
                            </div>

                            <?php if(has_post_thumbnail()) : ?>
                                <div class="latest-posts-img">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('thumbnail');?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        <div class="clearfix"></div>
                        <hr>

                    </section>
        
                    <?php $latest_count_var++ ?>

                <?php endif; ?>
        
            <?php endwhile;?>
        
        <?php else: ?>
            <div class="alert">
                <p>Sorry, no results were found</p>
            </div>
        <?php endif;?>
    </section>

    <?php
        /* Restore original Post Data */
        wp_reset_postdata();
    ?>

	<?php

}


// genesis child theme
genesis();