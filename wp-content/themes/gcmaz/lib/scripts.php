<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.min.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.10.2.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.6.2.min.js
 * 3. /theme/assets/js/main.min.js (in footer)
 */
function roots_scripts() {
  wp_enqueue_style('roots_main', get_template_directory_uri() . '/assets/css/main.min.css', false, 'c842fb21c87679c43efc04a52386cec0');
  wp_enqueue_style('nivo-slider', get_template_directory_uri() . '/assets/js/nivo-slider/nivo-slider.css', false, null);

  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', false, null, false);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.6.2.min.js', false, null, false);
  wp_register_script('roots_scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', false, 'e691c1155845b9519d0a6d78f660a98a', true);
  wp_enqueue_script('modernizr');
  wp_enqueue_script('jquery');
  wp_enqueue_script('roots_scripts');
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function roots_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/vendor/jquery-1.10.2.min.js"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'roots_jquery_local_fallback');

function roots_google_analytics() { ?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');
  <?php
        // add tracking for KAFF News
        // see if we're on KAFF News anywhere
        global $post;
        if( !empty( $post ) ){
            
            $array_of_news_cats = check_current_category_for_news();
            $c = get_the_category();
            $kaffNews = false;
            if( $c ){
                //check if the category or parent category is News
                // convert to array
                $c_array = object_to_array($c);
                if( $c_array[0]['term_id'] ){
                    //if set
                    if( in_array( $c_array[0]['term_id'], $array_of_news_cats ) ){
                        //if current cat is in news cats
                        $kaffNews = true;
                    }
                }
            }

            if( $post->post_name == 'kaff-news' || $kaffNews == true) {
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

<?php }
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
  add_action('wp_footer', 'roots_google_analytics', 20);
}
