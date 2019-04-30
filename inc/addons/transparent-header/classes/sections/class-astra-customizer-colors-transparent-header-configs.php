<?php
/**
 * Colors and Background - Header Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2019, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Astra_Customizer_Colors_Transparent_Header_Configs' ) ) {

	/**
	 * Register Colors and Background - Header Options Customizer Configurations.
	 */
	class Astra_Customizer_Colors_Transparent_Header_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Colors and Background - Header Options Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = Astra_Theme_Options::defaults();

			$_configs = array(

				array(
					'name'       => 'transparent-header-bg-color-responsive',
					'default'    => $defaults['transparent-header-bg-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 1,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors]',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'title'      => __( 'Background Overlay Color', 'astra' ),
					'tab'        => __( 'Normal', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Site Title Color
				 */
				array(
					'name'       => 'transparent-header-color-site-title-responsive',
					'default'    => $defaults['transparent-header-color-site-title-responsive'],
					'type'       => 'sub-control',
					'priority'   => 1,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Site Title Color', 'astra' ),
					'tab'        => __( 'Normal', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Site Title Hover Color
				 */
				array(
					'name'       => 'transparent-header-color-h-site-title-responsive',
					'default'    => $defaults['transparent-header-color-h-site-title-responsive'],
					'type'       => 'sub-control',
					'priority'   => 1,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Site Title Hover Color', 'astra' ),
					'tab'        => __( 'Hover', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => 'transparent-header-colors-menu-divider',
					'type'     => 'sub-control',
					'tab'       => __( 'Normal', 'astra-addon' ),
					'parent'   => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'  => 'ast-divider',
					'priority' => 2,
					'title'    => __( 'Menu', 'astra' ),
					'settings' => array(),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => 'transparent-header-colors-menu-divider',
					'type'     => 'sub-control',
					'tab'       => __( 'Hover', 'astra-addon' ),
					'parent'   => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'  => 'ast-divider',
					'priority' => 2,
					'title'    => __( 'Menu', 'astra' ),
					'settings' => array(),
				),

				/**
				 * Option: Menu Background Color
				 */
				array(
					'name'       => 'transparent-menu-bg-color-responsive',
					'default'    => $defaults['transparent-menu-bg-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 2,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Normal', 'astra' ),
					'title'      => __( 'Background Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Primary Menu Color
				 */
				array(
					'name'       => 'transparent-menu-color-responsive',
					'default'    => $defaults['transparent-menu-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 2,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'astra' ),
					'title'      => __( 'Link / Text Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Menu Hover Color
				 */
				array(
					'name'       => 'transparent-menu-h-color-responsive',
					'default'    => $defaults['transparent-menu-h-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Hover', 'astra' ),
					'title'      => __( 'Link Active / Hover Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => 'transparent-header-colors-submenu-divider',
					'type'     => 'sub-control',
					'tab'       => __( 'Normal', 'astra-addon' ),
					'parent'   => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'  => 'ast-divider',
					'priority' => 3,
					'title'    => __( 'Submenu', 'astra' ),
					'settings' => array(),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => 'transparent-header-colors-submenu-divider',
					'type'     => 'sub-control',
					'tab'       => __( 'Hover', 'astra-addon' ),
					'parent'   => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'  => 'ast-divider',
					'priority' => 3,
					'title'    => __( 'Submenu', 'astra' ),
					'settings' => array(),
				),

				/**
				 * Option: Sub menu background color.
				 */
				array(
					'name'       => 'transparent-submenu-bg-color-responsive',
					'default'    => $defaults['transparent-submenu-bg-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'astra' ),
					'title'      => __( 'Background Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Sub menu text color.
				 */
				array(
					'name'       => 'transparent-submenu-color-responsive',
					'default'    => $defaults['transparent-submenu-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'astra' ),
					'title'      => __( 'Link / Text Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Sub menu active hover color.
				 */
				array(
					'name'       => 'transparent-submenu-h-color-responsive',
					'default'    => $defaults['transparent-submenu-h-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Hover', 'astra' ),
					'title'      => __( 'Link Active / Hover Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				* Option: Content Section Text color.
				*/
				array(
					'name'       => 'transparent-content-section-text-color-responsive',
					'default'    => $defaults['transparent-content-section-text-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 4,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-content]',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Normal', 'astra' ),
					'title'      => __( 'Text Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),
				/**
				 * Option: Content Section Link color.
				 */
				array(
					'name'       => 'transparent-content-section-link-color-responsive',
					'default'    => $defaults['transparent-content-section-link-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 4,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-content]',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Normal', 'astra' ),
					'title'      => __( 'Link Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Content Section Link Hover color.
				 */
				array(
					'name'       => 'transparent-content-section-link-h-color-responsive',
					'default'    => $defaults['transparent-content-section-link-h-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 4,
					'parent'     => ASTRA_THEME_SETTINGS . '[transparent-header-colors-content]',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Hover', 'astra' ),
					'title'      => __( 'Link Hover Color', 'astra' ),
					'section'    => 'section-colors-transparent-header',
					'responsive' => true,
					'rgba'       => true,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Transparent_Header_Configs;
