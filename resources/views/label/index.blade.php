@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success" href="{{route('administrator.label.create')}}">
                    <span class="glyphicon glyphicon-plus"></span> Добавить метку
                </a>
            </div>
            <hr/>
            <div class="col-md-12">
                @if(count($data)>0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Функции</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $one)
                            <tr>
                                <td>{{{$one->id}}}</td>
                                <td>{{{$one->title}}}</td>
                                <td>{{{$cat[$one->id_cat]}}}</td>
                                <td>
                                    <form action="{{route('administrator.label.destroy',$one->id)}}" method="POST"
                                          name="delete">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <a href="{{route('administrator.label.edit',$one->id)}}"
                                           class="btn btn-link btn-sm"><span
                                                    class="glyphicon glyphicon-edit"></span></a>
                                        <button type="submit" class="btn btn-link btn-sm"><span
                                                    class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                </td>
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