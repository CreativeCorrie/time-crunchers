<div class="row">
	<div class="col-md-6">
		<p>Approve or Deny Request:</p>
		<form name="adminRequestView" role="form">

			<!--Radio Buttons-->
			<label class="radio-inline">
				<input type="radio" name="optradio">Approve
			</label>
			<label class="radio-inline">
				<input type="radio" name="optradio">Deny
			</label>
			<br>

			<!--Comment box-->
			<div class="form-group">
				<label for="comment">Add a Comment:</label>
				<textarea ng-submit="updateRequest()" ng-controller="RequestController" class="form-control" rows="5" id="comment" ></textarea>
			</div>
		</form>

	</div> <!--/.row-->

	<div class="row">
		<div class="col-md-6">
			<div class="button-container">
				<a href="adminOnlyView/" class="btn btn-warning">Return to Admin</a>
			</div>
		</div>
	</div> <!-- /row -->

	<br> <!-- TODO: Need this to trigger an email response to the requestor -->
	<div class="row">
		<div class="col-md-6">
			<p>Great! When you submit this form the requesting Member will receive an email from "Time Crunch" notifying them of your decision.</p>
			<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i>Submit</button>
<!--			<button class="btn btn-info" type="reset"><i class="fa fa-ban"></i>Reset Form</button>-->
		</div>


<!--		<form ng-submit="submit()" ng-controller="ExampleController">-->
<!--			Enter text and hit enter:-->
<!--			<input type="text" ng-model="text" name="text" />-->
<!--			<input type="submit" id="submit" value="Submit" />-->
<!--			<pre>list={{list}}</pre>-->
<!--		</form>-->