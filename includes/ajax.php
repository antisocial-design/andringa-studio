<?php

function filter_posts() {

  $tag = sanitize_text_field($_POST['tag']);
  $category = sanitize_text_field($_POST['cat']);

  $ajaxposts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 18,
    'order' => 'DESC',
    'orderby' => 'date',
    'post_status' => 'publish',
    'tax_query' => [
        'relation' => 'AND',
        [
            'taxonomy' => 'post_tag',
            'field' => 'slug',
            'terms' => $tag,
        ],
        [
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $category,
        ],
    ],
  ]);

  $response = '';

  if ($ajaxposts->have_posts()) {
    while ($ajaxposts->have_posts()) {
      $ajaxposts->the_post();
      $context['post'] = new Timber\Post();
      $response .= Timber::compile('templates/loop/post.twig', $context);
    }
  } else {
    $response = Timber::render('templates/loop/no-posts.twig');
  }

  echo $response;
  wp_die();
}

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

?>