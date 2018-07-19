/**
 * Customizer controls
 *
 * @package Astra
 */

( function( $ ) {

	 'use strict';

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @since x.x.x
	 * @class Astra_Customizer
	 */
	var Astra_Customizer = {

		controls	: {},
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
			var $this = this;
			$this.handleDependency();

			api.bind( 'change', function ( setting ) {
				$this.handleDependency();
			} );

		},

		handleDependency: function() {

			var $this = this;
			var values = api.get();

            _.each( values, function ( value, id ) {
                var control = api.control(id);

                $this.checkControlVisibility( control, id );
                
            });
		}, 

		checkControlVisibility: function( control, id, values ) {

			var $this = this;
			var values = api.get();

			if ( !_.isUndefined( control ) ) {

            	if( 'undefined' != typeof astra.config[id] ) {
                    var check = false;
                    var required_param = astra.config[id];
                    var conditions     = required_param.conditions;
                    var operator       = 'undefined' !== typeof required_param.operator ? required_param.operator : 'AND';

                    check = $this.checkDependency( conditions, values, operator );

                    if ( !check ) {
                        control.container.addClass('ast-hide');
                    } else {
                        control.container.removeClass('ast-hide');
                    }
                }
            }
		}, 

		checkDependency: function ( conditions, values, compare_operator ) {

            var control = this;
            var check = false;
            var returnNow = false;
      		var test = conditions[0];

            if ( _.isString( test ) ) {
                check = false;
                var cond = conditions[1];
                var cond_val = conditions[2];
                var value;

                if ( !_.isUndefined( values[test] ) ) {
                    value = values[test];
                    check = control.compareValues( value, cond, cond_val );
                }

            } else if ( _.isArray( test ) ) {
                check = true;
                
                $.each( conditions, function ( index, val ) {

                    var cond_key = val[0];
                    var cond_cond = val[1];
                    var cond_val = val[2];            
                    var t_val = values[cond_key];
                    var element = api.control(cond_key);

                    if( 'undefined' !== typeof astra.config[cond_key] ) {
	                    if( ! control.checkDependency( astra.config[cond_key]['conditions'], values, astra.config[cond_key]['operator'] ) ) {
	                    	check = false;
	                    	return;
	                    } else {
                			var control_obj = api.control(cond_key);
                			control_obj.container.removeClass('ast-hide');
	                    }
                    }
        
                    if ( _.isUndefined( t_val ) ) {
                        t_val = '';
                    }

                    if( 'AND' == compare_operator ) {
                        if ( !control.compareValues( t_val, cond_cond, cond_val ) ) {
                            check = false;
                        }
                    } else {

                    	if ( control.compareValues( t_val, cond_cond, cond_val ) ) {
                            returnNow = true;
                            check = true;
                        } else {
                    		check = false;
                        }
                    }

                	// Break loop in case of OR operator
                    if( returnNow && 'OR' == compare_operator ) {
	                	return false;
	                }
                });
            }

            return check;
        },

        compareValues: function ( value1, cond, value2 ) {
            var equal = false;
            switch (cond) {
                case '===':
                    equal = ( value1 === value2 ) ? true : false;
                    break;
                case '>':
                    equal = ( value1 > value2 ) ? true : false;
                    break;
                case '<':
                    equal = ( value1 < value2 ) ? true : false;
                    break;
                case '!=':
                    equal = ( value1 != value2 ) ? true : false;
                    break;
                case 'empty':
                    var _v = _.clone(value1);
                    if (_.isObject(_v) || _.isArray(_v)) {
                        _.each(_v, function (v, i) {
                            if (_.isEmpty(v)) {
                                delete _v[i];
                            }
                        });

                        equal = _.isEmpty(_v) ? true : false;
                    } else {
                        equal = _.isNull(_v) || _v == '' ? true : false;
                    }
                    break;
                case 'not_empty':
                    var _v = _.clone(value1);
                    if (_.isObject(_v) || _.isArray(_v)) {
                        _.each(_v, function (v, i) {
                            if (_.isEmpty(v)) {
                                delete _v[i];
                            }
                        })
                    }
                    equal = _.isEmpty(_v) ? false : true;
                    break;
                default:
                    if (_.isArray(value2)) {
                        if (!_.isEmpty(value2) && !_.isEmpty(value1)) {
                            equal = _.contains(value2, value1);
                        } else {
                            equal = false;
                        }
                    } else {
                        equal = ( value1 == value2 ) ? true : false;
                    }
            }

            return equal;
        },
	};

	$( function() { Astra_Customizer.init(); } );


})( jQuery );