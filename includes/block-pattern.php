<?php

function my_custom_wp_block_patterns() {

register_block_pattern(
    'portfolio-template/my-custom-pattern',
    array(
        'title'       => __( 'Portfolio Template', 'portfolio-template' ),
        
        'description' => _x( 'Portfolio Template for Andringa Studio', 'Block pattern description', 'portfolio-template' ),
        
        'content'     => '<!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group"><!-- wp:columns -->
        <div class="wp-block-columns"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:paragraph -->
        <p></p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:image -->
        <figure class="wp-block-image"><img alt=""/></figure>
        <!-- /wp:image --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->
        
        <!-- wp:gallery {"linkTo":"none"} -->
        <figure class="wp-block-gallery has-nested-images columns-default is-cropped"></figure>
        <!-- /wp:gallery --></div>
        <!-- /wp:group -->',
        
        'categories'  => array('featured'),
    )
);

}    
add_action( 'init', 'my_custom_wp_block_patterns' );

?>