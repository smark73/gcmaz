<?php
global $post;

// check if we're in News category
$show_news_sidebar = false;
$array_of_news_cats = check_current_category_for_news();
$c = get_the_category();
if( $c ){
    //check if the category or parent category is News
    // convert to array
    $c_array = object_to_array($c);
    if( $c_array[0]['term_id'] ){
        //if set
        if( in_array( $c_array[0]['term_id'], $array_of_news_cats ) ){
            //if current cat is in news cats
            $show_news_sidebar = true;
        }
    }
}
//give Advertise and its children the 'home' sidebar
$adv_id = get_page_by_title("Advertise On Northern Arizona Radio");
//print_r($adv_id->ID);

// need to keep is_search check first ... otherwise gets wrong sidebar as search info moves into post->info (a search for "concerts" calls the concerts sidebar)
if( is_search() ) {
    //echo "<div style='background:yellow'>search</div>";
    dynamic_sidebar('sidebar-primary');

} elseif(is_front_page()){
    //echo "<div style='background:yellow'>front page</div>";
    dynamic_sidebar('sidebar-homepage');
    
} elseif(!empty( $post )){
        
    // list of pages to show basic (homepage) sidebar
    if(is_page(array('Contact Great Circle Media', 'thank-you', 'employment'))){
        dynamic_sidebar('sidebar-homepage');
        
    // advertising page and children
    } elseif(is_page('advertise-on-northern-arizona-radio') || $post->post_parent == $adv_id->ID){
        dynamic_sidebar('sidebar-homepage');
        
    // weather
    } elseif($post->post_title == 'Area Weather'){
        dynamic_sidebar('sidebar-weather');
        
    // splash pages
    } elseif(is_page_template('template-splash.php')){
        dynamic_sidebar('sidebar-splash');
        
    // News
    } elseif( $post->post_name == 'kaff-news' ) {
        // check if were on the kaff news main page
        dynamic_sidebar('sidebar-news');
    } elseif($show_news_sidebar == true) {
        dynamic_sidebar('sidebar-news');
        // BELOW NOT USED - Changed to 1 sidebar instead of separate sidebars (see widgets.php)
        // changed - so can have banner for Pres AND Flag on post with both cat's
        // use dynamic widgets plugin to control
        // kept here in case changed back
        // 
        // check if sub cat is Flagstaff, Prescott (or Sports)
        //if ( is_category( "Flagstaff News" ) || in_category( "Flagstaff News", $post->ID ) ){
            //dynamic_sidebar('sidebar-news-flagstaff');
        //} elseif( is_category( "Prescott News" ) || in_category( "Prescott News", $post->ID ) ){
            //dynamic_sidebar('sidebar-news-prescott');
        //} else {
            //dynamic_sidebar('sidebar-news');
        //}
        
    // etc 
    } else {
        dynamic_sidebar('sidebar-primary');
    }

} else {
    
    dynamic_sidebar('sidebar-primary');
    
}
?>