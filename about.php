<?php
// Template name: About

defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();
$context['page'] = 'about';

$args = array(
    'post_type' => array('team'),
    'posts_per_page' => -1,
    'post_count' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
  );

  $context['team'] = Timber::get_posts( $args );

Timber::render('about.twig', $context);