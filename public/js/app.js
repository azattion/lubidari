'use strict';

/* App Module */
var genealogy = angular.module('lubidariApp', [
        'ngRoute',
        'ProdService',
        'Controllers',
        'ui.bootstrap'
    ],
    function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<{').endSymbol('}>');
    });


genealogy.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '/js/template/home.html',
                controller: 'HomeCtrl'
            }).
            when('/:id', {
                templateUrl: '/js/template/show.html',
                controller: 'ShowCtrl'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);