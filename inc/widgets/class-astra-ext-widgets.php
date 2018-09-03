<?php
/**
 * Footer Widgets Extension
 *
 * @package Astra Addon
 * @since 1.6.0
 */

define( 'ASTRA_EXT_WIDGETS_DIR', ASTRA_THEME_DIR . 'inc/widgets/' );
define( 'ASTRA_EXT_WIDGETS_URL', ASTRA_THEME_URI . 'inc/widgets/' );

if ( ! class_exists( 'Astra_Ext_Widgets' ) ) {

	/**
	 * Footer Widgets Initial Setup
	 *
	 * @since 1.6.0
	 */
	class Astra_Ext_Widgets {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {
			// Init.
			require_once ASTRA_EXT_WIDGETS_DIR . 'classes/class-astra-ext-widgets-loader.php';
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Widgets::get_instance();
}
