<?php
/**
 * Astra Updates
 *
 * Functions for updating data, used by the background updater.
 *
 * @package Astra
 * @version x.x.x
 */

defined( 'ABSPATH' ) || exit;

/**
 * Customizer Version 2 categorization database operations using batch processing
 *
 * @since x.x.x
 * @return void
 */
function astra_theme_update_v2_0_0_customizer_optimization() {

	$json = astra_theme_update_v2_0_0_new_controls();

	$json_array = json_decode( $json, true );

	foreach ( $json_array as $group => $sub_control ) {
		$new_options_data = group_item_operations( $group, $sub_control );
		control_data_update( $new_options_data );
	}
}

/**
 * Added a JSON object for changes in customizer version 2 database migration.
 *
 * @since x.x.x
 * @return array
 */
function astra_theme_update_v2_0_0_new_controls() {

	$json = '{"theme-button-color-group":["button-bg-h-color","button-bg-color","button-h-color","button-color"],"theme-button-border-group":["button-h-padding","button-v-padding","button-radius"],"primary-header-button-color-group":["header-main-rt-section-button-back-h-color","header-main-rt-section-button-back-color","header-main-rt-section-button-text-h-color","header-main-rt-section-button-text-color"],"primary-header-button-border-group":["header-main-rt-section-button-border-h-color","header-main-rt-section-button-border-color"],"transparent-header-button-color-group":["header-main-rt-trans-section-button-back-h-color","header-main-rt-trans-section-button-back-color","header-main-rt-trans-section-button-text-h-color","header-main-rt-trans-section-button-text-color"],"transparent-header-button-border-group":["header-main-rt-trans-section-button-border-h-color","header-main-rt-trans-section-button-border-color"],"footer-bar-content-group":["footer-link-h-color","footer-link-color","footer-color"],"footer-bar-background-group":"footer-bg-obj","footer-widget-content-group":["footer-adv-link-h-color","footer-adv-link-color","footer-adv-text-color","footer-adv-wgt-title-color"],"footer-widget-background-group":"footer-adv-bg-obj","blog-content-blog-post-title-typo":["text-transform-page-title","line-height-page-title","font-weight-page-title","font-family-page-title","font-size-page-title"],"blog-content-archive-summary-typo":["text-transform-archive-summary-title","line-height-archive-summary-title","font-weight-archive-summary-title","font-family-archive-summary-title","font-size-archive-summary-title"],"site-title-typography":["line-height-site-title","text-transform-site-title","font-weight-site-title","font-family-site-title","font-size-site-title"],"site-tagline-typography":["line-height-site-tagline","text-transform-site-tagline","font-weight-site-tagline","font-family-site-tagline","font-size-site-tagline"],"blog-single-title-typo":["text-transform-entry-title","line-height-entry-title","font-weight-entry-title","font-family-entry-title","font-size-entry-title"],"transparent-header-background-colors":"transparent-header-bg-color-responsive","transparent-header-colors":["transparent-header-color-h-site-title-responsive","transparent-header-color-site-title-responsive"],"transparent-header-colors-menu":["transparent-submenu-h-color-responsive","transparent-submenu-bg-color-responsive","transparent-submenu-color-responsive","transparent-header-colors-submenu-divider","transparent-header-colors-submenu-divider","transparent-menu-h-color-responsive","transparent-menu-bg-color-responsive","transparent-menu-color-responsive","transparent-header-colors-menu-divider","transparent-header-colors-menu-divider"],"transparent-header-colors-content":["transparent-content-section-link-h-color-responsive","transparent-content-section-link-color-responsive","transparent-content-section-text-color-responsive"],"section-breadcrumb-color":["breadcrumb-bg-color","breadcrumb-separator-color","breadcrumb-hover-color-responsive","breadcrumb-text-color-responsive","breadcrumb-active-color-responsive"],"section-breadcrumb-typo":["breadcrumb-line-height","breadcrumb-font-size","breadcrumb-text-transform","breadcrumb-font-weight","breadcrumb-font-family"],"blog-content-color-group":["post-meta-link-h-color","post-meta-link-color","post-meta-color","page-title-color","archive-summary-box-text-color","archive-summary-box-title-color","archive-summary-box-bg-color","divider-blog-archive"],"primary-header-background-group":"header-bg-obj-responsive","primary-menu-colors":["primary-submenu-a-bg-color-responsive","primary-submenu-a-color-responsive","primary-header-color-bg-submenu-divider-active","primary-menu-a-bg-color-responsive","primary-menu-a-color-responsive","primary-header-color-bg-menu-divider-active","primary-submenu-h-bg-color-responsive","primary-submenu-h-color-responsive","primary-header-color-bg-submenu-divider-hover","primary-menu-h-bg-color-responsive","primary-menu-h-color-responsive","primary-header-color-bg-menu-divider-hover","primary-submenu-bg-color-responsive","primary-submenu-color-responsive","primary-header-color-bg-submenu-divider-normal","primary-menu-bg-obj-responsive","primary-menu-color-responsive","primary-header-color-bg-menu-divider-normal"],"sidebar-background-group":"sidebar-bg-obj","sidebar-content-group":["sidebar-link-h-color","sidebar-link-color","sidebar-text-color","sidebar-widget-title-color"],"footer-widget-title-typography-group":["footer-adv-wgt-title-line-height","footer-adv-wgt-title-font-size","footer-adv-wgt-title-text-transform","footer-adv-wgt-title-font-weight","footer-adv-wgt-title-font-family"],"footer-widget-content-typography-group":["footer-adv-wgt-content-line-height","footer-adv-wgt-content-font-size","footer-adv-wgt-content-text-transform","footer-adv-wgt-content-font-weight","footer-adv-wgt-content-font-family"],"below-header-menus-group":["below-header-submenu-active-bg-color-responsive","below-header-submenu-active-color-responsive","below-header-submenu-bg-hover-color-responsive","below-header-submenu-hover-color-responsive","below-header-submenu-bg-color-responsive","below-header-submenu-text-color-responsive","below-header-current-menu-bg-color-responsive","below-header-current-menu-text-color-responsive","below-header-menu-bg-hover-color-responsive","below-header-menu-text-hover-color-responsive","below-header-menu-bg-obj-responsive","below-header-menu-text-color-responsive","below-header-primary-sub-menu-active-color-label-divider","below-header-primary-menu-active-color-label-divider","below-header-primary-sub-menu-hover-color-label-divider","below-header-primary-menu-hover-color-label-divider","below-header-primary-sub-menu-normal-color-label-divider","below-header-primary-menu-normal-color-label-divider"],"above-header-typography-menu-styling":["above-header-text-transform","above-header-font-size","above-header-font-weight","above-header-font-family"],"above-header-typography-submenu-styling":["text-transform-above-header-dropdown-menu","font-size-above-header-dropdown-menu","font-weight-above-header-dropdown-menu","font-family-above-header-dropdown-menu"],"below-header-menu-typography-styling":["text-transform-below-header-primary-menu","font-size-below-header-primary-menu","font-weight-below-header-primary-menu","font-family-below-header-primary-menu"],"below-header-submenu-typography-styling":["text-transform-below-header-dropdown-menu","font-size-below-header-dropdown-menu","font-weight-below-header-dropdown-menu","font-family-below-header-dropdown-menu"],"below-header-content-typography-styling":["text-transform-below-header-content","font-size-below-header-content","font-weight-below-header-content","font-family-below-header-content"],"above-header-background-styling":"above-header-bg-obj-responsive","above-header-menu-colors":["above-header-submenu-active-bg-color-responsive","above-header-submenu-active-color-responsive","above-header-color-bg-dropdown-submenu-divider-active","above-header-menu-active-bg-color-responsive","above-header-menu-active-color-responsive","above-header-color-bg-dropdown-menu-divider-active","above-header-submenu-bg-hover-color-responsive","above-header-submenu-hover-color-responsive","above-header-color-bg-dropdown-menu-divider-hover","above-header-menu-h-bg-color-responsive","above-header-menu-h-color-responsive","above-header-color-bg-dropdown-menu-h-divider-hover","above-header-submenu-bg-color-responsive","above-header-submenu-text-color-responsive","above-header-color-bg-dropdown-menu-divider","above-header-menu-bg-obj-responsive","above-header-menu-color-responsive","above-header-color-bg-menu-divider-normal"],"above-header-content-section-styling":["above-header-link-h-color-responsive","above-header-link-color-responsive","above-header-text-color-responsive"],"below-header-background-group":"below-header-bg-obj-responsive","below-header-content-group":["below-header-link-hover-color-responsive","below-header-link-color-responsive","below-header-text-color-responsive"],"learndash-color-group":["learndash-incomplete-icon-color","learndash-complete-icon-color","learndash-table-title-separator-color","learndash-table-title-bg-color","learndash-table-title-color","learndash-table-heading-bg-color","learndash-table-heading-color"],"learndash-header-typography-group":["font-size-learndash-table-heading","text-transform-learndash-table-heading","font-weight-learndash-table-heading","font-family-learndash-table-heading"],"learndash-content-typography-group":["font-size-learndash-table-content","text-transform-learndash-table-content","font-weight-learndash-table-content","font-family-learndash-table-content"],"sticky-header-above-menus-colors":["sticky-above-header-megamenu-heading-h-color","sticky-above-header-megamenu-heading-color","sticky-above-header-submenu-h-a-bg-color-responsive","sticky-above-header-submenu-h-color-responsive","sticky-above-header-submenu-color-responsive","sticky-above-header-submenu-bg-color-responsive","sticky-above-header-menu-h-a-bg-color-responsive","sticky-above-header-menu-h-color-responsive","sticky-above-header-menu-color-responsive","sticky-above-header-menu-bg-color-responsive","sticky-header-above-megamenu-col-hover-color-label-divider","sticky-header-above-sub-menu-hover-color-label-divider","sticky-header-above-menu-hover-color-label-divider","sticky-header-above-megamenu-col-normal-color-label-divider","sticky-header-above-sub-menu-normal-color-label-divider","sticky-header-above-menu-normal-color-label-divider"],"sticky-header-primary-menus-colors":["sticky-primary-header-megamenu-heading-h-color","sticky-primary-header-megamenu-heading-color","sticky-header-submenu-h-a-bg-color-responsive","sticky-header-submenu-h-color-responsive","sticky-header-submenu-color-responsive","sticky-header-submenu-bg-color-responsive","sticky-header-menu-h-a-bg-color-responsive","sticky-header-menu-h-color-responsive","sticky-header-menu-color-responsive","sticky-header-menu-bg-color-responsive","sticky-header-primary-megamenu-col-hover-color-label-divider","sticky-header-primary-sub-menu-hover-color-label-divider","sticky-header-primary-menu-hover-color-label-divider","sticky-header-primary-megamenu-col-normal-color-label-divider","sticky-header-primary-sub-menu-normal-color-label-divider","sticky-header-primary-menu-normal-color-label-divider"],"sticky-header-below-menus-colors":["sticky-below-header-megamenu-heading-h-color","sticky-below-header-megamenu-heading-color","sticky-below-header-submenu-h-a-bg-color-responsive","sticky-below-header-submenu-h-color-responsive","sticky-below-header-submenu-color-responsive","sticky-below-header-submenu-bg-color-responsive","sticky-below-header-menu-h-a-bg-color-responsive","sticky-below-header-menu-h-color-responsive","sticky-below-header-menu-color-responsive","sticky-below-header-menu-bg-color-responsive","sticky-header-below-megamenu-col-hover-color-label-divider","sticky-header-below-sub-menu-hover-color-label-divider","sticky-header-below-menu-hover-color-label-divider","sticky-header-below-megamenu-col-normal-color-label-divider","sticky-header-below-sub-menu-normal-color-label-divider","sticky-header-below-menu-normal-color-label-divider"],"sticky-header-button-color-group":["header-main-rt-sticky-section-button-back-h-color","header-main-rt-sticky-section-button-back-color","header-main-rt-sticky-section-button-text-h-color","header-main-rt-sticky-section-button-text-color"],"sticky-header-button-border-group":["header-main-rt-sticky-section-button-border-h-color","header-main-rt-sticky-section-button-border-color"],"sticky-header-primary-header-colors":["sticky-header-color-site-tagline-responsive","sticky-header-color-h-site-title-responsive","sticky-header-color-site-title-responsive","sticky-header-bg-color-responsive"],"sticky-header-primary-outside-item-colors":["sticky-header-content-section-link-h-color-responsive","sticky-header-content-section-link-color-responsive","sticky-header-content-section-text-color-responsive"],"sticky-header-above-header-colors":"sticky-above-header-bg-color-responsive","sticky-header-above-outside-item-colors":["sticky-above-header-content-section-link-h-color-responsive","sticky-above-header-content-section-link-color-responsive","sticky-above-header-content-section-text-color-responsive"],"sticky-header-below-header-colors":"sticky-below-header-bg-color-responsive","scroll-on-top-color-group":["scroll-to-top-icon-h-bg-color","scroll-to-top-icon-h-color","scroll-to-top-icon-bg-color","scroll-to-top-icon-color"],"blog-content-post-meta-typo":["text-transform-post-meta","line-height-post-meta","font-size-post-meta","font-weight-post-meta","font-family-post-meta"],"blog-content-pagination-typo":["font-size-post-pagination","text-transform-post-pagination"],"button-text-typography":["font-size-button","text-transform-button","font-weight-button","font-family-button"],"footer-bar-typography-group":["line-height-footer-content","font-size-footer-content","text-transform-footer-content","font-weight-footer-content","font-family-footer-content"],"site-identity-typography":["header-main-menu-label-divider","header-main-menu-label-divider"],"primary-header-menu-typography":["line-height-primary-menu","font-size-primary-menu","text-transform-primary-menu","font-weight-primary-menu","font-family-primary-menu"],"primary-sub-menu-typography":["line-height-primary-dropdown-menu","font-size-primary-dropdown-menu","text-transform-primary-dropdown-menu","font-weight-primary-dropdown-menu","font-family-primary-dropdown-menu"],"sidebar-title-typography-group":["line-height-widget-title","font-size-widget-title","text-transform-widget-title","font-weight-widget-title","font-family-widget-title"],"sidebar-content-typography-group":["line-height-widget-content","font-size-widget-content","text-transform-widget-content","font-weight-widget-content","font-family-widget-content"],"single-product-title-group":["line-height-product-title","font-size-product-title","text-transform-product-title","font-weight-product-title","font-family-product-title"],"single-product-price-group":["line-height-product-price","font-size-product-price","font-weight-product-price","font-family-product-price"],"single-product-breadcrumb-group":["line-height-product-breadcrumb","font-size-product-breadcrumb","text-transform-product-breadcrumb","font-weight-product-breadcrumb","font-family-product-breadcrumb"],"single-product-content-group":["line-height-product-content","font-size-product-content","text-transform-product-content","font-weight-product-content","font-family-product-content"],"woo-single-page-color-group":["single-product-breadcrumb-color","single-product-content-color","single-product-price-color","single-product-title-color"],"shop-product-title-group":["line-height-shop-product-title","font-size-shop-product-title","text-transform-shop-product-title","font-weight-shop-product-title","font-family-shop-product-title"],"shop-product-price-group":["line-height-shop-product-price","font-size-shop-product-price","font-weight-shop-product-price","font-family-shop-product-price"],"shop-product-content-group":["line-height-shop-product-content","font-size-shop-product-content","text-transform-shop-product-content","font-weight-shop-product-content","font-family-shop-product-content"],"shop-color-group":["shop-product-content-color","shop-product-price-color","shop-product-title-color"],"edd-single-product-title-typo":["text-transform-edd-product-title","line-height-edd-product-title","font-size-edd-product-title","font-weight-edd-product-itle]","font-family-edd-product-title"],"edd-single-product-content-typo":["text-transform-edd-product-content","line-height-edd-product-content","font-size-edd-product-content","font-weight-edd-product-content","font-family-edd-product-content"],"edd-single-product-colors":["edd-single-product-navigation-color","edd-single-product-content-color","edd-single-product-title-color"],"edd-archive-product-title-typo":["text-transform-edd-archive-product-title","line-height-edd-archive-product-title","font-size-edd-archive-product-title","font-weight-edd-archive-product-title","font-family-edd-archive-product-title"],"edd-archive-product-price-typo":["line-height-edd-archive-product-price","font-size-edd-archive-product-price","font-weight-edd-archive-product-price","font-family-edd-archive-product-price"],"edd-archive-product-content-typo":["text-transform-edd-archive-product-content","line-height-edd-archive-product-content","font-size-edd-archive-product-content","font-weight-edd-archive-product-content","font-family-edd-archive-product-content"],"edd-archive-colors":["edd-archive-product-content-color","edd-archive-product-price-color","edd-archive-product-title-color"],"primary-mega-menu-col-color-group":["primary-header-megamenu-heading-h-color","primary-header-megamenu-heading-color"],"primary-mega-menu-col-typography":["primary-header-megamenu-heading-text-transform","primary-header-megamenu-heading-font-size","primary-header-megamenu-heading-font-weight","primary-header-megamenu-heading-font-family"],"above-header-megamenu-colors":["above-header-megamenu-heading-h-color","above-header-megamenu-heading-color"],"above-header-typography-megamenu-styling":["above-header-megamenu-heading-text-transform","above-header-megamenu-heading-font-size","above-header-megamenu-heading-font-weight","above-header-megamenu-heading-font-family"],"below-header-megamenu-group":["below-header-megamenu-heading-h-color","below-header-megamenu-heading-color"],"below-header-megamenu-typography-styling":["below-header-megamenu-heading-text-transform","below-header-megamenu-heading-font-size","below-header-megamenu-heading-font-weight","below-header-megamenu-heading-font-family"]}';

	return $json;
}

