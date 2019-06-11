<?php
/**
 * Skins of Astra Theme.
 *
 * @package     Astra
 * @subpackage  Class
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Skins
 */
if ( ! class_exists( 'Astra_Skins' ) ) {

	/**
	 * Astra_Skins
	 */
	class Astra_Skins {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'astra_theme_assets', array( $this, 'add_styles' ), 100 );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since x.x.x
		 */
		function add_styles( $assets ) {
			if ( 'modern-skin' === self::astra_get_selected_skin() ) {
				$assets['css']['astra-modern-skin'] = 'skin-1';
				return $assets;
			}

			$assets['css']['astra-classic-skin'] = 'skin-classic';
			return $assets;
		}

		/**
		 * Get the skin selected from customizer for the site.
		 *
		 * @since x.x.x
		 * @return string Selected skin.
		 */
		public static function astra_get_selected_skin() {
			// If Addon is not updated to version 1.9.0 then fallback to Classic Skin.
			// if ( class_exists( 'Astra_Addon_Update' ) ) {
			// 	$saved_version = Astra_Addon_Update::astra_addon_stored_version();
			// 	if ( version_compare( $saved_version, '1.9.0', '<' ) ) {
			// 		return 'classic-skin';
			// 	}
			// }

			$theme_options = get_option( ASTRA_THEME_SETTINGS );
			$option        = 'site-content-skin';
			$default       = 'modern-skin';
			$value         = ( isset( $theme_options[ $option ] ) && '' !== $theme_options[ $option ] ) ? $theme_options[ $option ] : $default;
			return $value;
		}
	}
}

new Astra_Skins();
