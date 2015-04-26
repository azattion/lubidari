@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Подарки/Просмотр</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4">Название</div>
                            <div class="col-md-6">
                                {{{$data->title}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Цена</div>
                            <div class="col-md-6">
                                {{{$data->price}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Состав</div>
                            <div class="col-md-6">
                                {{{$data->consist}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Описание</div>
                            <div class="col-md-6">
                                {{{$data->desc}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Упаковка</div>
                            <div class="col-md-6">
                                {{{$data->boxing}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Размер</div>
                            <div class="col-md-6">
                                {{{$data->size}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Вес</div>
                            <div class="col-md-6">
                                {{{$data->weight}}} кг.
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Срок изготовления</div>
                            <div class="col-md-6">
                                {{{$data->prod_time}}} день
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection