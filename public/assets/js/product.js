var app = angular.module('myProduct', ['ngMaterial', 'chieffancypants.loadingBar', 'ngAnimate']).config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  });
app.controller('MyProduct', function ($scope, $http, $mdToast, $location, $timeout, cfpLoadingBar) {

  console.log('product.js');

})

