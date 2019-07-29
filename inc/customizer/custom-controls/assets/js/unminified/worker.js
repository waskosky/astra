onmessage = function(e) {
  // console.log('Worker: Message received from main script');
  // console.log(e.data[0]);
   console.log( e.data );

  // let result = e.data[0] * e.data[1];
  // if ( ! isNaN(result)) {
  //   let workerResult = 'Result: ' + result;
  //   console.log('Worker: Posting message back to main script');
    // postMessage(workerResult);
    postMessage( e.data );
  // } 
}

// self.addEventListener('message', function(e) {
//   var data = e.data;
//   switch (data.cmd) {
//     case 'start':
//       console.log( JSON.parse(data.msg) );
//       self.postMessage('WORKER STARTED: ');
//       self.close();
//       break;
//     case 'stop':
//       self.postMessage('WORKER STOPPED: ' + data.msg +
//                        '. (buttons will no longer work)');
//       self.close(); // Terminates the worker.
//       break;
//     default:
//       self.postMessage('Unknown command: ' + data.msg);
//   };
// }, false);

// this.onmessage = function( e ) {

  
//   console.log('Worker: Message received from main script');
//   console.log(e);
//   console.log(e.wrap);
//   console.log(e.fields);
//   console.log(e.control_elem);
//   console.log(e.this_control);
//   console.log('Work==================================');
//   if( undefined !== e.wrap && undefined !== e.fields && undefined !== e.control_elem && undefined !== e.this_control ) {

