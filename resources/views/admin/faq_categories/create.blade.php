@extends('admin.layouts.app')

@section('content')
    <h2>Категория часто задаваемых вопросов</h2>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST"
          @if(isset($category))
          action="{{ route('faq_categories.update', ['id' => $category->id]) }}"
          @else
          action="{{ route('faq_categories.store') }}"
          @endif
          class="form-group">

        {{ csrf_field() }}
        @if(isset($category))
            {{ method_field('put') }}
            <input type="hidden" name="alias" value="{{ $category->alias }}">
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
                            <label>Название категории *</label>
                            <input type="text" name="title_ru" class="form-control"
                               @isset($category)
                                   value="{{ old('title_ru') ? old('title_ru') : $category->title_ru }}"
                               @else
                                   value="{{ old('title_ru') }}"
                                @endisset
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Название категории * <small>(украинский вариант)</small></label>
                            <input type="text" name="title_uk" class="form-control"
                               @isset($category)
                                   value="{{ old('title_uk') ? old('title_uk') : $category->title_uk }}"
                               @else
                                   value="{{ old('title_uk') }}"
                                @endisset
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" class="form-control">
                        <option value="1" @if(isset($category) &&  $category->published ) {{ 'selected' }} @endif >
                            Опубликовано
                        </option>
                        <option value="0" @if(isset($category) &&  !$category->published ) {{ 'selected' }} @endif >
                            Не опубликовано
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Алиас</label>
                    <input type="text" name="alias"  class="form-control" value="@if(isset($category)) {{ $category->alias }} @endif">
                    <small class="red">не заполнять если не уверены</small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>

    </form>
@endsection