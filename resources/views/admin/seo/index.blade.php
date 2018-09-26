@extends('admin.layouts.app')

@section('content')

    <h2>SEO данные для разделов сайта</h2>

    <div class="table">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Заголовок</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(isset($pages))
                @foreach($pages as $page)
                    <tr>
                        <td><a href="{{ route('seo.edit', ['id' => $page->id]) }}">{{ $page->title }}</a></td>

                        <td>
                            <a href="{{ route('seo.edit', ['id' => $page->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>

@endsection