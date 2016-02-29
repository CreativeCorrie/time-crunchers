<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>

		<!-- IE Rendering Mode = Edge-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
				crossorigin="anonymous"/>

		<!-- Optional theme -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
				integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
				crossorigin="anonymous"/>

		<!--Font Awesome CSS-->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
				integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
		<!-- LOAD OUR CUSTOM STYLESHEET HERE!!! -->
		<link href="css/style1.css" type="text/css" rel="stylesheet"/>

		<!-- HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

		<!-- Latest compiled and minified Bootstrap JavaScript, all compiled plugins included -->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
				  integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
				  crossorigin="anonymous"></script>
	</head>

	<title>Time Crunch Schedule View</title>
	<body>
		<header>
			<!--			this is the new test nav bar w tabs and drop down log in log out-->
			<div class="container">
				<h3>just another banner</h3>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#">Schedule View</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Log In/Out <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Log In</a></li>
							<li><a href="#">Log Out</a></li>
							<li><a href="#">Receive CupCake Consistent with Rank</a></li>
						</ul>
					</li>
					<li><a href="#">Request</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Admin</a></li>
				</ul>
			</div>
			<!--this is the end of the new test nav bar-->
		</header>

		<!--		main box-->
		<!-- The div class="form-wrap" is the black box containing the form. It's set to a column width of 12 for small screens, and a column width of 6 for medium screens on up -->
		<div class="col-xs-12 col-md-7 form-wrap">
			<!-- Form is centered within it's container, and is set to 10 be columns wide RELATIVE TO IT'S CONTAINER, and offset to the right by one column. See classes: col-xs-offset-1 & col-xs-10 -->
			<form method="get" action="#" id="sample-form" class="form-horizontal col-xs-10 col-xs-offset-1">

				<div class="form-group">
					<!-- Labels for each field are places within a <label> tag. Use the "for" attribute. the class="control-label" is for styling. -->
					<label for="inputName1" class="control-label">Name</label>
					<!-- the div class="input-group" contains both the text field and the icon to the left -->
					<div class="input-group">
						<!-- this div and span contains the glyphicon to the left. aria-hidden is so that screen readers don't read this element -->
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						</div>
						<!-- text field input. pay attention to the id, placeholder text, type, and placeholder attributes -->
						<input type="text" class="form-control" id="textName1" placeholder="Your name here." maxlength="150" />
					</div>
				</div>

				<div class="form-group">
					<label for="email1" class="control-label">Email</label>
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
						</div>
						<input type="email" id="email1" class="form-control" maxlength="150" placeholder="your.email@something.com"/>
					</div>
				</div>

				<div class="form-group">
					<label for="selectList1" class="control-label">Choose a language:</label><br/>
					<select id="selectList1" class="form-control">
						<!--"no-option" is a custom class to style the disabled option-->
						<option class="no-option" value="" disabled selected>Choose One! :D</option>
						<option value="PHP">PHP</option>
						<option value="JavaScript">JavaScript</option>
						<option value="HTML">HTML</option>
						<option value="CSS">CSS</option>
						<option value="Klingon">Klingon (Qapla'!)</option>
					</select>
				</div>

				<div class="form-group">
					<label for="genderRadio" class="control-label">Choose your gender identity:</label>
					<!-- each radio button and it's label text is placed within a row, 12-col div, and a div class="radio" -->
					<div class="row">
						<!-- this div has been given a 12-col width to ensure consistent padding -->
						<div class="col-xs-12">
							<!-- class of radio-inline styles the radio buttons in a single row -->
							<div class="radio-inline">
								<!-- each radio button and it's label is further contained within it's own <label> tag. pay attention to this -->
								<label>
									<!-- name attribute is required for full functionality -->
									<input type="radio" name="rdoGender" id="radioGenderMale" value="Male" />Male
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="rdoGender" id="radioGenderFemale" value="Female" />Female
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="rdoGender" id="radioGenderOther" value="Other" />Other
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="rdoGender" id="radioGenderDecline" value="Prefer not to state." />I prefer not to state.
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label">Some Of My Favorite Things:</label>
					<!-- use div class="help-block" to explain the form content -->
					<div class="help-block">Please check all that apply.</div>
					<div class="checkbox">
						<label class="checkbox">
							<!-- name value contains square brackets which makes it easy to create an array on the back end in php -->
							<input id="chkFavoritesKittens" name="chkFavorites[]" type="checkbox" value="Kittens" />Kittens
						</label>
						<label class="checkbox">
							<input id="chkFavoritesPuppies" name="chkFavorites[]" type="checkbox" value="Puppies" />Puppies
						</label>
						<label class="checkbox">
							<input id="chkFavoritesRainbows" name="chkFavorites[]" type="checkbox" value="Rainbows" />Rainbows
						</label>
						<label class="checkbox">
							<input id="chkFavoritesUnicorns" name="chkFavorites[]" type="checkbox" value="Unicorns" />Unicorns
						</label>
						<label class="checkbox">
							<input id="chkFavoritesCthulhu" name="chkFavorites[]" type="checkbox" value="Cthulhu" />Cthulhu
						</label>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="txtareaComments">Tell Us More About Yourself:</label>
					<textarea class="form-control" rows="5" id="txtareaComments" maxlength="500" placeholder="500 characters max."></textarea>
				</div>

				<div class="form-group">
					<!-- the following <a> tag has been styled as a button with class="btn" -->
					<a id="reset-form" class="btn" role="button">Reset Form</a>
					<button type="submit" class="btn">Submit</button>
				</div>
			</form>
		</div> <!-- CLOSE FORM WRAP -->

	</body>
</html>


<!--		this is my test area-->


<!--		this is my test area-->
