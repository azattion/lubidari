'use strict';

/* App Module */
var lubidari = angular.module('lubidariApp', [
        'ngRoute',
        'ngAnimate',
        'ngCart',
        'angular-loading-bar',
        'ProdService',
        'Controllers',
        'Directive',
        'ui.bootstrap',
        'angularFileUpload'
    ],
    function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<{').endSymbol('}>');
    });
lubidari.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);

lubidari.factory('DataCache', function ($cacheFactory) {
    return $cacheFactory('dataCache', {});
});

lubidari.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
            when('/home', {
                templateUrl: '/js/template/home.html',
                controller: 'HomeCtrl'
            }).
            when('/to-order', {
                templateUrl: '/js/template/order.html',
                controller: 'OrderCtrl'
            }).
            when('/cart', {
                templateUrl: '/js/template/cart.html',
                controller: 'CartCtrl'
            }).
            when('/:id', {
                templateUrl: '/js/template/show.html',
                controller: 'ShowCtrl'
            }).
            otherwise({
                redirectTo: '/home'
            });
    }]);