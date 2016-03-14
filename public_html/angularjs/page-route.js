// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	// route for the home page
		.when('/', {
			controller  : 'MainController',
			templateUrl : 'angularjs/pages/landingPage.php'
		})

		 //route for the about page
		.when('/about/', {
			controller  : 'AboutController',
			templateUrl : 'angularjs/templates/aboutView.php'
		})

		// route for the activation page
		.when('/activation/:emailActivation', {
			controller  : 'ActivationController',
			templateUrl : 'angularjs/pages/setPassForm.php'
		})

		//route page for calendarView page
		.when('/calendar', {
			controller  : 'CalendarViewController',//TODO: NO CONTROLLER
			templateUrl : 'angularjs/pages/calendarView.php'
		})

		//route page to setPassForm page
		.when('/setPass', {
			controller  : 'ActivationController',	//TODO: NO CONTROLLER
			templateUrl : 'angularjs/pages/setPassForm.php'
		})

		//route page to adminOnlyView page
		.when('/adminView', {
			controller  : 'AdminViewController',//TODO: NO CONTROLLER
			templateUrl : 'angularjs/templates/adminOnlyView.php'
		})

		//route page to buildCrewForm page
		.when('/buildCrew', {
			controller  : 'AdminViewController',//TODO: NO CONTROLLER
			templateUrl : 'angularjs/templates/buildCrewForm.php'
		})
		// route for the faqView page
		.when('/faq', {
			controller  : 'faqController',//TODO: NO CONTROLLER
			templateUrl : 'angularjs/templates/faqView.php'
		})

		// route for the sign up page
		.when('/request', {
			controller  : 'RequestController',
			templateUrl : 'angularjs/templates/requestModal.php'
		})

		// route for the sign up page
		.when('/sign-up', {
			controller  : 'SignUpController',
			templateUrl : 'angularjs/templates/adminSignUpForm.php'
		})

		// route for the login page
		.when('/login', {
			controller  : 'LoginController',
			templateUrl : 'angularjs/templates/modalLoginForm.php'
		})

		// route for the admin view request page
		.when('/adminRequestView', {
			controller  : 'RequestController',
			templateUrl : 'angularjs/templates/adminRequestView.php'
		})

		// route for the add schedule form
		.when('/addScheduleForm', {
			controller  : 'ScheduleController',
			templateUrl : 'angularjs/templates/addScheduleForm.php'
		})

		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});