<?php
/**
 * Customizer Control: description
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Control_Settings_Toggle' ) && class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * A text control with validation for CSS units.
	 */
	class Astra_Control_Settings_Toggle extends WP_Customize_Control {

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'ast-settings-toggle';

		/**
		 * The text to display.
		 *
		 * @access public
		 * @var string
		 */
		public $text = '';

		/**
		 * The control name.
		 *
		 * @access public
		 * @var string
		 */
		public $name = '';

		/**
		 * The control value.
		 *
		 * @access public
		 * @var string
		 */
		public $value = '';

		/**
		 * The fields for group.
		 *
		 * @access public
		 * @var string
		 */
		public $ast_fields = '';

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $help = '';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {

			$assets_uri = ASTRA_THEME_URI . 'inc/customizer/custom-controls/settings-toggle/';
			wp_enqueue_style( 'astra-settings-toggle', $assets_uri . 'settings-toggle.css', null, ASTRA_THEME_VERSION );

			wp_enqueue_script( 'astra-settings-toggle-script', $assets_uri . 'settings-toggle.js', array( 'jquery', 'customize-base' ), ASTRA_THEME_VERSION, true );

		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['label']      = esc_html( $this->label );
			$this->json['text']       = $this->text;
			$this->json['help']       = $this->help;
			$this->json['name']       = $this->name;
			$this->json['value']      = $this->value();
			$this->json['ast_fields'] = $this->ast_fields;
		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 *
		 * @access protected
		 */
		protected function content_template() {
			?>

			<div class="ast-toggle-desc-wrap" >
				<label class="customizer-text">
					<# if ( data.label ) { #>
						<span class="customize-control-title">{{{ data.label }}}</span>
					<# } #>
					<# if ( data.help ) { #>
						<span class="ast-description">{{{ data.help }}}</span>
					<# } #>
					<# if ( data.description ) { #>
						<span class="description customize-control-description">{{{ data.text }}}</span>
					<# } #>
					<span class="ast-adv-toggle-icon dashicons" data-control="{{ data.name }}"></span>

				</label>
			</div>
			<div class="customize-control-content">
				<input type="hidden" data-name="{{ data.name }}" class="ast-hidden-input" value="{{ data.value }}">
			</div>
			<script type="text/html" id="tmpl-ast-settings-modal">
				<div class="ast-field-settings-modal">
					<div class="ast-field-settings-wrap" >
						<ul class="ast-fields-wrap">
						</ul>
					</div>
				</div>
			</script>
			<?php
		}

		/**
		 * Render the control's content.
		 *
		 * @see WP_Customize_Control::render_content()
		 */
		protected function render_content() {}
	}

endif;
