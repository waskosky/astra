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

if ( ! class_exists( 'Astra_Header_Layout_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	class Astra_Header_Layout_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Header Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$header_rt_sections = array(
				'none'      => __( 'None', 'astra' ),
				'search'    => __( 'Search', 'astra' ),
				'text-html' => __( 'Text / HTML', 'astra' ),
				'widget'    => __( 'Widget', 'astra' ),
			);

			$_configs = array(

				/**
				 * Option: Header Layout
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-layouts]',
					'default'  => astra_get_option( 'header-layouts' ),
					'section'  => 'section-header',
					'priority' => 4,
					'title'    => __( 'Layout', 'astra' ),
					'type'     => 'control',
					'control'  => 'ast-radio-image',
					'choices'  => array(
						'header-main-layout-1' => array(
							'label' => __( 'Logo Left', 'astra' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="-216.666 41.75 120.5 81" style="enable-background:new -216.666 41.75 120.5 81;" xml:space="preserve"><g><g><path style="fill:#0085BA;" d="M-99.965,122.546h-112.901c-1.958,0-3.549-1.592-3.549-3.549V45.503    c0-1.957,1.592-3.549,3.549-3.549h112.901c1.958,0,3.549,1.592,3.549,3.549v73.494C-96.416,120.954-98.008,122.546-99.965,122.546    z M-212.867,43.729c-0.979,0-1.775,0.795-1.775,1.774v73.494c0,0.979,0.796,1.774,1.775,1.774h112.901    c0.979,0,1.775-0.795,1.775-1.774V45.503c0-0.979-0.796-1.774-1.775-1.774H-212.867z"/></g><g><g><path style="fill:#0085BA;" d="M-109.391,61.35h-58.891c-0.98,0-1.774-0.794-1.774-1.774c0-0.98,0.794-1.774,1.774-1.774h58.891     c0.979,0,1.774,0.794,1.774,1.774C-107.617,60.556-108.412,61.35-109.391,61.35z"/></g><g><path style="fill:#0085BA;" d="M-178.529,62.205c0,1.394-1.13,2.523-2.524,2.523h-19.864c-1.395,0-2.525-1.129-2.525-2.523     v-5.258c0-1.394,1.13-2.524,2.525-2.524h19.864c1.394,0,2.524,1.13,2.524,2.524V62.205z"/></g></g></g></svg>',
						),
						'header-main-layout-2' => array(
							'label' => __( 'Logo Center', 'astra' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="-216.666 41.75 120.5 81" style="enable-background:new -216.666 41.75 120.5 81;" xml:space="preserve"><g><g><path style="fill:#0085BA;" d="M-99.965,122.546h-112.902c-1.957,0-3.549-1.592-3.549-3.549V45.503    c0-1.957,1.592-3.549,3.549-3.549h112.902c1.956,0,3.549,1.592,3.549,3.549v73.494C-96.416,120.954-98.009,122.546-99.965,122.546    z M-212.867,43.729c-0.979,0-1.774,0.796-1.774,1.774v73.494c0,0.979,0.795,1.774,1.774,1.774h112.902    c0.978,0,1.774-0.796,1.774-1.774V45.503c0-0.979-0.796-1.774-1.774-1.774H-212.867z"/></g><g><g><path style="fill:#0085BA;" d="M-116.489,72.71h-79.854c-0.98,0-1.774-0.795-1.774-1.775s0.794-1.774,1.774-1.774h79.854     c0.98,0,1.774,0.794,1.774,1.774S-115.509,72.71-116.489,72.71z"/></g><g><path style="fill:#0085BA;" d="M-143.28,60.574c0,1.47-1.192,2.662-2.662,2.662h-20.949c-1.471,0-2.662-1.192-2.662-2.662v-5.545     c0-1.47,1.191-2.662,2.662-2.662h20.949c1.47,0,2.662,1.191,2.662,2.662V60.574z"/></g></g></g></svg>',
						),
						'header-main-layout-3' => array(
							'label' => __( 'Logo Right', 'astra' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="-216.666 41.75 120.5 81" style="enable-background:new -216.666 41.75 120.5 81;" xml:space="preserve"><g><g><path style="fill:#0085BA;" d="M-216.416,118.997V45.503c0-1.957,1.592-3.549,3.549-3.549h112.901    c1.958,0,3.549,1.592,3.549,3.549v73.494c0,1.957-1.592,3.549-3.549,3.549h-112.901    C-214.824,122.546-216.416,120.954-216.416,118.997z M-212.867,43.729c-0.979,0-1.775,0.795-1.775,1.774v73.494    c0,0.979,0.796,1.774,1.775,1.774h112.901c0.979,0,1.775-0.795,1.775-1.774V45.503c0-0.979-0.796-1.774-1.775-1.774H-212.867z"/></g><g><g><path style="fill:#0085BA;" d="M-203.441,61.35h58.891c0.98,0,1.774-0.794,1.774-1.774c0-0.98-0.794-1.774-1.774-1.774h-58.891     c-0.979,0-1.774,0.794-1.774,1.774C-205.215,60.556-204.42,61.35-203.441,61.35z"/></g><g><path style="fill:#0085BA;" d="M-134.303,62.205c0,1.394,1.13,2.523,2.524,2.523h19.864c1.395,0,2.525-1.129,2.525-2.523v-5.258     c0-1.394-1.13-2.524-2.525-2.524h-19.864c-1.394,0-2.524,1.13-2.524,2.524V62.205z"/></g></g></g></svg>',
						),
					),
				),
				/**
				 * Option: Header Width
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-layout-width]',
					'default'  => astra_get_option( 'header-main-layout-width' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-header',
					'priority' => 4,
					'title'    => __( 'Width', 'astra' ),
					'choices'  => array(
						'full'    => __( 'Full Width', 'astra' ),
						'content' => __( 'Content Width', 'astra' ),
					),
				),

				/**
				 * Option: Bottom Border Size
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[header-main-sep]',
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'header-main-sep' ),
					'type'        => 'control',
					'control'     => 'number',
					'section'     => 'section-header',
					'priority'    => 4,
					'title'       => __( 'Bottom Border Size', 'astra' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Bottom Border Color
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[header-main-sep-color]',
					'transport' => 'postMessage',
					'default'   => '',
					'type'      => 'control',
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-sep]', '>=', 1 ),
					'control'   => 'ast-color',
					'section'   => 'section-header',
					'priority'  => 4,
					'title'     => __( 'Bottom Border Color', 'astra' ),
				),

				array(
					'name'     => 'primary-header-menu-label-divider',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'title'    => __( 'Menu', 'astra' ),
					'section'  => 'section-primary-menu',
					'settings' => array(),
				),

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[disable-primary-nav]',
					'default'  => astra_get_option( 'disable-primary-nav' ),
					'type'     => 'control',
					'control'  => 'checkbox',
					'section'  => 'section-primary-menu',
					'title'    => __( 'Disable Menu', 'astra' ),
					'priority' => 5,
				),

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-rt-section]',
					'default'  => astra_get_option( 'header-main-rt-section' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-primary-menu',
					'priority' => 7,
					'title'    => __( 'Last Item in Menu', 'astra' ),
					'choices'  => apply_filters(
						'astra_header_section_elements',
						array(
							'none'      => __( 'None', 'astra' ),
							'search'    => __( 'Search', 'astra' ),
							'button'    => __( 'Button', 'astra' ),
							'text-html' => __( 'Text / HTML', 'astra' ),
							'widget'    => __( 'Widget', 'astra' ),
						),
						'primary-header'
					),
				),

				/**
				* Option: Button Text
				*/
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-text]',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'header-main-rt-section-button-text' ),
					'type'      => 'control',
					'control'   => 'text',
					'section'   => 'section-primary-menu',
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section]', '===', 'button' ),
					'priority'  => 10,
					'partial'   => array(
						'selector'            => '.main-header-bar .ast-masthead-custom-menu-items .ast-button',
						'container_inclusive' => false,
						'render_callback'     => array( 'Astra_Customizer_Partials', '_render_header_main_rt_section_button_text' ),
					),
					'title'     => __( 'Button Text', 'astra' ),
				),

				/**
				* Option: Button Link
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-link]',
					'default'  => astra_get_option( 'header-main-rt-section-button-link' ),
					'type'     => 'control',
					'control'  => 'text',
					'section'  => 'section-primary-menu',
					'required' => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section]', '===', 'button' ),
					'priority' => 10,
					'title'    => __( 'Button Link', 'astra' ),
				),

				/**
				* Option: Button Style
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]',
					'default'  => astra_get_option( 'header-main-rt-section-button-style' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-primary-menu',
					'required' => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section]', '===', 'button' ),
					'priority' => 10,
					'partial'  => array(
						'selector' => '.ast-custom-button-link',
					),
					'choices'  => array(
						'theme-button'  => __( 'Theme Button', 'astra' ),
						'custom-button' => __( 'Header Button', 'astra' ),
					),
					'title'    => __( 'Button Style', 'astra' ),
				),

				/**
				* Option: Theme Button Style edit link
				*/
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[header-button-style-link]',
					'default'   => astra_get_option( 'header-button-style-link' ),
					'type'      => 'control',
					'control'   => 'ast-customizer-link',
					'section'   => 'section-primary-menu',
					'required'  => array(
						array( ASTRA_THEME_SETTINGS . '[header-main-rt-section]', '===', 'button' ),
						array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'theme-button' ),
					),
					'priority'  => 10,
					'link_type' => 'section',
					'linked'    => 'section-buttons',
					'link_text' => 'Customize Button Style.',
				),

				/**
				 * Option: Right Section Text / HTML
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[header-main-rt-section-html]',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'header-main-rt-section-html' ),
					'type'      => 'control',
					'control'   => 'textarea',
					'section'   => 'section-primary-menu',
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section]', '===', 'text-html' ),
					'priority'  => 10,
					'partial'   => array(
						'selector'            => '.main-header-bar .ast-masthead-custom-menu-items .ast-custom-html',
						'container_inclusive' => false,
						'render_callback'     => array( 'Astra_Customizer_Partials', '_render_header_main_rt_section_html' ),
					),
					'title'     => __( 'Custom Menu Text / HTML', 'astra' ),
				),

				array(
					'name'     => 'primary-header-sub-menu-label-divider',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 30,
					'title'    => __( 'Sub Menu', 'astra' ),
					'section'  => 'section-primary-menu',
					'settings' => array(),
				),

				/**
				 * Option: Submenu Container Animation
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-submenu-container-animation]',
					'default'  => astra_get_option( 'header-main-submenu-container-animation' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-primary-menu',
					'required' => array(
						ASTRA_THEME_SETTINGS . '[disable-primary-nav]',
						'!=',
						true,
					),
					'priority' => 30,
					'title'    => __( 'Container Animation', 'astra' ),
					'choices'  => array(
						''           => __( 'Default', 'astra' ),
						'slide-down' => __( 'Slide Down', 'astra' ),
						'slide-up'   => __( 'Slide Up', 'astra' ),
						'fade'       => __( 'Fade', 'astra' ),
					),
				),

				// Option: Primary Menu Border.
				array(
					'type'           => 'control',
					'control'        => 'ast-border',
					'transport'      => 'postMessage',
					'name'           => ASTRA_THEME_SETTINGS . '[primary-submenu-border]',
					'section'        => 'section-primary-menu',
					'linked_choices' => true,
					'priority'       => 30,
					'default'        => astra_get_option( 'primary-submenu-border' ),
					'title'          => __( 'Container Border', 'astra' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra' ),
						'right'  => __( 'Right', 'astra' ),
						'bottom' => __( 'Bottom', 'astra' ),
						'left'   => __( 'Left', 'astra' ),
					),
				),

				// Option: Submenu Container Border Color.
				array(
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'name'      => ASTRA_THEME_SETTINGS . '[primary-submenu-b-color]',
					'default'   => '',
					'title'     => __( 'Border Color', 'astra' ),
					'section'   => 'section-primary-menu',
					'priority'  => 30,
				),

				array(
					'type'      => 'control',
					'control'   => 'checkbox',
					'transport' => 'postMessage',
					'name'      => ASTRA_THEME_SETTINGS . '[primary-submenu-item-border]',
					'section'   => 'section-primary-menu',
					'priority'  => 30,
					'default'   => astra_get_option( 'primary-submenu-item-border' ),
					'title'     => __( 'Submenu Divider', 'astra' ),
				),

				// Option: Submenu item Border Color.
				array(
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'name'      => ASTRA_THEME_SETTINGS . '[primary-submenu-item-b-color]',
					'default'   => '',
					'title'     => __( 'Divider Color', 'astra' ),
					'section'   => 'section-primary-menu',
					'required'  => array(
						ASTRA_THEME_SETTINGS . '[primary-submenu-item-border]',
						'==',
						true,
					),
					'priority'  => 30,
				),

				/**
				 * Option: Mobile Menu Label Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-menu-label-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-header',
					'priority' => 35,
					'title'    => __( 'Mobile Header', 'astra' ),
					'settings' => array(),
				),

				/**
				 * Option: Mobile Menu Alignment
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-menu-align]',
					'default'  => astra_get_option( 'header-main-menu-align' ),
					'type'     => 'control',
					'control'  => 'ast-radio-image',
					'choices'  => array(
						'inline' => array(
							'label' => __( 'Inline', 'astra' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"><g><path fill="#0085BA" d="M116.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902   c1.956,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.657,80.796,116.701,80.796z M3.799,1.979   c-0.979,0-1.774,0.797-1.774,1.774v73.494c0,0.979,0.795,1.774,1.774,1.774h112.902c0.979,0,1.773-0.797,1.773-1.774V3.753   c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g><g><g><g><path fill="#0085BA" d="M100.673,14.229H85.345c-0.708,0-1.276-0.571-1.276-1.277c0-0.704,0.568-1.276,1.276-1.276h15.328     c0.707,0,1.278,0.573,1.278,1.276C101.951,13.658,101.38,14.229,100.673,14.229z"/></g><g><path fill="#0085BA" d="M100.673,19.94H85.345c-0.708,0-1.276-0.572-1.276-1.277c0-0.707,0.568-1.279,1.276-1.279h15.328     c0.707,0,1.278,0.572,1.278,1.279C101.951,19.368,101.38,19.94,100.673,19.94z"/></g><g><path fill="#0085BA" d="M100.673,25.649H85.345c-0.708,0-1.276-0.571-1.276-1.277c0-0.705,0.568-1.276,1.276-1.276h15.328     c0.707,0,1.278,0.571,1.278,1.276C101.951,25.079,101.38,25.649,100.673,25.649z"/></g></g><g><path fill="#0085BA" d="M48.113,24.426c0,1.261-0.974,2.282-2.172,2.282H20.721c-1.2,0-2.172-1.021-2.172-2.282V12.896    c0-1.259,0.972-2.279,2.172-2.279h25.221c1.199,0,2.172,1.02,2.172,2.279V24.426z"/></g></g></svg>',
						),
						'stack'  => array(
							'label' => __( 'Stack', 'astra' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"><g><path fill="#0085BA" d="M116.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902   c1.956,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.657,80.796,116.701,80.796z M3.799,1.979   c-0.979,0-1.774,0.797-1.774,1.774v73.494c0,0.979,0.795,1.774,1.774,1.774h112.902c0.979,0,1.773-0.797,1.773-1.774V3.753   c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g><g><g><path fill="#0085BA" d="M67.913,34.229H52.585c-0.708,0-1.276-0.57-1.276-1.277c0-0.703,0.568-1.275,1.276-1.275h15.328    c0.707,0,1.278,0.572,1.278,1.275C69.191,33.658,68.62,34.229,67.913,34.229z"/></g><g><path fill="#0085BA" d="M67.913,39.94H52.585c-0.708,0-1.276-0.572-1.276-1.277c0-0.707,0.568-1.279,1.276-1.279h15.328    c0.707,0,1.278,0.572,1.278,1.279C69.191,39.368,68.62,39.94,67.913,39.94z"/></g><g><path fill="#0085BA" d="M67.913,45.649H52.585c-0.708,0-1.276-0.571-1.276-1.277c0-0.705,0.568-1.276,1.276-1.276h15.328    c0.707,0,1.278,0.571,1.278,1.276C69.191,45.079,68.62,45.649,67.913,45.649z"/></g></g><g><path fill="#0085BA" d="M75.032,24.426c0,1.261-0.974,2.282-2.172,2.282H47.64c-1.2,0-2.172-1.021-2.172-2.282V12.896   c0-1.259,0.972-2.279,2.172-2.279H72.86c1.199,0,2.172,1.02,2.172,2.279V24.426z"/></g></svg>',
						),
					),
					'section'  => 'section-header',
					'priority' => 40,
					'title'    => __( 'Layout', 'astra' ),
				),

				/**
				 * Option: Hide Last item in Menu on mobile device
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[hide-custom-menu-mobile]',
					'default'  => astra_get_option( 'hide-custom-menu-mobile' ),
					'type'     => 'control',
					'control'  => 'checkbox',
					'required' => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section]', '!=', 'none' ),
					'section'  => 'section-primary-menu',
					'title'    => __( 'Hide Last Item in Menu on Mobile', 'astra' ),
					'priority' => 7,
				),

				/**
				 * Option: Display outside menu
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-display-outside-menu]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'required' => array( ASTRA_THEME_SETTINGS . '[hide-custom-menu-mobile]', '!=', '1' ),
					'default'  => astra_get_option( 'header-display-outside-menu' ),
					'section'  => 'section-primary-menu',
					'title'    => __( 'Take Last Item Outside Menu', 'astra' ),
					'priority' => 7,
				),

				array(
					'name'     => 'primary-menu-label-divider',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 39,
					'title'    => __( 'Mobile Menu', 'astra' ),
					'section'  => 'section-primary-menu',
					'settings' => array(),
				),

				/**
				 * Option: Mobile Header Breakpoint
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[mobile-header-breakpoint]',
					'default'           => '',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'section'           => 'section-primary-menu',
					'priority'          => 40,
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Menu Breakpoint', 'astra' ),
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 10,
						'max'  => 6000,
					),
				),

				/**
				 * Option: Toggle on click of button or link.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-target]',
					'default'  => astra_get_option( 'mobile-header-toggle-target' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-header',
					'priority' => 42,
					'title'    => __( 'Dropdown Target', 'astra' ),
					'suffix'   => '',
					'choices'  => array(
						'icon' => __( 'Icon', 'astra' ),
						'link' => __( 'Link', 'astra' ),
					),
				),

				/**
				 * Option: Notice to add # link to parent menu when Link option selected in Dropdown Target.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-target-link-notice]',
					'type'     => 'control',
					'control'  => 'ast-description',
					'section'  => 'section-header',
					'priority' => 41,
					'title'    => '',
					'required' => array( ASTRA_THEME_SETTINGS . '[mobile-header-toggle-target]', '==', 'link' ),
					'help'     => __( 'The parent menu should have a # link for the submenu to open on a link.', 'astra' ),
					'settings' => array(),
				),

				/**
				 * Option: Mobile Menu Label
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[header-main-menu-label]',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'header-main-menu-label' ),
					'section'   => 'section-primary-menu',
					'required'  => array(
						'conditions' => array(
							array( ASTRA_THEME_SETTINGS . '[header-main-rt-section]', '!=', array( 'none' ) ),
							array( ASTRA_THEME_SETTINGS . '[disable-primary-nav]', '!=', array( '1' ) ),
						),
						'operator'   => 'OR',
					),
					'priority'  => 40,
					'title'     => __( 'Menu Label', 'astra' ),
					'type'      => 'control',
					'control'   => 'text',
				),

				/**
				 * Option: Toggle Button Style
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-btn-style]',
					'default'  => astra_get_option( 'mobile-header-toggle-btn-style' ),
					'section'  => 'section-primary-menu',
					'title'    => __( 'Toggle Button Style', 'astra' ),
					'type'     => 'control',
					'control'  => 'select',
					'priority' => 42,
					'required' => array( ASTRA_THEME_SETTINGS . '[mobile-menu-style]', '!=', 'no-toggle' ),
					'choices'  => array(
						'fill'    => __( 'Fill', 'astra' ),
						'outline' => __( 'Outline', 'astra' ),
						'minimal' => __( 'Minimal', 'astra' ),
					),
				),

				/**
				 * Option: Toggle Button Color
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-btn-style-color]',
					'default'   => astra_get_option( 'mobile-header-toggle-btn-style-color' ),
					'type'      => 'control',
					'control'   => 'ast-color',
					'required'  => array( ASTRA_THEME_SETTINGS . '[mobile-menu-style]', '!=', 'no-toggle' ),
					'title'     => __( 'Toggle Button Color', 'astra' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 42,
				),

				/**
				 * Option: Border Radius
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-btn-border-radius]',
					'default'     => astra_get_option( 'mobile-header-toggle-btn-border-radius' ),
					'type'        => 'control',
					'control'     => 'ast-slider',
					'section'     => 'section-primary-menu',
					'title'       => __( 'Border Radius', 'astra' ),
					'required'    => array( ASTRA_THEME_SETTINGS . '[mobile-header-toggle-btn-style]', '!=', 'minimal' ),
					'priority'    => 42,
					'suffix'      => '',
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
				),
				/**
				 * Option: Toggle on click of button or link.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-target]',
					'default'  => astra_get_option( 'mobile-header-toggle-target' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-primary-menu',
					'priority' => 42,
					'title'    => __( 'Dropdown Target', 'astra' ),
					'suffix'   => '',
					'choices'  => array(
						'icon' => __( 'Icon', 'astra' ),
						'link' => __( 'Link', 'astra' ),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			// Learn More link if Astra Pro is not activated.
			if ( ! defined( 'ASTRA_EXT_VER' ) ) {

				$config = array(

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[mobile-header-more-feature-divider]',
						'type'     => 'control',
						'control'  => 'ast-divider',
						'section'  => 'section-header',
						'priority' => 999,
						'settings' => array(),
					),

					/**
					 * Option: Learn More about Mobile Header
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[mobile-header-more-feature-description]',
						'type'     => 'control',
						'control'  => 'ast-description',
						'section'  => 'section-header',
						'priority' => 999,
						'title'    => '',
						'help'     => '<p>' . __( 'More Options Available in Astra Pro!', 'astra' ) . '</p><a href="' . astra_get_pro_url( 'https://wpastra.com/pro/', 'customizer', 'learn-more', 'upgrade-to-pro' ) . '" class="button button-primary"  target="_blank" rel="noopener">' . __( 'Learn More', 'astra' ) . '</a>',
						'settings' => array(),
					),
				);

				$configurations = array_merge( $configurations, $config );
			}

			return $configurations;
		}
	}
}


new Astra_Header_Layout_Configs();




