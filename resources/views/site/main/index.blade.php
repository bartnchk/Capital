@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')
    <div id="homePage" class="homePage page">

        {{--баннеры--}}
        @include('site.main.banners')

        {{--Под залог и специальные возможности--}}
        @include('site.main.bail')

        {{--Вы получаете--}}
        @include('site.main.youget')

        {{--Акции--}}
        @include('site.main.actions')

        {{--Подписка--}}
        @include('site.main.subscribe')

        {{--новости--}}
        @include('site.main.news')

        {{--достижения--}}
        @include('site.main.achievements')

    </div>
@endsection