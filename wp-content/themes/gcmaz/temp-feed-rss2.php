<?php
/**
 * Template Name: Feeds Dated
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php
	/**
	 * Fires at the end of the RSS root to add namespaces.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_ns' );
	?>
>

<channel>
	<title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><?php bloginfo_rss( 'language' ); ?></language>
	<?php
	$duration = 'hourly';
	/**
	 * Filter how often to update the RSS feed.
	 *
	 * @since 2.1.0
	 *
	 * @param string $duration The update period.
	 *                         Default 'hourly'. Accepts 'hourly', 'daily', 'weekly', 'monthly', 'yearly'.
	 */
	?>
	<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
	<?php
	$frequency = '1';
	/**
	 * Filter the RSS update frequency.
	 *
	 * @since 2.1.0
	 *
	 * @param string $frequency An integer passed as a string representing the frequency
	 *                          of RSS updates within the update period. Default '1'.
	 */
	?>
	<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>   
	<?php
	/**
	 * Fires at the end of the RSS2 Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_head');
        
              // query the Whats Happening category
              $the_query = new WP_Query(array(
                'post_type' => 'whats-happening',
                'orderby' => 'meta_value',
                'meta_key' => 'whats_fulldate',
                //'order' => 'ASC',
                //'posts_per_page' => get_option('posts_per_page'),
                //'paged' => $paged,
                //'cat' => '23',
               ));
            
	while($the_query->have_posts()) : the_post();
	?>
        
              <?php
                // check our date - don't feed past date events
                //returns an array
                $expDate = get_post_custom_values('whats_fulldate');
                //$date2 = get_post_custom_values('community_date');
                //$date3 = get_post_custom_values('concert_date');
                /*if(isset($date1[0])){
                    $expDate = $date1[0];
                    //$expDate .= "11111111 ";
                    //print_r($expDate);
                }elseif(isset($date2[0])){
                    $expDate = $date2[0];
                    //$expDate .= "22222222 ";
                    //print_r($expDate);
                }elseif(isset($date3[0])){
                    $expDate = $date3[0];
                    //$expDate .= "3333333333 ";
                    //print_r($expDate);
                }else{
                    $expDate = null;
                    //$expDate .= "NULL ";
                    //print_r($expDate);
                }*/
                //echo $expDate . "---------------";
                //print_r($expDate);
              ?>
        
              <?php if(($expDate[0] == null) || (strtotime($expDate[0])) >= (strtotime('now'))) : ?>
        
	<item>
		<title><?php the_title_rss() ?></title>
		<link><?php the_permalink_rss() ?></link>
		<comments><?php comments_link_feed(); ?></comments>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                            <eventDate>
                                <?php
                                    // insert our custom field for date
                                    /*if(isset(get_post_custom_values('whats_date'))){
                                        $eventDate = get_post_custom_values('whats_date');
                                    }elseif(isset(get_post_custom_values('community_date'))){
                                        $eventDate = get_post_custom_values('community_date');
                                    }elseif(isset(get_post_custom_values('concert_date'))){
                                        $eventDate = get_post_custom_values('concert_date');
                                    }else{
                                        $eventDate = '';
                                    }
                                    echo $eventDate;*/
                                ?>
                            </eventDate>
		<dc:creator><![CDATA[<?php the_author() ?>]]></dc:creator>
		<?php the_category_rss('rss2') ?>

		<guid isPermaLink="false"><?php the_guid(); ?></guid>
<?php if (get_option('rss_use_excerpt')) : ?>
		<description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
<?php else : ?>
		<description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
	<?php $content = get_the_content_feed('rss2'); ?>
	<?php if ( strlen( $content ) > 0 ) : ?>
		<content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
	<?php else : ?>
		<content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>
	<?php endif; ?>
<?php endif; ?>
		<wfw:commentRss><?php echo esc_url( get_post_comments_feed_link(null, 'rss2') ); ?></wfw:commentRss>
		<slash:comments><?php echo get_comments_number(); ?></slash:comments>
<?php rss_enclosure(); ?>
	<?php
	/**
	 * Fires at the end of each RSS2 feed item.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_item' );
	?>
	</item>

              <?php endif; ?>

	<?php endwhile; ?>
</channel>
</rss>
