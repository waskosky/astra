/**
 * File slider.js
 *
 * Handles Slider control
 *
 * @package Astra
 */

	wp.customize.controlConstructor['ast-color'] = wp.customize.Control.extend({

		ready: function() {

			'use strict';

			var control = this,
				value,
				thisInput,
				inputDefault,
				changeAction;

			console.log( jQuery( '.ast-color-picker-alpha' ) );
			

			this.container.find('.ast-color-picker-alpha' ).wpColorPicker({
				/**
			     * @param {Event} event - standard jQuery event, produced by whichever
			     * control was changed.
			     * @param {Object} ui - standard jQuery UI object, with a color member
			     * containing a Color.js object.
			     */
			    change: function (event, ui) {
			        var element = event.target;
			        var color = ui.color.toString();

			       	control.setting.set( color );
			        // if ( jQuery('html').hasClass('colorpicker-ready') ) {
			        // }else{
			        // 	jQuery('html').addClass('colorpicker-ready')
			        // }
			    },

			    /**
			     * @param {Event} event - standard jQuery event, produced by "Clear"
			     * button.
			     */
			    clear: function (event) {
			        var element = jQuery(event.target).siblings('.wp-color-picker')[0];
			        var color = '';

			        if (element) {
			            // Add your code here
			        	control.setting.set( color );
			        }
			    }
			});
		}
	});
