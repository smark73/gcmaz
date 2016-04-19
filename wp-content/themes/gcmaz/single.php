<?php get_template_part('templates/content', 'single'); ?>
<section class="post-credit">
    <?php get_template_part('templates/entry-meta'); ?>
    <div class="clearfix"></div>
</section>
<section class="post-tags">
    <?php
        // if post has tags list them
        if(get_the_tag_list()) {
            echo get_the_tag_list('<ul><span>Tags: </span><li class="btn btn-default btn-xs">', '</li><li class="btn btn-default btn-xs"> ', '</li></ul>');
        }
    ?>
</section>
<section class="post-comments">
    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
                comments_template();
        }
     ?>
</section>
