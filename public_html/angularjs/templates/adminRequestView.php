<div class="row">
	<div class="col-md-6">
		<h2>Requests</h2>
		<div id="reqView">
			<!-- TODO:plug in an array of requests here-->
		</div>

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
				<textarea class="form-control" rows="5" id="comment"></textarea>
			</div>
		</form>

	</div> <!--/.row-->

	<div class="row">
		<div class="col-md-6">
			<div class="button-container">
				<a href="adminOnlyView/" class="btn btn-info">Return to Admin View</a>
			</div>
		</div>
	&nbsp;
		<div class="col-md-6">
			<div class="button-container">
				<a href="calendarView.php" class="btn btn-warning">Return to Schedule View</a>
			</div>
		</div>
	</div> <!-- /row -->


