<!--this is the form for creating a crew-->

<!-- Crew Sign Up-->

<h2>Create a New Crew</h2>

<form name="buildCrewForm" ng-submit="createCrew(crewData, buildCrewForm.$valid);">

	<fieldset class="form-group">
		<label for="crewLocationInput">Crew Location</label>
		<input type="text" class="form-control" name="crewLocation" id="crewLocation"
				 placeholder="Rio Rancho #4" ng-model="crewData.crewLocation"
				 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="buildCrewForm.crewLocation.$error"
			  ng-if="buildCrewForm.crewLocation.$touched" ng-hide="buildCrewForm.crewLocation.$valid">
			<p ng-message="minlength">Location of the crew is too short.</p>
			<p ng-message="maxlength">Location of the crew is too long.</p>
			<p ng-message="required">Please enter the location of the crew.</p>
		</div>
		<p class="text-danger">
			This name should be unique so you can distinguish one crew from another.
		</p>
	</fieldset>
	<hr>
	<br>

	<!-- Submit Crew Form or Reset Form -->
	<!--		TODO: add Angular.js here to connect to User API-->
	<p>Great! When you submit this form you will create a new crew.</p>
	<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
	<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i> Reset Form</button>
</form>