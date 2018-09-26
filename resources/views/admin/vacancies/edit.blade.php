@extends('admin.layouts.app')

@section('content')
    <h3>{{ isset($vacancy->id) ? 'Редактированее вакансии : ' .$vacancy->title_ru : 'Создание новой вакансии' }}</h3>
    <hr>
    <form method="POST"
          action="{{ isset($vacancy->id) ? route('vacancies.update', $vacancy->id) : route('vacancies.store')}}"
          id="item-form" class="form-group" enctype="multipart/form-data">
        {{isset($vacancy->id) ? method_field('PUT') : method_field('POST') }}

        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ isset($vacancy) ? $vacancy->id : '' }}"/>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#ru">русский</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#ua">украинский</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-sm-9">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="ru">
                        <br>
                        <div class="form-group">
                            <label>Название *</label>
                            <input type="text" name="title_ru" class="form-control"
                                   value="{{ isset($vacancy) ? $vacancy->title_ru : old('title_ru') }}">

                        </div>
                        <div class="form-group">
                            <label>Описание *</label>
                            <textarea name="description_ru" class="form-control" id="description_ru"
                                      rows="10">{{ isset($vacancy) ? $vacancy->description_ru : old('description_ru') }}
                            </textarea>
                        </div>
                    </div>
                    <br>
                    <div class="tab-pane fade" id="ua">
                        <div class="form-group">
                            <label>Название *</label>
                            <input type="text" name="title_uk" class="form-control"
                                   value="{{ isset($vacancy) ? $vacancy->title_uk : old('title_uk') }}">
                        </div>

                        <div class="form-group">
                            <label>Описание *</label>
                            <textarea name="description_uk" class="form-control" id="description_uk"
                                      rows="10">{{ isset($vacancy) ? $vacancy->description_uk : old('description_uk') }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="1" @if(isset($vacancy->published) && $vacancy->published  == $vacancy::PUBLISHED ) {{ 'selected' }} @endif >
                            Активен
                        </option>
                        <option value="0" @if(isset($vacancy->published) && $vacancy->published == $vacancy::UNPUBLISHED) {{ 'selected' }} @endif >
                            Не активен
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Категория *</label>
                    <select name="category_id" class="form-control" id="category" data-selected="{{ isset($vacancy) ? $vacancy->category_id : '' }}">
                        <option value="">Выберите категорию</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="">Область *</label>
                    <select name="region_id" class="form-control" id="region" data-selected="{{ isset($vacancy) ? $vacancy->region_id : old('region_id') }}">
                        <option value="">Выберите область</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" @if(isset($vacancy) && $vacancy->region_id == $region->id) {{ 'selected' }} @endif >{{ $region->title_ru }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Город *</label>
                    <select name="city_id" id="city" class="form-control"
                            data-selected="{{ isset($vacancy) ? $vacancy->city_id : old('city_id') }}" data-placeholder="Выберите город">
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Оклад</label>
                    <input type="text" name="salary" class="form-control" value="{{ isset($vacancy) ? $vacancy->salary : old('salary') }}">
                </div>

                <div class="form-group">
                    <label for="">Ссылка на вакансию</label>
                    <input type="text" name="link" class="form-control"  value="{{ isset($vacancy) ? $vacancy->link : old('link') }}">
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection

@section('scripts')
    <script src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script>
        var editor_config = {
            path_absolute: "/",
            mode: "textareas",
            plugins: [
                "advlist autolink autosave link lists charmap print preview hr anchor spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template textcolor paste textcolor colorpicker"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | ltr rtl | bullist numlist outdent indent removeformat formatselect| link image media | code codesample | forecolor backcolor",
            nanospell_server: "php",
            browser_spellcheck: true,
            relative_urls: false,
            remove_script_host: false,
        };

        tinyMCE.init(editor_config);

    </script>
@endsection