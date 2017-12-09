<?php
/**
 * WooCommerce Options for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2017, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
	/**
	 * Option: Shop Columns
	 */
	$wp_customize->add_setting( ASTRA_THEME_SETTINGS . '[shop-grid]', array(
		'default' => astra_get_option( 'shop-grid' ),
		'type'    => 'option',
	) );
	$wp_customize->add_control( ASTRA_THEME_SETTINGS . '[shop-grid]', array(
		'section'  => 'section-shop',
		'label'    => __( 'Shop Columns', 'astra' ),
		'type'     => 'select',
		'priority' => 15,
		'choices'  => array(
			'1' => __( '1 Column', 'astra' ),
			'2' => __( '2 Columns', 'astra' ),
			'3' => __( '3 Columns', 'astra' ),
			'4' => __( '4 Columns', 'astra' ),
			'5' => __( '5 Columns', 'astra' ),
			'6' => __( '6 Columns', 'astra' ),
		),
	) );

	/**
	 * Option: Products Per Page
	 */
	$wp_customize->add_setting( ASTRA_THEME_SETTINGS . '[shop-no-of-products]', array(
		'default' => astra_get_option( 'shop-no-of-products' ),
		'type'    => 'option',
	) );
	$wp_customize->add_control( ASTRA_THEME_SETTINGS . '[shop-no-of-products]', array(
		'section'     => 'section-shop',
		'label'       => __( 'Products Per Page', 'astra' ),
		'type'        => 'number',
		'priority'    => 20,
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
			'max'  => 50,
		),
	) );
	