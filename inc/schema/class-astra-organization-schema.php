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
class Astra_Organization_Schema extends Astra_Schema {

	/**
	 * Setup schema
	 *
	 * @since 1.0.0
	 */
	public function setup_schema() {

		if ( true !== $this->schema_enabled() ) {
			return false;
		}

		add_filter( 'astra_attr_site-identity', array( $this, 'organization_Schema' ) );
		add_filter( 'astra_attr_site-title', array( $this, 'site_title_attr' ) );
		add_filter( 'astra_attr_site-title-link', array( $this, 'site_title_link_attr' ) );
	}

	/**
	 * Update Schema markup attribute.
	 *
	 * @param  array $attr An array of attributes.
	 *
	 * @return string       Updated embed markup.
	 */
	public function organization_Schema( $attr ) {
		$attr['itemtype']  = 'https://schema.org/Organization';
		$attr['itemscope'] = 'itemscope';

		return $attr;
	}

	/**
	 * Update Schema markup attribute.
	 *
	 * @param  array $attr An array of attributes.
	 *
	 * @return string       Updated embed markup.
	 */
	public function site_title_attr( $attr ) {
		$attr['itemprop'] = 'name';

		return $attr;
	}

	/**
	 * Update Schema markup attribute.
	 *
	 * @param  array $attr An array of attributes.
	 *
	 * @return string       Updated embed markup.
	 */
	public function site_title_link_attr( $attr ) {
		$attr['itemprop'] = 'url';
		$attr['class']    = '';

		return $attr;
	}

	/**
	 * Enabled schema
	 *
	 * @since 1.0.0
	 */
	protected function schema_enabled() {
		return apply_filters( 'astra_organization_schema_enabled', parent::schema_enabled() );
	}

}

new Astra_Organization_Schema();
