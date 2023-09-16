<?php 

function init_timber() {
    Timber::$dirname = 'templates';
    $context = Timber::context();

  if (!empty($_SERVER['QUERY_STRING'])) {
    $query_string = $_SERVER['QUERY_STRING'];

    $params = array();
    parse_str($query_string, $params);
  }

    $context['main_menu'] = new Timber\Menu('main-menu');
    $context['footer_menu'] = new Timber\Menu('footer-menu');
    $context['policy_menu'] = new Timber\Menu('policy-menu');
    // $context['social_media'] = get_field('social_media', 'option');
    $context['options'] = get_fields('options');
    return $context;
    
}

add_filter('timber/twig', 'add_to_twig');
function add_to_twig($twig) {
  $twig->addFunction(new Timber\Twig_Function('get_terms', 'get_terms'));
  $twig->addFunction(new Timber\Twig_Function('timber_set_product', 'timber_set_product'));
  $twig->addFunction(new Timber\Twig_Function('get_field', 'get_field'));
  $twig->addFunction(new Timber\Twig_Function('get_the_permalink', 'get_the_permalink'));
  $twig->addFunction(new Timber\Twig_Function('do_shortcode', 'do_shortcode'));
  $twig->addFunction(new Timber\Twig_Function('do_action', 'do_action'));
  $twig->addFunction(new Timber\Twig_Function('get_the_terms', 'get_the_terms'));
  $twig->addFunction(new Timber\Twig_Function('wc_get_product', 'wc_get_product'));
  $twig->addFunction(new Timber\Twig_Function('wp_get_attachment_image_src', 'wp_get_attachment_image_src'));
  $twig->addFunction(new Timber\Twig_Function('date_range', 'create_date_range_with_year'));
  $twig->addFunction(new Timber\Twig_Function('wp_get_attachment_caption', 'wp_get_attachment_caption'));
  $twig->addFunction(new Timber\Twig_Function('wpd_nav_menu_breadcrumbs', 'wpd_nav_menu_breadcrumbs'));
  $twig->addFunction(new Timber\Twig_Function('language_attributes', 'language_attributes'));
  $twig->addFunction(new Timber\Twig_Function('wp_get_attachment_caption', 'wp_get_attachment_caption'));
  $twig->addFunction(new Timber\Twig_Function('title_length_class', 'title_length_class'));
  $twig->addFunction(new Timber\Twig_Function('get_content_type', 'get_content_type'));
  $twig->addFunction(new Timber\Twig_Function('get_discount_percentage', 'get_discount_percentage'));
  
  

  return $twig;
}



?>