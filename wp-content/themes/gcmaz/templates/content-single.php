<div class="in-cnt-wrp row">
    <?php while (have_posts()) : the_post(); ?>
        <div class="centered rbn-hdg">
            <span class="txtshdw hdr-cat-links">
                <?php
                    //the_category('  |  ');
                    // display News categories except "slider"
                    $categories = get_the_category();
                    foreach( $categories as $cat ){
                        //print_r($cat);
                        if( $cat->slug !== 'kaff-news-slider' ){
                            echo '<a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "%s" ), $cat->name ) . '" ' . '>' . $cat->name.'</a> ';
                        }
                    }
                ?>
            </span>
        </div>
        <article class="entry-content">
            <h3 class="story-hdr"><?php the_title(); ?></h3>
            <?php
                if(has_post_thumbnail()){
                    //the_post_thumbnail('large', array('class'=>'img-responsive'));
                    // fn moved to custom.php
                    featured_image_in_post();
                }
            ?>
            <?php the_content(); ?>
            <footer></footer>
        </article>
    <?php endwhile; ?>
</div>