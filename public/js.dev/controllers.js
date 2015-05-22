'use strict';

/* Controllers */

var controllers = angular.module('Controllers', []);
controllers.controller('HomeCtrl', ['$scope', 'Service', '$window','cfpLoadingBar',
    function ($scope, Service, $window, cfpLoadingBar) {
        $scope.loading = true;
        cfpLoadingBar.start();
        $scope.currentPage = 1;
        $scope.totalItems = 0;
        $scope.loadingItems = function (currentPage) {
            var data = JSON.parse($window.localStorage.getItem("data#page"+currentPage));
            if (data == null || data == undefined) {
                $scope.data = Service.query({page: currentPage}, function () {
                    $scope.loading = false;
                    cfpLoadingBar.complete();
                    $window.localStorage.setItem("data#page"+currentPage, JSON.stringify($scope.data));
                }, function () {
                    $scope.alerts = [
                        {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз'}
                    ];
                    $scope.loading = false;
                });
            } else {
                $scope.loading = false;
                $scope.data = data;
                $scope.totalItems = $scope.data.total;
            }
        }
        $scope.changePage = function (num) {
            $scope.currentPage = num;
            $scope.loadingItems(num);
        }
        $scope.loadingItems(1);
    }]);

controllers.controller('ShowCtrl', ['$scope', 'ServiceId', '$routeParams', 'DataCache',
    function ($scope, ServiceId, $routeParams, DataCache) {
        $scope.loading = true;
      /*  var data = JSON.parse($window.localStorage.getItem("data#" + $routeParams.id));
      /*  if (data == null || data == undefined) {
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
        }*/
        $scope.prod = DataCache.get('prod');

        if (!$scope.prod) {
            $scope.prod = ServiceId.show({id: $routeParams.id}, function () {
                $scope.loading = false;
                DataCache.put('prod', $scope.prod);
               // $window.localStorage.setItem("data#" + $routeParams.id, JSON.stringify($scope.prod));
            }, function () {
                $scope.loading = false;
                $scope.alerts = [
                    {type: 'danger', msg: 'Кечиресиз, жуктоо ийгиликсиз аяктады. Дагы аракет кылып корунуз'}
                ];
            });
        }

        console.log(DataCache.info());
    }
]);

controllers.controller('OrderCtrl', ['$scope', function ($scope) {
    $scope.CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    return $scope;
}]);

controllers.controller('CartCtrl', ['$scope', function ($scope) {
    return $scope;
}]);

controllers.controller('TimepickerCtrl', function ($scope) {
    $scope.mytime = new Date();
    $scope.hstep = 1;
    $scope.mstep = 15;
});

controllers.controller('DatepickerCtrl', function ($scope) {
    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };

    // Disable weekend selection
    $scope.disabled = function (date, mode) {
        return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 7 ) );
    };

    $scope.toggleMin = function () {
        $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    $scope.open = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];
});


controllers.controller('UploadController', ['$scope', 'FileUploader', function ($scope, FileUploader) {
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var uploader = $scope.uploader = new FileUploader({
        url: '/administrator/photo',
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        photo: ''
    });
// FILTERS

    uploader.filters.push({
        name: 'customFilter',
        fn: function (item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
        }
    });

    // CALLBACKS

    uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function (fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader.onAfterAddingAll = function (addedFileItems) {
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader.onBeforeUploadItem = function (item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader.onProgressItem = function (fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader.onProgressAll = function (progress) {
        console.info('onProgressAll', progress);
    };
    uploader.onSuccessItem = function (fileItem, response, status, headers) {
        uploader.photo = uploader.photo + response + ',';
        console.info('onSuccessItem', fileItem, response, status, headers);
    };
    uploader.onErrorItem = function (fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function (fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function (fileItem, response, status, headers) {
        console.info('onCompleteItem', fileItem, response, status, headers);
    };
    uploader.onCompleteAll = function () {
        console.info('onCompleteAll');
    };

    console.info('uploader', uploader);
}]);