<?php get_header(); ?>



<div class="container content center">

  

<div class="about-wrapper">
  <div class="about-gal">
    <?php
      // TO SHOW THE PAGE CONTENTS
      while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->

              <?php the_content(); ?>



      <?php
      endwhile; //resetting the page loop
      wp_reset_query(); //resetting the page query
      ?>
  </div>

  <div class="about">
    <?php
    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->

            <h2><?php the_field('heading'); ?></h2>
            <p><?php the_field('kirjeldus') ?></p>
            <p><?php the_field('description') ?></p>




    <?php
    endwhile; //resetting the page loop
    wp_reset_query(); //resetting the page query
    ?>
  </div>
</div>




</div>

<?php get_footer(); ?>
