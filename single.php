<?php
// Template name: Post Page

defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();

$current = get_the_ID();

Timber::render('single-portfolio.twig', $context);