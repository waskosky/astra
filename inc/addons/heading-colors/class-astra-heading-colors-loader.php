<?php
/**
 * Heading Colors Loader for Astra theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2019, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Astra_Heading_Colors_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since x.x.x
	 */
	class Astra_Heading_Colors_Loader {

		/**
		 *  Constructor
		 */
		public function __construct() {

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
			// // Load Google fonts.
			// add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );
		}

		/**
		 * Enqueue google fonts.
		 *
		 * @return void
		 */
		// public function add_fonts() {
		// 	$breadcrumb_font_family = astra_get_option( 'breadcrumb-font-family' );
		// 	$breadcrumb_font_weight = astra_get_option( 'breadcrumb-font-weight' );
		// 	Astra_Fonts::add_font( $breadcrumb_font_family, $breadcrumb_font_weight );
		// }

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
         *
         * @since x.x.x
		 */
		function theme_defaults( $defaults ) {

			/**
			* Heading Tags <h1> to <h6>
			*/
			$defaults['h1-color'] = '';
			$defaults['h2-color'] = '';
			$defaults['h3-color'] = '';
			$defaults['h4-color'] = '';
			$defaults['h5-color'] = '';
			$defaults['h6-color'] = '';

			return $defaults;
		}

		/**
		 * Load color configs for the Heading Colors.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         *
         * @since x.x.x
		 */
		function customize_register( $wp_customize ) {

			/**
			 * Register Panel & Sections
			 */
			require_once ASTRA_THEME_HEADING_COLORS_DIR . 'customizer/class-astra-heading-colors-configs.php';
			// require_once ASTRA_THEME_BREADCRUMBS_DIR . 'customizer/class-astra-breadcrumbs-color-configs.php';
			// require_once ASTRA_THEME_BREADCRUMBS_DIR . 'customizer/class-astra-breadcrumbs-typo-configs.php';

		}

		/**
		 * Customizer Preview
		 */
		function preview_scripts() {
			/**
			 * Load unminified if SCRIPT_DEBUG is true.
			 */
			/* Directory and Extension */
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_script( 'astra-heading-colors-customizer-preview-js', ASTRA_THEME_HEADING_COLORS_URI . 'assets/js/' . $dir_name . '/customizer-preview' . $file_prefix . '.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_THEME_VERSION, true );
		}
	}
}

/**
*  Kicking this off by creating the object of the class.
*/
new Astra_Heading_Colors_Loader();
