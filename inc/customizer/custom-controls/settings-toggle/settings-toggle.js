

wp.customize.controlConstructor['ast-settings-toggle'] = wp.customize.Control.extend({

    ready : function() {

        'use strict';

        var control = this,
        value   = control.setting._value;

        control.registerToggleEvents();
        this.container.on( 'ast_settings_changed', control.onOptionChange );
    },
    
    registerToggleEvents: function() {

        var control = this;

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
                    var fields = control.params.ast_fields;
                    var $modal_wrap = $( $("#tmpl-ast-settings-modal").html() );
                
                    parent_wrap.append( $modal_wrap );
                    parent_wrap.find( '.ast-fields-wrap' ).attr( 'data-control', control.params.name );
                    control.ast_render_field( parent_wrap, fields, control );
                }
            }

            $this.toggleClass('open');

        });
    },

    ast_render_field: function( wrap, fields, control_elem ) {

        var control = this;
        var ast_field_wrap = wrap.find( '.ast-fields-wrap' );
        var fields_html = '';
        var control_types = [];
        var field_values = isJsonString( control_elem.params.value ) ? JSON.parse( control_elem.params.value ) : {};

        _.each( fields, function( attr, index ) {
            var control = attr.control;
            var template_id = "customize-control-" + control + "-content";
            var template = wp.template( template_id );
            var value = field_values[attr.name] || attr.default;

            attr.value = value;

            console.log( attr );

            control_types.push( control );

            fields_html += "<li class='customize-control customize-control-"+ attr.control +"' >";
            fields_html += template( attr );
            fields_html += '</li>';
        });

        ast_field_wrap.html( fields_html );

        _.each( control_types, function( control_type, index ) {

            switch( control_type ) {

                case "ast-responsive-color":
                    control.initResponsiveColor( ast_field_wrap, control_elem );
                break;  

                case "ast-font": 

                    var google_fonts_string = astra.customizer.settings.google_fonts;
                    control.container.find( '.ast-font-family' ).html( google_fonts_string );
                    control.container.find( '.ast-font-family' ).selectWoo();
                    
                break;  
            }
        });

        wrap.find( '.ast-field-settings-modal' ).data( 'loaded', true );
        
    },

    initResponsiveColor: function( wrap, control_elem ) {

        var control = this;
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
                    control.container.trigger( 'ast_settings_changed', [ control, jQuery(this), newValue ] );
                }
            },

                /**
             * @param {Event} event - standard jQuery event, produced by "Clear"
             * button.
             */
            clear: function (event) {
                var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0],
                    device = jQuery( this ).closest('.wp-picker-input-wrap').find('.wp-color-picker').data( 'id' );

                var option_name = jQuery( element ).attr('data-name');
                var stored = {
                    'desktop' : jQuery( ".desktop.ast-responsive-color[data-name='"+ option_name +"']" ).val(),
                    'tablet'  : jQuery( ".tablet.ast-responsive-color[data-name='"+ option_name +"']" ).val(),
                    'mobile'  : jQuery( ".mobile.ast-responsive-color[data-name='"+ option_name +"']" ).val()
                };

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

                    jQuery(element).val( '' );
                    control.container.trigger( 'ast_settings_changed', [ control, jQuery(element), newValue ] );
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

    onOptionChange:function ( e, control, element, value ) {

        var control_id = element.closest( '.ast-fields-wrap' ).attr( 'data-control' ),
            hidden_data_input = $( ".ast-hidden-input[data-name='"+ control_id +"']");

        if( '""' == hidden_data_input.val() ) {
            var option_data = {};
        } else {
            var option_data = isJsonString( hidden_data_input.val() ) ? JSON.parse( hidden_data_input.val() ) : {};
        }

        var input_name  = element.attr( 'data-name' );
        option_data[input_name] = value;

        hidden_data_input.val( JSON.stringify( option_data ) );
        control.setting.set( JSON.stringify( option_data ) );
    },
});

var isJsonString = function(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

