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

				/**
				 * Colors & Background - Panels & Sections
				 */
				array(
					'name'     => 'section-colors-content',
					'type'     => 'section',
					'title'    => __( 'Content', 'astra-addon' ),
					'panel'    => 'panel-global',
					'section'  => 'section-colors-background',
					'priority' => 35,
				),
				array(
					'name'     => 'section-colors-header',
					'type'     => 'section',
					'title'    => __( 'Header', 'astra-addon' ),
					'panel'    => 'panel-colors-background',
					'priority' => 20,
				),

				// Option: Heading 1 <h1> Color.
				array(
					'default'   => '',
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'name'      => ASTRA_THEME_SETTINGS . '[h1-color]',
					'title'     => __( 'Heading 1 Color', 'astra-addon' ),
					'section'   => 'section-colors-content',
				),

				// Option: Heading 2 <h2> Color.
				array(
					'default'   => '',
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'name'      => ASTRA_THEME_SETTINGS . '[h2-color]',
					'title'     => __( 'Heading 2 Color', 'astra-addon' ),
					'section'   => 'section-colors-content',
				),

				// Option: Heading 3 <h3> Color.
				array(
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'name'      => ASTRA_THEME_SETTINGS . '[h3-color]',
					'default'   => '',
					'title'     => __( 'Heading 3 Color', 'astra-addon' ),
					'section'   => 'section-colors-content',
				),

				// Option: Heading 4 <h4> Color.
				array(
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'default'   => '',
					'name'      => ASTRA_THEME_SETTINGS . '[h4-color]',
					'title'     => __( 'Heading 4 Color', 'astra-addon' ),
					'section'   => 'section-colors-content',
				),

				// Option: Heading 5 <h5> Color.
				array(
					'type'      => 'control',
					'control'   => 'ast-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => ASTRA_THEME_SETTINGS . '[h5-color]',
					'title'     => __( 'Heading 5 Color', 'astra-addon' ),
					'section'   => 'section-colors-content',
				),

				// Option: Heading 6 <h6> Color.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[h6-color]',
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'default'   => '',
					'title'     => __( 'Heading 6 Color', 'astra-addon' ),
					'section'   => 'section-colors-content',
				),

			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Astra_Heading_Colors_Configs();
