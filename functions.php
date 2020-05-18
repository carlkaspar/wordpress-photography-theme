<?php


// Load css
function load_css()
{

      wp_register_style('lightbox', get_template_directory_uri() . '/css/lightbox.min.css', array(), false, 'all');
      wp_enqueue_style('lightbox');

      wp_register_style('fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css', array(), false, 'all');
      wp_enqueue_style('fancybox');

      wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
      wp_enqueue_style('main');

}
add_action('wp_enqueue_scripts', 'load_css');


// Load javascript
function load_js()
{

      wp_enqueue_script('jquery');



      wp_register_script('lazy', get_template_directory_uri() . '/js/lazysizes.min.js', 'jquery', false, true);
      wp_enqueue_script('lazy');

      wp_register_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', 'jquery', false, true);
      wp_enqueue_script('lightbox');

      wp_register_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', 'jquery', false, true);
      wp_enqueue_script('fancybox');

      wp_register_script('main', get_template_directory_uri() . '/js/main.js', 'jquery', false, true);
      wp_enqueue_script('main');
}
add_action('wp_enqueue_scripts', 'load_js');


// Theme Options
add_theme_support('menus');


// menus
register_nav_menus(

      array(

          'top-menu' => 'Top Menu Location',
          'mobile-menu' => 'Mobile Menu Location',

      )

);


// Photos Post type
function photos_post_type()
{

      $args = array(
        'labels' => array(
            'name' => 'Photos',
            'singular_name' => 'Photo',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-camera-alt',
        'has_archive' => false,
        'supports' => array('title', 'editor', 'thumbnail'),
      );

      register_post_type('photos', $args);

}
add_action('init', 'photos_post_type');



// Photos tax
function photos_taxonomy()
{
        $args = array(
                'public' => true,
                'hierarchical' => true
        );

        register_taxonomy('photos', array('photos'), $args);
}
add_action('init', 'photos_taxonomy');


// Add the filter to manage the p tags
add_filter( 'the_content', 'wti_remove_autop_for_image', 0 );

function wti_remove_autop_for_image( $content )
{
     global $post;

     // Check for single page and image post type and remove
     if ( is_single() && $post->post_type == 'photos' )
          remove_filter('the_content', 'wpautop');

     return $content;
}


// add theme support : post thumbnails
add_theme_support( 'post-thumbnails' );


// Add fields to WP General
add_filter('admin_init', 'my_general_settings_register_fields');

function my_general_settings_register_fields()
{
    register_setting('general', 'copyright', 'esc_attr');
    add_settings_field('copyright', '<label for="copyright">'.__('Copyright' , 'copyright' ).'</label>' , 'my_general_settings_fields_html', 'general');

    register_setting('general', 'instagram', 'esc_attr');
    add_settings_field('instagram', '<label for="instagram">'.__('Instagram' , 'instagram' ).'</label>' , 'my_general_settings_fields_html_insta', 'general');

    register_setting('general', 'facebook', 'esc_attr');
    add_settings_field('facebook', '<label for="facebook">'.__('Facebook' , 'facebook' ).'</label>' , 'my_general_settings_fields_html_facebook', 'general');


}

function my_general_settings_fields_html()
{
    $value = get_option( 'copyright', '' );
    echo '<input type="text" id="copyright" name="copyright" value="' . $value . '" />';
}

function my_general_settings_fields_html_insta()
{
    $value = get_option( 'instagram', '' );
    echo '<input type="text" id="instagram" name="instagram" value="' . $value . '" />';
}

function my_general_settings_fields_html_facebook()
{
    $value = get_option( 'facebook', '' );
    echo '<input type="text" id="facebook" name="facebook" value="' . $value . '" />';
}

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'gallery_thumb', 340 );
}

add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
        $addsizes = array(
                "gallery_thumb" => __( "Gallery Image Size" )
                );
        $newsizes = array_merge($sizes, $addsizes);
        return $newsizes;
}

add_action( 'after_setup_theme', 'setup_thumbnails' );
function setup_thumbnails() {
  add_image_size( 'front_page_thumb', 85, 117, true);
  add_image_size( 'front_page_thumb-1x', 340, 468 , true ); //(cropped)
  add_image_size( 'front_page_thumb-2x', 680, 935 , true );
  add_image_size( 'front_page_thumb-3x', 1360, 1870 , true );
  add_image_size( 'gal_thumb-low', 85, 0);
  add_image_size( 'gal_thumb', 340, 0);
  add_image_size( 'gal_thumb-2x', 680, 0);
  add_image_size( 'gal_thumb-3x', 1360, 0);
}



