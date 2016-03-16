<form class="form-group" id="modalRequestForm" name="modalRequestForm" ng-submit="createRequest(requestData, modalRequestForm.$valid);" novalidate>
	<div class="form-group">
		<label for="modalRequestForm">Reason for Request</label>
		<div class="input-group">
			<input type="text-center" class id="userRequest" name="userRequest" ng-model="requestData.requestRequestorText"
					 placeholder="Make your Request"
					 ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="modalRequestForm.userRequest.$error"
			<p ng-message="required">Please leave a brief message to explain your request.</p>
		</div>
	</div>
	<button type="submit" class="btn btn-info" ng-disabled="signinForm.$invalid">submit</button>
	<button type="reset" class="btn btn-warning" ng-click="cancel();">Clear</button>
</form>