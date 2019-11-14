<?php
/**
 * Heading Colors - Dynamic CSS
 *
 * @package Astra
 * @since x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Heading Colors
 */
add_filter( 'astra_dynamic_theme_css', 'astra_heading_colors_section_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since x.x.x
 */
function astra_heading_colors_section_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * Heading Colors - h1 - h6.
	 */
	$h1_color = astra_get_option( 'h1-color' );
	$h2_color = astra_get_option( 'h2-color' );
	$h3_color = astra_get_option( 'h3-color' );
	$h4_color = astra_get_option( 'h4-color' );
	$h5_color = astra_get_option( 'h5-color' );
	$h6_color = astra_get_option( 'h6-color' );

	/**
	 * Normal Colors without reponsive option.
	 * [1]. Heading Colors
	 */
	$css_output = array(

		/**
		 * Content <h1> to <h6> headings
		 */
		'h1, .entry-content h1' => array(
			'color' => esc_attr( $h1_color ),
		),
		'h2, .entry-content h2' => array(
			'color' => esc_attr( $h2_color ),
		),
		'h3, .entry-content h3' => array(
			'color' => esc_attr( $h3_color ),
		),
		'h4, .entry-content h4' => array(
			'color' => esc_attr( $h4_color ),
		),
		'h5, .entry-content h5' => array(
			'color' => esc_attr( $h5_color ),
		),
		'h6, .entry-content h6' => array(
			'color' => esc_attr( $h6_color ),
		),
	);

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	$dynamic_css .= $css_output;

	return $dynamic_css;
}
