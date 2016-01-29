<?php

/*
Plugin Name: GCMAZ Custom Post Types
Plugin URI: http://www.gcmaz.com
Description: Creates the custom post types for gcmaz wp sites
Author: Stacy Mark
Version: 1.0
Author URI: http://www.gcmaz.com/
*/


/*
 * NOTES
 * 
 * whats_date --------\
 * community_date --------- >   equals start date (D, M d)  ex. Sat, Aug 8
 * concert_date -------/
 * 
 * whats_enddate ---------\
 * community_enddate ---------- >  equals end date (D, M d) ex. Fri, Aug 7
 * concert_enddate -------/
 * 
 * whats_fulldate ---------\
 * community_fulldate --------- >  equals date used in comparison fn (yymmdd)  ex. 20150807
 * concert_fulldate --------/

 * whats_fullenddate ---------\
 * community_fullenddate --------- >  equals date used in comparison fn (yymmdd)  ex. 20150807
 * concert_fullenddate --------/
 * 
 * 
 * 
 * about "fulldate"
 * ----------------
 * it is compared against "todays" date in feeds to show or hide posts
 * it gets it's value from:
 * a)  end date if end date is populated
 * b) if no end date, it is assigned the value of start date
 * c) if neither end or start date have values (undated posts) it is given a default of 20000101 to position it at top of feed
 * 
 * 
 */


 /* ---------------------------------
 *    CREATE CUSTOM POST TYPES
 * ---------------------------------*/

add_action('init', 'whats_post_type');
add_action('init', 'community_post_type');
add_action('init', 'concert_post_type');
add_action('init', 'splash_post_type');
add_action('init', 'station_post_type');


function whats_post_type(){
    $args = array(
            'labels' => array(
                'name' => __("What's Happening in Northern Arizona"),
                'singular_name' => __('Whats Post'),
                'menu_name' => __('Whats Post'),
                'all_items' => __('See All'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Whats Post'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit Post'),
                'new_item' => __('New Post'),
                'view' => __('View Post'),
                'view_item' => __('View Post'),
                'search_items' => __('Search Whats'),
                'not_found' => __('No Whats Posts'),
                'not_found_in_trash' => __('No Whats posts in the trash'),
            ),
            'hierarchichal' => false,
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'whats-happening'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields', 'publicize'),
            'description' => "A 'whats' post is a blurb for the Whats Happening page.",
            'taxonomies' => array('category'),
    );
    register_post_type('whats-happening', $args);
}
function community_post_type(){
    $args = array(
            'labels' => array(
                'name' => __('Northern Arizona Community Info'),
                'singular_name' => __('Community Post'),
                'menu_name' => __('Community Post'),
                'all_items' => __('See All'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Community Post'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit Post'),
                'new_item' => __('New Post'),
                'view' => __('View Post'),
                'view_item' => __('View Post'),
                'search_items' => __('Search Community'),
                'not_found' => __('No Community Posts'),
                'not_found_in_trash' => __('No Community posts in the trash'),
            ),
            'hierarchichal' => false,
            'public' => true,
            'menu_position' => 6,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'query_var' => true,
            'can_export' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'community-info'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields', 'publicize'),
            'description' => "A 'community' post is a blurb for the Community Info page.",
            'taxonomies' => array('category'),
    );
    register_post_type('community-info', $args);
}
function concert_post_type(){
    $args = array(
            'labels' => array(
                'name' => __('Concerts Near You'),
                'singular_name' => __('Concert Post'),
                'menu_name' => __('Concert Post'),
                'all_items' => __('See All'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Concert'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit Post'),
                'new_item' => __('New Post'),
                'view' => __('View Post'),
                'view_item' => __('View Post'),
                'search_items' => __('Search Concerts'),
                'not_found' => __('No Concert Posts'),
                'not_found_in_trash' => __('No Concert posts in the trash'),
            ),
            'hierarchichal' => false,
            'public' => true,
            'menu_position' => 7,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'concerts'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields', 'publicize'),
            'description' => "A 'concert' post is a listing for the Concert page.",
            'taxonomies' => array('category'),
    );
    register_post_type('concert', $args);
}
function splash_post_type(){
    $args = array(
            'labels' => array(
                'name' => __("Splash or Contest"),
                'singular_name' => __('Splash or Contest'),
                'menu_name' => __('Splash / Contest'),
                'all_items' => __('See All'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Post'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit Post'),
                'new_item' => __('New Post'),
                'view' => __('View Post'),
                'view_item' => __('View Post'),
                'search_items' => __('Search Posts'),
                'not_found' => __('No Posts'),
                'not_found_in_trash' => __('No posts in the trash'),
            ),
            'hierarchichal' => false,
            'public' => true,
            'menu_position' => 8,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'info'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields'),
            'description' => "For Splash and Contest info pages.",
            'taxonomies' => array('category'),
    );
    register_post_type('splash-post', $args);
}
function station_post_type(){
    $args = array(
            'labels' => array(
                'name' => __("Jobs, Media Kits, and other Station content"),
                'singular_name' => __('Station Content'),
                'menu_name' => __('Station Content'),
                'all_items' => __('See All'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Post'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit Post'),
                'new_item' => __('New Post'),
                'view' => __('View Post'),
                'view_item' => __('View Post'),
                'search_items' => __('Search Station Posts'),
                'not_found' => __('No Station Posts'),
                'not_found_in_trash' => __('No Station posts in the trash'),
            ),
            'hierarchichal' => false,
            'public' => true,
            'menu_position' => 20,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'station-info', 'feeds' => true),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields'),
            'description' => "Job postings, Media Kits, and other Station related content that duplicates across sites.",
            'taxonomies' => array('category'),
    );
    register_post_type('station-content', $args);
}



 /* ----------------------------------------------
 *    PLACE CUSTOM FIELDS ON ADMIN SCREEN
 * ---------------------------------------------*/

