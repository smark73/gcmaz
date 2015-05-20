<?php
//Need to give Advertise and its children a sidebar
$adv_id = get_page_by_title("Advertise On Northern Arizona Radio");
//print_r($adv_id->ID);
   
if(!empty( $post )){
    
    // need to keep is_search check first ... otherwise gets wrong sidebar as search info moves into post->info (a search for "concerts" calls the concerts sidebar)
    if( is_search() ) {
        //echo "<div style='background:yellow'>search</div>";
        dynamic_sidebar('sidebar-primary');
        
    } elseif(is_front_page()){
        //echo "<div style='background:yellow'>front page</div>";
        dynamic_sidebar('sidebar-homepage');
        
    // list of pages to show basic (homepage) sidebar
    } elseif(is_page(array('Contact Great Circle Media', 'thank-you', 'employment'))){
        dynamic_sidebar('sidebar-homepage');
        
    // advertising page and children
    } elseif(is_page('advertise-on-northern-arizona-radio') || $post->post_parent == $adv_id->ID){
        dynamic_sidebar('sidebar-homepage');
        
    // weather
    } elseif($post->post_title == 'Area Weather'){
        dynamic_sidebar('sidebar-weather');
        
    // splash pages
    }elseif(is_page_template('template-splash.php')){
        dynamic_sidebar('sidebar-splash');
        
    // news etc get newsy sidebar
    } else {
        dynamic_sidebar('sidebar-primary');
    }

} else {
    
    dynamic_sidebar('sidebar-primary');
    
}
?>