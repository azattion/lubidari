'use strict';

/* App Module */
var lubidari = angular.module('lubidariApp', [
        'ngRoute',
        'ngAnimate',
        'ProdService',
        'Controllers',
        'Directive',
        'ui.bootstrap',
        'angularFileUpload'
    ],
    function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<{').endSymbol('}>');
    });
lubidari.value('item', []);


lubidari.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
            when('/', {
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
                redirectTo: '/'
            });
    }]);