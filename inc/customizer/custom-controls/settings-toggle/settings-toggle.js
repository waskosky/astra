
(function($, wpcustomize) {

    ASTSettingsToggle = {

        init: function()
		{
            wpcustomize.bind( "ready", ASTSettingsToggle.registerToggleEvents );
            jQuery(document).on( 'ast_settings_changed', ASTSettingsToggle.onOptionChange );
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

                fields_html += "<div class='ast-toggle-field-container customize-control-"+ attr.control +"' >";
                fields_html += template( attr );
                fields_html += '</div>';
            });

            ast_field_wrap.html( fields_html );

            _.each( control_types, function( control_type, index ) {

                switch( control_type ) {

                    case "ast-color":
                        ASTSettingsToggle.initColorPicker( ast_field_wrap, control_elem );
                    break;

                    case "ast-responsive-color":
                        ASTSettingsToggle.initResponsiveColor( ast_field_wrap, control_elem );
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
                        jQuery(element).val(color);
                        jQuery(document).trigger( 'ast_settings_changed', [ jQuery(this), color ] );
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
			        	jQuery(element).val(color);
			        }
			    }
			});

        },

        initResponsiveColor: function( wrap, control_elem ) {

            var picker = wrap.find( '.ast-responsive-color' );

            picker.wpColorPicker({

                change: function(event, ui) {
                    if ( jQuery('html').hasClass('responsive-background-color-ready') ) {

                        var option_name = jQuery(this).data('name');
                        var stored = {
                            'desktop' : jQuery( ".desktop.ast-responsive-color[data-name='"+ option_name +"']" ).val(),
                            'tablet'  : jQuery( ".tablet.ast-responsive-color[data-name='"+ option_name +"']" ).val(),
                            'mobile'  : jQuery( ".mobile.ast-responsive-color[data-name='"+ option_name +"']" ).val()
                        };

                        var element = event.target;
                        var device = jQuery( this ).data( 'id' );
                        var newValue = {
                            'desktop' : stored['desktop'],
                            'tablet'  : stored['tablet'],
                            'mobile'  : stored['mobile'],
                        };
                        if ( 'desktop' === device ) {
                            newValue['desktop'] = ui.color.toString();
                        }
                        if ( 'tablet' === device ) {
                            newValue['tablet'] = ui.color.toString();
                        }
                        if ( 'mobile' === device ) {
                            newValue['mobile'] = ui.color.toString();
                        }

                        jQuery(element).val( ui.color.toString() );
                        jQuery(document).trigger( 'ast_settings_changed', [ jQuery(this), newValue ] );
                    }
                },
    
                  /**
                 * @param {Event} event - standard jQuery event, produced by "Clear"
                 * button.
                 */
                clear: function (event) {
                    var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0],
                        device = jQuery( this ).closest('.wp-picker-input-wrap').find('.wp-color-picker').data( 'id' );
    
                        var stored = control_elem.setting.get();
                        var newValue = {
                            'desktop' : stored['desktop'],
                            'tablet'  : stored['tablet'],
                            'mobile'  : stored['mobile'],
                        };
                    if ( element ) {
                        if ( 'desktop' === device ) {
                            newValue['desktop'] = '';
                        }
                        if ( 'tablet' === device ) {
                            newValue['tablet'] = '';
                        }
                        if ( 'mobile' === device ) {
                            newValue['mobile'] = '';
                        }
                        control_elem.setting.set( newValue );
                    }
                }
            });

            wrap.find( '.ast-responsive-btns button' ).on( 'click', function( event ) {

                var device = jQuery(this).attr('data-device');
                if( 'desktop' == device ) {
                    device = 'tablet';
                } else if( 'tablet' == device ) {
                    device = 'mobile';
                } else {
                    device = 'desktop';
                }
    
                jQuery( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
            });

            // Set desktop colorpicker active.
            wrap.find( '.ast-responsive-color.desktop' ).parents( '.wp-picker-container' ).addClass( 'active' );
        },

        onOptionChange:function ( e, element, value ) {

            var control_id = element.closest( '.ast-fields-wrap' ).attr( 'data-control' );
            var hidden_data_input = $( ".ast-hidden-input[data-name='"+ control_id +"']");
            var control_params = wpcustomize.control(control_id);

            if( '""' == hidden_data_input.val() ) {
                var option_data = {};
            } else {
                var option_data = ASTSettingsToggle.isJsonString( hidden_data_input.val() ) ? JSON.parse( hidden_data_input.val() ) : {};
            }

            var input_name  = element.attr( 'data-name' );

            option_data[input_name] = value;

            hidden_data_input.val( JSON.stringify( option_data ) );
            control_params.setting.set( JSON.stringify( option_data ) );
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