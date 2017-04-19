<?php
/**
 * Elementor Compatibility File.
 *
 * @package Astra
 */

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

/**
 * Astra Elementor Compatibility
 */
if ( ! class_exists( 'Ast_Elementor' ) ) :

	/**
	 * Astra Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class Ast_Elementor {

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
		 * Add Styles Callback
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-elementor'] = 'site-compatible/elementor' ;
			return $assets;
		}

	}

endif;

/**
*  Kicking this off by calling 'get_instance()' method
*/
$ast_elementor  = Ast_Elementor::get_instance();
