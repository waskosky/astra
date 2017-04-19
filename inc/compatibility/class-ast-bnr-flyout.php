<?php
/**
 * BNR Flyout Compatibility File.
 *
 * @package Astra
 */

// If plugin - 'BNR Flyout' not exist then return.
if ( ! class_exists( 'FLBuilderModel' ) ) {
	return;
}

/**
 * Astra BNR Flyout Compatibility
 */
if ( ! class_exists( 'Ast_BNR_Flyout' ) ) :

	/**
	 * Astra BNR Flyout Compatibility
	 *
	 * @since 1.0.0
	 */
	class Ast_BNR_Flyout {

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
			$assets['css']['astra-bnr-flyout'] = 'site-compatible/bnr-flyout' ;
			return $assets;
		}

	}

endif;

/**
*  Kicking this off by calling 'get_instance()' method
*/
$ast_beaver_builder  = Ast_BNR_Flyout::get_instance();
