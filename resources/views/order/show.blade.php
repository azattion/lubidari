@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Заказы/Просмотр</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4">ФИО</div>
                            <div class="col-md-8">
                                {{{$data->name}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Телефон</div>
                            <div class="col-md-8">
                                {{{$data->phone}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Адрес</div>
                            <div class="col-md-8">
                                {{{$data->address}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Статус</div>
                            <div class="col-md-8">
                                {{{$data->status}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Дата доставки</div>
                            <div class="col-md-8">
                                {{{$data->delivery_date}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Время доставки</div>
                            <div class="col-md-8">
                                {{{$data->delivery_time}}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">Товары</div>
                            <div class="col-md-8">
                                {{{var_dump($data->items)}}}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection