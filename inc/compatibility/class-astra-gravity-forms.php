<?php
/**
 * Gravity Forms File.
 *
 * @package Astra
 */

// If plugin - 'Gravity Forms' not exist then return.
if ( ! class_exists( 'GFForms' ) ) {
	return;
}

/**
 * Astra Gravity Forms
 */
if ( ! class_exists( 'Astra_Gravity_Forms' ) ) :

	/**
	 * Astra Gravity Forms
	 *
	 * @since 1.0.0
	 */
	class Astra_Gravity_Forms {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'gform_enqueue_scripts', array( $this, 'add_styles' ), 10, 2 );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.0.0
		 */
		function add_styles() {
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
			$css_file    = ASTRA_THEME_URI . 'assets/css/' . $dir_name . '/compatibility/gravity-forms' . $file_prefix . '.css';

			wp_register_style( 'astra-gravity-forms', $css_file, array(), ASTRA_THEME_VERSION, 'all' );
			wp_enqueue_style( 'astra-gravity-forms' );
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Gravity_Forms::get_instance();
