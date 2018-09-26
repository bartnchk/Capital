@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ isset($city->id) ? route('cities.update') : route('cities.store')}}"
          id="item-form" class="form-group" enctype="multipart/form-data">
        {{isset($city->id) ? method_field('PUT') : method_field('POST') }}
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ isset($city) ? $city->id : '' }}"/>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Город (RU)</label>
                    <input type="text" name="title_ru" class="form-control"
                           value="{{ isset($city) ? $city->title_ru : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Город (UA)</label>
                    <input type="text" name="title_uk" class="form-control"
                           value="{{ isset($city) ? $city->title_uk : '' }}" required>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="{{ $city::PUBLISHED }}" @if($city->published == $city::PUBLISHED ) {{ 'selected' }} @endif >
                            Активен
                        </option>
                        <option value="{{ $city::UNPUBLISHED }}" @if(isset($city->published) && $city->published == $city::UNPUBLISHED) {{ 'selected' }} @endif >
                            Не активен
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Область</label>
                    <select name="region_id" class="form-control" required>
                        <option value="">Выберите регион</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" @if($city->region_id == $region->id) {{ 'selected' }} @endif >{{ $region->title_ru }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
