'use strict';

/* Controllers */

var controllers = angular.module('Controllers', []);

controllers.controller('GenealogyTreeCtrl', ['$scope', 'Service', '$modal','$window',
    function($scope, Service, $modal,$window) {
        $scope.loading = true;
        $scope.selection = 'tree';
        $scope.open = function() {
            $modal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                windowClass: 'small'
            });
        };
        $scope.add = function() {
            $modal.open({
                templateUrl: 'addChild.html',
                controller: 'ModalInstanceCtrl',
                windowClass: 'small'
            });
        };
        $scope.edit = function() {
            $modal.open({
                templateUrl: 'editChild.html',
                controller: 'ModalInstanceCtrl',
                windowClass: 'small'
            });
        };
        var data = JSON.parse($window.localStorage.getItem("data"));
        if(data == null || data == undefined){
            $scope.data = Service.query({}, function() {
                $scope.loading = false;
                $window.localStorage.setItem("data", JSON.stringify($scope.data));

            }, function() {
                $scope.alerts = [
                    {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз'}
                ];
                $scope.loading = false;
                $scope.close = function(index) {
                    $scope.alerts.splice(index, 1);
                };
            });
        }else{
            $scope.loading = false;
            $scope.data = data;
        }

    }]);


controllers.controller('GenealogyPostCtrl', ['$scope', 'Posts',
    function($scope, Posts) {
        $scope.loading = true;
        $scope.data = Posts.query({}, function() {
            $scope.loading = false;
        }, function() {
            $scope.alerts = [
                {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз.'}
            ];
            $scope.loading = false;
            $scope.close = function(index) {
                $scope.alerts.splice(index, 1);
            };
        });
    }]);

controllers.controller('GenealogyPostShowCtrl', ['$scope', '$routeParams', 'Posts',
    function($scope, $routeParams, Posts) {
        $scope.loading = true;
        $scope.data = Posts.show({id: $routeParams.id}, function() {
            $scope.loading = false;
        }, function() {
            $scope.alerts = [
                {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз.'}
            ];
            $scope.loading = false;
            $scope.close = function(index) {
                $scope.alerts.splice(index, 1);
            };
        });

    }]);

controllers.controller('GenealogyViewCtrl', ['$scope', '$routeParams', 'ServiceView',
    function($scope, $routeParams, ServiceView) {
        $scope.data = ServiceView.get({id: $routeParams.id});
    }]);

controllers.controller('GenealogySearchCtrl', ['$scope', '$tour',
    function($scope, $tour) {
        $scope.startTour = $tour.start;
    }]);

controllers.controller('GenealogySettingsCtrl', ['$scope', '$tour',
    function($scope, $tour) {
        $scope.startTour = $tour.start;
    }]);

controllers.controller('ModalInstanceCtrl', function($scope, $modalInstance, ServiceId, id) {
    $scope.loading = true;
    $scope.data = ServiceId.show({id: id}, function() {
        $scope.loading = false;
    }, function() {
        $scope.alerts = [
            {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз.'}
        ];
        $scope.loading = false;
        $scope.close = function(index) {
            $scope.alerts.splice(index, 1);
        };
    });

    $scope.ok = function() {
        $modalInstance.close();
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
});

controllers.controller('PaginationCtrl', function($scope) {
    $scope.totalItems = 64;
    $scope.currentPage = 4;
    $scope.maxSize = 5;

    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.bigTotalItems = 175;
    $scope.bigCurrentPage = 1;
});