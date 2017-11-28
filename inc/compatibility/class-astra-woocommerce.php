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
if ( ! class_exists( 'Astra_Woocommerce' ) ) :

	/**
	 * Astra WooCommerce Compatibility
	 *
	 * @since 1.0.0
	 */
	class Astra_Woocommerce {

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

			add_filter( 'astra_theme_defaults',                     array( $this, 'theme_defaults' ) );

			add_action( 'after_setup_theme',                        array( $this, 'setup_theme' ) );

			add_action( 'woocommerce_before_main_content',          array( $this, 'before_main_content_start' ) );
			add_action( 'woocommerce_after_main_content',           array( $this, 'before_main_content_end' ) );
			add_filter( 'wp_enqueue_scripts',                       array( $this, 'add_styles' ) );
			add_action( 'init',                                     array( $this, 'woocommerce_init' ), 1 );

			add_filter( 'loop_shop_columns',                        array( $this, 'shop_columns' ) );
			add_filter( 'loop_shop_per_page',                       array( $this, 'shop_no_of_products' ) );
			add_filter( 'body_class',                               array( $this, 'shop_page_products_item_class' ) );
			add_filter( 'astra_dynamic_css',                          array( $this, 'dynamic_css_callback' ), 10, 2 );

			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'woocommerce_add_to_cart_fragments',        array( $this, 'add_to_cart_fragments' ) );

			add_action( 'woocommerce_before_shop_loop_item_title',  array( $this, 'product_flip_image' ), 10 );
			add_filter( 'woocommerce_subcategory_count_html',       array( $this, 'subcategory_count_markup' ), 10, 2 );
		}

		/**
		 * Subcategory Count Markup
		 * @param  mixed 	$content  Count Markup.
		 * @param  object 	$category Object of Category.
		 * @return mixed
		 */
		function subcategory_count_markup( $content, $category ) {

			$content = sprintf( // WPCS: XSS OK.
					/* translators: 1: number of products */
					_nx( '<mark class="count">%1$s Product</mark>', '<mark class="count">%1$s Products</mark>', $category->count, 'product categories', 'astra' ),
					number_format_i18n( $category->count ) );

			return $content;
		}

		/**
		 * Product Flip Image
		 */
		function product_flip_image() {

		    global $product;

		    $attachment_ids = $product->get_gallery_image_ids();

		    if ( $attachment_ids ) {

				// @see woocommerce_get_product_thumbnail()
				$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' );

		    	echo apply_filters( 'astra_woocommerce_product_flip_image', wp_get_attachment_image( reset( $attachment_ids ), $image_size, false, array( 'class' => 'show-on-hover' ) ) );
		    }
		}

		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 */
	    function add_to_cart_fragments( $fragments ) {

	        $fragments['.astra-menu-cart-item'] = astra_get_cart();

	        return $fragments;
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

		function dynamic_css_callback( $dynamic_css, $dynamic_css_filtered = '' ) {

			$theme_color  = astra_get_option( 'link-color' );
			$text_color   = astra_get_option( 'text-color' );
			$link_h_color = astra_get_option( 'link-h-color' );

			$btn_color    = astra_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = astra_get_foreground_color( $theme_color );
			}

			$btn_h_color = astra_get_option( 'button-h-color' );
			if ( empty( $btn_h_color ) ) {
				$btn_h_color = astra_get_foreground_color( $link_h_color );
			}
			$btn_bg_color   = astra_get_option( 'button-bg-color', '', $theme_color );
			$btn_bg_h_color = astra_get_option( 'button-bg-h-color', '', $link_h_color );

			$btn_border_radius               = astra_get_option( 'button-radius' );
			$btn_vertical_padding            = astra_get_option( 'button-v-padding' );
			$btn_horizontal_padding          = astra_get_option( 'button-h-padding' );

			$css_output = array(
				'.woocommerce span.onsale' => array(
					'background-color' => $theme_color
				),
				'.woocommerce a.button, .woocommerce button.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled], .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover, .woocommerce #respond input#submit' => array(
					'color'            => $btn_color,
					'border-color'     => $btn_bg_color,
					'background-color' => $btn_bg_color
				),
				'.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce .woocommerce-message a.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce input.button:hover' => array(
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
				'.woocommerce nav.woocommerce-pagination ul,.woocommerce nav.woocommerce-pagination ul li' => array(
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
				// Button Typography.
				'.woocommerce a.button, .woocommerce button.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce-cart table.cart td.actions .button, .woocommerce form.checkout_coupon .button, .woocommerce #respond input#submit' => array(
					'border-radius'    => astra_get_css_value( $btn_border_radius, 'px' ),
					'padding'          => astra_get_css_value( $btn_vertical_padding, 'px' ) . ' ' . astra_get_css_value( $btn_horizontal_padding, 'px' ),
				),
			);

			/* Parse CSS from array() */
			$css_output = astra_parse_css( $css_output );
			return $dynamic_css . $css_output;
		}

		/**
		 * Update Shop page grid
		 * @param  int $col Shop Column.
		 * @return int
		 */
		function shop_columns( $col ) {

			$col = astra_get_option( 'shop-grid' );
	        return $col;
		}

		function shop_no_of_products( ) {
			$products = astra_get_option( 'shop-no-of-products' );
	        return $products;
		}

		/**
		 * Add products item class on shop page
		 */
	    function shop_page_products_item_class( $classes = '' ) {

	    	if ( is_shop() || 'product' == get_post_type() ) {
	        	$classes[] = 'columns-' . astra_get_option( 'shop-grid' ); // self::get_grid_classes( $grid_columns );
	        }

	        return $classes;
	    }

		/**
		 * Update woocommerce related product numbers
		 * @param  array $args Related products array.
		 * @return array
		 */
		function related_products_args( $args ) {

			$col = astra_get_option( 'shop-grid' );
			$args['posts_per_page'] = $col;
			return $args;
		}

		/**
		 * Setup theme
		 *
		 * @since 1.0.3
		 */
		function setup_theme() {

			// WooCommerce.
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

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
			$site_sidebar = astra_page_layout();
			if ( 'left-sidebar' == $site_sidebar ) {
				get_sidebar();
			}
			?>
			<div id="primary" class="content-area primary">

				<?php astra_primary_content_top(); ?>

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

				<?php astra_primary_content_bottom(); ?>

			</div> <!-- #primary -->
			<?php
			$site_sidebar = astra_page_layout();
			if ( 'right-sidebar' == $site_sidebar ) {
				get_sidebar();
			}
		}

		/**
		 * Enqueue styles
		 *
		 * @since 1.0.31
		 */
		function add_styles( ) {

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$css_uri = ASTRA_THEME_URI . 'assets/css/' . $dir_name . '/';

			$style      = 'site-compatible/woocommerce';
			$key        = 'astra-woocommerce';

			// Register & Enqueue Styles.
			// Generate CSS URL.
			$css_file = $css_uri . $style . $file_prefix . '.css';

			// Register.
			wp_register_style( $key, $css_file, array(), ASTRA_THEME_VERSION, 'all' );

			// Enqueue.
			wp_enqueue_style( $key );

			// RTL support.
			wp_style_add_data( $key, 'rtl', 'replace' );
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Woocommerce::get_instance();
