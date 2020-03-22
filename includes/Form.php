<?php

namespace ProductAddon;

class Form {

	public function __construct() {

	}

	public static function init() {
		static $instance = false;

		if( !$instance ) {
			$instance = new self();
		}

		return $instance;
	}
}