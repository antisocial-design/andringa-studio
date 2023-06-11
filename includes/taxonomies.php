<?php
add_action( 'init', function() {
	register_taxonomy( 'season', array(
		0 => 'post',
	), array(
		'labels' => array(
			'name' => 'Seasons',
			'singular_name' => 'Season',
			'menu_name' => 'Seasons',
			'all_items' => 'All Seasons',
			'edit_item' => 'Edit Season',
			'view_item' => 'View Season',
			'update_item' => 'Update Season',
			'add_new_item' => 'Add New Season',
			'new_item_name' => 'New Season Name',
			'search_items' => 'Search Seasons',
			'popular_items' => 'Popular Seasons',
			'separate_items_with_commas' => 'Separate seasons with commas',
			'add_or_remove_items' => 'Add or remove seasons',
			'choose_from_most_used' => 'Choose from the most used seasons',
			'not_found' => 'No seasons found',
			'no_terms' => 'No seasons',
			'items_list_navigation' => 'Seasons list navigation',
			'items_list' => 'Seasons list',
			'back_to_items' => '← Go to seasons',
			'item_link' => 'Season Link',
			'item_link_description' => 'A link to a season',
		),
		'public' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
	) );
} );


?>