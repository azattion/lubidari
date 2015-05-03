@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Категории/Добавить</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('administrator.category.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Название</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="3" name="desc">{{old('desc')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Ключевые слова</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="3" name="keywords">{{old('keywords')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить
                                    </button>
                                    <a class="btn btn-default" href="{{route('administrator.category.index')}}">Отмена</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection