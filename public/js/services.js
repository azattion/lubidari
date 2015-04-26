'use strict';

/* Services */

var services = angular.module('GenService', ['ngResource']);

services.factory('Service',
        function($resource) {
            return $resource('/genealogy/list',
                    {query: {method: 'GET', isArray: false}});
        });
services.factory('ServiceId',
        function($resource) {
            return $resource('/genealogy/view/:id', {}, {
                show: {method: 'GET', params: {id: '@id'}}
            });
        });

services.factory('Posts',
        function($resource) {
            return $resource('/post', {},
                    {query: {method: 'GET'}});
        });

services.factory('Posts',
        function($resource) {
            return $resource('/post/:id', {}, {
                show: {metod: 'GET', params: {id: '@id'}}
            });
        });

