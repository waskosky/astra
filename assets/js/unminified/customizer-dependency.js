/**
 * Customizer controls
 *
 * @package Astra
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @since x.x.x
	 * @class Astra_Customizer_
	 */
	Astra_Customizer_ = {

		controls	: {},

		/**
		 * Initializes our custom logic for the Customizer.
		 *
		 * @since x.x.x
		 * @method init
		 */
		init: function()
		{
			Astra_Customizer_.init();
		},

		/**
		 * Initializes the logic for showing and hiding controls
		 * when a setting changes.
		 *
		 * @since x.x.x
		 * @access private
		 * @method init
		 */
		init: function()
		{
			api.bind( 'change', function ( setting ) {
				console.dir( setting.id );
				console.dir( setting.get() );
			} );
		}
	};

	$( function() { Astra_Customizer_.init(); } );

})( jQuery );