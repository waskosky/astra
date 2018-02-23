<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Admin_Settings' ) ) {

	/**
	 * Astra Admin Settings
	 */
	class Astra_Admin_Settings {

		/**
		 * View all actions
		 *
		 * @since 1.0
		 * @var array $view_actions
		 */
		static public $view_actions = array();

		/**
		 * Menu page title
		 *
		 * @since 1.0
		 * @var array $menu_page_title
		 */
		static public $menu_page_title = 'Astra';

		/**
		 * Plugin slug
		 *
		 * @since 1.0
		 * @var array $plugin_slug
		 */
		static public $plugin_slug = 'astra';

		/**
		 * Default Menu position
		 *
		 * @since 1.0
		 * @var array $default_menu_position
		 */
		static public $default_menu_position = 'themes.php';

		/**
		 * Parent Page Slug
		 *
		 * @since 1.0
		 * @var array $parent_page_slug
		 */
		static public $parent_page_slug = 'general';

		/**
		 * Current Slug
		 *
		 * @since 1.0
		 * @var array $current_slug
		 */
		static public $current_slug = 'general';

		/**
		 * Constructor
		 */
		function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );
		}

		/**
		 * Admin settings init
		 */
		static public function init_admin_settings() {

			self::$menu_page_title = apply_filters( 'astra_menu_page_title', __( 'Astra', 'astra' ) );

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], self::$plugin_slug ) !== false ) {

				add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles_scripts' );

				// Let extensions hook into saving.
				do_action( 'astra_admin_settings_scripts' );

				self::save_settings();
			}

			add_action( 'admin_enqueue_scripts', __CLASS__ . '::admin_scripts' );

			add_action( 'customize_controls_enqueue_scripts', __CLASS__ . '::customizer_scripts' );

			add_action( 'admin_menu', __CLASS__ . '::add_admin_menu', 99 );

			add_action( 'astra_menu_general_action', __CLASS__ . '::general_page' );

			add_filter( 'admin_title', __CLASS__ . '::astra_admin_title', 10, 2 );

			add_action( 'astra_welcome_page_right_sidebar_content', __CLASS__ . '::astra_welcome_page_right_sidebar_content' );

			add_action( 'astra_welcome_page_content', __CLASS__ . '::astra_welcome_page_content' );
		}

		/**
		 * View actions
		 */
		static public function get_view_actions() {

			if ( empty( self::$view_actions ) ) {

				$actions            = array(
					'general' => array(
						'label' => __( 'Welcome', 'astra' ),
						'show'  => ! is_network_admin(),
					),
				);
				self::$view_actions = apply_filters( 'astra_menu_options', $actions );
			}

			return self::$view_actions;
		}

		/**
		 * Save All admin settings here
		 */
		static public function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Let extensions hook into saving.
			do_action( 'astra_admin_settings_save' );
		}

		/**
		 * Load the scripts and styles in the customizer controls.
		 *
		 * @since 1.2.1
		 */
		static public function customizer_scripts() {
			$color_palettes = json_encode( astra_color_palette() );
			wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $color_palettes . ';' );
		}

		/**
		 * Enqueues the needed CSS/JS for Backend.
		 *
		 * @since 1.0
		 */
		static public function admin_scripts() {

			// Styles.
			wp_enqueue_style( 'astra-admin', ASTRA_THEME_URI . 'inc/assets/css/astra-admin.css', array(), ASTRA_THEME_VERSION );

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$assets_js_uri = ASTRA_THEME_URI . 'assets/js/' . $dir_name . '/';

			wp_enqueue_script( 'astra-color-alpha', $assets_js_uri . 'wp-color-picker-alpha' . $file_prefix . '.js', array( 'jquery', 'customize-base', 'wp-color-picker' ), ASTRA_THEME_VERSION, true );
		}

		/**
		 * Enqueues the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.0
		 */
		static public function styles_scripts() {

			// Styles.
			wp_enqueue_style( 'astra-admin-settings', ASTRA_THEME_URI . 'inc/assets/css/astra-admin-menu-settings.css', array(), ASTRA_THEME_VERSION );
		}

		/**
		 * Init Nav Menu
		 *
		 * @param mixed $action Action name.
		 * @since 1.0
		 */
		static public function init_nav_menu( $action = '' ) {

			if ( '' !== $action ) {
				self::render_tab_menu( $action );
			}
		}

		/**
		 * Update Admin Title.
		 *
		 * @since 1.0.19
		 *
		 * @param string $admin_title Admin Title.
		 * @param string $title Title.
		 * @return string
		 */
		static public function astra_admin_title( $admin_title, $title ) {

			$screen = get_current_screen();
			if ( 'appearance_page_astra' == $screen->id ) {

				$view_actions = self::get_view_actions();

				$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug;
				$active_tab   = str_replace( '_', '-', $current_slug );

				if ( 'general' != $active_tab && isset( $view_actions[ $active_tab ]['label'] ) ) {
					$admin_title = str_replace( $title, $view_actions[ $active_tab ]['label'], $admin_title );
				}
			}

			return $admin_title;
		}

		/**
		 * Render tab menu
		 *
		 * @param mixed $action Action name.
		 * @since 1.0
		 */
		static public function render_tab_menu( $action = '' ) {
			?>
			<div id="ast-menu-page">
				<?php self::render( $action ); ?>
			</div>
			<?php
		}

		/**
		 * Prints HTML content for tabs
		 *
		 * @param mixed $action Action name.
		 * @since 1.0
		 */
		static public function render( $action ) {

			?>
			<div class="nav-tab-wrapper">
				<h1 class='ast-title'> <?php echo esc_html( self::$menu_page_title ); ?> </h1>
				<?php
				$view_actions = self::get_view_actions();

				foreach ( $view_actions as $slug => $data ) {

					if ( ! $data['show'] ) {
						continue;
					}

					$url = self::get_page_url( $slug );

					if ( $slug == self::$parent_page_slug ) {
						update_option( 'astra_parent_page_url', $url );
					}

					$active = ( $slug == $action ) ? 'nav-tab-active' : '';
					?>
						<a class='nav-tab <?php echo esc_attr( $active ); ?>' href='<?php echo esc_url( $url ); ?>'> <?php echo esc_html( $data['label'] ); ?> </a>
				<?php } ?>
			</div><!-- .nav-tab-wrapper -->

			<?php
			// Settings update message.
			if ( isset( $_REQUEST['message'] ) && ( 'saved' == $_REQUEST['message'] || 'saved_ext' == $_REQUEST['message'] ) ) {
				?>
					<span id="message" class="notice notice-success is-dismissive astra-notice"><p> <?php esc_html_e( 'Settings saved successfully.', 'astra' ); ?> </p></span>
				<?php
			}

		}

		/**
		 * Get and return page URL
		 *
		 * @param string $menu_slug Menu name.
		 * @since 1.0
		 * @return  string page url
		 */
		static public function get_page_url( $menu_slug ) {

			$parent_page = self::$default_menu_position;

			if ( strpos( $parent_page, '?' ) !== false ) {
				$query_var = '&page=' . self::$plugin_slug;
			} else {
				$query_var = '?page=' . self::$plugin_slug;
			}

			$parent_page_url = admin_url( $parent_page . $query_var );

			$url = $parent_page_url . '&action=' . $menu_slug;

			return esc_url( $url );
		}

		/**
		 * Add main menu
		 *
		 * @since 1.0
		 */
		static public function add_admin_menu() {

			$parent_page    = self::$default_menu_position;
			$page_title     = self::$menu_page_title;
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug;
			$page_menu_func = __CLASS__ . '::menu_callback';

			if ( apply_filters( 'astra_dashboard_admin_menu', true ) ) {
				add_theme_page( $page_title, $page_title, $capability, $page_menu_slug, $page_menu_func );
			} else {
				do_action( 'asta_register_admin_menu', $parent_page, $page_title, $capability, $page_menu_slug, $page_menu_func );
			}
		}

		/**
		 * Menu callback
		 *
		 * @since 1.0
		 */
		static public function menu_callback() {

			$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug;

			$active_tab   = str_replace( '_', '-', $current_slug );
			$current_slug = str_replace( '-', '_', $current_slug );

			$astra_theme_name = apply_filters( 'astra_theme_name', __( 'Astra', 'astra' ) );
			$top_links        = apply_filters(
				'astra_page_top_links', array(
					'astra-theme-link' => array(
						'title'     => __( 'Visit Website', 'astra' ),
						'theme_url' => 'https://wpastra.com',
					),
				)
			);

			?>
			<div class="ast-menu-page-wrapper">
				<div class="wrap ast-clear">
						<div class="ast-theme-page-header">
							<div class="ast-container ast-flex">
								<div class="ast-theme-title">
									<span>
										<?php echo esc_html( $astra_theme_name ); ?>
									</span>
								</div>

						<?php
						if ( ! empty( $top_links ) ) :
							?>
							<div class="ast-top-links">
								<ul>
									<?php
									foreach ( (array) $top_links as $key => $info ) {
										echo '<li><a href="' . esc_url( $info['theme_url'] ) . '" target="_blank" rel="noopener" >' . esc_html( $info['title'] ) . '</a></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
							</div>
						</div>
					</div>

				<?php do_action( 'astra_menu_' . esc_attr( $current_slug ) . '_action' ); ?>
			</div>
			<?php
		}

		/**
		 * Include general page
		 *
		 * @since 1.0
		 */
		static public function general_page() {
			require_once ASTRA_THEME_DIR . 'inc/core/view-general.php';
		}

		/**
		 * Include Welcome page right sidebar content
		 *
		 * @since 1.2.4
		 */
		static public function astra_welcome_page_right_sidebar_content() {
			$astra_theme_name = apply_filters( 'astra_theme_name', __( 'Astra', 'astra' ) );
			?>
			<div class="postbox">
				<h2 class="hndle">
					<span>
					<?php
					printf(
						'%1$s %2$s',
						esc_html_e( 'Welcome To', 'astra' ),
						esc_html( $astra_theme_name )
					);
					?>
					</span>
				</h2>
				<div class="inside">
					Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle"><span><?php esc_html_e( 'Getting Started', 'astra' ); ?></span></h2>
				<div class="inside">
					Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle"><span><?php esc_html_e( 'Astra Starter Sites', 'astra' ); ?></span></h2>
				<div class="inside">
					Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle"><span><?php esc_html_e( 'User Community', 'astra' ); ?></span></h2>
				<div class="inside">
					Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle"><span><?php esc_html_e( 'Five Star Support', 'astra' ); ?></span></h2>
				<div class="inside">
					Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle"><span><?php esc_html_e( 'Recommended Resources', 'astra' ); ?></span></h2>
				<div class="inside">
					Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
			</div>

			<a class="submit ast-customizer-btn button-primary button button-hero" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Go To Customizer', 'astra' ); ?></a>
		<?php
		}


		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		static public function astra_welcome_page_content() {
			// Quick settings.
			$quick_settings = apply_filters(
				'astra_quick_settings', array(
					array(
						'title'    => __( 'Upload Logo & Favicon', 'astra' ),
						'dashicon' => 'dashicons-format-image',
						'href'     => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
					),
					array(
						'title'    => __( 'Set Colors', 'astra' ),
						'dashicon' => 'dashicons-admin-customizer',
						'href'     => admin_url( 'customize.php?autofocus[panel]=panel-colors-background' ),
					),
					array(
						'title'    => __( 'Choose Typography', 'astra' ),
						'dashicon' => 'dashicons-editor-textcolor',
						'href'     => admin_url( 'customize.php?autofocus[panel]=panel-typography' ),
					),
					array(
						'title'    => __( 'Check Layout Options', 'astra' ),
						'dashicon' => 'dashicons-layout',
						'href'     => admin_url( 'customize.php?autofocus[panel]=panel-layout' ),
					),
					array(
						'title'    => __( 'Header Options', 'astra' ),
						'dashicon' => 'dashicons-align-center',
						'href'     => admin_url( 'customize.php?autofocus[section]=section-header-group' ),
					),
					array(
						'title'    => __( 'Blog Layouts', 'astra' ),
						'dashicon' => 'dashicons-welcome-write-blog',
						'href'     => admin_url( 'customize.php?autofocus[section]=section-blog-group' ),
					),
					array(
						'title'    => __( 'Footer Settings', 'astra' ),
						'dashicon' => 'dashicons-admin-generic',
						'href'     => admin_url( 'customize.php?autofocus[section]=section-footer-group' ),
					),
				)
			);

			$extensions = apply_filters(
				'astra_addon_list', array(
					'advanced-hooks'        => array(
						'title'           => __( 'Custom Layouts', 'astra' ),
						// 'icon'            => ASTRA_EXT_URI . 'assets/img/astra-advanced-hooks.png',
						'description'     => __( 'Add content conditionally in the various hook areas of the theme.', 'astra' ),
						'manage_settings' => true,
						'links'           => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'blog-pro'              => array(
						'title'       => __( 'Blog Pro', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/blog-pro.png',
						'description' => 'This module adds more options in the customizer for the blog layouts.',
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'colors-and-background' => array(
						'title'       => __( 'Colors & Background', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/colors-and-backgrounds.png',
						'description' => __( 'Customize colors in all areas on your website or add background images.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'advanced-footer'       => array(
						'title'       => __( 'Footer Widgets', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/advanced-footer.png',
						'description' => __( 'Add customizable widget areas above the main footer.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'header-sections'       => array(
						'title'       => __( 'Header Sections', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/astra-header-sections.png',
						'description' => __( 'This module introduces two more header sections in the website header.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'lifterlms'             => array(
						'title'       => __( 'LifterLMS', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/lifterlms.png',
						'description' => __( 'Supercharge your LifterLMS website with amazing design features.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'advanced-headers'      => array(
						'title'           => __( 'Page Headers', 'astra' ),
						// 'icon'            => ASTRA_EXT_URI . 'assets/img/advanced-headers.png',
						'description'     => __( 'Make your header layouts look more appealing and sexy!', 'astra' ),
						'manage_settings' => true,
						'links'           => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'site-layouts'          => array(
						'title'       => __( 'Site Layouts', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/sites-layout-addon.png',
						'description' => 'Adds Box, Fluid, Padded layouts to add more design possibilities to your websites.',
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'spacing'               => array(
						'title'       => __( 'Spacing', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/spacing.png',
						'description' => 'Controls spacing for every element you use with Astra',
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'sticky-header'         => array(
						'title'       => __( 'Sticky Header', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/sticky-header.png',
						'description' => __( 'Let your header stick throughout the site or just on few particular pages.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'scroll-to-top'         => array(
						'title'       => __( 'Scroll To Top', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/scroll-to-top.png',
						'description' => __( 'Provides functionality to add a scroll to top link on your long pages.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'transparent-header'    => array(
						'title'       => __( 'Transparent Header', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/transparent-header.png',
						'description' => __( 'Create beautiful transparent headers with with just a few clicks.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'typography'            => array(
						'title'       => __( 'Typography', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/typography.png',
						'description' => __( 'Get full freedom to manage typography of all areas on your website.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'woocommerce'           => array(
						'title'       => __( 'WooCommerce', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/woocommerce.png',
						'description' => __( 'Powerful design features for your WooCommerce store.', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'white-label'           => array(
						'title'       => __( 'White Label', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/woocommerce.png',
						'description' => __( 'White Label', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
					'upcomming'             => array(
						'title'       => __( 'Upcomming', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/woocommerce.png',
						'description' => __( 'Upcomming', 'astra' ),
						'links'       => array(
							array(
								'link_url'  => 'https://wpastra.com',
								'link_text' => __( 'Learn more', 'astra' ),
							),
						),
					),
				)
			);
			?>
			<div class="postbox">
				<h2 class="hndle"><span><?php esc_html_e( 'Quick Settings', 'astra' ); ?></span></h2>
					<div class="ast-quick-setting-section">
						<?php
						if ( ! empty( $quick_settings ) ) :
							?>
							<div class="ast-quick-links">
								<ul>
									<?php
									foreach ( (array) $quick_settings as $key => $link ) {
										echo '<li class="ast-flex"><span class="dashicons ' . esc_html( $link['dashicon'] ) . '"></span><span class="ast-quick-setting-title">' . esc_html( $link['title'] ) . '</span><a class="ast-quick-setting-link" href="' . esc_url( $link['href'] ) . '" target="_blank" rel="noopener">' . esc_html__( 'Visit Option', 'astra' ) . '</a></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>

			<div class="postbox">
				<h2 class="hndle"><span><?php esc_html_e( 'Astra Pro Addon', 'astra' ); ?></span></h2>
					<div class="ast-addon-list-section">
						<?php
						if ( ! empty( $extensions ) ) :
							?>
							<div class="ast-quick-links">
								<ul>
									<?php
									foreach ( (array) $extensions as $addon => $info ) {
										echo '<li class="ast-flex"><span class="ast-addon-title">' . esc_html( $info['title'] ) . '</span>';

										foreach ( $info['links'] as $key => $link ) {
											printf(
												'<a class="ast-addon-link" href="%1$s" target="_blank" rel="noopener"> %2$s </a>',
												esc_url( $link['link_url'] ),
												esc_html( $link['link_text'] )
											);
										}
										echo '</li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>

		<?php
		}

	}

	new Astra_Admin_Settings;

}// End if().
