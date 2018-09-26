@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{ ($feedback->id) ? route('feedbacks.update', ['id' => $feedback->id]) : route('feedbacks.store')}}" class="form-group" enctype="multipart/form-data">
        {{ ($feedback->id) ? method_field('PUT') : method_field('POST') }}
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ isset($feedback) ? $feedback->id : '' }}"/>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Имя пользователя *</label>
                    <input type="text" name="name" class="form-control" value="{{ ($feedback->id) ? $feedback->name : old('name') }}" >
                </div>

                <div class="form-group">
                    <label for="">Город *</label>
                    <input type="text" name="city" class="form-control" value="{{ ($feedback->id) ? $feedback->city : old('city') }}" >
                </div>

                <div class="form-group">
                    <label>Отзыв *</label>
                    <textarea name="body" class="form-control" >{{ isset($feedback->body) ? $feedback->body : old('body') }}</textarea>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label>Дата</label>
                    <input name="date" class="form-control datepicker" value="{{ isset($feedback->date) ? $feedback->date : old('date') }}">
                </div>

                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="{{ $feedback::PUBLISHED }}" @isset($feedback->published) @if($feedback->published == $feedback::PUBLISHED ) {{ 'selected' }} @endif @endisset >
                            Активен
                        </option>
                        <option value="{{ $feedback::UNPUBLISHED }}" @isset($feedback->published) @if($feedback->published == $feedback::UNPUBLISHED) {{ 'selected' }} @endif @endisset>
                            Не активен
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection




