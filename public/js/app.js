'use strict';

/* App Module */
var lubidari = angular.module('lubidariApp', [
        'ngRoute',
        'ngAnimate',
        'ngCart',
        'angular-loading-bar',
        'ProdService',
        'Controllers',
        'Directive',
        'ui.bootstrap',
        'angularFileUpload'
    ],
    function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<{').endSymbol('}>');
    });
lubidari.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);

lubidari.factory('DataCache', function ($cacheFactory) {
    return $cacheFactory('dataCache', {});
});

lubidari.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
            when('/home', {
                templateUrl: '/js/template/home.html',
                controller: 'HomeCtrl'
            }).
            when('/to-order', {
                templateUrl: '/js/template/order.html',
                controller: 'OrderCtrl'
            }).
            when('/cart', {
                templateUrl: '/js/template/cart.html',
                controller: 'CartCtrl'
            }).
            when('/:id', {
                templateUrl: '/js/template/show.html',
                controller: 'ShowCtrl'
            }).
            otherwise({
                redirectTo: '/home'
            });
    }]);
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
'use strict';

/* Filters */

angular.module('Filters', []);

'use strict';


angular.module('ngCart', ['ngCart.directives'])

    .config([function () {

    }])

    .provider('$ngCart', function () {
        this.$get = function () {
        };
    })

    .run(['$rootScope', 'ngCart','ngCartItem', 'store', function ($rootScope, ngCart, ngCartItem, store) {

        $rootScope.$on('ngCart:change', function(){
            ngCart.$save();
        });

        if (angular.isObject(store.get('cart'))) {
            ngCart.$restore(store.get('cart'));

        } else {
            ngCart.init();
        }

    }])

    .service('ngCart', ['$rootScope', 'ngCartItem', 'store', function ($rootScope, ngCartItem, store) {

        this.init = function(){
            this.$cart = {
                shipping : null,
                taxRate : null,
                tax : null,
                items : []
            };
        };

        this.addItem = function (id, name, price, quantity, data) {

            var inCart = this.getItemById(id);

            if (typeof inCart === 'object'){
                //Update quantity of an item if it's already in the cart
                inCart.setQuantity(quantity, false);
            } else {
                var newItem = new ngCartItem(id, name, price, quantity, data);
                this.$cart.items.push(newItem);
                $rootScope.$broadcast('ngCart:itemAdded', newItem);
            }

            $rootScope.$broadcast('ngCart:change', {});
        };

        this.getItemById = function (itemId) {
            var items = this.getCart().items;
            var build = false;

            angular.forEach(items, function (item) {
                if  (item.getId() === itemId) {
                    build = item;
                }
            });
            return build;
        };

        this.setShipping = function(shipping){
            this.$cart.shipping = shipping;
            return this.getShipping();
        };

        this.getShipping = function(){
            if (this.getCart().items.length == 0) return 0;
            return  this.getCart().shipping;
        };

        this.setTaxRate = function(taxRate){
            this.$cart.taxRate = +parseFloat(taxRate).toFixed(2);
            return this.getTaxRate();
        };

        this.getTaxRate = function(){
            return this.$cart.taxRate
        };

        this.getTax = function(){
            return +parseFloat(((this.getSubTotal()/100) * this.getCart().taxRate )).toFixed(2);
        };

        this.setCart = function (cart) {
            this.$cart = cart;
            return this.getCart();
        };

        this.getCart = function(){
            return this.$cart;
        };

        this.getItems = function(){
            return this.getCart().items;
        };

        this.getTotalItems = function () {
            var count = 0;
            var items = this.getItems();
            angular.forEach(items, function (item) {
                count += item.getQuantity();
            });
            return count;
        };

        this.getTotalUniqueItems = function () {
            return this.getCart().items.length;
        };

        this.getSubTotal = function(){
            var total = 0;
            angular.forEach(this.getCart().items, function (item) {
                total += item.getTotal();
            });
            return +parseFloat(total).toFixed(2);
        };

        this.totalCost = function () {
            return +parseFloat(this.getSubTotal() + this.getShipping() + this.getTax()).toFixed(2);
        };

        this.removeItem = function (index) {
            this.$cart.items.splice(index, 1);
            $rootScope.$broadcast('ngCart:itemRemoved', {});
            $rootScope.$broadcast('ngCart:change', {});

        };

        this.removeItemById = function (id) {
            var cart = this.getCart();
            angular.forEach(cart.items, function (item, index) {
                if  (item.getId() === id) {
                    cart.items.splice(index, 1);
                }
            });
            this.setCart(cart);
            $rootScope.$broadcast('ngCart:itemRemoved', {});
            $rootScope.$broadcast('ngCart:change', {});
        };

        this.empty = function () {

            $rootScope.$broadcast('ngCart:change', {});
            this.$cart.items = [];
            localStorage.removeItem('cart');
        };

        this.toObject = function() {

            if (this.getItems().length === 0) return false;

            var items = [];
            angular.forEach(this.getItems(), function(item){
                items.push (item.toObject());
            });

            return {
                shipping: this.getShipping(),
                tax: this.getTax(),
                taxRate: this.getTaxRate(),
                subTotal: this.getSubTotal(),
                totalCost: this.totalCost(),
                items:items
            }
        };


        this.$restore = function(storedCart){
            var _self = this;
            _self.init();
            _self.$cart.shipping = storedCart.shipping;
            _self.$cart.tax = storedCart.tax;

            angular.forEach(storedCart.items, function (item) {
                _self.$cart.items.push(new ngCartItem(item._id,  item._name, item._price, item._quantity, item._data));
            });
            this.$save();
        };

        this.$save = function () {
            return store.set('cart', JSON.stringify(this.getCart()));
        }

    }])

    .factory('ngCartItem', ['$rootScope', '$log', function ($rootScope, $log) {

        var item = function (id, name, price, quantity, data) {
            this.setId(id);
            this.setName(name);
            this.setPrice(price);
            this.setQuantity(quantity);
            this.setData(data);
        };


        item.prototype.setId = function(id){
            if (id)  this._id = id;
            else {
                $log.error('An ID must be provided');
            }
        };

        item.prototype.getId = function(){
            return this._id;
        };


        item.prototype.setName = function(name){
            if (name)  this._name = name;
            else {
                $log.error('A name must be provided');
            }
        };
        item.prototype.getName = function(){
            return this._name;
        };

        item.prototype.setPrice = function(price){
            var priceFloat = parseFloat(price);
            if (priceFloat) {
                if (priceFloat <= 0) {
                    $log.error('A price must be over 0');
                } else {
                    this._price = (priceFloat);
                }
            } else {
                $log.error('A price must be provided');
            }
        };
        item.prototype.getPrice = function(){
            return this._price;
        };


        item.prototype.setQuantity = function(quantity, relative){


            var quantityInt = parseInt(quantity);
            if (quantityInt % 1 === 0){
                if (relative === true){
                    this._quantity  += quantityInt;
                } else {
                    this._quantity = quantityInt;
                }
                if (this._quantity < 1) this._quantity = 1;

            } else {
                this._quantity = 1;
                $log.info('Quantity must be an integer and was defaulted to 1');
            }
            $rootScope.$broadcast('ngCart:change', {});

        };

        item.prototype.getQuantity = function(){
            return this._quantity;
        };

        item.prototype.setData = function(data){
            if (data) this._data = data;
        };

        item.prototype.getData = function(){
            if (this._data) return this._data;
            else $log.info('This item has no data');
        };


        item.prototype.getTotal = function(){
            return +parseFloat(this.getQuantity() * this.getPrice()).toFixed(2);
        };

        item.prototype.toObject = function() {
            return {
                id: this.getId(),
                name: this.getName(),
                price: this.getPrice(),
                quantity: this.getQuantity(),
                data: this.getData(),
                total: this.getTotal()
            }
        };

        return item;

    }])

    .service('store', ['$window', function ($window) {

        return {

            get: function (key) {
                if ($window.localStorage [key]) {
                    var cart = angular.fromJson($window.localStorage [key]);
                    return JSON.parse(cart);
                }
                return false;

            },


            set: function (key, val) {

                if (val === undefined) {
                    $window.localStorage .removeItem(key);
                } else {
                    $window.localStorage [key] = angular.toJson(val);
                }
                return $window.localStorage [key];
            }
        }
    }])

    .controller('CartController',['$scope', 'ngCart', function($scope, ngCart) {
        $scope.ngCart = ngCart;

    }])

    .value('version', '0.0.3-rc.1');
