<?php
// Template name: Press

defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();
$context['page'] = 'press';

$args = array(
    'post_type' => array('press'),
    'posts_per_page' => -1,
    'post_count' => -1,
    'post_status' => 'publish',
  );

$context['press'] = Timber::get_posts( $args );

Timber::render('press.twig', $context);