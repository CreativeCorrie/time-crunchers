app.controller('CompanyController', ["$scope", "$window", "$uibModal", "companyService", function($scope, $window, $uibModal, companyService) {
	$scope.alerts = [];
	$scope.companyData = {};
	$scope.editedCompany = {};

	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getCompanyById = function() {
		companyService.fetchCompanyById(companyId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.companyData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};


	/**
	 * creates a company and sends it to the company API
	 *
	 * @param company the company to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createCompany = function(company, validated) {
		if(validated === true) {
			CompanyService.create(company)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newCompany = {companyId: null, attribution: "", company: "", submitter: ""};
						$scope.addCompanyForm.$setPristine();
						$scope.addCompanyForm.$setUntouched();
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};




}]);