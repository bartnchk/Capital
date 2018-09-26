@extends('admin.layouts.app')

@section('content')

    <h2>Категории задаваемых вопросов</h2>

    <div class="table">

        <form action="{{ route('faq_categories.destroyAll') }}" method="post">
            {{ csrf_field() }}
            <div class="button-group form-group">
                <a href="{{ route('faq_categories.create') }}">
                    <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Создать</button>
                </a>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Удалить</button>
            </div>
            @if(count($categories))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="total" class="all" data-id="d1">
                        </th>
                        <th>№</th>
                        <th>Заголовок</th>
                        <th>Состояние</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr  data-element-id="{{ $category->id }}">
                            <td>
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="one" data-id="d1">
                            </td>
                            <td>{{ $loop->iteration+$page }}</td>
                            <td><a href="{{ route('faq_categories.edit', ['id' => $category->id]) }}">{{ $category->title_ru }}</a></td>
                            <td>
                                @if( $category->published == 1)
                                    <span class="badge badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-warning">Не опубликовано</span>
                                @endif
                            </td>
                            <td><a href="{{ route('faq_categories.edit', ['id' => $category->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td>
                                <a href=""  class="delete" data-delete-url="/admin/faq-categories/{{ $category->id }}" data-element-id="{{ $category->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                Не создано ни одной категории
            @endif

        </form>

    </div>

    @if(count($categories)) {{ $categories->links() }} @endif

@endsection