add_action( 'admin_init', 'add_whats_box' );
add_action('admin_init', 'add_community_box');
add_action('admin_init', 'add_concert_box');

function add_whats_box(){
    add_meta_box('whats_info', 'Date', 'whats_fields', 'whats-happening', 'normal', 'core');
}
function add_community_box(){
    add_meta_box('community_info', 'Date', 'community_fields', 'community-info', 'normal', 'core');
}
function add_concert_box(){
    add_meta_box('concert_info', 'Date', 'concert_fields', 'concert', 'normal', 'core');
}

// Enqueue jquery UI (Datepicker) + jQuery UI CSS + jquery validate + datepicker validate
function enqueue_dp_ui(){
    //wp_enqueue_script('jquery-ui-datepicker');
    //wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
    wp_enqueue_script( 'jquery-ui-custom', get_template_directory_uri() . '/assets/js/jquery-ui-1.11.4.custom/jquery-ui.min.js');
    wp_enqueue_style( 'jquery-ui-style', get_template_directory_uri() . '/assets/js/jquery-ui-1.11.4.custom/jquery-ui.min.css');
    //wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/assets/js/jquery-validation-1.13.1/dist/jquery.validate.min.js');
    //wp_enqueue_script( 'jquery-ui-datepicker-validate', get_template_directory_uri() . '/assets/js/jquery.ui.datepicker.validation.package-1.0.1/jquery.ui.datepicker.validation.min.js');
}
add_action('admin_init', 'enqueue_dp_ui');


 /* ---------------------------------
 *    CREATE CUSTOM FIELDS
 * ---------------------------------*/

