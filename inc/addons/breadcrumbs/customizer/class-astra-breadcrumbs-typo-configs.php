<?php
/**
 * Typography - Breadcrumbs Options for theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2019, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.7.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.7.0
 */
if ( ! class_exists( 'Astra_Breadcrumbs_Typo_Configs' ) ) {

	/**
	 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
	 */
	class Astra_Breadcrumbs_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.7.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = Astra_Theme_Options::defaults();

			$_configs = array(

				/*
				 * Breadcrumb Typography
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'default'   => astra_get_option( 'section-breadcrumb-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Typography', 'astra' ),
					'section'   => 'section-breadcrumb',
					'transport' => 'postMessage',
					'priority'  => 60,
				),

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'breadcrumb-font-family',
					'default'   => astra_get_option( 'breadcrumb-font-family' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra' ),
					'connect'   => 'breadcrumb-font-weight',
					'priority'  => 5,
				),

				/**
				 * Option: Font Weight
				 */
				array(
					'name'              => 'breadcrumb-font-weight',
					'control'           => 'ast-font',
					'parent'            => ASTRA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'breadcrumb-font-weight' ),
					'title'             => __( 'Font Weight', 'astra' ),
					'connect'           => 'breadcrumb-font-family',
					'priority'          => 10,
				),

				/**
				 * Option: Font Size
				 */
				array(
					'name'        => 'breadcrumb-font-size',
					'control'     => 'ast-responsive',
					'parent'      => ASTRA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'default'     => astra_get_option( 'breadcrumb-font-size' ),
					'transport'   => 'postMessage',
					'title'       => __( 'Font Size', 'astra' ),
					'priority'    => 15,
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Line Height
				 */
				array(
					'name'              => 'breadcrumb-line-height',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'default'           => '',
					'parent'            => ASTRA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra' ),
					'suffix'            => '',
					'priority'          => 20,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'breadcrumb-text-transform',
					'control'   => 'ast-select',
					'parent'    => ASTRA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'default'   => astra_get_option( 'breadcrumb-text-transform' ),
					'title'     => __( 'Text Transform', 'astra' ),
					'transport' => 'postMessage',
					'priority'  => 25,
					'choices'   => array(
						''           => __( 'Inherit', 'astra' ),
						'none'       => __( 'None', 'astra' ),
						'capitalize' => __( 'Capitalize', 'astra' ),
						'uppercase'  => __( 'Uppercase', 'astra' ),
						'lowercase'  => __( 'Lowercase', 'astra' ),
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
new Astra_Breadcrumbs_Typo_Configs;
