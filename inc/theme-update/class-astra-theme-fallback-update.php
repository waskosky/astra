<?php
/**
 * Theme Update
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Astra_Theme_Fallback_Update' ) ) {

	/**
	 * Astra_Theme_Fallback_Update initial setup
	 *
	 * @since x.x.x
	 */
	class Astra_Theme_Fallback_Update {

		/**
		 *  Constructor
		 */
		public function __construct() {

			$this->init();
		}

		/**
		 * Implement theme update logic.
		 *
		 * @since x.x.x
		 */
		public function init() {

			do_action( 'astra_fallback_update_before' );

			// Get auto saved version number.
			$saved_version = astra_get_option( 'theme-auto-version', false );

			if ( version_compare( $saved_version, '2.1.3', '<' ) ) {
				self::v_2_1_3();
			}

			Astra_Theme_Background_Updater::update_db_version();

			do_action( 'astra_fallback_update_after' );
		}

		/**
		 * Add backward compatibility for version 2.1.3.
		 *
		 * @since x.x.x
		 * @return void
		 */
		public static function v_2_1_3() {
			astra_submenu_below_header();
		}

	}
}
