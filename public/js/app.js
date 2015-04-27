'use strict';

/* App Module */
var genealogy = angular.module('lubidariApp', [
    'ngRoute',
    'Controllers'
    ],
        function($interpolateProvider) {
            $interpolateProvider.startSymbol('<{').endSymbol('}>');
        });


genealogy.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
                when('/', {
                    templateUrl: '/js/template/home.html',
                    controller: 'HomeCtrl'
                }).
                otherwise({
                    redirectTo: '/'
                });
    }]);