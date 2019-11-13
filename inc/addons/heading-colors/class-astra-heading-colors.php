<?php
/**
 * Heading Colors for Astra theme.
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

define( 'ASTRA_THEME_HEADING_COLORS_DIR', ASTRA_THEME_DIR . 'inc/addons/heading-colors/' );
define( 'ASTRA_THEME_HEADING_COLORS_URI', ASTRA_THEME_URI . 'inc/addons/heading-colors/' );

if ( ! class_exists( 'Astra_Heading_Colors' ) ) {

	/**
	 * Heading Initial Setup
	 *
	 * @since x.x.x
	 */
	class Astra_Heading_Colors {

		/**
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			require_once ASTRA_THEME_HEADING_COLORS_DIR . 'class-astra-heading-colors-loader.php';
			// require_once ASTRA_THEME_BREADCRUMBS_DIR . 'class-astra-breadcrumbs-markup.php';
			// require_once ASTRA_THEME_BREADCRUMBS_DIR . 'class-astra-breadcrumb-trail.php';
			// // Third Party plugins in the breadcrumb options.
			// add_filter( 'astra_breadcrumb_source_list', array( $this, 'astra_breadcrumb_source_list_items' ) );

			// // Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_THEME_HEADING_COLORS_DIR . 'dynamic-css/dynamic.css.php';
			}
		}
	}

	/**
	 *  Kicking this off by creating an object.
	 */
	new Astra_Heading_Colors();

}
