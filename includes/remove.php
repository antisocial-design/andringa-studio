<?php

/* Disable the emoji's  */

// function disable_emojis()
// {
//     remove_action('wp_head', 'print_emoji_detection_script', 7);
//     remove_action('admin_print_scripts', 'print_emoji_detection_script');
//     remove_action('wp_print_styles', 'print_emoji_styles');
//     remove_action('admin_print_styles', 'print_emoji_styles');
//     remove_filter('the_content_feed', 'wp_staticize_emoji');
//     remove_filter('comment_text_rss', 'wp_staticize_emoji');
//     remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
//     add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
// }
// add_action('init', 'disable_emojis');


/**
 * Filter out the tinymce emoji plugin.
 */
// function disable_emojis_tinymce($plugins)
// {
//     if (is_array($plugins)) {
//         return array_diff($plugins, array('wpemoji'));
//     } else {
//         return array();
//     }
// }

/* Disable Links to Image URL */
add_action('after_setup_theme', 'default_attachment_display_settings');
function default_attachment_display_settings()
{
    update_option('image_default_link_type', 'none');
}

/* Disable xmlrpc */
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', function ($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});
remove_action('wp_head', 'wlwmanifest_link');


/* Disable REST API */
add_filter('rest_authentication_errors', function ($result) {
    if (!empty($result)) {
        return $result;
    }
    if (!is_user_logged_in()) {
        return new WP_Error('rest_not_logged_in', 'You are not currently logged in.', array('status' => 401));
    }
    return $result;
});

/* Disable RSS */
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('template_redirect', 'rest_output_link_header', 11);

/* Remove Gutenberg Block Library CSS from loading on the frontend */
// function smartwp_remove_wp_block_library_css()
// {
//     wp_dequeue_style('wp-block-library');
//     wp_dequeue_style('wp-block-library-theme');
// }
// add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css');


function remove_unused_admin_menus()
{
    remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product');
}
add_action('admin_menu', 'remove_unused_admin_menus', 99);



// function remove_default_post_type_menu_bar($wp_admin_bar)
// {
//     $wp_admin_bar->remove_node('new-post');
// }
// add_action('admin_bar_menu', 'remove_default_post_type_menu_bar', 99);



function remove_draft_widget()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'remove_draft_widget', 99, 1);


//Remove JQuery migrate
add_action('wp_default_scripts', 'remove_jquery_migrate');
function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];

        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}

/**
 * Remove Comments
**/

 add_action('admin_init', function () {
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

add_filter('comments_array', '__return_empty_array', 10, 2);

add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/**
 * Templates and Page IDs without editor
 *
 */
function ea_disable_editor( $id = false ) {

	$excluded_templates = array(
		'contacts.php',
        'about.php',
        'index.php',
        'portfolio.php',
        'press.php'
	);

	$excluded_ids = array(
		// get_option( 'page_on_front' )
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( ea_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );

/**
 * Disable Classic Editor by template
 *
 */
function ea_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( ea_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_head', 'ea_disable_classic_editor' );

function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    if ($post_type === 'team') return false;
    return $current_status;
}


?>