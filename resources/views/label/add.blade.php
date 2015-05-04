@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Метки/Добавить</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('administrator.label.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Название</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Категория меток</label>

                                <div class="radio  col-md-6">
                                    <label>
                                        <input type="radio" value="1" name="id_cat"> Праздник
                                    </label>
                                    <br/>
                                    <label>
                                        <input type="radio" value="2" name="id_cat"> Кому подарить?
                                    </label>
                                    <br/>
                                    <label>
                                        <input type="radio" value="3" name="id_cat"> Цвет компазиции
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить
                                    </button>
                                    <a class="btn btn-default"
                                       href="{{route('administrator.category.index')}}">Отмена</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection