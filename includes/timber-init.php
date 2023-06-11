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

    $today = date('Ymd');

    $args = array(
      'post_type'      => 'ad',
      'post_count'     => 1,
      'post_status'    => 'publish',
      'meta_query'     => array(
          'relation' => 'AND',
          array(
              'key'     => 'starting_date',
              'value'   => $today,
              'compare' => '<=',
              'type'    => 'DATE',
          ),
          array(
              'key'     => 'end_date',
              'value'   => $today,
              'compare' => '>=',
              'type'    => 'DATE',
          ),
      ),
      'orderby'        => 'meta_value',
      'order'          => 'ASC',
  );  

    $context['ads'] = Timber::get_posts( $args );

    return $context;
}

?>