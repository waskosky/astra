<?php
/**
 * General Options for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_new_Layout_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	class Astra_new_Layout_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register new Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Header Layout
				 */
				array(
					'name'     => 'panel-layout-new',
					'type'     => 'panel',
					'priority' => 10,
					'title'    => __( 'Layout New', 'astra' ),
				),
				array(
					'name'     => 'section-site-new',
					'type'     => 'section',
					'priority' => 5,
					'title'    => __( 'Site Layout New', 'astra' ),
					'panel'    => 'panel-layout-new',
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[disable-primary-new]',
					'default'  => astra_get_option( 'disable-primary-new' ),
					'type'     => 'control',
					'control'  => 'checkbox',
					'section'  => 'section-site-new',
					'title'    => __( 'Disable Menu', 'astra' ),
					'priority' => 5,
				),
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[settings-toggle-new]',
					'default'    => astra_get_option( 'settings-toggle-new' ),
					'type'       => 'control',
					'control'    => 'ast-settings-toggle',
					'label'      => __( 'Advance Settings', 'astra' ),
					'text'       => __( 'Advance Settings', 'astra' ),
					'section'    => 'section-site-new',
					'title'      => __( 'Advanced Settings', 'astra' ),
					'priority'   => 5,
					'ast_fields' => array(
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[ast-layout-new-text]',
							'type'     => 'control',
							'control'  => 'ast-description',
							'section'  => 'section-blog-single',
							'priority' => 999,
							'title'    => '',
							'help'     => '<p>' . __( 'More Options Available for Single Post in Astra Pro!', 'astra' ) . '</p><a href="' . astra_get_pro_url( 'https://wpastra.com/docs/single-post-blog-pro/', 'customizer', 'learn-more', 'upgrade-to-pro' ) . '" class="button button-primary"  target="_blank" rel="noopener">' . __( 'Learn More', 'astra' ) . '</a>',
							'settings' => array(),
						),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}


new Astra_new_Layout_Configs();




