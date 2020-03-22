<?php

namespace ProductAddon;

class Admin {

	public function __construct() {
		 add_action( 'init', [ $this, 'register_type_forms' ], 10, 1 );
	}

	public static function init() {
		static $instance = false;

		if( !$instance ) {
			$instance = new self();
		}

		return $instance;
	}

	public function register_type_forms() {
			$labels = array(
				'name'               => __( 'Product Form', 'text-domain' ),
				'singular_name'      => __( 'Product Form', 'text-domain' ),
				'add_new'            => _x( 'Add New Product Form', 'text-domain', 'text-domain' ),
				'add_new_item'       => __( 'Add New Product Form', 'text-domain' ),
				'edit_item'          => __( 'Edit Product Form', 'text-domain' ),
				'new_item'           => __( 'New Product Form', 'text-domain' ),
				'view_item'          => __( 'View Product Form', 'text-domain' ),
				'search_items'       => __( 'Search Product Form', 'text-domain' ),
				'not_found'          => __( 'No Product Form found', 'text-domain' ),
				'not_found_in_trash' => __( 'No Product Form found in Trash', 'text-domain' ),
				'parent_item_colon'  => __( 'Parent Product Form:', 'text-domain' ),
				'menu_name'          => __( 'Product Form', 'text-domain' ),
			);

			$args = array(
				'labels'              => $labels,
				'hierarchical'        => false,
				'description'         => 'description',
				'taxonomies'          => array(),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' 		  => 'edit.php?post_type=product',
				'show_in_admin_bar'   => true,
				'menu_position'       => null,
				'menu_icon'           => null,
				'show_in_nav_menus'   => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'has_archive'         => true,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite'             => true,
				'capability_type'     => 'post',
				'supports'            => array(
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'custom-fields',
					'trackbacks',
					'comments',
					'revisions',
					'page-attributes',
					'post-formats',
				),
			);

			register_post_type( 'product_forms', $args );
	}
}