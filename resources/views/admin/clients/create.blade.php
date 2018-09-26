@extends('admin.layouts.app')


@section('content')

    <h3>Услуга</h3>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST"
          @if($client->id)
          action="{{ route('client.update', ['id' => $client->id]) }}"
          @else
          action="{{ route('client.store') }}"
          @endif
          class="form-group"  enctype="multipart/form-data">

        {{ csrf_field() }}

        @if($client->id)
            {{ method_field('put') }}
        @endif

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
                            <label>Заголовок услуги *</label>
                            <input type="text" name="title_ru" class="form-control" value="{{ ($client->id) ? $client->title_ru : old('title_ru') }}">
                        </div>

                        <div class="form-group">
                            <label>Описание услуги *</label>
                            <textarea name="description_ru" class="form-control" rows="5" >{{ ($client->id) ? $client->description_ru : old('description_ru') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Заголовок услуги *<small>(украинский вариант)</small></label>
                            <input type="text" name="title_uk" class="form-control"
                                   value="{{ ($client->id) ? $client->title_uk : old('title_uk') }}">
                        </div>

                        <div class="form-group">
                            <label>Описание услуги *<small>(украинский вариант)</small></label>
                            <textarea name="description_uk" class="form-control"
                                      rows="5">{{ ($client->id) ? $client->description_uk : old('description_uk') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="1" @if(isset($client) &&  $client->published ) {{ 'selected' }} @endif >
                            Опубликовано
                        </option>
                        <option value="0" @if(isset($client) &&  !$client->published ) {{ 'selected' }} @endif >
                            Не опубликовано
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Алиас</label>
                    <input type="text" name="alias"  class="form-control" value="@if($client->id) {{ $client->alias }} @endif">
                    <small class="red">не заполнять если не уверены</small>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h5>Изображение *</h5>
                    <span><small>будет отображаться в списке акций</small></span>
                    <input type="file" name="photo" class="form-control" @if(!isset($client->photo))  @endif/>
                </div>
            </div>
            <div class="col-sm-6">
                <h5>Изображения для галереи</h5>
                <span><small>не обязательно для заполнения</small></span>
                <input class="form-control" type="file" name="gallery[]" multiple />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-3">
                    @if($client->id)
                        <div class="card card-body bg-light">
                            <img src="{{ asset('storage/images/client/'.$client->photo) }}" alt="" class="img-fluid">
                        </div>
                    @endif
                </div>

            </div>

            <div class="col-sm-6 d-flex flex-wrap">
                @if($client->id and count($client->images))
                    @foreach($client->images as $image)
                        <div class="col-sm-3">
                            <div class="card card-body bg-light">
                                <span class="admin-image-delete" @click="destroy">
                                    <i class="fa fa-times-circle-o delete-client-photo" aria-hidden="true" data-id="{{ $image->id }}"></i>
                                </span>
                                <img src="{{ asset('storage/images/client/' . $image->path) }}" alt="" class="img-fluid">
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