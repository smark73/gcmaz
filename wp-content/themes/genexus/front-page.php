<?php


// Content Area
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'page_loop' );


function page_loop(){
    ?>

    <div class="front-page-wrap">

        <div class="home-top">

            <div class="slider-c2a">
                <section class="slider-wrap">
                <?php
                    //display home page content
                    global $post;
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
                            //global $post;
                            the_content();
                        }
                    }
                 ?>
                 </section>
            </div>

            <div class="home-news">
                <section class="news-headlines">

                    <a href="/kaff-news" class="kaff-news-link">
                        <div class="news-headlines-hdr">
                            <div class="news-hdr-txt bree">
                                KAFF News <span class="red">Posts</span>
                            </div>
                            <div class="news-hdr-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </a>

                    <?php
                        //save WP post object
                        $save_post = $post;

                        $featured_query = new WP_Query(array(
                            'category_name' => 'featured',
                            'posts_per_page' => 5,
                        ));
                    ?>

                    <?php if($featured_query->have_posts()) : ?>

                        <ul>
                            <?php while($featured_query->have_posts()) : $featured_query->the_post(); ?>
                                <li><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title(); ?></a></li>
                            <?php endwhile;?>
                        </ul>

                        <?php
                            // restore WP post object
                            $post = $save_post;
                        ?>

                    <?php else: ?>
                        <div class="">
                            <p>KAFF News Feed Not Found</p>
                        </div>
                    <?php endif;?>

                </section>

            </div>

        </div> <!--home-top-->

        <div class="ad-spot" style="width:90%;margin:50px auto;text-align:center;background:#ccc;height:100px;">
            <p>banner ad spot (and page takeover)</p>
        </div>

        <div class="home-stations">

            <section class="stations-hdr">
                <h1>Serving Northern Arizona</h1>
                <p>With the best radio stations and news coverage in the area!</p>
            </section>

            <div class="kaff-block station-tile">
                <div class="logo-block">
                    <a href="http://kaff.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/images/kaff-logo.png" alt="92.9 KAFF Country" class="kaff-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kaff blockBtnKaff block-btn-hide blockBtnKaff">
                    <div class="block-btn-web" blockBtnKaff>
                        <a href="http://kaff.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36581" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="kmgn-block station-tile">
                <div class="logo-block">
                    <a href="http://939themountain.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kmgn-logo.png" alt="93-9 The Mountain" class="kmgn-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kmgn blockBtnKmgn block-btn-hide">
                    <div class="block-btn-web">
                        <a href="http://939themountain.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36601" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="kzgl-block station-tile">
                <div class="logo-block">
                    <a href="http://eagle.gcmaz.com/" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kzgl-logo.png" alt="103.7 The Eagle Rocks" class="kzgl-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kzgl block-btn-hide">
                    <div class="block-btn-web">
                        <a href="http://eagle.gcmaz.com/" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://eagle.gcmaz.com/kzgl-stream-player/" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>

            <div class="kfsz-block station-tile">
                <div class="logo-block">
                    <a href="http://hits106.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kfsz-logo.png" alt="Hits 106" class="kfsz-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kfsz block-btn-hide">
                    <div class="block-btn-web">
                        <a href="http://hits106.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36591" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="ktmg-block station-tile">
                <div class="logo-block">
                    <a href="http://magic991.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ktmg-logo.png" alt="Magic 99.1" class="ktmg-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-ktmg block-btn-hide">
                    <div class="block-btn-web">
                        <a href="http://magic991.gcmaz.com" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36621" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>
            
            <div class="kaffam-block station-tile">
                <div class="logo-block">
                    <a href="http://kafflegends.gcmaz.com" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kaffam-logo.png" alt="KAFF Legends 93-5 AM930" class="kaffam-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kaffam block-btn-hide">
                    <div class="block-btn-web">
                        <a href="http://kafflegends.gcmaz.com" target="_blank" class="logo-block-link" style="color:#28231e;">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://player.listenlive.co/36571" target="_blank" class="logo-block-link" style="color:#28231e;">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>

            <div class="e979-block station-tile">
                <div class="logo-block">
                    <a href="http://979theeagle.gcmaz.com/" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/97-9-logo.png" alt="97.9 The Eagle Rocks" class="e979-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-e979 block-btn-hide">
                    <div class="block-btn-web">
                        <a href="http://979theeagle.gcmaz.com/" target="_blank" class="logo-block-link">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        <a href="http://979theeagle.gcmaz.com/stream-player/" target="_blank" class="logo-block-link">LISTEN<div class="spkr-icon"><i class="fa fa-volume-up"></i></div></a>
                    </div>
                </div>
            </div>

            <div class="knot-block station-tile">
                <div class="logo-block">
                    <a href="http://arizonashine.org" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/az-shine-logo.png" alt="Arizona Shine" class="knot-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-knot block-btn-hide">
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
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kaff-news-logo.png" alt="KAFF News of Northern Arizona" class="kaffnews-logo img-responsive centered"/>
                    </a>
                </div>
                <div class="block-btns block-btn-kaffnews block-btn-hide">
                    <div class="block-btn-web">
                        <a href="http://gcmaz.com/kaff-news" target="_blank" class="logo-block-link" style="color:#2d4a9f;">WEBSITE</a>
                    </div>
                    <div class="block-btn-listen">
                        &nbsp;
                    </div>
                </div>
            </div>
        
        </div>

        <div class="ad-spot" style="width:90%;margin:50px auto;text-align:center;background:#ccc;height:100px;">
            <p>banner ad spot (and page takeover)</p>
        </div>

    </div>

        
    <?php
}



// genesis child theme
genesis();