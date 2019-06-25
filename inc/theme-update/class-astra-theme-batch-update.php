<?php
/**
 * Theme Batch Update
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since x.x.x.x
 */

if ( ! class_exists( 'Astra_Theme_Batch_Update' ) ) {

	/**
	 * Astra_Theme_Batch_Update Class.
	 */
	class Astra_Theme_Batch_Update {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Background update class.
		 *
		 * @var object
		 */
		private static $background_updater;

		/**
		 * DB updates and callbacks that need to be run per version.
		 *
		 * @var array
		 */
		private static $db_updates = array(
			'2.0.0-beta.1' => array(
				'astra_theme_update_v2_0_0_beta_1',
			),
			'2.0.0-beta.2' => array(
				'astra_theme_update_v2_0_0_beta_2',
			),
			'2.0.0-beta.3' => array(
				'astra_theme_update_v2_0_0_beta_3',
			),
		);

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
			self::init();
		}

		/**
		 * Hook in tabs.
		 */
		public static function init() {
			// Theme Updates.
			// delete_option( 'my_testing' );.
			if ( is_admin() ) {
				add_action( 'admin_init', array( __CLASS__, 'install_actions' ) );
			} else {
				add_action( 'wp', array( __CLASS__, 'install_actions' ) );
			}

			// Core Helpers - Batch Processing.
			require_once ASTRA_THEME_DIR . 'inc/theme-update/batch-processing/class-wp-async-request.php';
			require_once ASTRA_THEME_DIR . 'inc/theme-update/batch-processing/class-wp-background-process.php';
			require_once ASTRA_THEME_DIR . 'inc/theme-update/batch-processing/class-wp-background-process-astra-theme.php';

			self::$background_updater = new WP_Background_Process_Astra_Theme();

		}

		/**
		 * Install actions when a update button is clicked within the admin area.
		 *
		 * This function is hooked into admin_init and wp to affect admin and frontend both.
		 */
		public static function install_actions() {
			if ( 'yes' === get_option( 'my_testing', 'yes' ) ) {
				error_log( 'called' );
				update_option( 'my_testing', 'no' );
				self::update();
			}
		}

		/**
		 * Is this a brand new WC install?
		 *
		 * @since x.x.x
		 * @return boolean
		 */
		private static function is_new_install() {

			// Get auto saved version number.
			$saved_version = astra_get_option( 'theme-auto-version', false );

			if ( false === $saved_version ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Is a DB update needed?
		 *
		 * @since x.x.x
		 * @return boolean
		 */
		private static function needs_db_update() {
			$current_theme_version = get_option( 'theme-auto-version', null );
			$updates               = self::get_db_update_callbacks();

			return ! is_null( $current_theme_version ) && version_compare( $current_theme_version, max( array_keys( $updates ) ), '<' );
		}

		/**
		 * See if we need to show or run database updates during install.
		 *
		 * @since x.x.x
		 */
		private static function maybe_update_db_version() {
			if ( self::needs_db_update() ) {
				self::update();
			} else {
				self::update_db_version();
			}
		}

		/**
		 * Get list of DB update callbacks.
		 *
		 * @since x.x.x
		 * @return array
		 */
		public static function get_db_update_callbacks() {
			return self::$db_updates;
		}

		/**
		 * Push all needed DB updates to the queue for processing.
		 */
		private static function update() {
			$current_db_version = get_option( 'theme-auto-version' );

			foreach ( self::get_db_update_callbacks() as $version => $update_callbacks ) {
				if ( version_compare( $current_db_version, $version, '<' ) ) {
					foreach ( $update_callbacks as $update_callback ) {
						var_dump( $update_callback );
						error_log( sprintf( 'Queuing %s - %s', $version, $update_callback ) );

						self::$background_updater->push_to_queue( $update_callback );
					}
				}
			}

			self::$background_updater->save()->dispatch();
		}

		/**
		 * Update DB version to current.
		 *
		 * @param string|null $version New Astra theme version or null.
		 */
		public static function update_db_version( $version = null ) {

			// Get auto saved version number.
			$saved_version = astra_get_option( 'theme-auto-version', false );

			if ( false === $saved_version ) {
				$saved_version = ASTRA_THEME_VERSION;
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
		}
	}
}


/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Theme_Batch_Update::get_instance();
