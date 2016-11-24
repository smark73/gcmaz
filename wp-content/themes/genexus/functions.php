<?php
/**
 * Functions
 * @package      genexus
 * @author       Stacy Mark <stacy.mark@kaff.com>
 * @copyright    Copyright (c) 2016
 * @license      All Rights Reserved
 *
 */



//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );


//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genexus (Geneis Child with Bourbon Neat' );
define( 'CHILD_THEME_URL', '' );
define( 'CHILD_THEME_VERSION', '2.1.2' );



/**********************************************************/
// Initialize
// Google Analytics ID UA-XXXXX-Y
define('GOOGLE_ANALYTICS_ID', 'UA-47756322-1');



/**********************************************************/
//* Enqueue Scripts and Styles

//FRONTEND
function genexus_enqueue_reqs() {

	//load the WP included jquery ... into head
	wp_enqueue_script( 'jquery');

	//wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	//* Remove default stylesheet
	wp_deregister_style( 'genesis-sample-theme' );

	//* Add compiled stylesheet
	wp_register_style( 'genexus-styles', get_stylesheet_directory_uri() . '/style.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'genexus-styles' );

	//wp_enqueue_script( 'genexus-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	//$output = array(
	//	'mainMenu' => __( '', 'genesis-sample' ),
	//	'subMenu'  => __( '', 'genesis-sample' ),
	//);
	//wp_localize_script( 'genexus-responsive-menu', 'genesisSampleL10n', $output );

	//* Add compiled JS
	wp_enqueue_script( 'genexus-scripts', get_stylesheet_directory_uri() . '/js/script.min.js', array(), CHILD_THEME_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'genexus_enqueue_reqs' );

//BACKEND load scripts, styles, fonts
function genexus_admin_reqs(){
	// Enqueue jQuery Datepicker + jQuery UI CSS
	//this fixes jquery ajax error
    wp_register_script( 'admin-scripts', get_stylesheet_directory_uri() . '/js/adminscripts.min.js' );
    wp_enqueue_script( 'admin-scripts' );
    //ready the WP included datepicker
    wp_enqueue_script( 'jquery-ui-datepicker', true );
    //ready the datepicker styles
	wp_register_style( 'jquery-ui-style', get_stylesheet_directory_uri() . '/js/jquery-ui-1.11.4.custom/jquery-ui.min.css', false, '1.11.4');
	wp_enqueue_style( 'jquery-ui-style' );
}
add_action( 'admin_enqueue_scripts', 'genexus_admin_reqs');


// Google Analytics Script
function gx_google_analytics() {
    global $post;
    ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', '<?php echo GOOGLE_ANALYTICS_ID; ?>', 'auto');

    <?php
    // OLD
    //<script type="text/javascript">
    //    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    //    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    //    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    //    e.src='//www.google-analytics.com/analytics.js';
    //    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    //    ga('create','<?php echo GOOGLE_ANALYTICS_ID; ? >');
    ?>

        <?php
            //init as "not" in news
            $inKaffNews = false;

            if( !empty( $post ) ){
                //check if in "news" to add news tracking dimensions
                if( check_if_in_news() === true) {
                    $array_of_news_cats = get_news_cats();
                    $c = get_the_category();
                    $inKaffNews = false;
                    if( $c ){
                        //check if the category or parent category is News
                        // convert to array
                        $c_array = object_to_array($c);
                        if( $c_array[0]['term_id'] ){
                            //if set
                            if( in_array( $c_array[0]['term_id'], $array_of_news_cats ) ){
                                //if current cat is in news cats
                                $inKaffNews = true;
                            }
                        }
                    }
                }

                // add "news" tracking
                if( $post->post_name === 'kaff-news' || $inKaffNews === true) {
                    // set tracking for KAFF News
                    // first ALL
                    ?>ga('set', 'dimension1', 'All News');<?php
                    if ( is_category( "Prescott News" ) || in_category( "Prescott News", $post->ID ) ){
                        // 2nd set trakcing if KAFF News - Prescott
                        ?>ga('set', 'dimension2', 'Prescott News');<?php
                    }
                    if( is_category( "Flagstaff News" ) || in_category( "Flagstaff News", $post->ID ) ){
                        // 3rd set tracking if KAFF News - Flagstaff
                        ?>ga('set', 'dimension3', 'Flagstaff News');<?php
                    }
                }
                
            }
      ?>
    ga('send','pageview');
    </script>
<?php
}

if (GOOGLE_ANALYTICS_ID) {
    add_action('wp_head', 'gx_google_analytics', 20);
}





/**********************************************************/
// Add Genesis Supports

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
// add_theme_support( 'custom-header', array(
// 	'width'           => 600,
// 	'height'          => 160,
// 	'header-selector' => '.site-title a',
// 	'header-text'     => false,
// 	'flex-height'     => true,
// ) );

//* Add support for custom background
//add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 680, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'Primary Menu', 'genesis-sample' ), 'secondary' => __( 'KAFF News Menu', 'genesis-sample' ) ) );

//* Display author box on single posts
//add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

//add_action( 'genesis_after_post', 'genesis_get_comments_template' );





/**********************************************************/
// Genesis Layout Adjustments

/** Unregister site layouts */
//genesis_unregister_layout( 'sidebar-content' );
//genesis_unregister_layout( 'full-width' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );


//* Unregister Genesis sidebars
// Remove default sidebar */
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
// Remove secondary sidebar */
//unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );


// Unregister Genesis templates
function remove_genesis_page_templates( $page_templates ) {
    unset( $page_templates['page_archive.php'] );
    unset( $page_templates['page_blog.php'] );
    return $page_templates;
}
add_filter( 'theme_page_templates', 'remove_genesis_page_templates' );


//* Hide the secondary navigation menu (unless on KAFF News, then it shows)
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

//move prim menu above hdr
//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_before_header', 'genesis_do_nav' );

// logo or text (chosen in theme customization)
// -- replaced with ours genexus_site_title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

// tagline
remove_action( 'genesis_site_description', 'genesis_seo_site_description');


// Register Our Sidebars
//kaff news sidebar
genesis_register_sidebar( array(
    'id' => 'sidebar-news',
    'name' => 'KAFF News Sidebar',
    'description' => 'KAFF News Sidebar',
));

// local pages (community/whats/concerts) sidebar
genesis_register_sidebar( array(
    'id' => 'sidebar-local',
    'name' => 'Local Pages Sidebar',
    'description' => 'Local Pages Sidebar',
));

// primary (common) sidebar
genesis_register_sidebar( array(
    'id' => 'sidebar-primary',
    'name' => 'Primary Sidebar',
    'description' => 'Primary Sidebar',
));

// Home sidebar
genesis_register_sidebar( array(
    'id' => 'sidebar-homepage',
    'name' => 'Home Page Sidebar',
    'description' => 'Home Page Sidebar',
));




    
// REGISTER SIDEBAR FOR SLIDER WIDGETS
genesis_register_sidebar( array(
    'id' => 'kaff-news-slider',
    'name' => 'KAFF News Slider',
    'description' => 'Widget to hold KAFF News Slider ',
));


    
//---- 2ND MENU DEPTH ----------------
//* Reduce the secondary navigation menu to one level depth
function genesis_sample_secondary_menu_args( $args ) {
	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}
	$args['depth'] = 1;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );


    
//---- SUPERFISH ----------------
// Tell WP to use our Superfish JS arguments instead of defaults
/**
* Filter in URL for custom Superfish arguments.
* @author Gary Jones
* @link http://code.garyjones.co.uk/change-superfish-arguments
* @param string $url Existing URL.
* @return string Amended URL.
*/
function prefix_superfish_args_url( $url ) {
    return get_stylesheet_directory_uri() . '/js/superfish-args.min.js';
}
add_filter( 'genesis_superfish_args_url', 'prefix_superfish_args_url' );




/**********************************************************/
// FULL WIDTH LAYOUTS ON SPECIFIC 
// splash-post cpt
function full_width_layout(){
    global $post;

    if ( $post ) {
        if( $post->post_type === 'splash-post' || is_page_template( 'page_landing.php' ) ) {
            $opt = 'full-width-content';
            return $opt;
        }
    }
}
add_filter( 'genesis_pre_get_option_site_layout', 'full_width_layout' );




/**********************************************************/
// ADD MORE BTNS TO EDITOR
function add_more_buttons($buttons) {
 $buttons[] = 'hr';
 $buttons[] = 'del';
 $buttons[] = 'sub';
 $buttons[] = 'sup';
 $buttons[] = 'fontselect';
 $buttons[] = 'fontsizeselect';
 $buttons[] = 'cleanup';
 $buttons[] = 'styleselect';
 return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");





/**********************************************************/
// ADD THINGS TO PAGE HEAD

//* Add SVG definitions to <head>.
function genesis_sample_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . 'images/svg-icons.svg';

	// If it exsists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}
add_action( 'wp_head', 'genesis_sample_include_svg_icons', 999 );

// copyright meta
add_action( 'genesis_meta', 'genexus_meta_info' );
function genexus_meta_info(){
    ?>
    <meta name="author" content="Great Circle Media">
    <meta name="dcterms.dateCopyrighted" content="2016">
    <meta name="dcterms.rights" content="All Rights Reserved">
    <meta name="dcterms.rightsHolder" content="Great Circle Media">
    <?php
}
add_action('wp_head', 'genexus_meta_info');





/**********************************************************/
// Custom Post Types 

// remove comments on CPT's
function remove_custom_post_comment() {
    remove_post_type_support( 'splash-post', 'comments' );
    remove_post_type_support( 'station-content', 'comments' );
}
//add_action( 'init', 'remove_custom_post_comment' );





/**********************************************************/
// CUSTOMIZE OUR HEADER

function genexus_site_title (){
    //====== GCMAZ (DEFAULT) HDR ======//
    ?>
    <div class="hdr-nav-logo">
        <a href="/"><img src="<?php echo get_stylesheet_directory_uri();?>/images/gcm-logo-white.png" class="logo"></a>
    </div>
    <?php
}
add_action( 'genesis_site_title', 'genexus_site_title' );



// Customize genesis_header_right (shows above default stuff in genesis_header_right)

function genexus_header_right(){
    ?>

	<?php //===== HDR NAV ICONS =====// ?>
	<div class="hdr-nav-icons">
	    <?php get_template_part( 'templates/hdr-nav-icons' ); ?>
	</div>

	<?php //===== SEARCH SHOW/HIDE =====// ?>
    <div class="searchbar search-hide hide-me">
        <form class="searchbar-form hide-me" itemprop="" itemscope="" itemtype="http://schema.org/SearchAction" method="get" action="<?php echo home_url('/'); ?>" role="search">
            <meta itemprop="target" content="<?php echo home_url('/'); ?>?s={s}">
            <input itemprop="query-input" type="search" name="s" placeholder="Search" class="search-field">
            <button type="submit" class="btn-search">Search</button>
        </form>
    </div>
    <br class="clearfix">

    <?php

}
add_action( 'genesis_header_right', 'genexus_header_right' );



/**********************************************************/
// START KAFF NEWS MODS 
/**********************************************************/
// check if news pages/category/etc
// -- change site-title
// -- add news menu 

//if post object not populated, throws error 
// not needed if post object not populated anyways

function kaff_news_mods() {

    global $post;

    $array_of_kaff_news_pages = array(
        'kaff-news',
        'about-kaff-news',
        'contact-kaff-news',
    );

    //if post object not populated, throws error, check if in KAFF News
    if( !empty( $post ) ) {

        if( in_array( $post->post_name, $array_of_kaff_news_pages ) || in_category( get_news_cats() ) ) {

            // add kaff-news class to body tag
            function kaffnews_body_class( $classes ){
                $classes[] = 'kaff-news';
                return $classes;
            }
            add_filter('body_class', 'kaffnews_body_class');


            // change logo (site-title)
            remove_action( 'genesis_site_title', 'genexus_site_title' );
            // replace site-title
            function kaff_news_site_title(){
                ?>
                <div class="hdr-nav-logo kaff-news-hdr">
                    <a href="/kaff-news"><img src="<?php echo get_stylesheet_directory_uri();?>/images/kaff-news-logo.png" class="logo"></a>
                </div>
                <?php
            }
            add_action( 'genesis_site_title', 'kaff_news_site_title' );


            // KAFF News Menu
            // Get the secondary (kaff-news) menu and modify the items output
            function create_kaff_news_menu(){

                // start creating html
                $menu_list = '';
                $menu_list .= '<nav class="nav-secondary kaff-news-menu">';
                $menu_list .= '<div class="wrap">';
                $menu_list .= '<ul class="menu genesis-nav-menu menu-secondary">';
                $menu_list .= '<li class="news-sections-hdr">SECTIONS <i class="fa fa-chevron-right"></i></li>';

                // get the kaff news menu object and items
                $locations = get_nav_menu_locations();
                $menu = get_term($locations['secondary']);
                $menu_items = wp_get_nav_menu_items($menu->term_id);

                // cycle through items and add arrow
                foreach( $menu_items as $menu_item ){
                    $menu_list .= '<li class="menu-item">';
                    $menu_list .= '<a href="' . $menu_item->url . '" itemprop="url"><span itemprop="name">' . $menu_item->title . '</span></a>';
                    $menu_list .= '</li>';
                }

                // finish building html
                $menu_list .= '</ul>';
                $menu_list .= '</div>';
                $menu_list .= '</nav>';

                //print_r($menu_items);
                echo $menu_list;
            }
            add_action( 'genesis_before_content_sidebar_wrap', 'create_kaff_news_menu', 5 );

            
        }
    }
}
add_action( 'wp', 'kaff_news_mods' );


// CUSTOM KAFF NEWS MENU

// Create the menu 
//$menu_name = 'KAFF News';
//$menu_exists = wp_get_nav_menu_object( $menu_name );

//if doesn't exist, create it
//if( ! $menu_exists ){
    //$menu_id = wp_create_nav_menu( $menu_name );

    //set default items
    // Home Page (repeat for other items)
    //wp_update_nav_menu_item( $menu_id, 0, array(
        //'menu-item-title' => __('KAFF News Home'),
        //'menu-item-classes' => 'home',
        //'menu-item-url' => home_url('/kaff-news'),
        //'menu-item-status' => 'publish'
        //));
//}

// Register our KAFF News Menu 
//function register_kaff_news_menu() {
  //register_nav_menu('news_navigation',__( 'KAFF News' ));
//}
//add_action( 'init', 'register_kaff_news_menu' );


// Rename "Posts" to "KAFF News"
function change_news_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'KAFF News';
    $menu[5][6] = '../wp-content/mu-plugins/icon_gcmaz.png';
    $submenu['edit.php'][5][0] = 'See All News';
    $submenu['edit.php'][10][0] = 'Add News Post';
    $submenu['edit.php'][16][0] = 'News Tags';
    echo '';
}
function change_news_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'KAFF News';
    $labels->singular_name = 'News Post';
    $labels->add_new = 'Add News Post';
    $labels->add_new_item = 'Add News Post';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
}
add_action( 'admin_menu', 'change_news_post_label' );
add_action( 'init', 'change_news_post_object' );


