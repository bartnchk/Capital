@extends('admin.layouts.app')

@section('content')

    <h3>Часто задаваемые вопросы</h3>

    <div class="table">

        <form action="{{ route('faqs.destroyAll') }}" method="post">
            {{ csrf_field() }}
            <div class="button-group form-group">
                <a href="{{ route('faqs.create') }}">
                    <button type="button" class="btn btn-success"><i aria-hidden="true" class="fa fa-pencil"></i>Создать</button>
                </a>
                <button type="submit" class="btn btn-danger"><i aria-hidden="true" class="fa fa-trash-o"></i>Удалить</button>
            </div>
            @if(count($faqs))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="total" class="all" data-id="d1">
                        </th>
                        <th>№</th>
                        <th>Заголовок</th>
                        <th>Категория</th>
                        <th>Состояние</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($faqs as $faq)
                        <tr data-element-id="{{ $faq->id }}">
                            <td>
                                <input type="checkbox" name="faqs[]" value="{{ $faq->id }}" class="one" data-id="d1">
                            </td>
                            <td>{{ $loop->iteration+$page }}</td>
                            <td><a href="{{ route('faqs.edit', ['id' => $faq->id]) }}">{{ $faq->title_ru }}</a></td>
                            <td>{{ $faq->category->title_ru }}</td>
                            <td>
                                @if( $faq->published == 1)
                                    <span class="badge badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-warning">Не опубликовано</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('faqs.edit', ['id' => $faq->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                <a href="" class="delete" data-delete-url="/admin/faqs/{{ $faq->id }}" data-element-id="{{ $faq->id }}" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                Пока не создано ни одного вопроса
            @endif

        </form>

    </div>

    @if(count($faqs)) {{ $faqs->links() }} @endif

@endsection