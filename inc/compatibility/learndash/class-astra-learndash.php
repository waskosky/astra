<?php
/**
 * LearnDash Compatibility File.
 *
 * @package Astra
 * @since 1.2.0
 */

// If plugin - 'LearnDash' not exist then return.
if ( ! class_exists( 'SFWD_LMS' ) ) {
	return;
}

/**
 * Astra LearnDash Compatibility
 */
if ( ! class_exists( 'Astra_LearnDash' ) ) :

	/**
	 * Astra LearnDash Compatibility
	 *
	 * @since 1.2.0
	 */
	class Astra_LearnDash {

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
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			add_filter( 'astra_theme_assets', array( $this, 'add_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_dynamic_styles' ) );
		}

		/**
		 * Enqueue styles
		 *
		 * @since 1.2.0
		 * @return void
		 */
		function add_dynamic_styles() {

			/**
			 * - Variable Declaration
			 */
			$theme_color  = astra_get_option( 'link-color' );
			$text_color   = astra_get_option( 'text-color' );
			$link_h_color = astra_get_option( 'link-h-color' );

			$theme_forground_color = astra_get_foreground_color( $theme_color );
			$btn_color             = astra_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = $theme_forground_color;
			}

			$btn_h_color = astra_get_option( 'button-h-color' );
			if ( empty( $btn_h_color ) ) {
				$btn_h_color = astra_get_foreground_color( $link_h_color );
			}
			$btn_bg_color   = astra_get_option( 'button-bg-color', '', $theme_color );
			$btn_bg_h_color = astra_get_option( 'button-bg-h-color', '', $link_h_color );

			$btn_border_radius      = astra_get_option( 'button-radius' );
			$btn_vertical_padding   = astra_get_option( 'button-v-padding' );
			$btn_horizontal_padding = astra_get_option( 'button-h-padding' );

			$archive_post_title_font_size    = astra_get_option( 'font-size-page-title' );

			$css_output = array(
				'body #ld_course_list .btn' => array(
					'color'            => $btn_color,
					'border-color'     => $btn_bg_color,
					'background-color' => $btn_bg_color,
					'border-radius'    => astra_get_css_value( $btn_border_radius, 'px' ),
				),
				'body #ld_course_list .btn:hover, body #ld_course_list .btn:focus' => array(
					'color'            => $btn_h_color,
					'border-color'     => $btn_bg_h_color,
					'background-color' => $btn_bg_h_color,
				),
				'body dd.course_progress div.course_progress_blue' => array(
					'background-color' => $theme_color,
				),
				'body #learndash_lessons a, body #learndash_quizzes a, body .expand_collapse a, body .learndash_topic_dots a, body .learndash_topic_dots a > span, body #learndash_lesson_topics_list span a, body #learndash_profile a, body #learndash_profile a span' => array(
					'color' => $theme_color,
				),
				'body .thumbnail.course .ld_course_grid_price, body .thumbnail.course .ld_course_grid_price.ribbon-enrolled, body #learndash_lessons #lesson_heading, body #learndash_profile .learndash_profile_heading, body #learndash_quizzes #quiz_heading, body #learndash_lesson_topics_list div > strong' => array(
					'background-color' => $theme_color,
					'color' => $theme_forground_color,
				),
				'body .thumbnail.course .ld_course_grid_price:before' => array(
					'border-top-color' => astra_hex_to_rgba( $theme_color, .75 ),
    				'border-right-color' => astra_hex_to_rgba( $theme_color, .75 ),
				),
				'#ld_course_list .entry-title' => array(
					'font-size' => astra_responsive_font( $archive_post_title_font_size, 'desktop' ),
				),
			);

			/* Parse CSS from array() */
			$css_output = astra_parse_css( $css_output );

			$tablet_typography = array(
				'#ld_course_list .entry-title' => array(
					'font-size' => astra_responsive_font( $archive_post_title_font_size, 'tablet', 30 ),
				),
			);
			/* Parse CSS from array()*/
			$css_output .= astra_parse_css( $tablet_typography, '', '768' );

			$mobile_typography = array(
				'#ld_course_list .entry-title' => array(
					'font-size' => astra_responsive_font( $archive_post_title_font_size, 'mobile', 30 ),
				),
			);
			/* Parse CSS from array()*/
			$css_output .= astra_parse_css( $mobile_typography, '', '544' );

			wp_add_inline_style( 'learndash_style', apply_filters( 'astra_theme_learndash_dynamic_css', $css_output ) );

		}

		/**
		 * Add assets in theme
		 *
		 * @since 1.2.0
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-learndash'] = 'compatibility/learndash';
			return $assets;
		}
	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_LearnDash::get_instance();
