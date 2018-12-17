<?php
/**
 * Astra Attributes Class.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        https://wpastra.com/
 * @since       Astra x.x.x
 */

if ( ! class_exists( 'ariColor' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/lib/aricolor.php';
}

if ( ! class_exists( 'Astra_Color' ) ) :

	/**
	 * Class Astra_Color
	 */
	class Astra_Color extends ariColor {

		/**
		 * A proxy for the sanitize_color method.
		 *
		 * @param string|array $color The color.
		 * @param bool         $hash  Whether we want to include a hash (#) at the beginning or not.
		 * @return string             The sanitized hex color.
		 */
		public static function sanitize_hex( $color = '#FFFFFF', $hash = true ) {
			if ( ! $hash ) {
				return ltrim( self::sanitize_color( $color, 'hex' ), '#' );
			}
			return self::sanitize_color( $color, 'hex' );
		}

		/**
		 * Sanitize colors.
		 * Determine if the current value is a hex or an rgba color and call the appropriate method.
		 *
		 * @static
		 * @access public
		 * @since 0.8.5
		 * @param string|array $color The color.
		 * @param string       $mode  The mode to be used.
		 * @return string
		 */
		public static function sanitize_color( $color = '', $mode = 'auto' ) {
			if ( is_string( $color ) && 'transparent' == trim( $color ) ) {
				return 'transparent';
			}
			$obj = ariColor::newColor( $color );
			if ( 'auto' == $mode ) {
				$mode = $obj->mode;
			}
			return $obj->toCSS( $mode );
		}

		/**
		 * Gets the rgb value of a color.
		 *
		 * @static
		 * @access public
		 * @param string  $color   The color.
		 * @param boolean $implode Whether we want to implode the values or not.
		 * @return array|string
		 */
		public static function get_rgb( $color, $implode = false ) {
			$obj = ariColor::newColor( $color );

			if ( $implode ) {
				return $obj->toCSS( 'rgb' );
			}

			return array( $obj->red, $obj->green, $obj->blue );
		}

		/**
		 * Adjusts brightness of the $hex color.
		 *
		 * @static
		 * @access public
		 * @param   string  $hex    The hex value of a color.
		 * @param   integer $steps  Should be between -255 and 255. Negative = darker, positive = lighter.
		 * @return  string          Returns hex color.
		 */
		public static function adjust_brightness( $hex, $steps ) {
			$hex   = self::sanitize_hex( $hex, false );
			$steps = max( -255, min( 255, $steps ) );
			// Adjust number of steps and keep it inside 0 to 255.
			$red       = max( 0, min( 255, hexdec( substr( $hex, 0, 2 ) ) + $steps ) );
			$green     = max( 0, min( 255, hexdec( substr( $hex, 2, 2 ) ) + $steps ) );
			$blue      = max( 0, min( 255, hexdec( substr( $hex, 4, 2 ) ) + $steps ) );
			$red_hex   = str_pad( dechex( $red ), 2, '0', STR_PAD_LEFT );
			$green_hex = str_pad( dechex( $green ), 2, '0', STR_PAD_LEFT );
			$blue_hex  = str_pad( dechex( $blue ), 2, '0', STR_PAD_LEFT );
			return self::sanitize_hex( $red_hex . $green_hex . $blue_hex );
		}

		/**
		 * This function tries to compare the brightness of the colors.
		 * A return value of more than 125 is recommended.
		 * Combining it with the color_difference function above might make sense.
		 *
		 * @static
		 * @access public
		 * @param string $color_1 The 1st color.
		 * @param string $color_2 The 2nd color.
		 * @return string
		 */
		public static function brightness_difference( $color_1 = '#ffffff', $color_2 = '#000000' ) {
			$color_1     = self::sanitize_hex( $color_1, false );
			$color_2     = self::sanitize_hex( $color_2, false );
			$color_1_rgb = self::get_rgb( $color_1 );
			$color_2_rgb = self::get_rgb( $color_2 );
			$br_1        = ( 299 * $color_1_rgb[0] + 587 * $color_1_rgb[1] + 114 * $color_1_rgb[2] ) / 1000;
			$br_2        = ( 299 * $color_2_rgb[0] + 587 * $color_2_rgb[1] + 114 * $color_2_rgb[2] ) / 1000;
			return intval( abs( $br_1 - $br_2 ) );
		}

	}

endif;
