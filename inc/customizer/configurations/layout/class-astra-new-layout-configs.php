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

if ( ! class_exists( 'Astra_New_Layout_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	class Astra_New_Layout_Configs extends Astra_Customizer_Config_Base {

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
					'name'       => ASTRA_THEME_SETTINGS . '[settings-toggle-new]',
					'default'    => astra_get_option( 'settings-toggle-new' ),
					'type'       => 'control',
					'control'    => 'ast-settings-toggle',
					'label'      => __( 'Advance Settings', 'astra' ),
					'text'       => __( 'Advance Settings', 'astra' ),
					'section'    => 'section-site-new',
					'transport'  => 'postMessage',
					'title'      => __( 'Advanced Settings', 'astra' ),
					'priority'   => 5,
					'ast_fields' => array(
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[transparent-header-bg-color-responsive]',
							'default'    => $defaults['settings-toggle-new']['transparent-header-bg-color-responsive'],
							'type'       => 'control',
							'transport'  => 'postMessage',
							'control'    => 'ast-responsive-color',
							'label'      => __( 'Background Overlay Color', 'astra' ),
							'section'    => 'section-colors-transparent-header',
							'responsive' => true,
							'rgba'       => true,
						),
						array(
							'name'      => ASTRA_THEME_SETTINGS . '[font-family-primary-menu]',
							'type'      => 'control',
							'control'   => 'ast-font',
							'font_type' => 'ast-font-family',
							'default'   => astra_get_option( 'font-family-primary-menu' ),
							'label'     => __( 'Font Family', 'astra-addon' ),
							'section'   => 'section-primary-header-typo',
							'priority'  => 22,
							'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-primary-menu]',
						),
						array(
							'name'              => ASTRA_THEME_SETTINGS . '[font-weight-primary-menu]',
							'type'              => 'control',
							'control'           => 'ast-font',
							'font_type'         => 'ast-font-weight',
							'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
							'default'           => astra_get_option( 'font-weight-primary-menu' ),
							'label'             => __( 'Font Weight', 'astra-addon' ),
							'section'           => 'section-primary-header-typo',
							'priority'          => 23,
							'connect'           => ASTRA_THEME_SETTINGS . '[font-family-primary-menu]',
						),
						array(
							'name'        => ASTRA_THEME_SETTINGS . '[font-size-site-title]',
							'type'        => 'control',
							'control'     => 'ast-responsive',
							'section'     => 'section-primary-header-typo',
							'default'     => astra_get_option( 'font-size-site-title' ),
							'transport'   => 'postMessage',
							'label'       => __( 'Font Size', 'astra' ),
							'input_attrs' => array(
								'min' => 0,
							),
							'units'       => array(
								'px' => 'px',
								'em' => 'em',
							),
						),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}


new Astra_New_Layout_Configs();




