(función ($) {
	var Calendar = función (elemento, opciones) {
		this.element = elemento;
		this.element.addClass ('calendario');
		
		this._initializeEvents (opciones);
		this._initializeOptions (opciones);
		this._render ();
	};
 
	Calendar.prototype = {
		constructor: Calendario,
		_initializeOptions: function (opt) {
			if (opt == null) {
				opt = [];
			}
		
			this.options = {
				startYear:! isNaN (parseInt (opt.startYear))? parseInt (opt.startYear): nueva fecha (). getFullYear (),
				minDate: opt.minDate instancia de Date? opt.minDate: nulo,
				maxDate: opt.maxDate instancia de Date? opt.maxDate: nulo,
				idioma: (opt.language! = null && fechas [opt.language]! = null)? opt.language: 'en',
				allowOverlap: opt.allowOverlap! = null? opt.allowOverlap: true,
				displayWeekNumber: opt.displayWeekNumber! = null? opt.displayWeekNumber: false,
				alwaysHalfDay: opt.alwaysHalfDay! = null? opt.alwaysHalfDay: false,
				enableRangeSelection: opt.enableRangeSelection! = null? opt.enableRangeSelection: false,
				disabledDays: opt.disabledDays instancia de Array? opt.disabledDays: [],
				roundRangeLimits: opt.roundRangeLimits! = null? opt.roundRangeLimits: false,
				dataSource: opt.dataSource instancia de Array! = null? opt.dataSource: [],
				estilo: opt.style == 'fondo' || opt.style == 'borde' || opt.style == 'personalizado'? opt.style: 'borde',
				enableContextMenu: opt.enableContextMenu! = null? opt.enableContextMenu: false,
				contextMenuItems: opt.contextMenuItems instancia de Array? opt.contextMenuItems: [],
				customDayRenderer: $ .isFunction (opt.customDayRenderer)? opt.customDayRenderer: null,
				customDataSourceRenderer: $ .isFunction (opt.customDataSourceRenderer)? opt.customDataSourceRenderer: nulo
			};
			
			this._initializeDatasourceColors ();
		},
		_initializeEvents: function (opt) {
			if (opt == null) {
				opt = [];
			}
		
			if (opt.renderEnd) {this.element.bind ('renderEnd', opt.renderEnd); }
			if (opt.clickDay) {this.element.bind ('clickDay', opt.clickDay); }
			if (opt.dayContextMenu) {this.element.bind ('dayContextMenu', opt.dayContextMenu); }
			if (opt.selectRange) {this.element.bind ('selectRange', opt.selectRange); }
			if (opt.mouseOnDay) {this.element.bind ('mouseOnDay', opt.mouseOnDay); }
			if (opt.mouseOutDay) {this.element.bind ('mouseOutDay', opt.mouseOutDay); }
		},
		_initializeDatasourceColors: function () {
			para (var i en this.options.dataSource) {
				if (this.options.dataSource [i] .color == null) {
					this.options.dataSource [i] .color = colors [i% colors.length];
				}
			}
		},
		_render: function () {
			this.element.empty ();
			
			this._renderHeader ();
			this._renderBody ();
			this._renderDataSource ();
			
			this._applyEvents ();
			this.element.find ('. contenedor de meses'). fadeIn (500);
			
			this._triggerEvent ('renderEnd', {currentYear: this.options.startYear});
		},
		_renderHeader: function () {
			var header = $ (document.createElement ('div'));
			header.addClass ('panel de encabezado de calendario panel predeterminado');
			
			var headerTable = $ (document.createElement ('tabla'));
			
			var prevDiv = $ (document.createElement ('th'));
			prevDiv.addClass ('prev');
			
			if (this.options.minDate! = null && this.options.minDate> new Date (this.options.startYear - 1, 11, 31)) {
				prevDiv.addClass ('deshabilitado');
			}
			
			var prevIcon = $ (document.createElement ('intervalo'));
			prevIcon.addClass ('glyphicon glyphicon-chevron-left');
			
			prevDiv.append (prevIcon);
			
			headerTable.append (prevDiv);
			
			var prev2YearDiv = $ (document.createElement ('th'));
			prev2YearDiv.addClass ('año-título año-vecino2 oculto-sm oculto-xs');
			prev2YearDiv.text (this.options.startYear - 2);
			
			if (this.options.minDate! = null && this.options.minDate> new Date (this.options.startYear - 2, 11, 31)) {
				prev2YearDiv.addClass ('deshabilitado');
			}
			
			headerTable.append (prev2YearDiv);
			
			var prevYearDiv = $ (document.createElement ('th'));
			prevYearDiv.addClass ('año-título año-vecino oculto-xs');
			prevYearDiv.text (this.options.startYear - 1);
			
			if (this.options.minDate! = null && this.options.minDate> new Date (this.options.startYear - 1, 11, 31)) {
				prevYearDiv.addClass ('deshabilitado');
			}
			
			headerTable.append (prevYearDiv);
			
			var yearDiv = $ (document.createElement ('th'));
			yearDiv.addClass ('título-año');
			yearDiv.text (this.options.startYear);
			
			headerTable.append (yearDiv);
			
			var nextYearDiv = $ (document.createElement ('th'));
			nextYearDiv.addClass ('año-título año-vecino oculto-xs');
			nextYearDiv.text (this.options.startYear + 1);
			
			if (this.options.maxDate! = null && this.options.maxDate <new Date (this.options.startYear + 1, 0, 1)) {
				nextYearDiv.addClass ('deshabilitado');
			}
			
			headerTable.append (nextYearDiv);
			
			var next2YearDiv = $ (document.createElement ('th'));
			next2YearDiv.addClass ('año-título año-vecino2 oculto-sm oculto-xs');
			next2YearDiv.text (this.options.startYear + 2);
			
			if (this.options.maxDate! = null && this.options.maxDate <new Date (this.options.startYear + 2, 0, 1)) {
				next2YearDiv.addClass ('deshabilitado');
			}
			
			headerTable.append (next2YearDiv);
			
			var nextDiv = $ (document.createElement ('th'));
			nextDiv.addClass ('siguiente');
			
			if (this.options.maxDate! = null && this.options.maxDate <new Date (this.options.startYear + 1, 0, 1)) {
				nextDiv.addClass ('deshabilitado');
			}
			
			var nextIcon = $ (document.createElement ('intervalo'));
			nextIcon.addClass ('glyphicon glyphicon-chevron-right');
			
			nextDiv.append (nextIcon);
			
			headerTable.append (nextDiv);
			
			header.append (headerTable);
			
			this.element.append (encabezado);
		},
		_renderBody: function () {
			var monthsDiv = $ (document.createElement ('div'));
			monthsDiv.addClass ('contenedor de meses');
			
			para (var m = 0; m <12; m ++) {
				/* Envase */
				var monthDiv = $ (document.createElement ('div'));
				monthDiv.addClass ('mes-contenedor');
				monthDiv.data ('id-mes', m);
				
				var firstDate = nueva fecha (this.options.startYear, m, 1);
				
				var tabla = $ (document.createElement ('tabla'));
				table.addClass ('mes');
				
				/ * Encabezado del mes * /
				var thead = $ (document.createElement ('thead'));
				
				var titleRow = $ (document.createElement ('tr'));
				
				var titleCell = $ (document.createElement ('th'));
				titleCell.addClass ('título-mes');
				titleCell.attr ('colspan', this.options.displayWeekNumber? 8: 7);
				titleCell.text (fechas [this.options.language] .months [m]);
				
				titleRow.append (titleCell);
				thead.append (titleRow);
				
				var headerRow = $ (document.createElement ('tr'));
				
				if (this.options.displayWeekNumber) {
					var weekNumberCell = $ (document.createElement ('th'));
					weekNumberCell.addClass ('número-semana');
					weekNumberCell.text (fechas [this.options.language] .weekShort);
					headerRow.append (weekNumberCell);
				}
				
				var d = fechas [this.options.language] .weekStart;
				hacer
				{
					var headerCell = $ (document.createElement ('th'));
					headerCell.addClass ('día-encabezado');
					headerCell.text (fechas [this.options.language] .daysMin [d]);
					
					headerRow.append (headerCell);
					
					d ++;
					si (d> = 7)
						d = 0;
				}
				while (d! = fechas [this.options.language] .weekStart)
				
				thead.append (headerRow);
				table.append (thead);
				
				/* Dias */
				var currentDate = nueva fecha (firstDate.getTime ());
				var lastDate = nueva fecha (this.options.startYear, m + 1, 0);
				
				var weekStart = fechas [this.options.language] .weekStart
				
				while (currentDate.getDay ()! = weekStart)
				{
					currentDate.setDate (currentDate.getDate () - 1);
				}
				
				while (currentDate <= lastDate)
				{
					var fila = $ (document.createElement ('tr'));
					
					if (this.options.displayWeekNumber) {
						var weekNumberCell = $ (document.createElement ('td'));
						weekNumberCell.addClass ('número-semana');
						weekNumberCell.text (this.getWeekNumber (currentDate));
						row.append (weekNumberCell);
					}
				
					hacer
					{
						var celda = $ (document.createElement ('td'));
						cell.addClass ('día');
						
						if (currentDate <firstDate) {
							cell.addClass ('antiguo');
						}
						else if (currentDate> lastDate) {
							cell.addClass ('nuevo');
						}
						else {
							if ((this.options.minDate! = null && currentDate <this.options.minDate) || (this.options.maxDate! = null && currentDate> this.options.maxDate))
							{
								cell.addClass ('deshabilitado');
							}
							else if (this.options.disabledDays.length> 0) {
								para (var d en this.options.disabledDays) {
									if (currentDate.getTime () == this.options.disabledDays [d] .getTime ()) {
										cell.addClass ('deshabilitado');
										romper;
									}
								}
							}
						
							var cellContent = $ (document.createElement ('div'));
							cellContent.addClass ('contenido del día');
							cellContent.text (currentDate.getDate ());
							cell.append (cellContent);
							
							if (this.options.customDayRenderer) {
								this.options.customDayRenderer (cellContent, currentDate);
							}
						}
						
						row.append (celda);
						
						currentDate.setDate (currentDate.getDate () + 1);
					}
					while (currentDate.getDay ()! = weekStart)
					
					table.append (fila);
				}
				
				monthDiv.append (tabla);
				
				monthsDiv.append (monthDiv);
			}
			
			this.element.append (monthsDiv);
		},
		_renderDataSource: function () {
			var _this = esto;
			if (this.options.dataSource! = null && this.options.dataSource.length> 0) {
				this.element.find ('. mes-contenedor'). each (function () {
					var mes = $ (este) .data ('id-mes');
					
					var firstDate = nueva fecha (_this.options.startYear, month, 1);
					var lastDate = nueva fecha (_this.options.startYear, month + 1, 0);
					
					if ((_ this.options.minDate == null || lastDate> = _this.options.minDate) && (_this.options.maxDate == null || firstDate <= _this.options.maxDate))
					{
						var monthData = [];
					
						para (var i en _this.options.dataSource) {
							if (! (_ this.options.dataSource [i] .startDate> lastDate) || (_this.options.dataSource [i] .endDate <firstDate)) {
								monthData.push (_this.options.dataSource [i]);
							}
						}
						
						if (monthData.length> 0) {
							$ (this) .find ('. day-content'). each (function () {
								var currentDate = new Date (_this.options.startYear, month, $ (this) .text ());
								
								var dayData = [];
								
								if ((_ this.options.minDate == null || currentDate> = _this.options.minDate) && (_this.options.maxDate == null || currentDate <= _this.options.maxDate))
								{
									para (var i en monthData) {
										if (monthData [i] .startDate <= currentDate && monthData [i] .endDate> = currentDate) {
											dayData.push (monthData [i]);
										}
									}
									
									if (dayData.length> 0)
									{
										_this._renderDataSourceDay ($ (esto), currentDate, dayData);
									}
								}
							});
						}
					}
				});
			}
		},
		_renderDataSourceDay: function (elt, currentDate, events) {
			cambiar (this.options.style)
			{
				caso 'borde':
					var peso = 0;
			
					if (events.length == 1) {
						peso = 4;
					}
					else if (events.length <= 3) {
						peso = 2;
					}
					else {
						elt.parent (). css ('caja-sombra', 'recuadro 0 -4px 0 0 negro');
					}
					
					si (peso> 0)
					{
						var boxShadow = '';
					
						para (var i en eventos)
						{
							if (boxShadow! = '') {
								boxShadow + = ",";
							}
							
							boxShadow + = 'inset 0 -' + (parseInt (i) + 1) * peso + 'px 0 0' + eventos [i] .color;
						}
						
						elt.parent (). css ('sombra de caja', sombra de caja);
					}
					romper;
			
				caso 'fondo':
					elt.parent (). css ('color de fondo', eventos [events.length - 1] .color);
					
					var currentTime = currentDate.getTime ();
					
					if (eventos [events.length - 1] .startDate.getTime () == currentTime)
					{
						elt.parent (). addClass ('día-inicio');
						
						if (events [events.length - 1] .startHalfDay || this.options.alwaysHalfDay) {
							elt.parent (). addClass ('medio día');
							
							// Encuentra el color de la otra mitad
							var otherColor = 'transparente';
							para (var i = events.length - 2; i> = 0; i--) {
								if (eventos [i] .startDate.getTime ()! = currentTime || (! events [i] .startHalfDay &&! this.options.alwaysHalfDay)) {
									otherColor = eventos [i] .color;
									romper;
								}
							}
							
							elt.parent (). css ('background', 'linear-gradient (-45deg,' + events [events.length - 1] .color + ',' + events [events.length - 1] .color + '49 %, '+ otroColor +' 51%, '+ otroColor +') ');
						}
						else if (this.options.roundRangeLimits) {
							elt.parent (). addClass ('redondo a la izquierda');
						}
					}
					else if (eventos [events.length - 1] .endDate.getTime () == currentTime)
					{
						elt.parent (). addClass ('fin de día');
						
						if (events [events.length - 1] .endHalfDay || this.options.alwaysHalfDay) {
							elt.parent (). addClass ('medio día');
							
							// Encuentra el color de la otra mitad
							var otherColor = 'transparente';
							para (var i = events.length - 2; i> = 0; i--) {
								if (events [i] .endDate.getTime ()! = currentTime || (! events [i] .endHalfDay &&! this.options.alwaysHalfDay)) {
									otherColor = eventos [i] .color;
									romper;
								}
							}
							
							elt.parent (). css ('background', 'linear-gradient (135deg,' + events [events.length - 1] .color + ',' + events [events.length - 1] .color + '49% , '+ otroColor +' 51%, '+ otroColor +') ');
						}
						else if (this.options.roundRangeLimits) {
							elt.parent (). addClass ('redondo a la derecha');
						}
					}
					romper;
					
				caso 'personalizado':
					if (this.options.customDataSourceRenderer) {
						this.options.customDataSourceRenderer.call (this, elt, currentDate, eventos);
					}
					romper;
			}
		},
		_applyEvents: function () {
			var _this = esto;
			
			/ * Botones de encabezado * /
			this.element.find ('. año-vecino,. año-vecino2'). click (function () {
				if (! $ (this) .hasClass ('deshabilitado')) {
					_this.setYear (parseInt ($ (esto) .text ()));
				}
			});
			
			this.element.find ('. calendar-header .prev'). click (function () {
				if (! $ (this) .hasClass ('deshabilitado')) {
					_this.element.find ('. months-container'). animate ({'margin-left': '100%'}, 100, function () {
						_this.element.find ('. contenedor-meses'). hide ();
						_this.element.find ('. months-container'). css ('margin-left', '0');
						setTimeout (function () {_this.setYear (_this.options.startYear - 1)}, 50);
					});
				}
			});
			
			this.element.find ('. calendar-header .next'). click (function () {
				if (! $ (this) .hasClass ('deshabilitado')) {
					_this.element.find ('. months-container'). animate ({'margin-left': '- 100%'}, 100, function () {
						_this.element.find ('. contenedor-meses'). hide ();
						_this.element.find ('. months-container'). css ('margin-left', '0');
						setTimeout (function () {_this.setYear (_this.options.startYear + 1)}, 50);
					});
				}
			});
			
			var celdas = this.element.find ('. día: no (.old, .new, .disabled)');
			
			/ * Haga clic en la fecha * /
			celdas.click (función (e) {
				e.stopPropagation ();
				var date = _this._getDate ($ (esto));
				_this._triggerEvent ('clickDay', {
					elemento: $ (esto),
					cual: e. cual,
					fecha: fecha,
					eventos: _this.getEvents (fecha)
				});
			});
			
			/ * Haga clic derecho en la fecha * /
			
			cell.bind ('contextmenu', function (e) {
				si (_this.options.enableContextMenu)
				{
					e.preventDefault ();
					if (_this.options.contextMenuItems.length> 0)
					{
						_this._openContextMenu ($ (esto));
					}
				}
					
				var date = _this._getDate ($ (esto));
				_this._triggerEvent ('dayContextMenu', {
					elemento: $ (esto),
					fecha: fecha,
					eventos: _this.getEvents (fecha)
				});
			});
			
			/ * Selección de rango * /
			if (this.options.enableRangeSelection) {
				celdas.mousedown (función (e) {
					if (e.which == 1) {
						var currentDate = _this._getDate ($ (esto));
					
						if (_this.options.allowOverlap || _this.getEvents (currentDate) .length == 0)
						{
							_this._mouseDown = true;
							_this._rangeStart = _this._rangeEnd = currentDate;
							_this._refreshRange ();
						}
					}
				});

				cell.mouseenter (función (e) {
					si (_this._mouseDown) {
						var currentDate = _this._getDate ($ (esto));
						
						if (! _ this.options.allowOverlap)
						{
							var newDate = nueva fecha (_this._rangeStart.getTime ());
							
							if (newDate <currentDate) {
								var nextDate = new Date (newDate.getFullYear (), newDate.getMonth (), newDate.getDate () + 1);
								while (newDate <currentDate) {
									if (_this.getEvents (nextDate) .length> 0)
									{
										romper;
									}
								
									newDate.setDate (newDate.getDate () + 1);
									nextDate.setDate (nextDate.getDate () + 1);
								}
							}
							else {
								var nextDate = new Date (newDate.getFullYear (), newDate.getMonth (), newDate.getDate () - 1);
								while (newDate> currentDate) {
									if (_this.getEvents (nextDate) .length> 0)
									{
										romper;
									}
								
									newDate.setDate (newDate.getDate () - 1);
									nextDate.setDate (nextDate.getDate () - 1);
								}
							}
							
							currentDate = newDate;
						}
					
						var oldValue = _this._rangeEnd;
						_this._rangeEnd = currentDate;

						if (oldValue.getTime ()! = _this._rangeEnd.getTime ()) {
							_this._refreshRange ();
						}
					}
				});

				$ (ventana) .mouseup (función (e) {
					si (_this._mouseDown) {
						_this._mouseDown = falso;
						_this._refreshRange ();

						var minDate = _this._rangeStart <_this._rangeEnd? _this._rangeStart: _this._rangeEnd;
						var maxDate = _this._rangeEnd> _this._rangeStart? _this._rangeEnd: _this._rangeStart;

						_this._triggerEvent ('selectRange', {startDate: minDate, endDate: maxDate});
					}
				});
			}
		
			/ * Fecha de desplazamiento * /
			cell.mouseenter (función (e) {
				si (! _ this._mouseDown)
				{
					var date = _this._getDate ($ (esto));
					_this._triggerEvent ('mouseOnDay', {
						elemento: $ (esto),
						fecha: fecha,
						eventos: _this.getEvents (fecha)
					});
				}
			});
			
			cell.mouseleave (function (e) {
				var date = _this._getDate ($ (esto));
				_this._triggerEvent ('mouseOutDay', {
					elemento: $ (esto),
					fecha: fecha,
					eventos: _this.getEvents (fecha)
				});
			});
			
			/ * Gestión receptiva * /
			
			setInterval (function () {
				var calendarSize = $ (_ this.element) .width ();
				var monthSize = $ (_ this.element) .find ('. month'). first (). width () + 10;
				var monthContainerClass = 'mes-contenedor';
				
				if (monthSize * 6 <calendarSize) {
					monthContainerClass + = 'col-xs-2';
				}
				else if (monthSize * 4 <calendarSize) {
					monthContainerClass + = 'col-xs-3';
				}
				else if (monthSize * 3 <calendarSize) {
					monthContainerClass + = 'col-xs-4';
				}
				else if (monthSize * 2 <calendarSize) {
					monthContainerClass + = 'col-xs-6';
				}
				else {
					monthContainerClass + = 'col-xs-12';
				}
				
				$ (_ this.element) .find ('. mes-contenedor'). attr ('clase', mesContainerClass);
			}, 300);
		},
		_refreshRange: function () {
			var _this = esto;
		
            this.element.find ('td.day.range'). removeClass ('rango')
            this.element.find ('td.day.range-start'). removeClass ('range-start');
            this.element.find ('td.day.range-end'). removeClass ('range-end');

            if (this._mouseDown) {
                var beforeRange = true;
                var afterRange = false;
                var minDate = _this._rangeStart <_this._rangeEnd? _this._rangeStart: _this._rangeEnd;
                var maxDate = _this._rangeEnd> _this._rangeStart? _this._rangeEnd: _this._rangeStart;

                this.element.find ('. mes-contenedor'). each (function () {
					var monthId = $ (this) .data ('id-mes');
                    if (minDate.getMonth () <= monthId && maxDate.getMonth ()> = monthId) {
                        $ (esto) .find ('td.day:not (.old, .new)'). each (function () {
                            var date = _this._getDate ($ (esto));
                            if (fecha> = minDate && date <= maxDate) {
                                $ (esto) .addClass ('rango');

                                if (date.getTime () == minDate.getTime ()) {
                                    $ (esto) .addClass ('rango-inicio');
                                }

                                if (date.getTime () == maxDate.getTime ()) {
                                    $ (esto) .addClass ('rango-fin');
                                }
                            }
                        });
                    }
                });
            }
        },
		_openContextMenu: function (elt) {
			var contextMenu = $ ('. calendario-menú-contextual');
			
			if (contextMenu.length> 0) {
				contextMenu.hide ();
				contextMenu.empty ();
			}
			else {
				contextMenu = $ (document.createElement ('div'));
				contextMenu.addClass ('calendario-menú-contextual');
				$ ('cuerpo'). append (contextMenu);
			}
			
			var date = this._getDate (elt);
			var eventos = this.getEvents (fecha);
			
			para (var i en eventos) {
				var eventItem = $ (document.createElement ('div'));
				eventItem.addClass ('elemento');
				eventItem.css ('borde izquierdo', 'sólido 4px' + eventos [i] .color);
				
				var eventItemContent = $ (document.createElement ('div'));
				eventItemContent.addClass ('contenido');
				eventItemContent.text (eventos [i] .name);
				
				eventItem.append (eventItemContent);
				
				var icon = $ (document.createElement ('intervalo'));
				icon.addClass ('glyphicon glyphicon-chevron-right');
				
				eventItem.append (icono);
				
				this._renderContextMenuItems (eventItem, this.options.contextMenuItems, eventos [i]);
				
				contextMenu.append (eventItem);
			}
			
			if (contextMenu.children (). length> 0)
			{
				contextMenu.css ('izquierda', elt.offset (). izquierda + 25 + 'px');
				contextMenu.css ('arriba', elt.offset (). top + 25 + 'px');
				contextMenu.show ();
				
				$ (ventana) .one ('mouseup', function () {
					contextMenu.hide ();
				});
			}
		},
		_renderContextMenuItems: function (parent, items, evt) {
			var subMenu = $ (document.createElement ('div'));
			subMenu.addClass ('submenú');
			
			para (var i en elementos) {
				if (! items [i] .visible || items [i] .visible (evt)) {
					var menuItem = $ (document.createElement ('div'));
					menuItem.addClass ('elemento');
					
					var menuItemContent = $ (document.createElement ('div'));
					menuItemContent.addClass ('contenido');
					menuItemContent.text (elementos [i] .text);
					
					menuItem.append (menuItemContent);
					
					if (items [i] .click) {
						(función (índice) {
							menuItem.click (function () {
								elementos [índice] .click (evt);
							});
						})(yo);
					}
					
					var icon = $ (document.createElement ('intervalo'));
					icon.addClass ('glyphicon glyphicon-chevron-right');
					
					menuItem.append (icono);
					
					if (items [i] .items && items [i] .items.length> 0) {
						this._renderContextMenuItems (menuItem, items [i] .items, evt);
					}
					
					subMenu.append (menuItem);
				}
			}
			
			if (subMenu.children (). length> 0)
			{
				parent.append (subMenu);
			}
		},
		_getColor: function (colorString) {
			var div = $ ('<div />');
			div.css ('color', colorString);
			
		},
		_getDate: function (elt) {
			var day = elt.children ('. day-content'). text ();
			var mes = elt.closest ('. mes-contenedor'). datos ('id-mes');
			var year = this.options.startYear;

			return new Date (año, mes, día);
		},
		_triggerEvent: function (eventName, parámetros) {
			var event = $ .Event (eventName);
			
			para (var i en parámetros) {
				evento [i] = parámetros [i];
			}
			
			this.element.trigger (evento);
		},
		getWeekNumber: function (date) {
			var tempDate = nueva fecha (date.getTime ());
			tempDate.setHours (0, 0, 0, 0);
			tempDate.setDate (tempDate.getDate () + 3 - (tempDate.getDay () + 6)% 7);
			var week1 = nueva fecha (tempDate.getFullYear (), 0, 4);
			return 1 + Math.round (((tempDate.getTime () - week1.getTime ()) / 86400000 - 3 + (week1.getDay () + 6)% 7) / 7);
		},
		getEvents: function (date) {
			var eventos = [];
			
			if (this.options.dataSource && date) {
				para (var i en this.options.dataSource) {
					if (this.options.dataSource [i] .startDate <= fecha && this.options.dataSource [i] .endDate> = fecha) {
						events.push (this.options.dataSource [i]);
					}
				}
			}
			
			eventos de retorno;
		},
		getYear: function () {
			return this.options.startYear;
		},
		setYear: function (año) {
			var parsedYear = parseInt (año);
			if (! isNaN (parsedYear)) {
				this.options.startYear = parsedYear;
				this._render ();
			}
		},
		getMinDate: function () {
			return this.options.minDate;
		},
		setMinDate: function (date) {
			if (date instanceof Date) {
				this.options.minDate = fecha;
				this._render ();
			}
		},
		getMaxDate: function () {
			return this.options.maxDate;
		},
		setMaxDate: function (fecha) {
			if (date instanceof Date) {
				this.options.maxDate = fecha;
				this._render ();
			}
		},
		getStyle: function () {
			devuelve this.options.style;
		},
		setStyle: function (estilo) {
			this.options.style = style == 'background' || estilo == 'borde' || estilo == 'personalizado'? estilo: 'borde';
			this._render ();
		},
		getAllowOverlap: function () {
			return this.options.allowOverlap;
		},
		setAllowOverlap: function (allowOverlap) {
			this.options.allowOverlap = allowOverlap;
		},
		getDisplayWeekNumber: function () {
			return this.options.displayWeekNumber;
		},
		setDisplayWeekNumber: function (displayWeekNumber) {
			this.options.displayWeekNumber = displayWeekNumber;
			this._render ();
		},
		getAlwaysHalfDay: function () {
			return this.options.alwaysHalfDay;
		},
		setAlwaysHalfDay: function (alwaysHalfDay) {
			this.options.alwaysHalfDay = alwaysHalfDay;
			this._render ();
		},
		getEnableRangeSelection: function () {
			return this.options.enableRangeSelection;
		},
		setEnableRangeSelection: function (enableRangeSelection) {
			this.options.enableRangeSelection = enableRangeSelection;
			this._render ();
		},
		getDisabledDays: function () {
			return this.options.disabledDays;
		},
		setDisabledDays: function (disabledDays) {
			this.options.disabledDays = disabledDays instancia de Array? disabledDays: [];
			this._render ();
		},
		getRoundRangeLimits: function () {
			return this.options.roundRangeLimits;
		},
		setRoundRangeLimits: function (roundRangeLimits) {
			this.options.roundRangeLimits = roundRangeLimits;
			this._render ();
		},
		getEnableContextMenu: function () {
			return this.options.enableContextMenu;
		},
		setEnableContextMenu: function (enableContextMenu) {
			this.options.enableContextMenu = enableContextMenu;
			this._render ();
		},
		getContextMenuItems: function () {
			return this.options.contextMenuItems;
		},
		setContextMenuItems: function (contextMenuItems) {
			this.options.contextMenuItems = contextMenuItems instancia de Array? contextMenuItems: [];
			this._render ();
		},
		getCustomDayRenderer: function () {
			return this.options.customDayRenderer;
		},
		setCustomDayRenderer: function (customDayRenderer) {
			this.options.customDayRenderer = $ .isFunction (customDayRenderer)? customDayRenderer: null;
			this._render ();
		},
		getCustomDataSourceRenderer: function () {
			return this.options.customDataSourceRenderer;
		},
		setCustomDataSourceRenderer: function (customDataSourceRenderer) {
			this.options.customDataSourceRenderer = $ .isFunction (customDataSourceRenderer)? customDataSourceRenderer: null;
			this._render ();
		},
		getLanguage: function () {
			devuelve this.options.language;
		},
		setLanguage: function (language) {
			if (idioma! = nulo && fechas [idioma]! = nulo) {
				this.options.language = idioma;
				this._render ();
			}
		},
		getDataSource: function () {
			return this.options.dataSource;
		},
		setDataSource: function (dataSource) {
			this.options.dataSource = instancia de origen de datos de Array? fuente de datos : [];
			this._initializeDatasourceColors ();
			this._render ();
		},
		addEvent: function (evt) {
			this.options.dataSource.push (evt);
			this._render ();
		}
	}
 
	$ .fn.calendar = function (opciones) {
		var calendar = new Calendar ($ (esto), opciones);
		$ (esto) .data ('calendario', calendario);
		calendario de devolución;
	}
	
	/ * Gestión de enlace de eventos * /
	$ .fn.renderEnd = function (fct) {$ (this) .bind ('renderEnd', fct); }
	$ .fn.clickDay = function (fct) {$ (this) .bind ('clickDay', fct); }
	$ .fn.dayContextMenu = function (fct) {$ (this) .bind ('dayContextMenu', fct); }
	$ .fn.selectRange = function (fct) {$ (this) .bind ('selectRange', fct); }
	$ .fn.mouseOnDay = function (fct) {$ (this) .bind ('mouseOnDay', fct); }
	$ .fn.mouseOutDay = function (fct) {$ (this) .bind ('mouseOutDay', fct); }
	
	var fechas = $ .fn.calendar.dates = {
		en: {
			días: ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado", "domingo"],
			daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
			daysMin: ["Do", "Mo", "Tu", "Nosotros", "Ju", "Fr", "Sa", "Do"],
			meses: ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre" ],
			meses Corto: ["Ene", "Feb", "Mar", "Abr", "Mayo", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
			weekShort: 'W',
			semana Inicio: 0
		}
	};
	
	var colors = $ .fn.calendar.colors = ['# 2C8FC9', '# 9CB703', '# F5BB00', '# FF4A32', '# B56CE2', '# 45A597'];
	
	$ (función () {
		$ ('[data-provide = "calendar"]'). each (function () {
			$ (este) .calendar ();
		});
	});
 } (window.jQuery));