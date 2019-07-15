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
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="127px" height="86px" viewBox="-219.916 39.25 127 86" style="enable-background:new -219.916 39.25 127 86;" xml:space="preserve"><g><g><path style="fill:#0085BA;" d="M-96.877,124.75h-119.077c-2.064,0-3.743-1.68-3.743-3.743V43.493c0-2.063,1.679-3.743,3.743-3.743    h119.077c2.064,0,3.743,1.68,3.743,3.743v77.514C-93.135,123.07-94.813,124.75-96.877,124.75z M-215.955,41.621    c-1.032,0-1.871,0.84-1.871,1.872v77.514c0,1.032,0.839,1.872,1.871,1.872h119.077c1.032,0,1.871-0.84,1.871-1.872V43.493    c0-1.032-0.839-1.872-1.871-1.872H-215.955z"/></g><g><g><path style="fill:#0085BA;" d="M-106.82,57.4h-62.11c-1.035,0-1.872-0.838-1.872-1.872c0-1.033,0.837-1.871,1.872-1.871h62.11     c1.034,0,1.872,0.838,1.872,1.871C-104.948,56.562-105.786,57.4-106.82,57.4z"/></g><g><path style="fill:#0085BA;" d="M-179.738,58.302c0,1.47-1.191,2.662-2.662,2.662h-20.95c-1.47,0-2.662-1.192-2.662-2.662v-5.546     c0-1.469,1.191-2.662,2.662-2.662h20.95c1.471,0,2.662,1.192,2.662,2.662V58.302z"/></g></g></g></svg>',
						),
						'header-main-layout-2' => array(
							'label' => __( 'Logo Center', 'astra' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="123px" height="86px" viewBox="-217.916 39.25 123 86" style="enable-background:new -217.916 39.25 123 86;" xml:space="preserve">
							<path style="fill:#0586BB;" d="M-98.779,39.75h-115.273c-1.215,0-2.288,0.608-2.946,1.53h-0.005v0.007  c-0.419,0.591-0.671,1.31-0.671,2.086v77.753c0,1.999,1.625,3.624,3.622,3.624H-98.78c1.995,0,3.622-1.625,3.623-3.624V43.374  C-95.157,41.375-96.783,39.75-98.779,39.75z M-106.595,55.857c0,1-0.81,1.813-1.813,1.813h-60.123c-1.001,0-1.812-0.813-1.812-1.813  s0.811-1.813,1.812-1.813h60.125C-107.404,54.044-106.595,54.858-106.595,55.857z M-180.138,53.059l-0.001,5.125  c0,1.359-1.099,2.46-2.46,2.46h-19.366c-1.361,0-2.461-1.102-2.461-2.46v-5.125c0-1.361,1.1-2.462,2.461-2.462h19.366  C-181.238,50.596-180.138,51.698-180.138,53.059z M-96.97,121.126c0,1.001-0.811,1.81-1.809,1.81h-115.273  c-0.999,0-1.809-0.809-1.809-1.81V70.928H-96.97V121.126z"/>
							</svg>',
						),
						'header-main-layout-3' => array(
							'label' => __( 'Logo Right', 'astra' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="130px" height="100px" viewBox="0 0 130 100" style="enable-background:new 0 0 130 100;" xml:space="preserve"><g><g><path style="fill:#0085BA;" d="M0,96.057V3.944c0-2.121,1.726-3.846,3.844-3.846h122.313c2.118,0,3.844,1.725,3.844,3.846v92.113    c0,2.121-1.726,3.846-3.844,3.846H3.845C1.728,99.902,0.001,98.178,0,96.057z M3.844,2.021c-1.06,0-1.921,0.861-1.921,1.923    v92.113c0,1.063,0.861,1.922,1.921,1.922h122.313c1.06,0,1.921-0.859,1.921-1.922V3.944c0-1.062-0.861-1.923-1.921-1.923H3.844z"/></g><g><g><path style="fill:#0085BA;" d="M12.135,16.306c0-1.061,0.86-1.923,1.923-1.923h63.798c1.062,0,1.92,0.862,1.92,1.923     s-0.858,1.923-1.92,1.923H14.06C12.995,18.229,12.135,17.367,12.135,16.306z"/></g><g><path style="fill:#0085BA;" d="M88.958,19.154l-0.001-5.696c0-1.511,1.223-2.734,2.734-2.734h21.519     c1.511,0,2.733,1.223,2.733,2.734v5.696c0,1.509-1.223,2.734-2.733,2.734H91.693C90.182,21.888,88.958,20.663,88.958,19.154     L88.958,19.154z"/></g></g></g></svg>',
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
							'path'  => ASTRA_THEME_URI . '/assets/images/mobile-inline-layout-76x48.png',
						),
						'stack'  => array(
							'label' => __( 'Stack', 'astra' ),
							'path'  => ASTRA_THEME_URI . '/assets/images/mobile-stack-layout-76x48.png',
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




