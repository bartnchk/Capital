@extends('admin.layouts.app')

@section('content')

    <h3>Отделения</h3>
    <form action="{{ route('offices.destroyAll') }}" method="post">
        <div class="navigate d-flex justify-content-between align-items-start">
            <div class="buttons">
                <div class="button-group form-group">
                    <a href="{{ route('offices.create') }}">
                        <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Создать</button>
                    </a>
                    <button type="submit" class="btn btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Удалить</button>
                </div>
            </div>
            <div class="fields d-flex">
                <div class="form-inline">
                    <input type="text" class="form-control mb-3 mr-sm-3 mb-sm-0" id="searchOfficeField" name="q"
                           placeholder="Поиск..." value="@if(request()->has('q')){{request()->q}}@endif">
                    <div id="searchOfficeButton" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}

    <div class="table">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    <input type="checkbox" name="total" class="all" data-id="d1">
                </th>
                <th>№</th>
                <th>Город</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Дата создания</th>
                <th>Состояние</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($offices as $office)
                <tr data-element-id="{{ $office->id }}" @if(session()->has('marked') and $office->id == session('marked'))  class="table-success" @endif>
                    <td>
                        <input type="checkbox" name="offices[]" value="{{ $office->id }}" class="one" data-id="d1">
                    </td>
                    <td><a href="{{ route('offices.edit', ['id' => $office->id]) }}">Отделение № {{ $office->number }}</a></td>
                    <td>{{ $office->city['title_ru'] }}</td>
                    <td>{{ $office->address_ru }}</td>
                    <td>{{ $office->phone }}</td>
                    <td>{{ $office->created_at }}</td>
                    <td>
                        @if( $office->published == 1)
                            <span class="badge badge-success">Активен</span>
                        @else
                            <span class="badge badge-warning">Не активен</span>
                        @endif
                    </td>
                    <td><a href="{{ route('offices.edit', ['id' => $office->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td>
                        <a href="" class="delete" data-delete-url="/admin/offices/delete/{{ $office->id }}" data-element-id="{{ $office->id }}" >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </form>
    {{ $offices->links() }}

@endsection

