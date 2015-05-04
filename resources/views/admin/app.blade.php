@include('header')
<nav class="navbar navbar-default" style="z-index: 1030;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('adminHome')}}">Админ панель</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Логин</a></li>
                    <li><a href="{{ url('/auth/register') }}">Регистрация</a></li>
                @else
                    <li dropdown>
                        <a href="#" class="dropdown-toggle" dropdown-toggle ng-disabled="disabled">
                            Здравствуйте :  {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Выйти</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<aside class="main-sidebar">
    <h3>Навигация</h3>
    <section class="sidebar">
        <ul class="list-unstyled">

            <li><a href="{{ route('adminHome') }}"><span class="glyphicon glyphicon-home"></span>  Главная</a>
            </li>
            <li><a href="{{ route('administrator.category.index') }}"><span
                            class="glyphicon glyphicon-th"></span>  Категории товаров</a></li>
            <li><a href="{{ route('administrator.label.index') }}"><span
                            class="glyphicon glyphicon-tags"></span>     Метки</a></li>
            <li><a href="{{ route('administrator.product.index') }}"><span
                            class="glyphicon glyphicon-shopping-cart"></span> Товары</a></li>
            <li><a href="{{ route('administrator.order.index') }}"><span
                            class="glyphicon glyphicon-list-alt"></span>  Заказы</a></li>
            <li><a href="{{ route('administrator.photo.index') }}"><span
                            class="glyphicon glyphicon-picture"></span>  Картинки товаров</a></li>
            <li><a href="{{ route('adminStat') }}"><span class="glyphicon glyphicon-tasks"></span>
                     Статистика</a></li>
            <li><a href="/"><span class="glyphicon glyphicon-share-alt"></span> Главная стр. сайта</a>
            </li>
        </ul>
    </section>
</aside>

<div id="admin">

    <div class="container-fluid" ng-controller="AlertController">
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger" ng-init="alert=1" ng-show="alert">
                        <button type="button" class="close" ng-click="alert=0" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                        <span class="glyphicon glyphicon-warning-sign"></span> При обработке данных произашла ошибка<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-info" ng-init="alert=true" ng-show="alert">
                        <button type="button" class="close" ng-click="alert=false" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                        <p><span class="glyphicon glyphicon-bell"></span> {{ Session::get('message') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @yield('content')
</div>


@include('footer')
