<?php
/*
Template Name: News Template
*/
?>
<div class="in-cnt-wrp row">
    <section class="row">
        <div class="centered rbn-hdg">
            <div class="page-header">
                <h4 class="txtshdw">Northern Arizona News</h4>
            </div>
        </div>
        <?php $query = new WP_Query(array(
            'category_name' => 'news',
            //'posts_per_archive_page' => '3',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query->have_posts()) : ?>
        
            <?php while($query->have_posts()) : $query->the_post(); ?>
                <section class="archv-pg-lstng row">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="archv-info col-md-10 col-sm-9 col-xs-12">
                            <span class="archv-date pull-right red">
                                <?php //$cdate = get_post_custom_values('concert_date'); echo $cdate[0];?>
                            </span>
                            <?php get_template_part('templates/content', get_post_format());?>
                        </div>
                        <div class="archv-thmb col-md-2 col-sm-3 hidden-xs">
                            <?php the_post_thumbnail('thumbnail');?>
                        </div>
                    <?php else : ?>
                        <div class="archv-info col-md-12 col-sm-12 col-xs-12">
                            <span class="archv-date pull-right red">
                                <?php //$cdate = get_post_custom_values('concert_date'); echo $cdate[0];?>
                            </span>
                            <?php get_template_part('templates/content', get_post_format());?>
                        </div>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                    <hr class="archv-pg-hr">
                </section>
            <?php endwhile;?>
        
            <?php if ($query->max_num_pages > 1) : ?>
              <nav class="post-nav">
                <ul class="pager">
                  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
                  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
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