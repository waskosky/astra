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
class Astra_Site_Navigation_Schema extends Astra_Schema {

	/**
	 * Setup schema
	 *
	 * @since x.x.x
	 */
	public function setup_schema() {

		if ( true !== $this->schema_enabled() ) {
			return false;
		}

		add_filter( 'astra_attr_site-navigation', array( $this, 'site_navigation_schema' ) );
	}

	/**
	 * Update Schema markup attribute.
	 *
	 * @param  array $attr An array of attributes.
	 *
	 * @return array       Updated embed markup.
	 */
	public function site_navigation_schema( $attr ) {
		$attr['itemtype']  = 'https://schema.org/SiteNavigationElement';
		$attr['itemscope'] = 'itemscope';

		return $attr;
	}

	/**
	 * Enabled schema
	 *
	 * @since x.x.x
	 */
	protected function schema_enabled() {
		return apply_filters( 'astra_site_navigation_schema_enabled', parent::schema_enabled() );
	}

}

new Astra_Site_Navigation_Schema();
