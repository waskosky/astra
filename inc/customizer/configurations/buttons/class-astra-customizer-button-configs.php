<?php
/**
 * Astra Theme Customizer Configuration Base.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.4.3
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Astra_Customizer_Button_Configs' ) ) {

	/**
	 * Register Button Customizer Configurations.
	 */
	class Astra_Customizer_Button_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Button Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Button Color
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[button-color]',
					'default' => '',
					'type'    => 'control',
					'control' => 'ast-color',
					'section' => 'section-theme-button',
					'title'   => __( 'Button Text Color', 'astra' ),
				),

				/**
				 * Option: Button Hover Color
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[button-h-color]',
					'default' => '',
					'section' => 'section-theme-button',
					'type'    => 'control',
					'control' => 'ast-color',
					'title'   => __( 'Button Text Hover Color', 'astra' ),
				),

				/**
				 * Option: Button Background Color
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[button-bg-color]',
					'default' => '',
					'section' => 'section-theme-button',
					'type'    => 'control',
					'control' => 'ast-color',
					'title'   => __( 'Button Background Color', 'astra' ),
				),

				/**
				 * Option: Button Background Hover Color
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[button-bg-h-color]',
					'section' => 'section-theme-button',
					'default' => '',
					'type'    => 'control',
					'control' => 'ast-color',
					'title'   => __( 'Button Background Hover Color', 'astra' ),
				),

				/**
				 * Option: Button Radius
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[button-radius]',
					'section'     => 'section-theme-button',
					'default'     => astra_get_option( 'button-radius' ),
					'type'        => 'control',
					'control'     => 'number',
					'title'       => __( 'Button Radius', 'astra' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Vertical Padding
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[button-v-padding]',
					'section'     => 'section-theme-button',
					'default'     => astra_get_option( 'button-v-padding' ),
					'title'       => __( 'Vertical Padding', 'astra' ),
					'type'        => 'control',
					'control'     => 'number',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Horizontal Padding
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[button-h-padding]',
					'section'     => 'section-theme-button',
					'default'     => astra_get_option( 'button-h-padding' ),
					'title'       => __( 'Horizontal Padding', 'astra' ),
					'type'        => 'control',
					'control'     => 'number',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Primary Header Button Colors Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[primary-header-button-color-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-header',
					'title'    => __( 'Primary Header Button', 'astra-addon' ),
					'settings' => array(),
					'priority' => 17,
					'required' => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Primary Header Button Colors Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'default'   => astra_get_option( 'primary-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Colors', 'astra' ),
					'section'   => 'section-header',
					'transport' => 'postMessage',
					'priority'  => 18,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Primary Header Button Border Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'default'   => astra_get_option( 'primary-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Border', 'astra' ),
					'section'   => 'section-header',
					'transport' => 'postMessage',
					'priority'  => 19,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),

				/**
				* Option: Button Text Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-text-color',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'header-main-rt-section-button-text-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'tab'       => __( 'Normal', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Text Color', 'astra' ),
				),

				/**
				* Option: Button Text Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-text-h-color',
					'default'   => astra_get_option( 'header-main-rt-section-button-text-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'tab'       => __( 'Hover', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Text Hover Color', 'astra' ),
				),

				/**
				* Option: Button Background Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-back-color',
					'default'   => astra_get_option( 'header-main-rt-section-button-back-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'tab'       => __( 'Normal', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Background Color', 'astra' ),
				),

				/**
				* Option: Button Button Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-back-h-color',
					'default'   => astra_get_option( 'header-main-rt-section-button-back-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'tab'       => __( 'Hover', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Background Hover Color', 'astra' ),
				),

				// Option: Custom Menu Button Border.
				array(
					'type'           => 'control',
					'control'        => 'ast-responsive-spacing',
					'name'           => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-padding]',
					'section'        => 'section-header',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 20,
					'required'       => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'default'        => astra_get_option( 'header-main-rt-section-button-padding' ),
					'title'          => __( 'Button Padding', 'astra' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra' ),
						'right'  => __( 'Right', 'astra' ),
						'bottom' => __( 'Bottom', 'astra' ),
						'left'   => __( 'Left', 'astra' ),
					),
				),

				/**
				* Option: Button Border Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-border-color',
					'default'   => astra_get_option( 'header-main-rt-section-button-border-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'tab'       => __( 'Normal', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Border Color', 'astra' ),
				),

				/**
				* Option: Button Border Size
				*/
				array(
					'type'           => 'control',
					'control'        => 'ast-border',
					'name'           => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-border-size]',
					'section'        => 'section-header',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'required'       => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'priority'       => 21,
					'default'        => astra_get_option( 'header-main-rt-section-button-border-size' ),
					'title'          => __( 'Border Size', 'astra' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra' ),
						'right'  => __( 'Right', 'astra' ),
						'bottom' => __( 'Bottom', 'astra' ),
						'left'   => __( 'Left', 'astra' ),
					),
				),

				/**
				* Option: Button Border Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-border-h-color',
					'default'   => astra_get_option( 'header-main-rt-section-button-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'tab'       => __( 'Hover', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Border Hover Color', 'astra' ),
				),

				/**
				* Option: Button Border Radius
				*/
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-border-radius]',
					'default'     => astra_get_option( 'header-main-rt-section-button-border-radius' ),
					'type'        => 'control',
					'control'     => 'ast-slider',
					'transport'   => 'postMessage',
					'section'     => 'section-header',
					'required'    => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'priority'    => 22,
					'title'       => __( 'Border Radius', 'astra' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Transparent Header Button Colors Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-header',
					'title'    => __( 'Transparent Header Button', 'astra-addon' ),
					'settings' => array(),
					'priority' => 23,
					'required' => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Transparent Header Button Colors Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'default'   => astra_get_option( 'transparent-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Colors', 'astra' ),
					'section'   => 'section-header',
					'transport' => 'postMessage',
					'priority'  => 24,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Transparent Header Button Border Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'default'   => astra_get_option( 'transparent-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Border', 'astra' ),
					'section'   => 'section-header',
					'transport' => 'postMessage',
					'priority'  => 25,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),

				/**
				* Option: Button Text Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-text-color',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'header-main-rt-trans-section-button-text-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'tab'       => __( 'Normal', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Text Color', 'astra' ),
				),

				/**
				* Option: Button Text Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-text-h-color',
					'default'   => astra_get_option( 'header-main-rt-trans-section-button-text-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'tab'       => __( 'Hover', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Text Hover Color', 'astra' ),
				),

				/**
				* Option: Button Background Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-back-color',
					'default'   => astra_get_option( 'header-main-rt-trans-section-button-back-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'tab'       => __( 'Normal', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Background Color', 'astra' ),
				),

				/**
				* Option: Button Button Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-back-h-color',
					'default'   => astra_get_option( 'header-main-rt-trans-section-button-back-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'tab'       => __( 'Hover', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Button Background Hover Color', 'astra' ),
				),

				// Option: Custom Menu Button Border.
				array(
					'type'           => 'control',
					'control'        => 'ast-responsive-spacing',
					'name'           => ASTRA_THEME_SETTINGS . '[header-main-rt-trans-section-button-padding]',
					'section'        => 'section-header',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 26,
					'required'       => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'default'        => astra_get_option( 'header-main-rt-trans-section-button-padding' ),
					'title'          => __( 'Button Padding', 'astra' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra' ),
						'right'  => __( 'Right', 'astra' ),
						'bottom' => __( 'Bottom', 'astra' ),
						'left'   => __( 'Left', 'astra' ),
					),
				),

				/**
				* Option: Button Border Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-border-color',
					'default'   => astra_get_option( 'header-main-rt-trans-section-button-border-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'tab'       => __( 'Normal', 'astra' ),
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Border Color', 'astra' ),
				),

				/**
				* Option: Button Border Size
				*/
				array(
					'type'           => 'control',
					'control'        => 'ast-border',
					'name'           => ASTRA_THEME_SETTINGS . '[header-main-rt-trans-section-button-border-size]',
					'section'        => 'section-header',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'required'       => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'priority'       => 26,
					'default'        => astra_get_option( 'header-main-rt-trans-section-button-border-size' ),
					'title'          => __( 'Border Size', 'astra' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra' ),
						'right'  => __( 'Right', 'astra' ),
						'bottom' => __( 'Bottom', 'astra' ),
						'left'   => __( 'Left', 'astra' ),
					),
				),

				/**
				* Option: Button Border Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-border-h-color',
					'default'   => astra_get_option( 'header-main-rt-trans-section-button-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'tab'       => __( 'Hover', 'astra' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Border Hover Color', 'astra' ),
				),

				/**
				* Option: Button Border Radius
				*/
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[header-main-rt-trans-section-button-border-radius]',
					'default'     => astra_get_option( 'header-main-rt-trans-section-button-border-radius' ),
					'type'        => 'control',
					'control'     => 'ast-slider',
					'transport'   => 'postMessage',
					'section'     => 'section-header',
					'required'    => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'priority'    => 26,
					'title'       => __( 'Border Radius', 'astra' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
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
new Astra_Customizer_Button_Configs;
