<?php
/**
 * Daily Email Feed RSS template.
 * 
 * @package GCMAZ
 */

/*
    We use this custom feed template because
        - it has custom title and description that are used in the Aweber Email Blog Broadcast -> Daily Update
        - only loads the 10 most recent posts (lower overhead when being pinged)
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
		<title>KAFF News</title>
		<link><?php bloginfo_rss( 'url' ) ?></link>
		<description>Daily News for <?php echo date('D, M d, Y');?></description>
		<lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></lastBuildDate>
		<language><?php bloginfo_rss( 'language' ); ?></language>
		<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
		<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
		<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />

		<?php do_action( 'rss2_head' ); ?>
		
            <?php
                
                $args = array(
                    'post_type' => 'post',
                    'order' => 'DESC',
                    //'nopaging' => false,
                    'posts_per_page' => 10,
                    'no_found_rows' => true, //decr overhead when pagination not used
                );
                
                $the_query = new WP_Query($args);
            ?>


            <!-- Start loop -->
            <?php while( $the_query->have_posts()) : $the_query->the_post(); ?>

                    <item>
                        <title><?php the_title_rss(); ?></title>
                        <link><?php the_permalink_rss(); ?></link>
                        <guid isPermaLink="false"><?php the_guid(); ?></guid>
                        <author><?php the_author_meta('user_email'); echo "("; the_author(); echo ")"; ?></author>
                        <?php the_category_rss('rss2') ?>
                        <description><![CDATA[<?php the_excerpt_rss( 150, 2 ); ?>]]></description>
                        <content:encoded><![CDATA[<?php the_excerpt_rss( 150, 2 ); ?>]]></content:encoded>
                    </item>

            <?php endwhile; ?>
            
	</channel>
</rss>