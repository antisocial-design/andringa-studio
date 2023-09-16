<?php
// Template name: Post Page

defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();

$current = get_the_ID();

$args = array(
    'post_type' => array('product'),
    'posts_per_page' => -1,
    'post_count' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
  );

$context['products'] = Timber::get_posts( $args );

$taxonomy = 'product_cat';
$context['category'] = Timber::get_terms($taxonomy);


Timber::render('shop.twig', $context);