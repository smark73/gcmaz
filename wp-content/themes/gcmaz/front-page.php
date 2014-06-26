<div class="row"><!-- front-page-->
    
    <section class="boxy row">
        <div class="rbn-hdg">
            <span class="centered txtshdw gen-hdr">Flag Cat | Pres Cat</span>
        </div>
        <div class="col-md-6">
        <?php $query1 = new WP_Query(array(
            'category_name' => 'flagstaff',
            'posts_per_archive_page' => '2',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query1->have_posts()) : ?>
        
            <?php while($query1->have_posts()) : $query1->the_post(); ?>
                <section class="archv-pg-lstng row">
                <?php if(has_post_thumbnail()) : ?>
                    <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                    </div>
                    <div class="centered visible-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                   </div>
                <?php endif;?>
                <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                    <?php get_template_part('templates/content', get_post_format());?>
                </div>
                <div class="clearfix">
                <hr class="archv-pg-hr">
                </div>
                </section>
            <?php endwhile;?>
        
            <?php if ($query1->max_num_pages > 1) : ?>
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
        </div>
        
        <div class="col-md-6">
        <?php $query2 = new WP_Query(array(
            'category_name' => 'prescott',
            'posts_per_archive_page' => '2',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query2->have_posts()) : ?>
        
            <?php while($query2->have_posts()) : $query2->the_post(); ?>
                <section class="archv-pg-lstng row">
                <?php if(has_post_thumbnail()) : ?>
                    <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                    </div>
                    <div class="centered visible-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                   </div>
                <?php endif;?>
                <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                    <?php get_template_part('templates/content', get_post_format());?>
                </div>
                <div class="clearfix">
                <hr class="archv-pg-hr">
                </div>
                </section>
            <?php endwhile;?>
        
            <?php if ($query2->max_num_pages > 1) : ?>
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
        </div>
        </section><!------------------END --->
    
        <section class="boxy row">
        <div class="rbn-hdg">
            <span class="centered txtshdw gen-hdr">Flag Tag | Presc Tag</span>
        </div>
        <div class="col-md-6">
        <?php $query3 = new WP_Query(array(
            'tag' => 'flagstaff',
            'posts_per_archive_page' => '2',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query3->have_posts()) : ?>
        
            <?php while($query3->have_posts()) : $query3->the_post(); ?>
                <section class="archv-pg-lstng row">
                <?php if(has_post_thumbnail()) : ?>
                    <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                    </div>
                    <div class="centered visible-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                   </div>
                <?php endif;?>
                <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                    <?php get_template_part('templates/content', get_post_format());?>
                </div>
                <div class="clearfix">
                <hr class="archv-pg-hr">
                </div>
                </section>
            <?php endwhile;?>
        
            <?php if ($query3->max_num_pages > 1) : ?>
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
        </div>
        
        <div class="col-md-6">
        <?php $query4 = new WP_Query(array(
            'tag' => 'prescott',
            'posts_per_archive_page' => '2',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query4->have_posts()) : ?>
        
            <?php while($query4->have_posts()) : $query4->the_post(); ?>
                <section class="archv-pg-lstng row">
                <?php if(has_post_thumbnail()) : ?>
                    <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                    </div>
                    <div class="centered visible-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                   </div>
                <?php endif;?>
                <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                    <?php get_template_part('templates/content', get_post_format());?>
                </div>
                <div class="clearfix">
                <hr class="archv-pg-hr">
                </div>
                </section>
            <?php endwhile;?>
        
            <?php if ($query4->max_num_pages > 1) : ?>
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
        </div>
        </section><!------------------END --->
        
        <section class="boxy row">
        <div class="rbn-hdg">
            <span class="centered txtshdw gen-hdr">Combined P & F Category | General News Category</span>
        </div>
        <div class="col-md-6">
        <?php $query5 = new WP_Query(array(
            'category_name' => 'prescott,flagstaff',
            'posts_per_archive_page' => '3',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query5->have_posts()) : ?>

            <?php while($query5->have_posts()) : $query5->the_post(); ?>
                <section class="archv-pg-lstng row">
                <?php if(has_post_thumbnail()) : ?>
                    <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                    </div>
                    <div class="centered visible-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                   </div>
                <?php endif;?>
                <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                    <?php get_template_part('templates/content', get_post_format());?>
                </div>
                <div class="clearfix">
                <hr class="archv-pg-hr">
                </div>
                </section>
            <?php endwhile;?>
        
            <?php if ($query5->max_num_pages > 1) : ?>
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
        </div>
        
        <div class="col-md-6">
        <?php $query6 = new WP_Query(array(
            'category_name' => 'news',
            'posts_per_archive_page' => '3',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query6->have_posts()) : ?>
        
            <?php while($query6->have_posts()) : $query6->the_post(); ?>
                <section class="archv-pg-lstng row">
                <?php if(has_post_thumbnail()) : ?>
                    <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                    </div>
                    <div class="centered visible-xs">
                        <?php the_post_thumbnail('thumbnail');?>
                   </div>
                <?php endif;?>
                <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                    <?php get_template_part('templates/content', get_post_format());?>
                </div>
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
        </div>
        </section><!------------------END --->
        
    <section class="indx-bnr-wrap row ">
        <article class="indx-bnr col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php echo adrotate_group(4); ?>
        </article>
        <article class="indx-bnr col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php echo adrotate_group(5); ?>
        </article>
    </section>
    
</div><!-- /front-page-->