<?php
/**
 * Custom functions
 */

/*
 * Flush rewrite rules for custom post types
 * urls give a 404 otherwise
 */
add_action( 'after_switch_theme', 'bt_flush_rewrite_rules' );
function bt_flush_rewrite_rules() {
     flush_rewrite_rules();
}

// add more buttons to editor
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

/* change page title in admin (wrong for some reason) */
add_filter('admin_title', 'my_admin_title', 10, 2);
function my_admin_title($admin_title, $title){
    return get_bloginfo('name') . ' &bull; ' . $title;
}

// make archives include custom post types
function namespace_add_custom_types( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array(
            'post', 'nav_menu_item', 'whats-happening', 'concert', 'community-info', 'splash-post',
        ));
        return $query;
    }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

/* JetPack Publicize custom on/off chosen in Settings/GCMAZ */
// get current user id and compare it against stored id's in our gcmaz_publicize option value
$current_user = wp_get_current_user();
$gcmaz_settings = get_option('gcmaz_settings');
if( !in_array($current_user->ID, $gcmaz_settings['gcmaz_publicize']) ){
    // set auto post to unchecked
    add_filter( 'publicize_checkbox_default', '__return_false' );
    //echo "<script> alert('Booo');</script>";
    //print_r($gcmaz_settings['gcmaz_publicize']);
}

/* remove JetPack sharing buttons from excerpts */
add_action( 'init', 'gcmaz_remove_filters_func' );

function gcmaz_remove_filters_func() {
     remove_filter( 'the_excerpt', 'sharing_display', 19 );
}


// PAGE TAKE OVER FUNCTIONS CALLED BY ADMIN OPTIONS
// get the ptko options array
$ptko_settings = get_option('ptko_settings');
// check if page take over is enabled 
if($ptko_settings['ptko_toggle'] == 1){
    // create new styles and put in head
    add_action('wp_head', 'ptko_styles');
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
    add_filter('body_class', 'add_takeover_body_class');
    function add_takeover_body_class($classes){
        $classes[] = 'takeover';
        return $classes;
    }
    // add takeover header
    add_action('display_ptko', 'ptko_inc_hdr');
    function ptko_inc_hdr($ptko_settings){
        get_template_part('templates/takeover-hdr');
    }
}


/*
 * Register new  RSS templates
 */
add_action('after_setup_theme', 'gcm_feeds_tpl');

function gcm_feeds_tpl(){
    add_feed('whats', 'whats_feeds_render');
    add_feed('concerts', 'concerts_feeds_render');
    add_feed('community', 'community_feeds_render');
}
/*
 * gcm feeds RSS template callback
 */
function whats_feeds_render(){
    get_template_part('feed', 'whats');
}
function concerts_feeds_render(){
    get_template_part('feed', 'concerts');
}
function community_feeds_render(){
    get_template_part('feed', 'community');
}



/* Update Tag Cloud font sizes */
add_filter('widget_tag_cloud_args','set_tag_cloud_sizes');
function set_tag_cloud_sizes($args) {
    $args['smallest'] = 8;
    $args['largest'] = 18;
return $args; }



/*  dynamically provide either the gcmaz or kaff news logo based on page */
function check_current_category_for_news(){
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
    return($news_cats);
}

/*
 * Fn to convert Objects of stdClass to Arrays
 */
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

/*  Add more contact details for WP users in profile */
function gcmaz_user_contactmethods($contactmethods){
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['googleplus'] = 'Google+';
    return $contactmethods;
}
add_filter('user_contactmethods', 'gcmaz_user_contactmethods', 10, 1);


/*
 * Add Custom Code to Page Head
 */
add_action('wp_head', 'gcmaz_add_to_head');
function gcmaz_add_to_head(){
    echo "<link href='//fonts.googleapis.com/css?family=Bree+Serif|Montserrat:400,700' rel='stylesheet' type='text/css'>";
    if( is_front_page() ){
        echo "<link type='text/css' rel='stylesheet' href='/assets/css/animate/animate.min.css'>";
    }
}


/*
 * Custom fn to display featured image in posts *with* the caption if it has one
 */
function featured_image_in_post( ) {
    global $post;
    $thumbnail_id = get_post_thumbnail_id($post->ID);
    $thumbnail_details = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
    $thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, 'category-thumb' );
    $thumbnail_width = $thumbnail_src[1];

    if ($thumbnail_src && isset($thumbnail_src[0])) {
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


/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
function base_pagination() {
    global $wp_query;

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
        echo '</div><!--// end .pagination -->';
    }
}

