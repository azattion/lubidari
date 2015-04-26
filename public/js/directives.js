var direc = angular.module('GenDirective', []);
/* Pedigree */
direc.directive('pedigreeNode', ['$window',
    function ($window) {
        function d($scope, e) {
            var t = e.parents("li").find(".nodes>.node").outerHeight(true) / 2;
            var n = e.find(".nodes>.node").offset().top;
            if (e.parents("li").offset() != null)
                var r = e.parents("li").offset().left;
            var verHei = e.offset().left - r - e.parents("li").find(".nodes>.node").outerWidth(true) / 2;
            if (e.parents("li").offset() == null) {
                var i = 0;
            } else {
                var s = e.parents("li").find(".nodes>.node").offset().top + e.parents("li").find(".nodes>.node").height() / 2;
                var o = n + e.find(".nodes>.node").height() / 2;
                var i = s - o;
            }

            var u = i < 0 ? -Math.abs(i) + t : t;
            e.children("span.horizontal").css({
                height: 2,
                width: verHei,
                "margin-left": -verHei,
                "margin-top": t,
                top: n
            });
            e.children("span.vertical").css({
                width: 2,
                height: Math.abs(i),
               // "margin-left": -verHei,
                "margin-top": u,
                left: r+ e.parents('li').find(".nodes>.node").outerWidth()/2,
                top: n
            });
        }

        return {
            restrict: "A",
            replace: true,
            scope: {},
            link: function ($scope, $element) {
                var vertical = angular.element("<span></span>");
                var horizontal = vertical.clone().addClass('horizontal');
                var pedigree = $('#pedigree ul>li');
                vertical.addClass('vertical');
                $element.prepend(vertical).prepend(horizontal);
                $scope.getElement = function () {
                    return {'w': pedigree.width(), 'h': pedigree.height()};
                };
                $scope.$watch($scope.getElement, function () {
                    d($scope, $element);
                }, true);
                var win = angular.element($window);
                win.bind("resize", function () {
                    d($scope, $element);
                });
                d($scope, $element);
            }
        };
    }]);
/* end Pedigree */

/* Tree */
direc.directive('treeNode', ['$window',
    function ($window) {
        function d($scope, e) {
            var t = e.children("div.node").outerWidth(true) / 2;
            var n = e.children("div.node").offset().left;
            if (e.parents("li").offset() != null)
                var r = e.parents("li").offset().top;
            var verHei = e.offset().top - r - e.parents("li").children("div").outerHeight(true) / 2;
            if (e.parents("li").offset() == null) {
                var i = 0;
            } else {
                var s = e.parents("li").children("div.node").offset().left + e.parents("li").children("div.node").width() / 2;
                var o = n + e.children("div.node").width() / 2;
                var i = s - o;
            }
            var u = i < 0 ? -Math.abs(i) + t : t;
            e.children("span.vertical").css({
                height: verHei,
                "margin-top": -verHei,
                "margin-left": t,
                left: n
            });
            e.children("span.horizontal").css({
                width: Math.abs(i),
                "margin-top": -verHei,
                "margin-left": u,
                left: n
            });
        }

        return {
            restrict: "A",
            replace: true,
            scope: {},
            link: function ($scope, $element) {
                var vertical = angular.element("<span></span>");
                var horizontal = vertical.clone().addClass('horizontal');
                var tree = $('ul.tree');
                vertical.addClass('vertical');
                $element.prepend(vertical).prepend(horizontal);
                $scope.getElement = function () {
                    return {'w': tree.width(), 'h': tree.height()};
                };
                $scope.$watch($scope.getElement, function () {
                    d($scope, $element);
                }, true);
                var win = angular.element($window);
                win.bind("resize", function () {
                    d($scope, $element);
                });
                d($scope, $element);
            }
        };
    }]);
/* end tree  */

