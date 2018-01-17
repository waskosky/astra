<?php
/**
 * Lifter LMS Compatibility File.
 *
 * @package Astra
 */

// If plugin - 'Lifter LMS' not exist then return.
if ( ! class_exists( 'LifterLMS' ) ) {
	return;
}

/**
 * Astra Lifter LMS Compatibility
 */
if ( ! class_exists( 'Astra_LifterLMS' ) ) :

	/**
	 * Astra Lifter LMS Compatibility
	 *
	 * @since 1.0.0
	 */
	class Astra_LifterLMS {

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

			add_action( 'wp', array( $this, 'lifterlms_init' ), 1 );
			add_filter( 'llms_get_theme_default_sidebar', array( $this, 'add_sidebar' ) );
			add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
			add_filter( 'astra_theme_assets', array( $this, 'add_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_dynamic_styles' ) );

			add_action( 'customize_register', array( $this, 'customize_register' ), 11 );

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );

			// Sidebar Layout.
			add_filter( 'astra_page_layout', array( $this, 'sidebar_layout' ) );
			// Content Layout.
			add_filter( 'astra_get_content_layout', array( $this, 'content_layout' ) );

			add_action( 'lifterlms_before_main_content', array( $this, 'before_main_content_start' ) );
			add_action( 'lifterlms_after_main_content', array( $this, 'before_main_content_end' ) );
		}

		/**
		 * Remove LifterLMS Default actions
		 */
		function lifterlms_init() {

			remove_action( 'lifterlms_before_main_content', 'lifterlms_output_content_wrapper', 10 );
			remove_action( 'lifterlms_after_main_content', 'lifterlms_output_content_wrapper_end', 10 );
			remove_action( 'lifterlms_sidebar', 'lifterlms_get_sidebar' );

			if( is_lesson() ) {
				remove_action( 'lifterlms_single_lesson_after_summary', 'lifterlms_template_lesson_navigation', 20 );
				remove_action( 'astra_entry_after', 'astra_single_post_navigation_markup' );
				add_action( 'astra_entry_after', 'lifterlms_template_lesson_navigation' );
			}
		}

		/**
		 * Register Customizer sections and panel for lifterlms
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function customize_register( $wp_customize ) {

			/**
			 * Sections
			 */
			require ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/customizer/sections/section-container.php';
			require ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/customizer/sections/section-sidebar.php';
		}

		/**
		 * Theme Defaults.
		 *
		 * @param array $defaults Array of options value.
		 * @return array
		 */
		function theme_defaults( $defaults ) {

			// Container.
			$defaults['lifterlms-content-layout'] = 'plain-container';

			// Sidebar.
			$defaults['lifterlms-sidebar-layout']    = 'no-sidebar';
			$defaults['lifterlms-course-lesson-sidebar-layout'] = 'default';

			return $defaults;
		}

		/**
		 * Enqueue styles
		 *
		 */
		function add_dynamic_styles() {

			/**
			 * - Variable Declaration
			 */
			$theme_color  = astra_get_option( 'link-color' );
			$text_color   = astra_get_option( 'text-color' );
			$link_h_color = astra_get_option( 'link-h-color' );

			$btn_color = astra_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = astra_get_foreground_color( $theme_color );
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

			$css_output = array(
				'a.llms-button-primary, button.llms-button-action, button.llms-field-button, a.llms-field-button' => array(
					'color'            => $btn_color,
					'border-color'     => $btn_bg_color,
					'background-color' => $btn_bg_color,
				),
				'a.llms-button-primary, button.llms-button-action' => array(
					'border-radius' => astra_get_css_value( $btn_border_radius, 'px' ),
					'padding'       => astra_get_css_value( $btn_vertical_padding, 'px' ) . ' ' . astra_get_css_value( $btn_horizontal_padding, 'px' ),
				),
				'a.llms-button-primary:hover, button.llms-button-action:hover, button.llms-field-button:hover, a.llms-field-button:hover' => array(
					'color'            => $btn_h_color,
					'border-color'     => $btn_bg_h_color,
					'background-color' => $btn_bg_h_color,
				),
				'nav.llms-pagination ul li a:focus, nav.llms-pagination ul li a:hover, nav.llms-pagination ul li span.current' => array(
					'background' => $theme_color,
					'color'      => $btn_color,
				),
				'nav.llms-pagination ul, nav.llms-pagination ul li, .llms-instructor-info .llms-instructors .llms-author, .llms-instructor-info .llms-instructors .llms-author .avatar' => array(
					'border-color' => $theme_color,
				),
				'.llms-progress .progress-bar-complete, .llms-instructor-info .llms-instructors .llms-author .avatar, h4.llms-access-plan-title, .llms-lesson-preview .llms-icon-free' => array(
					'background' => $theme_color,
				),
				'.llms-lesson-preview.is-complete .llms-lesson-complete, .llms-lesson-preview.is-free .llms-lesson-complete, .llms-widget-syllabus .lesson-complete-placeholder.done, .llms-widget-syllabus .llms-lesson-complete.done' => array(
					'color' => $theme_color,
				),
				'h4.llms-access-plan-title' => array(
					'color' => $btn_color,
				),
			);

			/* Parse CSS from array() */
			$css_output = astra_parse_css( $css_output );

			wp_add_inline_style( 'woocommerce-general', apply_filters( 'astra_theme_woocommerce_dynamic_css', $css_output ) );

		}

		/**
		 * Add start of wrapper
		 */
		function before_main_content_start() {
			$site_sidebar = astra_page_layout();
			if ( 'left-sidebar' == $site_sidebar ) {
				get_sidebar();
			}
			?>
			<div id="primary" class="content-area primary">

				<?php astra_primary_content_top(); ?>

				<main id="main" class="site-main" role="main">
					<div class="ast-lifterlms-container">
			<?php
		}

		/**
		 * Add end of wrapper
		 */
		function before_main_content_end() {
			?>
					</div> <!-- .ast-lifterlms-container -->
				</main> <!-- #main -->

				<?php astra_primary_content_bottom(); ?>

			</div> <!-- #primary -->
			<?php
			$site_sidebar = astra_page_layout();
			if ( 'right-sidebar' == $site_sidebar ) {
				get_sidebar();
			}
		}

		/**
		 * Display LifterLMS Course and Lesson sidebars
		 * on courses and lessons in place of the sidebar returned by
		 * this function
		 *
		 * @param    string $id    default sidebar id (an empty string).
		 * @return   string
		 */
		function add_sidebar( $id ) {
			$sidebar_id = 'sidebar-1'; // replace this with theme's sidebar ID.
			return $sidebar_id;
		}

		/**
		 * Declare explicit theme support for LifterLMS course and lesson sidebars
		 *
		 * @return   void
		 */
		function add_theme_support() {
			add_theme_support( 'lifterlms-sidebars' );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.0.0
		 */
		function add_styles( $assets ) {
			$assets['css']['astra-lifterlms'] = 'compatibility/lifterlms';
			return $assets;
		}

		/**
		 * LifterLMS Sidebar
		 *
		 * @param string $layout Layout type.
		 * @return string $layout Layout type.
		 */
		function sidebar_layout( $layout ) {

			if ( ( is_lifterlms() ) || is_llms_account_page() || is_llms_checkout() ) {

				$llms_sidebar = astra_get_option( 'lifterlms-sidebar-layout' );
				if( is_lesson() || is_course() ) {				
					$llms_sidebar = astra_get_option( 'lifterlms-course-lesson-sidebar-layout' );
				}

				if ( 'default' !== $llms_sidebar ) {

					$layout = $llms_sidebar;
				}

				if ( is_courses() ) {
					$shop_page_id = get_option( 'lifterlms_shop_page_id' );
					$shop_sidebar = get_post_meta( $shop_page_id, 'site-sidebar-layout', true );
				} elseif ( is_memberships() ) {
					$membership_page_id = get_option( 'lifterlms_memberships_page_id' );
					$shop_sidebar = get_post_meta( $membership_page_id, 'site-sidebar-layout', true );
				} elseif ( is_course_taxonomy() ) {
					$shop_sidebar = 'default';
				} else {
					$shop_sidebar = astra_get_option_meta( 'site-sidebar-layout', '', true );
				}

				if ( 'default' !== $shop_sidebar && ! empty( $shop_sidebar ) ) {
					$layout = $shop_sidebar;
				}
			}

			return $layout;
		}

		/**
		 * LifterLMS Container
		 *
		 * @param string $layout Layout type.
		 * @return string $layout Layout type.
		 */
		function content_layout( $layout ) {

			if ( is_lifterlms() || is_llms_account_page() || is_llms_checkout() ) {

				$llms_layout = astra_get_option( 'lifterlms-content-layout' );

				if ( 'default' !== $llms_layout ) {

					$layout = $llms_layout;
				}

				if ( is_courses() ) {
					$shop_page_id = get_option( 'lifterlms_shop_page_id' );
					$shop_layout  = get_post_meta( $shop_page_id, 'site-content-layout', true );
				} elseif ( is_memberships() ) {
					$membership_page_id = get_option( 'lifterlms_memberships_page_id' );
					$shop_layout = get_post_meta( $membership_page_id, 'site-content-layout', true );
				} elseif ( is_course_taxonomy() ) {
					$shop_layout = 'default';
				} else {
					$shop_layout = astra_get_option_meta( 'site-content-layout', '', true );
				}

				if ( 'default' !== $shop_layout && ! empty( $shop_layout ) ) {
					$layout = $shop_layout;
				}
			}

			return $layout;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_LifterLMS::get_instance();
