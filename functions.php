<?php 

add_action('init', 'register_menus');

function register_menus(){
    register_nav_menu('main-menu', 'Main Menu');
    register_nav_menu('footer-menu', 'Footer Menu');
    register_nav_menu('policy-menu', 'Policy Menu');
}

// show_admin_bar(false);
add_post_type_support('page', 'excerpt', 'post-thumbnails');
add_theme_support( 'post-thumbnails' );

function load_theme_scripts_and_styles() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/dist/tailwind/tailwind.css' , '' , '');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', '', '');
    wp_enqueue_script('slick', get_template_directory_uri() . '/src/js/slick.js' , '' , '');
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/src/js/fancybox.js' , '' , '', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/src/js/main.js' , '' , '1.4', true);
    // wp_enqueue_script('bundle', get_template_directory_uri() . '/dist/js/bundle.js' , '' , '1.0');
    // wp_enqueue_script('ajax', get_template_directory_uri() . '/src/js/ajax.js' , '' , '1.2', true);
}

add_action('wp_enqueue_scripts', 'load_theme_scripts_and_styles');

include 'includes/acfs.php';
include 'includes/cpts.php';
include 'includes/taxonomies.php';
include 'includes/remove.php';
include 'includes/custom-styles.php';
include 'includes/admincolumns.php';
include 'includes/ajax.php';
include 'includes/block-pattern.php';

if(!is_admin()){
    include 'includes/timber-init.php';
}

function imageTagForJs( $response, $attachment ) {
    foreach ( $response['sizes'] as $size => $datas ) {
      $response['sizes'][$size]['tag']    = wp_get_attachment_image( $attachment->ID, $size );
      $response['sizes'][$size]['srcset'] = wp_get_attachment_image_srcset( $attachment->ID, $size );
    }
    return $response;
  }
add_filter( 'wp_prepare_attachment_for_js', 'imageTagForJs', 10, 2 );



?>