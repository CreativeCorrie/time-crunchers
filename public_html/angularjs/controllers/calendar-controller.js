app.controller('CalendarController', ["$scope", "moment", "alert", "calendarService", function($scope, moment, alert, calendarService) {


	//These variables MUST be set as a minimum for the calendar to work
	this.calendarView = 'month';
	this.viewDate = new Date();
	this.events = [
		{
			title: 'An event',
			type: 'warning',
			startsAt: moment().startOf('week').subtract(0, 'days').add(8, 'hours').toDate(),
			endsAt: moment().startOf('week').add(17, 'hours').toDate(),
			draggable: true,
			resizable: true
		},
		{
			title: 'An event',
			type: 'warning',
			startsAt: moment().startOf('week').add(1, 'days').add(8, 'hours').toDate(),
			endsAt: moment().startOf('week').add(17, 'hours').toDate(),
			draggable: true,
			resizable: true
		},
		{
			title: 'An event',
			type: 'warning',
			startsAt: moment().startOf('week').add(2, 'days').add(8, 'hours').toDate(),
			endsAt: moment().startOf('week').add(17, 'hours').toDate(),
			draggable: true,
			resizable: true
		},
		{
			title: 'An event',
			type: 'warning',
			startsAt: moment().startOf('week').add(3, 'days').add(8, 'hours').toDate(),
			endsAt: moment().startOf('week').add(17, 'hours').toDate(),
			draggable: true,
			resizable: true
		},
		{
			title: 'An event',
			type: 'warning',
			startsAt: moment().startOf('week').add(, 'days').add(8, 'hours').toDate(),
			endsAt: moment().startOf('week').add(17, 'hours').toDate(),
			draggable: true,
			resizable: true
		}
	];
	$scope.alerts = [];

	this.getAllShifts = function() {
		calendarService.fetchAllShifts()
			.then(function(result) {
				console.log(result); // TODO: remove
				if(result.data.status === 200) {
					for(var i = 0; i < result.data.data.length; i++) {
						this.date = result.data.data[i].shiftDate + " " + result.data.data[i].shiftStartTime;
						console.log(this.date); // TODO: remove
						this.events[i] = {
							title: 'Shift',
							type: 'info',
							startsAt: this.date.toDate(),
							endsAt: this.date.add(result.data.data.shiftDuration, "hours").toDate(),
							draggable: true,
							resizable: true
						};
					}
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

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

	this.getAllShifts();

}]);
