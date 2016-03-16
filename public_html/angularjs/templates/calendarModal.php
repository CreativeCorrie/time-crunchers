<!--calendar from: http://mattlewis92.github.io/angular-bootstrap-calendar/#?example=kitchen-sink-->
<div class="modal-header">
	<h3 class="modal-title">Event action occurred!</h3>
</div>
<div class="modal-body">
	<p>Action:
	<pre>{{ vm.action }}</pre>
	</p>
	<p>Event:
	<pre>{{ vm.event | json }}</pre>
	</p>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" ng-click="$close()">Exit</button>
</div>