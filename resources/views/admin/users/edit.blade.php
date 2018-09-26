@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ isset($user->id) ? route('users.update') : route('users.store')}}" class="form-group" enctype="multipart/form-data">
    {{isset($user->id) ? method_field('PUT') : method_field('POST') }}
    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ isset($user) ? $user->id : '' }}"/>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Имя пользователя(Логин)</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ isset($user) ? $user->name : '' }}" required>
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control" value="{{ isset($user) ? $user->email : '' }}" required>
                </div>

                @isset($user->name)
                    <div class="form-group">
                        <button type="button" name="change_password" class="btn btn-warning">Изменить пароль</button>
                    </div>
                @endisset
                <div class="password_form" @isset($user->name) style="display: none" @endisset>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    @isset($user->name)
                        <div class="form-group">
                            <label>Новый пароль</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                    @endisset

                    <div class="form-group">
                        <label>Подтвердить@isset($user->name) новый @endisset пароль</label>
                        <input type="password" name="@if($user->name){{ 'new_password_confirmation' }}@else{{'password_confirmation'}}@endif" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="{{ $user::PUBLISHED }}" @isset($user->state) @if($user->state == $user::PUBLISHED ) {{ 'selected' }} @endif @endisset >
                            Активен
                        </option>
                        <option value="{{ $user::UNPUBLISHED }}" @isset($user->state) @if($user->state == $user::UNPUBLISHED) {{ 'selected' }} @endif @endisset>
                            Не активен
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection

