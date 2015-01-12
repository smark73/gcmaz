<?php
    // create array to store post ID's of featured stories so we don't show them again below
    $temp_featured_ids = array();
?>
<div class="in-cnt-wrp row">
    <div class="row rbn-hdg">
        <?php get_template_part('templates/page', 'header'); ?>
    </div>
    <div class="row news-featured-section">
        
        <section class="col-md-6 news-featured">
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
                            <section class="archv-pg-lstng row">
                                <?php if(has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('thumbnail img-responsive ftrd-img');?>
                                    </a>
                                <?php endif; ?>
                                <p class="featured-news-date"><?php echo get_the_date() . ", " . get_the_time();?></p>
                                <?php get_template_part('templates/content', get_post_format());?>
                                <hr class="archv-pg-hr">
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
        
        <section class="col-md-6 news-featured">
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
                        <section class="archv-pg-lstng row">
                            <?php if(has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail('thumbnail img-responsive ftrd-img');?>
                                </a>
                            <?php endif; ?>
                            <p class="featured-news-date"><?php echo get_the_date() . ", " . get_the_time();?></p>
                            <?php get_template_part('templates/content', get_post_format());?>
                            <hr class="archv-pg-hr">
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
                <div class="centered news-featured-ftr">
                    <?php
                        $cat_sp_id = get_cat_ID('Sports News');
                        $cat_sp_link = get_category_link( $cat_sp_id );
                    ?>
                    <a href="<?php echo esc_url( $cat_sp_link );?>">More Local Sports News &raquo;</a>
                </div>
            </article>
        </section>
        
    </div>
    
    <section class="row">
        <?php $the_query = new WP_Query(array(
            'category_name' => 'news',
            //'posts_per_archive_page' => '1',
            //'order' => 'DESC',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => $paged,
            ));
        ?>
        <?php if($the_query->have_posts()) : ?>
        
            <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                
                <?php
                    // check if id is stored in our temp array of featured id's - dont display post if it is
                    if( !in_array($post->ID, $temp_featured_ids ) ) :
                ?>
        
                    <section class="archv-pg-lstng row">
                        <p class="news-date"><?php echo get_the_date() . ", " . get_the_time();?></p>
                        <?php if(has_post_thumbnail()) : ?>
                            <div class="archv-info col-md-10 col-sm-9 col-xs-12">
                                <?php get_template_part('templates/content', get_post_format());?>
                            </div>
                            <div class="archv-thmb col-md-2 col-sm-3 hidden-xs">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail('thumbnail');?>
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="archv-info col-md-12 col-sm-12 col-xs-12">
                                <?php get_template_part('templates/content', get_post_format());?>
                            </div>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                        <hr class="archv-pg-hr">
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
                <?php _e('Sorry, no results were found.', 'roots'); ?>
            </div>
        <?php endif;?>
    </section>
</div>