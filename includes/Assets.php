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

	}

	public function register_frontend_scripts() {

	}
}