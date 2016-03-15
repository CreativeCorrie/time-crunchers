<form class="form-inline" id="modalRequestForm" name="modalRequestForm" ng-submit="createRequest(requestData, modalRequestForm.$valid);" novalidate>
	<div class="form-group">
		<label for="modalRequestForm">Reason for request</label>
		<div class="input-group">
			<input type="text" class="form-control" id="userRequest" name="userRequest" ng-model="requestData.requestRequestorText"
					 placeholder="Make your Request"
					 ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="modalRequestForm.userRequest.$error"
			<p ng-message="required">Please leave a brief message to explain your request.</p>
		</div>
	</div>
</form>