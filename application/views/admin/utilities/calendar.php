<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link rel="stylesheet" type="text/css" id="full-calendar-css" href="<?= base_url() ?>/assets/plugins/fullcalendar/fullcalendar.min.css?v=2.4.4">
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
		<div class="row">
		<?php
			$_SESSION['staff']= ($staffs);
			$_SESSION['cars']= ($cars);
			$_SESSION['lieferanten']= ($lieferanten);
		?>

			<div class="col-xs-10 col-md-10">

				<div class="panel_s">
					<div class="panel-body" style="overflow-x: auto;">
						<div class="dt-loader hide"></div>

						<?php
						if(has_permission('personalplan', get_user_id(), 'view') || 1==1){
							$this->load->view('admin/utilities/calendar_filters');
						}
						?>
						<div id="calendar"></div>
					</div>
				</div>
			</div>


			<?php
				if(has_permission('personalplan', get_user_id(), 'edit') || is_admin() || 1==1){
					echo'<div class="col-xs-2 col-md-2 hide-block">
							<div class="panel_s">
								<div class="panel-body" style="overflow-x: auto;">
						';
									$this->load->view('admin/utilities/calendar_empsidelist');

					echo'		</div>
							</div>
						</div>
						';
				}
			?>
		</div>
	</div>
</div>
</div>
<div id="_task"></div>
<div id="_edit_event"></div>
<input type="hidden" name="drag_drop_elt_id" id="drag_drop_elt_id">
<input type="hidden" name="drag_drop_elt_type" id="drag_drop_elt_type">
<?php $this->load->view('admin/utilities/calendar_template'); ?>
<?php $this->load->view('admin/utilities/calendar_choose'); ?>

<!--?php $this->load->view('admin/utilities/calendar_task'); ?-->

<script>
	app.calendarIDs = '<?php echo json_encode($google_ids_calendars); ?>';
</script>


<?php init_tail(); ?>

