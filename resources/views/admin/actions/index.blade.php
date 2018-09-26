@extends('admin.layouts.app')

@section('content')

    <h3>Акции</h3>

    <form action="{{ route('actions.destroyAll') }}" method="post">
        {{ csrf_field() }}
        <div class="button-group form-group">
            <a href="{{ route('actions.create') }}">
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
                    <th>Название акции</th>
                    <th>Период</th>
                    <th>Состояние</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($actions as $action)
                    <tr data-element-id="{{ $action->id }}">
                        <td>
                            <input type="checkbox" name="actions[]" value="{{ $action->id }}" class="one" data-id="d1">
                        </td>
                        <td>{{ $loop->iteration + $counter }}</td>
                        <td><a href="{{ route('actions.edit', ['id' => $action->id]) }}">{{ $action->title_ru }}</a></td>
                        <td>{{ date( 'd-m-Y', strtotime($action->start_at) ) . ' - ' . date( 'd-m-Y', strtotime($action->finish_at) ) }}</td>
                        <td>
                            @if( $action->published == 1)
                                <span class="badge badge-success">Опубликовано</span>
                            @else
                                <span class="badge badge-warning">Не опубликовано</span>
                            @endif
                        </td>
                        <td><a href="{{ route('actions.edit', ['id' => $action->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        <td>
                            <a href="" class="delete" data-delete-url="/admin/action/delete/{{ $action->id }}" data-element-id="{{ $action->id }}" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $actions->links() }}

    </form>

@endsection