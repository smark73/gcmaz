<div class="row news-top-nav" role="navigation">
    <div class="col-md-12 hidden-xs hidden-sm">
        <?php
            // reg screen sizes
            if (has_nav_menu('news_navigation')) :
                wp_nav_menu(array('theme_location' => 'news_navigation', 'menu_class' => 'nav nav-tabs nav-justified'));
            endif;
        ?>
    </div>
    <div class="col-md-12 hidden-md hidden-lg">
        <?php
            // sm screen sizes dont give justified class to prevent vertical menu
            if (has_nav_menu('news_navigation')) :
                wp_nav_menu(array('theme_location' => 'news_navigation', 'menu_class' => 'nav nav-tabs'));
            endif;
        ?>
    </div>
</div>