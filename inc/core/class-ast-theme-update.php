<?php
/**
 * Theme Update
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2015, Brainstorm Force
 * @link        http://www.brainstormforce.com
 * @since       Astra 1.0.0
 */

if ( ! class_exists( 'Ast_Theme_Update' ) ) {

	/**
	 * Ast_Theme_Update initial setup
	 *
	 * @since 1.0.0
	 */
	class Ast_Theme_Update {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
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
		 *  Constructor
		 */
		public function __construct() {

			// Theme Updates.
			add_action( 'init', __CLASS__ . '::init' );

		}

		/**
		 * Implement theme update logic.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		static public function init() {

			do_action( 'astra_update_before' );

			// Get auto saved version number.
			$saved_version = ast_get_option( 'theme-auto-version' );

			// If equals then return.
			if ( version_compare( $saved_version, AST_THEME_VERSION, '=' ) ) {
				return;
			}

			// Not have stored?
			if ( empty( $saved_version ) ) {

				// Get old version.
				$theme_version = get_option( '_astra_auto_version', '0' );

				// Remove option.
				delete_option( '_astra_auto_version' );

			} else {

				// Get latest version.
				$theme_version = AST_THEME_VERSION;
			}

			// Get all customizer options.
			$customizer_options = get_option( AST_THEME_SETTINGS );

			// Get all customizer options.
			$version_array = array(
				'theme-auto-version' => $theme_version,
			);

			// Merge customizer options with version.
			$theme_options = wp_parse_args( $version_array, $customizer_options );

			// Update auto saved version number.
			update_option( AST_THEME_SETTINGS, $theme_options );

			do_action( 'astra_update_after' );
		}
	}
}// End if().

/**
 * Kicking this off by calling 'get_instance()' method
 */
Ast_Theme_Update::get_instance();