//  Returns News categories
function get_news_cats(){

    // Get the news category id by slug
    $newsCategory = get_category_by_slug('news');
    $news_cat_id = $newsCategory->term_id;

    // get child categories of news
    $cat_args = array('child_of' => $news_cat_id);
    $news_cat_children = get_categories($cat_args);

    //get the children cats ids
    $news_cats = array();
    $i = 0;
    foreach($news_cat_children as $news_cat_child){
        $news_cats[$i] = $news_cat_child->cat_ID;
        $i += 1;
    }

    //add children and parent together in array
    array_push($news_cats, $news_cat_id);
    //print_r($news_cats);
    return $news_cats;

}

// Check if in KAFF News
function check_if_in_news() {

    global $post;
    $array_of_news_cats = get_news_cats();
    $c = get_the_category();
    if( $c ){
        //check if the category or parent category is News
        // convert to array
        $c_array = object_to_array($c);
        if( $c_array[0]['term_id'] ){
            //print_r($c_array[0]['term_id']);
            //if set
            if( in_array( $c_array[0]['term_id'], $array_of_news_cats ) ){
                //if current cat is in news cats
                return true;
            }
        }
    }
}
add_action( 'wp', 'check_if_in_news');


/**********************************************************/
// END KAFF NEWS MODS 
/**********************************************************/





