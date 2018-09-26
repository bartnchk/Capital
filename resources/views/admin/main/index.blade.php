@extends('admin.layouts.app')

@section('content')

    <h3>Раздел "{{ $title }}"</h3>

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
                        <td><a href="{{ route('main.edit', ['section' => strtolower($section), 'id' => $page->id]) }}">{{ $page->title_ru }}</a></td>

                        <td>
                            <a href="{{ route('main.edit', ['section' => strtolower($section), 'id' => $page->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection