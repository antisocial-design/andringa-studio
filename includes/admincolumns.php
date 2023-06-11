<?php

function add_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
      'starting_date' => __ ( 'Start Date' ),
      'end_date'   => __ ( 'End Date' ) ,
    ) );
  }
  add_filter ( 'manage_ad_posts_columns', 'add_acf_columns' );

  function ad_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'starting_date':
        // echo get_post_meta ( $post_id, 'starting_date', true );
        $format_in = 'Ymd';
        $format_out = 'm/d/Y';
        $date = DateTime::createFromFormat($format_in, get_post_meta ( $post_id, 'starting_date', true ));
        echo $date->format( $format_out );

        break;
      case 'end_date':
        // echo get_post_meta ( $post_id, 'end_date', true );
        $format_in = 'Ymd';
        $format_out = 'm/d/Y';
        $date = DateTime::createFromFormat($format_in, get_post_meta ( $post_id, 'end_date', true ));
        echo $date->format( $format_out );
        break;
    }
    
 }
 add_action ( 'manage_ad_posts_custom_column', 'ad_custom_column', 10, 2 );

 function my_column_register_sortable( $columns ) {
	$columns['starting_date'] = 'starting_date';
	$columns['end_date'] = 'end_date';
	return $columns;
}
add_filter('manage_edit-ad_sortable_columns', 'my_column_register_sortable' );

add_filter('manage_post_posts_columns', function ( $columns ) {
    unset($columns['comments']);
    return $columns;
});

add_filter('manage_ad_posts_columns', function ( $columns ) {
    unset($columns['date']);
    return $columns;
});

?>