<script type="text/javascript" id="moment-js" src="<?= base_url() ?>/assets/builds/moment.min.js"></script>
<script type="text/javascript" id="full-calendar-min-js" src="<?= base_url() ?>/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" id="full-calendar-lang-js" src="<?= base_url() ?>/assets/plugins/fullcalendar/locale/de.js"></script>
<script>
	$(function(){

            /* scan individual table and set "cellPos" data in the form { left: x-coord, top: y-coord } */
            function scanTable( $table ) {
                var m = [];
                $table.children( "tr" ).each( function( y, row ) {
                    $( row ).children( "td, th" ).each( function( x, cell ) {
                        var $cell = $( cell ),
                            cspan = $cell.attr( "colspan" ) | 0,
                            rspan = $cell.attr( "rowspan" ) | 0,
                            tx, ty;
                        cspan = cspan ? cspan : 1;
                        rspan = rspan ? rspan : 1;
                        for( ; m[y] && m[y][x]; ++x );  //skip already occupied cells in current row
                        for( tx = x; tx < x + cspan; ++tx ) {  //mark matrix elements occupied by current cell with true
                            for( ty = y; ty < y + rspan; ++ty ) {
                                if( !m[ty] ) {  //fill missing rows
                                    m[ty] = [];
                                }
                                m[ty][tx] = true;
                            }
                        }
                        var pos = { top: y, left: x };
                        $cell.data( "cellPos", pos );
                    } );
                } );
            };

            /* plugin */
            $.fn.cellPos = function( rescan ) {
                var $cell = this.first(),
                    pos = $cell.data( "cellPos" );
                if( !pos || rescan ) {
                    var $table = $cell.closest( "table, thead, tbody, tfoot" );
                    scanTable( $table );
                }
                pos = $cell.data( "cellPos" );
                return pos;
            }




        var calendar_selector = $('#calendar'),
            calendar_selector_d = $('#calendar_dsqs');
        if (calendar_selector.length > 0 || 1==1) {
            //validate_calendar_form();
            var calendar_settings = {

                eventAfterAllRender: function (view) {

                    var row, cell, date;

                    // First iterate over each calendar row
                    $('.fc-content-skeleton').each(function(i) {
                        row = $(this);
                        // Now iterate over each header cell within this row latter dragDrop_event
                        $('tbody td', row).each(function(k) {
                            cell = $(this);
                            cell.attr('ondrop',"dragDrop_event(event)" );
                            cell.attr('data-col',$(this).cellPos().left  );
                            cell.attr('ondragover',"allowDrop(event)");

                        });
                    });
                    $('.table-bordered').parent('div.fc-bg').each(function(i) {
                        row = $(this);
                        // Now iterate over each header cell within this row
                        $('tbody td', row).each(function(k1) {
                            cell = $(this);
                            cell.attr('ondrop',"dragDrop(event)" );
                            cell.attr('ondragover',"allowDrop(event)");
                        });
                    });

                },
                locale: 'de',
                themeSystem: 'bootstrap4',
                customButtons: {},
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,viewFullCalendar,calendarFilter'
                },
                editable: false,
                eventLimit: parseInt(app.options.calendar_events_limit) + 1,

                views: {
                    day: {
                        eventLimit: false
                    }
                },
                defaultView: app.options.default_view_calendar,
                isRTL: false,
                eventStartEditable: false,
                timezone: app.options.timezone,
                firstDay: 0,
                year: moment.tz(app.options.timezone).format("YYYY"),
                month: moment.tz(app.options.timezone).format("M"),
                date: moment.tz(app.options.timezone).format("DD"),
                loading: function (isLoading, view) {
                    isLoading && $('#calendar .fc-header-toolbar .btn-default').addClass('btn-info').removeClass('btn-default').css('display', 'block');
                    !isLoading ? $('.dt-loader').addClass('hide') : $('.dt-loader').removeClass('hide');
                },
                eventSources: [{
                    url: admin_url + 'utilities/get_calendar_data',
                    data: function () {
                        var params = {};
                        $('#calendar_filters').find('input:checkbox:checked').map(function () {
                            params[$(this).attr('name')] = true;
                        }).get();
                        if (!jQuery.isEmptyObject(params)) {
                            params['calendar_filters'] = true;
                        }
                        return params;
                    },
                    type: 'POST',
                    error: function () {
                        console.error('There was error fetching calendar data');
                    },
                },],
                eventLimitClick: function (cellInfo, jsEvent) {
                    $('#calendar').fullCalendar('gotoDate', cellInfo.date);
                    $('#calendar').fullCalendar('changeView', 'basicDay');
                },
                eventRender: function (event, element) {
                    element.attr('title', event._tooltip);
                    element.attr('onclick', event.onclick);
                    element.attr('data-toggle', 'tooltip');
                    if (!event.url) {
                        element.attr('data-id', event.eventid);
                        element.click(function () {
                            view_event(event.eventid);
                        });
                    }
                },
                dayClick: function (date, jsEvent, view) {
                    $('#chooseEventModel').modal('show');
                    var d = date.format();
                    if (!$.fullCalendar.moment(d).hasTime()) {
                        d += ' 00:00';
                    }
                    if(jsEvent.target.tagName != "SPAN"){
                        var vformat = 'd.m.yy H:i';
                        var fmt = new DateFormatter();
                        var d1 = fmt.formatDate(new Date(d), vformat);
                        localStorage.setItem('startdate',d1)

                        $("input[name='start'].datetimepicker").val(d1);
                        //$('#newEventModal').modal('show');
                    }
                    return false;
                }
            };
            if ($("body").hasClass('dashboard')) {
                calendar_settings.customButtons.viewFullCalendar = {
                    text: app.lang.calendar_expand,
                    click: function () {
                        window.location.href = admin_url + 'utilities/calendar';
                    }
                };
            }
            calendar_settings.customButtons.calendarFilter = {
                text: 'filtere nach',
                click: function () {
                    slideToggle('#calendar_filters');
                }
            };
            if (app.user_is_staff_member == 1) {

                if (app.options.google_api !== '') {

                    calendar_settings.googleCalendarApiKey = app.options.google_api;
                }
                if (app.calendarIDs !== '') {

                    app.calendarIDs = JSON.parse(app.calendarIDs);
                    if (app.calendarIDs.length != 0) {

                        if (app.options.google_api !== '') {
                            for (var i = 0; i < app.calendarIDs.length; i++) {
                                var _gcal = {};
                                _gcal.googleCalendarId = app.calendarIDs[i];
                                calendar_settings.eventSources.push(_gcal);
                            }
                        } else {
                            console.error('You have setup Google Calendar IDs but you dont have specified Google API key. To setup Google API key navigate to Setup->Settings->Google');
                        }
                    }
                }
            }
            // Init calendar
            calendar_selector.fullCalendar(calendar_settings);
            var new_event = get_url_param('new_event');
            if (new_event) {
                localStorage.setItem('startdate',get_url_param('date'));
                //$("input[name='startdate']").val(get_url_param('date'));
                $("input[name='start'].datetimepicker").val(get_url_param('date'));
                $('#newEventModal').modal('show');
            }
        }

        if(get_url_param('eventid')) {
			view_event(get_url_param('eventid'));
		}
	});


	// Drag and Drop Js
    function allowDrop(ev) {
		ev.preventDefault();
		//alert("The cursor just exited the " + ev.relatedTarget+ " element.");
    }

    function dragStart(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
        $("#drag_drop_elt_type").val($(ev.target).data('type'));
        $("#drag_drop_elt_id").val($(ev.target).data('set'));
    }

  // function use to drop event on empty block
    function dragDrop(ev) {
		ev.preventDefault();
		var data1 = ev.dataTransfer.getData("text");



		if (ev.target.tagName != 'TD') {
			alert(" drag drop Vorbeikommen Ereignisfunktionalität ist erwartete Funktionalität");
		}
		else{
			appchild = ev.target.appendChild(document.getElementById(data1).cloneNode(true));
				$(appchild).removeClass('buttonlike').addClass('buttondragged ');

			if($(ev.target).find("div[id^=car_]").length>0){
                var id = $("#drag_drop_elt_id").val();
                $(ev.target)
                url = admin_url + 'tasks/task';
                // show loader
                $('#taksLoader').show();
                requestGet(url).done(function (response) {

                    $('#_task').html(response);
                    $("body").find('#_task_modal').modal({show: true, backdrop: 'static'});
                    $('#taksLoader').hide();
                    //set Cliecked Data in task modal
                    setTimeout(() => {
                        $("input[name='startdate']").val(localStorage.getItem('startdate'));

                    var valF = JSON.parse(localStorage.getItem('taskfor'));
                    $('select[name="car"]').val(id).trigger('change');;

                    init_selectpicker();

                }, 900);

                }).fail(function (error) {
                    alert_float('danger', error.responseText);
                    $('#taksLoader').hide();
                })

            }else {
				//for company
				if($(ev.target).find("div[id^=company_]").length>0){
					window.location.href='<?=admin_url()?>lieferanten/lieferanten';
					////break;
				}else{


					var tar_date = $(ev.target).attr('data-date');
					var elemid = [];
					for(var i=0; i<$(ev.target).find("div[id^=emp_]").length; i++){
						elemid.push($(ev.target).find("div[id^=emp_]")[i].dataset.set);
					}

					$('#chooseEventModel').modal('show');

					setTimeout(() => {
						if (!$.fullCalendar.moment(tar_date).hasTime()) {
							tar_date += ' 00:00';
						}
						var vformat = 'd.m.yy H:i';
						var fmt = new DateFormatter();
						var d1 = fmt.formatDate(new Date(tar_date), vformat);
                        $('#start').val(d1);
						// Task
						localStorage.setItem('startdate', d1);
						localStorage.setItem('taskfor',JSON.stringify(elemid));

						// Event
						$("input[name='start'].datetimepicker").val(d1);
						if($('select[name="user[]"]').length>0){
							$('select[name="user[]"]').val(elemid).trigger('change');
						}


					}, 100);
				}
			}
		}

	}


