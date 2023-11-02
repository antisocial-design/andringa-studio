<?php
defined('ABSPATH') || exit;
$context = Timber::context();
$context = init_timber();
$context['post'] = new Timber\Post();

if (is_product_category()) {
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['category'] = get_term($term_id, 'product_cat');
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
                'terms' => $term_id,
            ),
        ),
    );

    $context['products'] = Timber::get_posts($args);

    Timber::render('templates/archive.twig', $context);
} else if (is_singular('product')) {
    $product = wc_get_product(get_the_ID());

    $args = array(
        'post_type' => array('product'),
        'posts_per_page' => 3,
        'post_count' => 3,
        'post_status' => 'publish',
        'orderby' => 'rand',
        'order' => 'rand',
        'post__not_in' => array(get_the_ID()),
    );

    $context['related'] = Timber::get_posts($args);

    if ($product->is_type('variable')) {
        $product = new WC_Product_Variable(get_the_ID());
        $show_variation_price = apply_filters('woocommerce_show_variation_price', $product->get_price() === '' || $product->get_variation_sale_price('min') !== $product->get_variation_sale_price('max') || $product->get_variation_regular_price('min') !== $product->get_variation_regular_price('max'), $product);
        $context['variable_price_range'] = $show_variation_price;
    }

    $context['page'] = 'product';
    $context['post'] = new Timber\Post();
    $context['product'] = $product;
    $context['related_items'] = $related_items;
    $context['archive_link'] = get_the_permalink(6);

    Timber::render('single-product.twig', $context);
}


