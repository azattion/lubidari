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
                $scope.close = function (index) {
                    $scope.alerts.splice(index, 1);
                };
            });
        } else {
            $scope.loading = false;
            $scope.data = data;
        }
    }]);

controllers.controller('ShowCtrl', ['$scope', 'ServiceId','$routeParams',
    function ($scope, ServiceId, $routeParams) {
        $scope.loading = true;
        $scope.prod = ServiceId.show({id: $routeParams.id}, function () {
            $scope.loading = false;
        }, function () {
            $scope.loading = false;
        });
    }
]);