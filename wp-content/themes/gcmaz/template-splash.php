<?php
/*
Template Name: Splash Pages
*/
?>
<div class="centered row">
<?php if(has_post_thumbnail()){ the_post_thumbnail('full', array('class'=>'centered info-img img-responsive'));} ?>
<?php get_template_part('templates/content', 'page'); ?>
</div>