<?php
    // display KAFF News social icons on kaff news pages
    global $post;
    if( !empty( $post ) ) : ?>

    <?php if( $post->post_name == 'kaff-news' || in_category( check_current_category_for_news() ) ) : ?>

            <span class="navbar-icons">
                <a href="https://www.facebook.com/NewsOnKAFF" target="_blank" class="icon-fb">
                    <img src="/media/icon-nav-fb.png" width="24" height="24" alt="Follow KAFF News on Facebook" />
                </a>
                <a href="https://twitter.com/kaffnews" target="_blank" class="icon-tw">
                    <img src="/media/icon-nav-twtr.png" width="24" height="24" alt="Follow KAFF News on Twitter" />
                </a>
            </span>

    <?php endif; ?>
<?php endif; ?>