<div class="container-fluid">
	<div class="mb-4">
		<?= $this->breadcrumbs->show(); ?>
	</div>
	<div class="row">

		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Events</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<!--<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>-->
						</div>
					</div>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="calender-inner">
						<div id='calendar' style="color: black;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<link href="<?= base_url("assets/admin/css/calendar/core.fullcallender.css"); ?>" rel="stylesheet">
<link href="<?= base_url("assets/admin/css/calendar/daygrid.fullcalender.css"); ?>" rel="stylesheet">
<script src="<?= base_url("assets/admin/js/calendar/moment.min.js"); ?>"></script>
<script src="<?= base_url("assets/admin/js/calendar/core.fullcallender.js"); ?>"></script>
<script src="<?= base_url("assets/admin/js/calendar/fullcalender.js"); ?>"></script>
<script src="<?= base_url("assets/admin/js/calendar/daygrid.fullcalender.js"); ?>"></script>
<script>
			function get_events(calendar) {
			$.ajax({
				type: "get",
				url: "<?= base_url('admin/dashboard/get_events') ?>",
				dataType: "json",
				success: function(data) {
					//console.log(data);
					$(data).each(function(key,value){
						//console.log(value);
						calendar.addEvent({ title: value.title, start: value.start });
					});
				}
			});
		}
		
		function save_events(event_date, event_name) {
			var e_date = event_date;
			var e_name = event_name;
			$.ajax({
				type: "post",
				url: "<?= base_url('admin/dashboard/save_events') ?>",
				data: {
					event_date: e_date,
					event_name: e_name
				},
				success: function(data) {
					console.log("Data saved successfully");
					$.notify({
              message: 'Event Added Successfully'
            }, {
              // settings
              type: 'info',
              animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
              },
            offset: {
              x: 20,
              y: 100
            }
            });
				}
			});
		}
document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');

	var calendar = new FullCalendar.Calendar(calendarEl, {
		height: 650,
		plugins: [ 'dayGrid','interaction','timeGrid' ],
		selectable: true,
		eventTextColor: '#FFF',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      dateClick: function(info) {
				var event_name = prompt('Enter event details');
				if(event_name!=null && event_name.length!=0){
				//console.log(event_name);exit;
				calendar.addEvent({ title: event_name, start: info.dateStr });
        //console.log('clicked ' + info.dateStr);
				save_events(info.dateStr,event_name);
				}else{
					console.log("I am here");
				}
      },
      select: function(info) {
        //alert('selected ' + info.startStr + ' to ' + info.endStr);
      }
	});

	calendar.render();
	get_events(calendar);
});

</script>
