<?php
/**
 * Yoast SEO Compatibility File.
 *
 * @package Astra
 */

/**
 * Astra Yoast SEO Compatibility
 */
if ( ! class_exists( 'Astra_Yoast_SEO' ) ) :

	/**
	 * Astra Yoast SEO Compatibility
	 *
	 * @since x.x.x
	 */
	class Astra_Yoast_SEO {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'wpseo_sitemap_exclude_post_type', array( $this, 'sitemap_exclude_post_type' ), 10, 2 );
		}

		/**
		 * Exclude One Content Type From Yoast SEO Sitemap
		 *
		 * @param  string $value value.
		 * @param  string $post_type Post Type.
		 * @since x.x.x
		 */
		function sitemap_exclude_post_type( $value, $post_type ) {
			if ( 'astra-advanced-hook' === $post_type ) {
				return true;
			}
		}

	}

endif;

/**
 * Kicking this off by object
 */
new Astra_Yoast_SEO;
