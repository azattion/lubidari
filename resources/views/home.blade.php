@include('header')

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
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Корзина</div>
                    <div class="panel-body">
                        <a href="#/cart">Корзина</a>
                        <a href="#/to-order">Оформить заказ</a>
                    </div>
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
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">© 2015, ЛюбиДари — эксклюзивные подарки и игрушки из живых цветов</div>
    </div>
</div>
@include('footer')
