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

			do_action( 'astra_auto_update_before' );

			// Get auto saved version number.
			$saved_version = get_option( '_astra_auto_version', '0' );

			// If matches the current version then skip the next steps.
			if ( version_compare( $saved_version, AST_THEME_VERSION, '=' ) ) {
				return;
			}

			// Update to older version than 1.0.3 version.
			if ( version_compare( $saved_version, '1.0.3', '<' ) ) {
				self::v_1_0_3();
			}

			// Update auto saved version number.
			update_option( '_astra_auto_version', AST_THEME_VERSION );

			do_action( 'astra_auto_update_after' );
		}

		/**
		 * Update options of older version than 1.0.3.
		 *
		 * @since 1.0.3
		 * @return void
		 */
		static public function v_1_0_3() {

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
			);

			$ast_options = get_option( AST_THEME_SETTINGS );

			foreach ( $options as $key ) {

				if ( array_key_exists( $key, $ast_options ) && ! is_array( $ast_options[ $key ] ) ) {

					$ast_options[ $key ] = array(
						'desktop' 	=> $ast_options[ $key ],
						'tablet' 	=> '',
						'mobile' 	=> '',
					);
				}
			}

			update_option( AST_THEME_SETTINGS, $ast_options );
		}
	}
}// End if().

/**
 * Kicking this off by calling 'get_instance()' method
 */
Ast_Theme_Update::get_instance();
