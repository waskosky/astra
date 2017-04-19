<?php
/**
 * Site Origin Compatibility File.
 *
 * @package Astra
 */

// If plugin - 'Site Origin' not exist then return.
if ( ! class_exists( 'SiteOrigin_Panels_Settings' ) ) {
	return;
}

/**
 * Astra Site Origin Compatibility
 */
if ( ! class_exists( 'Ast_Site_Origin' ) ) :

	/**
	 * Astra Site Origin Compatibility
	 *
	 * @since 1.0.0
	 */
	class Ast_Site_Origin {

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
			$assets['css']['astra-site-origin'] = 'site-compatible/site-origin';
			return $assets;
		}

	}

endif;

/**
*  Kicking this off by calling 'get_instance()' method
*/
$ast_site_origin  = Ast_Site_Origin::get_instance();