/**
 * Update individual control item values in database.
 *
 * @since x.x.x
 *
 * @param array $new_options New options data.
 * @return void
 */
function control_data_update( $new_options ) {

	$theme_options = get_option( 'astra-settings', array() );

	$theme_options = array_merge( $theme_options, $new_options );

	update_option( 'astra-settings', $theme_options );
}

/**
 * Perform database operations on indivitual group controls
 *
 * @since x.x.x
 *
 * @param string $group Queue item.
 * @return array
 */
function group_item_operations( $group, $sub_control ) {

	$theme_options = get_option( 'astra-settings', array() );

	$new_options = array();

	$json = astra_theme_update_v2_0_0_new_controls();

	// Check if group key exists in the theme options.
	if ( array_key_exists( $group, $theme_options ) ) {
		return $new_options;
	}

	// Check if sub_control key exists in the theme options.
	if ( is_array( $sub_control ) ) {

		foreach ( $sub_control as $key => $value ) {

			// Check if sub_control key exists in the theme options.
			if ( array_key_exists( $value, $theme_options ) ) {
				$new_value = $theme_options[ $value ];

				$new_options[ $group ][ $value ] = $new_value;
			}
		}
		if ( array_key_exists( $group, $new_options ) ) {
			$new_options[ $group ] = json_encode( $new_options[ $group ] );
		}
	} else {
		// Check if sub_control key exists in the theme options.
		if ( array_key_exists( $sub_control, $theme_options ) ) {
			$new_value                             = $theme_options[ $sub_control ];
			$new_options[ $group ][ $sub_control ] = $new_value;
		}
	}

	return $new_options;
}

