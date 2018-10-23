<?php
/**
 * Navigation Menu customizations.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        https://wpastra.com/
 * @since       Astra x.x.x
 */

/**
 * Page menu item classes.
 *
 * @since x.x.x
 *
 * @param array   $atts {
 *       The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $href The href attribute.
 * }
 * @param WP_Post $page         Page data object.
 * @param int     $depth        Depth of page, used for padding.
 * @param array   $args         An array of arguments.
 * @param int     $current_page ID of the current page.
 *
 * @return array menu item arguments.
 */
function astra_page_menu_item_attributes( $atts, $page, $depth, $args, $current_page ) {
	if ( 'primary' == $args['theme_location'] || 'above_header_menu' == $args['theme_location'] || 'below_header_menu' == $args['theme_location'] ) {
		if ( ! isset( $atts['class'] ) ) {
			$atts['class'] = '';
		}

		$atts['class'] = $atts['class'] . ' sub-menu ';
	}

	return $atts;
}

add_filter( 'page_menu_link_attributes', 'astra_page_menu_item_attributes', 10, 5 );
