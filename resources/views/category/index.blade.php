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
                        <th>Описание</th>
                        <th>Ключевые слова</th>
                        <th>Функции</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $one)
                        <tr>
                            <td>{{{$one->id}}}</td>
                            <td>{{{$one->title}}}</td>
                            <td>{{{$one->desc}}}</td>
                            <td>{{{$one->keywords}}}</td>
                            <td>
                                <div class="input-group">
                                    <form action="{{route('administrator.category.destroy',$one->id)}}" method="POST" name="delete">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <a href="{{route('administrator.category.edit',$one->id)}}"><span
                                                    class="glyphicon glyphicon-edit"></span></a>
                                        <button type="submit" class="btn btn-link"><span
                                                    class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                </div>
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