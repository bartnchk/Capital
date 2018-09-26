@extends('admin.layouts.app')

@section('content')

    <h3>Регионы</h3>
    <form action="{{ route('regions.deleteAll') }}" method="post">
        {{ csrf_field() }}
        <div class="button-group form-group">
            <a href="{{ route('regions.create') }}">
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
                    <th>Регион</th>
                    <th>Состояние</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($regions as $region)
                    <tr data-element-id="{{ $region->id }}">
                        <td><input type="checkbox" name="regions[]" value="{{ $region->id }}" class="one" data-id="d1"></td>
                        <td>{{ $region->id }}</td>
                        <td><a href="{{ route('regions.edit', ['id' => $region->id]) }}">{{ $region->title_ru}}</a></td>
                        <td>
                            @if( $region->published == 1)
                                <span class="badge badge-success">Активен</span>
                            @else
                                <span class="badge badge-warning">Не активен</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('regions.edit', ['id' => $region->id]) }}" class="delete">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <a href="" class="delete" data-delete-url="/admin/regions/delete/{{ $region->id }}" data-element-id="{{ $region->id }}" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </form>

    {{ $regions->links() }}


@endsection

