<div class="modal-header">
	<h3>Submit Request</h3>
</div>
<div class="modal-body">
	<form id="modalRequestForm" name="modalRequestForm" ng-submit="createRequest(requestData, modalRequestForm.$valid);" novalidate>
		<div class="form-group">
			<label for="userRequest">Reason for Request</label>
			<input type="text" class="form-control" id="userRequest" name="userRequest" ng-model="requestData.requestRequestText"
					 placeholder="Make your Request"
					 ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="modalRequestForm.userRequest.$error" ng-if="modalRequestForm.userRequest.$touched" ng-hide="modalRequestForm.userRequest.$valid">
				<p ng-message="required">Please leave a brief message to explain your request.</p>
			</div>
		</div>
		<button type="submit" class="btn btn-info" ng-click="Your request has been sent" ng-disabled="modalRequestForm.$invalid">Submit</button>
		<button type="reset" class="btn btn-warning" ng-click="cancel();">Cancel</button>
	</form>
</div>