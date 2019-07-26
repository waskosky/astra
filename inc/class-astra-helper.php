<?php
/**
 * Astra Helper.
 *
 * @package Astra
 */

if ( ! class_exists( 'Astra_Helper' ) ) {
	/**
	 * Class Astra_Helper.
	 */
	class Astra_Helper {

		/**
		 * Get fonts to generate.
		 *
		 * @since 1.0.0
		 * @var array $fonts
		 */
		static private $css = array();

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 999 );
		}

		/**
		 * Enqueue CSS files.
		 *
		 * @since x.x.x
		 * @return bool
		 */
		function enqueue_scripts() {

			$post_id   = get_the_ID();
			$date      = new DateTime();
			$timestamp = $date->getTimestamp();

			if ( ! $post_id ) {
				return;
			}

			$css_data = apply_filters( 'astra_dynamic_css', '' );

			$this->file_write( $css_data, $post_id, $timestamp );

			$uploads_dir     = $this->get_upload_dir();
			$uploads_dir_url = $uploads_dir['url'];

			wp_enqueue_style( 'astra-dynamic', $uploads_dir_url . 'astra-dynamic-css-' . $post_id . '-' . $timestamp . '.css' );
		}

		/**
		 * Checks to see if the site has SSL enabled or not.
		 *
		 * @since x.x.x
		 * @return bool
		 */
		public function is_ssl() {
			if ( is_ssl() ) {
				return true;
			} elseif ( 0 === stripos( get_option( 'siteurl' ), 'https://' ) ) {
				return true;
			} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' == $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
				return true;
			}
			return false;
		}

		/**
		 * Returns an array of paths for the upload directory
		 * of the current site.
		 *
		 * @since x.x.x
		 * @return array
		 */
		public function get_upload_dir() {
			$wp_info  = wp_upload_dir( null, false );
			$dir_name = basename( ASTRA_THEME_DIR );
			if ( 'astra' == $dir_name ) {
				$dir_name = 'astra';
			}
			// SSL workaround.
			if ( $this->is_ssl() ) {
				$wp_info['baseurl'] = str_ireplace( 'http://', 'https://', $wp_info['baseurl'] );
			}
			// Build the paths.
			$dir_info = array(
				'path' => $wp_info['basedir'] . '/' . $dir_name . '/',
				'url'  => $wp_info['baseurl'] . '/' . $dir_name . '/',
			);
			// Create the upload dir if it doesn't exist.
			if ( ! file_exists( $dir_info['path'] ) ) {
				// Create the directory.
				mkdir( $dir_info['path'] );
				// Add an index file for security.
				file_put_contents( $dir_info['path'] . 'index.html', '' );
			}
			return apply_filters( 'astra_get_upload_dir', $dir_info );
		}

		/**
		 * Returns an array of paths for the CSS assets
		 * of the current post.
		 *
		 * @param  var    $data            Gets the CSS for the current Page.
		 * @param  string $post_id      Gets the current post ID.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @since x.x.x
		 * @return array
		 */
		public function get_asset_info( $data, $post_id, $timestamp ) {
			$uploads_dir = $this->get_upload_dir();
			$css_suffix  = 'astra-dynamic-css';
			$info        = array();
			if ( ! empty( $data ) ) {
				$info['css']     = $uploads_dir['path'] . $css_suffix . '-' . $post_id . '-' . $timestamp . '.css';
				$info['css_url'] = $uploads_dir['url'] . $css_suffix . '-' . $post_id . '-' . $timestamp . '.css';
			}
			return $info;
		}

		/**
		 * Creates CSS files.
		 *
		 * @param  string $style_data   Gets the CSS for the current Page.
		 * @param  string $post_id      Gets the current post ID.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @since  x.x.x
		 */
		public function file_write( $style_data, $post_id, $timestamp ) {
			$post_timestamp = get_post_meta( get_the_ID(), 'astra_style_timestamp-' . 'css', true );

			// File not created yet.
			$assets_info = $this->get_asset_info( $style_data, $post_id, $timestamp );

			// Create a new file.
			$handle = fopen( $assets_info['css'], 'a' );
			file_put_contents( $assets_info['css'], $style_data );
			fclose( $handle );

			// Update the post meta.
			update_post_meta( get_the_ID(), 'astra_style_timestamp-' . 'css', $timestamp );
		}

	}

	new Astra_Helper;
}
