<div class="in-cnt-wrp row">
    <section class="row">
        <div class="centered rbn-hdg">
            <?php get_template_part('templates/page', 'header'); ?>
        </div>
        <?php
            $the_category = get_query_var('cat');
            $the_query = new WP_Query(array(
                'cat' => $the_category,
            ));
        ?>
        <?php if($the_query->have_posts()) : ?>
        
            <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                <section class="archv-pg-lstng row">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                        <div class="centered visible-xs">
                            <?php the_post_thumbnail('thumbnail');?>
                       </div>
                        <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                            <?php get_template_part('templates/content', get_post_format());?>
                        </div>
                    <?php else : ?>
                        <div class="archv-info col-md-12 col-sm-12 col-xs-12">
                            <?php get_template_part('templates/content', get_post_format());?>
                        </div>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                    <hr class="archv-pg-hr">
                </section>
            <?php endwhile;?>
        
            <?php if ($the_query->max_num_pages > 1) : ?>
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