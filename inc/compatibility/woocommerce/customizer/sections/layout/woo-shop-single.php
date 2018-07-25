<?php
/**
 * WooCommerce Options for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Woo_Shop_Single_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Woo_Shop_Single_Layout_Configs extends Astra_Customizer_Config_Base {

		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				* Option: Disable Breadcrumb
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-disable]',
					'section'  => 'section-woo-shop-single',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => astra_get_option( 'single-product-breadcrumb-disable' ),
					'title'    => __( 'Disable Breadcrumb', 'astra' ),
					'priority' => 10,
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}

new Astra_Woo_Shop_Single_Layout_Configs;


