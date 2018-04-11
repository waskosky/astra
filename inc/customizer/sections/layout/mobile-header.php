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
		'default'           => astra_get_option( 'mobile-header-breakpoint' ),
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
			'label'       => __( 'Enter Breakpoint', 'astra' ),
			'suffix'      => '',
			'input_attrs' => array(
				'min'  => 100,
				'step' => 1,
				'max'  => 1920,
			),
		)
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
			'label'          => __( 'Logo (optional)', 'astra-addon' ),
			'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
		)
	)
);

/**
 * Option: Display Title for mobile
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[display-mobile-site-title]', array(
		'default'           => astra_get_option( 'display-mobile-site-title' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	ASTRA_THEME_SETTINGS . '[display-mobile-site-title]', array(
		'type'     => 'checkbox',
		'section'  => 'section-mobile-header',
		'label'    => __( 'Display Site Title', 'astra' ),
		'priority' => 25,
	)
);

/**
 * Option: Display Tagline for mobile
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[display-mobile-site-tagline]', array(
		'default'           => astra_get_option( 'display-mobile-site-tagline' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_checkbox' ),
	)
);
$wp_customize->add_control(
	ASTRA_THEME_SETTINGS . '[display-mobile-site-tagline]', array(
		'type'     => 'checkbox',
		'section'  => 'section-mobile-header',
		'label'    => __( 'Display Site Tagline', 'astra' ),
		'priority' => 30,
	)
);