/**********************************************************/
// PAGE TAKEOVER
/**********************************************************/

// get the ptko options array
$ptko_settings = get_option('ptko_settings');

// check if page take over is enabled 
if( $ptko_settings['ptko_toggle'] === 1 ){
    
    // create new styles and put in head
    //add_action( 'wp_head', 'ptko_styles' );
    function ptko_styles(){
        $ptko_settings = get_option('ptko_settings');
        $bgcolor = esc_attr($ptko_settings['ptko_bgcolor']);
        $bgimg = esc_url($ptko_settings['ptko_bgimg']);
        $newstyles = "
            <style type='text/css'>
            .takeover{background:$bgcolor;background-image: url('$bgimg');background-position:center 102px;background-repeat:no-repeat;}
            @media (max-width: 767px) { .takeover{background:$bgcolor;}
            </style>
        ";
        echo $newstyles;
    }

    // add takeover class to body
    //add_filter('body_class', 'add_takeover_body_class');
    function add_takeover_body_class($classes){
        $classes[] = 'takeover';
        return $classes;
    }

    // add takeover header
    //add_action('display_ptko', 'ptko_inc_hdr');
    function ptko_inc_hdr($ptko_settings){
        get_template_part('templates/takeover-hdr');
    }


    // 2016 PTO
    function page_takeover_hdr() {
        $ptko_settings = get_option('ptko_settings');
        ?>
            <div class="takeover" style="background:<?php echo esc_attr($ptko_settings['ptko_bgcolor']);?>">
                <a href="<?php echo esc_url( $ptko_settings['ptko_link'] );?>" target="_blank" rel="nofollow">
                    <img src="<?php echo esc_url( $ptko_settings['ptko_hdrimg'] );?>">
                </a>
            </div>
        <?php
    }
    add_action( 'genesis_before_header', 'page_takeover_hdr' );

}



/**********************************************************/
// CUSTOMIZE THE FOOTER

remove_action( 'genesis_footer', 'genesis_do_footer' );

function genexus_footer() {
    if ( is_page( 'some-page-we-dont-want-this-ftr-on' ) ){
    	//some other footer
		//wp_footer();
    } else {
    ?>
    
    <p class="copyright" data-enhance="false" data-role="none"><?php echo do_shortcode( '[footer_copyright]');?> <a href="/" data-enhance="false" data-role="none">Great Circle Media</a> &middot; All Rights Reserved.
    
    <?php
    }
}
add_action( 'genesis_footer', 'genexus_footer' );




/**********************************************************/
// CUSTOM MOBILE MENU

// Add the template
function genexus_mobile_nav() {
    get_template_part( 'templates/mobile-nav' );
}
add_action( 'genesis_before_header', 'genexus_mobile_nav');


// Create the mobile menu 
//$menu_name = 'Mobile Menu';
//$menu_exists = wp_get_nav_menu_object( $menu_name );

//if doesn't exist, create it
//if( ! $menu_exists ){
//    $menu_id = wp_create_nav_menu( $menu_name );

    //set default items
    // Home Page (repeat for other items)
//    wp_update_nav_menu_item( $menu_id, 0, array(
//        'menu-item-title' => __('Home'),
//        'menu-item-classes' => 'home',
//        'menu-item-url' => home_url('/'),
//        'menu-item-status' => 'publish'
//        ));
//}


// Register our mobile menu 
function register_mobile_menu() {
 register_nav_menu('mobile-menu',__( 'Mobile Menu' ));
}
add_action( 'init', 'register_mobile_menu' );


// Get the mobile menu and modify the items output
function modify_mobile_menu(){

    // start creating html
    $menu_list = '';
    $menu_list .= '<nav class="js-menu sliding-panel-content">';
    $menu_list .= '<div class="wrap">';
    $menu_list .= '<ul class="menu genesis-nav-menu mobile-menu">';

    // get the menu object and items
    $locations = get_nav_menu_locations();
    $menu = get_term($locations['mobile-menu']);
    $menu_items = wp_get_nav_menu_items($menu->term_id);

    // cycle through items and add arrow
    foreach( $menu_items as $menu_item ){

        //print_r($menu_item);

        if($menu_item->menu_item_parent === '0') {
            $menu_list .= '<li class="menu-item menu-item-has-child">';
        } else {
            $menu_list .= '<li class="menu-item">';
        }

        $menu_list .= '<a href="' . $menu_item->url . '" itemprop="url"><span itemprop="name">' . $menu_item->title . '</span></a>';
        $menu_list .= '</li>';
    }

    // finish building html
    $menu_list .= '</ul>';
    $menu_list .= '</div>';
    $menu_list .= '</nav>';

    //print_r($menu_items);
    echo $menu_list;
}
add_action( 'genesis_before_content_sidebar_wrap', 'modify_mobile_menu', 5 );
    




/**********************************************************/
// SIDEBARS
// customize sidebar based on category/page/etc
// the tpl file does all the work
function genexus_custom_sidebar() {
    get_template_part( 'templates/sidebars' );
}
add_action( 'genesis_before_sidebar_widget_area', 'genexus_custom_sidebar' );





/**********************************************************/
// CUSTOMIZE THE Login Screen

// Use your own external URL logo link
function genexus_url_login(){
    return "/";
}
add_filter('login_headerurl', 'genexus_url_login');

// change logo
function genexus_login_logo() {
	?>
    <style type="text/css">
        #login{
            width:400px !important;
        }
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/all-logos-gcm.png) !important;
            width:400px !important;
            height:83px !important;
            background-size:contain !important;
            background-position:center top !important;
        }
    </style>
    <?php
}
add_action( 'login_head', 'genexus_login_logo' );




