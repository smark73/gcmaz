<?php
/**
 * Community RSS template.
 * 
 * @package GCMAZ
 */

/**
 * Feed defaults.
 */
header( 'Content-Type: ' . feed_content_type( 'rss-http' ) . '; charset=' . get_option( 'blog_charset' ), true );
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
		<title>Northern Arizona Community Info</title>
		<link><?php bloginfo_rss( 'url' ) ?></link>
		<description>Northern Arizona Community Info - Great Circle Media</description>
		<lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></lastBuildDate>
		<language><?php bloginfo_rss( 'language' ); ?></language>
		<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
		<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
		<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />

		<?php do_action( 'rss2_head' ); ?>
		
                            <?php
                                // query the Community Info category
                                $the_query = new WP_Query(array(
                                  'post_type' => 'community-info',
                                  'orderby' => 'meta_value',
                                  'meta_key' => 'community_fulldate',
                                  'order' => 'ASC',
                                 ));
                            ?>
                            <!-- Start loop -->
		<?php while( $the_query->have_posts()) : $the_query->the_post(); ?>
                                <?php
                                    // check custom date to see if its past date
                                    $expDate = get_post_custom_values('community_fulldate');
                                    if(($expDate[0] == null) || (strtotime($expDate[0])) >= (strtotime('now'))) :
                                ?>
                                <?php
                                    // get pertinent data and attach it to content variable
                                    $content = get_the_content_feed('rss2');
                                    
                                    $eDate = get_post_custom_values('community_date');
                                    $eventDate = $eDate[0];
                                    $content = '<span class="archv-date pull-right red">' . $eventDate . '</span>' . $content;
                                    
                                    if(has_post_thumbnail()) {
                                        $postimages = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                                        $postimage = $postimages[0];
                                        $imgTag = '<img src="' . $postimage . '" class="feed-img" align="left"/>';
                                        $content = $imgTag . $content;
                                    }

                                ?>

			<item>
				<title><?php the_title_rss(); ?></title>
				<link><?php the_permalink_rss(); ?></link>
				<guid isPermaLink="false"><?php the_guid(); ?></guid>
				<author><?php the_author(); ?></author>
                                		<?php the_category_rss('rss2') ?>
                                                        
                                                        <?php if (get_option('rss_use_excerpt')) : ?>
                                                                        <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
                                                        <?php else : ?>
                                                                        <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>

                                                                <?php if ( strlen( $content ) > 0 ) : ?>
                                                                        <content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
                                                                <?php else : ?>
                                                                        <content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>
                                                                <?php endif; ?>
                                                        <?php endif; ?>

			</item>
                            
                                <?php endif; ?>
		<?php endwhile; ?>
	</channel>
</rss>