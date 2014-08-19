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

// custom post types
function whats_post_type(){
    $args = array(
            'labels' => array(
                'name' => __("What's Happening in Northern Arizona"),
                'singular_name' => __('Whats Post'),
                'menu_name' => __('Whats Post'),
                'all_items' => __('See All Posts'),
                'add_new' => __('Add New Post'),
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
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields'),
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
                'all_items' => __('See All Posts'),
                'add_new' => __('Add New Post'),
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
            'menu_position' => 5,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'query_var' => true,
            'can_export' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'community-info'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields'),
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
                'all_items' => __('See All Concerts'),
                'add_new' => __('Add New Concert'),
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
            'menu_position' => 5,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'concerts'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields'),
            'description' => "A 'concert' post is a listing for the Concert page.",
            'taxonomies' => array('category'),
    );
    register_post_type('concert', $args);
}
function splash_post_type(){
    $args = array(
            'labels' => array(
                'name' => __("Splash Posts"),
                'singular_name' => __('Splash Post'),
                'menu_name' => __('Splash Post'),
                'all_items' => __('See All Splash Posts'),
                'add_new' => __('Add New Splash Post'),
                'add_new_item' => __('Add New Splash Post'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit Post'),
                'new_item' => __('New Post'),
                'view' => __('View Post'),
                'view_item' => __('View Post'),
                'search_items' => __('Search Splash Posts'),
                'not_found' => __('No Splash Posts'),
                'not_found_in_trash' => __('No Splash posts in the trash'),
            ),
            'hierarchichal' => false,
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => plugins_url( 'icon_gcmaz.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'info'),
            'capability_type' => 'post',
            'supports' => array('title', 'excerpt', 'editor', 'author', 'thumbnail', 'custom-fields'),
            'description' => "A 'splash' post is a splash page.",
            'taxonomies' => array('category'),
    );
    register_post_type('splash-post', $args);
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

// Enqueue Datepicker + jQuery UI CSS
function enqueue_dp_ui(){
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
}
add_action('admin_init', 'enqueue_dp_ui');

//create custom fields 
function whats_fields (){
    global $post;
    $custom = get_post_custom($post->ID);
    //load stored date & fulldate values if set
    if(isset($custom['whats_date'][0])){
        $whats_date = $custom['whats_date'][0];
    }
    if(isset($custom['whats_fulldate'][0])){
        $whats_fulldate = $custom['whats_fulldate'][0];
    }
    ?>
    <p>
        <label>Date (leave blank for ongoing)</label><br />
        <input size="45" name="whats_date" id="whats_date" value="<?php echo $whats_date; ?>" />
        <input type="hidden" name="whats_fulldate" id="whats_fulldate"/>
    </p>
    <script>
        jQuery(document).ready(function(){
            //load hiddenfield with stored data if exists
            jQuery('#whats_fulldate').datepicker({dateFormat:'yy-mm-dd'});
            var parsedDate = jQuery.datepicker.parseDate('yy-mm-dd', '<?php echo $whats_fulldate;?>');
            jQuery('#whats_fulldate').datepicker('setDate', parsedDate);
            //set values when use datepicker
            jQuery('#whats_date').datepicker({
                dateFormat : 'D, M d',
                altFormat: 'yy-mm-dd',
                altField: '#whats_fulldate'
            });
        });
    </script>
    <?php
}
function community_fields (){
    global $post;
    $custom = get_post_custom($post->ID);
    //load stored date & fulldate values if set
    if(isset($custom['community_date'][0])){
        $community_date = $custom['community_date'][0];
    }
    if(isset($custom['community_fulldate'][0])){
        $community_fulldate = $custom['community_fulldate'][0];
    }
    ?>
    <p>
        <label>Date (leave blank for ongoing)</label><br />
        <input size="45" name="community_date" id="community_date" value="<?php echo $community_date; ?>" />
        <input type="hidden" name="community_fulldate" id="community_fulldate"/>
    </p>
    <script>
        jQuery(document).ready(function(){
            //load hiddenfield with stored data if exists
            jQuery('#community_fulldate').datepicker({dateFormat:'yy-mm-dd'});
            var parsedDate = jQuery.datepicker.parseDate('yy-mm-dd', '<?php echo $community_fulldate;?>');
            jQuery('#community_fulldate').datepicker('setDate', parsedDate);
            //set values when use datepicker
            jQuery('#community_date').datepicker({
                dateFormat : 'D, M d',
                altFormat: 'yy-mm-dd',
                altField: '#community_fulldate'
            });
        });
    </script>
    <?php
}
function concert_fields (){
    global $post;
    $custom = get_post_custom($post->ID);
    //load stored date & fulldate values if set
    if(isset($custom['concert_date'][0])){
        $concert_date = $custom['concert_date'][0];
    }
    if(isset($custom['concert_fulldate'][0])){
        $concert_fulldate = $custom['concert_fulldate'][0];
    }
    ?>
    <p>
        <label>Date (leave blank for ongoing)</label><br />
        <input size="45" name="concert_date" id="concert_date" value="<?php echo $concert_date; ?>" />
        <input type="hidden" name="concert_fulldate" id="concert_fulldate"/>
    </p>
    <script>
        jQuery(document).ready(function(){
            //load hiddenfield with stored data if exists
            jQuery('#concert_fulldate').datepicker({dateFormat:'yy-mm-dd'});
            var parsedDate = jQuery.datepicker.parseDate('yy-mm-dd', '<?php echo $concert_fulldate;?>');
            jQuery('#concert_fulldate').datepicker('setDate', parsedDate);
            //set values when use datepicker
            jQuery('#concert_date').datepicker({
                dateFormat : 'D, M d',
                altFormat: 'yy-mm-dd',
                altField: '#concert_fulldate'
            });
        });
    </script>
    <?php
}

// save action
add_action('save_post', 'save_whats_attributes');
add_action('save_post', 'save_community_attributes');
add_action('save_post', 'save_concert_attributes');
add_action('save_post', 'save_splash_attributes');
add_action('publish_post', 'save_whats_attributes');
add_action('publish_post', 'save_community_attributes');
add_action('publish_post', 'save_concert_attributes');
add_action('publish_post', 'save_splash_attributes');

//save custom fields and set specific category
function save_whats_attributes(){
    global $post;
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
function save_community_attributes(){
    global $post;
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
function save_concert_attributes(){
    global $post;
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

//add taxonomy
/*add_action('init', 'create_station_taxonomy', 0);

function create_station_taxonomy(){
    $loc_labels = array(
        'name' => 'Station',
        'singular_name' => 'Station',
        'search_items' => 'Search station',
        'popular_items' => 'Popular stations',
        'all_items' => 'All stations',
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => 'Edit station',
        'update_item' => 'Update station',
        'add_new_item' => 'Add new station',
        'new_item_name' => 'New station name',
        'separate_items_with_commas' => 'Separate stations with commas',
        'add_or_remove_items' => 'Add or remove stations',
        'choose_from_most_used' => 'Choose from common stations',
        'menu_name' => 'Stations',
    );
    register_taxonomy('locations', array('whats-happening', 'community-info', 'concert'), array(
        'hierarchical' => false,
        'labels' => $loc_labels,
        'query_var' => true,
        'update_count_callback' => '_update_post_term_count',
        'rewrite' => array('slug' => 'station')
    ));
}*/