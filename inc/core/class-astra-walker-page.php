<?php
/**
 * Custom wp_nav_menu walker.
 *
 * @package Astra WordPress theme
 */

if ( ! class_exists( 'Astra_Walker_Page' ) ) {

	/**
	 * Astra custom navigation walker.
	 *
	 * @since x.x.x
	 */
	class Astra_Walker_Page extends Walker_Page {

		/**
		 * Outputs the beginning of the current level in the tree before elements are output.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param int    $depth  Optional. Depth of page. Used for padding. Default 0.
		 * @param array  $args   Optional. Arguments for outputting the next level.
		 *                       Default empty array.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
				$t = "\t";
				$n = "\n";
			} else {
				$t = '';
				$n = '';
			}
			$indent  = str_repeat( $t, $depth );
			$output .= "{$n}{$indent}<ul class='children sub-menu'>{$n}";
		}

	}
}

if ( ! function_exists( 'astra_page_menu_item_attributes' ) ) :

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
				$atts['class'] = array();
			}

			$atts['class'][] = 'ast-menu-item';

			$atts['class'] = implode( ' ', $atts['class'] );

		}

		return $atts;
	}
	add_filter( 'page_menu_link_attributes', 'astra_page_menu_item_attributes', 10, 5 );

endif;

if ( ! function_exists( 'astra_page_menu_item_css_class' ) ) :

	/**
	 * Page menu item classes
	 *
	 * @since x.x.x
	 *
	 * @see wp_list_pages()
	 *
	 * @param array   $css_class    An array of CSS classes to be applied
	 *                              to each list item.
	 * @param WP_Post $page         Page data object.
	 * @param int     $depth        Depth of page, used for padding.
	 * @param array   $args         An array of arguments.
	 * @param int     $current_page ID of the current page.
	 *
	 * @return array menu item classes.
	 */
	function astra_page_menu_item_css_class( $css_class, $page, $depth, $args, $current_page ) {
		$css_class[] = 'ast-menu-item-li';

		if ( in_array( 'page_item_has_children', $css_class ) ) {
			$css_class[] = 'menu-item-has-children';
		}

		if ( in_array( 'current_page_item', $css_class ) ) {
			$css_class[] = 'current-menu-item';
		}

		if ( in_array( 'current_page_ancestor', $css_class ) ) {
			$css_class[] = 'current-menu-ancestor';
		}

		return $css_class;
	}

	add_filter( 'page_css_class', 'astra_page_menu_item_css_class', 10, 5 );

endif;
