@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ isset($settings->id) ? route('settings.update') : route('settings.store')}}"
          id="item-form" class="form-group" enctype="multipart/form-data">
        {{isset($settings->id) ? method_field('PUT') : method_field('POST') }}

        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ isset($settings) ? $settings->id : '' }}"/>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label><i class="fa fa-envelope-o" aria-hidden="true"></i>E-mail</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ isset($settings) ? $settings->email : '' }}">
                </div>

                <div class="form-group">
                    <label><i class="fa fa-phone" aria-hidden="true"></i>Телефон</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ isset($settings) ? $settings->phone : '' }}">
                </div>

                <div class="form-group">
                    <label><i class="fa fa-phone-square" aria-hidden="true"></i>Viber</label>
                    <input type="text" name="viber" class="form-control"
                           value="{{ isset($settings) ? $settings->viber : '' }}">
                </div>

                <div class="form-group">
                    <label><i class="fa fa-instagram" aria-hidden="true"></i>Instagram</label>
                    <input type="text" name="instagram" class="form-control"
                           value="{{ isset($settings) ? $settings->instagram : '' }}">
                </div>

                <div class="form-group">
                    <label><i class="fa fa-facebook-official" aria-hidden="true"></i>Facebook</label>
                    <input type="text" name="facebook" class="form-control"
                           value="{{ isset($settings) ? $settings->facebook : '' }}">
                </div>

                <div class="form-group">
                    <label><i class="fa fa-youtube" aria-hidden="true"></i>Youtube</label>
                    <input type="text" name="youtube" class="form-control"
                           value="{{ isset($settings) ? $settings->youtube : '' }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>

@endsection
