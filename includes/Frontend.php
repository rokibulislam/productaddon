<?php

namespace ProductAddon;

class Frontend {

	public function __construct() {

	    // add_action('woocommerce_before_add_to_cart_button', [ $this, 'before_add_to_cart_button' ], 10);
	    // add_filter('woocommerce_add_cart_item_data', [ $this, 'add_cart_item_data' ], 10, 3);
	    // add_filter('woocommerce_add_to_cart_validation', [ $this, 'add_to_cart_validation' ], 10, 3);
	    // add_action('woocommerce_single_product_summary', [ $this, 'check_if_product_has_set_price' ], 30);
     //    add_filter('woocommerce_product_add_to_cart_url', [ $this, 'add_to_cart_url' ], 20, 2);
     //    add_filter('woocommerce_product_add_to_cart_text', [ $this, 'add_to_cart_text' ], 10, 2);


     //    add_filter('woocommerce_order_item_display_meta_value', [ $this, 'display_meta_value' ], 10, 3);
     //    add_action('woocommerce_checkout_order_processed', [ $this, 'checkout_order_processed' ], 10, 3);
     //    add_filter('woocommerce_get_item_data', [ $this, 'get_item_data' ], 10, 2);
     //    add_action('woocommerce_checkout_create_order_line_item', [ $this, 'checkout_create_order_line_item' ], 10, 3);
     //    add_filter('woocommerce_order_again_cart_item_data', [ $this, 'order_again_cart_item_data' ], 50, 3);
     //    add_action('woocommerce_order_item_get_formatted_meta_data', [ $this, 'order_item_get_formatted_meta_data' ], 10, 2);
	}

	public static function init() {
		static $instance = false;

		if( !$instance ) {
			$instance = new self();
		}

		return $instance;
	}
}