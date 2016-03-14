<!--this is the form for creating a crew-->

<!-- Crew Sign Up-->
<!--		TODO: add Angualar.js here to connect to Crew API-->
<h2>Now, create your first Crew for this company.</h2>

<form>

	<fieldset class="form-group">
		<label for="crewLocationInput">Crew Location</label>
		<input type="text" class="form-control" id="crewLocation" placeholder="Managers Only">
		<small class="text-muted">
			This name is how you will differentiate your crews.
		</small>
	</fieldset>


	<fieldset class="form-group">
		<label for="crewAddress1Input">Crew Address 1</label>
		<input type="text" class="form-control" id="crewAddress1" placeholder="1920 Grand Plaza NW">
	</fieldset>

	<fieldset class="form-group">
		<label for="crewAddress2Input">Crew Address 2</label>
		<input type="text" class="form-control" id="crewAddress2" placeholder="Section 31">
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>
	</br>

	<hr>
	</br>


		<label for="crewMemberInput">Select the closest amount of employees</label>
		<legend>Add employees to this crew</legend>
		<p>
			<select id="myList">
				<option value 0>select the amout you would like to add</option>
				<option value 1>5 employees</option>
				<option value 2>10 employees</option>
				<option value 3>20 employees</option>
				<option value 4>40 employees</option>
			</select>
		</p>




</form>