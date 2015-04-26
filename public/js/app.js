'use strict';

/* App Module */

var genealogy = angular.module('genealogyApp', [
    'ngRoute',
    'Controllers',
    'GenService',
    'GenDirective',
    'LocalStorageModule',
    'mm.foundation'],
        function($interpolateProvider) {
            $interpolateProvider.startSymbol('<{').endSymbol('}>');
        });


genealogy.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
                when('/tree', {
                    templateUrl: '/js/angular/template/tree.html',
                    controller: 'GenealogyTreeCtrl'
                }).
                when('/post', {
                    templateUrl: '/js/angular/template/post.html',
                    controller: 'GenealogyPostCtrl'
                }).
                when('/post/:id',{
                    templateUrl: '/js/angular/template/post-show.html',
                    controller: 'GenealogyPostShowCtrl'
                }).
                when('/pedigree', {
                    templateUrl: '/js/angular/template/pedigree.html',
                    controller: 'GenealogyPedigreeCtrl'
                }).
                when('/block', {
                    templateUrl: '/js/angular/template/block.html',
                    controller: 'GenealogyBlockCtrl'
                }).
                when('/settings', {
                    templateUrl: '/js/angular/template/settings.html',
                    controller: 'GenealogySettingsCtrl'
                }).
                when('/search', {
                    templateUrl: '/js/angular/template/search.html',
                    controller: 'GenealogySearchCtrl'
                }).
                /*when('/view/:id', {
                 templateUrl: '/js/angular/template/view.html',
                 controller: 'GenealogyViewCtrl'
                 }).*/
                otherwise({
                    redirectTo: '/tree'
                });
    }]);

genealogy.controller('Modal', function($scope, $modal) {
    $scope.open = function(view) {
        var modalInstance = $modal.open({
            templateUrl: view + '.html',
            controller: 'ModalGenealogyCtrl'
        });
    };
    $scope.print = function() {
        window.print();
    };
});