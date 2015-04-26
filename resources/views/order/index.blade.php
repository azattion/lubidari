@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
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
                        <th>Функции</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $one)
                            <tr>
                                <td>{{{$one->id}}}</td>
                                <td><a href="{{{route('order.show',$one->id)}}}">{{{$one->name}}}</a></td>
                                <td>{{{$one->phone}}}</td>
                                <td>{{{$one->address}}}</td>
                                <td>{{{$one->options}}}</td>
                                <td>{{{$one->delivery_date}}}</td>
                                <td>{{{$one->delivery_time}}}</td>
                                <td>
                                    <a href="{{route('order.destroy',$one->id)}}"><span class="glyphicon glyphicon-trash"></span> Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination pagination-centered"></div>
            </div>
        </div>
    </div>
@endsection