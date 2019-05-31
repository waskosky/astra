<?php
/**
 * Site Layout Option for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Site_Layout_Configs' ) ) {

	/**
	 * Register Site Layout Customizer Configurations.
	 */
	class Astra_Site_Layout_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Site Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Select Skin for Blog Design.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[site-content-skin]',
					'type'     => 'control',
					'default'  => astra_get_option( 'site-content-skin' ),
					'control'  => 'select',
					'section'  => 'section-container-layout',
					'priority' => 5,
					'title'    => __( 'Select Skin', 'astra' ),
					'choices'  => array(
						''         => __( 'Legacy', 'astra' ),
						'new-skin' => __( 'New Skin', 'astra' ),
					),
				),

				/**
				 * Option: Divider
				 */

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[site-content-skin-divider]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-container-layout',
					'priority' => 8,
					'settings' => array(),
				),

				array(
					'name'        => ASTRA_THEME_SETTINGS . '[site-content-width]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'default'     => 1200,
					'section'     => 'section-container-layout',
					'priority'    => 10,
					'title'       => __( 'Container Width', 'astra' ),
					'required'    => array( ASTRA_THEME_SETTINGS . '[site-layout]', '==', 'ast-full-width-layout' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Site_Layout_Configs;
