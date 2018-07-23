<?php
/**
 * Astra Theme Customizer Configuration Base.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra x.x.x
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Customizer_Config_Base {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'astra_customizer_configurations', array( $this, 'register_configuration' ), 30, 2 );
		}

		public function register_configuration( $configurations, $wp_customize ) {
			return $configurations;
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Config_Base;
