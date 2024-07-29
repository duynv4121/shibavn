<?php  
include('top.php');
?>
<link href='../calendar_lib/assets/css/fullcalendar.css' rel='stylesheet' />
<link href='../calendar_lib/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<style>

/*	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
		background-color: #DDDDDD;
	}*/

	

	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		text-align: left;
	}

	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}

	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
	}

	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
	}

	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		margin: 0 auto;
		/*width: 900px;*/
		background-color: #FFFFFF;
		border-radius: 6px;
		box-shadow: 0 1px 2px #C3C3C3;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div id='calendar'></div>
			
		</div>
	</div>

	<div style='clear:both'></div>
</div>

<?php  
include('footer.php');
?>
<!-- <script src='../calendar_lib/assets/js/jquery-1.10.2.js' type="text/javascript"></script>
	<script src='../calendar_lib/assets/js/jquery-ui.custom.min.js' type="text/javascript"></script> -->
	<script src='../calendar_lib/assets/js/fullcalendar.js' type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();
			var code = [];

			
			$.ajax({
		      url: '../controller/ajax.php',
		      type: 'POST',
		      data: {
		        action: 'getCalender'
		      },
		      async: false,
		      cache: false,
		      success: function(result){
		      	console.log(1);
		      	for(var i = 0; i < result.length; i++){
	      			let string = result[i][1];
	      			let temp = 
		      			{
		      				id: `${result[i][0]}`,
							title: `${result[i][1]}`,
							start: new Date(`${result[i][2]}`),
							allDay: false,
							className: `info clickhere${result[i][0]}`,
							url: `edit_calendar.php?id=${result[i][0]}`

					    };
					code.push(temp);
	      		}
		      },
		      dataType: 'json'
		    });

		    $('#external-events div.external-event').each(function() {
				var eventObject = {
					title: $.trim($(this).text())
				};

				$(this).data('eventObject', eventObject);
			});

			var calendar =  $('#calendar').fullCalendar({
				header: {
					left: 'title',
					center: 'month',
					right: 'prev,next today'
				},
				editable: true,
				firstDay: 1, 
				selectable: true,
				defaultView: 'month',

				axisFormat: 'h:mm',
				columnFormat: {
					month: 'ddd',  
					week: 'ddd d',
					day: 'dddd M/d', 
					agendaDay: 'dddd d'
				},
				titleFormat: {
					month: 'MMMM yyyy',
					week: "MMMM yyyy", 
					day: 'MMMM yyyy'  
				},
				allDaySlot: false,
				selectHelper: true,
				select: function(start, end, allDay) {
					var title = prompt('Event Title:');
					if (title) {
						$.ajax({
					      url: '../controller/ajax.php',
					      type: 'POST',
					      data: {
					        action: 'addNote',
					        title: title,
					        start: start
					      },
					      async: false,
					      cache: false,
					      success: function(result){
					      	calendar.fullCalendar('renderEvent',
							{
								title: title,
								start: start,
								end: end,
								allDay: allDay,
								className: 'info'
							},true);
					      },
					    });
					}
					calendar.fullCalendar('unselect');
				},


				events: code,
			});


		});

	</script>
