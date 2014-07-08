<div class="in-cnt-wrp row">
    <section class="boxy row">
        <div class="rbn-hdg">
            <?php get_template_part('templates/page', 'header'); ?>
        </div>
        <?php
            $the_tag = get_query_var('tag');
            $the_query = new WP_Query(array(
                'tag' => $the_tag,
            ));
        ?>
        <?php if($the_query->have_posts()) : ?>
        
            <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                <section class="archv-pg-lstng row">
                    <?php
                        if(has_post_thumbnail()){
                            the_post_thumbnail('thumbnail pull-left');
                        }
                        get_template_part('templates/content', get_post_format());
                    ?>
                    <div class="clearfix">
                        <hr class="archv-pg-hr">
                    </div>
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