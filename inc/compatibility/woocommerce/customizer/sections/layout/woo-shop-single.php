<?php
/**
 * WooCommerce Options for Astra Theme.
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
	 * Option: Disable Breadcrumb
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-disable]', array(
			'default' => astra_get_option( 'single-product-breadcrumb-disable' ),
			'type'    => 'option',
		)
	);
	$wp_customize->add_control(
		ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-disable]', array(
			'section'  => 'section-woo-shop-single',
			'label'    => __( 'Disable Breadcrumb', 'astra-addon' ),
			'priority' => 35,
			'type'     => 'checkbox',
		)
	);
