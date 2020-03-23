<?php

namespace ProductAddon;

class Assets {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_frontend_scripts' ] );
	}

	public static function init() {
		static $instance = false;

		if( !$instance ) {
			$instance = new self();
		}

		return $instance;
	}

	public function register_admin_scripts() {
		wp_register_style( 'product_addon_admin_css', ADDON_ASSET_URI . '/js/admin.css', false,  ADDON_VERSION );
		wp_enqueue_script( 'product_addon_admin_css' );

		wp_register_script( 'product_addon_admin_js', ADDON_ASSET_URI . '/js/admin.js', ['jquery'],  ADDON_VERSION, true );
		wp_enqueue_script( 'product_addon_admin_js' );
	}

	public function register_frontend_scripts() {
		wp_register_style( 'product_addon_frontend_css', ADDON_ASSET_URI . '/js/frontend.css', false,  ADDON_VERSION );
		wp_enqueue_script( 'product_addon_frontend_css' );

		wp_register_script( 'product_addon_frontend_js', ADDON_ASSET_URI . '/js/frontend.js', ['jquery'],  ADDON_VERSION, true );
		wp_enqueue_script( 'product_addon_frontend_js' );
	}
}