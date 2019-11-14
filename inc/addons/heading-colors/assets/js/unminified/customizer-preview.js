/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra
 * @since x.x.x
 */

( function( $ ) {

	/**
	 * Content <h1> to <h6> headings
	 */
	astra_css( 'astra-settings[h1-color]', 'color', 'h1, .entry-content h1' );
	astra_css( 'astra-settings[h2-color]', 'color', 'h2, .entry-content h2' );
	astra_css( 'astra-settings[h3-color]', 'color', 'h3, .entry-content h3' );
	astra_css( 'astra-settings[h4-color]', 'color', 'h4, .entry-content h4' );
	astra_css( 'astra-settings[h5-color]', 'color', 'h5, .entry-content h5' );
	astra_css( 'astra-settings[h6-color]', 'color', 'h6, .entry-content h6' );

	astra_generate_outside_font_family_css( 'astra-settings[font-family-h1]', 'h1, .entry-content h1' );
	astra_css('astra-settings[font-weight-h1]', 'font-weight', 'h1, .entry-content h1');	
	astra_css('astra-settings[line-height-h1]', 'line-height', 'h1, .entry-content h1');
	astra_css('astra-settings[text-transform-h1]', 'text-transform', 'h1, .entry-content h1');

	astra_generate_outside_font_family_css( 'astra-settings[font-family-h2]', 'h2, .entry-content h2' );
	astra_css('astra-settings[font-weight-h2]', 'font-weight', 'h2, .entry-content h2');	
	astra_css('astra-settings[line-height-h2]', 'line-height', 'h2, .entry-content h2');
	astra_css('astra-settings[text-transform-h2]', 'text-transform', 'h2, .entry-content h2');

	astra_generate_outside_font_family_css( 'astra-settings[font-family-h3]', 'h3, .entry-content h3' );
	astra_css('astra-settings[font-weight-h3]', 'font-weight', 'h3, .entry-content h3');	
	astra_css('astra-settings[line-height-h3]', 'line-height', 'h3, .entry-content h3');
	astra_css('astra-settings[text-transform-h3]', 'text-transform', 'h3, .entry-content h3');
	
} )( jQuery );
		