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
 * Astra Breadcrumb Schema Markup.
 *
 * @since x.x.x
 */
class Astra_Breadcrumb_Schema extends Astra_Schema {

	/**
	 * Setup schema
	 *
	 * @since x.x.x
	 */
	public function setup_schema() {
		if ( true !== $this->schema_enabled() ) {
			add_filter( 'astra_breadcrumb_trail_args', array( $this, 'breadcrumb_schema' ) );
			return false;
		}
		add_action( 'wp', array( $this, 'disable_schema_before_title' ), 20 );
	}

	/**
	 * Disable schema for Before Title option of Breadcrumb Position.
	 *
	 * @since x.x.x
	 *
	 * @return void
	 */
	public function disable_schema_before_title() {
		$breadcrumb_position = astra_get_option( 'breadcrumb-position' );
		$breadcrumb_source   = astra_get_option( 'select-breadcrumb-source' );

		if ( 'astra_entry_top' === $breadcrumb_position && empty( $breadcrumb_source ) ) {
			add_filter( 'astra_breadcrumb_trail_args', array( $this, 'breadcrumb_schema' ) );
		}
	}

	/**
	 * Disable schema by passing false to the 'schema' param to the filter.
	 *
	 * @since x.x.x
	 *
	 * @param  array $args An array of default values.
	 *
	 * @return array       Updated schema param.
	 */
	public function breadcrumb_schema( $args ) {
		$args['schema'] = false;

		return $args;
	}

	/**
	 * Enabled schema
	 *
	 * @since x.x.x
	 */
	protected function schema_enabled() {
		return apply_filters( 'astra_breadcrumb_schema_enabled', parent::schema_enabled() );
	}

}

new Astra_Breadcrumb_Schema();
