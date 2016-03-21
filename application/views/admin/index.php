<script>

	$(function() { // document ready

		$('#calendar').fullCalendar({
			schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			//theme: true,
			now: '2016-03-07',
			selectable: true,
			selectHelper: true,
			editable: true, // enable draggable events
			//aspectRatio: 1.8,
			//scrollTime: '00:00', // undo default 6am scrollTime
			eventLimit: true, // allow "more" link when too many events
			header: {
				left: 'today prev,next',
				center: 'title',
				right: 'timelineDay,timelineThreeDays,agendaWeek,month'
			},
			defaultView: 'timelineDay',
			views: {
				timelineThreeDays: {
					type: 'timeline',
					duration: { days: 3 }
				}
			},
			// the point if this demo is to demonstrate dayClick...
			dayClick: function(date, jsEvent, view, resourceObj) {
				alert("Clicked");
				console.log(
					'dayClick',
					date.format(),
					resourceObj ? resourceObj.id : '(no resource)'
				);
			},
			select: function(start, end, jsEvent, view, resource) {
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
					console.log(eventData);
				}
				$('#calendar').fullCalendar('unselect');
			},
			resourceLabelText: 'Rooms',
			resources: [
				{ id: 'a', title: 'Auditorium A' },
				{ id: 'b', title: 'Auditorium B', eventColor: 'green' },
				{ id: 'c', title: 'Auditorium C', eventColor: 'orange' },
				{ id: 'd', title: 'Auditorium D', children: [
					{ id: 'd1', title: 'Room D1' },
					{ id: 'd2', title: 'Room D2' }
				] },
				{ id: 'e', title: 'Auditorium E' },
				{ id: 'f', title: 'Auditorium F', eventColor: 'red' },
				{ id: 'g', title: 'Auditorium G' },
				{ id: 'h', title: 'Auditorium H' }
			],
			events: [
				{ id: '1', resourceId: 'b', start: '2016-03-07T02:00:00', end: '2016-03-07T07:00:00', title: 'event 1' },
				{ id: '2', resourceId: 'c', start: '2016-03-07T05:00:00', end: '2016-03-07T22:00:00', title: 'event 2' },
				{ id: '3', resourceId: 'd', start: '2016-03-06', end: '2016-03-08', title: 'event 3' },
				{ id: '4', resourceId: 'e', start: '2016-03-07T03:00:00', end: '2016-03-07T08:00:00', title: 'event 4' },
				{ id: '5', resourceId: 'f', start: '2016-03-07T00:30:00', end: '2016-03-07T02:30:00', title: 'event 5' }
			]
		});

	});

</script>