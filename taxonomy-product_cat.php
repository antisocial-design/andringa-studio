<?php
// Template name: Taxonomy Page

defined('ABSPATH') || exit;

$context = Timber::context();
$context['post'] = new Timber\Post();

$current_term = get_queried_object();

$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $current_term->term_id,
        ),
    ),
);

$context['products'] = Timber::get_posts($args);

Timber::render('producttax.twig', $context);