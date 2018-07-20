<?php
/**
 * Site Layout Option for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	if ( ! class_exists( 'Astra_site_layout_Configs' ) ) {

		/**
		 * Customizer Sanitizes Initial setup
		 */
		class Astra_site_layout_Configs extends Astra_Customizer_Config_Base {

			public function register_configuration( $configurations, $wp_customize ) {

				$_configs = array(

					array(
						'name'        => ASTRA_THEME_SETTINGS . '[site-content-width]',
						'type'        => 'control',
						'control'     => 'ast-slider',
						'default'     => 1200,
						'section'     => 'section-container-layout',
						'priority'    => 10,
						'title'       => __( 'Container Width', 'astra' ),
						'suffix'      => '',
						'input_attrs' => array(
							'min'  => 768,
							'step' => 1,
							'max'  => 1920,
						),
					)
				);

				return array_merge( $configurations, $_configs );
			}

		}
	}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_site_layout_Configs;
