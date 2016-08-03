<?php

/*
Plugin Name: GCMAZ Splash & Station Custom Post Types
Plugin URI: http://www.gcmaz.com
Description: Creates the custom post types for gcmaz wp sites
Author: Stacy Mark
Version: 1.0
Author URI: http://www.gcmaz.com/
*/


 /* ---------------------------------
 *    CREATE CUSTOM POST TYPES
 * ---------------------------------*/

add_action('init', 'splash_post_type');
add_action('init', 'station_post_type');

function splash_post_type(){
    $args = array(
            'labels' => array(
                'name' => __("Splash Pages"),
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
            'menu_position' => 7,
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
                'name' => __("Great Circle Media Information"),
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
            'menu_position' => 8,
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

