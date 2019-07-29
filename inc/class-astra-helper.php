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
			add_action( 'astra_post_meta_updated', array( $this, 'check_values' ), 10, 1 );
			add_action( 'customize_save_after', array( $this, 'astra_remove_css_option' ) );
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
		 * Remove option that check if css file need to be regenerated.
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function astra_remove_css_option() {
			delete_option( 'astra_theme_get_dynamic_css' );
		}

		/**
		 * Enqueue theme CSS files.
		 *
		 * @since x.x.x
		 * @return bool
		 */
		public function theme_enqueue_scripts() {

			$slug = $this->astra_get_archive_title();

			if ( '' == $slug ) {
				$slug = $this->get_post_id();
			}

			if ( ! $slug ) {
				return;
			}

			$theme_css_data = apply_filters( 'astra_dynamic_theme_css', '' );

			if ( '' == $this->astra_get_archive_title() ) {
				$post_timestamp = get_post_meta( get_the_ID(), 'astra_theme_style_timestamp_css', true );
			} else {
				$post_timestamp = get_option( 'astra_theme_get_dynamic_css' );
			}

			if ( '' == $post_timestamp ) {
				$timestamp = $this->get_timestamp();
			} else {
				$timestamp = $post_timestamp;
			}

			if ( ! empty( $theme_css_data ) ) {
				$this->file_write( $theme_css_data, $slug, $timestamp, 'theme' );
			}

			$uploads_dir     = $this->get_upload_dir();
			$uploads_dir_url = $uploads_dir['url'];

			wp_enqueue_style( 'astra-theme-dynamic', $uploads_dir_url . 'astra-theme-dynamic-css-' . $slug . '.css', array(), $timestamp );
		}

		/**
		 * Enqueue Addon CSS files.
		 *
		 * @since x.x.x
		 * @return bool
		 */
		public function addon_enqueue_scripts() {

			$slug = $this->astra_get_archive_title();

			if ( '' == $slug ) {
				$slug = $this->get_post_id();
			}

			if ( ! $slug ) {
				return;
			}

			$theme_css_data = apply_filters( 'astra_dynamic_css', '' );

			if ( '' == $this->astra_get_archive_title() ) {
				$post_timestamp = get_post_meta( get_the_ID(), 'astra_addon_style_timestamp_css', true );
			} else {
				$post_timestamp = get_option( 'astra_addon_get_dynamic_css' );
			}

			if ( '' === $post_timestamp ) {
				$timestamp = $this->get_timestamp();
			} else {
				$timestamp = $post_timestamp;
			}

			if ( ! empty( $addon_css_data ) ) {
				$this->file_write( $addon_css_data, $slug, $timestamp, 'addon' );
			}

			$uploads_dir     = $this->get_upload_dir();
			$uploads_dir_url = $uploads_dir['url'];

			wp_enqueue_style( 'astra-addon-dynamic', $uploads_dir_url . 'astra-addon-dynamic-css-' . $slug . '.css', array(), $timestamp );
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
		 * @param  string $slug         Gets the current post ID/taxonomy name.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @param  string $type         Gets the type theme/addon.
		 * @since x.x.x
		 * @return array
		 */
		public function get_asset_info( $data, $slug, $timestamp, $type ) {

			$uploads_dir = $this->get_upload_dir();
			$css_suffix  = 'astra-' . $type . '-dynamic-css';
			$css_suffix  = 'astra-' . $type . '-dynamic-css';
			$info        = array();
			if ( ! empty( $data ) ) {
				$info['css']     = $uploads_dir['path'] . $css_suffix . '-' . $slug . '.css';
				$info['css_url'] = $uploads_dir['url'] . $css_suffix . '-' . $slug . '.css';
			}
			return $info;
		}

		/**
		 * Creates CSS files.
		 *
		 * @param  string $style_data   Gets the CSS for the current Page.
		 * @param  string $slug      Gets the current post ID/ Taxonomy name.
		 * @param  string $timestamp    Gets the current timestamp.
		 * @param  string $type         Gets the type theme/addon.
		 * @since  x.x.x
		 */
		public function file_write( $style_data, $slug, $timestamp, $type ) {

			if ( '' == $this->astra_get_archive_title() ) {
				$post_timestamp = get_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', true );

				if ( '' == $post_timestamp ) {
					return;
				}
			} else {
				$current_timestamp = get_option( 'astra_' . $type . '_get_dynamic_css', true );

				if ( '' == $current_timestamp ) {
					return;
				}
			}

			// File not created yet.
			$assets_info = $this->get_asset_info( $style_data, $slug, $timestamp, $type );

			// Create a new file.
			$handle = fopen( $assets_info['css'], 'a' );
			file_put_contents( $assets_info['css'], $style_data );
			fclose( $handle );

			if ( '' == $this->astra_get_archive_title() ) {
				// Update the post meta.
				update_post_meta( get_the_ID(), 'astra_' . $type . '_style_timestamp_css', $timestamp );
			} else {
				// Update the option.
				update_option( 'astra_' . $type . '_get_dynamic_css', $timestamp );
			}
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
				$title = $this->get_post_id();
			}
			return $title;
		}

	}

	new Astra_Helper;
}