/*
/* ---- WHATS HAPPENING ------
*/
function whats_fields (){
    global $post;
    if(!empty($post)){
        $custom = get_post_custom($post->ID);
        //load stored date & fulldate values if set
        if(isset($custom['whats_date'][0])){
            $whats_date = $custom['whats_date'][0];
        } else {
            $whats_date = '';
        }
        if(isset($custom['whats_enddate'][0])){
            $whats_enddate = $custom['whats_enddate'][0];
        } else {
            $whats_enddate = '';
        }
        if(isset($custom['whats_fulldate'][0])){
            $whats_fulldate = $custom['whats_fulldate'][0];
        } else {
            //give it a date from long ago to position it a top
            $whats_fulldate = '20000101';
        }
        if(isset($custom['whats_fullenddate'][0])){
            $whats_fullenddate = $custom['whats_fullenddate'][0];
        } else {
            $whats_fullenddate = '';
        }

        // help for debugging
        //$letssee = "whats date: " . $whats_date . "<br/>" . "whats enddate: " . $whats_enddate . "<br/>" . "whats fulldate: " . $whats_fulldate . "<br/>" . "whats fullenddate: " . $whats_fullenddate . "<br/>";
        //print_r($letssee);
    }
    ?>
    <div>
        <p><span style="text-decoration:underline">Single day events</span> - enter in the first box and leave second empty</p>
        <p><span style="text-decoration:underline">Multiple day events</span> - enter both start and end dates</p>
        <p><span style="text-decoration:underline">Ongoing events (non-dated)</span> - leave both empty</p>
        <label>Date (Start): </label>  <input size="15" name="whats_date" id="whats_date" class="dpDate" value="<?php echo $whats_date; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <label>End Date (?) </label>  <input size="15" name="whats_enddate" id="whats_enddate" class="dpDate" value="<?php echo $whats_enddate; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <button class="clear-event-dates" title="Clear Dates">Clear</button>
        <input type="hidden" name="whats_fulldate" id="whats_fulldate" class="dpDate"/>
        <input type="hidden" name="whats_fullenddate" id="whats_fullenddate" class="dpDate"/>
    </div>
    <script>
        jQuery(document).ready(function(){
            // clear dates button functions
            jQuery('.clear-event-dates').on("click", function(event){
                event.preventDefault();
                 jQuery('#whats_date').datepicker('setDate', '');
                 jQuery('#whats_enddate').datepicker('setDate', '');
                 startDateChange();
                 endDateChange();
            });
            
            // datepicker
            jQuery('#whats_date').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#whats_enddate').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#whats_fulldate').datepicker({dateFormat:'yymmdd' });
            jQuery('#whats_fullenddate').datepicker({dateFormat:'yymmdd' });
            
            //ON LOAD
            //load hiddenfields with stored data if exists
            var checkWhatsFullDate = "<?php echo $whats_fulldate; ?>";
            if(checkWhatsFullDate !== '' || checkWhatsFullDate !== null){
                var parsedWhatsFullDate = jQuery.datepicker.parseDate('yymmdd', checkWhatsFullDate);
                jQuery('#whats_fulldate').datepicker('setDate', parsedWhatsFullDate);
            }
            var checkWhatsFullEndDate = "<?php echo $whats_fullenddate; ?>";
            if(checkWhatsFullEndDate !== '' || checkWhatsFullEndDate !== null){
                var parsedWhatsFullEndDate = jQuery.datepicker.parseDate('yymmdd', checkWhatsFullEndDate);
                jQuery('#whats_fullenddate').datepicker('setDate', parsedWhatsFullEndDate);
            }
            
            // START DATE CHANGE
            jQuery('#whats_date').change(startDateChange);
            
            function startDateChange() {
                var $startDateVal = jQuery('#whats_date').val();
                // changing the start date ?
                if( $startDateVal === '' || $startDateVal === null || $startDateVal === undefined){
                    // if set to null, set whats_fulldate to default & set endate to null
                    jQuery('#whats_fulldate').datepicker('setDate', '20000101');
                    jQuery('#whats_enddate').datepicker('setDate', '');
                    jQuery('#whats_fullenddate').datepicker('setDate', '');
                } else {
                    var $endDateVal = jQuery('#whats_enddate').val();
                    var parsedStartDate = jQuery.datepicker.parseDate('D, M d yy', $startDateVal);
                    jQuery('#whats_fulldate').datepicker('setDate', parsedStartDate);
                }
            }
            
            // END DATE CHANGE
            jQuery('#whats_enddate').change(endDateChange);
            
            function endDateChange() {
                var $endDateVal = jQuery('#whats_enddate').val();
                var parsedEndDate = jQuery.datepicker.parseDate('D, M d yy', $endDateVal);
                jQuery('#whats_fullenddate').datepicker('setDate', parsedEndDate);
            }

        });
    </script>
    <?php
}