//     var wrap = e.wrap;
//     var fields = e.fields;
//     var control_elem = e.control_elem;
//     var this_control = e.this_control;

        // var control = this_control;
        // var ast_field_wrap = wrap.find( '.ast-fields-wrap' );
        // var fields_html = '';
        // var control_types = [];
        // var field_values = control.isJsonString( control_elem.params.value ) ? JSON.parse( control_elem.params.value ) : {};

        // if( 'undefined' != typeof fields.tabs ) {

        //     var clean_param_name = control_elem.params.name.replace( '[', '-' ),
        //         clean_param_name = clean_param_name.replace( ']', '' );

        //     fields_html += '<div id="' + clean_param_name + '-tabs" class="ast-group-tabs">'; 
        //     fields_html += '<ul class="ast-group-list">'; 
        //     var counter = 0;

        //     _.each( fields.tabs, function ( value, key ) {

        //         var li_class = '';
        //         if( 0 == counter ) {
        //             li_class = "active";
        //         }

        //         fields_html += '<li class="'+ li_class + '"><a href="#tab-' + key + '"><span>' + key +  '</span></a></li>';
        //         counter++;
        //     });

        //     fields_html += '</ul>'; 

        //     fields_html += '<div class="ast-tab-content" >';

        //     _.each( fields.tabs, function ( fields_data, key ) {

        //         fields_html += '<div id="tab-'+ key +'" class="tab">';

        //         var result = control.generateFieldHtml( fields_data, field_values );

        //         fields_html += result.html;

        //         _.each( result.controls , function ( control_value, control_key ) {
        //             control_types.push({
        //                 key: control_value.key,
        //                 value : control_value.value,
        //                 name  : control_value.name 
        //             });
        //         });

        //         fields_html += '</div>';
        //     });

        //     fields_html += '</div></div>';

        //     ast_field_wrap.html( fields_html );

        //     $( "#" + clean_param_name + "-tabs" ).tabs();

        // } else {

        //     var result = control.generateFieldHtml( fields, field_values );

        //     fields_html += result.html;
            
        //     _.each( result.controls, function (control_value, control_key) {
        //         control_types.push({
        //             key: control_value.key,
        //             value: control_value.value,
        //             name: control_value.name
        //         });
        //     });

        //     ast_field_wrap.html(fields_html);
        // }

        // _.each( control_types, function( control_type, index ) {

        //     switch( control_type.key ) {

        //         case "ast-responsive-color":
        //             control.initResponsiveColor( ast_field_wrap, control_elem, control_type.name );
        //         break;  

        //         case "ast-color": 
        //             control.initColor( ast_field_wrap, control_elem, control_type.name );
        //         break;

        //         case "ast-font": 

        //             var googleFontsString = astra.customizer.settings.google_fonts;
        //             control.container.find( '.ast-font-family' ).html( googleFontsString );

        //             control.container.find( '.ast-font-family' ).each( function() {
        //                 var selectedValue = $(this).data('value');
        //                 $(this).val( selectedValue );

        //                 var optionName = $(this).data('name');

        //                 // Set inherit option text defined in control parameters.
        //                 $("select[data-name='" + optionName + "'] option[value='inherit']").text( $(this).data('inherit') );

        //                 var fontWeightContainer = jQuery(".ast-font-weight[data-connected-control='" + optionName + "']");
        //                 var weightObject = AstTypography._getWeightObject( AstTypography._cleanGoogleFonts( selectedValue ) );

        //                 control.generateDropdownHtml( weightObject, fontWeightContainer );
        //                 fontWeightContainer.val( fontWeightContainer.data('value') );

        //             }); 

        //             control.container.find( '.ast-font-family' ).selectWoo();
        //             control.container.find( '.ast-font-family' ).on( 'select2:select', function() {

        //                 var value = $(this).val();
        //                 var weightObject = AstTypography._getWeightObject( AstTypography._cleanGoogleFonts( value ) );
        //                 var optionName = $(this).data( 'name' );
        //                 var fontWeightContainer = jQuery(".ast-font-weight[data-connected-control='" + optionName + "']");

        //                 control.generateDropdownHtml( weightObject, fontWeightContainer );

        //                 var font_control = $(this).parents( '.customize-control' ).attr( 'id' );
        //                 font_control = font_control.replace( 'customize-control-', '' );

        //                 control.container.trigger( 'ast_settings_changed', [ control, jQuery(this), value, font_control ] );

        //                 var font_weight_control = fontWeightContainer.parents( '.customize-control' ).attr( 'id' );
        //                 font_weight_control = font_weight_control.replace( 'customize-control-', '' );

        //                 control.container.trigger( 'ast_settings_changed', [ control, fontWeightContainer, fontWeightContainer.val(), font_weight_control ] );
                        
        //             });

        //             control.container.find( '.ast-font-weight' ).on( 'change', function() {

        //                 var value = $(this).val();

        //                 name = $(this).parents( '.customize-control' ).attr( 'id' );
        //                 name = name.replace( 'customize-control-', '' );

        //                 control.container.trigger( 'ast_settings_changed', [ control, jQuery(this), value, name ] );
        //             });
                    
        //         break;  

        //         case "ast-responsive": 

        //             control.initResponsiveTrigger( ast_field_wrap, control_elem ); 

        //             control.container.on( 'change keyup paste', 'input.ast-responsive-input, select.ast-responsive-select', function() {
        
        //                 name = $(this).parents( '.customize-control' ).attr( 'id' );
        //                 name = name.replace( 'customize-control-', '' );

        //                 // Update value on change.
        //                 control.updateResonsiveValue( jQuery(this), name );
        //             });

        //         break;

        //         case "ast-select":

        //             control.container.on( 'change', '.ast-select-input', function() {

        //                 var value = jQuery( this ).val();

        //                 name = $(this).parents( '.customize-control' ).attr( 'id' );
        //                 name = name.replace( 'customize-control-', '' );  

        //                 control.container.trigger( 'ast_settings_changed', [ control, jQuery(this), value, name ] );
        //             });

        //         break;

        //         case "ast-slider": 
                   
        //             control.container.on('input change', 'input[type=range]', function () {
        //                 var value = jQuery(this).attr('value'),
        //                     input_number = jQuery(this).closest('.wrapper').find('.astra_range_value .value');

        //                 input_number.val(value);

        //                 name = $(this).parents( '.customize-control' ).attr( 'id' );
        //                 name = name.replace( 'customize-control-', '' );

        //                 control.container.trigger('ast_settings_changed', [control, input_number, value, name]);
        //             });

        //             // Handle the reset button.
        //             control.container.on( 'click', '.ast-slider-reset', function () {

        //                 var wrapper = jQuery(this).closest('.wrapper'),
        //                     input_range = wrapper.find('input[type=range]'),
        //                     input_number = wrapper.find('.astra_range_value .value'),
        //                     default_value = input_range.data('reset_value');

        //                 input_range.val(default_value);
        //                 input_number.val(default_value);

        //                 name = $(this).parents( '.customize-control' ).attr( 'id' );
        //                 name = name.replace( 'customize-control-', '' );

        //                 control.container.trigger('ast_settings_changed', [control, input_number, default_value, name]);
        //             });

        //             // Save changes.
        //             control.container.find( '.customize-control-ast-slider' ).on('input change', 'input[type=number]', function () {

        //                 var value = jQuery(this).val();
        //                 jQuery(this).closest('.wrapper').find('input[type=range]').val(value);

        //                 name = $(this).parents( '.customize-control' ).attr( 'id' );
        //                 name = name.replace( 'customize-control-', '' );
 
        //                 control.container.trigger('ast_settings_changed', [control, jQuery(this), value, name]);
        //             });

        //         break;

        //         case "ast-responsive-background":

        //             control.initAstResonsiveBgControl( control_elem, control_type, control_type.name );

        //         break;

        //         case "ast-background":

        //             control.initAstBgControl( control_elem, control_type, control_type.name );

        //         break;

        //         case "ast-border":

        //             control.initAstBorderControl( control_elem, control_type, control_type.name );

        //         break;
        //     }

        // });

        // wrap.find( '.ast-field-settings-modal' ).data( 'loaded', true );

  //       let workerResult = 'Result: ';
  //       console.log('Worker: Posting message back to main script');
  //   postMessage(workerResult);
  // }



  // wrap.find( '.ast-field-settings-modal' ).data( 'loaded', true );
  
// }
