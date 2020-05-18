<?php get_header(); ?>


<div class="container content center">

    <section class="contact">

      <div class="contact-description">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <?php the_content(); ?>

        <?php endwhile; ?>
        <?php endif; ?>
      </div>




            <?php get_template_part('includes/form','enquiry'); ?>

        <span><?php echo get_option('admin_email') ?></span>
    </section>


</div>


<?php get_footer(); ?>
