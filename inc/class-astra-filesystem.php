<?php
/**
 * Astra Helper.
 *
 * @package Astra
 */

/**
 * Class Astra_Filesystem.
 */
class Astra_Filesystem {

	/**
	 * Store instance of Astra_Filesystem
	 *
	 * @since x.x.x
	 * @var Astra_Filesystem
	 */
	protected static $_instance = null;

	/**
	 * Get instance of Astra_Filesystem
	 *
	 * @since x.x.x
	 * @return Astra_Filesystem
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Get WP_Filesystem instance.
	 *
	 * @since x.x.x
	 * @return WP_Filesystem
	 */
	public function get_filesystem() {
		global $wp_filesystem;

		if ( ! $wp_filesystem ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			$context = apply_filters( 'request_filesystem_credentials_context', false );

			$creds = request_filesystem_credentials( site_url(), '', false, $context, null );
			WP_Filesystem( $creds, $context );
		}

		// Set the permission constants if not already set.
		if ( ! defined( 'FS_CHMOD_DIR' ) ) {
			define( 'FS_CHMOD_DIR', 0755 );
		}

		if ( ! defined( 'FS_CHMOD_FILE' ) ) {
			define( 'FS_CHMOD_FILE', 0644 );
		}

		return $wp_filesystem;
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
	 * Create uploads directory if it does not exist.
	 *
	 * @since x.x.x
	 * @param String $dir directory path to be created.
	 * @return boolean True of the directory is created. False if directory is not created.
	 */
	public function maybe_create_uploads_dir( $dir ) {
		// Create the upload dir if it doesn't exist.
		if ( ! file_exists( $dir ) ) {
			// Create the directory.
			$status = astra_filesystem()->get_filesystem()->mkdir( $dir );

			// IF a directory cannot be created, return with false status.
			if ( false === $status ) {
				return false;
			}

			// Add an index file for security.
			astra_filesystem()->get_filesystem()->put_contents( $dir . 'index.php', '' );
		}

		return true;
	}

	/**
	 * Update Filesystem status.
	 *
	 * @since x.x.x
	 * @param boolean $status status for filesystem access.
	 * @return void
	 */
	public function update_filesystem_access_status( $status ) {
		astra_update_option( 'file-write-access', $status );
	}

	/**
	 * Check if filesystem has write access.
	 *
	 * @since x.x.x
	 * @return boolean True if filesystem has access, false if does not have access.
	 */
	public function can_access_filesystem() {
		return (bool) astra_get_option( 'file-write-access', true );
	}

	/**
	 * Reset filesystem access status.
	 *
	 * @since x.x.x
	 * @return void
	 */
	public function reset_filesystem_access_status() {
		astra_delete_option( 'file-write-access' );
	}

	/**
	 * Returns an array of paths for the upload directory
	 * of the current site.
	 *
	 * @since x.x.x
	 * @param String $assets_dir directory name to be created in the WordPress uploads directory.
	 * @return array
	 */
	public function get_uploads_dir( $assets_dir ) {
		$wp_info = wp_upload_dir( null, false );

		// SSL workaround.
		if ( $this->is_ssl() ) {
			$wp_info['baseurl'] = str_ireplace( 'http://', 'https://', $wp_info['baseurl'] );
		}

		// Build the paths.
		$dir_info = array(
			'path' => $wp_info['basedir'] . '/' . $assets_dir . '/',
			'url'  => $wp_info['baseurl'] . '/' . $assets_dir . '/',
		);

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
	public function put_contents( $file_path, $style_data ) {
		return astra_filesystem()->get_filesystem()->put_contents( $file_path, $style_data );
	}

	/**
	 * Get contents of the file.
	 *
	 * @param  string $file_path  Gets the assets path info.
	 * @since  x.x.x
	 * @return bool $get_contents Gets te file contents.
	 */
	public function get_contents( $file_path ) {
		return astra_filesystem()->get_filesystem()->get_contents( $file_path );
	}
}
