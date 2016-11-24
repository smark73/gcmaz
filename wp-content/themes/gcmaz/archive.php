<div class="in-cnt-wrp row">
    <div class="centered rbn-hdg">
        <?php get_template_part('templates/page', 'header'); ?>
    </div>
    
    <?php
        $the_category = get_query_var('cat');
        $the_query = new WP_Query(array(
            'cat' => $the_category,
            //'posts_per_archive_page' => '10',
            'order' => 'DESC',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => $paged,
            ));
    ?>

    <?php if($the_query->have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <section class="archv-pg-lstng row">
                <p class="news-date"><?php echo get_the_date() . ", " . get_the_time();?></p>
                <?php if(has_post_thumbnail()) : ?>
                    <div class="archv-info col-md-10 col-sm-9 col-xs-12">
                        <?php get_template_part('templates/content', get_post_format());?>
                    </div>
                    <div class="archv-thmb col-md-2 col-sm-3 hidden-xs">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
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
        <?php endwhile;?>

        <?php if ( function_exists('base_pagination') ) { base_pagination(); } else if ( is_paged() ) { ?>
            <div class="navigation clearfix">
                <div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
                <div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
            </div>
        <?php } ?>

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