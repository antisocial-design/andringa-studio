<?php

add_action('init', 'register_menus');

function register_menus()
{
    register_nav_menu('main-menu', 'Main Menu');
    register_nav_menu('footer-menu', 'Footer Menu');
    register_nav_menu('policy-menu', 'Policy Menu');
}

function theme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );

// show_admin_bar(false);
add_post_type_support('page', 'excerpt', 'post-thumbnails');
add_theme_support('post-thumbnails');

function load_theme_scripts_and_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', '', '');
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/tailwind/tailwind.css', '1.3', '');
    wp_enqueue_style('main-style-min', get_template_directory_uri() . '/dist/css/main.css', '1.3', '');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', '', '');
    wp_enqueue_script('slick', get_template_directory_uri() . '/src/js/slick.js', '', '');
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/src/js/fancybox.js', '', '', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/src/js/main.js', '', '1.4', true);
    // wp_enqueue_script('bundle', get_template_directory_uri() . '/dist/js/bundle.js' , '' , '1.0');
    // wp_enqueue_script('ajax', get_template_directory_uri() . '/src/js/ajax.js' , '' , '1.2', true);
}

add_action('wp_enqueue_scripts', 'load_theme_scripts_and_styles');

include 'includes/acfs.php';
// include 'includes/cpts.php';
include 'includes/taxonomies.php';
include 'includes/remove.php';
include 'includes/custom-styles.php';
include 'includes/admincolumns.php';
include 'includes/ajax.php';
include 'includes/block-pattern.php';

if (!is_admin()) {
    include 'includes/timber-init.php';
}

function imageTagForJs($response, $attachment)
{
    foreach ($response['sizes'] as $size => $datas) {
        $response['sizes'][$size]['tag'] = wp_get_attachment_image($attachment->ID, $size);
        $response['sizes'][$size]['srcset'] = wp_get_attachment_image_srcset($attachment->ID, $size);
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'imageTagForJs', 10, 2);

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(
        array(
            'page_title' => 'Footer',
            'menu_title' => 'Footer Settings',
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );

}


pll_register_string('andringa-studio', 'Ver Todos');
pll_register_string('andringa-studio', 'Contacts');
pll_register_string('andringa-studio', 'Other Suggestions');
pll_register_string('andringa-studio', 'Buy now');
pll_register_string('andringa-studio', 'new');

add_action('template_redirect', 'custom_cart_redirect');
function custom_cart_redirect()
{
    if (is_cart() && !is_wc_endpoint_url('order-received')) {
        wp_safe_redirect(wc_get_checkout_url());
        exit;
    }
}

function add_content_after_addtocart()
{

    // get the current post/product ID
    $current_product_id = get_the_ID();

    // get the product based on the ID
    $product = wc_get_product($current_product_id);

    // get the "Checkout Page" URL
    $checkout_url = WC()->cart->get_checkout_url();

    // run only on simple products
    if ($product->is_type('simple')) {
        echo '<a href="' . $checkout_url . '?add-to-cart=' . $current_product_id . '" class="single_add_to_cart_button button alt direct_checkout">' . pll__('Buy now') . '</a>';
    }
}
add_action('woocommerce_after_add_to_cart_button', 'add_content_after_addtocart');


?>