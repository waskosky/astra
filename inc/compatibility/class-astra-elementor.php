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
			add_filter( 'astra_theme_assets', 	array( $this, 'add_styles' ) );
			add_action( 'wp', 					array( $this, 'elementor_default_setting' ), 20 );
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
		function elementor_default_setting() {
			
			global $post;
			$id = astra_get_post_id();

			if ( is_singular() && empty( $post->post_content ) && 'builder' === Plugin::$instance->db->get_edit_mode( $id ) ) {

				$page_builder_flag = get_post_meta( $id, '_astra_content_layout_flag', true );
				if ( empty( $page_builder_flag ) ) {

					update_post_meta( $id, '_astra_content_layout_flag', 'disabled' );
					update_post_meta( $id, 'site-post-title', 'disabled' );
					update_post_meta( $id, 'ast-title-bar-display', 'disabled' );

					$content_layout = get_post_meta( $id, 'site-content-layout', true );
					if ( empty( $content_layout ) || 'default' == $content_layout ) {
						update_post_meta( $id, 'site-content-layout', 'page-builder' );
					}

					$sidebar_layout = get_post_meta( $id, 'site-sidebar-layout', true );
					if ( empty( $sidebar_layout ) || 'default' == $sidebar_layout ) {
						update_post_meta( $id, 'site-sidebar-layout', 'no-sidebar' );
					}
				}
			}
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Elementor::get_instance();
