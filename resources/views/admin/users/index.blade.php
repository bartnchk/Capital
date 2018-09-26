@extends('admin.layouts.app')

@section('content')

    <h3>Пользователи</h3>
    <div class="button-group form-group">
        <a href="{{ route('users.create') }}">
            <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Создать</button>
        </a>
    </div>
    <div class="table">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Логин</th>
                <th>E-mail</th>
                <th>Дата создания</th>
                <th>Дата изменения</th>
                <th>Состояние</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('users.edit', ['id' => $user->id]) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        @if( $user->published == 1)
                            <span class="badge badge-success">Активен</span>
                        @else
                            <span class="badge badge-warning">Не активен</span>
                        @endif
                    </td>
                    <td><a href="{{ route('users.edit', ['id' => $user->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td>
                        <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}


@endsection

