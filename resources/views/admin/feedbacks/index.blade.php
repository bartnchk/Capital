@extends('admin.layouts.app')

@section('content')

    <h3>Отзывы</h3>

    <form action="{{ route('feedbacks.destroyAll') }}" method="post">
        {{ csrf_field() }}
        <div class="button-group form-group">
            <a href="{{ route('feedbacks.create') }}">
                <button type="button" class="btn btn-success"><i aria-hidden="true" class="fa fa-pencil"></i>Создать</button>
            </a>
            <button type="submit" class="btn btn-danger"><i aria-hidden="true" class="fa fa-trash-o"></i>Удалить</button>
        </div>
    <div class="table">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" name="total" class="all" data-id="d1">
                    </th>
                    <th>№</th>
                    <th>Пользователь</th>
                    <th>Отзыв</th>
                    <th>Дата</th>
                    <th>Состояние</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($feedbacks as $feedback)
                <tr data-element-id="{{ $feedback->id }}">
                    <td>
                        <input type="checkbox" name="feedbacks[]" value="{{ $feedback->id }}" class="one" data-id="d1">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('feedbacks.edit', ['id' => $feedback->id]) }}">{{ $feedback->name }}</a></td>
                    <td>{{ str_limit(strip_tags($feedback->body) , 40)}}</td>
                    <td>{{ $feedback->date }}</td>
                    <td>
                        @if( $feedback->published == 1)
                            <span class="badge badge-success">Опубликовано</span>
                        @else
                            <span class="badge badge-warning">Не опубликовано</span>
                        @endif
                    </td>
                    <td><a href="{{ route('feedbacks.edit', ['id' => $feedback->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td>
                        <a href="" class="delete" data-delete-url="/admin/feedbacks/delete/{{ $feedback->id }}" data-element-id="{{ $feedback->id }}" >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    {{ $feedbacks->links() }}


@endsection


        @section('scripts')
            <script>
                // назначить для <tr> и для кнопки  data-element-id="id свойство объекта"
                // для кнопки class="delete" и  data-delete-url="/admin/tariffs/id объекта"
                $('.delete').click(function (e) {
                    e.preventDefault();

                    var url = $(this).data('delete-url');
                    var id = $(this).data('element-id');

                    console.log(id);

                    $.ajax({
                        dataType: 'JSON',
                        type: "DELETE",
                        url: url,
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            if (response.message == 'success') {

                                $('tr[data-element-id="' +id+ '"]').fadeOut(500);
                            }
                        }
                    })
                });
            </script>

@endsection
