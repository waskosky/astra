
(function($, wpcustomize) {

    ASTSettingsToggle = {

        init: function()
		{
			wpcustomize.bind( "ready", ASTSettingsToggle.registerToggleEvents );
        },
        
        registerToggleEvents: function() {

            jQuery( document ).on( 'click', '.ast-toggle-desc-wrap .ast-adv-toggle-icon', function( e ) {

                var $this = jQuery(this);
                var parent_wrap = $this.closest( '.customize-control-ast-settings-toggle' );

                if( $this.hasClass('open') ) {
                    parent_wrap.find( '.ast-field-settings-modal' ).hide();
                } else {

                    var control = $this.data( 'control' );
                    var control_params = wpcustomize.control(control);
                    var fields = control_params.params.ast_fields;
                    var $modal_wrap = $($("#tmpl-ast-settings-modal").html());

                    parent_wrap.append( $modal_wrap );
                    ASTSettingsToggle.ast_render_field( parent_wrap, fields );
                }

                $this.toggleClass('open');

            });
        },

        ast_render_field: function( wrap, fields ) {

            var ast_field_wrap = wrap.find( '.ast-fields-wrap' );

            _.each( fields, function( attr, index ) {
                var control = attr.control;
                var template_id = "customize-control-" + control + "-content";
                var template = wp.template( template_id );
                ast_field_wrap.html( template( attr ) );
            });
        }
    }

   ASTSettingsToggle.init();

})(jQuery, wp.customize || null);