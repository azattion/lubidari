<html ng-app="lubidariApp">
<head>
    <title>Люби дари</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Люби дари</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/angular.js') }}"></script>
    <script src="{{ asset('/js/ui-bootstrap-tpls-0.12.1.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/controllers.js') }}"></script>
    <script src="{{ asset('/js/directives.js') }}"></script>
    <script src="{{ asset('/js/resource.js') }}"></script>
    <script src="{{ asset('/js/route.js') }}"></script>
    <script src="{{ asset('/js/services.js') }}"></script>
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="height: 100px;">
            <div class="col-md-6">
                <h3><a href="/#/">Люби дари</a></h3>
            </div>
            <div class="col-md-6 text-right">
                <h3>+996 700 75 56 35</h3>
            </div>
        </div>
        <div class="col-lg-10 col-md-offset-1">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Контент</div>
                    <div class="panel-body">
                        <div ng-view></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина</div>
                    <div class="panel-body">Содержание</div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Фотографии доставок</div>
                    <div class="panel-body"><img ng-src="http://www.lubidari.ru/f/images/a_2262.jpg" width="100%"></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Фотографии доставок</div>
                    <div class="panel-body text-center">
                        <img ng-src="http://www.lubidari.ru/f/gallery/pre_2015-03-01_184712.jpg">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Отзывы клиентов</div>
                    <div class="panel-body">Екатерина
                        Хочу сказать огромное спасибо мастерам ООО "Люби Дари" за прекрасную работу. Очень красивый
                        получился тортик, заказывала своей маме на юбилей http://www.lubidari.ru/p-cvetochnyj_tort/.
                        Своевременная обратная связь, на протяжении всего времени держали меня в курсе. Доставили
                        вовремя, все очень позитивно!!! Очень красиво, даже лучше чем ожидала!!! Мама даже опешила от
                        такой красоты! Спасибо
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-12">© 2010-2015, ЛюбиДари — эксклюзивные подарки и игрушки из живых цветов</div>
        </div>
    </div>
</div>
</body>
</html>
