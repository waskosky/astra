

wp.customize.controlConstructor['ast-settings-group'] = wp.customize.Control.extend({

    ready : function() {

        'use strict';

        var control = this,
        value   = control.setting._value;

        control.registerToggleEvents();
        this.container.on( 'ast_settings_changed', control.onOptionChange );
    },
    
    registerToggleEvents: function() {

        var control = this;

        control.container.on( 'click', '.ast-toggle-desc-wrap .ast-adv-toggle-icon', function( e ) {

            e.preventDefault();
            e.stopPropagation();

            var $this = jQuery(this);

            var parent_wrap = $this.closest( '.customize-control-ast-settings-group' );
            var is_loaded = parent_wrap.find( '.ast-field-settings-modal' ).data('loaded');

            if( $this.hasClass('open') ) {
                parent_wrap.find( '.ast-field-settings-modal' ).hide();
            } else {
                
                if( is_loaded ) {
                    parent_wrap.find( '.ast-field-settings-modal' ).show();
                } else {
                    var fields = control.params.ast_fields;
                    var $modal_wrap = $( $(".tmpl-ast-settings-modal").html() );

                    parent_wrap.append( $modal_wrap );
                    parent_wrap.find( '.ast-fields-wrap' ).attr( 'data-control', control.params.name );
                    control.ast_render_field( parent_wrap, fields, control );

                    parent_wrap.find( '.ast-field-settings-modal' ).show();
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
        var field_values = control.isJsonString( control_elem.params.value ) ? JSON.parse( control_elem.params.value ) : {};

        _.each( fields, function( attr, index ) {
            var control = attr.control;
            var template_id = "customize-control-" + control + "-content";
            var template = wp.template( template_id );
            var value = field_values[attr.name] || attr.default;
            attr.value = value;

            control_types.push( control );

            if ( 'ast-responsive' == control ) {
                var is_responsive = 'undefined' == typeof attr.responsive ? true : attr.responsive;
                attr.responsive   = is_responsive; 
            }

            var control_clean_name = attr.name.replace( '[', '-' );
            control_clean_name = control_clean_name.replace( ']', '' );

            fields_html += "<li id='customize-control-"+ control_clean_name +"' class='customize-control customize-control-"+ attr.control +"' >";
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

                    var googleFontsString = astra.customizer.settings.google_fonts;
                    control.container.find( '.ast-font-family' ).html( googleFontsString );

                    control.container.find( '.ast-font-family' ).each( function() {
                        var selectedValue = $(this).data('value');
                        $(this).val( selectedValue );

                        var optionName = $(this).data('name');
                        var fontWeightContainer = jQuery(".ast-font-weight[data-connected-control='" + optionName + "']");
                        var weightObject = AstTypography._getWeightObject( AstTypography._cleanGoogleFonts( selectedValue ) );

                        control.generateDropdownHtml( weightObject, fontWeightContainer );
                        fontWeightContainer.val( fontWeightContainer.data('value') );

                    }); 

                    control.container.find( '.ast-font-family' ).selectWoo();
                    control.container.find( '.ast-font-family' ).on( 'select2:select', function() {

                        var value = $(this).val();
                        var weightObject = AstTypography._getWeightObject( AstTypography._cleanGoogleFonts( value ) );
                        var optionName = $(this).data( 'name' );
                        var fontWeightContainer = jQuery(".ast-font-weight[data-connected-control='" + optionName + "']");

                        console.log(weightObject );

                        control.generateDropdownHtml( weightObject, fontWeightContainer );

                        control.container.trigger( 'ast_settings_changed', [ control, jQuery(this), value ] );
                        control.container.trigger( 'ast_settings_changed', [ control, fontWeightContainer, fontWeightContainer.val() ] );
                        
                    });

                    control.container.find( '.ast-font-weight' ).on( 'change', function() {

                        var value = $(this).val();
                        control.container.trigger( 'ast_settings_changed', [ control, jQuery(this), value ] );
                    });
                    
                break;  

                case "ast-responsive": 

                    control.initResponsiveTrigger( ast_field_wrap, control_elem ); 

                    control.container.on( 'change keyup paste', 'input.ast-responsive-input, select.ast-responsive-select', function() {
        
                        // Update value on change.
                        control.updateResonsiveValue( jQuery(this) );
                    });

                break;

                case "ast-select":

                    control.container.on( 'change', '.ast-select-input', function() {

                        var value = jQuery( this ).val();   
                        control.container.trigger( 'ast_settings_changed', [ control, jQuery(this), value ] );
                    });

                break;

                case "ast-slider": 
                   
                    control.container.on('input change', 'input[type=range]', function () {
                        var value = jQuery(this).attr('value'),
                            input_number = jQuery(this).closest('.wrapper').find('.astra_range_value .value');

                        input_number.val(value);
                        control.container.trigger('ast_settings_changed', [control, input_number, value]);
                    });

                    // Handle the reset button.
                    control.container.on( 'click', '.ast-slider-reset', function () {

                        var wrapper = jQuery(this).closest('.wrapper'),
                            input_range = wrapper.find('input[type=range]'),
                            input_number = wrapper.find('.astra_range_value .value'),
                            default_value = input_range.data('reset_value');

                        input_range.val(default_value);
                        input_number.val(default_value);
                        control.container.trigger('ast_settings_changed', [control, input_number, default_value]);
                    });

                    // Save changes.
                    control.container.find( '.customize-control-ast-slider' ).on('input change', 'input[type=number]', function () {

                        var value = jQuery(this).val();
                        jQuery(this).closest('.wrapper').find('input[type=range]').val(value);
                        control.container.trigger('ast_settings_changed', [control, jQuery(this), value]);
                    });

                break;
            }

        });

        wrap.find( '.ast-field-settings-modal' ).data( 'loaded', true );
        
    },

    generateDropdownHtml: function( weightObject, element ) {

        var currentWeightTitle  = element.data( 'inherit' );
        var weightOptions       = '';
        var inheritWeightObject = [ 'inherit' ];
        var counter = 0;
        var weightObject        = $.merge( inheritWeightObject, weightObject );
        var weightValue         = element.val() || '400';
        astraTypo[ 'inherit' ] = currentWeightTitle;

        for ( ; counter < weightObject.length; counter++ ) {

            if ( 0 === counter && -1 === $.inArray( weightValue, weightObject ) ) {
                weightValue = weightObject[ 0 ];
                selected 	= ' selected="selected"';
            } else {
                selected = weightObject[ counter ] == weightValue ? ' selected="selected"' : '';
            }
            if( ! weightObject[ counter ].includes( "italic" ) ){
                weightOptions += '<option value="' + weightObject[ counter ] + '"' + selected + '>' + astraTypo[ weightObject[ counter ] ] + '</option>';
            }
        }
        
        element.html( weightOptions );
    },

    initResponsiveTrigger: function( wrap, control_elem ) {

        wrap.find('.ast-responsive-btns button').on('click', function (event) {

            var device = jQuery(this).attr('data-device');
            if ('desktop' == device) {
                device = 'tablet';
            } else if ('tablet' == device) {
                device = 'mobile';
            } else {
                device = 'desktop';
            }

            jQuery('.wp-full-overlay-footer .devices button[data-device="' + device + '"]').trigger('click');
        });

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
            var option_data = control.isJsonString( hidden_data_input.val() ) ? JSON.parse( hidden_data_input.val() ) : {};
        }

        var input_name  = element.attr( 'data-name' );
        option_data[input_name] = value;
        option_data = JSON.stringify(option_data);

        hidden_data_input.val( option_data );
        control.setting.set( option_data );
    },

    /**
     * Updates the rresponsive param value.
     */
    updateResonsiveValue: function( element ) {

        'use strict';

        var control = this,
        newValue = {};

        // Set the spacing container.
        control.responsiveContainer = control.container.find( '.ast-responsive-wrapper' ).first();

        control.responsiveContainer.find( 'input.ast-responsive-input' ).each( function() {
            var responsive_input = jQuery( this ),
            item = responsive_input.data( 'id' ),
            item_value = responsive_input.val();

            newValue[item] = item_value;

        });

        control.responsiveContainer.find( 'select.ast-responsive-select' ).each( function() {
            var responsive_input = jQuery( this ),
            item = responsive_input.data( 'id' ),
            item_value = responsive_input.val();

            newValue[item] = item_value;
        });

        control.container.trigger( 'ast_settings_changed', [ control, element, newValue ] );
    },

    isJsonString: function( str ) {

        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }   
});