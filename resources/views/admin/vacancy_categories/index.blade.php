@extends('admin.layouts.app')

@section('content')

    <h3>Категории вакансий</h3>
    <form action="{{ route('vacancies.category.destroyAll') }}" method="post">
        {{ csrf_field() }}
    <div class="button-group form-group">
        <a href="{{ route('vacancies.category.create') }}">
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
                <th>Категория</th>
                <th>Дата создания</th>
                <th>Состояние</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)
                <tr data-element-id="{{ $category->id }}">
                    <td>
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="one" data-id="d1">
                    </td>
                    <td>{{ $loop->iteration + $counter }}</td>
                    <td><a href="{{ route('vacancies.category.edit', ['id' => $category->id]) }}">{{ $category->title_ru }}</a></td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        @if( $category->published == 1)
                            <span class="badge badge-success">Активен</span>
                        @else
                            <span class="badge badge-warning">Не активен</span>
                        @endif
                    </td>
                    <td><a href="{{ route('vacancies.category.edit', ['id' => $category->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td>
                        <a href="" class="delete" data-delete-url="/admin/vacancies-category/delete/{{ $category->id }}" data-element-id="{{ $category->id }}" >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </form>
    {{ $categories->links() }}


@endsection

