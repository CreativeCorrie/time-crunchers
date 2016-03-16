<div class="row">
	<div class="col-md-6">
		<h2>All Pending Requests</h2>
		<div ng-repeat="request in currentRequests">
			<div class="well"><a href="adminRequestView/">{{request.requestRequestorText}}</a></div>
		</div>
	</div>
</div>

