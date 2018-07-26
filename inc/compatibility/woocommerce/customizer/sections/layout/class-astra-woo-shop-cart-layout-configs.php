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

if ( ! class_exists( 'Astra_Woo_Shop_Cart_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Woo_Shop_Cart_Layout_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Astra-WooCommerce Shop Cart Layout Customizer Configurations.
		 *
		 * @param Array                $configurations
		 * @param WP_Customize_Manager $wp_customize
		 * @since x.x.x
		 * @return void
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Cart upsells
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[enable-cart-upsells]',
					'section'  => 'section-woo-shop-cart',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => astra_get_option( 'enable-cart-upsells' ),
					'title'    => __( 'Enable Upsells', 'astra' ),
					'priority' => 10,
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}

new Astra_Woo_Shop_Cart_Layout_Configs;
