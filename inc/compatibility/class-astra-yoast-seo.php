<?php
/**
 * Contact Form 7 Compatibility File.
 *
 * @package Astra
 */

/**
 * Astra Contact Form 7 Compatibility
 */
if ( ! class_exists( 'Astra_Yoast_SEO' ) ) :

	/**
	 * Astra Contact Form 7 Compatibility
	 *
	 * @since 1.0.0
	 */
	class Astra_Yoast_SEO {

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
			add_filter( 'wpseo_sitemap_exclude_post_type', array( $this, 'ast_sitemap_exclude_post_type' ), 10, 2 );
		}

		/**
		 * Exclude One Content Type From Yoast SEO Sitemap
		 *
		 * @param  string $value value.
		 * @param  string $post_type Post Type.
		 * @since 1.0.0
		 */
		function ast_sitemap_exclude_post_type( $value, $post_type ) {
			if ( 'astra-advanced-hook' == $post_type ) {
				return true;
			}
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Yoast_SEO::get_instance();
