@extends('base.base')

@section('header_title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="cal-schedules"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/ui/fullcalendar/main.min.js') }}"></script>

    <script type="text/javascript">
		$(() => 
		{
			// Define element
			const calendarBasicViewElement = document.querySelector('.cal-schedules');

			// Initialize
			if(calendarBasicViewElement) {
				const calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
					headerToolbar: {
						left: 'prev,next today',
						center: 'title',
						right: 'dayGridMonth,timeGridWeek,timeGridDay'
					},
					initialDate: new Date(),
					navLinks: true, // can click day/week names to navigate views
					nowIndicator: true,
					weekNumberCalculation: 'ISO',
					editable: false,
					selectable: true,
					direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
					dayMaxEvents: false, // allow "more" link when too many events
					events: {!! json_encode($events) !!}
				});

				// Init
				calendarBasicViewInit.render();

				// Resize calendar when sidebar toggler is clicked
				document.querySelectorAll('.sidebar-control').forEach(function(sidebarToggle) {
					sidebarToggle.addEventListener('click', function() {
						calendarBasicViewInit.updateSize();
					});
				});
			}
		});
	</script>
@endsection