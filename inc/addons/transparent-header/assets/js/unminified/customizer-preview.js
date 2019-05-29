/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra Addon
 * @since  1.0.0
 */

( function( $ ) {
	
	/**
	 * Transparent Logo Width
	 */
	wp.customize( 'astra-settings[transparent-header-logo-width]', function( setting ) {
		setting.bind( function( logo_width ) {
			if ( logo_width['desktop'] != '' || logo_width['tablet'] != '' || logo_width['mobile'] != '' ) {
				var dynamicStyle = '.ast-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img {max-width: ' + logo_width['desktop'] + 'px;} .ast-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .astra-logo-svg { width: ' + logo_width['desktop'] + 'px;} @media( max-width: 768px ) { .ast-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img {max-width: ' + logo_width['tablet'] + 'px;} .ast-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .astra-logo-svg { width: ' + logo_width['tablet'] + 'px;} } @media( max-width: 544px ) { .ast-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img {max-width: ' + logo_width['mobile'] + 'px;} .ast-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .astra-logo-svg { width: ' + logo_width['mobile'] + 'px;} }';
				astra_add_dynamic_css( 'transparent-header-logo-width', dynamicStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	/**
	 * Transparent Header Bottom Border width
	 */
	wp.customize( 'astra-settings[transparent-header-main-sep]', function( value ) {
		value.bind( function( border ) {

			var dynamicStyle = ' body.ast-theme-transparent-header.ast-header-break-point .site-header { border-bottom-width: ' + border + 'px } ';

			dynamicStyle += 'body.ast-theme-transparent-header.ast-desktop .main-header-bar {';
			dynamicStyle += 'border-bottom-width: ' + border + 'px';
			dynamicStyle += '}';

			astra_add_dynamic_css( 'transparent-header-main-sep', dynamicStyle );

		} );
	} );

	/**
	 * Transparent Header Bottom Border color
	 */
	wp.customize( 'astra-settings[transparent-header-main-sep-color]', function( value ) {
		value.bind( function( color ) {
			if (color == '') {
				wp.customize.preview.send( 'refresh' );
			}

			if ( color ) {

				var dynamicStyle = ' body.ast-theme-transparent-header.ast-desktop .main-header-bar { border-bottom-color: ' + color + '; } ';
					dynamicStyle += ' body.ast-theme-transparent-header.ast-header-break-point .site-header { border-bottom-color: ' + color + '; } ';

				astra_add_dynamic_css( 'transparent-header-main-sep-color', dynamicStyle );
			}

		} );
	} );


	/* Transparent Header Colors */                                                                                                                                                                                                                                                                                                                                                                                                                                                        
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-background-colors]', 'transparent-header-bg-color-responsive', '.ast-theme-transparent-header .main-header-bar, .ast-theme-transparent-header.ast-header-break-point .main-header-menu, .ast-theme-transparent-header.ast-header-break-point .main-header-bar', 'background-color', 'transparent-primary-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors]', 'transparent-header-color-site-title-responsive', '.ast-theme-transparent-header .site-title a, .ast-theme-transparent-header .site-title a:focus, .ast-theme-transparent-header .site-title a:hover, .ast-theme-transparent-header .site-title a:visited, .ast-theme-transparent-header .site-header .site-description', 'color', 'transparent-primary-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors]', 'transparent-header-color-h-site-title-responsive', '.ast-theme-transparent-header .site-header .site-title a:hover', 'color', 'transparent-primary-header' );
	
	// Primary Menu
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-bg-color-responsive', '.ast-theme-transparent-header .main-header-menu, .ast-theme-transparent-header.ast-header-break-point .main-header-menu', 'background-color', 'transparent-primary-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-color-responsive', '.ast-theme-transparent-header .main-header-menu, .ast-theme-transparent-header .main-header-menu a,.ast-theme-transparent-header .ast-masthead-custom-menu-items, .ast-theme-transparent-header .ast-masthead-custom-menu-items a,.ast-theme-transparent-header .main-header-menu li > .ast-menu-toggle, .ast-theme-transparent-header .main-header-menu li > .ast-menu-toggle', 'color', 'transparent-primary-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-h-color-responsive', '.ast-theme-transparent-header .main-header-menu li:hover > a, .ast-theme-transparent-header .main-header-menu li:hover > .ast-menu-toggle, .ast-theme-transparent-header .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-theme-transparent-header .main-header-menu .focus > a, .ast-theme-transparent-header .main-header-menu .focus > .ast-menu-toggle, .ast-theme-transparent-header .main-header-menu .current-menu-item > a, .ast-theme-transparent-header .main-header-menu .current-menu-ancestor > a, .ast-theme-transparent-header .main-header-menu .current_page_item > a, .ast-theme-transparent-header .main-header-menu .current-menu-item > .ast-menu-toggle, .ast-theme-transparent-header .main-header-menu .current-menu-ancestor > .ast-menu-toggle, .ast-theme-transparent-header .main-header-menu .current_page_item > .ast-menu-toggle', 'color', 'transparent-primary-header' );
	// Primary SubMenu
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-bg-color-responsive', '.ast-theme-transparent-header .main-header-menu ul.sub-menu ', 'background-color', 'transparent-primary-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-color-responsive', '.ast-theme-transparent-header .main-header-menu ul.sub-menu li a,.ast-theme-transparent-header .main-header-menu ul.sub-menu li > .ast-menu-toggle', 'color', 'transparent-primary-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-h-color-responsive', '.ast-theme-transparent-header .main-header-menu ul.sub-menu a:hover,.ast-theme-transparent-header .main-header-menu ul.sub-menu li:hover > a, .ast-theme-transparent-header .main-header-menu ul.sub-menu li.focus > a, .ast-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > a,	.ast-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > .ast-menu-toggle,.ast-theme-transparent-header .main-header-menu ul.sub-menu li:hover > .ast-menu-toggle, .ast-theme-transparent-header .main-header-menu ul.sub-menu li.focus > .ast-menu-toggle', 'color', 'transparent-primary-header' );


	// Primary Content Section text color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-text-color-responsive', '.ast-theme-transparent-header div.ast-masthead-custom-menu-items, .ast-theme-transparent-header div.ast-masthead-custom-menu-items .widget, .ast-theme-transparent-header div.ast-masthead-custom-menu-items .widget-title', 'color', 'transparent-primary-header' );
	// Primary Content Section link color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-link-color-responsive', '.ast-theme-transparent-header div.ast-masthead-custom-menu-items a, .ast-theme-transparent-header div.ast-masthead-custom-menu-items .widget a', 'color', 'transparent-primary-header' );
	// Primary Content Section link hover color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-link-h-color-responsive', '.ast-theme-transparent-header div.ast-masthead-custom-menu-items a:hover, .ast-theme-transparent-header div.ast-masthead-custom-menu-items .widget a:hover', 'color', 'transparent-primary-header' );



	// Above Header Menu
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-background-colors]', 'transparent-header-bg-color-responsive', '.ast-theme-transparent-header .ast-above-header-wrap .ast-above-header', 'background-color', 'transparent-above-header' );

	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-bg-color-responsive', '.ast-theme-transparent-header .ast-above-header-menu, .ast-theme-transparent-header.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation ul.ast-above-header-menu', 'background-color', 'transparent-above-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-color-responsive', '.ast-theme-transparent-header .ast-above-header-navigation a', 'color', 'transparent-above-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-h-color-responsive', '.ast-theme-transparent-header .ast-above-header-navigation li.current-menu-item > a,.ast-theme-transparent-header .ast-above-header-navigation li.current-menu-ancestor > a, .ast-theme-transparent-header .ast-above-header-navigation li:hover > a', 'color' )
	// Above Header SubMenu
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-bg-color-responsive', '.ast-theme-transparent-header .ast-above-header-menu .sub-menu', 'background-color', 'transparent-above-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-color-responsive', '.ast-theme-transparent-header .ast-above-header-menu .sub-menu, .ast-theme-transparent-header .ast-above-header-menu .sub-menu a', 'color', 'transparent-above-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-h-color-responsive', '.ast-theme-transparent-header .ast-above-header-menu .sub-menu li:hover > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li:focus > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.focus > a,.ast-theme-transparent-header .ast-above-header-menu .sub-menu li:hover > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li:focus > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.focus > .ast-menu-toggle,.ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor:hover > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor:focus > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor.focus > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item:hover > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item:focus > .ast-menu-toggle, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item.focus > .ast-menu-toggle,.ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item:hover > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item:focus > a, .ast-theme-transparent-header .ast-above-header-menu .sub-menu li.current-menu-item.focus > a', 'color', 'transparent-above-header' );

	// Above Header Content Section text color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-text-color-responsive', '.ast-theme-transparent-header .ast-above-header-section .user-select, .ast-theme-transparent-header .ast-above-header-section .widget, .ast-theme-transparent-header .ast-above-header-section .widget-title', 'color', 'transparent-above-header' );
	// Above Header Content Section link color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-link-color-responsive', '.ast-theme-transparent-header .ast-above-header-section .user-select a, .ast-theme-transparent-header .ast-above-header-section .widget a', 'color', 'transparent-above-header' );
	// Above Header Content Section link hover color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-link-h-color-responsive', '.ast-theme-transparent-header .ast-above-header-section .user-select a:hover, .ast-theme-transparent-header .ast-above-header-section .widget a:hover', 'color', 'transparent-above-header' );



	// below Header Menu
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-background-colors]', 'transparent-header-bg-color-responsive', '.ast-theme-transparent-header .ast-below-header-wrap .ast-below-header', 'background-color', 'transparent-below-header' );

	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-bg-color-responsive', '.ast-theme-transparent-header.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap, .ast-theme-transparent-header .ast-below-header-actual-nav, .ast-theme-transparent-header.ast-header-break-point .ast-below-header-actual-nav', 'background-color', 'transparent-below-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-color-responsive', '.ast-theme-transparent-header .ast-below-header-menu, .ast-theme-transparent-header .ast-below-header-menu a', 'color', 'transparent-below-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-menu-h-color-responsive', '.ast-theme-transparent-header .ast-below-header-menu li:hover > a, .ast-theme-transparent-header .ast-below-header-menu li:focus > a, .ast-theme-transparent-header .ast-below-header-menu li.focus > a,.ast-theme-transparent-header .ast-below-header-menu li.current-menu-ancestor > a, .ast-theme-transparent-header .ast-below-header-menu li.current-menu-item > a, .ast-theme-transparent-header .ast-below-header-menu li.current-menu-ancestor > .ast-menu-toggle, .ast-theme-transparent-header .ast-below-header-menu li.current-menu-item > .ast-menu-toggle, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item:hover > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item:focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item.focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor:hover > .ast-menu-toggle, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor:focus > .ast-menu-toggle, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor.focus > .ast-menu-toggle, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item:hover > .ast-menu-toggle, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item:focus > .ast-menu-toggle, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item.focus > .ast-menu-toggle', 'color', 'transparent-below-header' );
	// below Header SubMenu
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-bg-color-responsive', '.ast-theme-transparent-header .ast-below-header-menu .sub-menu', 'background-color', 'transparent-below-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-color-responsive', '.ast-theme-transparent-header .ast-below-header-menu .sub-menu, .ast-theme-transparent-header .ast-below-header-menu .sub-menu a', 'color', 'transparent-below-header' );
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-menu]', 'transparent-submenu-h-color-responsive', '.ast-theme-transparent-header .ast-below-header-menu .sub-menu li:hover > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li:focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.focus > a,.ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item:hover > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item:focus > a, .ast-theme-transparent-header .ast-below-header-menu .sub-menu li.current-menu-item.focus > a', 'color', 'transparent-below-header' );

	// below Header Content Section text color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-text-color-responsive', '.ast-theme-transparent-header .below-header-user-select, .ast-theme-transparent-header .below-header-user-select .widget,.ast-theme-transparent-header .below-header-user-select .widget-title', 'color', 'transparent-below-header' );
	// below Header Content Section link color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-link-color-responsive', '.ast-theme-transparent-header .below-header-user-select a, .ast-theme-transparent-header .below-header-user-select .widget a', 'color', 'transparent-below-header' );
	// below Header Content Section link hover color
	astra_apply_responsive_color_property( 'astra-settings[transparent-header-colors-content]', 'transparent-content-section-link-h-color-responsive', '.ast-theme-transparent-header .below-header-user-select a:hover, .ast-theme-transparent-header .below-header-user-select .widget a:hover', 'color', 'below-transparent-header' );



} )( jQuery );
