// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	// route for the home page
		.when('/', {
			controller  : 'mainController',
			templateUrl : 'angularjs/pages/landingPage.php'
		})

		// route for the about page
		//.when('/about', {
		//	controller  : 'aboutController',
		//	templateUrl : 'angularjs/pages/aboutView.php'
		//})

		// route for the activation page
		.when('/activation', {
			controller  : 'activationController',
			templateUrl : 'angularjs/pages/setPassForm.php'
		})

		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});