function srcset_post_thumbnail( $post_id )
{
  $size = "front_page_thumb";
  $small = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size);
  $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size . '-1x');
  $thumbnail_2x = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size . '-2x' );
  $thumbnail_3x = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size . '-3x' );


  $image = sprintf('<a href="%s"', esc_attr(get_post_permalink($post_id)));
  $image .= sprintf(' data-imgh="%s"', esc_attr($thumbnail[2]));
  $image .= sprintf(' data-imgw="%s">', esc_attr($thumbnail[1]));
  $image .= '<div class="img-container">';
  $image .= '<img src="' . $thumbnail[0] . '"';
  $image .= ' srcset="' . $small[0] . '"';
  $image .= ' data-srcset="' . $thumbnail[0] . ' 1x, ';
  $image .= $thumbnail_2x[0] . ' 2x, ';
  $image .= $thumbnail_3x[0] . ' 3x"';
  $image .= ' alt="' . get_bloginfo('title') . ' photography | ' . get_the_title() . '"';
  $image .= ' data-sizes="auto"';
  $image .= ' class=" blur-up" />';
  $image .= '</div></a>';


  return $image;
}

function custom_gal_srcset( $sources, $size_array, $image_src, $image_meta, $attachment_id )
{

  $size = "gal_thumb";
  $thumbnail = wp_get_attachment_image_src( $attachment_id, $size)[0];
  $thumbnail_2x = wp_get_attachment_image_src( $attachment_id, $size . '-2x')[0];
  $thumbnail_3x = wp_get_attachment_image_src( $attachment_id, $size . '-3x')[0];


// srcset val


      $sources[0] = array
      (
        'url'        => $thumbnail,
        'descriptor' => 'x',
        'value'      => 1

      );
      $sources[1] = array
      (
        'url'        => $thumbnail_2x,
        'descriptor' => 'x',
        'value'      => 2

      );

      $sources[2] = array
      (
        'url'        => $thumbnail_3x,
        'descriptor' => 'x',
        'value'      => 3

      );






      return $sources;
}

function custom_gal_img_sizes($size, $image_src, $image_meta,$attachment_id)
{
  $size = 'auto';
  return $size;
}
// Remove the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false' );
add_filter( 'wp_calculate_image_srcset', '__return_false' );
//add_filter('wp_calculate_image_srcset', 'custom_gal_srcset', 10, 5);
add_filter( 'wp_calculate_image_sizes', 'custom_gal_img_sizes' , 10, 4);




// add data-attr to gallery links
function filter_image_send_to_editor($html, $id, $caption, $title, $align, $url, $size, $alt) {

  if( $id > 0 ){




        $img_attr = wp_get_attachment_image_src($id, 'full'); // get media full size url
        $linked_img = wp_get_attachment_image_src($id, 'gal_thumb-low');
        $img_1x = wp_get_attachment_image_src($id, 'gal_thumb');
        $img_2x = wp_get_attachment_image_src($id, 'gal_thumb-2x');
        $img_3x = wp_get_attachment_image_src($id, 'gal_thumb-3x');
        if($img_attr) {
          $html = sprintf('<a href="%s" ', esc_attr($url));
          $html .= sprintf('data-imgw="%s"', esc_attr($img_1x[1]));
          $html .= sprintf(' data-imgh="%s"', esc_attr($img_1x[2]));
          $html .= sprintf(' data-width="%s"', esc_attr($img_attr[1]));
          $html .= sprintf(' data-height="%s">', esc_attr($img_attr[2]));
          $html .= sprintf('<img src="%s"', esc_attr($img_1x[0]));
          $html .= sprintf(' srcset="%s"', esc_attr($linked_img[0]));
          $html .= sprintf(' data-srcset="%s 1x,', esc_attr($img_1x[0]));
          $html .= sprintf(' %s 2x,', esc_attr($img_2x[0]));
          $html .= sprintf(' %s 3x"', esc_attr($img_3x[0]));
          $html .= ' data-sizes="auto"';
          $html .= sprintf(' class="align%s', esc_attr($align));
          $html .= ' lazyload blur-up';
          $html .= sprintf(' size-%s', esc_attr($size));
          $html .= sprintf(' wp-image-%s" /></a>', esc_attr($id));
        }

    }
    return $html;

}

add_filter('image_send_to_editor', 'filter_image_send_to_editor', 10, 8);

// Form action
add_action('wp_ajax_enquiry', 'enquiry_form');
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');
function enquiry_form()
{
  if ( !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce') )
  {

    wp_send_json_error('Nonce is incorrect', 401);
    die();

  }


  $formdata = [];

  wp_parse_str($_POST['enquiry'], $formdata);


  //admin Email
  $admin_email = get_option('admin_email');

  //headers
  $headers[] = 'Content-Type: text/html; charset=UTF-8';
  $headers[] = 'From:' . $admin_email;
  $headers[] = 'Reply-to:' . $formdata['email'];

  //who are we sending the email to
  $send_to = $admin_email;

  //subject
  $subject = "Enquiry from " . $formdata['fname'] . ' ' . $formdata['lname'];

  //Message

  /*
  $message = '';

  foreach ($formdata as $index => $field)
  {
      $message .= '<strong>' . $index . '</strong>: ' . $field . '<br />';
  }
  */

  $message = $formdata['enquiry'];


  try {

    if( wp_mail($send_to, $subject, $message, $headers))
    {

        wp_send_json_success('Email sent!');

    }
    else {
        wp_send_json_error('Email error!');
    }

  } catch (Exception $e)
  {
        wp_send_json_error($e -> getMessage());
  }


}