/*
/* ---- COMMUNITY INFO  ------
*/
function community_fields (){
    global $post;
    if(!empty($post)){
        $custom = get_post_custom($post->ID);
        //load stored date & fulldate values if set
        if(isset($custom['community_date'][0])){
            $community_date = $custom['community_date'][0];
        } else {
            $community_date = '';
        }
        if(isset($custom['community_enddate'][0])){
            $community_enddate = $custom['community_enddate'][0];
        } else {
            $community_enddate = '';
        }
        if(isset($custom['community_fulldate'][0])){
            $community_fulldate = $custom['community_fulldate'][0];
        } else {
            //give it a date from long ago to position it a top
            $community_fulldate = '20000101';
        }
        if(isset($custom['community_fullenddate'][0])){
            $community_fullenddate = $custom['community_fullenddate'][0];
        } else {
            $community_fullenddate = '';
        }
        
        // help for debugging
        // see 'whats'
    }
    ?>
    <div>
        <p><span style="text-decoration:underline">Single day events</span> - enter in the first box and leave second empty</p>
        <p><span style="text-decoration:underline">Multiple day events</span> - enter both start and end dates</p>
        <p><span style="text-decoration:underline">Ongoing events (non-dated)</span> - leave both empty</p>
        <label>Date (Start): </label>  <input size="15" name="community_date" id="community_date" class="dpDate" value="<?php echo $community_date; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <label>End Date (?) </label>  <input size="15" name="community_enddate" id="community_enddate" class="dpDate" value="<?php echo $community_enddate; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <button class="clear-event-dates" title="Clear Dates">Clear</button>
        <input type="hidden" name="community_fulldate" id="community_fulldate" class="dpDate"/>
        <input type="hidden" name="community_fullenddate" id="community_fullenddate" class="dpDate"/>
    </div>
    <script>
        jQuery(document).ready(function(){
            // clear dates button functions
            jQuery('.clear-event-dates').on("click", function(event){
                event.preventDefault();
                 jQuery('#community_date').datepicker('setDate', '');
                 jQuery('#community_enddate').datepicker('setDate', '');
                 startDateChange();
                 endDateChange();
            });
            
            // datepicker
            jQuery('#community_date').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#community_enddate').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#community_fulldate').datepicker({dateFormat:'yymmdd'});
            jQuery('#community_fullenddate').datepicker({dateFormat:'yymmdd'});
            
            //ON LOAD
            //load hiddenfields with stored data if exists
            var checkWhatsFullDate = "<?php echo $community_fulldate; ?>";
            if(checkWhatsFullDate !== '' || checkWhatsFullDate !== null){
                var parsedWhatsFullDate = jQuery.datepicker.parseDate('yymmdd', checkWhatsFullDate);
                jQuery('#community_fulldate').datepicker('setDate', parsedWhatsFullDate);
            }
            var checkWhatsFullEndDate = "<?php echo $community_fullenddate; ?>";
            if(checkWhatsFullEndDate !== '' || checkWhatsFullEndDate !== null){
                var parsedWhatsFullEndDate = jQuery.datepicker.parseDate('yymmdd', checkWhatsFullEndDate);
                jQuery('#community_fullenddate').datepicker('setDate', parsedWhatsFullEndDate);
            }
            
            // START DATE CHANGE
            jQuery('#community_date').change(startDateChange);
            
            function startDateChange() {
                var $startDateVal = jQuery('#community_date').val();
                // changing the start date ?
                if( $startDateVal === '' || $startDateVal === null || $startDateVal === undefined){
                    // if set to null, set community_fulldate to default & set endate to null
                    jQuery('#community_fulldate').datepicker('setDate', '20000101');
                    jQuery('#community_enddate').datepicker('setDate', '');
                    jQuery('#community_fullenddate').datepicker('setDate', '');
                } else {
                    var $endDateVal = jQuery('#community_enddate').val();
                    var parsedStartDate = jQuery.datepicker.parseDate('D, M d yy', $startDateVal);
                    jQuery('#community_fulldate').datepicker('setDate', parsedStartDate);
                }
            }
            
            // END DATE CHANGE
            jQuery('#community_enddate').change(endDateChange);
            
            function endDateChange() {
                var $endDateVal = jQuery('#community_enddate').val();
                var parsedEndDate = jQuery.datepicker.parseDate('D, M d yy', $endDateVal);
                jQuery('#community_fullenddate').datepicker('setDate', parsedEndDate);
            }

        });
    </script>
    <?php
}

