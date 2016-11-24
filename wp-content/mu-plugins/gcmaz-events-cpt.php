<?php

/*
Plugin Name: GCMAZ Events CPT
Plugin URI: http://gcmaz.com
Description: Creates the custom post types for gcmaz events
Author: Stacy Mark
Version: 1.0
Author URI: http://gcmaz.com/
*/


/*
 * NOTES
 * 
    event_start_date (event_date)
    event_end_date
    event_start_date_comp (event_fulldate)
    event_end_date_comp
 * 
 * about "XXXX_date_comp"
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
 *    CREATE CUSTOM POST TYPE
 * ---------------------------------*/

add_action('init', 'gcmaz_event_post_type');

function gcmaz_event_post_type(){
    $args = array(
            'labels' => array(
                'name' => __("Events"),
                'singular_name' => __('Event/Info Post'),
                'menu_name' => __('EVENTS & INFO'),
                'all_items' => __('See All'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Event/Info Post'),
                'edit' => __('Edit Post'),
                'edit_item' => __('Edit Post'),
                'new_item' => __('New Post'),
                'view' => __('View Post'),
                'view_item' => __('View Post'),
                'search_items' => __('Search Posts'),
                'not_found' => __('No Posts'),
                'not_found_in_trash' => __('No event/info posts in the trash'),
            ),
            'hierarchichal' => false,
            'public' => true,
            'menu_position' => 6,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'events'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields', 'publicize', 'comments'),
            'description' => "Posts for all stations 'HAPPENINGS', 'CONCERTS', 'INFO' listings",
            'taxonomies' => array('category'),
    );
    register_post_type('gcmaz-event', $args);
}


 /* ----------------------------------------------
 *    PLACE CUSTOM FIELDS ON ADMIN SCREEN
 * ---------------------------------------------*/

add_action( 'admin_init', 'add_event_metabox' );


function add_event_metabox(){
    add_meta_box('event_info', 'Date', 'event_fields', 'gcmaz-event', 'normal', 'core');
}




 /* ---------------------------------
 *    CREATE CUSTOM FIELDS
 * ---------------------------------*/

/*
/* ---- EVENTS ------
*/
function event_fields (){
    global $post;

    if( !empty( $post ) ){
        $custom = get_post_custom( $post->ID );
        
        //load stored date & fulldate values if set
        if( isset( $custom['event_start_date'][0] ) ){
            $event_start_date = $custom['event_start_date'][0];
        } else {
            $event_start_date = '';
        }

        if( isset( $custom['event_end_date'][0] ) ){
            $event_end_date = $custom['event_end_date'][0];
        } else {
            $event_end_date = '';
        }

        if( isset( $custom['event_start_date_comp'][0] ) ){
            $event_start_date_comp = $custom['event_start_date_comp'][0];
        } else {
            //give it a date from long ago to position it a top
            $event_start_date_comp = '20000101';
        }
        if( isset( $custom['event_end_date_comp'][0] ) ){
            $event_end_date_comp = $custom['event_end_date_comp'][0];
        } else {
            $event_end_date_comp = '';
        }

        // help for debugging
        //$letssee = "date: " . $event_start_date . "<br/>" . "event end_date: " . $event_end_date . "<br/>" . "event start date comp: " . $event_start_date_comp . "<br/>" . "event end date comp: " . $event_end_date_comp . "<br/>";
        //print_r($letssee);
    }
    ?>
    <div>
        <p><span style="text-decoration:underline">Single day events</span> - enter in the first box and leave second empty</p>
        <p><span style="text-decoration:underline">Multiple day events</span> - enter both start and end dates</p>
        <p><span style="text-decoration:underline">Ongoing events (non-dated)</span> - leave both empty</p>
        <label>Date (Start): </label>  <input size="15" name="event_start_date" id="event_start_date" class="dpDate" value="<?php echo $event_start_date; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <label>End Date (if needed) </label>  <input size="15" name="event_end_date" id="event_end_date" class="dpDate" value="<?php echo $event_end_date; ?>" readonly="true" /> 
        &nbsp; &nbsp; &nbsp; 
        <button class="clear-event-dates" title="Clear Dates">Clear</button>
        <input type="hidden" name="event_start_date_comp" id="event_start_date_comp" class="dpDate"/>
        <input type="hidden" name="event_end_date_comp" id="event_end_date_comp" class="dpDate"/>
    </div>
    <script>
        jQuery(document).ready(function(){

            // datepicker
            jQuery('#event_start_date').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#event_end_date').datepicker({ dateFormat : 'D, M d yy' });
            jQuery('#event_start_date_comp').datepicker({dateFormat:'yymmdd' });
            jQuery('#event_end_date_comp').datepicker({dateFormat:'yymmdd' });
            
            //ON LOAD
            //load hiddenfields with stored data if exists
            var checkStartDateComp = "<?php echo $event_start_date_comp; ?>";
            if(checkStartDateComp !== '' || checkStartDateComp !== null){
                var parsedStartDateComp = jQuery.datepicker.parseDate('yymmdd', checkStartDateComp);
                jQuery('#event_start_date_comp').datepicker('setDate', parsedStartDateComp);
            }
            var checkEndDateComp = "<?php echo $event_end_date_comp; ?>";
            if(checkEndDateComp !== '' || checkEndDateComp !== null){
                var parsedEndDateComp = jQuery.datepicker.parseDate('yymmdd', checkEndDateComp);
                jQuery('#event_end_date_comp').datepicker('setDate', parsedEndDateComp);
            }
            
            // START DATE CHANGE
            function startDateChange() {
                var $startDateVal = jQuery('#event_start_date').val();
                // changing the start date ?
                if( $startDateVal === '' || $startDateVal === null || $startDateVal === undefined){
                    // if set to null, set event_start_date_comp to default & set endate to null
                    jQuery('#event_start_date_comp').datepicker('setDate', '20000101');
                    jQuery('#event_end_date').datepicker('setDate', '');
                    jQuery('#event_end_date_comp').datepicker('setDate', '');
                } else {
                    var $endDateVal = jQuery('#event_end_date').val();
                    var parsedStartDate = jQuery.datepicker.parseDate('D, M d yy', $startDateVal);
                    jQuery('#event_start_date_comp').datepicker('setDate', parsedStartDate);
                }
            }
            jQuery('#event_start_date').change(startDateChange);
            

            // END DATE CHANGE
            function endDateChange() {
                var $endDateVal = jQuery('#event_end_date').val();
                var parsedEndDate = jQuery.datepicker.parseDate('D, M d yy', $endDateVal);
                jQuery('#event_end_date_comp').datepicker('setDate', parsedEndDate);
            }
            jQuery('#event_end_date').change(endDateChange);


            // CLEAR DATES FUNCTION
            jQuery('.clear-event-dates').on("click", function(event){
                event.preventDefault();
                 jQuery('#event_start_date').datepicker('setDate', '');
                 jQuery('#event_end_date').datepicker('setDate', '');
                 startDateChange();
                 endDateChange();
            });

        });
    </script>
    <?php
}



 /* ---------------------------------
 *    SAVE ACTIONS
 * ---------------------------------*/
add_action('save_post', 'save_event_attributes');

add_action('publish_post', 'save_event_attributes');


//save custom fields and set specific category
function save_event_attributes(){

    global $post;
    
    if( !empty( $post ) ){
        if( $post->post_type == 'gcmaz-event' ){
            //custom fields
            $event_start_date = sanitize_text_field( $_POST['event_start_date'] );
            $event_start_date_comp = sanitize_text_field( $_POST['event_start_date_comp'] );
            $event_end_date = sanitize_text_field( $_POST['event_end_date'] );
            $event_end_date_comp = sanitize_text_field( $_POST['event_end_date_comp'] );
            update_post_meta( $post->ID, "event_start_date", $event_start_date );
            update_post_meta( $post->ID, "event_start_date_comp", $event_start_date_comp );
            update_post_meta( $post->ID, "event_end_date", $event_end_date );
            update_post_meta( $post->ID, "event_end_date_comp", $event_end_date_comp );
        }
    }
}
