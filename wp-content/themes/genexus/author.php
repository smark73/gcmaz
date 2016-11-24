<?php

// Content Area
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'page_loop' );




function page_loop() {

    global $post;
    global $paged;

    // This sets the $curauth variable 
    //$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

    $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

    //$curauth = get_the_author();

    ?>

    <div class="author-page">

        <section>

            <div class="author-details">

                <h2 class="author-name">About <?php echo $curauth->first_name . ' ' . $curauth->last_name ; ?></h2>

                <dl>

                    <?php if(isset($curauth->user_description) && !empty($curauth->user_description)) : ?>

                            <dt>Profile:</dt>
                            <dd><?php echo $curauth->user_description; ?></dd>
                            <br>

                    <?php endif;?>

                    <?php if(isset($curauth->facebook) && !empty($curauth->facebook)) : ?>

                            <dt>Facebook:</dt>
                            <?php
                                //check for valid url
                                if(filter_var($curauth->facebook, FILTER_VALIDATE_URL) !== false){
                                    $fb_url = $curauth->facebook;
                                } else {
                                    $fb_url = "https://facebook.com/" . $curauth->facebook ;
                                }
                            ?>
                            <dd><a href="<?php echo esc_url($fb_url);?>" target="_blank"><?php echo $curauth->facebook; ?></a></dd>

                    <?php endif;?>

                    <?php if(isset($curauth->twitter) && !empty($curauth->twitter)) : ?>

                            <dt>Twitter:</dt>
                            <?php
                                //check for valid url
                                if(filter_var($curauth->twitter, FILTER_VALIDATE_URL) !== false){
                                    $tw_url = $curauth->twitter;
                                } else {
                                    $tw_url = "https://twitter.com/" . $curauth->twitter ;
                                }
                            ?>
                            <dd><a href="<?php echo esc_url($tw_url);?>" target="_blank"><?php echo $curauth->twitter; ?></a></dd>
 
                    <?php endif;?>

                    <?php if(isset($curauth->googleplus) && !empty($curauth->googleplus)) : ?>

                            <dt>Google+:</dt>
                            <?php
                                //check for valid url
                                if(filter_var($curauth->googleplus, FILTER_VALIDATE_URL) !== false){
                                    $gp_url = $curauth->googleplus;
                                } else {
                                    $gp_url = "https://plus.google.com/" . $curauth->googleplus ;
                                }
                            ?>
                            <dd><a href="<?php echo esc_url($gp_url); ?>" target="_blank"><?php echo $curauth->googleplus; ?></a></dd>

                    <?php endif;?>

                    <?php if(isset($curauth->user_url) && !empty($curauth->user_url)) : ?>

                            <dt>Website:</dt>
                            <?php
                                //check for valid url
                                if(filter_var($curauth->user_url, FILTER_VALIDATE_URL) !== false){
                                    $user_url = $curauth->user_url;
                                } else {
                                    $user_url = "http://" . $curauth->user_url ;
                                }
                            ?>
                            <dd><a href="<?php echo esc_url($user_url); ?>" target="_blank"><?php echo $curauth->user_url; ?></a></dd>

                    <?php endif;?>

                </dl>
            </div>

            <div class="author-recent-posts">
                <p>Recent Posts by <?php echo $curauth->nickname; ?>:</p>
                <ul>

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <li>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                            <?php the_title(); ?></a>
                            <span> (Posted: <?php the_time('d M Y'); ?>)</span>
                        </li>
                        <?php endwhile; else: ?>
                        <p><?php _e('No posts by this author.'); ?></p>

                    <?php endif; ?>

                </ul>
            </div>

        </section>
    </div>


    <?php
}

// genesis child theme
genesis();