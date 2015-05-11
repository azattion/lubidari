var direct = angular.module('Directive', []);

direct.directive('product', ['$window',
    function ($window) {
        function link($scope, e) {
            e.children(".btn-link").on("click", function () {
                $window.item = JSON.stringify($scope.one);
               // console.log($window.item);
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

direct.directive('buttonToCart', ['$window',
    function ($window) {
        return {
            restrict: "E",
            replace: true,
            scope: {
                id: '@',
                name: '@',
                quantity: '@',
                price: '@'
            },
            template: '<button class="btn btn-link" >' +
            '<span class="glyphicon glyphicon-shopping-cart"> Заказать</span>' +
            '</button>',
            link: function (scope, el, attr) {

                el.on('click', function(){
                    var data = {'id': attr.id,'quantity': attr.quantity };
                    $window.localStorage.setItem("cart",JSON.parse(data));
                });

                scope.inCart = function () {
                   // alert("4541415");
                   // return ngCart.getItemById(attrs.id);
                };

                if (scope.inCart()) {
                   // scope.q = ngCart.getItemById(attrs.id).getQuantity();
                } else {
                   // scope.q = parseInt(scope.quantity);
                }

                scope.qtyOpt = [];
                for (var i = 1; i <= scope.quantityMax; i++) {
                   // scope.qtyOpt.push(i);
                }
            }
        }
    }
]);