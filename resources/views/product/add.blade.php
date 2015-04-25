@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Подарки/Добавить</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('product.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Название</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Цена</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Состав</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="consist">{{ old('consist') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea name="desc" class="form-control">{{ old('desc') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Упаковка</label>
                                <div class="col-md-6">
                                    <textarea name="boxing" class="form-control">{{ old('boxing') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Размер</label>
                                <div class="col-md-6">
                                    <input name="size" type="text" class="form-control" value="{{ old('size') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Вес</label>
                                <div class="col-md-6">
                                    <input name="weight" type="number" class="form-control" value="{{ old('weight') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Срок изготовления</label>
                                <div class="col-md-6">
                                    <input name="prod_time" type="number" class="form-control" value="{{ old('prod_time') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection