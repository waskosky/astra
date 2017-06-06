<?php
/**
 * Beaver Builder Compatibility File.
 *
 * @package Astra
 */

// If plugin - 'Builder Builder' not exist then return.
if ( ! class_exists( 'FLBuilderModel' ) ) {
	return;
}

/**
 * Astra Beaver Builder Compatibility
 */
if ( ! class_exists( 'Astra_Beaver_Builder' ) ) :

	/**
	 * Astra Beaver Builder Compatibility
	 *
	 * @since 1.0.0
	 */
	class Astra_Beaver_Builder {

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
			add_filter( 'astra_theme_assets',       array( $this, 'add_styles' ) );
			add_filter( 'astra_get_content_layout',     array( $this, 'builder_template_content_layout' ), 20 );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.0.0
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-bb-plugin'] = 'site-compatible/bb-plugin' ;
			return $assets;
		}

		/**
		 * Builder Template Content layout set as Page Builder
		 *
		 * @param  string $layout Content Layout.
		 * @return string
		 * @since  1.0.2
		 */
		function builder_template_content_layout( $layout ) {

			$id = astra_get_post_id();
			$do_render = apply_filters( 'fl_builder_do_render_content', true, FLBuilderModel::get_post_id() );

			if ( is_singular() && $do_render && FLBuilderModel::is_builder_enabled() ) {

				$page_builder_flag = get_post_meta( $id, 'astra-content-layout-flag', true );

				if ( empty( $page_builder_flag ) ) {

					update_post_meta( $id, 'astra-content-layout-flag', 'disabled' );
					update_post_meta( $id, 'site-post-title', 'disabled' );

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

			return $layout;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Beaver_Builder::get_instance();
