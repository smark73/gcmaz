<div class="in-cnt-wrp row">
    <div class="centered rbn-hdg">
        <div class="page-header">
            <h5 class="txtshdw">Local Events and Information</h5>
        </div>
    </div>
    <?php while (have_posts()) : the_post(); ?>
      <article <?php post_class('sngl-info'); ?>>
        <header>
            <h3 class='blue'><?php the_title(); ?></h3>
            <span class='red' style='font-size:1.3em'>
                <?php
                    $startdate = get_post_custom_values('event_start_date');
                    echo $startdate[0];
                    $enddate = get_post_custom_values('event_end_date');
                    if($enddate[0]){
                        echo " - " . $enddate[0];
                    }
                ?>
            </span>
        </header>
        <div class="entry-content">

            <?php
                // image
                if(has_post_thumbnail()){
                    $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                    echo '<a href="' . $full_image_url[0] . '" target="_blank" title="' . the_title_attribute( 'echo=0' ) . '" class="event-img-link">';
                        echo get_the_post_thumbnail( $post->ID, 'full info-img' );
                        //the_post_thumbnail('full', array('class'=>'info-img centered img-responsive'));
                    echo '</a>';
                }
            ?>

            <?php the_content(); ?>

        </div>
        <footer>
          <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
        </footer>
        <?php comments_template('/templates/comments.php'); ?>
      </article>
    <?php endwhile; ?>
</div>