<?php
/**
 * General Options for Astra Theme Mobile Header.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option: Mobile Header Breakpoint
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[mobile-header-breakpoint]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
	)
);
$wp_customize->add_control(
	new Astra_Control_Slider(
		$wp_customize, ASTRA_THEME_SETTINGS . '[mobile-header-breakpoint]', array(
			'type'        => 'ast-slider',
			'section'     => 'section-mobile-header',
			'priority'    => 10,
			'label'       => __( 'Header Breakpoint', 'astra' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 100,
				'step' => 1,
				'max'  => 1921,
			),
		)
	)
);

/**
 * Option: Inherit Desktop logo
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[inherit-mobile-logo]', array(
		'default'           => astra_get_option( 'inherit-mobile-logo' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	ASTRA_THEME_SETTINGS . '[inherit-mobile-logo]', array(
		'section'  => astra_theme_customizer_mobile_header_section(),
		'label'    => __( 'Inherit Desktop Logo', 'astra-addon' ),
		'priority' => 20,
		'type'     => 'checkbox',
	)
);

/**
 * Option: Mobile header logo
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[mobile-header-logo]', array(
		'default'           => astra_get_option( 'mobile-header-logo' ),
		'type'              => 'option',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize, ASTRA_THEME_SETTINGS . '[mobile-header-logo]', array(
			'section'        => 'section-mobile-header',
			'priority'       => 20,
			'label'          => __( 'Logo (optional)', 'astra' ),
			'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
		)
	)
);

/**
 * Option: Logo Width
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[mobile-header-logo-width]', array(
		'default'           => astra_get_option( 'mobile-header-logo-width' ),
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
	)
);
$wp_customize->add_control(
	new Astra_Control_Slider(
		$wp_customize, ASTRA_THEME_SETTINGS . '[mobile-header-logo-width]', array(
			'type'        => 'ast-slider',
			'section'     => 'section-mobile-header',
			'priority'    => 20,
			'label'       => __( 'Logo Width', 'astra' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 50,
				'step' => 1,
				'max'  => 600,
			),
		)
	)
);
