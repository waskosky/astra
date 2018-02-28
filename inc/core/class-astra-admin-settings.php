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

			// AJAX.
			add_action( 'wp_ajax_astra-sites-plugin-activate', __CLASS__ . '::required_plugin_activate' );
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
			// Script.
			wp_enqueue_script( 'astra-admin-settings', ASTRA_THEME_URI . 'inc/assets/js/astra-admin-menu-settings.js', array( 'jquery', 'wp-util', 'updates' ), ASTRA_THEME_VERSION );

			$localize = array(
				'ajaxUrl'             => admin_url( 'admin-ajax.php' ),
				'btnActivating'       => __( 'Activating', 'astra' ) . '&hellip;',
				'astraSitesLink'      => admin_url( 'themes.php?page=astra-sites' ),
				'astraSitesLinkTitle' => __( 'See Library', 'astra' ),
			);
			wp_localize_script( 'astra-admin-settings', 'astra', apply_filters( 'astra_theme_js_localize', $localize ) );
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

			$ast_icon  = apply_filters( 'astra_page_top_icon', true );
			$top_links = apply_filters(
				'astra_page_top_links', array(
					'astra-theme-link' => array(
						'title'     => __( 'Visit Website', 'astra' ),
						'theme_url' => 'https://wpastra.com',
					),
				)
			);

			?>
			<div class="ast-menu-page-wrapper wrap ast-clear">
					<div class="ast-theme-page-header">
						<div class="ast-container ast-flex">
							<div class="ast-theme-title">
								<?php if ( $ast_icon ) { ?>
									<img src="<?php echo esc_url( ASTRA_THEME_URI . 'inc/assets/images/astra-icon.png' ); ?>" class="ast-theme-icon" alt="<?php echo esc_attr( self::$menu_page_title ); ?> " >
								<?php } ?>
								<span>
									<?php echo esc_html( self::$menu_page_title ); ?>
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

			do_action( 'astra_welcome_page_right_sidebar_content_before' );
			?>
			<div class="postbox">
				<h2 class="hndle">
					<span class="dashicons dashicons-book"></span>
					<span><?php esc_html_e( 'Getting Started', 'astra' ); ?></span>
				</h2>
				<div class="inside">
					<p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<a href="<?php echo esc_url( 'https://wpastra.com/docs/?utm_source=astra-dashoard&utm_medium=visit-documentation&utm_campaign=welcome-page' ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Visit Documentation', 'astra' ); ?></a>
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle">
					<span class="dashicons dashicons-admin-customizer"></span>
					<span><?php esc_html_e( 'Astra Starter Sites', 'astra' ); ?></span>
				</h2>
				<div class="inside">
					<p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<?php
						// Astra Sites - Installed but Inactive.
						if ( file_exists( WP_PLUGIN_DIR . '/astra-sites/astra-sites.php' ) && is_plugin_inactive( 'astra-sites/astra-sites.php' ) ) {

							$class       = 'button ast-sites-inactive';
							$button_text = __( 'Activate', 'astra' );
							$data_slug   = 'astra-sites';
							$data_init   = '/astra-sites/astra-sites.php';

							// Astra Sites - Not Installed.
						} elseif ( ! file_exists( WP_PLUGIN_DIR . '/astra-sites/astra-sites.php' ) ) {

							$class       = 'button ast-sites-notinstalled';
							$button_text = __( 'Install', 'astra' );
							$data_slug   = 'astra-sites';
							$data_init   = '/astra-sites/astra-sites.php';

							// Astra Sites - Active.
						} else {
							$class       = 'active';
							$button_text = __( 'See Library', 'astra' );
							$link        = admin_url( 'themes.php?page=astra-sites' );
						}

						printf(
							'<a class="%1$s" %2$s %3$s %4$s> %5$s </a>',
							esc_attr( $class ),
							isset( $link ) ? 'href="' . esc_url( $link ) . '"' : '',
							isset( $data_slug ) ? 'data-slug="' . esc_attr( $data_slug ) . '"' : '',
							isset( $data_init ) ? 'data-init="' . esc_attr( $data_init ) . '"' : '',
							esc_html( $button_text )
						);
						?>
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle">
					<span class="dashicons dashicons-groups"></span>
					<span><?php esc_html_e( 'User Community', 'astra' ); ?></span>
				</h2>
				<div class="inside">
					<p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<a href="<?php echo esc_url( 'https://www.facebook.com/groups/wpastra' ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Join Community', 'astra' ); ?></a>
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle">
					<span class="dashicons dashicons-smiley"></span>
					<span><?php esc_html_e( 'Five Star Support', 'astra' ); ?></span>
				</h2>
				<div class="inside">
					<p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<a href="<?php echo esc_url( 'https://wpastra.com/support/?utm_source=astra-dashoard&utm_medium=submit-a-ticket&utm_campaign=welcome-page' ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Submit a Ticket', 'astra' ); ?></a>
				</div>
			</div>

			<div class="postbox">
				<h2 class="hndle">
					<span class="dashicons dashicons-smiley"></span>
					<span><?php esc_html_e( 'Recommended Resources', 'astra' ); ?></span>
				</h2>
				<div class="inside">
					<p>These are some of our favorite tools and resources that play great with Astra.</p>
					<a href="<?php echo esc_url( 'https://wpastra.com/resources/?utm_source=astra-dashoard&utm_medium=recommended-resources&utm_campaign=welcome-page' ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'See all Recommended Resources', 'astra' ); ?></a>
				</div>
			</div>

			<?php do_action( 'astra_welcome_page_right_sidebar_content_after' ); ?>

		<?php
		}


		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		static public function astra_welcome_page_content() {

			$astra_addon_name = apply_filters( 'astra_addon_name', __( 'Astra Pro Addon', 'astra' ) );

			// Quick settings.
			$quick_settings = apply_filters(
				'astra_quick_settings', array(
					'logo-favicon' => array(
						'title'     => __( 'Upload Logo & Favicon', 'astra' ),
						'dashicon'  => 'dashicons-format-image',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
					),
					'colors'       => array(
						'title'     => __( 'Set Colors', 'astra' ),
						'dashicon'  => 'dashicons-admin-customizer',
						'quick_url' => admin_url( 'customize.php?autofocus[panel]=panel-colors-background' ),
					),
					'typography'   => array(
						'title'     => __( 'Choose Typography', 'astra' ),
						'dashicon'  => 'dashicons-editor-textcolor',
						'quick_url' => admin_url( 'customize.php?autofocus[panel]=panel-typography' ),
					),
					'layout'       => array(
						'title'     => __( 'Check Layout Options', 'astra' ),
						'dashicon'  => 'dashicons-layout',
						'quick_url' => admin_url( 'customize.php?autofocus[panel]=panel-layout' ),
					),
					'header'       => array(
						'title'     => __( 'Header Options', 'astra' ),
						'dashicon'  => 'dashicons-align-center',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-header' ),
					),
					'blog-layout'  => array(
						'title'     => __( 'Blog Layouts', 'astra' ),
						'dashicon'  => 'dashicons-welcome-write-blog',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-blog-group' ),
					),
					'footer'       => array(
						'title'     => __( 'Footer Settings', 'astra' ),
						'dashicon'  => 'dashicons-admin-generic',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-footer-group' ),
					),
				)
			);

			$extensions = apply_filters(
				'astra_addon_list', array(
					'colors-and-background' => array(
						'title'       => __( 'Colors & Background', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/colors-and-backgrounds.png',
						'description' => __( 'Customize colors in all areas on your website or add background images.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'typography'            => array(
						'title'       => __( 'Typography', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/typography.png',
						'description' => __( 'Get full freedom to manage typography of all areas on your website.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'spacing'               => array(
						'title'       => __( 'Spacing', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/spacing.png',
						'description' => 'Controls spacing for every element you use with Astra',
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'blog-pro'              => array(
						'title'       => __( 'Blog Pro', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/blog-pro.png',
						'description' => 'This module adds more options in the customizer for the blog layouts.',
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'header-sections'       => array(
						'title'       => __( 'Header Sections', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/astra-header-sections.png',
						'description' => __( 'This module introduces two more header sections in the website header.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'transparent-header'    => array(
						'title'       => __( 'Transparent Header', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/transparent-header.png',
						'description' => __( 'Create beautiful transparent headers with with just a few clicks.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'sticky-header'         => array(
						'title'       => __( 'Sticky Header', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/sticky-header.png',
						'description' => __( 'Let your header stick throughout the site or just on few particular pages.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'advanced-headers'      => array(
						'title'           => __( 'Page Headers', 'astra' ),
						// 'icon'            => ASTRA_EXT_URI . 'assets/img/advanced-headers.png',
						'description'     => __( 'Make your header layouts look more appealing and sexy!', 'astra' ),
						'manage_settings' => true,
						'class'           => 'ast-addon',
						'title_url'       => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'           => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'advanced-hooks'        => array(
						'title'           => __( 'Custom Layouts', 'astra' ),
						// 'icon'            => ASTRA_EXT_URI . 'assets/img/astra-advanced-hooks.png',
						'description'     => __( 'Add content conditionally in the various hook areas of the theme.', 'astra' ),
						'manage_settings' => true,
						'class'           => 'ast-addon',
						'title_url'       => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'           => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'site-layouts'          => array(
						'title'       => __( 'Site Layouts', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/sites-layout-addon.png',
						'description' => 'Adds Box, Fluid, Padded layouts to add more design possibilities to your websites.',
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'advanced-footer'       => array(
						'title'       => __( 'Footer Widgets', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/advanced-footer.png',
						'description' => __( 'Add customizable widget areas above the main footer.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'scroll-to-top'         => array(
						'title'       => __( 'Scroll To Top', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/scroll-to-top.png',
						'description' => __( 'Provides functionality to add a scroll to top link on your long pages.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'woocommerce'           => array(
						'title'       => __( 'WooCommerce', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/woocommerce.png',
						'description' => __( 'Powerful design features for your WooCommerce store.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'lifterlms'             => array(
						'title'       => __( 'LifterLMS', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/lifterlms.png',
						'description' => __( 'Supercharge your LifterLMS website with amazing design features.', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
							),
						),
					),
					'white-label'           => array(
						'title'       => __( 'White Label', 'astra' ),
						// 'icon'        => ASTRA_EXT_URI . 'assets/img/woocommerce.png',
						'description' => __( 'White Label', 'astra' ),
						'class'       => 'ast-addon',
						'title_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
						'links'       => array(
							array(
								'link_class' => 'ast-learn-more',
								'link_url'   => 'https://wpastra.com/pro/?utm_source=astra-dashoard&utm_medium=learn-more&utm_campaign=welcome-page',
								'link_text'  => __( 'Learn more', 'astra' ),
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
								<ul class="ast-flex">
									<?php
									foreach ( (array) $quick_settings as $key => $link ) {
										echo '<li class=""><span class="dashicons ' . esc_attr( $link['dashicon'] ) . '"></span><a class="ast-quick-setting-title" href="' . esc_url( $link['quick_url'] ) . '" target="_blank" rel="noopener">' . esc_html( $link['title'] ) . '</a></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>

			<div class="postbox">
				<h2 class="hndle ast-addon-heading ast-flex"><span><?php echo esc_html( $astra_addon_name ); ?></span>
					<?php do_action( 'astra_addon_bulk_action' ); ?>
				</h2>
					<div class="ast-addon-list-section">
						<?php
						if ( ! empty( $extensions ) ) :
							?>
							<div>
								<ul class="ast-addon-list">
									<?php
									foreach ( (array) $extensions as $addon => $info ) {
										$title_url = isset( $info['title_url'] ) ? esc_url( $info['title_url'] ) : '';
										echo '<li id="' . esc_attr( $addon ) . '"  class="' . esc_attr( $info['class'] ) . '"><a class="ast-addon-title" href="' . esc_url( $title_url ) . '" target="_blank" rel="noopener">' . esc_html( $info['title'] ) . '</a><div class="ast-addon-link-wrapper">';

										foreach ( $info['links'] as $key => $link ) {
											printf(
												'<a class="%1$s" %2$s> %3$s </a>',
												esc_attr( $link['link_class'] ),
												isset( $link['link_url'] ) ? 'href="' . esc_url( $link['link_url'] ) . '"' : '',
												esc_html( $link['link_text'] )
											);
										}
										echo '</div></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>

		<?php
		}

		/**
		 * Required Plugin Activate
		 *
		 * @since 1.2.4
		 */
		static public function required_plugin_activate() {

			if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'No plugin specified', 'astra' ),
					)
				);
			}

			$plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : '';

			$activate = activate_plugin( $plugin_init, '', false, true );

			if ( is_wp_error( $activate ) ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => $activate->get_error_message(),
					)
				);
			}

			wp_send_json_success(
				array(
					'success' => true,
					'message' => __( 'Plugin Successfully Activated', 'astra' ),
				)
			);

		}

	}

	new Astra_Admin_Settings;

}// End if().
