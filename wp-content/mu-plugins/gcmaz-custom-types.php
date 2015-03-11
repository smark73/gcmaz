<?php

/*
Plugin Name: GCMAZ Custom Post Types
Plugin URI: http://www.gcmaz.com
Description: Creates the custom post types for gcmaz wp sites
Author: Stacy Mark
Version: 1.0
Author URI: http://www.gcmaz.com/
*/

add_action('init', 'whats_post_type');
add_action('init', 'community_post_type');
add_action('init', 'concert_post_type');
add_action('init', 'splash_post_type');
add_action('init', 'station_post_type');

// custom post types
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


//place custom fields on admin screen
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
    wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/assets/js/jquery-validation-1.13.1/dist/jquery.validate.min.js');
    wp_enqueue_script( 'jquery-ui-datepicker-validate', get_template_directory_uri() . '/assets/js/jquery.ui.datepicker.validation.package-1.0.1/jquery.ui.datepicker.validation.min.js');
}
add_action('admin_init', 'enqueue_dp_ui');

//create custom fields 
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
        if(isset($custom['whats_fulldate'][0])){
            $whats_fulldate = $custom['whats_fulldate'][0];
        } else {
            //give it a date from long ago to position it a top
            $whats_fulldate = '20000101';
        }
    }
    ?>
    <p>
        <label>Date <span style="color:red"> MUST use the datepicker or leave empty</span></label><br />
        <input size="45" name="whats_date" id="whats_date" class="dpDate" value="<?php echo $whats_date; ?>" />
        <input type="hidden" name="whats_fulldate" id="whats_fulldate" class="dpDate"/>
    </p>
    <script>
        jQuery(document).ready(function(){
            //load hiddenfield with stored data if exists
            var parsedDate = jQuery.datepicker.parseDate('yymmdd', '<?php echo $whats_fulldate;?>');
            jQuery('#whats_fulldate').datepicker({dateFormat:'yymmdd'});
            jQuery('#whats_fulldate').datepicker('setDate', parsedDate);
            //set values when use datepicker
            jQuery('#whats_date').datepicker({
                dateFormat : 'D, M d',
                altFormat: 'yymmdd',
                altField: '#whats_fulldate'
            });
            // watch for setting null value in date and update the hidden field with null (doesnt want to do it automatically)
            jQuery('#whats_date').change(function(){
                var $temp_date = jQuery(this).val();
                if($temp_date === '' || $temp_date === null){
                    jQuery('#whats_fulldate').val('20000101');
                }
            });
            jQuery('#post').validate({
                errorPlacement: jQuery.datepicker.errorPlacement,
                rules: {
                    validDefaultDatepicker: {
                        dpDate: true
                    },
                    validFormatDatepicker: {
                        dpDate: true
                    },
                    messages: {
                        validFormatDatepicker: 'Invalid Format Date',
                        validDefaultDatepicker: 'Invalid Date'
                    }
                }
            });
        });
    </script>
    <?php
}
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
        if(isset($custom['community_fulldate'][0])){
            $community_fulldate = $custom['community_fulldate'][0];
        } else {
            //give it a date from long ago to position it a top
            $community_fulldate = '20000101';
        }
    }
    ?>
    <p>
        <label>Date <span style="color:red"> MUST use the datepicker or leave empty</span></label><br />
        <input size="45" name="community_date" id="community_date" class="dpDate" value="<?php echo $community_date; ?>" />
        <input type="hidden" name="community_fulldate" class="dpDate" id="community_fulldate"/>
    </p>
    <script>
        jQuery(document).ready(function(){
            //load hiddenfield with stored data if exists
            var parsedDate = jQuery.datepicker.parseDate('yymmdd', '<?php echo $community_fulldate;?>');
            jQuery('#community_fulldate').datepicker({dateFormat:'yymmdd'});
            jQuery('#community_fulldate').datepicker('setDate', parsedDate);
            //set values when use datepicker
            jQuery('#community_date').datepicker({
                dateFormat : 'D, M d',
                altFormat: 'yymmdd',
                altField: '#community_fulldate'
            });
            // watch for setting null value in date and update the hidden field with null (doesnt want to do it automatically)
            jQuery('#community_date').change(function(){
                var $temp_date = jQuery(this).val();
                if($temp_date === '' || $temp_date === null){
                    jQuery('#community_fulldate').val('20000101');
                }
            });
            jQuery('#post').validate({
                errorPlacement: jQuery.datepicker.errorPlacement,
                rules: {
                    validDefaultDatepicker: {
                        dpDate: true
                    },
                    validFormatDatepicker: {
                        dpDate: true
                    },
                    messages: {
                        validFormatDatepicker: 'Invalid Format Date',
                        validDefaultDatepicker: 'Invalid Date'
                    }
                }
            });
        });
    </script>
    <?php
}
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
        if(isset($custom['concert_fulldate'][0])){
            $concert_fulldate = $custom['concert_fulldate'][0];
        } else {
            //give it a date from long ago to position it a top
            $concert_fulldate = '20000101';
        }
    }
    ?>
    <p>
        <label>Date <span style="color:red"> MUST use the datepicker or leave empty</span></label><br />
        <input size="45" name="concert_date" id="concert_date" class="dpDate" value="<?php echo $concert_date; ?>" />
        <input type="hidden" name="concert_fulldate" id="concert_fulldate" class="dpDate"/>
    </p>
    <script>
        jQuery(document).ready(function(){
            //load hiddenfield with stored data if exists
            var parsedDate = jQuery.datepicker.parseDate('yymmdd', '<?php echo $concert_fulldate;?>');
            jQuery('#concert_fulldate').datepicker({dateFormat:'yymmdd'});
            jQuery('#concert_fulldate').datepicker('setDate', parsedDate);
            //set values when use datepicker
            jQuery('#concert_date').datepicker({
                dateFormat : 'D, M d',
                altFormat: 'yymmdd',
                altField: '#concert_fulldate'
            });
            // watch for setting null value in date and update the hidden field with null (doesnt want to do it automatically)
            jQuery('#concert_date').change(function(){
                var $temp_date = jQuery(this).val();
                if($temp_date === '' || $temp_date === null){
                    jQuery('#concert_fulldate').val('20000101');
                }
            });
            jQuery('#post').validate({
                errorPlacement: jQuery.datepicker.errorPlacement,
                rules: {
                    validDefaultDatepicker: {
                        dpDate: true
                    },
                    validFormatDatepicker: {
                        dpDate: true
                    },
                    messages: {
                        validFormatDatepicker: 'Invalid Format Date',
                        validDefaultDatepicker: 'Invalid Date'
                    }
                }
            });
        });
    </script>
    <?php
}

// save action
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
            update_post_meta($post->ID, "whats_date", $whats_date);
            update_post_meta($post->ID, "whats_fulldate", $whats_fulldate);
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
            update_post_meta($post->ID, "community_date", $community_date);
            update_post_meta($post->ID, "community_fulldate", $community_fulldate);
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
            update_post_meta($post->ID, "concert_date", $concert_date);
            update_post_meta($post->ID, "concert_fulldate", $concert_fulldate);
            //category
            wp_set_object_terms($post->ID, 'concert', 'category', true);
        }
    }
}
