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
if ( ! class_exists( 'Astra_Customizer_Control_Base' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Customizer_Control_Base {

		private static $controls;

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->set_controls();
		}

		public function set_controls() {
			self::$controls = array();
		}

		public static function get_control_instance( $control_type ) {

			if ( 'color' === $control_type ) {
				return is_callable( 'WP_Customize_Color_Control' ) ? 'WP_Customize_Color_Control' : false;
			}

			return false;
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Control_Base;
