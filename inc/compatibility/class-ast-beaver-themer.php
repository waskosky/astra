<?php
/**
 * Beaver Themer Compatibility File.
 *
 * @package Astra
 */

// If plugin - 'Beaver Themer' not exist then return.
if ( ! class_exists( 'FLThemeBuilderLoader' ) ) {
	return;
}

/**
 * Astra Beaver Themer Compatibility
 */
if ( ! class_exists( 'Ast_Beaver_Themer' ) ) :

	/**
	 * Astra Beaver Themer Compatibility
	 *
	 * @since 1.0.0
	 */
	class Ast_Beaver_Themer {

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
			add_action( 'after_setup_theme', 			array( $this, 'header_footer_support' ) );
			add_action( 'wp', 							array( $this, 'theme_header_footer_render' ) );
			add_filter( 'fl_theme_builder_part_hooks', 	array( $this, 'register_part_hooks' ) );
			add_filter( 'post_class', 					array( $this, 'render_post_class' ), 99 );
			add_filter( 'ast_get_content_layout', 		array( $this, 'builder_template_content_layout' ), 20 );
		}

		/**
		 * Builder Template Content layout set as Page Builder
		 *
		 * @param  string $layout Content Layout.
		 * @return string
		 * @since  1.0.2
		 */
		function builder_template_content_layout( $layout ) {

			$do_render = apply_filters( 'fl_builder_do_render_content', true, FLBuilderModel::get_post_id() );
			if ( $do_render && FLBuilderModel::is_builder_enabled() && ! is_archive() ) {
				$layout = 'page-builder';
			}

			if ( 'fl-theme-layout' == get_post_type() ) {
				$layout = 'page-builder';
			}
			return $layout;
		}

		/**
		 * Remove theme post's default classes
		 *
		 * @param  array $classes Post Classes.
		 * @return array
		 * @since  1.0.2
		 */
		function render_post_class( $classes ) {

			$post_class = array( 'fl-post-grid-post', 'fl-post-gallery-post', 'fl-post-feed-post' );
			$result = array_intersect( $classes, $post_class );

			if ( count( $result ) > 0 ) {
				$classes = array_diff( $classes, array( 'ast-col-sm-12', 'ast-article-post' ) );
				remove_filter( 'excerpt_more', 'ast_post_link', 1 );
			}
			return $classes;
		}

		/**
		 * Function to add Theme Support
		 *
		 * @since 1.0.0
		 */
		function header_footer_support() {

			add_theme_support( 'fl-theme-builder-headers' );
			add_theme_support( 'fl-theme-builder-footers' );
			add_theme_support( 'fl-theme-builder-parts' );
		}

		/**
		 * Function to update Atra header/footer with Beaver template
		 *
		 * @since 1.0.0
		 */
		function theme_header_footer_render() {

			// Get the header ID.
			$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();

			// If we have a header, remove the theme header and hook in Theme Builder's.
			if ( ! empty( $header_ids ) ) {
				remove_action( 'ast_header', 'ast_header_markup' );
				add_action( 'ast_header', 'FLThemeBuilderLayoutRenderer::render_header' );
			}

			// Get the footer ID.
			$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();

			// If we have a footer, remove the theme footer and hook in Theme Builder's.
			if ( ! empty( $footer_ids ) ) {
				remove_action( 'ast_footer', 'ast_footer_markup' );
				add_action( 'ast_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
			}
		}

		/**
		 * Function to Astra theme parts
		 *
		 * @since 1.0.0
		 */
		function register_part_hooks() {

			return array(
				array(
					'label' => 'Page',
					'hooks' => array(
						'ast_body_top'    => __( 'Before Page', 'astra' ),
						'ast_body_bottom' => __( 'After Page', 'astra' ),
					),
				),
				array(
					'label' => 'Header',
					'hooks' => array(
						'ast_header_before' => __( 'Before Header', 'astra' ),
						'ast_header_after'  => __( 'After Header', 'astra' ),
					),
				),
				array(
					'label' => 'Content',
					'hooks' => array(
						'ast_primary_content_top'    => __( 'Before Content', 'astra' ),
						'ast_primary_content_bottom' => __( 'After Content', 'astra' ),
					),
				),
				array(
					'label' => 'Footer',
					'hooks' => array(
						'ast_footer_before' => __( 'Before Footer', 'astra' ),
						'ast_footer_after'  => __( 'After Footer', 'astra' ),
					),
				),
				array(
					'label' => 'Sidebar',
					'hooks' => array(
						'ast_sidebars_before' => __( 'Before Sidebar', 'astra' ),
						'ast_sidebars_after'  => __( 'After Sidebar', 'astra' ),
					),
				),
				array(
					'label' => 'Posts',
					'hooks' => array(
						'loop_start'               => __( 'Loop Start', 'astra' ),
						'ast_entry_top'            => __( 'Before Post', 'astra' ),
						'ast_entry_content_before' => __( 'Before Post Content', 'astra' ),
						'ast_entry_content_after'  => __( 'After Post Content', 'astra' ),
						'ast_entry_bottom'         => __( 'After Post', 'astra' ),
						'ast_comments_before'      => __( 'Before Comments', 'astra' ),
						'ast_comments_after'       => __( 'After Comments', 'astra' ),
						'loop_end'                 => __( 'Loop End', 'astra' ),
					),
				),
			);
		}
	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Ast_Beaver_Themer::get_instance();