/*
/* ---- CONCERT ------
*/
function concert_fields (){
    global $post;
    if(!empty($post)){
        $custom = get_post_custom($post->ID);
        //load stored date & fulldate values if set
        if(isset($custom['concert_date'][0])){
            $concert_date = $custom['concert_date'][0];
        } else {
            $concert_date = '';
        }
        if(isset($custom['concert_enddate'][0])){
            $concert_enddate = $custom['concert_enddate'][0];
        } else {
            $concert_enddate = '';
        }
        if(isset($custom['concert_fulldate'][0])){
            $concert_fulldate = $custom['concert_fulldate'][0];
        } else {
            //give it a date from long ago to position it a top
            $concert_fulldate = '20000101';
        }
        if(isset($custom['concert_fullenddate'][0])){
            $concert_fullenddate = $custom['concert_fullenddate'][0];
        } else {
            $concert_fullenddate = '';
        }
        
        // help for debugging
        // see 'whats'
    }
    ?>
    <div>
        <p><span style="text-decoration:underline">Single day events</span> - enter in the first box and leave second empty</p>
        <p><span style="text-decoration:underline">Multiple day events</span> - enter both start and end dates</p>
        <p><span style="text-decoration:underline">Ongoing events (non-dated)</span> - leave both empty</p>
        <label>Date (Start): </label>  <input size="15" name="concert_date" id="concert_date" class="dpDate" value="<?php echo $concert_date; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <label>End Date (?) </label>  <input size="15" name="concert_enddate" id="concert_enddate" class="dpDate" value="<?php echo $concert_enddate; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <button class="clear-event-dates" title="Clear Dates">Clear</button>
        <input type="hidden" name="concert_fulldate" id="concert_fulldate" class="dpDate"/>
        <input type="hidden" name="concert_fullenddate" id="concert_fullenddate" class="dpDate"/>
    </div>
    <script>
        jQuery(document).ready(function(){
            // clear dates button functions
            jQuery('.clear-event-dates').on("click", function(event){
                event.preventDefault();
                 jQuery('#concert_date').datepicker('setDate', '');
                 jQuery('#concert_enddate').datepicker('setDate', '');
                 startDateChange();
                 endDateChange();
            });
            
            // datepicker
            jQuery('#concert_date').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#concert_enddate').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#concert_fulldate').datepicker({dateFormat:'yymmdd'});
            jQuery('#concert_fullenddate').datepicker({dateFormat:'yymmdd'});
            
            //ON LOAD
            //load hiddenfields with stored data if exists
            var checkWhatsFullDate = "<?php echo $concert_fulldate; ?>";
            if(checkWhatsFullDate !== '' || checkWhatsFullDate !== null){
                var parsedWhatsFullDate = jQuery.datepicker.parseDate('yymmdd', checkWhatsFullDate);
                jQuery('#concert_fulldate').datepicker('setDate', parsedWhatsFullDate);
            }
            var checkWhatsFullEndDate = "<?php echo $concert_fullenddate; ?>";
            if(checkWhatsFullEndDate !== '' || checkWhatsFullEndDate !== null){
                var parsedWhatsFullEndDate = jQuery.datepicker.parseDate('yymmdd', checkWhatsFullEndDate);
                jQuery('#concert_fullenddate').datepicker('setDate', parsedWhatsFullEndDate);
            }
            
            // START DATE CHANGE
            jQuery('#concert_date').change(startDateChange);
            
            function startDateChange() {
                var $startDateVal = jQuery('#concert_date').val();
                // changing the start date ?
                if( $startDateVal === '' || $startDateVal === null || $startDateVal === undefined){
                    // if set to null, set concert_fulldate to default & set endate to null
                    jQuery('#concert_fulldate').datepicker('setDate', '20000101');
                    jQuery('#concert_enddate').datepicker('setDate', '');
                    jQuery('#concert_fullenddate').datepicker('setDate', '');
                } else {
                    var $endDateVal = jQuery('#concert_enddate').val();
                    var parsedStartDate = jQuery.datepicker.parseDate('D, M d yy', $startDateVal);
                    jQuery('#concert_fulldate').datepicker('setDate', parsedStartDate);
                }
            }
            
            // END DATE CHANGE
            jQuery('#concert_enddate').change(endDateChange);
            
            function endDateChange() {
                var $endDateVal = jQuery('#concert_enddate').val();
                var parsedEndDate = jQuery.datepicker.parseDate('D, M d yy', $endDateVal);
                jQuery('#concert_fullenddate').datepicker('setDate', parsedEndDate);
            }

        });
    </script>
    <?php
}

 /* ---------------------------------
 *    SAVE ACTIONS
 * ---------------------------------*/
