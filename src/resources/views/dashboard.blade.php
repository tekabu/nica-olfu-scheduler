@extends('base.base')

@section('header_title', 'Dashboard')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col">
					<div class="card card-body bg-primary text-white">
						<div class="d-flex align-items-center">
							<div class="flex-fill">
								<h4 class="mb-0">{{ number_format($total, 0, '.', ',') }}</h4>
								Total Schedules
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card card-body bg-success text-white">
						<div class="d-flex align-items-center">
							<div class="flex-fill">
								<h4 class="mb-0">{{ number_format($onGoing, 0, '.', ',') }}</h4>
								On-Going Schedules
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card card-body bg-indigo text-white">
						<div class="d-flex align-items-center">
							<div class="flex-fill">
								<h4 class="mb-0">{{ number_format($completed, 0, '.', ',') }}</h4>
								Completed Schedules
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card card-body bg-danger text-white">
						<div class="d-flex align-items-center">
							<div class="flex-fill">
								<h4 class="mb-0">{{ number_format($due, 0, '.', ',') }}</h4>
								Due Schedules
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-body">
					<div class="cal-schedules"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="table-responsive">
			<table class="table dt datatable-basic dataTable">
				<thead>
					<tr>
						<th class="title">Title</th>
						<th class="description">Description</th>
						<th class="started_date">Started Date</th>
						<th class="ended_date">Ended Date</th>
						<th class="completed_date">Completed Date</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('js/vendor/ui/fullcalendar/main.min.js') }}"></script>
	<script src="{{ asset('js/vendor/tables/datatables/datatables.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/2.1.3/sorting/datetime-moment.js"></script>

	<script type="text/javascript">
		$(() => {
			// Define element
			const calendarBasicViewElement = document.querySelector('.cal-schedules');

			// Initialize
			if (calendarBasicViewElement) {
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
				document.querySelectorAll('.sidebar-control').forEach(function (sidebarToggle) {
					sidebarToggle.addEventListener('click', function () {
						calendarBasicViewInit.updateSize();
					});
				});
			}

			$.extend($.fn.dataTable.defaults, {
				autoWidth: false,
				dom: '<"datatable-header justify-content-start"f<"ms-sm-auto"l><"ms-sm-3">><"datatable-scroll-wrap"t><"datatable-footer"ip>',
				language: {
					search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
					searchPlaceholder: 'Type to filter...',
					lengthMenu: '<span class="me-3">Show:</span> _MENU_',
					paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
				}
			});

			$.fn.dataTable.moment('MMM. D, YYYY');

			$('.dt').DataTable({
				data: {!! $schedules !!},
				columns: [
					{ data: 'title' },
					{ data: 'description' },
					{ data: 'started_date' },
					{ data: 'ended_date' },
					{ data: 'completed_date' },
				],
				order: []
			});
		});
	</script>
@endsection