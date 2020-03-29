<?php

namespace ProductAddon;

class Frontend {

	public function __construct() {

	    add_action('woocommerce_before_add_to_cart_button', [ $this, 'before_add_to_cart_button' ], 10 );
	    add_filter('woocommerce_add_cart_item_data', [ $this, 'add_cart_item_data' ], 10, 3);
	    // add_filter('woocommerce_add_to_cart_validation', [ $this, 'add_to_cart_validation' ], 10, 3);
	    // add_action('woocommerce_single_product_summary', [ $this, 'check_if_product_has_set_price' ], 30);
     //    add_filter('woocommerce_product_add_to_cart_url', [ $this, 'add_to_cart_url' ], 20, 2);
     //    add_filter('woocommerce_product_add_to_cart_text', [ $this, 'add_to_cart_text' ], 10, 2);

	    add_filter( 'woocommerce_is_purchasable', [ $this,'filter_is_purchasable' ], 10, 2 );


	    add_filter( 'woocommerce_get_item_data', [ $this, 'add_item_meta' ],10,2);
	    add_action( 'woocommerce_before_calculate_totals', [ $this, 'before_calculate_totals' ], 10, 1 );

     //    add_filter('woocommerce_order_item_display_meta_value', [ $this, 'display_meta_value' ], 10, 3);
     //    add_action('woocommerce_checkout_order_processed', [ $this, 'checkout_order_processed' ], 10, 3);
     //    add_filter('woocommerce_get_item_data', [ $this, 'get_item_data' ], 10, 2);
        add_action( 'woocommerce_checkout_create_order_line_item', [ $this, 'checkout_create_order_line_item' ], 10, 4);
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

	public function before_add_to_cart_button() {

		global $product;

	?>
	<div>
		<label> My Weight </label>
		<input type="text" name="robo_customer_weight" />
		<label> My Height </label>
		<input type="text" name="robo_customer_height" />
		<label> <input type="checkbox" name="robo_pocket" value="1"> Pocket (10)</label>
	</div>
		
	<?php
	}

	public function add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {

		if( isset( $_REQUEST['robo_customer_weight'] ) ) {
			$cart_item_data['robo_customer_weight'] = $_REQUEST['robo_customer_weight'];
		}

		if( isset( $_REQUEST['robo_customer_height'] ) ) {
			$cart_item_data['robo_customer_height'] = $_REQUEST['robo_customer_height'];
		}

		if( ! empty( $_POST['robo_pocket'] ) ) {
			$product = wc_get_product( $product_id );
			$price = $product->get_price();
			$cart_item_data['robo_pocket'] = $_REQUEST['robo_pocket'];
			$cart_item_data['custom_price'] = $price + 10;
		}

		return $cart_item_data;
	}

	public function add_item_meta( $item_data, $cart_item ) {

		if( array_key_exists( 'robo_customer_weight', $cart_item ) ) {
        	$robo_customer_weight = $cart_item['robo_customer_weight'];

	        $item_data[] = array(
	            'key'   => 'robo_customer_weight',
	            'value' => $robo_customer_weight
	        );
	    }

	    if( array_key_exists( 'robo_customer_height', $cart_item ) ) {
        	$robo_customer_height = $cart_item['robo_customer_height'];

	        $item_data[] = array(
	            'key'   => 'robo_customer_height',
	            'value' => $robo_customer_height
	        );
	    }


	    if( array_key_exists( 'robo_pocket', $cart_item ) ) {
        	$robo_pocket = $cart_item['robo_pocket'];

	        $item_data[] = array(
	            'key'   => 'robo_pocket',
	            'value' => $robo_pocket
	        );
	    }


		return $item_data;
	}

	public function checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {

		if( array_key_exists( 'robo_customer_weight', $values ) ){
        	$item->add_meta_data('robo_customer_weight',$values['robo_customer_weight']);
    	}

    	if( array_key_exists( 'robo_customer_height', $values ) ){
        	$item->add_meta_data('robo_customer_height',$values['robo_customer_height']);
    	}

    	if( array_key_exists( 'robo_pocket', $values ) ){
        	$item->add_meta_data('robo_pocket',$values['robo_pocket']);
    	}
	}

	public function before_calculate_totals( $cart_obj ) {
	  if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
	    return;
	  }
	  // Iterate through each cart item
	  foreach( $cart_obj->get_cart() as $key=>$value ) {
	    if( isset( $value['custom_price'] ) ) {
	      $price = $value['custom_price'];
	      $value['data']->set_price( ( $price ) );
	    }
	  }
	}

	public function filter_is_purchasable(  $is_purchasable, $product ) {
		if( is_archive() ) {
			return false;
		}
		return $is_purchasable;
	}
}