/**********************************************************/
// ADD USER CONTACT INFO
/*  Add more contact details for WP users in profile */
function genexus_user_contactmethods($contactmethods){
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['googleplus'] = 'Google+';
    return $contactmethods;
}
add_filter('user_contactmethods', 'genexus_user_contactmethods', 10, 1);




/**********************************************************/
// PAGINATION
/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
function base_pagination( $the_query = NULL ) {
    global $wp_query;

    if (!empty( $the_query ) ){
        // overwrite wp_query with the passed one if exists
        $wp_query = $the_query;
    }

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5
    ) );

    // Display the pagination if more than one page is found
    if ( $paginate_links ) {
        echo '<div class="pagination">';
        echo $paginate_links;
        echo '</div>';
    }
}




/**********************************************************/
// FEATURED IMAGES

//Display featured image in posts *with* the caption if it has one
function featured_image_in_post( ) {
    global $post;
    $thumbnail_id = get_post_thumbnail_id( $post->ID );
    $thumbnail_details = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment' ) );
    $thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, 'category-thumb' );
    $thumbnail_width = $thumbnail_src[1];

    if ( $thumbnail_src && isset( $thumbnail_src[0] ) ) {
        echo '<div class="featured-image">';
        the_post_thumbnail( 'large', array( 'class'=>'img-responsive' ) );
        if ( !empty( $thumbnail_details[0]->post_excerpt ) ) {
            echo '<p class="featured-image-caption">';
            echo $thumbnail_details[0]->post_excerpt;
            echo '</p>';
        }
        echo '</div>';
    }
}
// not called?



