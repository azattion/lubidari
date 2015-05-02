'use strict';

/* App Module */
var genealogy = angular.module('lubidariApp', [
        'ngRoute',
        'ProdService',
        'Controllers',
        'ui.bootstrap',
        'angularFileUpload'
    ],
    function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<{').endSymbol('}>');
    });

var csrftoken =  (function() {
    // not need Jquery for doing that
    var metas = window.document.getElementsByTagName('meta');

    // finding one has csrf token
    for(var i=0 ; i < metas.length ; i++) {

        if ( metas[i].name === "csrf-token") {

            return  metas[i].content;
        }
    }

})();
genealogy.constant('CSRF_TOKEN', csrftoken);

genealogy.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '/js/template/home.html',
                controller: 'HomeCtrl'
            }).
            when('/:id', {
                templateUrl: '/js/template/show.html',
                controller: 'ShowCtrl'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);
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

controllers.controller('ShowCtrl', ['$scope', 'ServiceId', '$routeParams', '$window',
    function ($scope, ServiceId, $routeParams, $window) {
        $scope.loading = true;
        var data = JSON.parse($window.localStorage.getItem("data#" + $routeParams.id));
        if (data == null || data == undefined) {
            $scope.prod = ServiceId.show({id: $routeParams.id}, function () {
                $scope.loading = false;
                $window.localStorage.setItem("data#" + $routeParams.id, JSON.stringify($scope.prod));
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

controllers.controller('UploadController', ['$scope', 'FileUploader', function($scope, FileUploader) {
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var uploader = $scope.uploader = new FileUploader({
        url: '/administrator/photo/upload',
        headers : {
            'X-CSRF-TOKEN' : CSRF_TOKEN // X-CSRF-TOKEN is used for Ruby on Rails Tokens
        }
   });
// FILTERS

    uploader.filters.push({
        name: 'customFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
        }
    });

    // CALLBACKS

    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function(fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader.onAfterAddingAll = function(addedFileItems) {
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader.onBeforeUploadItem = function(item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader.onProgressItem = function(fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader.onProgressAll = function(progress) {
        console.info('onProgressAll', progress);
    };
    uploader.onSuccessItem = function(fileItem, response, status, headers) {
        console.info('onSuccessItem', fileItem, response, status, headers);
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers) {
        console.info('onCompleteItem', fileItem, response, status, headers);
    };
    uploader.onCompleteAll = function() {
        console.info('onCompleteAll');
    };

    console.info('uploader', uploader);
}]);

'use strict';

/* Filters */

angular.module('Filters', []);

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

//# sourceMappingURL=app.js.map