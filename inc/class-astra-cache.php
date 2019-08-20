<?php
/**
 * Astra Helper.
 *
 * @package Astra
 */

if ( ! class_exists( 'Astra_Cache' ) ) {


	/**
	 * Class Astra_Cache.
	 */
	class Astra_Cache extends Astra_Filesystem {

		/**
		 * Member Variable
		 *
		 * @var array instance
		 */
		private static $dynamic_css_file_path = array();

		/**
		 * Member Variable
		 *
		 * @var string instance
		 */
		private static $dynamic_css_data;

		/**
		 *  Constructor
		 */
		public function __construct() {

			parent::__construct();

			if ( ! function_exists( 'WP_Filesystem' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
			}

			WP_Filesystem();

			add_action( 'wp_enqueue_scripts', array( $this, 'add_to_dynamic_css_file' ), 1 );
			add_action( 'wp_enqueue_scripts', array( $this, 'theme_enqueue_styles' ), 1 );

			add_action( 'astra_post_meta_updated', array( $this, 'refresh_post_meta_data' ), 10, 1 );
			add_action( 'astra_advanced_headers_save_after', array( $this, 'astra_refresh_assets' ) );

			// Refresh assets.
			add_action( 'customize_save_after', array( $this, 'astra_refresh_assets' ) );

			// Triggers on click on refresh/ recheck button.
			add_action( 'wp_ajax_astra_refresh_assets_files', array( $this, 'astra_ajax_refresh_assets' ) );
		}

		/**
		 * Create an array of all the files that needs to be merged in dynamic CSS file.
		 *
		 * @since x.x.x
		 * @param array $file file path.
		 * @return void
		 */
		public static function add_dynamic_theme_css( $file ) {
			self::$dynamic_css_file_path = array_merge( self::$dynamic_css_file_path, $file );
		}

		/**
		 * Append CSS style to the theme dynamic css.
		 *
		 * @since x.x.x
		 * @param array $file file path.
		 * @return void
		 */
		public function add_to_dynamic_css_file( $file ) {

			foreach ( self::$dynamic_css_file_path as $key => $value ) {
				// Get file contents.
				$get_contents = parent::astra_get_contents( $value );
				if ( $get_contents ) {
					self::$dynamic_css_data .= $get_contents;
				}
			}
		}

		/**
		 * Refresh Assets, called through ajax
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function astra_ajax_refresh_assets() {

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			check_ajax_referer( 'astra-assets-refresh', 'nonce' );

			astra_delete_option( 'file-write-access' );

			$this->delete_cache_files();
		}

		/**
		 * Refresh Assets
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function astra_refresh_assets() {

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			astra_delete_option( 'file-write-access' );

			$this->delete_cache_files();
		}

		/**
		 * Deletes cache files
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function delete_cache_files() {

			$uploads_dir      = parent::get_uploads_dir();
			$uploads_dir_path = $uploads_dir['path'];

			array_map( 'unlink', glob( $uploads_dir_path . '/astra-theme-dynamic-css*.*' ) );
			array_map( 'unlink', glob( $uploads_dir_path . '/astra-addon-dynamic-css*.*' ) );
		}

		/**
		 * Remove post meta that check if CSS file need to be regenerated.
		 *
		 * @param int $post_id Gets the post id.
		 * @since x.x.x
		 * @return void
		 */
		public function refresh_post_meta_data( $post_id ) {
			delete_post_meta( $post_id, 'astra_theme_style_timestamp_css' );
		}

		/**
		 * Fetch theme CSS data to be added in the dynamic CSS file.
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function theme_enqueue_styles() {

			$theme_css_data  = apply_filters( 'astra_dynamic_theme_css', '' );
			$theme_css_data .= self::$dynamic_css_data;

			// Return if there is no data to add in the css file.
			if ( empty( $theme_css_data ) ) {
				return;
			}

			// Call enqueue styles function.
			$this->enqueue_styles( $theme_css_data, 'theme' );
		}

		/**
		 * Enqueue CSS files.
		 *
		 * @param  string $style_data   Gets the CSS data.
		 * @param  string $type         Gets the type theme/addon.
		 * @since  x.x.x
		 * @return void
		 */
		public function enqueue_styles( $style_data, $type ) {

			$archive_title = astra_get_archive_title();

			// Returns false if the current page is a post.
			if ( false === $archive_title ) {
				$slug = get_the_ID();
			} else {
				$slug = $archive_title;
			}

			// Gets the file path.
			$assets_info = $this->get_asset_info( $style_data, $slug, $type );

			// Gets the timestamp.
			$post_timestamp = $this->get_post_timestamp( $archive_title, $type, $assets_info );

			// Gets the uploads folder directory.
			$uploads_dir = parent::get_uploads_dir();

			// Check if the uploads folder has write access.
			$write_access = astra_get_option( 'file-write-access', true );

			// Check if we need to show the dynamic CSS inline.
			$load_inline_css = apply_filters( 'astra_load_dynamic_css_inline', false );

			// Check if we need to create a new file or override the current file.
			if ( ! empty( $style_data ) && $post_timestamp['create_new_file'] ) {
				$this->file_write( $style_data, $archive_title, $post_timestamp['timestamp'], $type, $assets_info );
			}

			// Add inline CSS if there is no write access or user has returned true using the `astra_load_dynamic_css_inline` filter.
			if ( ! $write_access || $load_inline_css ) {
				wp_add_inline_style( 'astra-' . $type . '-css', $style_data );
			} else {
				wp_enqueue_style( 'astra-' . $type . '-dynamic', $uploads_dir['url'] . 'astra-' . $type . '-dynamic-css-' . $slug . '.css', array(), $post_timestamp['timestamp'] );
			}
		}

		/**
		 * Returns the current Post Meta/ Option Timestamp.
		 *
		 * @since  x.x.x
		 * @param  string $archive_title         Gets the taxonomay name.
		 * @param  string $type         Gets the type theme/addon.
		 * @param  string $assets_info  Gets the assets path info.
		 * @return array $timestamp_data.
		 */
		public function get_post_timestamp( $archive_title, $type, $assets_info ) {

			// Check if current page is a post/ archive page. false states that the current page is a post.
			if ( false === $archive_title ) {
				$post_timestamp = get_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', true );
			} else {
				$post_timestamp = get_option( 'astra_' . $type . '_get_dynamic_css' );
			}

			$timestamp_data = $this->maybe_get_new_timestamp( $post_timestamp, $assets_info );

			return $timestamp_data;
		}

		/**
		 * Returns the current Post Meta/ Option Timestamp or creates a new timestamp.
		 *
		 * @since  x.x.x
		 * @param  string $post_timestamp Timestamp of the post meta/ option.
		 * @param  string $assets_info  Gets the assets path info.
		 * @return array $data.
		 */
		public function maybe_get_new_timestamp( $post_timestamp, $assets_info ) {

			// Creates a new timestamp if the file does not exists or the timestamp is empty.
			// If post_timestamp is empty that means it is an new post or the post is updated and a new file needs to be created.
			// If a file does not exists then we need to create a new file.
			if ( '' == $post_timestamp || ! file_exists( $assets_info['path'] ) ) {
				$timestamp = astra_get_current_timestamp();

				$data = array(
					'create_new_file' => true,
					'timestamp'       => $timestamp,
				);
			} else {
				$timestamp = $post_timestamp;
				$data      = array(
					'create_new_file' => false,
					'timestamp'       => $timestamp,
				);
			}

			return $data;
		}

		/**
		 * Returns an array of paths for the CSS assets
		 * of the current post.
		 *
		 * @param  var    $data         Gets the CSS for the current Page.
		 * @param  string $slug         Gets the current post ID/taxonomy name.
		 * @param  string $type         Gets the type theme/addon.
		 * @since x.x.x
		 * @return array
		 */
		public function get_asset_info( $data, $slug, $type ) {

			$uploads_dir = parent::get_uploads_dir();
			$css_suffix  = 'astra-' . $type . '-dynamic-css';
			$css_suffix  = 'astra-' . $type . '-dynamic-css';
			$info        = array();
			if ( ! empty( $data ) ) {
				$info['path']    = $uploads_dir['path'] . $css_suffix . '-' . $slug . '.css';
				$info['css_url'] = $uploads_dir['url'] . $css_suffix . '-' . $slug . '.css';
			}
			return $info;
		}

		/**
		 * Updates the Post Meta/ Option Timestamp.
		 *
		 * @param  string $archive_title         Gets the taxonomay name.
		 * @param  string $type         Gets the type theme/addon.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @since  x.x.x
		 * @return void
		 */
		public function update_timestamp( $archive_title, $type, $timestamp ) {

			// Check if current page is a post/ archive page. false states that the current page is a post.
			if ( false === $archive_title ) {
				// Update the post meta.
				update_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', $timestamp );
			} else {
				// Update the option.
				update_option( 'astra_' . $type . '_get_dynamic_css', $timestamp );
			}
		}

		/**
		 * Creates CSS files.
		 *
		 * @param  string $style_data   Gets the CSS for the current Page.
		 * @param  string $archive_title         Gets the archive title.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @param  string $type         Gets the type theme/addon.
		 * @param  string $assets_info  Gets the assets path info.
		 * @since  x.x.x
		 */
		public function file_write( $style_data, $archive_title, $timestamp, $type, $assets_info ) {

			// Create a new file.
			$put_contents = parent::astra_put_contents( $assets_info['path'], $style_data );

			// Adds an option as if the uploads folder has file rights access.
			astra_update_option( 'file-write-access', $put_contents );

			// This function will update the Post/ Option timestamp.
			$this->update_timestamp( $archive_title, $type, $timestamp );
		}
	}

	new Astra_Cache;
}
