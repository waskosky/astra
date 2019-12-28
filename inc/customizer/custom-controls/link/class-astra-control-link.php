<?php
/**
 * Customizer Control: select.
 *
 * Creates a select control.
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

/**
 * Color control (alpha).
 */
class Astra_Control_Link extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ast-link';

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $suffix = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['value'] = $this->value();
		$this->json['label'] = esc_html( $this->label );
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
		<#
		var name = data.settings.default;
		name = name.replace( '[', '-' );
		name = name.replace( ']', '' );
		#>
		<# if ( data.label ) { #>
			<label>
				<span class="customize-control-title">{{{ data.label }}}</span>
			</label>
		<# } console.log( data ); #>
		<div class="customize-control-content">
			<input type="text" class="ast-link-input" data-name="{{data.name}}" value="{{data.value.url}}" >
		</div>
		<div class="customize-control-content">
			<input type="checkbox" id="ast-link-open-in-new-tab" name="ast-link-open-in-new-tab" checked>
			<label for="ast-link-open-in-new-tab">Open in a new Tab</label>
		</div>
		<div class="customize-control-content">
			<label>
				<span class="customize-control-title">Button Link Rel</span>
			</label>
			<input type="text" class="ast-link-input" data-name="{{data.name}}" value="{{data.value.link_rel}}" >
		</div>
		<?php
	}
}
