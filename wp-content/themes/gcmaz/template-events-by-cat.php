<?php
/*
Template Name: Events by Category
*/
?>
<?php
// --- Check Slug and Set Event Type ---
// use the slug to set the event type
// check it for "community", "what", "concert"
$cpt_slug = get_permalink();

// set the event_cat by slug

if ( stripos( $cpt_slug, 'community' ) !== false ){
    $event_cat_slug = "community-info";
    $event_cat_obj = get_category_by_slug($event_cat_slug);
    $event_cat_id = $event_cat_obj->term_id;
    $event_hdr = "Community Information";

} elseif ( stripos( $cpt_slug, 'concert' ) !== false ){
    $event_cat_slug = "concert";
    $event_cat_obj = get_category_by_slug($event_cat_slug);
    $event_cat_id = $event_cat_obj->term_id;
    $event_hdr = "Concerts";

} elseif ( stripos( $cpt_slug, 'what' ) !== false ){
    $event_cat_slug = "whats-happening";
    $event_cat_obj = get_category_by_slug($event_cat_slug);
    $event_cat_id = $event_cat_obj->term_id;
    $event_hdr = "What's Happening";

} else {
    // not a correct slug/page for this tpl
}
// --- End ---

?>

<div class="in-cnt-wrp row">
    <div class="centered rbn-hdg">
        <?php //get_template_part('templates/page', 'header'); ?>
        <h4><?php echo $event_hdr ; ?></h4>
    </div>
    
    <?php
        $the_query = new WP_Query(array(
            'post_type' => 'gcmaz-event',
            'cat' => $event_cat_id,
            'orderby' => 'meta_value',
            'meta_key' => 'event_start_date_comp',
            'order' => 'ASC',
            'posts_per_page' => 100000,
            'paged' => $paged,
            ));
    ?>
    
    <?php if($the_query->have_posts()) : ?>

        <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
    
            <?php
            // for position - use start date (event_start_date_comp)
            // for kill date - use end date (event_end_date_comp)
            // check for past dated posts or non-dated posts (default date for undated posts is 20000101)
            $expDate = get_post_custom_values('event_end_date_comp');
            if (!$expDate[0]){
                // if no end date set, use start date or default value
                $expDate = get_post_custom_values('event_start_date_comp');
            }
            
            if( ( $expDate[0] == '20000101' ) || ( strtotime($expDate[0]) ) >= ( strtotime('now') ) ) : ?>
                <section class="archv-pg-lstng row">

                       <div class="archv-info col-md-12 col-sm-12 col-xs-12">

                           <?php
                                //img visible on sm screen
                                if(has_post_thumbnail()) {
                                    the_post_thumbnail('medium', array( 'class' => 'aligncenter hidden-md hidden-lg' ) ) ;
                                }
                            ?>

                            <p class="archv-date">
                                <?php
                                    // echo date
                                    $startdate = get_post_custom_values('event_start_date');
                                    echo $startdate[0];
                                    // if has end date, add it
                                    $enddate = get_post_custom_values('event_end_date');
                                    if($enddate[0]){
                                        echo " - " . $enddate[0];
                                    }
                                 ?>
                            </p>

                            <?php
                                //img hidden on sm screen
                                if(has_post_thumbnail()) {
                                    the_post_thumbnail('thumbnail', array( 'class' => 'alignright hidden-sm hidden-xs' ) ) ;
                                }
                            ?>

                            <?php get_template_part('templates/content', get_post_format());?>

                       </div>

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