// function use to drop event on tasked box will optimize this code latter
	function dragDrop_event(ev) {

    	ev.preventDefault();
		var data1 = ev.dataTransfer.getData("text");
		if (ev.target.tagName != 'TD') {
			if($(ev.target).parent().attr('data-id')  && ev.target.tagName == 'DIV' ){
				appchild = ev.target.appendChild(document.getElementById(data1).cloneNode(true));
				$(appchild).removeClass('buttonlike').addClass('buttondragged');
				var eventIDAjax = $(ev.target).parent().attr('data-id');
				alert(ev.target.tagName);

				$.post(admin_url + 'utilities/view_event/' + eventIDAjax).done(function (response) {
						$('#event').html('');
						$('#event').html(response);
						$('#viewEvent').modal('show');
						init_datepicker();
                        init_selectpicker();


						var elemid = [];

							setTimeout(() => {
								if($('#viewEvent select[name="user[]"]').length>0){
								elemid =  $('#viewEvent select[name="user[]"]').val();
									//alert($('#viewEvent select[name="user[]"]').val());
									//alert(elemid);
									for(var i=0; i<$(ev.target).find("div[id^=emp_]").length; i++){
										elemid.push($(ev.target).find("div[id^=emp_]")[i].dataset.set);
									}
									//alert(elemid);
									$('#viewEvent select[name="user[]"]').val(elemid).trigger('change');
								}
						}, 900);

				});
			}else {
                var click_event=$(ev.target).closest('td').find('a').attr('onclick');
                if(click_event.includes('task'))
                {
                    var type= $("#drag_drop_elt_type").val();

                    var id_attr = $(ev.target).closest('td').find('a').attr('onclick');
                    var id_task = Number(id_attr.match(/\d+/)[0]);
                    var id_emp = Number(data1.substring(4));
                    var id =  $("#drag_drop_elt_id").val();
                    if ( type == "emp")
                    {

                        $.post(admin_url + 'utilities/assigntasktouser/',{user_id:id_emp,task_id:id_task}).done(function (response) {
                            $(ev.target).click();
                        });
                    }
                    if ( type == "car")
                    {

                        $.post(admin_url + 'utilities/assigntasktocar/',{car_id:id,task_id:id_task}).done(function (response) {
                            $(ev.target).click();
                        });
                    }
                    if ( type == "company")
                    {

                        $.post(admin_url + 'utilities/assigntasktocompany/',{company_id:id,task_id:id_task}).done(function (response) {
                            $(ev.target).click();
                        });
                    }

                }
                else
                {
                    var id_attr = $(ev.target).closest('td').find('a').attr('onclick');
                    var id_event = Number(id_attr.match(/\d+/)[0]);;
                    var id_emp = Number(data1.substring(4));

                    $.post(admin_url + 'utilities/assigneventtouser/',{user_id:id_emp,event_id:id_event}).done(function (response) {
                        $(ev.target).click();
                    });
                }
			}

		}
		else {
			appchild = ev.target.appendChild(document.getElementById(data1).cloneNode(true));
			$(appchild).removeClass('buttonlike').addClass('buttondragged');

			if($(ev.target).find("div[id^=car_]").length>0){
                var id = $("#drag_drop_elt_id").val();
                $(ev.target)
                url = admin_url + 'task/task';
                // show loader
                $('#taksLoader').show();
                requestGet(url).done(function (response) {

                    $('#_task').html(response);
                    $("body").find('#_task_modal').modal({show: true, backdrop: 'static'});
                    $('#taksLoader').hide();
                    //set Cliecked Data in task modal
                    setTimeout(() => {
                        $("input[name='startdate']").val(localStorage.getItem('startdate'));

                    var valF = JSON.parse(localStorage.getItem('taskfor'));
                    $('select[name="car"]').val(id).trigger('change');;

                    init_selectpicker();

                }, 900);

                }).fail(function (error) {
                    alert_float('danger', error.responseText);
                    $('#taksLoader').hide();
                })

            }else{
				//for company
				if($(ev.target).find("div[id^=company_]").length>0){
						window.location.href='<?=admin_url()?>/lieferanten/lieferanten';
						//break;
				}else{

					var th  = $(ev.target).parent().parent().parent().find('thead td').eq($(ev.target).data('col'));
					var tar_date = $(th).attr('data-date');
					var elemid = [];
					for(var i=0; i<$(ev.target).find("div[id^=emp_]").length; i++){
						elemid.push($(ev.target).find("div[id^=emp_]")[i].dataset.set);
					}
					$('#chooseEventModel').modal('show');
					//$('#newEventModal').modal('show');
					//alert('droped row -' + (parseInt($(ev.target).parents('td').index()) + 1));
					//alert(elemid);
					setTimeout(() => {

						if (!$.fullCalendar.moment(tar_date).hasTime()) {
							tar_date += ' 00:00';
						}
						var vformat = 'd.m.yy H:i' ;
						var fmt = new DateFormatter();
						var d1 = fmt.formatDate(new Date(tar_date), vformat);

						// Task
						localStorage.setItem('startdate', d1);
                         $('#start').val(d1);
						localStorage.setItem('taskfor',JSON.stringify(elemid));

						// Event
						//$("input[name='start'].datetimepicker").val(d1);
						if($('select[name="user[]"]').length>0){
							$('select[name="user[]"]').val(elemid).trigger('change');
						}



					}, 100);
				}
			}

		}
    }

    function closebox(ev){
    {
        $(ev.srcElement).parent('div').remove()
        return false;
	};

};

$(".switch").change(function() {
    if ( $("#select-mf").is(':checked') ) {
		$('#fh-1, #vehicle_list').hide();
		$('#mh-1, #employee_list').show();


    } else {
		$('#mh-1, #employee_list').hide();
		$('#fh-1, #vehicle_list').show();

    }
});

$(".switchS").change(function() {
		$('.listc').hide();
		$('#'+$(this).val()).show();


});

</script>
</body>
</html>
