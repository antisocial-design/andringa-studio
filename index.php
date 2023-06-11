<?php
// Template name: Homepage

defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();
$context['page'] = 'homepage';

// $context['has_ads'] = true;
// $context['top_ads'] = true;
// $context['bottom_ads'] = true;

Timber::render('homepage.twig', $context);