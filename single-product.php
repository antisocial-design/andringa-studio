<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$context = init_timber();

$product = wc_get_product(get_the_ID());

$related = $product->get_upsell_ids();

if($related && count($related) < 4){

    $per_page = (int) 4 - count($related);

    $excludes = $related;
    array_push($excludes, get_the_ID());

    $extra_posts = get_posts([
        'post_type' => 'product',
        'post__not_in' => $excludes,
        'numberposts' => $per_page,
        'post_status' => 'publish',
        'orderby' => 'rand',
        'fields' => 'ids'
    ]);

    foreach($extra_posts as $extra_post){
        array_push($related, $extra_post);
    }
    
    $filled_related = get_posts([
        'post_type' => 'product',
        'numberposts' => 4,
        'post_status' => 'publish',
        'orderby' => 'rand',
        'post__not_in' => array(get_the_ID()),
        'post__in' => $related,
    ]);

    $related_items = $filled_related;

}elseif($related && count($related) >= 4){
    $related_items = $related; 
}else{
    $related_items = get_posts(['post_type' => 'product',
        'posts_per_page' => 4,
        'post_status' => 'publish',
        'orderby' => 'rand',
        'post__not_in' => array(get_the_ID()),
    ]);
}

if($product->is_type('variable')){
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

