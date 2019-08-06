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
		 * @since x.x.x
		 * @var array $fonts
		 */
		static private $css = array();

		/**
		 *  Constructor
		 */
		public function __construct() {

			if ( ! function_exists( 'WP_Filesystem' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
			}

			WP_Filesystem();

			add_action( 'wp_enqueue_scripts', array( $this, 'theme_enqueue_styles' ), 1 );

			if ( defined( 'ASTRA_EXT_FILE' ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'addon_enqueue_styles' ), 999 );
			}

			add_action( 'astra_post_meta_updated', array( $this, 'check_values' ), 10, 1 );

			// Refresh assets.
			add_action( 'customize_save_after', array( $this, 'astra_refresh_assets' ) );
			add_action( 'astra_addon_activate', array( $this, 'astra_refresh_assets' ) );

			// Triggers on click on refresh/ recheck button.
			add_action( 'wp_ajax_astra_refresh_assets_files', array( $this, 'astra_refresh_assets' ) );
		}

		/**
		 * Refresh Assets
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function astra_refresh_assets() {

			astra_delete_option( 'file-write-access' );

			$uploads_dir      = $this->astra_get_upload_dir();
			$uploads_dir_path = $uploads_dir['path'];

			array_map( 'unlink', glob( $uploads_dir_path . '/astra-theme-dynamic-css*.*' ) );
			array_map( 'unlink', glob( $uploads_dir_path . '/astra-addon-dynamic-css*.*' ) );
		}

		/**
		 * Remove post meta that check if css file need to be regenerated.
		 *
		 * @param int $post_id Gets the post id.
		 * @since x.x.x
		 * @return void
		 */
		public function check_values( $post_id ) {
			delete_post_meta( $post_id, 'astra_theme_style_timestamp_css' );
		}

		/**
		 * Enqueue theme CSS files.
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function theme_enqueue_styles() {

			$slug = $archive_title = $this->astra_get_archive_title();

			if ( false === $slug ) {
				$slug = $this->astra_get_post_id();
			}

			$theme_css_data = apply_filters( 'astra_dynamic_theme_css', '' );

			// Return if there is no data to add in the css file.
			if ( empty( $theme_css_data ) ) {
				return;
			}

			// Call enqueue styles function.
			$this->enqueue_styles( $theme_css_data, $slug, $archive_title, 'theme' );
		}

		/**
		 * Enqueue Addon CSS files.
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function addon_enqueue_styles() {

			$slug = $archive_title = $this->astra_get_archive_title();

			if ( false === $slug ) {
				$slug = $this->astra_get_post_id();
			}

			$addon_css_data = apply_filters( 'astra_dynamic_css', '' );

			// Return if there is no data to add in the css file.
			if ( empty( $addon_css_data ) ) {
				return;
			}

			// Call enqueue styles function.
			$this->enqueue_styles( $addon_css_data, $slug, $archive_title, 'addon' );
		}

		/**
		 * Enqueue Addon CSS files.
		 *
		 * @param  string $style_data   Gets the CSS data.
		 * @param  string $slug         Gets the taxonomy name/ post id.
		 * @param  string $slug         Gets the archive title.
		 * @param  string $type         Gets the type theme/addon.
		 * @since  x.x.x
		 * @return void
		 */
		public function enqueue_styles( $style_data, $slug, $archive_title, $type ) {

			$assets_info = $this->astra_get_asset_info( $style_data, $slug, $type );

			if ( false === $archive_title ) {
				$post_timestamp = get_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', true );
			} else {
				$post_timestamp = get_option( 'astra_' . $type . '_get_dynamic_css' );
			}

			if ( '' == $post_timestamp || ! file_exists( $assets_info['path'] ) ) {
				$timestamp = $this->astra_get_file_timestamp();
			} else {
				$timestamp = $post_timestamp;
			}

			if ( ! empty( $style_data ) ) {
				$this->file_write( $style_data, $slug, $archive_title, $timestamp, $type, $assets_info );
			}

			$uploads_dir     = $this->astra_get_upload_dir();
			$uploads_dir_url = $uploads_dir['url'];

			$write_access    = astra_get_option( 'file-write-access', true );
			$load_inline_css = apply_filters( 'astra_load_dynamic_css_inline', false );

			if ( ! $write_access || $load_inline_css ) {
				wp_add_inline_style( 'astra-' . $type . '-css', $style_data );
			} else {
				wp_enqueue_style( 'astra-' . $type . '-dynamic', $uploads_dir_url . 'astra-' . $type . '-dynamic-css-' . $slug . '.css', array(), $timestamp );
			}
		}

		/**
		 * Gets the current post id.
		 *
		 * @since x.x.x
		 * @return string $post_id Post ID.
		 */
		public function astra_get_post_id() {
			$post_id = get_the_ID();
			return $post_id;
		}

		/**
		 * Gets the current timestamp.
		 *
		 * @since x.x.x
		 * @return string $timestamp Timestamp.
		 */
		public function astra_get_file_timestamp() {
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
		public function astra_get_upload_dir() {

			global $wp_filesystem;

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
				$wp_filesystem->mkdir( $dir_info['path'] );
				// Add an index file for security.
				$wp_filesystem->put_contents( $dir_info['path'] . 'index.php', '' );

			}
			return apply_filters( 'astra_astra_get_upload_dir', $dir_info );
		}

		/**
		 * Gets the archive title.
		 *
		 * @since  x.x.x
		 * @return $title Gets the archive title.
		 */
		public function astra_get_archive_title() {
			if ( is_category() ) {
				$title = 'category';
			} elseif ( is_tag() ) {
				$title = 'tag';
			} elseif ( is_author() ) {
				$title = 'author';
			} elseif ( is_year() ) {
				$title = 'year';
			} elseif ( is_month() ) {
				$title = 'month';
			} elseif ( is_day() ) {
				$title = 'day';
			} elseif ( is_tax( 'post_format' ) ) {
				if ( is_tax( 'post_format', 'post-format-aside' ) ) {
					$title = 'asides';
				} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
					$title = 'galleries';
				} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
					$title = 'images';
				} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
					$title = 'videos';
				} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
					$title = 'quotes';
				} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
					$title = 'links';
				} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
					$title = 'statuses';
				} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
					$title = 'audio';
				} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
					$title = 'chats';
				}
			} elseif ( is_post_type_archive() ) {
				$title = 'archives';
			} elseif ( is_tax() ) {
				$tax   = get_taxonomy( get_queried_object()->taxonomy );
				$title = $tax->labels->singular_name;
			} else {
				$title = false;
			}
			return $title;
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
		public function astra_get_asset_info( $data, $slug, $type ) {

			$uploads_dir = $this->astra_get_upload_dir();
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
		 * Creates CSS files.
		 *
		 * @param  string $style_data   Gets the CSS for the current Page.
		 * @param  string $slug         Gets the current post ID/ Taxonomy name.
		 * @param  string $slug         Gets the archive title.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @param  string $type         Gets the type theme/addon.
		 * @param  string $assets_info  Gets the assets path info.
		 * @since  x.x.x
		 */
		public function file_write( $style_data, $slug, $archive_title, $timestamp, $type, $assets_info ) {

			global $wp_filesystem;

			if ( false === $archive_title ) {
				$post_timestamp = get_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', true );

				if ( '' == $post_timestamp && '' == $timestamp ) {
					return;
				}
			} else {
				$current_timestamp = get_option( 'astra_' . $type . '_get_dynamic_css', true );

				if ( '' == $current_timestamp && '' == $timestamp ) {
					return;
				}
			}

			// Create a new file.
			$put_contents = $wp_filesystem->put_contents( $assets_info['path'], $style_data );

			// Adds an option as if the uploads folder has file rights access.
			astra_update_option( 'file-write-access', $put_contents );

			if ( false === $archive_title ) {
				// Update the post meta.
				update_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', $timestamp );
			} else {
				// Update the option.
				update_option( 'astra_' . $type . '_get_dynamic_css', $timestamp );
			}
		}
	}

	new Astra_Helper;
}
