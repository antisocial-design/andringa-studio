<?php
// Template name: Portfolio

defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();
$context['page'] = 'portfolio';

$args = array(
    'post_type' => array('work'),
    'posts_per_page' => -1,
    'post_count' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
  );

$context['portfolio'] = Timber::get_posts( $args );

$taxonomy = 'work_cat';
$context['category'] = Timber::get_terms($taxonomy);

Timber::render('portfolio.twig', $context);