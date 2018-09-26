@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <h3>Баннер</h3>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST"
          @if(isset($banner))
            action="{{ route('banners.update', ['id' => $banner->id]) }}"
          @else
            action="{{ route('banners.store') }}"
          @endif
           class="form-group"  enctype="multipart/form-data">

        {{ csrf_field() }}
        @if(isset($banner)) {{ method_field('put') }} @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ru-tab" data-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="true">русский</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uk-tab" data-toggle="tab" href="#uk" role="tab" aria-controls="uk" aria-selected="false">украинский</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-tab"><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Заголовок *</label>
                            <input type="text" name="title_ru" class="form-control"
                                   @isset($banner)
                                   value="{{ old('title_ru') ? old('title_ru') : $banner->title_ru }}"
                                   @else
                                   value="{{ old('title_ru') }}"
                                    @endisset
                            >
                        </div>

                        <div class="form-group">
                            <label>Описание *</label>
                            <textarea name="description_ru" id="description_ru" class="form-control" rows="5">@isset($banner){{ old('description_ru') ? old('description_ru') : $banner->description_ru }}@else{{ old('description_ru') }}@endisset</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Заголовок *  <small>(украинский вариант)</small></label>
                            <input type="text" name="title_uk" class="form-control"
                            @isset($banner)
                                value="{{ old('title_uk') ? old('title_uk') : $banner->title_uk }}"
                            @else
                                   value="{{ old('title_uk') }}"
                            @endisset
                            >
                        </div>

                        <div class="form-group">
                            <label>Описание * <small>(украинский вариант)</small></label>
                            <textarea name="description_uk" id="description_ru" class="form-control" rows="5">@isset($banner){{ old('description_uk') ? old('description_uk') : $banner->description_uk }}@else{{ old('description_uk') }}@endisset</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <h6>Изображение *</h6>
                    <input type="file" name="image" class="form-control" @if(!isset($banner) ) {{ 'required' }} @endif>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Ссылка *</label>
                    <input type="text" name="link" class="form-control"
                       @isset($banner)
                            value="{{ old('link') ? old('link') : $banner->link }}"
                       @else
                            value="{{ old('link') }}"
                        @endisset
                    >

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="1" @if(isset($banner) &&  $banner->published ) {{ 'selected' }} @endif >
                            Опубликовано
                        </option>
                        <option value="0" @if(isset($banner) &&  !$banner->published ) {{ 'selected' }} @endif >
                            Не опубликовано
                        </option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-3">
                    @if(isset($banner->image))
                        <div class="card card-body bg-light">
                            <img src="{{ asset('storage/images/banners/'.$banner->image) }}" alt=""   class="img-fluid">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection