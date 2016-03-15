<!--this will be the page that holds the calendar -
ideally this is the main page that appears
in the index when no other view has been selected-->

<div ng-controller="CalendarController as vm">
	<h2 class="text-center">{{ vm.calendarTitle }}</h2>

	<div class="row">

		<div class="col-md-6 text-center">
			<div class="btn-group">

				<button
					class="btn btn-primary"
					mwl-date-modifier
					date="vm.viewDate"
					decrement="vm.calendarView">
					Previous
				</button>
				<button
					class="btn btn-default"
					mwl-date-modifier
					date="vm.viewDate"
					set-to-today>
					Today
				</button>
				<button
					class="btn btn-primary"
					mwl-date-modifier
					date="vm.viewDate"
					increment="vm.calendarView">
					Next
				</button>
			</div>
		</div>

		<br class="visible-xs visible-sm">

		<div class="col-md-6 text-center">
			<div class="btn-group">
				<label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'year'">Year</label>
				<label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'month'">Month</label>
				<label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'week'">Week</label>
				<label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'day'">Day</label>
			</div>
		</div>

	</div>

	<br>

	<mwl-calendar
		events="vm.events"
		view="vm.calendarView"
		view-title="vm.calendarTitle"
		view-date="vm.viewDate"
		on-event-click="vm.eventClicked(calendarEvent)"
		on-event-times-changed="vm.eventTimesChanged(calendarEvent); calendarEvent.startsAt = calendarNewEventStart; calendarEvent.endsAt = calendarNewEventEnd"
		edit-event-html="'<i class=\'glyphicon glyphicon-pencil\'></i>'"
		delete-event-html="'<i class=\'glyphicon glyphicon-remove\'></i>'"
		on-edit-event-click="vm.eventEdited(calendarEvent)"
		on-delete-event-click="vm.eventDeleted(calendarEvent)"
		cell-is-open="vm.isCellOpen"
		day-view-start="06:00"
		day-view-end="22:00"
		day-view-split="30"
		cell-modifier="vm.modifyCell(calendarCell)">
	</mwl-calendar>

	<br><br><br>

	<h3 id="event-editor">
		Edit events
		<button
			class="btn btn-primary pull-right"
			ng-click="vm.events.push({title: 'New event', type: 'important', draggable: true, resizable: true})">
			Add new
		</button>
		<div class="clearfix"></div>
	</h3>

	<table class="table table-bordered">

		<thead>
			<tr>
				<th>Title</th>
				<th>Type</th>
				<th>Starts at</th>
				<th>Ends at</th>
				<th>Remove</th>
			</tr>
		</thead>

		<tbody>
			<tr ng-repeat="event in vm.events track by $index">
				<td>
					<input
						type="text"
						class="form-control"
						ng-model="event.title">
				</td>
				<td>
					<select ng-model="event.type" class="form-control">
						<option value="important">Important</option>
						<option value="warning">Warning</option>
						<option value="info">Info</option>
						<option value="inverse">Inverse</option>
						<option value="success">Success</option>
						<option value="special">Special</option>
					</select>
				</td>
				<td>
					<p class="input-group" style="max-width: 250px">
						<input
							type="text"
							class="form-control"
							readonly
							uib-datepicker-popup="dd MMMM yyyy"
							ng-model="event.startsAt"
							is-open="event.startOpen"
							close-text="Close" >
            <span class="input-group-btn">
              <button
					  type="button"
					  class="btn btn-default"
					  ng-click="vm.toggle($event, 'startOpen', event)">
					  <i class="glyphicon glyphicon-calendar"></i>
				  </button>
            </span>
					</p>
					<uib-timepicker
						ng-model="event.startsAt"
						hour-step="1"
						minute-step="15"
						show-meridian="true">
					</uib-timepicker>
				</td>
				<td>
					<p class="input-group" style="max-width: 250px">
						<input
							type="text"
							class="form-control"
							readonly
							uib-datepicker-popup="dd MMMM yyyy"
							ng-model="event.endsAt"
							is-open="event.endOpen"
							close-text="Close">
            <span class="input-group-btn">
              <button
					  type="button"
					  class="btn btn-default"
					  ng-click="vm.toggle($event, 'endOpen', event)">
					  <i class="glyphicon glyphicon-calendar"></i>
				  </button>
            </span>
					</p>
					<uib-timepicker
						ng-model="event.endsAt"
						hour-step="1"
						minute-step="15"
						show-meridian="true">
					</uib-timepicker>
				</td>
				<td>
					<button
						class="btn btn-danger"
						ng-click="vm.events.splice($index, 1)">
						Delete
					</button>
				</td>
			</tr>
		</tbody>

	</table>
</div>




