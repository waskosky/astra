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

	public function __construct() {
		$this->include_schemas();

		add_action( 'wp', array( $this, 'setup_schema' ) );
	}
	
	public function setup_schema() { }

    private function include_schemas() {
        require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-creativework-schema.php';
    }
    
    protected function schema_enabled() {
        return apply_filters( 'astra_schema_enabled', true );
    }

}

new Astra_Schema();
