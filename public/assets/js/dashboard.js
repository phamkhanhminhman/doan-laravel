var app = angular.module('myDashBoard', ['ngMaterial', 'chieffancypants.loadingBar', 'ngAnimate']).config(function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.includeSpinner = true;
});
app.controller('myDashBoard', function ($scope, $http, $mdToast, $location, $timeout, cfpLoadingBar) {

	var absUrl = $location.absUrl();
	var host   = $location.host();
	var port   = $location.port();
	$scope.baseURL = 'http://' + host + ':' + port;
	$http.get($scope.baseURL + '/sendo/update-report-thang').then(function (res) {});

	// setTimeout(function(){ window.location.reload(); }, 3000);
})
