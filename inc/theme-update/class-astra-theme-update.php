<?php
/**
 * Theme Update
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */

if ( ! class_exists( 'Astra_Theme_Update' ) ) {

	/**
	 * Astra_Theme_Update initial setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Theme_Update {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;


		/**
		 * Process All
		 *
		 * @since 2.0.0
		 * @var object Class object.
		 * @access public
		 */
		public static $process_all;

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
		 *  Constructor
		 */
		public function __construct() {

			// Theme Updates.
			if ( is_admin() ) {
				add_action( 'admin_init', __CLASS__ . '::init', 5 );
			} else {
				add_action( 'wp', __CLASS__ . '::init', 5 );
			}

			add_action( 'init', __CLASS__ . '::astra_pro_compatibility' );

			// Core Helpers - Batch Processing.
			require_once ASTRA_THEME_DIR . 'inc/theme-update/batch-processing/class-wp-async-request.php';
			require_once ASTRA_THEME_DIR . 'inc/theme-update/batch-processing/class-wp-background-process.php';
			require_once ASTRA_THEME_DIR . 'inc/theme-update/batch-processing/class-wp-background-process-astra-theme.php';

			self::$process_all = new WP_Background_Process_Astra_Theme();
		}

		/**
		 * Added a static json object for changes in customizer version 2 database migration.
		 *
		 * @since 2.0.0
		 * @return array
		 */
		public static function astra_new_controls() {

			$json = '{"theme-button-color-group":["button-bg-h-color","button-bg-color","button-h-color","button-color"],"theme-button-border-group":["button-h-padding","button-v-padding","button-radius"],"primary-header-button-color-group":["header-main-rt-section-button-back-h-color","header-main-rt-section-button-back-color","header-main-rt-section-button-text-h-color","header-main-rt-section-button-text-color"],"primary-header-button-border-group":["header-main-rt-section-button-border-h-color","header-main-rt-section-button-border-color"],"transparent-header-button-color-group":["header-main-rt-trans-section-button-back-h-color","header-main-rt-trans-section-button-back-color","header-main-rt-trans-section-button-text-h-color","header-main-rt-trans-section-button-text-color"],"transparent-header-button-border-group":["header-main-rt-trans-section-button-border-h-color","header-main-rt-trans-section-button-border-color"],"footer-bar-content-group":["footer-link-h-color","footer-link-color","footer-color"],"footer-bar-background-group":"footer-bg-obj","footer-widget-content-group":["footer-adv-link-h-color","footer-adv-link-color","footer-adv-text-color","footer-adv-wgt-title-color"],"footer-widget-background-group":"footer-adv-bg-obj","blog-content-blog-post-title-typo":["text-transform-page-title","line-height-page-title","font-weight-page-title","font-family-page-title","font-size-page-title"],"blog-content-archive-summary-typo":["text-transform-archive-summary-title","line-height-archive-summary-title","font-weight-archive-summary-title","font-family-archive-summary-title","font-size-archive-summary-title"],"site-title-typography":["line-height-site-title","text-transform-site-title","font-weight-site-title","font-family-site-title","font-size-site-title"],"site-tagline-typography":["line-height-site-tagline","text-transform-site-tagline","font-weight-site-tagline","font-family-site-tagline","font-size-site-tagline"],"blog-single-title-typo":["text-transform-entry-title","line-height-entry-title","font-weight-entry-title","font-family-entry-title","font-size-entry-title"],"transparent-header-background-colors":"transparent-header-bg-color-responsive","transparent-header-colors":["transparent-header-color-h-site-title-responsive","transparent-header-color-site-title-responsive"],"transparent-header-colors-menu":["transparent-submenu-h-color-responsive","transparent-submenu-bg-color-responsive","transparent-submenu-color-responsive","transparent-header-colors-submenu-divider","transparent-header-colors-submenu-divider","transparent-menu-h-color-responsive","transparent-menu-bg-color-responsive","transparent-menu-color-responsive","transparent-header-colors-menu-divider","transparent-header-colors-menu-divider"],"transparent-header-colors-content":["transparent-content-section-link-h-color-responsive","transparent-content-section-link-color-responsive","transparent-content-section-text-color-responsive"],"section-breadcrumb-color":["breadcrumb-bg-color","breadcrumb-separator-color","breadcrumb-hover-color-responsive","breadcrumb-text-color-responsive","breadcrumb-active-color-responsive"],"section-breadcrumb-typo":["breadcrumb-line-height","breadcrumb-font-size","breadcrumb-text-transform","breadcrumb-font-weight","breadcrumb-font-family"],"blog-content-color-group":["post-meta-link-h-color","post-meta-link-color","post-meta-color","page-title-color","archive-summary-box-text-color","archive-summary-box-title-color","archive-summary-box-bg-color","divider-blog-archive"],"primary-header-background-group":"header-bg-obj-responsive","primary-menu-colors":["primary-submenu-a-bg-color-responsive","primary-submenu-a-color-responsive","primary-header-color-bg-submenu-divider-active","primary-menu-a-bg-color-responsive","primary-menu-a-color-responsive","primary-header-color-bg-menu-divider-active","primary-submenu-h-bg-color-responsive","primary-submenu-h-color-responsive","primary-header-color-bg-submenu-divider-hover","primary-menu-h-bg-color-responsive","primary-menu-h-color-responsive","primary-header-color-bg-menu-divider-hover","primary-submenu-bg-color-responsive","primary-submenu-color-responsive","primary-header-color-bg-submenu-divider-normal","primary-menu-bg-obj-responsive","primary-menu-color-responsive","primary-header-color-bg-menu-divider-normal"],"sidebar-background-group":"sidebar-bg-obj","sidebar-content-group":["sidebar-link-h-color","sidebar-link-color","sidebar-text-color","sidebar-widget-title-color"],"footer-widget-title-typography-group":["footer-adv-wgt-title-line-height","footer-adv-wgt-title-font-size","footer-adv-wgt-title-text-transform","footer-adv-wgt-title-font-weight","footer-adv-wgt-title-font-family"],"footer-widget-content-typography-group":["footer-adv-wgt-content-line-height","footer-adv-wgt-content-font-size","footer-adv-wgt-content-text-transform","footer-adv-wgt-content-font-weight","footer-adv-wgt-content-font-family"],"below-header-menus-group":["below-header-submenu-active-bg-color-responsive","below-header-submenu-active-color-responsive","below-header-submenu-bg-hover-color-responsive","below-header-submenu-hover-color-responsive","below-header-submenu-bg-color-responsive","below-header-submenu-text-color-responsive","below-header-current-menu-bg-color-responsive","below-header-current-menu-text-color-responsive","below-header-menu-bg-hover-color-responsive","below-header-menu-text-hover-color-responsive","below-header-menu-bg-obj-responsive","below-header-menu-text-color-responsive","below-header-primary-sub-menu-active-color-label-divider","below-header-primary-menu-active-color-label-divider","below-header-primary-sub-menu-hover-color-label-divider","below-header-primary-menu-hover-color-label-divider","below-header-primary-sub-menu-normal-color-label-divider","below-header-primary-menu-normal-color-label-divider"],"above-header-typography-menu-styling":["above-header-text-transform","above-header-font-size","above-header-font-weight","above-header-font-family"],"above-header-typography-submenu-styling":["text-transform-above-header-dropdown-menu","font-size-above-header-dropdown-menu","font-weight-above-header-dropdown-menu","font-family-above-header-dropdown-menu"],"below-header-menu-typography-styling":["text-transform-below-header-primary-menu","font-size-below-header-primary-menu","font-weight-below-header-primary-menu","font-family-below-header-primary-menu"],"below-header-submenu-typography-styling":["text-transform-below-header-dropdown-menu","font-size-below-header-dropdown-menu","font-weight-below-header-dropdown-menu","font-family-below-header-dropdown-menu"],"below-header-content-typography-styling":["text-transform-below-header-content","font-size-below-header-content","font-weight-below-header-content","font-family-below-header-content"],"above-header-background-styling":"above-header-bg-obj-responsive","above-header-menu-colors":["above-header-submenu-active-bg-color-responsive","above-header-submenu-active-color-responsive","above-header-color-bg-dropdown-submenu-divider-active","above-header-menu-active-bg-color-responsive","above-header-menu-active-color-responsive","above-header-color-bg-dropdown-menu-divider-active","above-header-submenu-bg-hover-color-responsive","above-header-submenu-hover-color-responsive","above-header-color-bg-dropdown-menu-divider-hover","above-header-menu-h-bg-color-responsive","above-header-menu-h-color-responsive","above-header-color-bg-dropdown-menu-h-divider-hover","above-header-submenu-bg-color-responsive","above-header-submenu-text-color-responsive","above-header-color-bg-dropdown-menu-divider","above-header-menu-bg-obj-responsive","above-header-menu-color-responsive","above-header-color-bg-menu-divider-normal"],"above-header-content-section-styling":["above-header-link-h-color-responsive","above-header-link-color-responsive","above-header-text-color-responsive"],"below-header-background-group":"below-header-bg-obj-responsive","below-header-content-group":["below-header-link-hover-color-responsive","below-header-link-color-responsive","below-header-text-color-responsive"],"learndash-color-group":["learndash-incomplete-icon-color","learndash-complete-icon-color","learndash-table-title-separator-color","learndash-table-title-bg-color","learndash-table-title-color","learndash-table-heading-bg-color","learndash-table-heading-color"],"learndash-header-typography-group":["font-size-learndash-table-heading","text-transform-learndash-table-heading","font-weight-learndash-table-heading","font-family-learndash-table-heading"],"learndash-content-typography-group":["font-size-learndash-table-content","text-transform-learndash-table-content","font-weight-learndash-table-content","font-family-learndash-table-content"],"sticky-header-above-menus-colors":["sticky-above-header-megamenu-heading-h-color","sticky-above-header-megamenu-heading-color","sticky-above-header-submenu-h-a-bg-color-responsive","sticky-above-header-submenu-h-color-responsive","sticky-above-header-submenu-color-responsive","sticky-above-header-submenu-bg-color-responsive","sticky-above-header-menu-h-a-bg-color-responsive","sticky-above-header-menu-h-color-responsive","sticky-above-header-menu-color-responsive","sticky-above-header-menu-bg-color-responsive","sticky-header-above-megamenu-col-hover-color-label-divider","sticky-header-above-sub-menu-hover-color-label-divider","sticky-header-above-menu-hover-color-label-divider","sticky-header-above-megamenu-col-normal-color-label-divider","sticky-header-above-sub-menu-normal-color-label-divider","sticky-header-above-menu-normal-color-label-divider"],"sticky-header-primary-menus-colors":["sticky-primary-header-megamenu-heading-h-color","sticky-primary-header-megamenu-heading-color","sticky-header-submenu-h-a-bg-color-responsive","sticky-header-submenu-h-color-responsive","sticky-header-submenu-color-responsive","sticky-header-submenu-bg-color-responsive","sticky-header-menu-h-a-bg-color-responsive","sticky-header-menu-h-color-responsive","sticky-header-menu-color-responsive","sticky-header-menu-bg-color-responsive","sticky-header-primary-megamenu-col-hover-color-label-divider","sticky-header-primary-sub-menu-hover-color-label-divider","sticky-header-primary-menu-hover-color-label-divider","sticky-header-primary-megamenu-col-normal-color-label-divider","sticky-header-primary-sub-menu-normal-color-label-divider","sticky-header-primary-menu-normal-color-label-divider"],"sticky-header-below-menus-colors":["sticky-below-header-megamenu-heading-h-color","sticky-below-header-megamenu-heading-color","sticky-below-header-submenu-h-a-bg-color-responsive","sticky-below-header-submenu-h-color-responsive","sticky-below-header-submenu-color-responsive","sticky-below-header-submenu-bg-color-responsive","sticky-below-header-menu-h-a-bg-color-responsive","sticky-below-header-menu-h-color-responsive","sticky-below-header-menu-color-responsive","sticky-below-header-menu-bg-color-responsive","sticky-header-below-megamenu-col-hover-color-label-divider","sticky-header-below-sub-menu-hover-color-label-divider","sticky-header-below-menu-hover-color-label-divider","sticky-header-below-megamenu-col-normal-color-label-divider","sticky-header-below-sub-menu-normal-color-label-divider","sticky-header-below-menu-normal-color-label-divider"],"sticky-header-button-color-group":["header-main-rt-sticky-section-button-back-h-color","header-main-rt-sticky-section-button-back-color","header-main-rt-sticky-section-button-text-h-color","header-main-rt-sticky-section-button-text-color"],"sticky-header-button-border-group":["header-main-rt-sticky-section-button-border-h-color","header-main-rt-sticky-section-button-border-color"],"sticky-header-primary-header-colors":["sticky-header-color-site-tagline-responsive","sticky-header-color-h-site-title-responsive","sticky-header-color-site-title-responsive","sticky-header-bg-color-responsive"],"sticky-header-primary-outside-item-colors":["sticky-header-content-section-link-h-color-responsive","sticky-header-content-section-link-color-responsive","sticky-header-content-section-text-color-responsive"],"sticky-header-above-header-colors":"sticky-above-header-bg-color-responsive","sticky-header-above-outside-item-colors":["sticky-above-header-content-section-link-h-color-responsive","sticky-above-header-content-section-link-color-responsive","sticky-above-header-content-section-text-color-responsive"],"sticky-header-below-header-colors":"sticky-below-header-bg-color-responsive","scroll-on-top-color-group":["scroll-to-top-icon-h-bg-color","scroll-to-top-icon-h-color","scroll-to-top-icon-bg-color","scroll-to-top-icon-color"],"blog-content-post-meta-typo":["text-transform-post-meta","line-height-post-meta","font-size-post-meta","font-weight-post-meta","font-family-post-meta"],"blog-content-pagination-typo":["font-size-post-pagination","text-transform-post-pagination"],"button-text-typography":["font-size-button","text-transform-button","font-weight-button","font-family-button"],"footer-bar-typography-group":["line-height-footer-content","font-size-footer-content","text-transform-footer-content","font-weight-footer-content","font-family-footer-content"],"site-identity-typography":["header-main-menu-label-divider","header-main-menu-label-divider"],"primary-header-menu-typography":["line-height-primary-menu","font-size-primary-menu","text-transform-primary-menu","font-weight-primary-menu","font-family-primary-menu"],"primary-sub-menu-typography":["line-height-primary-dropdown-menu","font-size-primary-dropdown-menu","text-transform-primary-dropdown-menu","font-weight-primary-dropdown-menu","font-family-primary-dropdown-menu"],"sidebar-title-typography-group":["line-height-widget-title","font-size-widget-title","text-transform-widget-title","font-weight-widget-title","font-family-widget-title"],"sidebar-content-typography-group":["line-height-widget-content","font-size-widget-content","text-transform-widget-content","font-weight-widget-content","font-family-widget-content"],"single-product-title-group":["line-height-product-title","font-size-product-title","text-transform-product-title","font-weight-product-title","font-family-product-title"],"single-product-price-group":["line-height-product-price","font-size-product-price","font-weight-product-price","font-family-product-price"],"single-product-breadcrumb-group":["line-height-product-breadcrumb","font-size-product-breadcrumb","text-transform-product-breadcrumb","font-weight-product-breadcrumb","font-family-product-breadcrumb"],"single-product-content-group":["line-height-product-content","font-size-product-content","text-transform-product-content","font-weight-product-content","font-family-product-content"],"woo-single-page-color-group":["single-product-breadcrumb-color","single-product-content-color","single-product-price-color","single-product-title-color"],"shop-product-title-group":["line-height-shop-product-title","font-size-shop-product-title","text-transform-shop-product-title","font-weight-shop-product-title","font-family-shop-product-title"],"shop-product-price-group":["line-height-shop-product-price","font-size-shop-product-price","font-weight-shop-product-price","font-family-shop-product-price"],"shop-product-content-group":["line-height-shop-product-content","font-size-shop-product-content","text-transform-shop-product-content","font-weight-shop-product-content","font-family-shop-product-content"],"shop-color-group":["shop-product-content-color","shop-product-price-color","shop-product-title-color"],"edd-single-product-title-typo":["text-transform-edd-product-title","line-height-edd-product-title","font-size-edd-product-title","font-weight-edd-product-itle]","font-family-edd-product-title"],"edd-single-product-content-typo":["text-transform-edd-product-content","line-height-edd-product-content","font-size-edd-product-content","font-weight-edd-product-content","font-family-edd-product-content"],"edd-single-product-colors":["edd-single-product-navigation-color","edd-single-product-content-color","edd-single-product-title-color"],"edd-archive-product-title-typo":["text-transform-edd-archive-product-title","line-height-edd-archive-product-title","font-size-edd-archive-product-title","font-weight-edd-archive-product-title","font-family-edd-archive-product-title"],"edd-archive-product-price-typo":["line-height-edd-archive-product-price","font-size-edd-archive-product-price","font-weight-edd-archive-product-price","font-family-edd-archive-product-price"],"edd-archive-product-content-typo":["text-transform-edd-archive-product-content","line-height-edd-archive-product-content","font-size-edd-archive-product-content","font-weight-edd-archive-product-content","font-family-edd-archive-product-content"],"edd-archive-colors":["edd-archive-product-content-color","edd-archive-product-price-color","edd-archive-product-title-color"],"primary-mega-menu-col-color-group":["primary-header-megamenu-heading-h-color","primary-header-megamenu-heading-color"],"primary-mega-menu-col-typography":["primary-header-megamenu-heading-text-transform","primary-header-megamenu-heading-font-size","primary-header-megamenu-heading-font-weight","primary-header-megamenu-heading-font-family"],"above-header-megamenu-colors":["above-header-megamenu-heading-h-color","above-header-megamenu-heading-color"],"above-header-typography-megamenu-styling":["above-header-megamenu-heading-text-transform","above-header-megamenu-heading-font-size","above-header-megamenu-heading-font-weight","above-header-megamenu-heading-font-family"],"below-header-megamenu-group":["below-header-megamenu-heading-h-color","below-header-megamenu-heading-color"],"below-header-megamenu-typography-styling":["below-header-megamenu-heading-text-transform","below-header-megamenu-heading-font-size","below-header-megamenu-heading-font-weight","below-header-megamenu-heading-font-family"]}';
			return $json;
		}

		/**
		 * Implement theme update logic.
		 *
		 * @since 1.0.0
		 */
		static public function init() {

			do_action( 'astra_update_before' );

			// Get auto saved version number.
			$saved_version = astra_get_option( 'theme-auto-version', false );

			if ( false === $saved_version ) {

				// Get all customizer options.
				$customizer_options = get_option( ASTRA_THEME_SETTINGS );

				// Get all customizer options.
				$version_array = array(
					'theme-auto-version' => ASTRA_THEME_VERSION,
				);
				$saved_version = ASTRA_THEME_VERSION;

				// Merge customizer options with version.
				$theme_options = wp_parse_args( $version_array, $customizer_options );

				// Update auto saved version number.
				update_option( ASTRA_THEME_SETTINGS, $theme_options );
			}

			// If equals then return.
			if ( version_compare( $saved_version, ASTRA_THEME_VERSION, '=' ) ) {
				return;
			}

			// Update to older version than 1.0.4 version.
			if ( version_compare( $saved_version, '1.0.4', '<' ) ) {
				self::v_1_0_4();
			}

			// Update to older version than 1.0.5 version.
			if ( version_compare( $saved_version, '1.0.5', '<' ) ) {
				self::v_1_0_5();
			}

			// Update to older version than 1.0.8 version.
			if ( version_compare( $saved_version, '1.0.8', '<' ) && version_compare( $saved_version, '1.0.4', '>' ) ) {
				self::v_1_0_8();
			}

			// Update to older version than 1.0.12 version.
			if ( version_compare( $saved_version, '1.0.12', '<' ) ) {
				self::v_1_0_12();
			}

			// Update to older version than 1.0.14 version.
			if ( version_compare( $saved_version, '1.0.14', '<' ) ) {
				self::v_1_0_14();
			}

			// Update astra meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.0.28', '<' ) ) {
				self::v_1_0_28();
			}

			// Update astra meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.1.0-beta.3', '<' ) ) {
				self::v_1_1_0_beta_3();
			}

			// Update astra meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.1.0-beta.4', '<' ) ) {
				self::v_1_1_0_beta_4();
			}

			// Update astra meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.2.2', '<' ) ) {
				self::v_1_2_2();
			}

			// Update astra Theme colors values same as Link color.
			if ( version_compare( $saved_version, '1.2.4', '<' ) ) {
				self::v_1_2_4();
			}

			// Update astra Google Fonts values with fallback font.
			if ( version_compare( $saved_version, '1.2.7', '<' ) ) {
				self::v_1_2_7();
			}

			// Update astra background image data.
			if ( version_compare( $saved_version, '1.3.0', '<' ) ) {
				self::v_1_3_0();
			}

			// Update astra setting for inherit site logo compatibility.
			if ( version_compare( $saved_version, '1.4.0-beta.3', '<' ) ) {
				self::v_1_4_0_beta_3();
			}

			if ( version_compare( $saved_version, '1.4.0-beta.4', '<' ) ) {
				self::v_1_4_0_beta_4();
			}

			if ( version_compare( $saved_version, '1.4.0-beta.5', '<' ) ) {
				self::v_1_4_0_beta_5();
			}

			if ( version_compare( $saved_version, '1.4.3-alpha.1', '<' ) ) {
				self::v_1_4_3_alpha_1();
			}

			if ( version_compare( $saved_version, '1.4.9', '<' ) ) {
				self::v_1_4_9();
			}

			if ( version_compare( $saved_version, '1.5.0-beta.4', '<' ) ) {
				self::v_1_5_0_beta_4();
			}

			if ( version_compare( $saved_version, '1.5.0-rc.1', '<' ) ) {
				self::v_1_5_0_rc_1();
			}

			if ( version_compare( $saved_version, '1.5.0', '<' ) ) {
				self::v_1_5_0_rc_3();
			}

			if ( version_compare( $saved_version, '1.5.1', '<' ) ) {
				self::v_1_5_1();
			}

			if ( version_compare( $saved_version, '1.5.2', '<' ) ) {
				self::v_1_5_2();
			}

			if ( version_compare( $saved_version, '1.6.0', '<' ) ) {
				self::v_1_6_0();
			}

			if ( version_compare( $saved_version, '1.6.1-alpha.3', '<' ) ) {
				self::v_1_6_1();
			}

			if ( version_compare( $saved_version, '2.0.0', '<' ) ) {
				self::v_2_0_0();
			}

			// Not have stored?
			if ( empty( $saved_version ) ) {

				// Get old version.
				$theme_version = get_option( '_astra_auto_version', ASTRA_THEME_VERSION );

				// Remove option.
				delete_option( '_astra_auto_version' );

			} else {

				// Get latest version.
				$theme_version = ASTRA_THEME_VERSION;
			}

			// Get all customizer options.
			$customizer_options = get_option( ASTRA_THEME_SETTINGS );

			// Get all customizer options.
			$version_array = array(
				'theme-auto-version' => $theme_version,
			);

			// Merge customizer options with version.
			$theme_options = wp_parse_args( $version_array, $customizer_options );

			// Update auto saved version number.
			update_option( ASTRA_THEME_SETTINGS, $theme_options );

			// Update variables.
			Astra_Theme_Options::refresh();

			do_action( 'astra_update_after' );
		}

		/**
		 * Footer Widgets compatibilty for astra pro.
		 */
		static public function astra_pro_compatibility() {

			if ( defined( 'ASTRA_EXT_VER' ) && version_compare( ASTRA_EXT_VER, '1.0.0-beta.6', '<' ) ) {
				remove_action( 'astra_footer_content', 'astra_advanced_footer_markup', 1 );
			}
		}

		/**
		 * Update options of older version than 1.0.4.
		 *
		 * @since 1.0.4
		 */
		static public function v_1_0_4() {

			$options = array(
				'font-size-body',
				'body-line-height',
				'font-size-site-title',
				'font-size-site-tagline',
				'font-size-entry-title',
				'font-size-page-title',
				'font-size-h1',
				'font-size-h2',
				'font-size-h3',
				'font-size-h4',
				'font-size-h5',
				'font-size-h6',

				// Addon Options.
				'footer-adv-wgt-title-font-size',
				'footer-adv-wgt-title-line-height',
				'footer-adv-wgt-content-font-size',
				'footer-adv-wgt-content-line-height',
				'above-header-font-size',
				'font-size-below-header-primary-menu',
				'font-size-below-header-dropdown-menu',
				'font-size-below-header-content',
				'font-size-related-post',
				'line-height-related-post',
				'title-bar-title-font-size',
				'title-bar-title-line-height',
				'title-bar-breadcrumb-font-size',
				'title-bar-breadcrumb-line-height',
				'line-height-page-title',
				'font-size-post-meta',
				'line-height-post-meta',
				'font-size-post-pagination',
				'line-height-h1',
				'line-height-h2',
				'line-height-h3',
				'line-height-h4',
				'line-height-h5',
				'line-height-h6',
				'font-size-footer-content',
				'line-height-footer-content',
				'line-height-site-title',
				'line-height-site-tagline',
				'font-size-primary-menu',
				'line-height-primary-menu',
				'font-size-primary-dropdown-menu',
				'line-height-primary-dropdown-menu',
				'font-size-widget-title',
				'line-height-widget-title',
				'font-size-widget-content',
				'line-height-widget-content',
				'line-height-entry-title',
			);

			$astra_options = get_option( 'ast-settings', array() );

			if ( 0 < count( $astra_options ) ) {
				foreach ( $options as $key ) {

					if ( array_key_exists( $key, $astra_options ) && ! is_array( $astra_options[ $key ] ) ) {

						$astra_options[ $key ] = array(
							'desktop'      => $astra_options[ $key ],
							'tablet'       => '',
							'mobile'       => '',
							'desktop-unit' => 'px',
							'tablet-unit'  => 'px',
							'mobile-unit'  => 'px',
						);
					}
				}
			}

			update_option( 'ast-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.0.5.
		 *
		 * @since 1.0.5
		 */
		static public function v_1_0_5() {

			$astra_old_options = get_option( 'ast-settings', array() );
			$astra_new_options = get_option( ASTRA_THEME_SETTINGS, array() );

			// Merge old customizer options in new option.
			$astra_options = wp_parse_args( $astra_new_options, $astra_old_options );

			// Update option.
			update_option( ASTRA_THEME_SETTINGS, $astra_options );

			// Delete old option.
			delete_option( 'ast-settings' );
		}

		/**
		 * Update options of older version than 1.0.8.
		 *
		 * @since 1.0.8
		 */
		static public function v_1_0_8() {

			$options = array(
				'body-line-height',

				// Addon Options.
				'footer-adv-wgt-title-line-height',
				'footer-adv-wgt-content-line-height',
				'line-height-related-post',
				'title-bar-title-line-height',
				'title-bar-breadcrumb-line-height',
				'line-height-page-title',
				'line-height-post-meta',
				'line-height-h1',
				'line-height-h2',
				'line-height-h3',
				'line-height-h4',
				'line-height-h5',
				'line-height-h6',
				'line-height-footer-content',
				'line-height-site-title',
				'line-height-site-tagline',
				'line-height-primary-menu',
				'line-height-primary-dropdown-menu',
				'line-height-widget-title',
				'line-height-widget-content',
				'line-height-entry-title',
			);

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			if ( 0 < count( $astra_options ) ) {
				foreach ( $options as $key ) {

					if ( array_key_exists( $key, $astra_options ) && is_array( $astra_options[ $key ] ) ) {

						if ( in_array( $astra_options[ $key ]['desktop-unit'], array( '', 'em' ) ) ) {
							$astra_options[ $key ] = $astra_options[ $key ]['desktop'];
						} else {
							$astra_options[ $key ] = '';
						}
					}
				}
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update options of older version than 1.0.12.
		 *
		 * @since 1.0.12
		 */
		static public function v_1_0_12() {

			$options = array(
				'site-content-layout'         => 'plain-container',
				'single-page-content-layout'  => 'plain-container',
				'single-post-content-layout'  => 'content-boxed-container',
				'archive-post-content-layout' => 'content-boxed-container',
			);

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $astra_options[ $key ] ) ) {
					$astra_options[ $key ] = $value;
				}
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update options of older version than 1.0.14.
		 *
		 * @since 1.0.14
		 * @return void
		 */
		static public function v_1_0_14() {

			$options = array(
				'footer-sml-divider'          => '4',
				'footer-sml-divider-color'    => '#fff',
				'footer-adv'                  => 'layout-4',
				'single-page-sidebar-layout'  => 'no-sidebar',
				'single-post-sidebar-layout'  => 'right-sidebar',
				'archive-post-sidebar-layout' => 'right-sidebar',
			);

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $astra_options[ $key ] ) ) {
					$astra_options[ $key ] = $value;
				}
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );

			update_option( '_astra_pb_compatibility_offset', 1 );
			update_option( '_astra_pb_compatibility_time', date( 'Y-m-d H:i:s' ) );
		}

		/**
		 * Update page meta settings for all the themer layouts which are not already set.
		 * Default settings to previous versions was `no-sidebar` and `page-builder` through filters.
		 *
		 * @since  1.0.28
		 * @return void
		 */
		static public function v_1_0_28() {

			$query = array(
				'post_type'      => 'fl-theme-layout',
				'posts_per_page' => '-1',
				'no_found_rows'  => true,
				'post_status'    => 'any',
				'fields'         => 'ids',
			);

			// Execute the query.
			$posts = new WP_Query( $query );

			foreach ( $posts->posts as $id ) {

				$sidebar = get_post_meta( $id, 'site-sidebar-layout', true );

				if ( '' == $sidebar ) {
					update_post_meta( $id, 'site-sidebar-layout', 'no-sidebar' );
				}

				$content_layout = get_post_meta( $id, 'site-content-layout', true );

				if ( '' == $content_layout ) {
					update_post_meta( $id, 'site-content-layout', 'page-builder' );
				}
			}

		}

		/**
		 * Update options of older version than 1.1.0-beta.3.
		 *
		 * @since 1.1.0-beta.3
		 */
		static public function v_1_1_0_beta_3() {

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			if ( isset( $astra_options['shop-grid'] ) ) {

				$astra_options['shop-grids'] = array(
					'desktop' => $astra_options['shop-grid'],
					'tablet'  => 2,
					'mobile'  => 1,
				);

				unset( $astra_options['shop-grid'] );
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update options of older version than 1.1.0-beta.3.
		 *
		 * Container Style
		 * Sidebar
		 * Grid
		 *
		 * @since 1.1.0-beta.3
		 */
		static public function v_1_1_0_beta_4() {

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			$options = array(
				'woocommerce-content-layout' => 'default',
				'woocommerce-sidebar-layout' => 'default',
				/* Shop */
				'shop-grids'                 => array(
					'desktop' => 3,
					'tablet'  => 2,
					'mobile'  => 1,
				),
				'shop-no-of-products'        => '9',
			);

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $astra_options[ $key ] ) ) {
					$astra_options[ $key ] = $value;
				}
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update options of older version than 1.2.2.
		 *
		 * Logo Width
		 *
		 * @since 1.2.2
		 */
		static public function v_1_2_2() {

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			if ( isset( $astra_options['ast-header-logo-width'] ) && ! is_array( $astra_options['ast-header-logo-width'] ) ) {
				$astra_options['ast-header-responsive-logo-width'] = array(
					'desktop' => $astra_options['ast-header-logo-width'],
					'tablet'  => '',
					'mobile'  => '',
				);
			}

			if ( isset( $astra_options['blog-width'] ) ) {
				$astra_options['shop-archive-width'] = $astra_options['blog-width'];
			}

			if ( isset( $astra_options['blog-max-width'] ) ) {
				$astra_options['shop-archive-max-width'] = $astra_options['blog-max-width'];
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update Theme Color value same as Link Color for older version than 1.2.4.
		 *
		 * Theme Color update
		 *
		 * @since 1.2.4
		 */
		static public function v_1_2_4() {

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			if ( isset( $astra_options['link-color'] ) ) {
				$astra_options['theme-color'] = $astra_options['link-color'];
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update Google Fonts value with font categories
		 *
		 * Google Font Update
		 *
		 * @since 1.2.7
		 */
		static public function v_1_2_7() {

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );
			$google_fonts  = Astra_Font_Families::get_google_fonts();

			foreach ( $astra_options as $key => $value ) {

				if ( ! is_array( $value ) && ! empty( $value ) && ! is_bool( $value ) ) {

					if ( array_key_exists( $value, $google_fonts ) ) {
						$astra_options[ $key ] = "'" . $value . "', " . $google_fonts[ $value ][1];
					}
				}
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update options of older version than 1.3.0.
		 *
		 * Background options
		 *
		 * @since 1.3.0
		 */
		static public function v_1_3_0() {
			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			$astra_options['header-bg-obj'] = array(
				'background-color' => isset( $astra_options['header-bg-color'] ) ? $astra_options['header-bg-color'] : '',
			);

			$astra_options['content-bg-obj'] = array(
				'background-color' => isset( $astra_options['content-bg-color'] ) ? $astra_options['content-bg-color'] : '#ffffff',
			);

			$astra_options['footer-adv-bg-obj'] = array(
				'background-color'      => isset( $astra_options['footer-adv-bg-color'] ) ? $astra_options['footer-adv-bg-color'] : '',
				'background-image'      => isset( $astra_options['footer-adv-bg-img'] ) ? $astra_options['footer-adv-bg-img'] : '',
				'background-repeat'     => isset( $astra_options['footer-adv-bg-repeat'] ) ? $astra_options['footer-adv-bg-repeat'] : 'no-repeat',
				'background-position'   => isset( $astra_options['footer-adv-bg-pos'] ) ? $astra_options['footer-adv-bg-pos'] : 'center center',
				'background-size'       => isset( $astra_options['footer-adv-bg-size'] ) ? $astra_options['footer-adv-bg-size'] : 'cover',
				'background-attachment' => isset( $astra_options['footer-adv-bg-attac'] ) ? $astra_options['footer-adv-bg-attac'] : 'scroll',
			);

			$astra_options['footer-bg-obj'] = array(
				'background-color'      => isset( $astra_options['footer-bg-color'] ) ? $astra_options['footer-bg-color'] : '',
				'background-image'      => isset( $astra_options['footer-bg-img'] ) ? $astra_options['footer-bg-img'] : '',
				'background-repeat'     => isset( $astra_options['footer-bg-rep'] ) ? $astra_options['footer-bg-rep'] : 'repeat',
				'background-position'   => isset( $astra_options['footer-bg-pos'] ) ? $astra_options['footer-bg-pos'] : 'center center',
				'background-size'       => isset( $astra_options['footer-bg-size'] ) ? $astra_options['footer-bg-size'] : 'auto',
				'background-attachment' => isset( $astra_options['footer-bg-atch'] ) ? $astra_options['footer-bg-atch'] : 'scroll',
			);

			// Site layout background image and color.
			$site_layout = isset( $astra_options['site-layout'] ) ? $astra_options['site-layout'] : '';
			switch ( $site_layout ) {
				case 'ast-box-layout':
						$astra_options['site-layout-outside-bg-obj'] = array(
							'background-color'      => isset( $astra_options['site-layout-outside-bg-color'] ) ? $astra_options['site-layout-outside-bg-color'] : '',
							'background-image'      => isset( $astra_options['site-layout-box-bg-img'] ) ? $astra_options['site-layout-box-bg-img'] : '',
							'background-repeat'     => isset( $astra_options['site-layout-box-bg-rep'] ) ? $astra_options['site-layout-box-bg-rep'] : 'no-repeat',
							'background-position'   => isset( $astra_options['site-layout-box-bg-pos'] ) ? $astra_options['site-layout-box-bg-pos'] : 'center center',
							'background-size'       => isset( $astra_options['site-layout-box-bg-size'] ) ? $astra_options['site-layout-box-bg-size'] : 'cover',
							'background-attachment' => isset( $astra_options['site-layout-box-bg-atch'] ) ? $astra_options['site-layout-box-bg-atch'] : 'scroll',
						);
					break;

				case 'ast-padded-layout':
						$bg_color = isset( $astra_options['site-layout-outside-bg-color'] ) ? $astra_options['site-layout-outside-bg-color'] : '';
						$bg_image = isset( $astra_options['site-layout-padded-bg-img'] ) ? $astra_options['site-layout-padded-bg-img'] : '';

						$astra_options['site-layout-outside-bg-obj'] = array(
							'background-color'      => empty( $bg_image ) ? $bg_color : '',
							'background-image'      => $bg_image,
							'background-repeat'     => isset( $astra_options['site-layout-padded-bg-rep'] ) ? $astra_options['site-layout-padded-bg-rep'] : 'no-repeat',
							'background-position'   => isset( $astra_options['site-layout-padded-bg-pos'] ) ? $astra_options['site-layout-padded-bg-pos'] : 'center center',
							'background-size'       => isset( $astra_options['site-layout-padded-bg-size'] ) ? $astra_options['site-layout-padded-bg-size'] : 'cover',
							'background-attachment' => '',
						);
					break;

				case 'ast-full-width-layout':
				case 'ast-fluid-width-layout':
				default:
								$astra_options['site-layout-outside-bg-obj'] = array(
									'background-color' => isset( $astra_options['site-layout-outside-bg-color'] ) ? $astra_options['site-layout-outside-bg-color'] : '',
								);
					break;
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Mobile Header - Border new param introduced for Top, Right, Bottom and left border.
		 * Update options of older version than 1.4.0-beta.3.
		 *
		 * @since 1.4.0-beta.3
		 */
		static public function v_1_4_0_beta_3() {

			$theme_options     = get_option( 'astra-settings' );
			$mobile_logo_width = astra_get_option( 'mobile-header-logo-width' );

			if ( '' != $mobile_logo_width ) {
				$theme_options['ast-header-responsive-logo-width']['tablet'] = $mobile_logo_width;
			}

			$mobile_logo = ( isset( $theme_options['mobile-header-logo'] ) && '' !== $theme_options['mobile-header-logo'] ) ? $theme_options['mobile-header-logo'] : false;

			if ( '' != $mobile_logo ) {
				$theme_options['inherit-sticky-logo'] = false;
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Introduced different logo for mobile devices option
		 *
		 * @since 1.4.0-beta.4
		 */
		static public function v_1_4_0_beta_4() {

			$mobile_header_logo = astra_get_option( 'mobile-header-logo' );
			$theme_options      = get_option( 'astra-settings' );

			if ( '' != $mobile_header_logo ) {
				$theme_options['different-mobile-logo'] = true;
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Function to backward compatibility for version less than 1.4.0
		 *
		 * @since 1.4.0-beta.5
		 */
		static public function v_1_4_0_beta_5() {

			// Set default toggle button style.
			$theme_options = get_option( 'astra-settings' );

			if ( ! isset( $theme_options['mobile-header-toggle-btn-style'] ) ) {
				$theme_options['mobile-header-toggle-btn-style'] = 'fill';
			}

			$theme_options['hide-custom-menu-mobile'] = 0;

			update_option( 'astra-settings', $theme_options );

		}

		/**
		 * Function to backward compatibility for version less than 1.4.3
		 * Set the new option different-retina-logo to true for users who are already using a retina logo.
		 *
		 * @since 1.4.3-aplha.1
		 */
		static public function v_1_4_3_alpha_1() {

			$mobile_header_logo = astra_get_option( 'ast-header-retina-logo' );
			$theme_options      = get_option( 'astra-settings' );

			if ( '' != $mobile_header_logo ) {
				$theme_options['different-retina-logo'] = '1';
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Manage backwards compatibility when migrating to v1.4.9
		 *
		 * @since 1.4.9
		 * @return void
		 */
		public static function v_1_4_9() {
			$theme_options = get_option( 'astra-settings' );

			// Set flag to use anchors CSS selectors in the CSS for headings.
			if ( ! isset( $theme_options['include-headings-in-typography'] ) ) {
				$theme_options['include-headings-in-typography'] = true;
				update_option( 'astra-settings', $theme_options );
			}
		}

		/**
		 * Added Submenu Border options into theme from Addon
		 *
		 * @since 1.5.0-beta.4
		 *
		 * @return void
		 */
		public static function v_1_5_0_beta_4() {

			$border_disabled_values        = array(
				'top'    => '0',
				'bottom' => '0',
				'left'   => '0',
				'right'  => '0',
			);
			$inside_border_disabled_values = array(
				'bottom' => '0',
			);

			$border_enabled_values        = array(
				'top'    => '1',
				'bottom' => '1',
				'left'   => '1',
				'right'  => '1',
			);
			$inside_border_enabled_values = array(
				'bottom' => '1',
			);

			$theme_options  = get_option( 'astra-settings' );
			$submenu_border = isset( $theme_options['primary-submenu-border'] ) ? $theme_options['primary-submenu-border'] : true;

			// Primary Header.
			if ( $submenu_border ) {
				$theme_options['primary-submenu-border']      = $border_enabled_values;
				$theme_options['primary-submenu-item-border'] = $inside_border_enabled_values;
			} else {
				$theme_options['primary-submenu-border']      = $border_disabled_values;
				$theme_options['primary-submenu-item-border'] = $inside_border_disabled_values;
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Set flag 'submenu-below-header' to false to load fallback CSS to force menu load right after the container cropping logo and header.
		 *
		 * @see https://github.com/brainstormforce/astra/pull/820/
		 *
		 * @return void
		 */
		public static function v_1_5_0_rc_1() {
			$theme_options = get_option( 'astra-settings' );

			// Set flag to use anchors CSS selectors in the CSS for headings.
			if ( ! isset( $theme_options['submenu-below-header'] ) ) {
				$theme_options['submenu-below-header'] = false;
				update_option( 'astra-settings', $theme_options );
			}
		}

		/**
		 * Set Primary Header submenu border color 'primary-submenu-b-color' to '#eaeaea' for old users who doesn't set any color and set the theme color who install the fresh 1.5.0-rc.3 theme.
		 *
		 * @see https://github.com/brainstormforce/astra/pull/835
		 *
		 * @return void
		 */
		public static function v_1_5_0_rc_3() {

			$theme_options = get_option( 'astra-settings' );

			// Set the default #eaeaea sub menu border color who doesn't set any color.
			if ( ! isset( $theme_options['primary-submenu-b-color'] ) || empty( $theme_options['primary-submenu-b-color'] ) ) {
				$theme_options['primary-submenu-b-color'] = '#eaeaea';
			}

			// Set the primary sub menu animation to default for existing user.
			if ( ! isset( $theme_options['header-main-submenu-container-animation'] ) ) {
				$theme_options['header-main-submenu-container-animation'] = '';
			}

			update_option( 'astra-settings', $theme_options );

		}

		/**
		 * Change the Primary submenu option to be checkbpx rather than border selection.
		 *
		 * @return void
		 */
		public static function v_1_5_1() {
			$theme_options               = get_option( 'astra-settings', array() );
			$primary_submenu_otem_border = isset( $theme_options['primary-submenu-item-border'] ) ? $theme_options['primary-submenu-item-border'] : array();

			if ( ( is_array( $primary_submenu_otem_border ) && '0' != $primary_submenu_otem_border['bottom'] ) ) {
				$theme_options['primary-submenu-item-border'] = 1;
			} else {
				$theme_options['primary-submenu-item-border'] = 0;
			}
			if ( isset( $theme_options['primary-submenu-b-color'] ) && ! empty( $theme_options['primary-submenu-b-color'] ) ) {
				$theme_options['primary-submenu-item-b-color'] = $theme_options['primary-submenu-b-color'];
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Add same font variant as font weight for body and heading.
		 *
		 * @return void
		 */
		public static function v_1_5_2() {
			$theme_options = get_option( 'astra-settings', array() );
			if ( isset( $theme_options['body-font-weight'] ) && is_numeric( $theme_options['body-font-weight'] ) ) {
				$theme_options['body-font-variant'] = $theme_options['body-font-weight'];
			}
			if ( isset( $theme_options['headings-font-weight'] ) && is_numeric( $theme_options['headings-font-weight'] ) ) {
				$theme_options['headings-font-variant'] = $theme_options['headings-font-weight'];
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Disable transparent header in customizer if the transparent header addon was disabled.
		 *
		 * @return void
		 */
		public static function v_1_6_0() {
			$theme_options = get_option( 'astra-settings', array() );

			// Disable Transparent header is Transparent Header addon was deactivated from Astra Pro.
			if ( is_callable( 'Astra_Ext_Extension::get_enabled_addons' ) ) {
				$addons = Astra_Ext_Extension::get_enabled_addons();

				// If transparent header is addon was disabled, disable the transparent header.
				if ( 'transparent-header' !== $addons['transparent-header'] ) {
					$theme_options['transparent-header-enable'] = 0;
				}
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Add backward compatibility for Heading tags previous default values.
		 * Set Inline Logo & Site Title as false if user had not changed its value.
		 * Change default value for blog archive blog title.
		 *
		 * @return void
		 */
		public static function v_1_6_1() {
			$theme_options = get_option( 'astra-settings', array() );

			// If user was using a default value for h1, Set the default in the option.
			if ( ! isset( $theme_options['font-size-h1'] ) ) {
				$theme_options['font-size-h1'] = array(
					'desktop'      => '48',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}
			// If user was using a default value for h2, Set the default in the option.
			if ( ! isset( $theme_options['font-size-h2'] ) ) {
				$theme_options['font-size-h2'] = array(
					'desktop'      => '42',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}
			// If user was using a default value for h3, Set the default in the option.
			if ( ! isset( $theme_options['font-size-h3'] ) ) {
				$theme_options['font-size-h3'] = array(
					'desktop'      => '30',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}

			// If user was using a default value for h3, Set the default in the option.
			if ( ! isset( $theme_options['font-size-page-title'] ) ) {
				$theme_options['font-size-page-title'] = array(
					'desktop'      => '30',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}

			// If inline-logo option was unset previously, set to to false as new default is `true`.
			if ( ! isset( $theme_options['logo-title-inline'] ) ) {
				$theme_options['logo-title-inline'] = 0;
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Customizer Version 2 categorization database opertions using batch processing
		 *
		 * @return void
		 */
		public static function v_2_0_0() {

			$json = self::astra_new_controls();

			$json_array = json_decode( $json, true );

			foreach ( $json_array as $group => $sub_control ) {

				// Add database migration in queue.
				self::$process_all->push_to_queue( $group );
			}

			// Dispatch Queue.
			self::$process_all->save()->dispatch();
		}

		/**
		 * Update queued item values in database.
		 *
		 * @since 2.0.0
		 *
		 * @param array $new_options New options data.
		 * @return void
		 */
		public static function individual_queued_item_update( $new_options ) {

			$theme_options = get_option( 'astra-settings', array() );

			$theme_options = array_merge( $theme_options, $new_options );

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Perform database operations on indivitual queued items
		 *
		 * @since 2.0.0
		 *
		 * @param string $group Queue item.
		 * @return array
		 */
		public static function individual_queued_item_operations( $group ) {

			$theme_options = get_option( 'astra-settings', array() );

			$new_options = array();

			$json = self::astra_new_controls();

			$json_array = json_decode( $json, true );

			$sub_control = $json_array[ $group ];

			// Check if group key exists in the theme options.
			if ( array_key_exists( $group, $theme_options ) ) {
				return $new_options;
			}

			// Check if sub_control key exists in the theme options.
			if ( is_array( $sub_control ) ) {

				foreach ( $sub_control as $key => $value ) {
					// Check if sub_control key exists in the theme options.
					if ( array_key_exists( $value, $theme_options ) ) {
						$new_value                       = $theme_options[ $value ];
						$new_options[ $group ][ $value ] = $new_value;
					}
				}
				if ( array_key_exists( $group, $new_options ) ) {
					$new_options[ $group ] = json_encode( $new_options[ $group ] );
				}
			} else {
				// Check if sub_control key exists in the theme options.
				if ( array_key_exists( $sub_control, $theme_options ) ) {
					$new_value                             = $theme_options[ $sub_control ];
					$new_options[ $group ][ $sub_control ] = $new_value;
				}
			}

			return $new_options;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Theme_Update::get_instance();
