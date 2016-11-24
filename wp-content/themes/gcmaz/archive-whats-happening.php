<div class="in-cnt-wrp row">
    <div class="centered rbn-hdg">
        <?php get_template_part('templates/page', 'header'); ?>
    </div>
    
    <?php
        $the_query = new WP_Query(array(
            'post_type' => 'whats-happening',
            'orderby' => 'meta_value',
            'meta_key' => 'whats_fulldate',
            'order' => 'ASC',
            'posts_per_page' => 100000,
            'paged' => $paged,
            ));
    ?>
    
    <?php if($the_query->have_posts()) : ?>

        <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
    
            <?php
            // for position - use start date (whats_fulldate)
            // for kill date - use end date (whats_fullenddate)
            // check for past dated posts or non-dated posts (default date for undated posts is 20000101)
            $expDate = get_post_custom_values('whats_fullenddate');
            if (!$expDate[0]){
                // if no end date set, use start date or default value
                $expDate = get_post_custom_values('whats_fulldate');
            }
            
            if( ( $expDate[0] == '20000101' ) || ( strtotime($expDate[0]) ) >= ( strtotime('now') ) ) : ?>
                <section class="archv-pg-lstng row">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="archv-thmb col-md-3 col-sm-4 hidden-xs">
                            <?php the_post_thumbnail('thumbnail');?>
                        </div>
                        <div class="centered visible-xs">
                            <?php the_post_thumbnail('thumbnail');?>
                       </div>
                       <div class="archv-info col-md-9 col-sm-8 col-xs-12">
                            <span class="archv-date pull-right red">
                                <?php
                                    // echo date
                                    $startdate = get_post_custom_values('whats_date');
                                    echo $startdate[0];
                                    // if has end date, add it
                                    $enddate = get_post_custom_values('whats_enddate');
                                    if($enddate[0]){
                                        echo " - " . $enddate[0];
                                    }
                                 ?>
                            </span>
                            <?php get_template_part('templates/content', get_post_format());?>
                       </div>
                    <?php else : ?>
                        <div class="archv-info col-md-12 col-sm-12 col-xs-12">
                            <span class="archv-date pull-right red">
                                <?php
                                    // echo date
                                    $startdate = get_post_custom_values('whats_date');
                                    echo $startdate[0];
                                    // if has end date, add it
                                    $enddate = get_post_custom_values('whats_enddate');
                                    if($enddate[0]){
                                        echo " - " . $enddate[0];
                                    }
                                ?>
                            </span>
                            <?php get_template_part('templates/content', get_post_format());?>
                        </div>
                    <?php endif;?>
                    <div class="clearfix"></div>
                    <hr class="archv-pg-hr">
                </section>
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