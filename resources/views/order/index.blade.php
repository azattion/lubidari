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
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Адрес</th>
                        <th>Параметры доставки</th>
                        <th>Дата доставки</th>
                        <th>Время доставки</th>
                        <th>Создан</th>
                        <th>Функции</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $one)
                            <tr>
                                <td>{{{$one->id}}}</td>
                                <td><a href="{{{route('administrator.order.show',$one->id)}}}">{{{$one->name}}}</a></td>
                                <td>{{{$one->phone}}}</td>
                                <td>{{{$one->address}}}</td>
                                <td>{{{$one->options}}}</td>
                                <td>{{{$one->delivery_date}}}</td>
                                <td>{{{$one->delivery_time}}}</td>
                                <td>{{{$one->created_at}}}</td>
                                <td>
                                    <a href="{{route('administrator.order.destroy',$one->id)}}"><span class="glyphicon glyphicon-trash"></span> Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination pagination-centered"></div>
                @else
                    <h4 class="text-center">Пока данных нет</h4>
                @endif
            </div>
        </div>
    </div>
@endsection