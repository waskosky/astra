
(function($, wpcustomize) {

    wpcustomize.bind("ready", function(e, b) {

        jQuery( document ).ready( function() {

            jQuery( document ).on( 'click', '.ast-toggle-desc-wrap .ast-adv-toggle-icon', function( e ) {

                var control = $(this).data( 'control' );
                var control_params = wpcustomize.control(control);
                var fields = control_params.params.ast_fields;
                var $modal_wrap = $($("#tmpl-ast-settings-modal").html());
                var parent_wrap = jQuery(this).closest( '.customize-control-ast-settings-toggle' );

                parent_wrap.append( $modal_wrap );

                ast_render_field( parent_wrap, fields );

            });

        })

    });

    function ast_render_field( wrap, fields ) {

        var ast_field_wrap = wrap.find( '.ast-fields-wrap' );

        _.each( fields, function( attr, index ) {

            var name = attr.name;
            var control = attr.control;
            var template_id = "customize-control-" + control + "-content";
            var template = wp.template( template_id );
            ast_field_wrap.html( template( attr ) );
        });

    }

})(jQuery, wp.customize || null);