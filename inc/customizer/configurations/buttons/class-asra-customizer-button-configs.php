<?php
/**
 * Astra Theme Customizer Configuration Base.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra x.x.x
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since x.x.x
 */
if ( ! class_exists( 'Astra_Customizer_Button_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Customizer_Button_Configs extends Astra_Customizer_Config_Base {

		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'  => 'new-button',
					'type'  => 'section',
					'title' => __( 'New Button', 'astra' ),
				),

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[button-color-nikhil]',
					'type'              => 'control',
					'control'           => 'color',
					'section'           => 'new-button',
					'title'             => __( 'Button Text Color', 'astra' ),
					'default'           => '',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_hex_color' ),
				),

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[test-select-3]',
					'type'              => 'control',
					'control'           => 'select',
					'choices'           => array(
						'value1' => __( 'Value 1' ),
						'value2' => __( 'Value 2' ),
						'value3' => __( 'Value 3' ),
					),
					'required'          => array(
						'conditions' => array(
							array( ASTRA_THEME_SETTINGS . '[test-select-2]', '==', [ 'value1' ] ),
						),
						'operator'   => 'OR',
					),
					'section'           => 'new-button',
					'title'             => __( 'Button Select 3', 'astra' ),
					'default'           => 'value1',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
				),

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[button-color-new]',
					'type'              => 'control',
					'control'           => 'color',
					'section'           => 'new-button',
					'title'             => __( 'Button Text Colo New', 'astra' ),
					'default'           => '',
					'required'          => array(
						'conditions' => array(
							array( ASTRA_THEME_SETTINGS . '[test-select]', '==', [ 'value1', 'value2' ] ),
							array( ASTRA_THEME_SETTINGS . '[test-select-2]', '==', [ 'value1', 'value2' ] ),
						),
						'operator'   => 'OR',
					),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_hex_color' ),
				),
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[test-select]',
					'type'              => 'control',
					'control'           => 'select',
					'choices'           => array(
						'value1' => __( 'Value 1' ),
						'value2' => __( 'Value 2' ),
						'value3' => __( 'Value 3' ),
					),
					'section'           => 'new-button',
					'title'             => __( 'Button Select', 'astra' ),
					'default'           => 'value1',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
				),
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[test-select-2]',
					'type'              => 'control',
					'control'           => 'select',
					'choices'           => array(
						'value1' => __( 'Value 1' ),
						'value2' => __( 'Value 2' ),
						'value3' => __( 'Value 3' ),
					),
					'section'           => 'new-button',
					'title'             => __( 'Button Select 2', 'astra' ),
					'default'           => 'value1',
					'required'          => array(
						'conditions' => array(
							array( ASTRA_THEME_SETTINGS . '[test-select]', '==', [ 'value1' ] ),
						),
						'operator'   => 'OR',
					),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
				),
				
			);

			return array_merge( $configurations, $_configs );
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Button_Configs;
