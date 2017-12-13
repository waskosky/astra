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
	 * Option: Shop Columns
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[shop-grid]', array(
			'default' => astra_get_option( 'shop-grid' ),
			'type'    => 'option',
		)
	);
	$wp_customize->add_control(
		ASTRA_THEME_SETTINGS . '[shop-grid]', array(
			'section'  => 'section-woo-shop',
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
		)
	);

	/**
	 * Option: Products Per Page
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[shop-no-of-products]', array(
			'default' => astra_get_option( 'shop-no-of-products' ),
			'type'    => 'option',
		)
	);
	$wp_customize->add_control(
		ASTRA_THEME_SETTINGS . '[shop-no-of-products]', array(
			'section'     => 'section-woo-shop',
			'label'       => __( 'Products Per Page', 'astra' ),
			'type'        => 'number',
			'priority'    => 20,
			'input_attrs' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 50,
			),
		)
	);

	/**
	 * Option: Single Post Meta
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[shop-product-structure]', array(
			'default'           => astra_get_option( 'shop-product-structure' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);
	$wp_customize->add_control(
		new Astra_Control_Sortable(
			$wp_customize, ASTRA_THEME_SETTINGS . '[shop-product-structure]', array(
				'type'     => 'ast-sortable',
				'section'  => 'section-woo-shop',
				'priority' => 70,
				'label'    => __( 'Shop Product Structure', 'astra' ),
				'choices'  => array(
					'title'       	=> __( 'Title', 'astra' ),
					'price'       	=> __( 'Price', 'astra' ),
					'ratings'     	=> __( 'Ratings', 'astra' ),
					'short_desc' 	=> __( 'Short Description', 'astra' ),
					'add_cart'   	=> __( 'Add To Cart', 'astra' ),
					'category'      => __( 'Category', 'astra' ),
				),
			)
		)
	);