//check if  on DEV or LIVE site
function live_or_local(){
    if( strpos( $_SERVER['HTTP_HOST'], '.dev') !== false ){
        //on .dev site
        $liveOrLocal = 'local';
    } else {
        $liveOrLocal = 'live';
    }
    return $liveOrLocal;
}


/*
 * CUSTOMIZE THE Login Screen
 * 
 */
// Use your own external URL logo link
function gcmaz_url_login(){
    return "http://gcmaz.com/";
}
add_filter('login_headerurl', 'gcmaz_url_login');

// change logo
function gcmaz_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/all-logos-gcm.png);
            width:300px;
            height:120px;
            background-size:contain;
            background-position:center top;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'gcmaz_login_logo' );

// END


/*
 * CUSTOMIZE Dashboard
 */
add_action('wp_dashboard_setup', 'gcmaz_dashboard_widgets');

function gcmaz_dashboard_widgets(){
    global $wp_meta_boxes;
    wp_add_dashboard_widget('gcmaz_welcome_widget', 'Great Circle Media User Account', 'gcmaz_welcome_text');
    function gcmaz_welcome_text(){
        echo '
            <h2>About Your Account</h2>
            <p>With your new account on Great Circle Media you will be notified first of upcoming contests and events!</p>
            <a href="http://kaff.gcmaz.com"><img src="/media/flagstaff-radio-kaff-country.jpg" alt="Northern Arizona Radio - KAFF Country 92.9" style="max-width:120px;padding:20px;" /></a>
            <a href="http://939themountain.gcmaz.com"><img src="/media/flagstaff-radio-the-mountain.jpg" alt="Northern Arizona Radio - 93.9 The Mountain" style="max-width:90px;padding:20px;" /></a>
            <a href="http://magic991.gcmaz.com"><img src="/media/prescott-radio-magic.jpg" alt="Prescott Radio - Magic 99.1" style="max-width:120px;padding:20px;" /></a>
            <a href="http://hits106.gcmaz.com"><img src="/media/flagstaff-radio-hits-106.jpg" alt="Flagstaff Radio - Hits 106" style="max-width:90px;padding:20px;" /></a>
            <a href="http://country935.gcmaz.com"><img src="/media/flagstaff-radio-country-93-5.jpg" alt="Flagstaff Radio Country 93-5" style="max-width:90px;padding:20px;" /></a>
            <a href="http://eagle.gcmaz.com"><img src="/media/kzgl-logo-on-white.jpg" alt="103.7 The Eagle" style="max-width:80px;padding:20px;" /></a>
            <a href="http://funoldies.gcmaz.com"><img src="/media/prescott-radio-oldies.jpg" alt="Prescott Radio - Fun Oldies 100.9 1450am" style="max-width:100px;padding:20px;" /></a>
            <a href="http://gcmaz.com/kaff-news"><img src="/media/kaff-news.png" alt="KAFF News" style="max-width:120px;padding:20px;" /></a>
        ';
    }
}

// END

/*
 * GET Logged in User and Log out button
 */
function gcmaz_user_msg(){
    if ( is_user_logged_in() ) {
        $gcmaz_cur_user = wp_get_current_user();
        echo "<div class='gcmaz-user-msg'>Hi <a href='" . bp_loggedin_user_domain() . "' class='loginout-link'>" . $gcmaz_cur_user->user_firstname . "</a><br/><a href='" . wp_logout_url() . "' class='loginout-link'>Logout</a></div>";
    } else {
        echo "<div class='gcmaz-user-msg'><a href='" . wp_login_url( get_permalink() ) . "' class='loginout-link'>Login</a></div>";
    }
}
// END



/* disable ANNOYING sticky notices in admin (Yoast) */
// possibly hides legit notices, so not using
//remove_action( 'admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
//remove_action( 'all_admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );



// USE ONLY WHEN NEEDED
/* find registered widgets */
//global $wp_registered_widgets;
//
//function yoast_print_active_widgets() {
//    global $wp_registered_widgets;    
//    echo '<pre>'.print_r( $wp_registered_widgets, 1 ).'</pre>';
//}
//add_action('init','yoast_print_active_widgets');

/* use backtrace to trace errors */
//var_dump(debug_backtrace());

// END 
