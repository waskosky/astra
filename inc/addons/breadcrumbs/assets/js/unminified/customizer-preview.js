/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra
 * @since 1.7.0
 */

( function( $ ) {

	/* Breadcrumb Typography */                                                                                                                                                                                                                                                                                                                                                                                                                                                        
	astra_apply_responsive_font_size( 
		'astra-settings[section-breadcrumb-typo]',
		'breadcrumb-font-size',
		'.ast-breadcrumbs-wrapper .trail-items span, .ast-breadcrumbs-wrapper a, .ast-breadcrumbs-wrapper .breadcrumb_last, .ast-breadcrumbs-wrapper span,  .ast-breadcrumbs-wrapper .breadcrumbs, .ast-breadcrumbs-wrapper .current-item, .ast-breadcrumbs-wrapper .last, .ast-breadcrumbs-wrapper .separator'
	);
	astra_generate_font_family_css(
		'astra-settings[section-breadcrumb-typo]',
		'breadcrumb-font-family',
		'.ast-breadcrumbs-wrapper .trail-items span, .ast-breadcrumbs-wrapper a, .ast-breadcrumbs-wrapper .breadcrumb_last, .ast-breadcrumbs-wrapper span,  .ast-breadcrumbs-wrapper .breadcrumbs, .ast-breadcrumbs-wrapper .current-item, .ast-breadcrumbs-wrapper .last, .ast-breadcrumbs-wrapper .separator',
		'font-family'
	);
	astra_generate_css(
		'astra-settings[section-breadcrumb-typo]',
		'breadcrumb-font-weight',
		'.ast-breadcrumbs-wrapper .trail-items span, .ast-breadcrumbs-wrapper a, .ast-breadcrumbs-wrapper .breadcrumb_last, .ast-breadcrumbs-wrapper span,  .ast-breadcrumbs-wrapper .breadcrumbs, .ast-breadcrumbs-wrapper .current-item, .ast-breadcrumbs-wrapper .last, .ast-breadcrumbs-wrapper .separator',
		'font-weight'
	);
	astra_generate_css(
		'astra-settings[section-breadcrumb-typo]',
		'breadcrumb-text-transform',
		'.ast-breadcrumbs-wrapper .trail-items span, .ast-breadcrumbs-wrapper a, .ast-breadcrumbs-wrapper .breadcrumb_last, .ast-breadcrumbs-wrapper span,  .ast-breadcrumbs-wrapper .breadcrumbs, .ast-breadcrumbs-wrapper .current-item, .ast-breadcrumbs-wrapper .last, .ast-breadcrumbs-wrapper .separator',
		'text-transform'
	);
	
	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Line Height */
	astra_generate_css( 
		'astra-settings[section-breadcrumb-typo]',
		'breadcrumb-line-height',
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator, .ast-breadcrumbs-wrapper a, .ast-breadcrumbs-wrapper .breadcrumb_last, .ast-breadcrumbs-wrapper span, .ast-breadcrumbs-wrapper a, .ast-breadcrumbs-wrapper .breadcrumbs, .ast-breadcrumbs-wrapper .current-item, .ast-breadcrumbs-wrapper a, .ast-breadcrumbs-wrapper .last, .ast-breadcrumbs-wrapper .separator',
		'line-height'
	);
		
	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Text Color */
	astra_apply_responsive_color_property( 
		'astra-settings[section-breadcrumb-color]',
		'breadcrumb-active-color-responsive',
		'.ast-breadcrumbs-wrapper .trail-items .trail-end, .ast-breadcrumbs-wrapper #ast-breadcrumbs-yoast .breadcrumb_last, .ast-breadcrumbs-wrapper .current-item, .ast-breadcrumbs-wrapper .last',
		'color'
	);
	
	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Link Color */
	astra_apply_responsive_color_property(
		'astra-settings[section-breadcrumb-color]',
		'breadcrumb-text-color-responsive',
		'.ast-breadcrumbs-wrapper .trail-items a, .ast-breadcrumbs-wrapper #ast-breadcrumbs-yoast a, .ast-breadcrumbs-wrapper .breadcrumbs a, .ast-breadcrumbs-wrapper .rank-math-breadcrumb a',
		'color'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Hover Color */
	astra_apply_responsive_color_property(
		'astra-settings[section-breadcrumb-color]',
		'breadcrumb-hover-color-responsive',
		'.ast-breadcrumbs-wrapper .trail-items a:hover, .ast-breadcrumbs-wrapper #ast-breadcrumbs-yoast a:hover, .ast-breadcrumbs-wrapper .breadcrumbs a:hover, .ast-breadcrumbs-wrapper .rank-math-breadcrumb a:hover',
		'color'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Separator Color */
	astra_apply_responsive_color_property(
		'astra-settings[section-breadcrumb-color]',
		'breadcrumb-separator-color',
		'.ast-breadcrumbs-wrapper .trail-items li::after, .ast-breadcrumbs-wrapper #ast-breadcrumbs-yoast, .ast-breadcrumbs-wrapper .breadcrumbs, .ast-breadcrumbs-wrapper .rank-math-breadcrumb .separator',
		'color'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Background Color */
	astra_apply_responsive_color_property(
		'astra-settings[section-breadcrumb-color]',
		'breadcrumb-bg-color',
		'.ast-breadcrumbs-wrapper, .main-header-bar.ast-header-breadcrumb, .ast-primary-sticky-header-active .main-header-bar.ast-header-breadcrumb',
		'background-color'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Alignment */
	astra_css( 'astra-settings[breadcrumb-alignment]',
		'text-align',
		'.ast-breadcrumbs-wrapper'
	);

	/**
	 * Breadcrumb Spacing
	 */
	wp.customize( 'astra-settings[breadcrumb-spacing]', function( value ) {
		value.bind( function( padding ) {
			if( 'astra_header_markup_after' == wp.customize( 'astra-settings[breadcrumb-position]' ).get() ) {
				astra_responsive_spacing( 'astra-settings[breadcrumb-spacing]','.main-header-bar.ast-header-breadcrumb', 'padding',  ['top', 'right', 'bottom', 'left' ] );
			} else if( 'astra_masthead_content' == wp.customize( 'astra-settings[breadcrumb-position]' ).get() ) {
				astra_responsive_spacing( 'astra-settings[breadcrumb-spacing]','.ast-breadcrumbs-wrapper .ast-breadcrumbs-inner #ast-breadcrumbs-yoast, .ast-breadcrumbs-wrapper .ast-breadcrumbs-inner .breadcrumbs, .ast-breadcrumbs-wrapper .ast-breadcrumbs-inner .rank-math-breadcrumb, .ast-breadcrumbs-wrapper .ast-breadcrumbs-inner .ast-breadcrumbs', 'padding',  ['top', 'right', 'bottom', 'left' ] );
			} else {
				astra_responsive_spacing( 'astra-settings[breadcrumb-spacing]','.ast-breadcrumbs-wrapper #ast-breadcrumbs-yoast, .ast-breadcrumbs-wrapper .breadcrumbs, .ast-breadcrumbs-wrapper .rank-math-breadcrumb, .ast-breadcrumbs-wrapper .ast-breadcrumbs', 'padding',  ['top', 'right', 'bottom', 'left' ] );
			}
		} );
	} );

} )( jQuery );
		