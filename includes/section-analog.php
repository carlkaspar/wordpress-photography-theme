<section id="flex-photos">
  <?php



          $args = array(
            'post_type'   => 'photos',
            'post_status' => 'publish',
            'tax_query'   => array(
              array(
                'taxonomy' => 'photos',
                'field'    => 'slug',
                'terms'    => 'analog'
              )
            )
           );




          $photos = new WP_Query( $args );


          if( $photos->have_posts() ) :


    ?>

                  <?php  while( $photos->have_posts() ) :  $photos->the_post();  ?>


                          <?php echo srcset_post_thumbnail(get_the_ID()); ?>



                  <?php endwhile; wp_reset_postdata(); ?>

    <?php endif; ?>
</section>
