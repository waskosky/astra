<?php
/**
 * Schema markup.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.5.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Custom wp_nav_menu walker.
 *
 * @package Astra WordPress theme
 */
if ( ! class_exists( 'Astra_Schema_Markup' ) ) {

	/**
	 * Astra Schema Markup.
	 *
	 * @since 1.5.4
	 */
	class Astra_Schema_Markup {

		public static function ast_creativework_schema( ) {

			if ( apply_filters( 'ast_creativework_schema_disable', true ) ) {
				echo astra_attr(
					'article-page',
					array(
						'itemtype'  => 'https://schema.org/CreativeWork',
						'itemscope' => 'itemscope',
						'id'        => 'post-' . get_the_id(),
						'class'     => join( ' ', get_post_class() ),

					)
				);
			}
			else {
				return;
			}
		}

	}

}
