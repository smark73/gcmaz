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

            <?php echo do_shortcode('[metaslider id=653]'); ?>

        </div>
        
        <section class="featured-article">
            <article>

                <?php $featured_query = new WP_Query(array(
                    'category_name' => 'featured',
                    'posts_per_page' => 1,
                    ));
                ?>

                <?php if($featured_query->have_posts()) : ?>

                    <?php while($featured_query->have_posts()) : $featured_query->the_post(); ?>

                        <?php
                            /*store id in temp var */
                            $temp_featured_ids[0] = $post->ID ;
                        ?>
                        <section class="news-post">
                            <?php if(has_post_thumbnail()) : ?>

                                <?php //get img src, echo as bg of link ?>
                                <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="img-link" style="background-image:url('<?php echo $img_src[0];?>'); background-position: center center; background-size: cover;">
                                    <?php //the_post_thumbnail('medium featured-image'); ?>
                                </a>

                            <?php endif; ?>

                            <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="news-post-title">
                                <?php the_title(); ?>
                            </a>

                            <?php
                                //the_title( '<p class="news-post-title">', '</p>' );
                                echo '<div class="news-post-content">';
                                //the_content();
                                the_excerpt();
                                echo '</div>';
                            ?>
                        </section>
                    <?php endwhile;?>

                    <?php
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    ?>

                <?php else: ?>
                    <div class="alert alert-warning">
                        <?php _e('Sorry, no results were found.', 'roots'); ?>
                    </div>
                <?php endif;?>

            </article>
        </section>
        
        <section class="featured-article">
            <article>

                <?php $sports_query = new WP_Query(array(
                    'category_name' => 'sports',
                    'posts_per_page' => 1,
                    ));
                ?>

                <?php if($sports_query->have_posts()) : ?>

                    <?php while($sports_query->have_posts()) : $sports_query->the_post(); ?>
                    
                        <?php
                            /*store id in temp var */ 
                            $temp_featured_ids[1] = $post->ID ;
                        ?>
                        <section class="news-post">
                            <?php if(has_post_thumbnail()) : ?>

                                <?php //get img src, echo as bg of link ?>
                                <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="img-link" style="background-image:url('<?php echo $img_src[0];?>'); background-position: center center; background-size: cover;">
                                    <?php //the_post_thumbnail('medium featured-image'); ?>
                                </a>

                            <?php endif; ?>

                            <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="news-post-title">
                                <?php the_title(); ?>
                            </a>

                            <?php
                                //the_title( '<p class="news-post-title">', '</p>' );
                                echo '<div class="news-post-content">';
                                //the_content();
                                the_excerpt();
                                echo '</div>';
                            ?>
                        </section>
                    <?php endwhile;?>

                    <?php
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    ?>

                <?php else: ?>
                    <div class="alert alert-warning">
                        <?php _e('Sorry, no results were found.', 'roots'); ?>
                    </div>
                <?php endif;?>

            </article>
        </section>
        
    </div>
    
    <section class="news-latest-section">

        <div class="news-latest-hdr">
            <h5>Latest News Stories</h5>
        </div>

        <?php $the_query = new WP_Query(array(
            'category_name' => 'news',
            'posts_per_archive_page' => '5',
            //'order' => 'DESC',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => $paged,
            ));
        ?>

        <?php if($the_query->have_posts()) : ?>
        
            <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                
                <?php
                    // check if id is stored in our temp array of featured id's - dont display post if it is
                    if( !in_array( $post->ID, $temp_featured_ids ) ) :
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

                <?php endif; ?>
        
            <?php endwhile;?>
        
            <?php if ($the_query->max_num_pages > 1) : ?>
              <nav class="post-nav">
                <ul class="pager">
                  <li class="previous"><?php next_posts_link(__('&laquo; Older posts', 'roots')); ?></li>
                  <li class="next"><?php previous_posts_link(__('Newer posts &raquo;', 'roots')); ?></li>
                </ul>
              </nav>
            <?php endif; ?>

            <?php
                /* Restore original Post Data */
                wp_reset_postdata();
            ?>
        
        <?php else: ?>
            <div class="alert alert-warning">
                <?php _e('Sorry, no results were found.'); ?>
            </div>
        <?php endif;?>
    </section>

	<?php

}


// genesis child theme
genesis();