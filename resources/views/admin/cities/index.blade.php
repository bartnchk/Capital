@extends('admin.layouts.app')

@section('content')

    <h3>Города</h3>
    <form action="{{ route('cities.deleteAll') }}" method="post">
        {{ csrf_field() }}
        <div class="button-group form-group">
            <a href="{{ route('cities.create') }}">
                <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Создать</button>
            </a>
            <button type="submit" class="btn btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Удалить</button>
        </div>
        <div class="table">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" name="total" class="all" data-id="d1">
                    </th>
                    <th>ID</th>
                    <th>Город</th>
                    <th>Регион</th>
                    <th>Состояние</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($cities as $city)
                    <tr data-element-id="{{ $city->id }}">
                        <td>
                            <input type="checkbox" name="cities[]" value="{{ $city->id }}" class="one" data-id="d1">
                        </td>
                        <td>{{ $city->id }}</td>
                        <td><a href="{{ route('cities.edit', ['id' => $city->id]) }}">{{ $city->title_ru}}</a></td>
                        <td>{{ isset($city->region->title_ru) ? $city->region->title_ru : ''}}</td>
                        <td>
                            @if( $city->published == 1)
                                <span class="badge badge-success">Активен</span>
                            @else
                                <span class="badge badge-warning">Не активен</span>
                            @endif
                        </td>
                        <td><a href="{{ route('cities.edit', ['id' => $city->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        <td>
                            <a href="" class="delete" data-delete-url="/admin/cities/delete/{{ $city->id }}" data-element-id="{{ $city->id }}" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </form>

    {{ $cities->links() }}


@endsection

