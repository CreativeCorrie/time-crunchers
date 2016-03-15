app.controller('CalendarController', function($scope, moment, alert) {


	//These variables MUST be set as a minimum for the calendar to work
	this.calendarView = 'month';
	this.viewDate = new Date();
	this.events = [
		//commented the following out bc we don't need this filler info
		//{
		//	title: 'An event',
		//	type: 'warning',
		//	startsAt: moment().startOf('week').subtract(2, 'days').add(8, 'hours').toDate(),
		//	endsAt: moment().startOf('week').add(1, 'week').add(9, 'hours').toDate(),
		//	draggable: true,
		//	resizable: true
		//}, {
		//	title: '<i class="glyphicon glyphicon-asterisk"></i> <span class="text-primary">Another event</span>, with a <i>html</i> title',
		//	type: 'info',
		//	startsAt: moment().subtract(1, 'day').toDate(),
		//	endsAt: moment().add(5, 'days').toDate(),
		//	draggable: true,
		//	resizable: true
		//}, {
		//	title: 'This is a really long event title that occurs on every year',
		//	type: 'important',
		//	startsAt: moment().startOf('day').add(7, 'hours').toDate(),
		//	endsAt: moment().startOf('day').add(19, 'hours').toDate(),
		//	recursOn: 'year',
		//	draggable: true,
		//	resizable: true
		//}
	];

	this.isCellOpen = true;

	this.eventClicked = function(event) {
		alert.show('Clicked', event);
	};

	this.eventEdited = function(event) {
		alert.show('Edited', event);
	};

	this.eventDeleted = function(event) {
		alert.show('Deleted', event);
	};

	this.eventTimesChanged = function(event) {
		alert.show('Dropped or resized', event);
	};

	this.toggle = function($event, field, event) {
		$event.preventDefault();
		$event.stopPropagation();
		event[field] = !event[field];
	};

});
