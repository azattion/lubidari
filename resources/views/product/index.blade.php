@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Размер</th>
                        <th>Вес</th>
                        <th>Функции</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $one)
                            <tr>
                                <td>{{{$one->id}}}</td>
                                <td><a href="{{{route('product.show',$one->id)}}}">{{{$one->title}}}</a></td>
                                <td>{{{$one->price}}}</td>
                                <td>{{{$one->size}}}</td>
                                <td>{{{$one->weight}}}</td>
                                <td>
                                    <a href="{{route('product.edit',$one->id)}}"><span class="glyphicon glyphicon-edit"></span> Правка</a>

                                    <a href="{{route('product.destroy',$one->id)}}"><span class="glyphicon glyphicon-trash"></span> Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination text-center">{!!$data->render()!!}</div>
            </div>
        </div>
    </div>
@endsection