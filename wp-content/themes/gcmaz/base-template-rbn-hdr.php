<?php get_template_part('templates/head'); ?>
<body <?php body_class(''); ?> >
  <!--[if lt IE 8]><div class="alert alert-warning"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <?php
    // display the Page Take Over if it's enabled
    do_action('display_ptko');
  ?>
    
  <div class="innerbg wrap container" role="document">
        <div class="row row1">
            <section class="col-md-4">
                <a href="/" >
                    <img class="size-full wp-image-31 centered logo" alt="Great Circle Media of Arizona" src="/media/logo-gcmaz.png"/>
                </a>
            </section>
            <section class="col-md-8">
                <?php  get_template_part('templates/exp-leaderboard'); ?>
                <?php  // get_template_part('templates/listen-live'); ?>
            </section>
        </div>
        <div class="content row">
          <div class="main <?php echo roots_main_class(); ?>" role="main">
                <?php include roots_template_path(); ?>
          </div><!-- /.main -->
          <?php if (roots_display_sidebar()) : ?>
            <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
                <?php //(wrapped in php comment to hide)<div class="hidden-xs studio-sponsor">?>
                    <?php //echo adrotate_group(14);?>
                <?php //</div>?>
              <?php include roots_sidebar_path(); ?>
            </aside><!-- /.sidebar -->
          <?php endif; ?>
        </div><!-- /.content -->
</div><!-- /.wrap -->
  <?php get_template_part('templates/footer'); ?>

</body>
</html>