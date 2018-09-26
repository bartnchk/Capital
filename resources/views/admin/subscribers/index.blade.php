@extends('admin.layouts.app')

@section('content')

    <h3>Подписчики</h3>

    <form action="{{ route('subscribers.destroyAll') }}" method="post">
        {{ csrf_field() }}
        <div class="button-group form-group">
            <button type="submit" class="btn btn-danger"><i aria-hidden="true" class="fa fa-trash-o"></i>Удалить</button>
        </div>
        <div class="table">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><input type="checkbox" name="total" class="all" data-id="d1"></th>
                    <th>№</th>
                    <th>E-mail</th>
                    <th>Состояние</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($subscribers as $subscriber)

                    <tr data-element-id="{{ $subscriber->id }}">
                        <td>
                            <input type="checkbox" name="subscribers[]" value="{{ $subscriber->id }}" class="one" data-id="d1">
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>
                            @if( $subscriber->state == 1)
                                <span class="badge badge-success">Подтверждён</span>
                            @else
                                <span class="badge badge-warning">Не подтверждён</span>
                            @endif
                        </td>
                        <td>
                            <a href="" class="delete" data-delete-url="/admin/subscribers/delete/{{ $subscriber->id }}" data-element-id="{{ $subscriber->id }}" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        {{ $subscribers->links() }}


        @endsection


        @section('scripts')
            <script>
                // назначить для <tr> и для кнопки  data-element-id="id свойство объекта"
                // для кнопки class="delete" и  data-delete-url="/admin/tariffs/id объекта"
                $('.delete').click(function (e) {
                    e.preventDefault();

                    var url = $(this).data('delete-url');
                    var id = $(this).data('element-id');

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