// Remove dimensions from featured images in posts
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );





/**********************************************************/
// CHANGE EXCERPT [...] TO LINK
/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Full Story', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );




/**********************************************************/
// FEED TEMPLATES

function gcm_feeds_tpl(){
    add_feed('events', 'events_feed_render');
}
add_action('after_setup_theme', 'gcm_feeds_tpl');
/*
 * gcm feeds RSS template callback
 */

function events_feed_render(){
    get_template_part('feed', 'events');
}



/**********************************************************/
// BREADCRUMBS
//* Modify breadcrumb arguments.
function sp_breadcrumb_args( $args ) {
    $args['home'] = 'Home';
    $args['sep'] = ' / ';
    $args['list_sep'] = ', '; // Genesis 1.5 and later
    $args['prefix'] = '<div class="breadcrumb">';
    $args['suffix'] = '</div>';
    $args['heirarchial_attachments'] = true; // Genesis 1.5 and later
    $args['heirarchial_categories'] = true; // Genesis 1.5 and later
    $args['display'] = true;
    $args['labels']['prefix'] = '';
    $args['labels']['author'] = '';
    $args['labels']['category'] = ''; // Genesis 1.6 and later
    $args['labels']['tag'] = '';
    $args['labels']['date'] = '';
    $args['labels']['search'] = 'Search for ';
    $args['labels']['tax'] = '';
    $args['labels']['post_type'] = '';
    $args['labels']['404'] = 'Not found: '; // Genesis 1.5 and later
return $args;
}
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );


