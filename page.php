<?php
defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();

Timber::render('page.twig', $context);