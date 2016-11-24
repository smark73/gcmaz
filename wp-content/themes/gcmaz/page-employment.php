<div class="in-cnt-wrp row">
    <div class="centered rbn-hdg">
        <?php get_template_part('templates/page', 'header'); ?>
    </div>
    <div class="col-md-12 col-sm-12">
        
        <div style="margin:2% auto;">
            <?php 
                /* output content input from editor before getting our posts */
                get_template_part('templates/content', 'page'); 
            ?>
        </div>
        
        <?php
            //get station-content CPT's 
            $the_query = new WP_Query(array(
            'post_type' => 'station-content',
            //'category_name' => 'employment',
            'posts_per_archive_page' => '100',
            //'order' => 'DESC',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => $paged,
            ));
        ?>
        <?php if($the_query->have_posts()) : ?>
        
            <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                
                    <?php
                        // check if in "Hide Post" category
                        if( in_category( array( 'employment' ) ) ) :
                    ?>
                            <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                                <h3 class="entry-title blue"><?php the_title(); ?></h3>
                            </a>
                        
                    <?php endif;?>
        
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
        
    </div>
</div>