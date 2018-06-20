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
			'section'     => astra_theme_customizer_mobile_header_section(),
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
			'section'        => astra_theme_customizer_mobile_header_section(),
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
			'section'     => astra_theme_customizer_mobile_header_section(),
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

/**
 * Option: Mobile Menu Label Divider
 */
$wp_customize->add_control(
	new Astra_Control_Divider(
		$wp_customize, ASTRA_THEME_SETTINGS . '[header-main-menu-label-divider]', array(
			'type'     => 'ast-divider',
			'section'  => astra_theme_customizer_mobile_header_section(),
			'priority' => 35,
			'settings' => array(),
		)
	)
);

/**
 * Option: Mobile Menu Label
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[header-main-menu-label]', array(
		'default'           => astra_get_option( 'header-main-menu-label' ),
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	ASTRA_THEME_SETTINGS . '[header-main-menu-label]', array(
		'section'  => astra_theme_customizer_mobile_header_section(),
		'priority' => 40,
		'label'    => __( 'Menu Label', 'astra' ),
		'type'     => 'text',
	)
);

/**
 * Option: Mobile Menu Alignment
 */
$wp_customize->add_setting(
	ASTRA_THEME_SETTINGS . '[header-main-menu-align]', array(
		'default'           => astra_get_option( 'header-main-menu-align' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
	)
);
$wp_customize->add_control(
	ASTRA_THEME_SETTINGS . '[header-main-menu-align]', array(
		'type'        => 'select',
		'section'     => astra_theme_customizer_mobile_header_section(),
		'priority'    => 45,
		'label'       => __( 'Mobile Header Alignment', 'astra' ),
		'description' => __( 'This setting is only applied to the devices below 544px width ', 'astra' ),
		'choices'     => array(
			'inline' => __( 'Inline', 'astra' ),
			'stack'  => __( 'Stack', 'astra' ),
		),
	)
);

// Learn More link if Astra Pro is not activated.
if ( ! defined( 'ASTRA_EXT_VER' ) ) {

	/**
	 * Option: Divider
	 */
	$wp_customize->add_control(
		new Astra_Control_Divider(
			$wp_customize, ASTRA_THEME_SETTINGS . '[mobile-header-more-feature-divider]', array(
				'type'     => 'ast-divider',
				'section'  => 'section-mobile-header',
				'priority' => 999,
				'settings' => array(),
			)
		)
	);
	/**
	 * Option: Learn More about Mobile Header
	 */
	$wp_customize->add_control(
		new Astra_Control_Description(
			$wp_customize, ASTRA_THEME_SETTINGS . '[mobile-header-more-feature-description]', array(
				'type'     => 'ast-description',
				'section'  => 'section-mobile-header',
				'priority' => 999,
				'label'    => '',
				'help'     => '<p>' . __( 'More Options Available for Mobile Header in Astra Pro!', 'astra' ) . '</p><a href="' . astra_get_pro_url( 'https://wpastra.com/docs/mobile-header-with-astra/', 'customizer', 'learn-more', 'upgrade-to-pro' ) . '" class="button button-primary"  target="_blank" rel="noopener">' . __( 'Learn More', 'astra' ) . '</a>',
				'settings' => array(),
			)
		)
	);
}
