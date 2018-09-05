<?php
/**
 * Animation Styling output for Astra Theme.
 *
 * @package     Astra
 * @subpackage  Class
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.5.0
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
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Add animation.
		 *
		 * @since 1.5.0
		 * @param String $submenu_container_animation Animation name.
		 *
		 * @return array $css Animation css.
		 */
		public static function get_normal_animation( $submenu_container_animation ) {

			$css_output = '';

			switch ( $submenu_container_animation ) {
				case 'slide-up':
					$css_output = array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transform'  => 'translateY(0.5em)',
						'transition' => 'transform 300ms',
					);
					break;
				case 'slide-down':
					$css_output = array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transform'  => 'translateY(-0.5em)',
						'transition' => 'transform 300ms',
					);
					break;
				case 'fade':
					$css_output = array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transition' => 'opacity 300ms',
					);
					break;
				case 'scale':
					$css_output = array(
						'opacity'    => '0',
						'visibility' => 'hidden',
						'transform'  => 'scale(0.5)',
						'transition' => 'transform 300ms',
					);
					break;

				default:
					break;
			}

			return $css_output;
		}

		/**
		 * Add animation.
		 *
		 * @since 1.5.0
		 * @param String $submenu_container_animation Animation name.
		 *
		 * @return array $css Animation css.
		 */
		public static function get_normal_animation_css( $submenu_container_animation ) {

			if ( isset( $submenu_container_animation ) && '' !== $submenu_container_animation ) {
				$output = self::get_normal_animation( $submenu_container_animation );
			}
			return $output;
		}

		/**
		 * Get submenu container animation.
		 *
		 * @since 1.5.0
		 * @param String $submenu_container_animation Animation name.
		 *
		 * @return array $css Animation css.
		 */
		public static function get_hover_animation( $submenu_container_animation ) {

			$css_output = '';

			switch ( $submenu_container_animation ) {

				case 'slide-up':
					$css_output = array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transform'  => 'translateY(0)',
						'transition' => 'transform 300ms',
					);
					break;
				case 'slide-down':
					$css_output = array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transform'  => 'translateY(0)',
						'transition' => 'transform 300ms',
					);
					break;
				case 'fade':
					$css_output = array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transition' => 'opacity 300ms',
					);
					break;
				case 'scale':
					$css_output = array(
						'opacity'    => '1',
						'visibility' => 'visible',
						'transform'  => 'scale(1)',
						'transition' => 'transform 300ms',
					);
					break;
				default:
					break;
			}

			return $css_output;
		}

		/**
		 * Get submenu container animation.
		 *
		 * @since 1.5.0
		 * @param String $submenu_container_animation Animation name.
		 *
		 * @return array $css Animation css.
		 */
		public static function get_hover_animation_css( $submenu_container_animation ) {

			if ( isset( $submenu_container_animation ) && '' !== $submenu_container_animation ) {
				$output = self::get_hover_animation( $submenu_container_animation );
			}
			return $output;
		}

	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Animation_CSS::get_instance();
