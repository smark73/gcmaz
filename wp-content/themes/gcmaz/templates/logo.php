<?php
/*  dynamically provide either the gcmaz or kaff news logo based on page */

// Get the news category id by slug
$newsCategory = get_category_by_slug('news');
$news_cat_id = $newsCategory->term_id;

// get child categories of news
$cat_args = array('child_of' => $news_cat_id);
$news_cat_children = get_categories($cat_args);

//get the children cats ids
$news_cats = array();
$i = 0;
foreach($news_cat_children as $news_cat_child){
    $news_cats[$i] = $news_cat_child->cat_ID;
    $i += 1;
}

//add children and parent together in array
array_push($news_cats, $news_cat_id);
//print_r($news_cats);

?>

<?php 
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
    elseif( in_category( $news_cats ) ) : ?>

            <section class="col-md-4">
                <a href="/kaff-news/" >
                    <img class="centered logo" alt="KAFF News" src="/media/kaff-news.png" style="max-width:120px;height:auto;padding-top:3%"/>
                </a>
            </section>
            <section class="col-md-8">
                <?php  get_template_part('templates/exp-leaderboard'); ?>
                <!--img src="/media/news-station-logos.jpg" class="news-station-logos centered img-responsive" alt="Northern Arizona News" /-->
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
