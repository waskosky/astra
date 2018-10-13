<?php
/**
 * Easy Digital Downloads Compatibility File.
 *
 * @link https://easydigitaldownloads.com/
 *
 * @package Astra
 */

// If plugin - 'Easy_Digital_Downloads' not exist then return.
if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
	return;
}

/**
 * Astra Easy Digital Downloads Compatibility
 */
if ( ! class_exists( 'Astra_Edd' ) ) :

	/**
	 * Astra Easy Digital Downloads Compatibility
	 *
	 * @since x.x.x
	 */
	class Astra_Edd {

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

			require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/edd-common-functions.php';

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			// Register Store Sidebars.
			add_action( 'widgets_init', array( $this, 'store_widgets_init' ), 15 );
			// Replace Edd Store Sidebars.
			add_filter( 'astra_get_sidebar', array( $this, 'replace_store_sidebar' ) );
			// Edd Sidebar Layout.
			add_filter( 'astra_page_layout', array( $this, 'store_sidebar_layout' ) );
			// Edd Content Layout.
			add_filter( 'astra_get_content_layout', array( $this, 'store_content_layout' ) );
			
			add_filter( 'body_class', array( $this, 'edd_products_item_class' ) );
			add_filter( 'post_class', array( $this, 'edd_single_product_class' ) );
			
			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
			
			add_filter( 'astra_theme_assets', array( $this, 'add_styles' ) );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since x.x.x
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-edd'] = 'compatibility/edd';
			return $assets;
		}

		/**
		 * Theme Defaults.
		 *
		 * @param array $defaults Array of options value.
		 * @return array
		 */
		function theme_defaults( $defaults ) {

			// Container.
			$defaults['edd-content-layout'] = 'plain-container';

			// // Sidebar.
			$defaults['edd-sidebar-layout']    = 'no-sidebar';
			$defaults['edd-single-product-sidebar-layout'] = 'default';

			// Edd Archive.
			$defaults['edd-archive-grids']             = array(
				'desktop' => 4,
				'tablet'  => 3,
				'mobile'  => 2,
			);

			return $defaults;
		}


		/**
		 * Add products item class to the body
		 *
		 * @param Array $classes product classes.
		 *
		 * @return array.
		 */
		function edd_products_item_class( $classes = '' ) {

			$is_edd_archive_page = astra_is_edd_archive_page();

			if ( $is_edd_archive_page ) {
				$shop_grid = astra_get_option( 'edd-archive-grids' );
				$classes[] = 'columns-' . $shop_grid['desktop'];
				$classes[] = 'tablet-columns-' . $shop_grid['tablet'];
				$classes[] = 'mobile-columns-' . $shop_grid['mobile'];

				$classes[] = 'ast-edd-archive-page';
			}

			return $classes;
		}

		/**
		 * Add class on single product page
		 *
		 * @param Array $classes product classes.
		 *
		 * @return array.
		 */
		function edd_single_product_class( $classes ) {
		
			$is_edd_archive_page = astra_is_edd_archive_page();

			if ( $is_edd_archive_page ) {
				$classes[] = 'ast-edd-archive-article';
			}


			return $classes;
		}

		/**
		 * Store widgets init.
		 */
		function store_widgets_init() {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Easy Digital Downloads Sidebar', 'astra' ),
					'id'            => 'astra-edd-sidebar',
					'description'   => __( 'This sidebar will be used on Product archive, Cart, Checkout and My Account pages.', 'astra' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'EDD Single Product Sidebar', 'astra' ),
					'id'            => 'astra-edd-single-product-sidebar',
					'description'   => __( 'This sidebar will be used on EDD Single Product page.', 'astra' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}

		/**
		 * Assign shop sidebar for store page.
		 *
		 * @param String $sidebar Sidebar.
		 *
		 * @return String $sidebar Sidebar.
		 */
		function replace_store_sidebar( $sidebar ) {

			$is_edd_page         = astra_is_edd_page();
			$is_edd_single_product_page = astra_is_edd_single_product_page();

			if ( $is_edd_page && ! $is_edd_single_product_page ) {
				$sidebar = 'astra-edd-sidebar';
			} elseif ( $is_edd_single_product_page ) {
				$sidebar = 'astra-edd-single-product-sidebar';
			}

			return $sidebar;
		}

		/**
		 * Easy Digital Downloads Container
		 *
		 * @param String $sidebar_layout Layout type.
		 *
		 * @return String $sidebar_layout Layout type.
		 */
		function store_sidebar_layout( $sidebar_layout ) {

			$is_edd_page         = astra_is_edd_page();
			$is_edd_single_product_page  = astra_is_edd_single_product_page();
			$is_edd_archive_page = astra_is_edd_archive_page();

			if ( $is_edd_page ) {

				$edd_sidebar = astra_get_option( 'edd-sidebar-layout' );

				if ( 'default' !== $edd_sidebar ) {

					$sidebar_layout = $edd_sidebar;
				}

				if ( $is_edd_single_product_page ) {
					$edd_single_product_sidebar = astra_get_option( 'edd-single-product-sidebar-layout' );
						
					if ( 'default' !== $edd_single_product_sidebar ) {
						$sidebar_layout = $edd_single_product_sidebar;
					}

					$page_id = get_the_ID();
					$edd_sidebar_layout  = get_post_meta( $page_id, 'site-sidebar-layout', true );
				} elseif( $is_edd_archive_page ){
					$edd_sidebar_layout = astra_get_option( 'edd-sidebar-layout' );
				} else {
					$edd_sidebar_layout = astra_get_option_meta( 'site-sidebar-layout', '', true );
				}

				if ( 'default' !== $edd_sidebar_layout && ! empty( $edd_sidebar_layout ) ) {
					$sidebar_layout = $edd_sidebar_layout;
				}
			}

			return $sidebar_layout;
		}
		/**
		 * Easy Digital Downloads Container
		 *
		 * @param String $layout Layout type.
		 *
		 * @return String $layout Layout type.
		 */
		function store_content_layout( $layout ) {

			$is_edd_page = astra_is_edd_page();
			$is_edd_single_page = astra_is_edd_single_page();
			$is_edd_archive_page = astra_is_edd_archive_page();

			if ( $is_edd_page ) {

				$edd_layout = astra_get_option( 'edd-content-layout' );

				if ( 'default' !== $edd_layout ) {

					$layout = $edd_layout;
				}

				if ( $is_edd_single_page ) {
					$page_id = get_the_ID();
					$edd_page_layout  = get_post_meta( $page_id, 'site-content-layout', true );
				} elseif( $is_edd_archive_page ){
					$edd_page_layout = astra_get_option( 'edd-content-layout' );
				} else {
					$edd_page_layout = astra_get_option_meta( 'site-content-layout', '', true );
				}

				if ( 'default' !== $edd_page_layout && ! empty( $edd_page_layout ) ) {
					$layout = $edd_page_layout;
				}
			}

			return $layout;
		}

		/**
		 * Register Customizer sections and panel for Easy Digital Downloads.
		 *
		 * @since x.x.x
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function customize_register( $wp_customize ) {

			/**
			 * Register Sections & Panels
			 */
			require ASTRA_THEME_DIR . 'inc/compatibility/edd/customizer/class-astra-customizer-register-edd-section.php';

			/**
			 * Sections
			 */
			require ASTRA_THEME_DIR . 'inc/compatibility/edd/customizer/sections/class-astra-edd-container-configs.php';
			require ASTRA_THEME_DIR . 'inc/compatibility/edd/customizer/sections/class-astra-edd-sidebar-configs.php';
			require ASTRA_THEME_DIR . 'inc/compatibility/edd/customizer/sections/layout/class-astra-edd-archive-layout-configs.php';

		}

	}

endif;

if ( apply_filters( 'astra_enable_edd_integration', true ) ) {
	Astra_Edd::get_instance();
}
