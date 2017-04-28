<?php
/**
 * WooCommerce Compatibility File.
 *
 * @link https://woocommerce.com/
 *
 * @package Astra
 */

// If plugin - 'WooCommerce' not exist then return.
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Astra WooCommerce Compatibility
 */
if ( ! class_exists( 'Ast_Woocommerce' ) ) :

	/**
	 * Astra WooCommerce Compatibility
	 *
	 * @since 1.0.0
	 */
	class Ast_Woocommerce {

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

			// Customizer.
			add_filter( 'ast_theme_defaults',              			array( $this, 'theme_defaults' ) );
			add_action( 'customize_register',              			array( $this, 'customize_register' ) );

			add_action( 'woocommerce_before_main_content', 			array( $this, 'before_main_content_start' ) );
			add_action( 'woocommerce_after_main_content',  			array( $this, 'before_main_content_end' ) );
			add_filter( 'ast_theme_assets',                			array( $this, 'add_styles' ) );
			add_action( 'init',                            			array( $this, 'woocommerce_init' ), 1 );

			add_filter( 'loop_shop_columns', 						array( $this, 'shop_columns' ) );
			add_filter( 'loop_shop_per_page', 						array( $this, 'shop_no_of_products' ) );
			add_filter( 'body_class', 								array( $this, 'shop_page_products_item_class' ) );
			add_filter( 'ast_dynamic_css', 							array( $this, 'dynamic_css_callback' ), 10, 2 );

			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
		}

		/**
		 * Theme Defaults.
		 *
		 * @param array $default Array of options value.
		 * @return array
		 */
		function theme_defaults( $defaults ) {
			
			$defaults['shop-grid']           = '3';
			$defaults['shop-no-of-products'] = '9';

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function customize_register( $wp_customize ) {

			/**
			 * Get theme option default values
			 *
			 * @see Ast_Theme_Options::defaults() in parent theme
			 */
			$defaults = Ast_Theme_Options::defaults();

			/**
			 * Register Sections & Panels
			 */
			$wp_customize->add_section( 'section-shop', array(
				'title'    => __( 'Woo - Shop Page', 'astra' ),
				'panel'    => 'panel-layout',
				'priority' => 55,
			) );

			/**
			 * Option: Shop Columns
			 */
			$wp_customize->add_setting( AST_THEME_SETTINGS . '[shop-grid]', array(
				'default' => $defaults['shop-grid'],
				'type'    => 'option',
			) );
			$wp_customize->add_control( AST_THEME_SETTINGS . '[shop-grid]', array(
				'section'     => 'section-shop',
				'label'       => __( 'Shop Columns', 'astra' ),
				'type'        => 'select',
				'choices'     => array(
					'1' => __( '1 Column', 'astra' ),
					'2' => __( '2 Columns', 'astra' ),
					'3' => __( '3 Columns', 'astra' ),
					'4' => __( '4 Columns', 'astra' ),
					'5' => __( '5 Columns', 'astra' ),
					'6' => __( '6 Columns', 'astra' ),
				),
			) );

			/**
			 * Option: Products Per Page
			 */
			$wp_customize->add_setting( AST_THEME_SETTINGS . '[shop-no-of-products]', array(
				'default' => $defaults['shop-no-of-products'],
				'type'    => 'option',
			) );
			$wp_customize->add_control( AST_THEME_SETTINGS . '[shop-no-of-products]', array(
				'section'     => 'section-shop',
				'label'       => __( 'Products Per Page', 'astra' ),
				'type'        => 'number',
				'input_attrs' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 50,
				),
			) );
		}

		function dynamic_css_callback( $dynamic_css, $dynamic_css_filtered = '' ) {

			$theme_color  = ast_get_option( 'link-color' );
			$text_color   = ast_get_option( 'text-color' );
			$link_h_color = ast_get_option( 'link-h-color' );

			$btn_color    = ast_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = ast_get_foreground_color( $theme_color );
			}

			$btn_h_color = ast_get_option( 'button-h-color' );
			if ( empty( $btn_h_color ) ) {
				$btn_h_color = ast_get_foreground_color( $link_h_color );
			}
			$btn_bg_color   = ast_get_option( 'button-bg-color', '', $theme_color );
			$btn_bg_h_color = ast_get_option( 'button-bg-h-color', '', $link_h_color );

			$css_output = array(
				'.woocommerce .product span.onsale' => array(
					'background-color' => $theme_color
				),
				'.woocommerce a.button, .woocommerce button.button, .woocommerce .product a.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled], .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover' => array(
					'color'            => $btn_color,
					'border-color'     => $btn_bg_color,
					'background-color' => $btn_bg_color
				),
				'.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce .product a.button:hover, .woocommerce .woocommerce-message a.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce input.button:hover' => array(
					'color'            => $btn_h_color,
					'border-color'     => $btn_bg_h_color,
					'background-color' => $btn_bg_h_color
				),
				'.woocommerce .woocommerce-message' => array(
					'border-top-color' => $theme_color
				),
				'.woocommerce .woocommerce-message::before' => array(
					'color' => $theme_color
				),
				'.woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .widget_layered_nav_filters ul li.chosen a' => array(
					'color' => $text_color
				),
				'.woocommerce nav.woocommerce-pagination ul li' => array(
					'border-color' => $theme_color,
				),
				'.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current' => array(
					'background' => $theme_color,
					'color'      => $btn_color,
				),
				'.woocommerce-MyAccount-navigation-link.is-active a' => array(
					'color'      => $link_h_color,
				),
				'.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle' => array(
					'background-color' => $theme_color,
				),
			);

			/* Parse CSS from array() */
			$css_output = ast_parse_css( $css_output );
			return $dynamic_css . $css_output;
		}

		/**
		 * Update Shop page grid
		 * @param  int $col Shop Column.
		 * @return int
		 */
		function shop_columns( $col ) {

			$col = ast_get_option( 'shop-grid' );
	        return $col;
		}

		function shop_no_of_products( ) {
			$products = ast_get_option( 'shop-no-of-products' );
	        return $products;
		}

		/**
		 * Add products item class on shop page
		 */
	    function shop_page_products_item_class( $classes = '' ) {
	    	
	    	if ( is_shop() || 'product' == get_post_type() ) {
	        	$classes[] = 'columns-' . ast_get_option( 'shop-grid' ); // self::get_grid_classes( $grid_columns );
	        }

	        return $classes;
	    }

		/**
		 * Update woocommerce related product numbers
		 * @param  array $args Related products array.
		 * @return array
		 */
		function related_products_args( $args ) { 

			$col = ast_get_option( 'shop-grid' );
			$args['posts_per_page'] = $col;
			return $args; 
		}

		/**
		 * Remove Woo-Commerce Default actions
		 */
		function woocommerce_init() {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}

		/**
		 * Add start of wrapper
		 */
		function before_main_content_start() {
			$site_sidebar = ast_page_layout();
			if ( 'left-sidebar' == $site_sidebar ) {
				 get_sidebar();
			}
			?>
			<div id="primary" class="content-area primary">
				<main id="main" class="site-main" role="main">
					<div class="ast-woocommerce-container">
			<?php
		}

		/**
		 * Add end of wrapper
		 */
		function before_main_content_end() {
			?>
					</div> <!-- .ast-woocommerce-container -->
				</main> <!-- #main -->
			</div> <!-- #primary -->
			<?php
			$site_sidebar = ast_page_layout();
			if ( 'right-sidebar' == $site_sidebar ) {
				 get_sidebar();
			}
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.0.0
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-woocommerce'] = 'site-compatible/woocommerce';
			return $assets;
		}

	}

endif;

/**
*  Kicking this off by calling 'get_instance()' method
*/
$ast_woocommerce  = Ast_Woocommerce::get_instance();
