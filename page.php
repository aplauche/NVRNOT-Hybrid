<?php get_header(); ?>

<div class="entry-content has-global-padding is-layout-constrained">
  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post(); ?>

      <?php the_content(); ?>

    <?php } // end while 
    ?>
  <?php } // end if
  ?>
</div>

<?php get_footer(); ?>