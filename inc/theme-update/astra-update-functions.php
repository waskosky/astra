<?php
/**
 * Astra Updates
 *
 * Functions for updating data, used by the background updater.
 *
 * @package Astra
 * @version 2.1.3
 */

defined( 'ABSPATH' ) || exit;

/**
 * Open Submenu just below menu for existing users.
 *
 * @since 2.1.3
 * @return void
 */
function astra_submenu_below_header() {
	$theme_options = get_option( 'astra-settings' );

	// Set flag to use flex align center css to open submenu just below menu.
	if ( ! isset( $theme_options['submenu-open-below-header'] ) ) {
		$theme_options['submenu-open-below-header'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Check if we need to change the default value for tablet breakpoint.
 *
 * @since 2.2.0
 * @return void
 */
function astra_update_theme_tablet_breakpoint() {
	$theme_options = get_option( 'astra-settings' );

	// Set a flag to check if we need to change the theme tablet breakpoint value.
	$theme_options['can-update-theme-tablet-breakpoint'] = false;
	update_option( 'astra-settings', $theme_options );
}
