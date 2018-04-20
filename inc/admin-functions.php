<?php
/**
 * Admin functions - Functions that add some functionality to WordPress admin panel
 *
 * @package Astra
 * @since 1.0.0
 */

/**
 * Register menus
 */
if ( ! function_exists( 'astra_register_menu_locations' ) ) {

	/**
	 * Register menus
	 *
	 * @since 1.0.0
	 */
	function astra_register_menu_locations() {

		/**
		 * Menus
		 */
		register_nav_menus(
			array(
				'primary'     => __( 'Primary Menu', 'astra' ),
				'footer_menu' => __( 'Footer Menu', 'astra' ),
			)
		);
	}
}

add_action( 'init', 'astra_register_menu_locations' );


if ( ! function_exists( 'astra_theme_customizer_mobile_header_section' ) ) :
	/**
	 * Returns the mobile header section.
	 *
	 * Customizer Setting which added inside the Mobile Header Section
	 * which can be moved to the other section if needed.
	 *
	 * @since x.x.x
	 * @return mixed
	 */
	function astra_theme_customizer_mobile_header_section() {

		return apply_filters( 'astra_customizer_mobile_primary_header_layout', 'section-mobile-header' );
	}

endif;
