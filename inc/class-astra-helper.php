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
			add_action( 'wp_enqueue_scripts', array( $this, 'theme_enqueue_scripts' ), 1 );
			if ( defined( 'ASTRA_EXT_FILE' ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'addon_enqueue_scripts' ), 999 );
			}
		}

		/**
		 * Enqueue theme CSS files.
		 *
		 * @since x.x.x
		 * @return bool
		 */
		public function theme_enqueue_scripts() {

			$post_id   = $this->get_post_id();
			$timestamp = $this->get_timestamp();

			if ( ! $post_id ) {
				return;
			}

			$theme_css_data = apply_filters( 'astra_theme_dynamic_css', '' );

			if ( empty( $theme_css_data ) ) {
				return;
			}

			if ( ! empty( $theme_css_data ) ) {
				$this->file_write( $theme_css_data, $post_id, $timestamp, 'theme' );
			}

			$uploads_dir     = $this->get_upload_dir();
			$uploads_dir_url = $uploads_dir['url'];

			wp_enqueue_style( 'astra-theme-dynamic', $uploads_dir_url . 'astra-theme-dynamic-css-' . $post_id . '.css', array(), $timestamp );
		}

		/**
		 * Enqueue Addon CSS files.
		 *
		 * @since x.x.x
		 * @return bool
		 */
		public function addon_enqueue_scripts() {

			$post_id   = $this->get_post_id();
			$timestamp = $this->get_timestamp();

			if ( ! $post_id ) {
				return;
			}

			$addon_css_data = apply_filters( 'astra_dynamic_css', '' );

			if ( ! empty( $addon_css_data ) ) {
				$this->file_write( $addon_css_data, $post_id, $timestamp, 'addon' );
			}

			$uploads_dir     = $this->get_upload_dir();
			$uploads_dir_url = $uploads_dir['url'];

			wp_enqueue_style( 'astra-addon-dynamic', $uploads_dir_url . 'astra-addon-dynamic-css-' . $post_id . '.css', array(), $timestamp );
		}

		/**
		 * Gets the current post id.
		 *
		 * @since x.x.x
		 * @return string $post_id Post ID.
		 */
		public function get_post_id() {
			$post_id = get_the_ID();
			return $post_id;
		}

		/**
		 * Gets the current timestamp.
		 *
		 * @since x.x.x
		 * @return string $timestamp Timestamp.
		 */
		public function get_timestamp() {
			$date      = new DateTime();
			$timestamp = $date->getTimestamp();

			return $timestamp;
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
		 * @param  var    $data         Gets the CSS for the current Page.
		 * @param  string $post_id      Gets the current post ID.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @param  string $type         Gets the type theme/addon.
		 * @since x.x.x
		 * @return array
		 */
		public function get_asset_info( $data, $post_id, $timestamp, $type ) {

			$uploads_dir = $this->get_upload_dir();
			$css_suffix  = 'astra-' . $type . '-dynamic-css';
			$css_suffix  = 'astra-' . $type . '-dynamic-css';
			$info        = array();
			if ( ! empty( $data ) ) {
				$info['css']     = $uploads_dir['path'] . $css_suffix . '-' . $post_id . '.css';
				$info['css_url'] = $uploads_dir['url'] . $css_suffix . '-' . $post_id . '.css';
			}
			return $info;
		}

		/**
		 * Creates CSS files.
		 *
		 * @param  string $style_data   Gets the CSS for the current Page.
		 * @param  string $post_id      Gets the current post ID.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @param  string $type         Gets the type theme/addon.
		 * @since  x.x.x
		 */
		public function file_write( $style_data, $post_id, $timestamp, $type ) {

			$post_timestamp = get_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', true );

			if ( false == $post_timestamp || '' == $post_timestamp ) {
				return;
			}

			// File not created yet.
			$assets_info = $this->get_asset_info( $style_data, $post_id, $timestamp, $type );

			// Create a new file.
			$handle = fopen( $assets_info['css'], 'a' );
			file_put_contents( $assets_info['css'], $style_data );
			fclose( $handle );

			// Update the post meta.
			update_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', $timestamp );
		}

	}

	new Astra_Helper;
}
