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
	function get_astra_secondary_class() {
		_deprecated_function( __FUNCTION__, '1.5.2', 'astra_get_secondary_class()' );

		astra_get_secondary_class();
	}

endif;
