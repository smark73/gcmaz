<?php
// leaderboard ads are created in the adrotate plugin
// each ad is assigned to a group(s)
// pages are assigned a group below (and in the plugin), which is how we tell the page which ads we want to display

$c = get_the_category();

if($post->post_title == 'Home'){
    //home page
    $groupnum = 10;
} else if (($c[0]->cat_ID == 3) || ($c[0]->category_parent == 3)){
    //check if the category or parent category is News
    $groupnum = 16;
}

// since groupnum is populated from above, lets echo necessary html to display it
if($groupnum !== null){
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
