
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
                var is_loaded = parent_wrap.find( '.ast-field-settings-modal' ).data('loaded');

                if( $this.hasClass('open') ) {
                    parent_wrap.find( '.ast-field-settings-modal' ).hide();
                } else {
                    
                    if( is_loaded ) {
                        parent_wrap.find( '.ast-field-settings-modal' ).show();
                    } else {

                        var control = $this.data( 'control' );
                        var control_params = wpcustomize.control(control);
                        var fields = control_params.params.ast_fields;
                        var $modal_wrap = $( $("#tmpl-ast-settings-modal").html() );
                    
                        parent_wrap.append( $modal_wrap );
                        parent_wrap.find( '.ast-fields-wrap' ).attr( 'data-control', control );
                        ASTSettingsToggle.ast_render_field( parent_wrap, fields, control_params );
                    }
                }

                $this.toggleClass('open');

            });
        },

        ast_render_field: function( wrap, fields, control_elem ) {

            var ast_field_wrap = wrap.find( '.ast-fields-wrap' );
            var fields_html = '';
            var control_types = [];
            var field_values = ASTSettingsToggle.isJsonString( control_elem.params.value ) ? JSON.parse( control_elem.params.value ) : {};

            _.each( fields, function( attr, index ) {
                var control = attr.control;
                var template_id = "customize-control-" + control + "-content";
                var template = wp.template( template_id );
                var value = field_values[attr.name] || '';
                attr.value = value;

                control_types.push( control );
                fields_html += template( attr );
            });

            ast_field_wrap.html( fields_html );

            ast_field_wrap.on( 'change', 'input, select, textarea', function( e ) {

                var control_id = $(this).closest( '.ast-fields-wrap' ).attr( 'data-control' );
                var hidden_data_input = $( ".ast-hidden-input[data-name='"+ control_id +"']");
                var control_params = wpcustomize.control(control_id);

                if( '""' == hidden_data_input.val() ) {
                    var option_data = {};
                } else {
                    var option_data = ASTSettingsToggle.isJsonString( hidden_data_input.val() ) ? JSON.parse( hidden_data_input.val() ) : {};
                }

                var input_value = $(this).val();
                var input_name  = $(this).attr( 'data-name' );

                option_data[input_name] = input_value;

                hidden_data_input.val( JSON.stringify( option_data ) );
                control_params.setting.set( JSON.stringify( option_data ) );

            });

            _.each( control_types, function( control_type, index ) {

                switch( control_type ) {

                    case "ast-color":
                        ASTSettingsToggle.initColorPicker( ast_field_wrap, control_elem );
                    break;
                }
            });

            wrap.find( '.ast-field-settings-modal' ).data( 'loaded', true );
            
        },

        initColorPicker: function( wrap, control_elem ) {

            wrap.find('.ast-color-picker-alpha' ).wpColorPicker({
				/**
			     * @param {Event} event - standard jQuery event, produced by whichever
			     * control was changed.
			     * @param {Object} ui - standard jQuery UI object, with a color member
			     * containing a Color.js object.
			     */
			    change: function (event, ui) {
			        var element = event.target;
                    var color = ui.color.toString();

			        if ( jQuery('html').hasClass('colorpicker-ready') ) {
                        control_elem.setting.set( color );
                        jQuery(element).val(color).trigger( 'change' );
			        }
			    },

			    /**
			     * @param {Event} event - standard jQuery event, produced by "Clear"
			     * button.
			     */
			    clear: function (event) {
			        var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
			        var color = '';

			        if (element) {
			            // Add your code here
			        	control_elem.setting.set( color );
			        }
			    }
			});

        },

        isJsonString: function(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
    }

   ASTSettingsToggle.init();

})(jQuery, wp.customize || null);