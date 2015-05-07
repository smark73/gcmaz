<div class="in-cnt-wrp row">
    <?php while (have_posts()) : the_post(); ?>
        <div class="centered rbn-hdg">
            <span class="txtshdw hdr-cat-links"><?php the_category('  |  '); ?></span>
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