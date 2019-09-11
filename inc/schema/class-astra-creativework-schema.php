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
class Astra_CreativeWork_Schema extends Astra_Schema {

	public function setup_schema() {

		if ( true !== $this->schema_enabled() ) {
			return false;
		}

		add_filter( 'astra_attr_article-blog', array( $this, 'creative_work_Schema' ) );
		add_filter( 'astra_attr_article-page', array( $this, 'creative_work_Schema' ) );
		add_filter( 'astra_attr_article-single', array( $this, 'creative_work_Schema' ) );
		add_filter( 'astra_attr_article-content', array( $this, 'creative_work_Schema' ) );
	}

	public function creative_work_Schema( $attr ) {
		$attr['itemtype'] = 'https://schema.org/CreativeWork';
		$attr['itemscope'] = 'itemscope';

		return $attr;
	}

	protected function schema_enabled() {
		return apply_filters( 'astra_creativework_schema_enabled', parent::schema_enabled() );
	}

}

new Astra_CreativeWork_Schema();
