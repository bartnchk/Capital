@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <h3>{{ $page->title_ru }}</h3>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST" action="{{ route('main.update', ['section' => $section, 'id' => $page->id]) }}" class="form-group"  enctype="multipart/form-data">

        {{ csrf_field() }}
        {{ method_field('put') }}

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
                                   value="{{ old('title_ru') ? old('title_ru') : $page->title_ru }}" >
                        </div>

                        <div class="form-group">
                            <label>Описание *</label>
                            <textarea name="description_ru" class="form-control" rows="5">{{ old('description_ru') ? old('description_ru') : $page->description_ru }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Заголовок * <small>(украинский вариант)</small></label>
                            <input type="text" name="title_uk" class="form-control"
                                   value="{{ old('title_uk') ? old('title_uk') : $page->title_uk }}">
                        </div>

                        <div class="form-group">
                            <label>Описание * <small>(украинский вариант)</small></label>
                            <textarea name="description_uk" class="form-control" rows="5">{{ old('description_uk') ? old('description_uk') : $page->description_uk }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h5>@if($section == 'bail')Цветное @endif  изображение</h5>
                    <input type="file" name="image" class="form-control-file" @if(!isset($page->image)) required @endif>
                </div>
            </div>
            @if($section == 'bail')
                <div class="col-sm-6">
                    <div class="form-group">
                        <h5>Двухцветное изображение</h5>
                        <input type="file" name="image_bw" class="form-control-file" @if(!isset($page->image_bw)) required @endif>
                    </div>
                </div>
            @endif

        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-3">
                    @isset($page->image)
                        <div class="card card-body bg-light">
                            <img src="{{ asset('storage/images/main/'.$page->image) }}" alt=""   class="img-fluid">
                        </div>
                    @endisset
                </div>
            </div>

            @if($section == 'bail')
                <div class="col-sm-6">
                    <div class="col-sm-3">
                        @isset($page->image_bw)
                            <div class="card card-body bg-light">
                                <img src="{{ asset('storage/images/main/'.$page->image_bw) }}" alt=""   class="img-fluid">
                            </div>
                        @endisset
                    </div>
                </div>
            @endif
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection