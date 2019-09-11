<?php
/**
 * Schema markup.
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

/**
 * Astra Schema Markup.
 *
 * @since x.x.x
 */
class Astra_Schema {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->include_schemas();

		add_action( 'wp', array( $this, 'setup_schema' ) );
	}

	/**
	 * Setup schema
	 *
	 * @since 1.0.0
	 */
	public function setup_schema() { }

	/**
	 * Include schema files.
	 *
	 * @since 1.0.0
	 */
	private function include_schemas() {
		require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-creativework-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-wpheader-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-wpfooter-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-wpsidebar-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-person-schema.php';
	}

	/**
	 * Enabled schema
	 *
	 * @since 1.0.0
	 */
	protected function schema_enabled() {
		return apply_filters( 'astra_schema_enabled', true );
	}

}

new Astra_Schema();
