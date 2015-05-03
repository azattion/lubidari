@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Подарки</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST"
                              action="{{ route('administrator.product.store') }}">
                            <div class="col-md-12">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Название</label>
                                        <input min="2" max="255" required type="text" popover="Название товара" popover-trigger="focus"
                                               class="form-control" name="title" value="{{ old('title') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Категория</label>
                                        <select name="id_cat" class="form-control" required>
                                            @if($category):
                                            @foreach($category as $one)
                                                @if($one->id == old('id_cat'))
                                                    <option value="{{$one->id}}" selected>{{$one->title}}</option>
                                                    <?php continue?>
                                                @endif
                                                <option value="{{$one->id}}">{{$one->title}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5  col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">Цена</label>

                                        <div class="input-group">
                                            <input min="1" required type="number" popover="Цена товара в нац валюте"
                                                   popover-trigger="focus" class="form-control" name="price"
                                                   value="{{ old('price') }}">
                                            <span class="input-group-addon">сом</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Состав</label>
                                        <textarea min="2" max="255" required rows="3" popover="Состав товара" popover-trigger="focus" class="form-control"
                                                  name="consist">{{ old('consist') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Описание</label>
                                        <textarea min="2" max="255" required rows="3" name="desc" popover="Краткое описание товару" popover-trigger="focus"
                                                  class="form-control">{{ old('desc') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Упаковка</label>
                                        <textarea min="2" max="255" required rows="3" name="boxing" popover="Упаковка товара" popover-trigger="focus"
                                                  class="form-control">{{ old('boxing') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Размер</label>
                                        <input min="2" max="255" required popover="Размер высоты, ширины и длины" popover-trigger="focus"
                                               name="size" type="text" placeholder="например 12 * 12 * 45 "
                                               class="form-control" value="{{ old('size') }}">
                                    </div>
                                </div>
                                <div class="col-md-5  col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">Вес</label>

                                        <div class="input-group">
                                            <input required popover="Вес товара. Можно указать плавающяя числа"
                                                   popover-trigger="focus" min="1" max="100" name="weight" type="number"
                                                   class="form-control"
                                                   value="{{ old('weight') }}" step="any">
                                            <span class="input-group-addon"> кг.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Срок изготовления</label>

                                        <div class="input-group">
                                            <input required popover="Срок изготовления. Единица измерения  день"
                                                   popover-trigger="focus" min="1" max="10" name="prod_time" type="number"
                                                   class="form-control"
                                                   value="{{ old('prod_time') }}">
                                            <span class="input-group-addon">день</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" ng-controller="TypeaheadCtrl">
                                        <pre><input type="text" name="rofield" ng-value="selected" readonly="readonly" /></pre>
                                        <label>Метки</label>
                                        <input ng-model="selected" typeahead="state for state in states | filter:$viewValue | limitTo:8" required type="text" class="form-control" popover="Метки"
                                               popover-trigger="focus"/>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <hr/>
                                <div class="col-md-12">
                                    <div class="form-group" ng-controller="UploadController">
                                        <input type="hidden" name="photo" ng-init="uploader.photo" value="<{uploader.photo}>">
                                        <label>Картинки</label>
                                        <input type="file" nv-file-select uploader="uploader" multiple/><br/>
                                        <ul>
                                            <li ng-repeat="item in uploader.queue">
                                                Название: <span ng-bind="item.file.name"></span>
                                            </li>
                                        </ul>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th width="50%">Название</th>
                                                <th ng-show="uploader.isHTML5">Размер</th>
                                                <th ng-show="uploader.isHTML5">Прогресс</th>
                                                <th>Статус</th>
                                                <th>Функции</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in uploader.queue">
                                                <td><{ item.file.name }></td>
                                                <td ng-show="uploader.isHTML5" nowrap><{item.file.size/1024/1024|number:2 }> MB
                                                </td>
                                                <td ng-show="uploader.isHTML5">
                                                    <div class="progress" style="margin-bottom: 0;">
                                                        <div class="progress-bar" role="progressbar"
                                                             ng-style="{ 'width': item.progress + '%' }"></div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span ng-show="item.isSuccess"><i
                                                                class="glyphicon glyphicon-ok"></i></span>
                                                    <span ng-show="item.isCancel"><i
                                                                class="glyphicon glyphicon-ban-circle"></i></span>
                                                    <span ng-show="item.isError"><i
                                                                class="glyphicon glyphicon-remove"></i></span>
                                                </td>
                                                <td nowrap>
                                                    <button type="button" class="btn btn-success btn-xs"
                                                            ng-click="item.upload()"
                                                            ng-disabled="item.isReady || item.isUploading || item.isSuccess">
                                                        <span class="glyphicon glyphicon-upload"></span> Загрузить
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs"
                                                            ng-click="item.cancel()"
                                                            ng-disabled="!item.isUploading">
                                                        <span class="glyphicon glyphicon-ban-circle"></span> Отменить
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs"
                                                            ng-click="item.remove()">
                                                        <span class="glyphicon glyphicon-trash"></span> Удалить
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div>
                                            <div>
                                                Прогресс:
                                                <div class="progress" style="">
                                                    <div class="progress-bar" role="progressbar"
                                                         ng-style="{ 'width': uploader.progress + '%' }"></div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-link btn-s"
                                                    ng-click="uploader.uploadAll()"
                                                    ng-disabled="!uploader.getNotUploadedItems().length">
                                                <span class="glyphicon glyphicon-upload"></span> Загрузить все
                                            </button>
                                            <button type="button" class="btn btn-link btn-s"
                                                    ng-click="uploader.cancelAll()"
                                                    ng-disabled="!uploader.isUploading">
                                                <span class="glyphicon glyphicon-ban-circle"></span> Отменить все
                                            </button>
                                            <button type="button" class="btn btn-link btn-s"
                                                    ng-click="uploader.clearQueue()"
                                                    ng-disabled="!uploader.queue.length">
                                                <span class="glyphicon glyphicon-trash"></span> Удалить все
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-4">
                                             <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-ok"></span> Добавить
                                            </button>
                                            <a class="btn btn-default"
                                               href="{{route('administrator.product.index')}}">
                                                <span class="glyphicon glyphicon-ban-circle"></span> Отмена</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection