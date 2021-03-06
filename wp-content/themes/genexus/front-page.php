<?php

// Content Area
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'page_loop' );


function page_loop(){

    global $post;
    global $paged;
    ?>

    <div class="front-page-wrap">

        <div class="home-top">

            <div class="slider-c2a">
                <section class="slider-wrap">
                <?php
                    //display home page content

                    // get slug of home page in case someone changes permalink - which breaks the following fn's that rely on it
                    $hp_slug = $post->post_name;
                    
                    $home_post_args = array(
                        'post_type' => 'page',
                        'pagename' => $hp_slug,
                    );
                    $hp_query = new WP_Query( $home_post_args );
                    if( $hp_query->have_posts() ){
                        while ( $hp_query->have_posts() ) {
                            $hp_query->the_post();
                            the_content();
                        }
                    }
                 ?>
                 </section>
            </div>

            <?php
                /* Restore original Post Data */
                wp_reset_postdata();
            ?>

            <div class="home-local">
                <section class="home-headlines">

                    <div class="local-headlines-hdr">
                        <div class="hdr-txt">
                            Upcoming Events
                        </div>
                    </div>

                    <?php
                        $todays_date = date('Ymd');

                        $local_query = new WP_Query( array(
                            'post_type' => 'gcmaz-event',
                            'meta_query' => array(
                                array(
                                    'key' => 'event_start_date_comp',
                                    'value' => $todays_date,
                                    'type' => 'numeric',
                                    'compare' => '>=',
                                ),
                            ),
                            'orderby' => array(
                                //'post_date' => 'DESC',
                                'event_start_date_comp' => 'ASC',
                            ),
                            'posts_per_page' => 5,
                            'no_found_rows' => true, //decr overhead when pagination not used
                            'update_post_term_cache' => false, //decs overhead when taxonomy not used
                        ));

                        // show the query sql
                        //echo "<li style='color:white;'>" . $local_query->request . "</li>";

                    ?>

                    <?php if( $local_query->have_posts() ) : ?>

                        <ul>
                            <?php //$displayed_posts = 0; //count to show total of 5?>

                            <?php while( $local_query->have_posts() ) : $local_query->the_post(); ?>

                                <li><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title(); ?></a></li>

                            <?php endwhile;?>
                        </ul>

                    <?php else: ?>
                        <div class="">
                            <p>No Posts Found</p>
                        </div>
                    <?php endif;?>


                    <?php
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    ?>

                </section>
            </div>

        </div>

        <div class="home-stations">

            <section class="stations-hdr">
                <h1>Serving Northern Arizona</h1>
                <p>With the best radio stations and news coverage in the area!</p>
            </section>

            <div class="kaff-block station-tile">
                <div class="logo-block">
                    <a href="https://kaff.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/images/kaff-logo.png" alt="92.9 KAFF Country" class="kaff-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kaff btns-hide">
                    <div class="block-btn-web">
                        <a href="https://kaff.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36581" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="kmgn-block station-tile">
                <div class="logo-block">
                    <a href="https://939themountain.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kmgn-logo.png" alt="93-9 The Mountain" class="kmgn-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kmgn btns-hide">
                    <div class="block-btn-web">
                        <a href="https://939themountain.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36601" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="kzgl-block station-tile">
                <div class="logo-block">
                    <a href="https://eagle.gcmaz.com/" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/eagle-square-whiteeagle.png" alt="The Eagle Rocks" class="kzgl-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kzgl btns-hide">
                    <div class="block-btn-web">
                        <a href="https://eagle.gcmaz.com/" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://eagle.gcmaz.com/kzgl-stream-player/" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>

            <div class="kfsz-block station-tile">
                <div class="logo-block">
                    <a href="https://hits106.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kfsz-logo.png" alt="Hits 106" class="kfsz-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kfsz btns-hide">
                    <div class="block-btn-web">
                        <a href="https://hits106.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36591" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="ktmg-block station-tile">
                <div class="logo-block">
                    <a href="https://magic991.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ktmg-logo.png" alt="Magic 99.1" class="ktmg-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-ktmg btns-hide">
                    <div class="block-btn-web">
                        <a href="https://magic991.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36621" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="kaffam-block station-tile">
                <div class="logo-block">
                    <a href="https://kafflegends.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kaffam-logo.png" alt="KAFF Legends 93-5 AM930" class="kaffam-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kaffam btns-hide">
                    <div class="block-btn-web">
                        <a href="https://kafflegends.gcmaz.com" target="_blank" class="logo-block-link" style="color:#28231e;">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36571" target="_blank" class="logo-block-link" style="color:#28231e;">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>

            <div class="knot-block station-tile">
                <div class="logo-block">
                    <a href="http://arizonashine.org" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/az-shine-logo.png" alt="Arizona Shine" class="knot-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-knot btns-hide">
                    <div class="block-btn-web">
                        <a href="http://arizonashine.org" target="_blank" class="logo-block-link" style="color:#00416a;">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://stream.arizonashine.org:8000/arizonashine.mp3.m3u" target="_blank" class="logo-block-link" style="color:#00416a;">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>

            <div class="kaffnews-block station-tile">
                <div class="logo-block">
                    <a href="http://gcmaz.com/kaff-news" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kaff-news-logo.png" alt="KAFF News of Northern Arizona" class="kaffnews-logo"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kaffnews btns-hide">
                    <div class="block-btn-web">
                        <a href="http://gcmaz.com/kaff-news" target="_blank" class="logo-block-link" style="color:#2d4a9f;">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        &nbsp;
                    </div>
                </div>
            </div>

            <div class="station-tile blank-tile"></div>
        
        </div>


    </div>

        
    <?php
}



// genesis child theme
genesis();
