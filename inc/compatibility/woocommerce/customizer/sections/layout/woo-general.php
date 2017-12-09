<?php
/**
 * WooCommerce General Options for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2017, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	/**
	 * Option: Display Cart Menu
	 */
	$wp_customize->add_setting( ASTRA_THEME_SETTINGS . '[display-cart-menu]', array(
		'default' => astra_get_option( 'display-cart-menu' ),
		'type'    => 'option',
		'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_checkbox' ),
	) );
	$wp_customize->add_control( ASTRA_THEME_SETTINGS . '[display-cart-menu]', array(
		'section' => 'section-woo-general',
		'label'   => __( 'Display Cart in Menu', 'astra' ),
		'type'    => 'checkbox',
	) );