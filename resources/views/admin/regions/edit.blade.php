@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ isset($region->id) ? route('regions.update') : route('regions.store')}}"
          id="item-form" class="form-group" enctype="multipart/form-data">
        {{isset($region->id) ? method_field('PUT') : method_field('POST') }}
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ isset($region) ? $region->id : '' }}"/>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-row d-flex justify-content-between">
                    <div class="form-group col-md-6">
                        <label>Область (RU)</label>
                        <input type="text" name="title_ru" class="form-control"
                               value="{{ isset($region) ? $region->title_ru : '' }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Область (UA)</label>
                        <input type="text" name="title_uk" class="form-control"
                               value="{{ isset($region) ? $region->title_uk : '' }}" required>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="{{ $region::PUBLISHED }}"  @if($region->published == $region::PUBLISHED ) {{ 'selected' }} @endif >
                            Активен
                        </option>
                        <option value="{{ $region::UNPUBLISHED }}"  @if(isset($region->published) && $region->published == $region::UNPUBLISHED) {{ 'selected' }} @endif >
                            Не активен
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
