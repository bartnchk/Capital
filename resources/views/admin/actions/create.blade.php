@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')

    <h2>Акция</h2>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST"
          @if($action->id)
          action="{{ route('action.update', ['id' => $action->id]) }}"
          @else
          action="{{ route('action.store') }}"
          @endif
          class="form-group"  enctype="multipart/form-data">

        {{ csrf_field() }}

        @if($action->id)
            {{ method_field('put') }}
            <input type="hidden" name="url" value="{{ url()->previous() }}">
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ru-tab" data-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="true">русский</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uk-tab" data-toggle="tab" href="#uk" role="tab" aria-controls="uk" aria-selected="false">украинский</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-sm-8">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-tab"><br>
                        <div class="form-group">
                            <label>Заголовок акции *</label>
                            <input type="text" name="title_ru" class="form-control" value="{{ old('title_ru') ? old('title_ru') : $action->title_ru }}">
                        </div>
                        <div class="form-group">
                            <label>Описание акции *</label>
                            <textarea name="description_ru" class="form-control" rows="5" >{{ old('description_ru') ? old('description_ru') : $action->description_ru }}</textarea>
                        </div>
                        @isset($action)
                            @include('admin.includes.seo_tags_ru', array('page' => $action ))
                        @else
                            @include('admin.includes.seo_tags_ru')
                        @endisset
                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                        <div class="form-group">
                            <label>Заголовок акции *<small>(украинский вариант)</small></label>
                            <input type="text" name="title_uk" class="form-control"
                                   value="{{ old('title_uk') ? old('title_uk') : $action->title_uk }}">
                        </div>

                        <div class="form-group">
                            <label>Описание акции *<small>(украинский вариант)</small></label>
                            <textarea name="description_uk" class="form-control"
                                      rows="5">{{ old('description_uk') ? old('description_uk') : $action->description_uk }}</textarea>
                        </div>
                        @isset($action)
                            @include('admin.includes.seo_tags_uk', array('page' => $action ))
                        @else
                            @include('admin.includes.seo_tags_uk')
                        @endisset
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <br>
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="1" @if(isset($action) && $action->published ) {{ 'selected' }} @endif >
                            Опубликовано
                        </option>
                        <option value="0" @if(isset($action) && !$action->published ) {{ 'selected' }} @endif >
                            Не опубликовано
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Алиас</label>
                    <input type="text" name="alias"  class="form-control" value="{{ old('alias') ? old('alias') : $action->alias }}">
                    <small class="red">не заполнять если не уверены</small>
                </div>
                <div class="form-group">
                    <label for="">Регион *</label>
                    <select name="region_id[]" id="region" class="form-control chosen-select" multiple data-placeholder="Выберите регион">
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->title_ru }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Город *</label>
                    <select name="city_id[]" id="city"  class="form-control chosen-select @if(isset($cities)) {{ 'fillable' }} @endif" multiple data-placeholder="Выберите город">
                        @isset($cities)
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" selected data-region="{{ $city->region_id }}">{{ $city->title_ru }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="form-group">
                    <h5>Дата начала *</h5>
                    <span><small>выберите дату начала акции</small></span>
                    <input name="start_at" class="datepicker form-control" value="
                        @if(old('start_at'))
                            {{ old('start_at') }}
                        @elseif($action->start_at)
                            {{ date('d-m-Y', strtotime($action->start_at)) }}
                        @else
                            {{ '' }}
                        @endif
                    "/>
                </div>
                <div class="form-group">
                    <h5>Дата окончания *</h5>
                    <span><small>выберите дату окончания акции</small></span>
                    <input name="finish_at" class="datepicker form-control" value="
                        @if(old('finish_at'))
                            {{ old('finish_at') }}
                        @elseif($action->finish_at)
                            {{ date('d-m-Y', strtotime($action->finish_at)) }}
                        @else
                            {{ '' }}
                        @endif
                    "/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h5>Ссылка</h5>
        </div>
        <div class="row">


            <div class="col-sm-4">
                <div class="form-group">
                    <label>Название ссылки<br><small>не обязателньо для заполнения</small></label>
                    <input type="text" name="link_title" class="form-control"
                           value="{{ old('link_title') ? old('link_title') : $action->link_title }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Ссылка<br><small>не обязателньо для заполнения</small></label>
                    <input type="text" name="link" class="form-control"
                           value="{{ old('link') ? old('link') : $action->link }}" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Миниатюра для списка *</h5>
                    <span><small>будет отображаться в списке акций</small></span>
                    <input type="file" name="photo" class="form-control-file border" @if(!isset($action->photo))  @endif/>
                </div>
            </div>
            <div class="col-sm-4">
                <h5>Изображение на странице акции *</h5>
                <span><small>будет отображаться на странице акции</small></span>
                <input class="form-control-file border " type="file" name="wide_photo" @if(!isset($action->wide_photo))  @endif/>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-4">
                    @isset($action->photo)
                        <div class="card card-body bg-light">
                            <img src="{{ asset('storage/images/action/'.$action->photo) }}" alt="" class="img-fluid">
                        </div>
                    @endisset
                </div>

            </div>

            <div class="col-sm-6">
                <div class="col-sm-4">
                    @if($action->wide_photo)
                        <div class="card card-body bg-light">
                            <img src="{{ asset('storage/images/action/'.$action->wide_photo) }}" alt="" class="img-fluid">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <h5>Изображения для галереи</h5>
                <span><small>не обязательно для заполнения</small></span>
                <input class="form-control-file border" type="file" name="gallery[]" multiple />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4 d-flex flex-wrap">
                @if($action->id and count($action->images))
                    @foreach($action->images as $image)
                        <div class="col-sm-4">
                            <div class="card card-body bg-light">
                                <span class="admin-image-delete" @click="destroy">
                                    <i class="fa fa-times-circle-o delete-action-photo" aria-hidden="true" data-id="{{ $image->id }}"></i>
                                </span>
                                <img src="{{ asset('storage/images/action/' . $image->path) }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/wysiwyg.js')}}"></script>
@endsection