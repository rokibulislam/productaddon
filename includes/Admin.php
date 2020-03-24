<?php

namespace ProductAddon;

class Admin {

	public function __construct() {
		 // Register post
		 add_action( 'init', [ $this, 'register_type_forms' ], 10, 1 );
		 // Add Meta Box
		 add_action( 'add_meta_boxes', [ $this, 'add_metabox'  ] );
         add_action( 'save_post', [ $this, 'save_metabox' ], 10, 2 );

         // order
        add_filter('woocommerce_order_item_display_meta_value', [ $this, 'order_item_display_meta_value' ], 10, 1 );
        add_action('woocommerce_before_order_itemmeta', [ $this, 'order_item_line_item_html' ], 10, 3);
        add_action('woocommerce_before_save_order_items', [ $this, 'before_save_order_items' ], 10, 2);
        add_action('woocommerce_order_item_get_formatted_meta_data', [ $this, 'order_item_get_formatted_meta_data' ], 10, 2);
        add_filter('manage_product_posts_columns', [ $this, 'manage_products_columns' ], 20, 1);
        add_action('manage_product_posts_custom_column', [ $this, 'manage_products_column' ], 10, 2);
	}

	public static function init() {
		static $instance = false;

		if( !$instance ) {
			$instance = new self();
		}

		return $instance;
	}

	public function add_metabox() {
		add_meta_box(
            'product-form-meta',
            __( 'Product Form Meta', 'textdomain' ),
            [  $this, 'render_metabox' ],
            'product_forms'
        );
	}

	public function render_metabox() {

	}

	public function save_metabox( $post_id, $post ) {

	}

	public function order_item_display_meta_value( $meta_value ) {

		return $meta_value;
	}

	public function order_item_line_item_html( $item_id, $item, $order ) {

	}

	public function before_save_order_items( $order_id, $items ) {

	}

	public function order_item_get_formatted_meta_data( $formatted_meta, $item ) {

		return $formatted_meta;
	}

	public function manage_products_columns( $columns ) {

		return $columns;
	}

	public function manage_products_column( $column_name, $post_id ) {

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
					'title'
				),
			);

			register_post_type( 'product_forms', $args );
	}
}