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
			$( document ).on('click' , '.install-astra-sites', AstraThemeAdmin._installNow);
			$( document ).on('wp-plugin-install-success' , AstraThemeAdmin._installSuccess);
		},

		/**
		 * Install Success
		 */
		_installSuccess: function( event, response ) {

			event.preventDefault();

			if( 'astra-sites' !== response.slug ) {
				return;
			}

			var $message = $( '.install-astra-sites' );

			// Transform the 'Install' button into an 'Activate' button.
			var $init = $message.data('init');

			$message.removeClass( 'install-now installed button-disabled updated-message' )
				.addClass('updating-message')
				.html( AstraThemeAdmin.strings.btnActivating );

			// Reset not installed plugins list.
			var pluginsList = AstraThemeAdmin.requiredPlugins.notinstalled;
			AstraThemeAdmin.requiredPlugins.notinstalled = AstraThemeAdmin._removePluginFromQueue( response.slug, pluginsList );

			// WordPress adds "Activate" button after waiting for 1000ms. So we will run our activation after that.
			setTimeout( function() {

				$.ajax({
					url: AstraThemeAdmin.ajaxurl,
					type: 'POST',
					data: {
						'action'            : 'astra-required-plugin-activate',
						'init'              : $init,
						'options'           : $siteOptions,
						'enabledExtensions' : $enabledExtensions,
					},
				})
				.done(function (result) {

					if( result.success ) {

						var pluginsList = AstraThemeAdmin.requiredPlugins.inactive;

						// Reset not installed plugins list.
						AstraThemeAdmin.requiredPlugins.inactive = AstraThemeAdmin._removePluginFromQueue( response.slug, pluginsList );

						$message.removeClass( 'button-primary install-now activate-now updating-message' )
							.attr('disabled', 'disabled')
							.addClass('disabled')
							.text( AstraThemeAdmin.strings.btnActive );

						// Enable Demo Import Button
						AstraThemeAdmin._enable_demo_import_button();

					} else {

						$message.removeClass( 'updating-message' );

					}

				});

			}, 1200 );

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

			// AstraThemeAdmin._log( AstraThemeAdmin.log.installingPlugin + ' ' + $button.data( 'slug' ) );

			wp.updates.installPlugin( {
				slug:    $button.data( 'slug' )
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