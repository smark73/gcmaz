<?php
/**
 * Events Feed RSS template.
 * 
 * @package GCMAZ
 */

/**
 * Feed defaults.
 */
//header( 'Content-Type: ' . feed_content_type( 'rss-http' ) . '; charset=' . get_option( 'blog_charset' ), true );
header( 'Content-Type: application/rss+xml' . '; charset=' . get_option( 'blog_charset' ), true );
$frequency  = 1;        // Default '1'. The frequency of RSS updates within the update period.
$duration   = 'hourly'; // Default 'hourly'. Accepts 'hourly', 'daily', 'weekly', 'monthly', 'yearly'.

/**
 * Start RSS feed.
 */
echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?' . '>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php do_action( 'rss2_ns' ); ?>
>

  <!-- RSS feed defaults -->
	<channel>
		<title>Local Event Listings</title>
		<link><?php bloginfo_rss( 'url' ) ?></link>
		<description>Northern Arizona Events and Happenings - Great Circle Media</description>
		<lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></lastBuildDate>
		<language><?php bloginfo_rss( 'language' ); ?></language>
		<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
		<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
		<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />

		<?php do_action( 'rss2_head' ); ?>
		
            <?php
                //store the global post object temporarily and restore it after while loop
                $temp_post = $post;
                
                // get today
                $todays_date = date('Ymd');
                
                // query the Event CPT
                $args = array(

                    'post_type' => 'gcmaz-event',
                    'meta_key' => 'event_start_date_comp',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'posts_per_page' => 100,
                    'nopaging' => true,
                    'meta_query' => array(
                        //start and end dates
                        //'relation' => 'AND',
                        array(
                            // end date is >= todays date OR ..
                            'relation' => 'OR',
                            array(
                                'key' => 'event_end_date_comp',
                                'value' => $todays_date,
                                'type' => 'numeric',
                                'compare' => '>=',
                            ),
                            // end date is null AND ...
                            array(
                                'relation' => 'AND',
                                array(
                                    'key' => 'event_end_date_comp',
                                    'value' => null,
                                    'compare' => '=',
                                ),
                                // start date is >= todays date OR default 20000101
                                array(
                                    'relation' => 'OR',
                                    array(
                                        'key' => 'event_start_date_comp',
                                        'value' => $todays_date,
                                        'type' => 'numeric',
                                        'compare' => '>=',
                                    ),
                                    array(
                                        'key' => 'event_start_date_comp',
                                        'value' => '20000101',
                                        //'type' => 'numeric',
                                        'compare' => '=',
                                    ),
                                ),
                            ),
                        ),
                    ),
                );
                
                $the_query = new WP_Query($args);
            ?>

            <!-- Start loop -->
            <?php while( $the_query->have_posts()) : $the_query->the_post(); ?>
                            
                <?php
                    // check if in "Hide Post" category
                    if( !in_category( array( 'hide-post', 'Hide Post' ) ) ) :
                ?>

                    <?php
                        // get pertinent data and attach it to content variable
                        $content = get_the_content_feed( 'rss2' );

                        //$content = strip_tags( $content );
                        // shorten_and_strip_html( string, length )
                        $content = shorten_and_strip_html( $content, '350' );


                        $e_start_date = get_post_custom_values( 'event_start_date' );
                        $e_end_date = get_post_custom_values( 'event_end_date' );
                        
                        $event_start_date = $e_start_date[0];
                        $event_end_date = $e_end_date[0];
                        
                        if( $event_end_date ){
                            //if we have an end date, add it
                            $event_date = $event_start_date . " - " . $event_end_date;
                        } else {
                            $event_date = $event_start_date;
                        }
                        
                        $content = '<p class="listdate red">' . $event_date . '</p>' . $content;

                        if( has_post_thumbnail() ) {
                            $postimages = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                            $postimage = $postimages[0];
                            $imgTag = '<img src="' . $postimage . '" class="feed-img" align="right"/>';
                            $content = $imgTag . $content;
                        }

                    ?>

                    <item>
                        <title><?php the_title_rss(); ?></title>
                        <link><?php the_permalink_rss(); ?></link>
                        <guid isPermaLink="false"><?php the_guid(); ?></guid>
                        <author><?php the_author_meta('user_email'); echo "("; the_author(); echo ")"; ?></author>
                        <?php the_category_rss('rss2') ?>

                        <?php if (get_option('rss_use_excerpt')) : ?>
                            <?php // set to use excerpts instead of content ?>
                            <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>

                        <?php else : ?>

                            <?php //using content ?>
                            <?php //fill desc with excerpt ?>
                            <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>

                            <?php if ( strlen( $content ) > 0 ) : ?>
                                <?php //the content to show, if exists ?>
                                <content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>

                            <?php else : ?>
                                <?php //if no content, use excerpt ?>
                                <content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>

                            <?php endif; ?>
                            
                        <?php endif; ?>

                    </item>

                <?php endif; ?>

            <?php endwhile; ?>

            <?php
                // restore the global post object
                $post = $temp_post;
            ?>
            
	</channel>
</rss>