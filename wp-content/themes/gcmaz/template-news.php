<?php
/*
Template Name: News Template
*/
?>

<div class="in-cnt-wrp row">
    <div class="rbn-hdg">
        <span class="centered txtshdw gen-hdr">Northern Arizona News</span>
    </div>
    <section class="row">
        <?php $query = new WP_Query(array(
            'category_name' => 'news',
            'posts_per_archive_page' => '3',
            'order' => 'DESC',
            ));
        ?>
        <?php if($query->have_posts()) : ?>
        
            <?php while($query->have_posts()) : $query->the_post(); ?>
                <section>
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