( function( $ ) {
	/**
	 * File link.js
	 *
	 * Handles the link
	 *
	 * @package Astra
	 */

	wp.customize.controlConstructor['ast-link'] = wp.customize.Control.extend({

		ready: function() {

			'use strict';

			var control = this,
			value;
			
            console.log( 'here' );

			// Save the value.
			this.container.on( 'change keyup paste', 'input.ast-link-input', function() {

				value = jQuery( this ).val();

				// Update value on change.
                control.setting.set( value );
			});
		},
	});
})(jQuery);
