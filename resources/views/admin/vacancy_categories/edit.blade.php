@extends('admin.layouts.app')

@section('content')
    <h3>{{ isset($vacancy->id) ? 'Редактированее категори вакансий : ' .$vacancy->title_ru : 'Создание новой категории вакансий' }}</h3>
    <hr>
    <form method="POST" action="{{ isset($category->id) ? route('vacancies.category.update', $category->id) : route('vacancies.category.store')}}"
          id="item-form" class="form-group" enctype="multipart/form-data">
        {{isset($category->id) ? method_field('PUT') : method_field('POST') }}

        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ isset($category) ? $category->id : '' }}"/>

        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Название (RU)</label>
                    <input type="text" name="title_ru" class="form-control"
                           value="{{ isset($category) ? $category->title_ru : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Название (UA)</label>
                    <input type="text" name="title_uk" class="form-control"
                           value="{{ isset($category) ? $category->title_uk : '' }}" required>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="1" @if(isset($category->published) && $category->published  == $category::PUBLISHED ) {{ 'selected' }} @endif >
                            Активен
                        </option>
                        <option value="0" @if(isset($category->published) && $category->published == $category::UNPUBLISHED) {{ 'selected' }} @endif >
                            Не активен
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
