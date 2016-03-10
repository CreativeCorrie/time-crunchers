var app = angular.module("NgTemplate", ["ngRoute"]);

// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	// route for the home page
		.when('/', {
			controller  : 'mainController',
			templateUrl : 'angular/pages/landingPage.php'
		})

		// route for the about page
		//.when('/about', {
		//	controller  : 'aboutController',
		//	templateUrl : 'angular/pages/about.php'
		//})

		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});