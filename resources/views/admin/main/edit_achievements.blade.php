@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <h2>Достижения (счетчик)</h2>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST" action="{{ route('main.achievements.update') }}" class="form-group">

        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Лет на рынке *</label>
                    <input type="number" required name="years" class="form-control" value="{{ isset($achievement) ? $achievement->years : old('years') }}" >
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Отделений по Украине *</label>
                    <input type="number" required name="offices" class="form-control" value="{{ isset($achievement) ? $achievement->offices : old('offices') }}" >
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Городов *</label>
                    <input type="number" required name="cities" class="form-control" value="{{ isset($achievement) ? $achievement->cities : old('cities') }}" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Довольный клиентов *</label>
                    <input type="number" required name="clients" class="form-control" value="{{ isset($achievement) ? $achievement->clients : old('clients') }}" >
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Выданых кредитов *</label>
                    <input type="number" required name="credits" class="form-control" value="{{ isset($achievement) ? $achievement->credits : old('credits') }}" >
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection