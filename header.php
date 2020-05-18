<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?> | <?php echo get_the_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portrait photographer based in Tallinn, Estonia. Portreefotograaf kes teguteb Tallinnas.">

    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/photograph.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/photograph.png" type="image/x-icon" />
    <?php wp_head(); ?>

  </head>
  <body>

    <div id="loading">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/loading.svg" alt="">
    </div>

    <nav>
      <div class="title">
        <a href="<?php echo get_site_url(); ?>">
            <h1>
              <span class="h1-span"><?php echo get_bloginfo('description'); ?></span>
              <span class="h1-big"><?php echo get_bloginfo('name'); ?></span>
            </h1>


        </a>
      </div>



      <?php

          wp_nav_menu(

              array(

                  'theme_location' => 'top-menu'

              )

          );

       ?>
    </nav>
