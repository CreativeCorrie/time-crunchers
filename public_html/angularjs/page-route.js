// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	// route for the home page
		.when('/', {
			controller  : 'mainController',
			templateUrl : 'angular/pages/calendarView.php'
		})

		 //route for the about page
		.when('/about/', {
			controller  : 'aboutController',
			templateUrl : 'angularjs/templates/aboutView.php'
		})

		// route for the activation page
		.when('/activation/:emailActivation', {
			controller  : 'activationController',
			templateUrl : 'angularjs/pages/setPassForm.php'
		})

		// route for the sign up page
		.when('/sign-up/', {
			controller  : 'signupController',
			templateUrl : 'angular/templates/adminSignUpForm.php'
		})

		// route for the admin view request page
		.when('/adminRequestView/', {
			controller  : 'requestController',
			templateUrl : 'angular/templates/adminRequestView.php'
		})

		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});