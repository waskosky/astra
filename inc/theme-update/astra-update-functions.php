<?php
/**
 * Astra Updates
 *
 * Functions for updating data, used by the background updater.
 *
 * @package Astra
 * @version x.x.x
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add Hidden Class CSS if Addon is not updated to 2.2.0
 *
 * @since x.x.x
 * @return void
 */
function astra_hidden_css_class_compatibility() {
	// If Addon is not updated to version 2.2.0 then add hidden class as a fallback.
	if ( class_exists( 'Astra_Addon_Update' ) ) {
		$saved_version = Astra_Addon_Update::astra_addon_stored_version();

		if ( version_compare( $saved_version, '2.2.0', '<' ) ) {
			$theme_options = get_option( 'astra-settings' );

				// Set flag to add hidden class css if addon is not updated.
			if ( ! isset( $theme_options['hidden-class-css'] ) ) {
				$theme_options['hidden-class-css'] = false;
				update_option( 'astra-settings', $theme_options );
			}
		}
	}
}
