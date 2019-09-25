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
 * Astra CreativeWork Schema Markup.
 *
 * @since x.x.x
 */
class Astra_WPHeader_Schema extends Astra_Schema {

	/**
	 * Setup schema
	 *
	 * @since x.x.x
	 */
	public function setup_schema() {

		if ( true !== $this->schema_enabled() ) {
			return false;
		}

		add_filter( 'astra_attr_header', array( $this, 'wpheader_Schema' ) );
	}

	/**
	 * Update Schema markup attribute.
	 *
	 * @param  array $attr An array of attributes.
	 *
	 * @return array       Updated embed markup.
	 */
	public function wpheader_Schema( $attr ) {
		$attr['itemtype']  = 'https://schema.org/WPHeader';
		$attr['itemscope'] = 'itemscope';

		return $attr;
	}

	/**
	 * Enabled schema
	 *
	 * @since x.x.x
	 */
	protected function schema_enabled() {
		return apply_filters( 'astra_wpheader_schema_enabled', parent::schema_enabled() );
	}

}

new Astra_WPHeader_Schema();
