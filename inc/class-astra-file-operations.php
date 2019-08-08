<?php
/**
 * Astra Helper.
 *
 * @package Astra
 */

if ( ! class_exists( 'Astra_File_Operations' ) ) {


	/**
	 * Class Astra_File_Operations.
	 */
	class Astra_File_Operations {

		/**
		 *  Constructor
		 */
		public function __construct() {

		}

		/**
		 * Checks to see if the site has SSL enabled or not.
		 *
		 * @since x.x.x
		 * @return bool
		 */
		public function astra_is_ssl() {
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
		public function get_uploads_dir() {

			global $wp_filesystem;

			$wp_info  = wp_upload_dir( null, false );
			$dir_name = basename( ASTRA_THEME_DIR );
			if ( 'astra' == $dir_name ) {
				$dir_name = 'astra';
			}
			// SSL workaround.
			if ( $this->astra_is_ssl() ) {
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
				$wp_filesystem->mkdir( $dir_info['path'] );
				// Add an index file for security.
				$wp_filesystem->put_contents( $dir_info['path'] . 'index.php', '' );

			}
			return apply_filters( 'astra_get_assets_uploads_dir', $dir_info );
		}

		/**
		 * Adds contents to the file.
		 *
		 * @param  string $file_path  Gets the assets path info.
		 * @param  string $style_data   Gets the CSS data.
		 * @since  x.x.x
		 * @return bool $put_content returns false if file write is not successful.
		 */
		public function astra_put_contents( $file_path, $style_data ) {

			global $wp_filesystem;

			// Create a new file.
			$put_contents = $wp_filesystem->put_contents( $file_path, $style_data );

			return $put_contents;
		}

		/**
		 * Get contents of the file.
		 *
		 * @param  string $file_path  Gets the assets path info.
		 * @since  x.x.x
		 * @return bool $get_contents Gets te file contents.
		 */
		public function astra_get_contents( $file_path ) {

			global $wp_filesystem;

			$get_contents = $wp_filesystem->get_contents( $file_path );

			return $get_contents;
		}
	}
}
