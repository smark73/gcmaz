<?php 
    /* this checks the page and determines which logo (top row) to display */

    // home page = gcmaz logo
    if( is_front_page() ) : ?>

            <section class="col-md-4">
                <a href="/" >
                    <img class="size-full wp-image-31 centered logo" alt="Great Circle Media of Arizona" src="/media/logo-gcmaz.png"/>
                </a>
            </section>
            <section class="col-md-8">
                <?php  get_template_part('templates/exp-leaderboard'); ?>
            </section>

<?php
    // kaff-news page 
    // a. not in news category so needs to be grabbed by slug
    // b. we can give it a different logo than other news pages
    elseif( $post->post_name == 'kaff-news') : ?>

            <section class="col-md-4">
                <a href="/kaff-news/" >
                    <img class="centered logo" alt="KAFF News" src="/media/kaff-news.png" style="padding-top:3%"/>
                </a>
            </section>
            <section class="col-md-8">
                <?php  get_template_part('templates/exp-leaderboard'); ?>
                <img src="/media/news-station-logos.jpg" class="news-station-logos centered img-responsive" alt="Northern Arizona News" />
            </section>

<?php 
    //news or child categories = KAFF News logo
    elseif( in_category( check_current_category_for_news() ) ) : ?>

            <section class="col-md-4">
                <a href="/kaff-news/" >
                    <img class="centered logo" alt="KAFF News" src="/media/kaff-news.png" style="max-width:120px;height:auto;padding-top:3%"/>
                </a>
            </section>
            <section class="col-md-8">
                <?php  get_template_part('templates/exp-leaderboard'); ?>
            </section>

<?php
    // everything thing else
    else : ?>
    
            <section class="col-md-4">
                <a href="/" >
                    <img class="size-full wp-image-31 centered logo" alt="Great Circle Media of Arizona" src="/media/logo-gcmaz.png" style="max-width:150px;height:auto;padding-top:3%"/>
                </a>
            </section>
            <section class="col-md-8">
                <?php  get_template_part('templates/exp-leaderboard'); ?>
            </section>
    
<?php endif; ?>
