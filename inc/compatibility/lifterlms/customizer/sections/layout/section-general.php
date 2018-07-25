<?php
/**
 * LifterLMS General Options for our theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2018, Brainstorm Force
 * @link        http://www.brainstormforce.com
 * @since       1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Lifter_General_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Lifter_General_Configs extends Astra_Customizer_Config_Base {

		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Course Columns
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[llms-course-grid]',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'section'     => 'section-lifterlms',
					'default'     => array(
						'desktop' => 3,
						'tablet'  => 2,
						'mobile'  => 1,
					),
					'title'       => __( 'Course Columns', 'astra' ),
					'priority'    => 0,
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),

				/**
				 * Option: Membership Columns
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[llms-membership-grid]',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'section'     => 'section-lifterlms',
					'default'     => array(
						'desktop' => 3,
						'tablet'  => 2,
						'mobile'  => 1,
					),
					'title'       => __( 'Membership Columns', 'astra' ),
					'priority'    => 0,
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Astra_Lifter_General_Configs;
