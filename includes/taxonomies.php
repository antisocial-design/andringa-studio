<?php

add_action( 'init', function() {
	register_taxonomy( 'work_cat', array(
		0 => 'work',
	), array(
		'labels' => array(
			'name' => 'Categories',
			'singular_name' => 'Category',
			'menu_name' => 'Category',
			'all_items' => 'All Category',
			'edit_item' => 'Edit Category',
			'view_item' => 'View Category',
			'update_item' => 'Update Category',
			'add_new_item' => 'Add New Category',
			'new_item_name' => 'New Category Name',
			'search_items' => 'Search Category',
			'popular_items' => 'Popular Category',
			'separate_items_with_commas' => 'Separate category with commas',
			'add_or_remove_items' => 'Add or remove category',
			'choose_from_most_used' => 'Choose from the most used category',
			'not_found' => 'No category found',
			'no_terms' => 'No category',
			'items_list_navigation' => 'Category list navigation',
			'items_list' => 'Category list',
			'back_to_items' => '← Go to category',
			'item_link' => 'Category Link',
			'item_link_description' => 'A link to a category',
		),
		'public' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
	) );
} );



?>