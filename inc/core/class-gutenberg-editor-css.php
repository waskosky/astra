<?php
/**
 * Gutenberg Editor CSS
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0
 */

if ( ! class_exists( 'Gutenberg_Editor_CSS' ) ) :

	/**
	 * Admin Helper
	 */
	class Gutenberg_Editor_CSS {

		/**
		 * Get dynamic CSS  required for the block editor to make editing experience similar to how it looks on frontend.
		 *
		 * @return String CSS to be loaded in the editor interface.
		 */
		public static function get_css() {
			$site_content_width          = astra_get_option( 'site-content-width', 1200 );
			$headings_font_family        = astra_get_option( 'headings-font-family' );
			$headings_font_weight        = astra_get_option( 'headings-font-weight' );
			$headings_text_transform     = astra_get_option( 'headings-text-transform' );
			$single_post_title_font_size = astra_get_option( 'font-size-entry-title' );
			$body_font_family            = astra_body_font_family();
			$para_margin_bottom          = astra_get_option( 'para-margin-bottom' );
			$body_font_weight            = astra_get_option( 'body-font-weight' );
			$body_font_size              = astra_get_option( 'font-size-body' );
			$body_line_height            = astra_get_option( 'body-line-height' );
			$body_text_transform         = astra_get_option( 'body-text-transform' );
			$box_bg_obj                  = astra_get_option( 'site-layout-outside-bg-obj' );
			$text_color                  = astra_get_option( 'text-color' );

			if ( is_array( $body_font_size ) ) {
				$body_font_size_desktop = ( isset( $body_font_size['desktop'] ) && '' != $body_font_size['desktop'] ) ? $body_font_size['desktop'] : 15;
			} else {
				$body_font_size_desktop = ( '' != $body_font_size ) ? $body_font_size : 15;
			}

			$css = '';

			$desktop_css = array(
				'html' => array(
					'font-size' => astra_get_font_css_value( (int) $body_font_size_desktop * 6.25, '%' ),
				),
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content' => astra_get_background_obj( $box_bg_obj ),
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-post-title__block,.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-default-block-appender,.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-block-list__block' => array(
					'max-width' => astra_get_css_value( $site_content_width + 40, 'px' ),
				),
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content .edit-post-visual-editor .editor-block-list__block[data-align=wide]' => array(
					'max-width' => astra_get_css_value( $site_content_width + 40 + 200, 'px' ),
				),
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-post-title__block textarea' => array(
					'font-size' => astra_responsive_font( $single_post_title_font_size, 'desktop' ),
				),
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-post-title__block textarea,  .gutenberg-editor-page #wpwrap .edit-post-layout__content h1, .gutenberg-editor-page #wpwrap .edit-post-layout__content h2, .gutenberg-editor-page #wpwrap .edit-post-layout__content h3, .gutenberg-editor-page #wpwrap .edit-post-layout__content h4, .gutenberg-editor-page #wpwrap .edit-post-layout__content h5, .gutenberg-editor-page #wpwrap .edit-post-layout__content h6' => array(
					'font-family'    => astra_get_css_value( $headings_font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $headings_font_weight, 'font' ),
					'text-transform' => esc_attr( $headings_text_transform ),
				),
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content p,.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-block-list__block p' => array(
					'font-family'    => astra_get_font_family( $body_font_family ),
					'font-weight'    => esc_attr( $body_font_weight ),
					'font-size'      => astra_responsive_font( $body_font_size, 'desktop' ),
					'line-height'    => esc_attr( $body_line_height ),
					'text-transform' => esc_attr( $body_text_transform ),
					'margin-bottom'  => astra_get_css_value( $para_margin_bottom, 'em' ),
				),
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content h1,.gutenberg-editor-page #wpwrap .edit-post-layout__content h2,.gutenberg-editor-page #wpwrap .edit-post-layout__content h3,.gutenberg-editor-page #wpwrap .edit-post-layout__content h4,.gutenberg-editor-page #wpwrap .edit-post-layout__content h5,.gutenberg-editor-page #wpwrap .edit-post-layout__content h6' => array(
					'color' => esc_attr( $text_color ),
				),
			);

			$css .= astra_parse_css( $desktop_css );

			$tablet_css = array(
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-post-title__block textarea' => array(
					'font-size' => astra_responsive_font( $single_post_title_font_size, 'tablet', 30 ),
				),
			);

			$css .= astra_parse_css( $tablet_css, '', '768' );

			$mobile_css = array(
				'.gutenberg-editor-page #wpwrap .edit-post-layout__content .editor-post-title__block textarea' => array(
					'font-size' => astra_responsive_font( $single_post_title_font_size, 'mobile', 30 ),
				),
			);

			$css .= astra_parse_css( $mobile_css, '', '768' );

			return $css;
		}

	}

endif;
