<?php get_template_part('templates/content', 'single'); ?>
<section class="post-credit">
    <?php get_template_part('templates/entry-meta'); ?>
    <div class="clearfix"></div>
</section>
<section class="post-comments">
    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
                comments_template();
        }
     ?>
</section>
