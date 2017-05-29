<?php
/**
 * Elementor Compatibility File.
 *
 * @package Astra
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

/**
 * Astra Elementor Compatibility
 */
if ( ! class_exists( 'Astra_Elementor' ) ) :

	/**
	 * Astra Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class Astra_Elementor {

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
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'astra_theme_assets', 		array( $this, 'add_styles' ) );
			add_filter( 'astra_get_content_layout', array( $this, 'elementor_content_layout' ), 20 );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.0.0
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-elementor'] = 'site-compatible/elementor' ;
			return $assets;
		}

		/**
		 * Elementor Content layout set as Page Builder
		 *
		 * @param  string $layout Content Layout.
		 * @return string
		 * @since  1.0.2
		 */
		function elementor_content_layout( $layout ) {

			$id = get_the_ID();

			if ( is_singular() && 'builder' === Plugin::$instance->db->get_edit_mode( $id ) ) {
				$layout = 'page-builder';
			}

			return $layout;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Elementor::get_instance();
