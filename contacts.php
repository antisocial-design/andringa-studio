<?php
// Template name: Contacts

defined('ABSPATH') || exit;

$context = init_timber();
$context['post'] = new Timber\Post();
$context['page'] = 'contacts';

Timber::render('contacts.twig', $context);