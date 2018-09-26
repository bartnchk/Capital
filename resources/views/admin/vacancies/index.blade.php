@extends('admin.layouts.app')

@section('content')

    <h3>Вакансии</h3>
    <form action="{{ route('vacancies.destroyAll') }}" method="post">
        {{ csrf_field() }}
    <div class="button-group form-group">
        <a href="{{ route('vacancies.create') }}">
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
                <th>№</th>
                <th>Вакансия</th>
                <th>Категория</th>
                <th>Область</th>
                <th>Город</th>
                <th>Дата создания</th>
                <th>Состояние</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($vacancies as $vacancy)
                <tr data-element-id="{{ $vacancy->id }}">
                    <td>
                        <input type="checkbox" name="vacancies[]" value="{{ $vacancy->id }}" class="one" data-id="d1">
                    </td>
                    <td>{{ $loop->iteration + $counter }}</td>
                    <td><a href="{{ route('vacancies.edit', ['id' => $vacancy->id]) }}">{{ $vacancy->title_ru }}</a></td>
                    <td>{{ $vacancy->category->title_ru }}</td>
                    <td>{{ $vacancy->region->title_ru }}</td>
                    <td>{{ $vacancy->city->title_ru }}</td>
                    <td>{{ $vacancy->created_at }}</td>
                    <td>
                        @if( $vacancy->published == 1)
                            <span class="badge badge-success">Активен</span>
                        @else
                            <span class="badge badge-warning">Не активен</span>
                        @endif
                    </td>
                    <td><a href="{{ route('vacancies.edit', ['id' => $vacancy->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td>
                        <a href="" class="delete" data-delete-url="/admin/vacancies/delete/{{ $vacancy->id }}" data-element-id="{{ $vacancy->id }}" >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </form>
    {{ $vacancies->links() }}


@endsection

