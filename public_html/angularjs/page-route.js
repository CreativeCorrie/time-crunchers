// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	//FIXME: this is not the route for the home (index)page this is the landing page
	//	.when('/', {
	//		controller  : 'mainController',
	//		templateUrl : 'angularjs/pages/landingPage.php'
	//	})

		 //route for the about page
		.when('/about/', {
			controller  : 'aboutController',
			templateUrl : 'angularjs/pages/aboutView.php'
		})

		// route for the activation page
		.when('/activation/:emailActivation', {
			controller  : 'activationController',
			templateUrl : 'angularjs/pages/setPassForm.php'
		})

		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});