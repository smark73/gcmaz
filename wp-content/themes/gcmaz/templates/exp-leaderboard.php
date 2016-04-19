<?php
// leaderboard ads are created in the adrotate plugin
// each ad is assigned to a group(s)
// pages are assigned a group below (and in the plugin), which is how we tell the page which ads we want to display
// first, check if adrotat plugin is even active

// detect plugin - front end use only
include_once( ABSPATH . 'wp-admin/includes/plugin.php');
// check for plugin by using plugin name
if( is_plugin_active( 'adrotate/adrotate.php' ) ){

    global $post;

    // check if we're in News category
    $array_of_news_cats = check_current_category_for_news();
    $c = get_the_category();

    // check if were live or local
    $liveOrLocal = live_or_local();


    if( !empty( $post ) ){
        if( is_front_page() ){
            $groupnum = 10;
        } elseif( is_post_type_archive( 'whats-happening' ) ){
            $groupnum = 11;
        } elseif( is_post_type_archive( 'community-info' ) ){
            $groupnum = 12;
        } elseif( is_post_type_archive( 'concert' ) ){
            $groupnum = 13;
        } elseif ( !empty( $c ) ){
            //check if the category or parent category is News
            // convert to array
            $c_array = object_to_array($c);
            //print_r($c);
            if( in_array( $c_array[0]['term_id'], $array_of_news_cats ) ){
                if( $liveOrLocal == 'local' ){
                    // on .dev site
                    if ( is_category( "Flagstaff News" ) ){
                        $groupnum = 20;
                    } elseif( is_category( "Prescott News" ) ){
                        $groupnum = 21;
                    } else {
                        $groupnum = 22;
                    }
                } else {
                    //on .com site
                    if ( is_category( "Flagstaff News" ) ){
                        $groupnum = 20;
                    } elseif( is_category( "Prescott News" ) ){
                        $groupnum = 21;
                    } else {
                        $groupnum = 16;
                    }
                }
            }
        } elseif( $post->post_name == 'kaff-news' ) {
            if( $liveOrLocal == 'local' ){
                // on .dev site
                $groupnum = 22;
            } else {
                //on .com site
                $groupnum = 16;
            }
        }
        //print_r($groupnum);

        // since groupnum is populated from above, lets echo necessary html to display it
       if(!empty( $groupnum )){
            if(substr(adrotate_group($groupnum), 0, 5) == "<span" || substr(adrotate_group($groupnum), 0, 2) == "<!"){
                // (test to see if it returned an <a tag ... if not, it must be an error message)        
                // no ads in our group or error retrieving them
                // see adrotate-output.php for list of errors
            } else {
                echo '<div class="hidden-xs expldrbrd centered">';
                     echo adrotate_group($groupnum);
                echo '</div><div class="col-xs-12 hidden-sm hidden-md hidden-lg centered">';
                    echo adrotate_group($groupnum);
                echo '</div>';
            }
        } 
    }

}