/**
 * Customizer controls toggles
 *
 * @package Astra
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Trigger hooks
	 */
	ASTControlTrigger = {

	    /**
	     * Trigger a hook.
	     *
	     * @since 1.0.0
	     * @method triggerHook
	     * @param {String} hook The hook to trigger.
	     * @param {Array} args An array of args to pass to the hook.
		 */
	    triggerHook: function( hook, args )
	    {
	    	$( 'body' ).trigger( 'astra-control-trigger.' + hook, args );
	    },

	    /**
	     * Add a hook.
	     *
	     * @since 1.0.0
	     * @method addHook
	     * @param {String} hook The hook to add.
	     * @param {Function} callback A function to call when the hook is triggered.
	     */
	    addHook: function( hook, callback )
	    {
	    	$( 'body' ).on( 'astra-control-trigger.' + hook, callback );
	    },

	    /**
	     * Remove a hook.
	     *
	     * @since 1.0.0
	     * @method removeHook
	     * @param {String} hook The hook to remove.
	     * @param {Function} callback The callback function to remove.
	     */
	    removeHook: function( hook, callback )
	    {
		    $( 'body' ).off( 'astra-control-trigger.' + hook, callback );
	    },
	};

	/**
	 * Helper class that contains data for showing and hiding controls.
	 *
	 * @since 1.0.0
	 * @class ASTCustomizerToggles
	 */
	ASTCustomizerToggles = {


		/**
		 * Section - Header
		 *
		 * @link  ?autofocus[section]=section-header
		 */

		/**
		 * Layout 2
		 */
		// Layout 2 > Right Section > Text / HTML
		// Layout 2 > Right Section > Search Type
		// Layout 2 > Right Section > Search Type > Search Box Type.

		/**
		 * Blog
		 */
		'astra-settings[blog-post-structure]' :
		[
			{
				controls: [
					'astra-settings[blog-meta]',
				],
				callback: function( blog_structure ) {
					if ( jQuery.inArray ( "title-meta", blog_structure ) !== -1 ) {
						return true;
					}
					return false;
				}
			}
		],

		/**
		 * Blog Single
		 */
		 'astra-settings[blog-single-post-structure]' :
		[
			{
				controls: [
					'astra-settings[blog-single-meta]',
				],
				callback: function( blog_structure ) {
					if ( jQuery.inArray ( "single-title-meta", blog_structure ) !== -1 ) {
						return true;
					}
					return false;
				}
			}
		],
		'astra-settings[blog-single-meta]' :
		[
			{
				controls: [
					'astra-settings[blog-single-meta-comments]',
					'astra-settings[blog-single-meta-cat]',
					'astra-settings[blog-single-meta-author]',
					'astra-settings[blog-single-meta-date]',
					'astra-settings[blog-single-meta-tag]',
				],
				callback: function( enable_postmeta ) {

					if ( '1' == enable_postmeta ) {
						return true;
					}
					return false;
				}
		}
		],

		/**
		 * Small Footer
		 */
		'astra-settings[footer-sml-layout]' :
		[
			{
				controls: [
					'astra-settings[section-ast-small-footer-background-styling]',
					'astra-settings[ast-small-footer-color]',
					'astra-settings[ast-small-footer-link-color]',
					'astra-settings[ast-small-footer-link-hover-color]',
					'astra-settings[ast-small-footer-bg-img]',
					'astra-settings[ast-small-footer-text-font]',
					'astra-settings[footer-sml-divider]',
					'astra-settings[section-ast-small-footer-layout-info]',
					'astra-settings[footer-color]',
					'astra-settings[footer-link-color]',
					'astra-settings[footer-link-h-color]',
					'astra-settings[footer-bg-obj]',
					'astra-settings[divider-footer-image]',
				],
				callback: function( small_footer_layout ) {

					if ( 'disabled' != small_footer_layout ) {
						return true;
					}
					return false;
				}
			},
		],
	};

} )( jQuery );