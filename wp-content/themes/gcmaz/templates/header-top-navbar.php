<header class="header-wrap" role="banner">
    
    <div class="container pre-navbar">
        <a href="/" title="Great Circle Media">
            <img src="/media/gcm-logo-white.png" alt="Great Circle Media" class="logo-pre-navbar"/>
        </a>
        
        <?php get_template_part('templates/navbar-icons'); ?>

        <div class="navbar-search navbar-icons">
            <div class="searchbox-nav searchbox-hide">
                <form role="search" method="get" class="search-form form-inline hidden" action="<?php echo home_url('/'); ?>">
                  <div class="input-group">
                      <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
                    <label class="hide"><?php _e('Search for:', 'roots'); ?></label>
                    <span class="input-group-btn">
                      <button type="submit" class="search-submit btn btn-default"><?php _e('<span class="glyphicon glyphicon-search"></span>', 'roots'); ?></button>
                    </span>
                  </div>
                </form>
            </div>
            
            <a class="searchbox-toggle">
              <span class="glyphicon glyphicon-search"></span>
            </a>
        </div>



    </div>
    
    <div class="banner navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" border="0">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <nav class="collapse navbar-collapse" role="navigation">
              <?php
                if (has_nav_menu('primary_navigation')) :
                  wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
                endif;
              ?>
            </nav>
        </div>
    </div>
    
</header>