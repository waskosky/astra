<?php
/**
 * LifterLMS General Options for our theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2015, Brainstorm Force
 * @link        http://www.brainstormforce.com
 * @since       1.2.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	/**
	 * Option: Display Serial Number
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[learndash-lesson-serial-number]', array(
			'default'           => astra_get_option( 'learndash-lesson-serial-number' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		ASTRA_THEME_SETTINGS . '[learndash-lesson-serial-number]', array(
			'section'  => 'section-learndash',
			'label'    => __( 'Display Serial Number', 'astra-addon' ),
			'priority' => 5,
			'type'     => 'checkbox',
		)
	);

	/**
	 * Option: Differentiate Rows
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[learndash-differentiate-rows]', array(
			'default'           => astra_get_option( 'learndash-differentiate-rows' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		ASTRA_THEME_SETTINGS . '[learndash-differentiate-rows]', array(
			'section'  => 'section-learndash',
			'label'    => __( 'Differentiate Rows', 'astra-addon' ),
			'priority' => 5,
			'type'     => 'checkbox',
		)
	);
