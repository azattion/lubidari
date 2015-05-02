'use strict';
/* Services */

var services = angular.module('ProdService', ['ngResource']);
services.factory('Service',
        function($resource) {
            return $resource('/product/list',
                    {query: {method: 'GET', isArray: false}});
        });
services.factory('ServiceId',
        function($resource) {
            return $resource('/product/show/:id', {}, {
                show: {method: 'GET', params: {id: '@id'}}
            });
        });