//remove breadcrumbs from specific pages
function gx_rem_genesis_breadcrumbs(){
    global $post;
    if( $post ){
        if ( $post->post_type === 'splash-post' ){
            remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');
        }
    }
}
add_action( 'genesis_before', 'gx_rem_genesis_breadcrumbs' );






/**********************************************************/
// COMMENTS

// manually include comments file, otherwise throws error
// something (CPT in single ??) looking but not finding it ??
function genexus_comment_template(){
    return dirname(__FILE__) . '/comments.php';
}
add_filter( 'comments_template', 'genexus_comment_template' );


// Modify comments header text in comments
function child_title_comments() {
    return __(comments_number( '<h3>No Responses</h3>', '<h3>1 Response</h3>', '<h3>% Responses...</h3>' ), 'genesis');
}
add_filter( 'genesis_title_comments', 'child_title_comments');


function gx_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','gx_disable_comment_url');





/**********************************************************/
// START FUNCTIONS CALLED THROUGHOUT SITE
/**********************************************************/

// Live or Dev (.vag)
//check if  on DEV or LIVE site
function live_or_local(){
    if( strpos( $_SERVER['HTTP_HOST'], '.vag') !== false ){
        //on .vag site
        $liveOrLocal = 'local';
    } else {
        $liveOrLocal = 'live';
    }
    return $liveOrLocal;
}



