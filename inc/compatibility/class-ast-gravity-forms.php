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
if ( ! class_exists( 'Ast_Gravity_Forms' ) ) :

	/**
	 * Astra Gravity Forms
	 *
	 * @since 1.0.0
	 */
	class Ast_Gravity_Forms {

		/**
		 * Member Varible
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'ast_theme_assets', array( $this, 'add_styles' ) );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.0.0
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-gravity-forms'] = 'site-compatible/gravity-forms' ;
			return $assets;
		}

	}

endif;

/**
*  Kicking this off by calling 'get_instance()' method
*/
$ast_gravity_forms  = Ast_Gravity_Forms::get_instance();
