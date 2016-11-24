<?php

    global $post;

    // USER ICON & DROPDOWN
    if ( is_user_logged_in() ) {

        // ===== LOGGED IN =====
        $our_cur_user = wp_get_current_user();
        //$our_user_name = $our_cur_user->user_firstname;
        $our_user_name = $our_cur_user->user_nicename;
        
        //get user profile link (if buddypress active it's different)
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if( is_plugin_active('buddypress/bp-loader.php')){
            //buddypress
            $our_login_link = bp_loggedin_user_domain();
        } else {
            //default wp
            $our_login_link = get_edit_user_link( $our_cur_user->ID );
        }
        

        echo '
            <div class="user-nav" title="Account">
                <a class="icon-user">
                    <i class="fa fa-user"></i>
                </a>

                <ul class="dropdown hide-me">
                  <li><a href="' . wp_logout_url() . '" title="Logout">Logout</a></li>
                  <li><a href="' . $our_login_link . '" title="Profile">' . $our_user_name . '</a></li>
                </ul>

            </div>
            ';

    } else {

        // ===== NOT LOGGED IN =====
        echo '
            <div class="user-nav" title="Login">
                <a href="' . wp_login_url( get_permalink() ) . '" class="icon-user">
                    <i class="fa fa-user"></i>
                </a>
            </div>';

    } // END USER



    // SEARCH ICON & DROPDOWN
    ?>
        <div class="search-nav">
            <a class="icon-search" title="Search">
                <i class="fa fa-search"></i>
            </a>
        </div>
    <?php



    // NON-KAFF NEWS
    if( !empty( $post ) ){

        if( $post->post_name === 'kaff-news' || in_category( get_news_cats() ) ) {
            // dont' show this
        } else {

        ?>
            <div class="nau-nav">
                <a class="icon-nau" title="NAU Broadcast Partner">
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/nau-icon.png">
                </a>

                <ul class="dropdown hide-me">
                  <li><a href="/nau-athletics" title="NAU Broadcast Partner">NAU Broadcast Partner</a></li>
                  <li><a href="/nau-lumberjacks-football" title="NAU Lumberjacks Football Schedule">Lumberjacks Football Schedule</a></li>
                  <li><a href="/nau-basketball-schedule" title="NAU Basketball Schedule">Basketball Schedule</a></li>
                </ul>

            </div>
        <?php

        }

    }




    // KAFF NEWS
    // (checks and displays KAFF News social icons on kaff news pages)
    if( !empty( $post ) ){

        if( $post->post_name === 'kaff-news' || in_category( get_news_cats() ) ) {
        ?>
        
            <a href="https://www.facebook.com/NewsOnKAFF" target="_blank" class="icon-fb" title="KAFF News Facebook">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="https://twitter.com/kaffnews" target="_blank" class="icon-tw" title="KAFF News Twitter">
                <i class="fa fa-twitter"></i>
            </a>
        
        <?php
        }

    }




    // MOBILE NAV BTN
    // shows on sm screens (< md-screen) when regular nav hides
    ?>
    <button type="button" class="mobile-nav-btn js-menu-trigger">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
    <?php


