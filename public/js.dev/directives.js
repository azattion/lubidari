var direct = angular.module('Directive', []);

direct.directive('product', ['$window',
    function ($window) {
        function link($scope, e) {
            e.children(".btn-link").on("click", function () {
                $window.item =  JSON.stringify($scope.one);
                console.log($window.item);
            });
        }

        return {
            restrict: "E",
            replace: true,
            scope: true,
            templateUrl: '/js/template/product.html',
            link: function ($scope, e) {
                link($scope, e);
            }
        }
    }]);