// Convert Object to Array
// Fn to convert Objects of stdClass to Arrays
function object_to_array($object_to_array) {
    if (is_object($object_to_array)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $object_to_array = get_object_vars($object_to_array);
    }
    if (is_array($object_to_array)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $object_to_array);
    } else {
        // Return array
        return $object_to_array;
    }
}


/*
 * SimplePie function to shorten feed 
 */
function shorten($string, $length){
    // By default, an ellipsis will be appended to the end of the text.

    //$suffix = ' (more &hellip;)';
    $suffix = '';
 
    // Convert 'smart' punctuation to 'dumb' punctuation, strip the HTML tags,
    // and convert all tabs and line-break characters to single spaces.
    //$short_desc = trim(str_replace(array("\r","\n", "\t"), ' ', strip_tags($string)));
    // STACY mod - don't strip html !
    $short_desc = trim(str_replace(array("\r","\n", "\t" ), ' ', $string));
 
    // Cut the string to the requested length, and strip any extraneous spaces 
    // from the beginning and end.
    $desc = trim(mb_substr($short_desc, 0, $length));
 
    // Find out what the last displayed character is in the shortened string
    $lastchar = substr($desc, -1, 1);
 
    // If the last character is a period, an exclamation point, or a question 
    // mark, clear out the appended text.
    if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?') $suffix='';
 
    // Append the text.
    $desc .= $suffix;
 
    // Send the new description back to the page.
    return $desc;
}