add_action('save_post', 'save_whats_attributes');
add_action('save_post', 'save_community_attributes');
add_action('save_post', 'save_concert_attributes');
//add_action('save_post', 'save_splash_attributes');
add_action('publish_post', 'save_whats_attributes');
add_action('publish_post', 'save_community_attributes');
add_action('publish_post', 'save_concert_attributes');
//add_action('publish_post', 'save_splash_attributes');

//save custom fields and set specific category
function save_whats_attributes(){
    global $post;
    if(!empty($post)){
        if($post->post_type == 'whats-happening'){
            //custom fields
            $whats_date = sanitize_text_field($_POST['whats_date']);
            $whats_fulldate = sanitize_text_field($_POST['whats_fulldate']);
            $whats_enddate = sanitize_text_field($_POST['whats_enddate']);
            $whats_fullenddate = sanitize_text_field($_POST['whats_fullenddate']);
            update_post_meta($post->ID, "whats_date", $whats_date);
            update_post_meta($post->ID, "whats_fulldate", $whats_fulldate);
            update_post_meta($post->ID, "whats_enddate", $whats_enddate);
            update_post_meta($post->ID, "whats_fullenddate", $whats_fullenddate);
            //category
            wp_set_object_terms($post->ID, 'whats-happening', 'category', true);
        }
    }
}
function save_community_attributes(){
    global $post;
    if(!empty($post)){
        if($post->post_type == 'community-info'){
            //custom fields
            $community_date = sanitize_text_field($_POST['community_date']);
            $community_fulldate = sanitize_text_field($_POST['community_fulldate']);
            $community_enddate = sanitize_text_field($_POST['community_enddate']);
            $community_fullenddate = sanitize_text_field($_POST['community_fullenddate']);
            update_post_meta($post->ID, "community_date", $community_date);
            update_post_meta($post->ID, "community_fulldate", $community_fulldate);
            update_post_meta($post->ID, "community_enddate", $community_enddate);
            update_post_meta($post->ID, "community_fullenddate", $community_fullenddate);
            //category
            wp_set_object_terms($post->ID, 'community-info', 'category', true);
        }
    }
}
function save_concert_attributes(){
    global $post;
    if(!empty($post)){
        if($post->post_type == 'concert'){
            //custom fields
            $concert_date = sanitize_text_field($_POST['concert_date']);
            $concert_fulldate = sanitize_text_field($_POST['concert_fulldate']);
            $concert_enddate = sanitize_text_field($_POST['concert_enddate']);
            $concert_fullenddate = sanitize_text_field($_POST['concert_fullenddate']);
            update_post_meta($post->ID, "concert_date", $concert_date);
            update_post_meta($post->ID, "concert_fulldate", $concert_fulldate);
            update_post_meta($post->ID, "concert_enddate", $concert_enddate);
            update_post_meta($post->ID, "concert_fullenddate", $concert_fullenddate);
            //category
            wp_set_object_terms($post->ID, 'concert', 'category', true);
        }
    }
}
