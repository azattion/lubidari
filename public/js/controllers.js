'use strict';

/* Controllers */

var controllers = angular.module('Controllers', []);
controllers.controller('HomeCtrl', ['$scope', 'Service', '$window',
    function ($scope, Service, $window) {
        $scope.loading = true;
        var data = JSON.parse($window.localStorage.getItem("data"));
        if (data == null || data == undefined) {
            $scope.data = Service.query({}, function () {
                $scope.loading = false;
                $window.localStorage.setItem("data", JSON.stringify($scope.data));
            }, function () {
                $scope.alerts = [
                    {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз'}
                ];
                $scope.loading = false;
            });
        } else {
            $scope.loading = false;
            $scope.data = data;
        }
    }]);

controllers.controller('ShowCtrl', ['$scope', 'ServiceId','$routeParams','$window',
    function ($scope, ServiceId, $routeParams, $window) {
        $scope.loading = true;
        var data = JSON.parse($window.localStorage.getItem("data#"+$routeParams.id));
        if (data == null || data == undefined) {
            $scope.prod = ServiceId.show({id: $routeParams.id}, function () {
                $scope.loading = false;
                $window.localStorage.setItem("data#"+$routeParams.id, JSON.stringify($scope.prod));
            }, function () {
                $scope.loading = false;
                $scope.alerts = [
                    {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз'}
                ];
            });
        } else {
            $scope.loading = false;
            $scope.prod = data;
        }
    }
]);