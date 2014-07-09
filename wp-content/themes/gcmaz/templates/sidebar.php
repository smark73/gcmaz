<?php
//get the category & parent category to see if it's a news post so we can display the 'news' sidebar
$the_category = get_the_category($post->ID);
$news_cat_id = get_cat_ID("News");

if (is_page_template('template-splash.php')){
    dynamic_sidebar('sidebar-splash');
}elseif(is_page_template('template-news.php') || $the_category[0]->cat_name == "News" || $the_category[0]->category_parent == $news_cat_id){
    dynamic_sidebar('sidebar-news');
}elseif($post->post_title == 'Home'){
    dynamic_sidebar('sidebar-homepage');
} elseif($post->post_type == 'concert'){
    dynamic_sidebar('sidebar-concert');
} elseif($post->post_type == 'whats-happening'){
    dynamic_sidebar('sidebar-whats');
} elseif($post->post_type == 'community-info'){
    dynamic_sidebar('sidebar-community');
} elseif($post->post_title == 'On Air Shows'){
    dynamic_sidebar('sidebar-onair');
} elseif($post->post_title == 'Area Weather'){
    dynamic_sidebar('sidebar-weather');
} else {
    dynamic_sidebar('sidebar-primary');
}
?>