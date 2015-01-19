<div class="in-cnt-wrp row">
    <section class="row">
        <div class="rbn-hdg">
            <div class="page-header">
            <h4>Information About The Author</h4>
            </div>
        </div>

        <!-- This sets the $curauth variable -->
        <?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
            <div class="author-details">
                <h2 class="red"><?php echo $curauth->nickname; ?></h2>
                <dl>
                    <?php if(isset($curauth->facebook) && !empty($curauth->facebook)) : ?>
                    <div class="row">
                        <dt class="col-md-3 col-sm-3">Facebook:</dt>
                        <?php
                            //check for valid url
                            if(filter_var($curauth->facebook, FILTER_VALIDATE_URL) !== false){
                                $fb_url = $curauth->facebook;
                            } else {
                                $fb_url = "https://facebook.com/" . $curauth->facebook ;
                            }
                        ?>
                        <dd class="col-md-9 col-sm-9"><a href="<?php echo esc_url($fb_url);?>" target="_blank"><?php echo $curauth->facebook; ?></a></dd>
                    </div>
                    <?php endif;?>
                    <?php if(isset($curauth->twitter) && !empty($curauth->twitter)) : ?>
                    <div class="row">
                        <dt class="col-md-3 col-sm-3">Twitter:</dt>
                        <?php
                            //check for valid url
                            if(filter_var($curauth->twitter, FILTER_VALIDATE_URL) !== false){
                                $tw_url = $curauth->twitter;
                            } else {
                                $tw_url = "https://twitter.com/" . $curauth->twitter ;
                            }
                        ?>
                        <dd class="col-md-9 col-sm-9"><a href="<?php echo esc_url($tw_url);?>" target="_blank"><?php echo $curauth->twitter; ?></a></dd>
                    </div>
                    <?php endif;?>
                    <?php if(isset($curauth->googleplus) && !empty($curauth->googleplus)) : ?>
                    <div class="row">
                        <dt class="col-md-3 col-sm-3">Google+:</dt>
                        <?php
                            //check for valid url
                            if(filter_var($curauth->googleplus, FILTER_VALIDATE_URL) !== false){
                                $gp_url = $curauth->googleplus;
                            } else {
                                $gp_url = "https://plus.google.com/" . $curauth->googleplus ;
                            }
                        ?>
                        <dd class="col-md-9 col-sm-9"><a href="<?php echo esc_url($gp_url); ?>" target="_blank"><?php echo $curauth->googleplus; ?></a></dd>
                    </div>
                    <?php endif;?>
                    <?php if(isset($curauth->user_url) && !empty($curauth->user_url)) : ?>
                    <div class="row">
                        <dt class="col-md-3 col-sm-3">Website:</dt>
                        <?php
                            //check for valid url
                            if(filter_var($curauth->user_url, FILTER_VALIDATE_URL) !== false){
                                $user_url = $curauth->user_url;
                            } else {
                                $user_url = "http://" . $curauth->user_url ;
                            }
                        ?>
                        <dd class="col-md-9 col-sm-9"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><?php echo $curauth->user_url; ?></a></dd>
                    </div>
                    <?php endif;?>
                    <?php if(isset($curauth->user_description) && !empty($curauth->user_description)) : ?>
                    <div class="row">
                        <dt class="col-md-12">Profile:</dt>
                        <dd class="col-md-12"><?php echo $curauth->user_description; ?></dd>
                    </div>
                    <?php endif;?>
                </dl>
            <div class="author-details">

            <p style="font-size:1em;font-weight:600">Recent Posts by <?php echo $curauth->nickname; ?>:</p>

            <ul class="author-recent-posts">
                <!-- The Loop -->
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                        <?php the_title(); ?></a>
                        <span style="font-size:0.8em"> | <?php the_time('d M Y'); ?></span>
                    </li>
                    <?php endwhile; else: ?>
                    <p><?php _e('No posts by this author.'); ?></p>
                <?php endif; ?>
                <!-- End Loop -->
            </ul>

    </section>
</div>