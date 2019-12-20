<?php
/**
 * GiveWP - Donation Forms File.
 *
 * @package Astra
 */

// If plugin - 'GiveWP - Donation Forms' not exist then return.
if ( ! class_exists( 'Give' ) ) {
	return;
}

/**
 * Astra GiveWP Forms
 */
if ( ! class_exists( 'Astra_Givewp_Forms' ) ) :

	/**
	 * Astra GiveWP Forms
	 *
	 * @since 1.0.0
	 */
	class Astra_Givewp_Forms {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			if ( Astra_Dynamic_CSS::page_builder_button_style_css() ) {
				add_filter( 'astra_dynamic_theme_css', array( $this, 'add_dynamic_styles' ) );
			}
		}

		/**
		 * Enqueue styles
		 *
		 * @param  String $dynamic_css          Astra Dynamic CSS.
		 * @param  String $dynamic_css_filtered Astra Dynamic CSS Filters.
		 * @since 1.3.0
		 * @return String Dynamic CSS.
		 */
		function add_dynamic_styles( $dynamic_css, $dynamic_css_filtered = '' ) {

			/**
			 * - Variable Declaration
			//  */
			$link_color   = astra_get_option( 'link-color' );
			$theme_color  = astra_get_option( 'theme-color' );
			$link_h_color = astra_get_option( 'link-h-color' );

			/**
			 * Button theme compatibility.
			 */
			$global_custom_button_border_size = astra_get_option( 'theme-button-border-group-border-size' );
			$btn_border_color                 = astra_get_option( 'theme-button-border-group-border-color' );
			$btn_border_h_color               = astra_get_option( 'theme-button-border-group-border-h-color' );

			/**
			 * Theme Button Typography
			 */
			$theme_btn_font_family    = astra_get_option( 'font-family-button' );
			$theme_btn_font_size      = astra_get_option( 'font-size-button' );
			$theme_btn_font_weight    = astra_get_option( 'font-weight-button' );
			$theme_btn_text_transform = astra_get_option( 'text-transform-button' );
			$theme_btn_line_height    = astra_get_option( 'theme-btn-line-height' );
			$theme_btn_letter_spacing = astra_get_option( 'theme-btn-letter-spacing' );

			$theme_btn_padding = astra_get_option( 'theme-button-padding' );

			$link_forground_color = astra_get_foreground_color( $link_color );
			$btn_color            = astra_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = $link_forground_color;
			}

			$btn_h_color = astra_get_option( 'button-h-color' );
			if ( empty( $btn_h_color ) ) {
				$btn_h_color = astra_get_foreground_color( $link_h_color );
			}
			$btn_bg_color   = astra_get_option( 'button-bg-color', '', $theme_color );
			$btn_bg_h_color = astra_get_option( 'button-bg-h-color', '', $link_h_color );

			$btn_border_radius = astra_get_option( 'button-radius' );

			$button_desktop_css = array(
				'body .give-btn' => array(
					'border-style'        => 'solid',
					'border-top-width'    => ( isset( $global_custom_button_border_size['top'] ) && '' !== $global_custom_button_border_size['top'] ) ? astra_get_css_value( $global_custom_button_border_size['top'], 'px' ) : '1px',
					'border-right-width'  => ( isset( $global_custom_button_border_size['right'] ) && '' !== $global_custom_button_border_size['right'] ) ? astra_get_css_value( $global_custom_button_border_size['right'], 'px' ) : '1px',
					'border-left-width'   => ( isset( $global_custom_button_border_size['left'] ) && '' !== $global_custom_button_border_size['left'] ) ? astra_get_css_value( $global_custom_button_border_size['left'], 'px' ) : '1px',
					'border-bottom-width' => ( isset( $global_custom_button_border_size['bottom'] ) && '' !== $global_custom_button_border_size['bottom'] ) ? astra_get_css_value( $global_custom_button_border_size['bottom'], 'px' ) : '1px',
					'color'               => esc_attr( $btn_color ),
					'border-color'        => empty( $btn_border_color ) ? esc_attr( $btn_bg_color ) : esc_attr( $btn_border_color ),
					'background-color'    => esc_attr( $btn_bg_color ),
					'font-family'         => astra_get_font_family( $theme_btn_font_family ),
					'font-weight'         => esc_attr( $theme_btn_font_weight ),
					'line-height'         => empty( $theme_btn_line_height ) ? 'inherit' : esc_attr( $theme_btn_line_height ),
					'text-transform'      => esc_attr( $theme_btn_text_transform ),
					'letter-spacing'      => astra_get_css_value( $theme_btn_letter_spacing, 'px' ),
					'font-size'           => astra_responsive_font( $theme_btn_font_size, 'desktop' ),
					'border-radius'       => astra_get_css_value( $btn_border_radius, 'px' ),
					'padding-top'         => astra_responsive_spacing( $theme_btn_padding, 'top', 'desktop' ),
					'padding-right'       => astra_responsive_spacing( $theme_btn_padding, 'right', 'desktop' ),
					'padding-bottom'      => astra_responsive_spacing( $theme_btn_padding, 'bottom', 'desktop' ),
					'padding-left'        => astra_responsive_spacing( $theme_btn_padding, 'left', 'desktop' ),
				),
				'body .give-btn:hover, body .give-btn:focus' => array(
					'color'        => $btn_h_color,
					'border-color' => empty( $btn_border_h_color ) ? esc_attr( $btn_bg_h_color ) : esc_attr( $btn_border_h_color ),
					'background'   => $btn_bg_h_color,
				),

				'body #give-recurring-form, body form.give-form, body form[id*=give-form]' => array(
					'margin' => 'inherit',
				),

			);

			/* Parse CSS from array() */

			$css_output = astra_parse_css( $button_desktop_css );

			/**
			 * Global button CSS - Tablet.
			 */
			$css_global_button_tablet = array(
				'body .give-btn' => array(
					'padding-top'    => astra_responsive_spacing( $theme_btn_padding, 'top', 'tablet' ),
					'padding-right'  => astra_responsive_spacing( $theme_btn_padding, 'right', 'tablet' ),
					'padding-bottom' => astra_responsive_spacing( $theme_btn_padding, 'bottom', 'tablet' ),
					'padding-left'   => astra_responsive_spacing( $theme_btn_padding, 'left', 'tablet' ),
				),
			);

			$css_output .= astra_parse_css( $css_global_button_tablet, '', '768' );

			/**
			 * Global button CSS - Mobile.
			 */
			$css_global_button_mobile = array(
				'body .give-btn' => array(
					'padding-top'    => astra_responsive_spacing( $theme_btn_padding, 'top', 'mobile' ),
					'padding-right'  => astra_responsive_spacing( $theme_btn_padding, 'right', 'mobile' ),
					'padding-bottom' => astra_responsive_spacing( $theme_btn_padding, 'bottom', 'mobile' ),
					'padding-left'   => astra_responsive_spacing( $theme_btn_padding, 'left', 'mobile' ),
				),
			);

			$css_output .= astra_parse_css( $css_global_button_mobile, '', '544' );

			$dynamic_css .= apply_filters( 'astra_theme_givewp_dynamic_css', $css_output );

			return $dynamic_css;
		}
	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Givewp_Forms::get_instance();
