<?php
/**
 * Deprecated Functions of Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.23
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'astra_blog_post_thumbnai_and_title_order' ) ) :

	/**
	 * Blog post thumbnail & title order
	 *
	 * @since 1.4.9
	 * @deprecated 1.4.9 Use astra_blog_post_thumbnail_and_title_order()
	 * @see astra_blog_post_thumbnail_and_title_order()
	 *
	 * @return void
	 */
	function astra_blog_post_thumbnai_and_title_order() {
		_deprecated_function( __FUNCTION__, '1.4.9', 'astra_blog_post_thumbnail_and_title_order()' );

		astra_blog_post_thumbnail_and_title_order();
	}

endif;

if ( ! function_exists( 'get_astra_secondary_class' ) ) :

	/**
	 * Retrieve the classes for the secondary element as an array.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use astra_get_secondary_class()
	 * @see astra_get_secondary_class()
	 *
	 * @return void
	 */
	function get_astra_secondary_class( $class = '' ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'astra_get_secondary_class()' );

		astra_get_secondary_class( $class = '' );
	}

endif;

if ( ! function_exists( 'deprecated_astra_color_palette' ) ) :

	/**
	 * Depreciating astra_color_palletes filter.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use astra_deprecated_color_palette()
	 * @see astra_deprecated_color_palette()
	 *
	 * @return void
	 */
	function deprecated_astra_color_palette( $color_palette ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'astra_deprecated_color_palette()' );

		astra_deprecated_color_palette( $color_palette );
	}

endif;

if ( ! function_exists( 'deprecated_astra_sigle_post_navigation_enabled' ) ) :

	/**
	 * Deprecating astra_sigle_post_navigation_enabled filter.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use astra_deprecated_sigle_post_navigation_enabled()
	 * @see astra_deprecated_sigle_post_navigation_enabled()
	 *
	 * @return void
	 */
	function deprecated_astra_sigle_post_navigation_enabled( $post_nav ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'astra_deprecated_sigle_post_navigation_enabled()' );

		astra_deprecated_sigle_post_navigation_enabled( $post_nav );
	}

endif;

if ( ! function_exists( 'deprecated_astra_primary_header_main_rt_section' ) ) :

	/**
	 * Deprecating astra_primary_header_main_rt_section filter.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use astra_deprecated_primary_header_main_rt_section()
	 * @see astra_deprecated_primary_header_main_rt_section()
	 *
	 * @return void
	 */
	function deprecated_astra_primary_header_main_rt_section( $elements, $header ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'astra_deprecated_primary_header_main_rt_section()' );

		astra_deprecated_primary_header_main_rt_section( $elements, $header );
	}

endif;

if ( ! function_exists( 'astar' ) ) :

	/**
	 * Get a specific property of an array without needing to check if that property exists.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use astra_get_prop()
	 * @see astra_get_prop()
	 *
	 * @return void
	 */
	function astar( $array, $prop, $default = null ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'astra_get_prop()' );

		astra_get_prop( $array, $prop, $default = null );
	}

endif;
