<?php
// Template name: 404

defined('ABSPATH') || exit;

$context = init_timber();

$context['customTitle'] = "404";

Timber::render('404.twig', $context);