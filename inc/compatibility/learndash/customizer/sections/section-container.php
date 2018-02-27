<?php
/**
 * Container Options for Astra theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2015, Brainstorm Force
 * @link        http://www.brainstormforce.com
 * @since       Astra 1.2.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	/**
	 * Option: Divider
	 */
	$wp_customize->add_control(
		new Astra_Control_Divider(
			$wp_customize, ASTRA_THEME_SETTINGS . '[learndash-content-divider]', array(
				'section'  => 'section-container-layout',
				'type'     => 'ast-divider',
				'priority' => 65,
				'settings' => array(),
			)
		)
	);

	/**
	 * Option: Shop Page
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[learndash-content-layout]', array(
			'default'           => astra_get_option( 'learndash-content-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		ASTRA_THEME_SETTINGS . '[learndash-content-layout]', array(
			'type'     => 'select',
			'section'  => 'section-container-layout',
			'priority' => 65,
			'label'    => __( 'LearnDash', 'astra' ),
			'description' => __( 'This layout will apply on all single course, lesson, topic and quiz.', 'astra' ),
			'choices'  => array(
				'default'                 => __( 'Default', 'astra' ),
				'boxed-container'         => __( 'Boxed', 'astra' ),
				'content-boxed-container' => __( 'Content Boxed', 'astra' ),
				'plain-container'         => __( 'Full Width / Contained', 'astra' ),
				'page-builder'            => __( 'Full Width / Stretched', 'astra' ),
			),
		)
	);
