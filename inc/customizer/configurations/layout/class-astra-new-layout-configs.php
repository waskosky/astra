<?php
/**
 * General Options for Astra Theme.
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

if ( ! class_exists( 'Astra_new_Layout_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	class Astra_new_Layout_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register new Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = Astra_Theme_Options::defaults();

			$_configs = array(

				/**
				 * Option: Header Layout
				 */
				array(
					'name'     => 'panel-layout-new',
					'type'     => 'panel',
					'priority' => 10,
					'title'    => __( 'Layout New', 'astra' ),
				),
				array(
					'name'     => 'section-site-new',
					'type'     => 'section',
					'priority' => 5,
					'title'    => __( 'Site Layout New', 'astra' ),
					'panel'    => 'panel-layout-new',
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[disable-primary-new]',
					'default'  => astra_get_option( 'disable-primary-new' ),
					'type'     => 'control',
					'control'  => 'checkbox',
					'section'  => 'section-site-new',
					'title'    => __( 'Disable Menu', 'astra' ),
					'priority' => 5,
				),
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[settings-toggle-new]',
					'default'    => astra_get_option( 'settings-toggle-new' ),
					'type'       => 'control',
					'control'    => 'ast-settings-toggle',
					'label'      => __( 'Advance Settings', 'astra' ),
					'text'       => __( 'Advance Settings', 'astra' ),
					'section'    => 'section-site-new',
					'title'      => __( 'Advanced Settings', 'astra' ),
					'priority'   => 5,
					'ast_fields' => array(
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[ast-new-layout-color-2]',
							'type'     => 'control',
							'control'  => 'ast-color',
							'label'    => __( 'Color 2', 'astra' ),
							'title'    => __( 'Widget Title Color 2', 'astra' ),
							'default'  => '',
						),
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[ast-new-layout-color]',
							'type'     => 'control',
							'label'    => __( 'Color 1', 'astra' ),
							'control'  => 'ast-color',
							'title'    => __( 'Widget Title Color', 'astra' ),
							'default'  => '',
						),
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[ast-new-layout-color-3]',
							'type'     => 'control',
							'label'    => __( 'Color 3', 'astra' ),
							'control'  => 'ast-color',
							'title'    => __( 'Widget Title Color', 'astra' ),
							'default'  => '#444444',
						),
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[transparent-header-color-site-title-responsive-new]',
							'default'    => $defaults['transparent-header-color-site-title-responsive'],
							'type'       => 'control',
							'label'    => __( 'Responsive Color 1', 'astra' ),
							'control'    => 'ast-responsive-color',
							'transport'  => 'postMessage',
							'title'      => __( 'Site Title Color', 'astra' ),
							'section'    => 'section-colors-transparent-header',
							'responsive' => true,
							'rgba'       => true
						),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}


new Astra_new_Layout_Configs();