;'use strict';


angular.module('ngCart.directives', ['ngCart.fulfilment'])

    .controller('CartController',['$scope', 'ngCart', function($scope, ngCart) {
        $scope.ngCart = ngCart;
    }])

    .directive('ngcartAddtocart', ['ngCart', function(ngCart){
        return {
            restrict : 'E',
            controller : 'CartController',
            scope: {
                id:'@',
                name:'@',
                quantity:'@',
                quantityMax:'@',
                price:'@',
                data:'='
            },
            transclude: true,
            templateUrl: '/js/template/addtocart.html',
            link:function(scope, element, attrs){
                scope.attrs = attrs;
                scope.inCart = function(){
                    return  ngCart.getItemById(attrs.id);
                };

                if (scope.inCart()){
                    scope.q = ngCart.getItemById(attrs.id).getQuantity();
                } else {
                    scope.q = parseInt(scope.quantity);
                }

                scope.qtyOpt =  [];
                for (var i = 1; i <= scope.quantityMax; i++) {
                    scope.qtyOpt.push(i);
                }

            }

        };
    }])

    .directive('ngcartCart', [function(){
        return {
            restrict : 'E',
            controller : 'CartController',
            scope: {},
            templateUrl: '/js/template/cart.html',
            link:function(scope, element, attrs){

            }
        };
    }])

    .directive('ngcartSummary', [function(){
        return {
            restrict : 'E',
            controller : 'CartController',
            scope: {},
            transclude: true,
            templateUrl: '/js/template/summary.html'
        };
    }])

    .directive('ngcartCheckout', [function(){
        return {
            restrict : 'E',
            controller : ('CartController', ['$scope', 'ngCart', 'fulfilmentProvider', function($scope, ngCart, fulfilmentProvider) {
                $scope.ngCart = ngCart;

                $scope.checkout = function () {
                    fulfilmentProvider.setService($scope.service);
                    fulfilmentProvider.setSettings($scope.settings);
                    var promise = fulfilmentProvider.checkout();
                    console.log(promise);
                }
            }]),
            scope: {
                service:'@',
                settings:'='
            },
            transclude: true,
            templateUrl: 'template/ngCart/checkout.html'
        };
    }]);;
