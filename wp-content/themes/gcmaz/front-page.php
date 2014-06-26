<div class="row">
    <section class="boxy row">
        <div class="rbn-hdg">
            <span class="centered txtshdw gen-hdr">Northern Arizona News</span>
        </div>
        <?php $query6 = new WP_Query(array(
            'category_name' => 'news',
            'posts_per_archive_page' => '3',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query6->have_posts()) : ?>
        
            <?php while($query6->have_posts()) : $query6->the_post(); ?>
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
        
            <?php if ($query6->max_num_pages > 1) : ?>
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
        
    <section class="indx-bnr-wrap row ">
        <article class="indx-bnr col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php echo adrotate_group(4); ?>
        </article>
        <article class="indx-bnr col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php echo adrotate_group(5); ?>
        </article>
    </section>
    
</div>