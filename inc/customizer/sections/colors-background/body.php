<?php
/**
 * Styling Options for Astra Theme.
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
	/**
	 * Option: Theme Color
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[theme-color]', array(
			'default'           => '#0274be',
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Astra_Control_Color(
			$wp_customize, ASTRA_THEME_SETTINGS . '[theme-color]', array(
				'type'     => 'ast-color',
				'section'  => 'section-colors-body',
				'priority' => 5,
				'label'    => __( 'Theme Color', 'astra' ),
			)
		)
	);

	/**
	 * Option: Link Color
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[link-color]', array(
			'default'           => '#0274be',
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Astra_Control_Color(
			$wp_customize, ASTRA_THEME_SETTINGS . '[link-color]', array(
				'type'     => 'ast-color',
				'section'  => 'section-colors-body',
				'priority' => 5,
				'label'    => __( 'Link Color', 'astra' ),
			)
		)
	);

	/**
	 * Option: Text Color
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[text-color]', array(
			'default'           => '#3a3a3a',
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Astra_Control_Color(
			$wp_customize, ASTRA_THEME_SETTINGS . '[text-color]', array(
				'type'     => 'ast-color',
				'section'  => 'section-colors-body',
				'priority' => 10,
				'label'    => __( 'Text Color', 'astra' ),
			)
		)
	);


	/**
	 * Option: Link Hover Color
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[link-h-color]', array(
			'default'           => '#3a3a3a',
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Astra_Control_Color(
			$wp_customize, ASTRA_THEME_SETTINGS . '[link-h-color]', array(
				'type'     => 'ast-color',
				'section'  => 'section-colors-body',
				'priority' => 15,
				'label'    => __( 'Link Hover Color', 'astra' ),
			)
		)
	);


	/**
	 * Option: Divider
	 */
	$wp_customize->add_control(
		new Astra_Control_Divider(
			$wp_customize, ASTRA_THEME_SETTINGS . '[divider-outside-bg-color]', array(
				'type'     => 'ast-divider',
				'section'  => 'section-colors-body',
				'priority' => 20,
				'settings' => array(),
			)
		)
	);