angular.module('ngCart.fulfilment', [])
    .service('fulfilmentProvider', ['$injector', function($injector){

        this._obj = {
            service : undefined,
            settings : undefined
        };

        this.setService = function(service){
            this._obj.service = service;
        };

        this.setSettings = function(settings){
            this._obj.settings = settings;
        };

        this.checkout = function(){
            var provider = $injector.get('ngCart.fulfilment.' + this._obj.service);
            return provider.checkout(this._obj.settings);

        }

    }])


    .service('ngCart.fulfilment.log', ['$q', '$log', 'ngCart', function($q, $log, ngCart){

        this.checkout = function(){

            var deferred = $q.defer();

            $log.info(ngCart.toObject());
            deferred.resolve({
                cart:ngCart.toObject()
            });

            return deferred.promise;

        }

    }])

    .service('ngCart.fulfilment.http', ['$http', 'ngCart', function($http, ngCart){

        this.checkout = function(settings){
            return $http.post(settings.url,
                {data:ngCart.toObject()})
        }
    }])


    .service('ngCart.fulfilment.paypal', ['$http', 'ngCart', function($http, ngCart){


    }]);
'use strict';
/* Services */

var services = angular.module('ProdService', ['ngResource']);
services.factory('Service',
        function($resource) {
            return $resource('/product/list?page=:page',{},
                    {query: {method: 'GET', params: {page: '@page'}}});
        });
services.factory('ServiceId',
        function($resource) {
            return $resource('/product/show/:id', {}, {
                show: {method: 'GET', params: {id: '@id'}}
            });
        });

//# sourceMappingURL=app.js.map