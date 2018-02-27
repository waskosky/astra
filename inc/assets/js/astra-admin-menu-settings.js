/**
 * Install Astra Starter Sites
 *
 * - add()
 * - remove()
 * - run()
 * - stop()
 *
 * @since 1.0.0
 */

(function($){

	AstraThemeAdmin = {

		log_file        : '',
		customizer_data : '',
		wxr_url         : '',
		options_data    : '',
		widgets_data    : '',

		init: function()
		{
			this._bind();
		},

		/**
		 * Debugging.
		 * 
		 * @param  {mixed} data Mixed data.
		 */
		_log: function( data ) {
			
			if( AstraThemeAdmin.debug ) {

				var date = new Date();
				var time = date.toLocaleTimeString();

				if (typeof data == 'object') { 
					console.log('%c ' + JSON.stringify( data ) + ' ' + time, 'background: #ededed; color: #444');
				} else {
					console.log('%c ' + data + ' ' + time, 'background: #ededed; color: #444');
				}


			}
		},

		/**
		 * Binds events for the Astra Theme.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _bind
		 */
		_bind: function()
		{
			$( document ).on('click'                     , '.install-astra-sites', AstraThemeAdmin._installNow);
		},

		/**
		 * Install Now
		 */
		_installNow: function(event)
		{
			event.preventDefault();

			var $button 	= jQuery( event.target ),
				$document   = jQuery(document);

			if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
				return;
			}

			if ( wp.updates.shouldRequestFilesystemCredentials && ! wp.updates.ajaxLocked ) {
				wp.updates.requestFilesystemCredentials( event );

				$document.on( 'credential-modal-cancel', function() {
					var $message = $( '.install-now.updating-message' );

					$message
						.removeClass( 'updating-message' )
						.text( wp.updates.l10n.installNow );

					wp.a11y.speak( wp.updates.l10n.updateCancel, 'polite' );
				} );
			}

			AstraThemeAdmin._log( AstraThemeAdmin.log.installingPlugin + ' ' + $button.data( 'slug' ) );

			wp.updates.installPlugin( {
				slug:    $button.data( 'astra-sites' )
			} );
		},
	};

	/**
	 * Initialize AstraThemeAdmin
	 */
	$(function(){
		AstraThemeAdmin.init();
	});

})(jQuery);