function shorten_and_strip_html($string, $length){
    // By default, an ellipsis will be appended to the end of the text.
    $suffix = ' (more &hellip;)';
 
    // Convert 'smart' punctuation to 'dumb' punctuation, strip the HTML tags,
    // and convert all tabs and line-break characters to single spaces.
    $short_desc = trim(str_replace(array("\r","\n", "\t"), ' ', strip_tags($string)));
 
    // Cut the string to the requested length, and strip any extraneous spaces 
    // from the beginning and end.
    $desc = trim(mb_substr($short_desc, 0, $length));
 
    // Find out what the last displayed character is in the shortened string
    $lastchar = substr($desc, -1, 1);

    // Check for existing "(more&hellip;)" from WP 
    $more_tag = "(more&hellip;)";
    if ( stripos( $desc, $more_tag ) !== false ){
        $more_tag_exists = true;
    } else {
        $more_tag_exists = false;
    }
 
    // If the last character is a period, an exclamation point, or a question 
    // mark, clear out the appended text.
    if ( $lastchar === '.' || $lastchar === '!' || $lastchar === '?' || $more_tag_exists === true ){
        $suffix='';
    }
 
    // Append the text.
    $desc .= $suffix;
 
    // Send the new description back to the page.
    return $desc;
}


/**********************************************************/
//  END FUNCTIONS
/**********************************************************/






/**********************************************************/
//  START PLUGIN TWEAKS
/**********************************************************/

// JETPACK TWEAKS
// JetPack Publicize - custom on/off chosen in Settings/GCMAZ
// -- get current user id and compare it against stored id's in our gcmaz_publicize option value
// -- check if gcmaz custom settings plugin active first
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'jetpack/jetpack.php' ) ){
    function gx_jetpack_pub_fn(){
        $current_user = wp_get_current_user();
        $gcmaz_settings = get_option( 'gcmaz_settings' );
        // check if the objects settings array is populated, if not assign empty array
        $gcmaz_jp_pub_settings = isset($gcmaz_settings['gcmaz_publicize']) ? $gcmaz_settings['gcmaz_publicize'] : array(0);
        if( !in_array( $current_user->ID, $gcmaz_jp_pub_settings ) ){
            // set auto post to unchecked
            add_filter( 'publicize_checkbox_default', '__return_false' );
            //echo "<script> alert('Booo');</script>";
            //print_r($gcmaz_settings['gcmaz_publicize']);
        }   
    }
    add_action( 'after_setup_theme', 'gx_jetpack_pub_fn');
}


// remove JetPack sharing buttons from excerpts
function gx_remove_filters_func() {
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'init', 'gx_remove_filters_func' );




/**********************************************************/
// GRAVITY FORMS
// Gravity Forms Custom Activation Template
// http://gravitywiz.com/customizing-gravity-forms-user-registration-activation-page
function custom_maybe_activate_user() {

    $template_path = STYLESHEETPATH . '/gfur-activate-template/activate.php';
    $is_activate_page = isset( $_GET['page'] ) && $_GET['page'] == 'gf_activation';

    if( ! file_exists( $template_path ) || ! $is_activate_page  )
        return;

    require_once( $template_path );

    exit();
}
add_action('wp', 'custom_maybe_activate_user', 9);




/**********************************************************/
// META SLIDER
// Restrict Meta Slider to admins
function metaslider_permissions($capability) {
    $capability = 'administrator';
    return $capability;
}
add_filter( "metaslider_capability", "metaslider_permissions" );


/**********************************************************/
//  END PLUGIN TWEAKS
/**********************************************************/