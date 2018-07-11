<?php
/**
 * Astra Sites Notices
 *
 * Closing notice on click on `astra-notice-close` class.
 *
 * If notice has the data attribute `data-show-notice-after="%2$s"` then notice close for that SPECIFIC TIME.
 * If notice has NO data attribute `data-show-notice-after="%2$s"` then notice close for the CURRENT USER FOREVER.
 *
 * > Create custom close notice link in the notice markup. E.g.
 * `<a href="#" data-show-notice-after="<?php echo MONTH_IN_SECONDS; ?>" class="astra-notice-close">`
 * It close the notice for 30 days.
 *
 * @package Astra Sites
 * @since 1.4.0
 */

if ( ! class_exists( 'Astra_Notices' ) ) :

	/**
	 * Astra_Notices
	 *
	 * @since 1.4.0
	 */
	class Astra_Notices {

		/**
		 * Notices
		 *
		 * @access private
		 * @var array Notices.
		 * @since 1.4.0
		 */
		private static $notices = array();

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class object.
		 * @since 1.4.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.4.0
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
			add_action( 'admin_notices', array( $this, 'show_notices' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_ajax_astra-notice-dismiss', array( $this, 'dismiss_notice' ) );
		}

		/**
		 * Add Notice.
		 *
		 * @since 1.4.0
		 * @param array $args Notice arguments.
		 * @return void
		 */
		public static function add_notice( $args = array() ) {
			if ( is_array( $args ) ) {
				self::$notices[] = $args;
			}
		}

		/**
		 * Dismiss Notice.
		 *
		 * @since 1.4.0
		 * @return void
		 */
		function dismiss_notice() {
			$notice_id         = ( isset( $_POST['notice_id'] ) ) ? sanitize_key( $_POST['notice_id'] ) : '';
			$show_notice_after = ( isset( $_POST['show_notice_after'] ) ) ? absint( $_POST['show_notice_after'] ) : '';

			// Valid inputs?
			if ( ! empty( $notice_id ) ) {

				if ( ! empty( $show_notice_after ) ) {
					set_transient( $notice_id, true, $show_notice_after );
				} else {
					update_user_meta( get_current_user_id(), $notice_id, true );
				}

				wp_send_json_success();
			}

			wp_send_json_error();
		}

		/**
		 * Enqueue Scripts.
		 *
		 * @since 1.4.0
		 * @return void
		 */
		function enqueue_scripts() {

			$js_prefix  = '.min.js';
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			wp_register_script( 'astra-notices', ASTRA_THEME_URI . 'assets/js/' . $dir . '/astra-notices' . $js_prefix, array( 'jquery' ), null, ASTRA_THEME_VERSION );
		}

		/**
		 * Notice Types
		 *
		 * @since 1.4.0
		 * @return void
		 */
		function show_notices() {

			$defaults = array(
				'id'                => '',      // Optional, Notice ID. If empty it set `astra-notices-id-<$array-index>`.
				'type'              => 'info',  // Optional, Notice type. Default `info`. Expected [info, warning, notice, error].
				'message'           => '',      // Optional, Message.
				'show_if'           => true,    // Optional, Show notice on custom condition. E.g. 'show_if' => if( is_admin() ) ? true, false, .
				'show-notice-after' => '',      // Optional, Dismiss-able notice time. It'll auto show after given time.
				'class'             => '',      // Optional, Additional notice wrapper class.
			);

			foreach ( self::$notices as $key => $notice ) {

				$notice = wp_parse_args( $notice, $defaults );

				$notice['id'] = self::get_notice_id( $notice, $key );

				$notice['classes'] = self::get_wrap_classes( $notice );

				// Notices visible after transient expire.
				if ( isset( $notice['show_if'] ) && true === $notice['show_if'] ) {
					if ( self::is_expired( $notice ) ) {
						self::markup( $notice );
					}
				} else {

					// No transient notices.
					self::markup( $notice );
				}
			}

		}

		/**
		 * Markup Notice.
		 *
		 * @since 1.4.0
		 * @param  array $notice Notice markup.
		 * @return void
		 */
		public static function markup( $notice = array() ) {

			wp_enqueue_script( 'astra-notices' );

			?>
			<div id="<?php echo esc_attr( $notice['id'] ); ?>" class="<?php echo esc_attr( $notice['classes'] ); ?>" data-show-notice-after="<?php echo esc_attr( $notice['show-notice-after'] ); ?>">
				<p>
					<?php
					echo $notice['message']; // WPCS: XSS ok.
					?>
				</p>
			</div>
			<?php
		}

		/**
		 * Notice classes.
		 *
		 * @since 1.4.0
		 *
		 * @param  array $notice Notice arguments.
		 * @return array       Notice wrapper classes.
		 */
		private static function get_wrap_classes( $notice ) {
			$classes   = array( 'astra-notice', 'notice', 'is-dismissible' );
			$classes[] = $notice['class'];
			if ( isset( $notice['type'] ) ) {
				$classes[] = 'notice-' . $notice['type'];
			}

			return implode( ' ', $classes );
		}

		/**
		 * Get Notice ID.
		 *
		 * @since 1.4.0
		 *
		 * @param  array $notice Notice arguments.
		 * @param  int   $key     Notice array index.
		 * @return string       Notice id.
		 */
		private static function get_notice_id( $notice, $key ) {
			if ( isset( $notice['id'] ) && ! empty( $notice['id'] ) ) {
				return $notice['id'];
			}

			return 'astra-notices-id-' . $key;
		}

		/**
		 * Is notice expired?
		 *
		 * @since 1.4.0
		 *
		 * @param  array $notice Notice arguments.
		 * @return boolean
		 */
		private static function is_expired( $notice ) {

			$expired = get_transient( $notice['id'] );
			if ( false === $expired ) {
				$expired = get_user_meta( get_current_user_id(), $notice['id'], true );
				if ( empty( $expired ) ) {
					return true;
				}
			}

			return false;
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Astra_Notices::get_instance();

endif;
