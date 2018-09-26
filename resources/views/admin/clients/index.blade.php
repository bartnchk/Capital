@extends('admin.layouts.app')

@section('content')

    <h3>Клиентам</h3>

    <form action="{{ route('clients.destroyAll') }}" method="post">
        {{ csrf_field() }}
        <div class="button-group form-group">
            <a href="{{ route('clients.create') }}">
                <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Создать</button>
            </a>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Удалить</button>
        </div>
        <div class="table">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><input type="checkbox" name="total" class="all" data-id="d1"></th>
                    <th>№</th>
                    <th>Название услуги</th>
                    <th>Состояние</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($clients as $client)
                    <tr data-element-id="{{ $client->id }}">
                        <td>
                            <input type="checkbox" name="clients[]" value="{{ $client->id }}" class="one" data-id="d1">
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('clients.edit', ['id' => $client->id]) }}">{{ $client->title_ru }}</a></td>
                        <td>
                            @if( $client->published == 1)
                                <span class="badge badge-success">Опубликовано</span>
                            @else
                                <span class="badge badge-warning">Не опубликовано</span>
                            @endif
                        </td>
                        <td><a href="{{ route('clients.edit', ['id' => $client->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        <td>
                            <a href="" class="delete" data-delete-url="{{ route('client.delete', ['id' => $client->id]) }}" data-element-id="{{ $client->id }}" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $clients->links() }}

    </form>

@endsection