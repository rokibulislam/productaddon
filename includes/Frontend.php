<?php

namespace ProductAddon;

class Frontend {

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