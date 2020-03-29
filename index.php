<?php

/**
 * Plugin Name: Product Addon
 * Description: Description
 * Plugin URI: http://#
 * Author: Author
 * Author URI: http://#
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: text-domain
 * Domain Path: domain/path
 */

/*
    Copyright (C) Year  Author  Email

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Product_Addon {

	public $version    = '1.0.0';
	private $container = [];

	public function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

        $this->includes();
        $this->init_classes();

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
	}

	public function __get( $prop ) {
        if ( array_key_exists( $prop, $this->container ) ) {
            return $this->container[ $prop ];
        }

        return $this->{$prop};
    }

    public function __isset( $prop ) {
        return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
    }

	public static function init() {
		static $instance = false;

		if( !$instance ) {
			$instance = new self();
		}

		return $instance;
	}

	public function define_constants() {
		define( 'ADDON_VERSION', $this->version );
        define( 'ADDON_FILE', __FILE__ );
        define( 'ADDON_ROOT', __DIR__ );
        define( 'ADDON_INCLUDES', ADDON_ROOT . '/includes' );
        define( 'ADDON_ROOT_URI', plugins_url( '', __FILE__ ) );
        define( 'ADDON_ASSET_URI', ADDON_ROOT_URI . '/assets' );
	}

	public function activate() {

	}

	public function deactivate() {

	}

	public function  includes() {
		require_once ADDON_INCLUDES . '/functions.php';
		require_once ADDON_INCLUDES . '/Admin.php';
		//require_once ADDON_INCLUDES . '/Ajax.php';
		require_once ADDON_INCLUDES . '/Assets.php';
		require_once ADDON_INCLUDES . '/Form.php';
		require_once ADDON_INCLUDES . '/Frontend.php';
		require_once ADDON_INCLUDES . '/OrderMeta.php';
		require_once ADDON_INCLUDES . '/ProductMeta.php';
		require_once ADDON_INCLUDES . '/Settings.php';
	}

	public function init_classes() {
		$this->container['admin'] = new  \ProductAddon\Admin();
		//$this->container[''] = new  \ProductAddon\Ajax();
		$this->container['assets'] = new  \ProductAddon\Assets();
		//$this->container['forms'] = new  \ProductAddon\Form();
		$this->container['frontend'] = new  \ProductAddon\Frontend();
		//$this->container['ordermeta'] = new  \ProductAddon\OrderMeta();
		//$this->container['productmeta'] = new  \ProductAddon\ProductMeta();
		//$this->container['settings'] = new  \ProductAddon\Settings();
	}

	public function init_plugin() {
		 add_action( 'init', [ $this, 'localization_setup' ] );
		 add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_action_links' ] );
	}

	public function localization_setup() {

	}

	public function plugin_action_links( $links ) {

		return $links;
	}
}

function prdoduct_addon() {
	return Product_Addon::init();
}

prdoduct_addon();
