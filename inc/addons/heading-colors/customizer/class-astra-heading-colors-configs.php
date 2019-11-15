<?php
/**
 * Heading Colors Options for Astra theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2019, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Heading_Colors_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Heading_Colors_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Astra Heading Colors Settings.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since x.x.x
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				// Option: Base Heading Color.
				array(
					'default'   => '',
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'priority'  => 18,
					'name'      => ASTRA_THEME_SETTINGS . '[heading-base-color]',
					'title'     => __( 'Base Heading Color', 'astra-addon' ),
					'section'   => 'section-colors-body',
				),

				/**
				 * Heading Typography starts here - h1 - h3
				 */

				/**
				 * Option: Heading <H1> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h1]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-h1' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'section'   => 'section-content-typo',
					'priority'  => 5,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h1]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h1]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-h1' ),
					'section'           => 'section-content-typo',
					'priority'          => 7,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h1]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h1]',
					'section'   => 'section-content-typo',
					'default'   => astra_get_option( 'text-transform-h1' ),
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'select',
					'priority'  => 8,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Line Height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h1]',
					'section'           => 'section-content-typo',
					'default'           => '',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'type'              => 'control',
					'control'           => 'ast-slider',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'priority'          => 8,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h2]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'default'   => astra_get_option( 'font-family-h2' ),
					'section'   => 'section-content-typo',
					'priority'  => 10,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h2]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h2]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'section'           => 'section-content-typo',
					'default'           => astra_get_option( 'font-weight-h2' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'priority'          => 12,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h2]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h2]',
					'section'   => 'section-content-typo',
					'default'   => astra_get_option( 'text-transform-h2' ),
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'select',
					'transport' => 'postMessage',
					'priority'  => 13,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Line Height
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h2]',
					'section'           => 'section-content-typo',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'default'           => '',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'priority'          => 14,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h3]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-h3' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'section'   => 'section-content-typo',
					'priority'  => 15,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h3]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h3]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-h3' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'section'           => 'section-content-typo',
					'priority'          => 17,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h3]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h3]',
					'type'      => 'control',
					'section'   => 'section-content-typo',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-h3' ),
					'transport' => 'postMessage',
					'control'   => 'select',
					'priority'  => 18,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Line Height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h3]',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'section'           => 'section-content-typo',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => '',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'priority'          => 19,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Astra_Heading_Colors_Configs();
