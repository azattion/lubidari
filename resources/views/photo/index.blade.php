@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if(count($data)>0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Путь</th>
                        <th>Создан</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $one)
                        <tr>
                            <td>{{{$one->id}}}</td>
                            <td>{{{$one->title}}}</td>
                            <td>{{{$one->full-url}}}</td>
                            <td>{{{$one->created_at}}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination text-center">{!!$data->render()!!}</div>
                @else
                    <h4 class="text-center">Пока данных нет</h4>
                @endif
            </div>
        </div>
    </div>
@endsection