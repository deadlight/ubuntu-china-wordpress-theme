<?php

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

function add_topics() {
	// Add new "topic" taxonomy to Posts
	register_taxonomy('topic',array('whitepaper', 'ebook', 'post', 'video', 'attachment', 'casestudy', 'infographic', 'productbusinesscard', 'webinar', 'event', 'case-study', 'presskits', 'promo'), array(
		'hierarchical' => true,
		'show_admin_column' => true,
		'labels' => array(
			'name' => _x( 'Topic', 'taxonomy general name' ),
			'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search topics' ),
			'all_items' => __( 'All topics' ),
			'parent_item' => __( 'Parent topics' ),
			'parent_item_colon' => __( 'Parent asset type:' ),
			'edit_item' => __( 'Edit asset type' ),
			'update_item' => __( 'Update asset type' ),
			'add_new_item' => __( 'Add new topic' ),
			'new_item_name' => __( 'New topic name' ),
			'menu_name' => __( 'Topics' ),
			'menu_position' => 6
		),
		'rewrite' => array(
			'slug' => 'topic', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_topics', 0 );

/*function add_audience() {
	// Add new "products-and-services" taxonomy to Posts
	register_taxonomy('audience',array('ebooks','post','checklists','event','webiinar','whitepaper','glossary', 'news', 'casestudy'), array(
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Audience', 'taxonomy general name' ),
			'singular_name' => _x( 'Audience', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search audiences' ),
			'all_items' => __( 'All audiences' ),
			'parent_item' => __( 'Parent audiences' ),
			'parent_item_colon' => __( 'Parent audience:' ),
			'edit_item' => __( 'Edit audience' ),
			'update_item' => __( 'Update audience' ),
			'add_new_item' => __( 'Add new audience' ),
			'new_item_name' => __( 'New audience name' ),
			'menu_name' => __( 'Audience' ),
			'menu_position' => 6
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'audiencess', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_audience', 0 ); */

?>