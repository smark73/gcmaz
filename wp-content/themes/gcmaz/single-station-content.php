<div class="in-cnt-wrp row">
    <div class="centered rbn-hdg">
        <?php get_template_part('templates/page', 'header'); ?>
    </div>
    <?php while (have_posts()) : the_post(); ?>
      <article <?php post_class('sngl-info'); ?>>

        <header>
            <h3 class='entry-title blue'><?php the_title(); ?></h3>
        </header>
          
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
          
        <footer>
        </footer>

      </article>
    <?php endwhile; ?>
</div>

<button type="button" class="btn btn-default" onclick="goBack()" style="margin:20px 0;">Go Back</button>
<script>
    function goBack() {
        window.history.back();
    }
</script>