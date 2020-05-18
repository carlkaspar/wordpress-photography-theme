<?php get_header(); ?>



    <div class="container">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <p class="gal-title"><?php the_title(); ?></p>


      <?php endwhile; ?>
      <?php endif; ?>

      <div class="content">




        <div id="flex-photos" class="lbox single-gal">


            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                  <?php the_content(); ?>

            <?php endwhile; ?>
            <?php endif; ?>


        </div>
      </div>



    </div>

<?php get_footer(); ?>
