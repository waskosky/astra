<?php
/**
 * Footer Widgets - Customizer.
 *
 * @package Astra Addon
 * @since 1.6.0
 */

if ( ! class_exists( 'Astra_Ext_Widgets_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.6.0
	 */
	class Astra_Ext_Widgets_Loader {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			// Helper.
			require_once ASTRA_EXT_WIDGETS_DIR . 'classes/class-astra-ext-widgets-helper.php';

			// Add Widget.
			require_once ASTRA_EXT_WIDGETS_DIR . 'classes/widgets/class-astra-ext-widget-address.php';
			require_once ASTRA_EXT_WIDGETS_DIR . 'classes/widgets/class-astra-ext-widget-list-icons.php';
			require_once ASTRA_EXT_WIDGETS_DIR . 'classes/widgets/class-astra-ext-widget-social-profiles.php';

			add_action( 'widgets_init', array( $this, 'register_list_icons_widgets' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_backend_and_frontend') );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_backend_and_frontend') );

		}

		/**
		 * Regiter List Icons widget
		 *
		 * @return void
		 */
		function register_list_icons_widgets() {
			register_widget( 'Astra_Ext_Widget_Address' );
			register_widget( 'Astra_Ext_Widget_List_Icons' );
			register_widget( 'Astra_Ext_Widget_Social_Profiles' );
		}

		/**
		 * Regiter Social Icons widget script
		 *
		 * @param string $hook Page name.
		 * @return void
		 */
		function enqueue_admin_scripts( $hook ) {

			if ( 'widgets.php' !== $hook ) {
				return;
			}

			wp_enqueue_style( 'astra-widgets-backend', ASTRA_EXT_WIDGETS_URL . 'assets/css/unminified/astra-widgets-admin.css', null, ASTRA_THEME_VERSION, 'all' );
			wp_enqueue_script( 'astra-widgets-backend', ASTRA_EXT_WIDGETS_URL . 'assets/js/unminified/astra-widgets-backend.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), ASTRA_THEME_VERSION, true );
		}

		/**
		 * Regiter Social Icons widget script
		 *
		 * @return void
		 */
		function enqueue_scripts() {
			wp_enqueue_style( 'astra-widgets-style', ASTRA_EXT_WIDGETS_URL . 'assets/css/unminified/style.css', null, ASTRA_THEME_VERSION, 'all' );
		}

		/**
		 * Regiter Social Icons widget script
		 *
		 * @return void
		 */
		function enqueue_scripts_backend_and_frontend() {
			wp_register_style( 'astra-widgets-font-style', ASTRA_EXT_WIDGETS_URL . 'assets/css/unminified/font-style.css', null, ASTRA_THEME_VERSION, 'all' );
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_Widgets_Loader::get_instance();
