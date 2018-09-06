<?php
/**
 * Animation Styling output for Astra Theme.
 *
 * @package     Astra
 * @subpackage  Class
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Animation CSS
 */
if ( ! class_exists( 'Astra_Animation_CSS' ) ) {

	/**
	 * Animation CSS
	 */
	class Astra_Animation_CSS {

		/**
		 *  CSS Aniamtion Properties.
		 *
		 * @since x.x.x
		 */
		public static function animations() {
			return array(
				'slide-up'   => array(
					'normal' => array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transform'  => 'translateY(0.5em)',
						'transition' => 'transform 300ms',
					),
					'hover'  => array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transform'  => 'translateY(0)',
						'transition' => 'transform 300ms',
					),
				),
				'slide-down' => array(
					'normal' => array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transform'  => 'translateY(-0.5em)',
						'transition' => 'transform 300ms',
					),
					'hover'  => array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transform'  => 'translateY(0)',
						'transition' => 'transform 300ms',
					),
				),
				'fade'       => array(
					'normal' => array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transition' => 'opacity 300ms',
					),
					'hover'  => array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transition' => 'opacity 300ms',
					),
				),
				'scale'      => array(
					'normal' => array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transform'  => 'scale(0.5)',
						'transition' => 'transform 300ms',
					),
					'hover'  => array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transform'  => 'scale(1)',
						'transition' => 'transform 300ms',
					),
				),
			);
		}

		/**
		 * Get animation properties.
		 *
		 * @since x.x.x
		 * @param String $animation Animation name.
		 * @param String $state Hover or Normal state for animation.
		 *
		 * @return Array Animation CSS properties if the Animation exists else returns an empty array.
		 */
		public static function get_animation_prop( $animation, $state ) {
			$animations = self::animations();

			if ( isset( $animations[ $animation ] ) && isset( $animations[ $animation ][ $state ] ) ) {
				return $animations[ $animation ][ $state ];
			}

			return array();
		}

	}
}
