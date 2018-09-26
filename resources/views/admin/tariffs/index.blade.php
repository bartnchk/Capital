@extends('admin.layouts.app')

@section('content')

    <h3>Тарифы</h3>

    <div class="table">

        <form action="{{ route('tariffs.destroyAll') }}" method="post">
            {{ csrf_field() }}
            <div class="button-group form-group">
                <a href="{{ route('tariffs.create') }}">
                    <button type="button" class="btn btn-success"><i aria-hidden="true" class="fa fa-pencil"></i>Создать</button>
                </a>
                <button type="submit" class="btn btn-danger"><i aria-hidden="true" class="fa fa-trash-o"></i>Удалить</button>
            </div>
            @if(count($tariffs))
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
                    @foreach($tariffs as $tariff)
                        <tr data-element-id="{{ $tariff->id }}">
                            <td>
                                <input type="checkbox" name="tariffs[]" value="{{ $tariff->id }}" class="one" data-id="d1">
                            </td>
                            <td>{{ $loop->iteration+$page }}</td>
                            <td><a href="{{ route('tariffs.edit', ['id' => $tariff->id]) }}">{{ $tariff->title_ru }}</a></td>
                            <td>{{ $tariff->category->title_ru }}</td>
                            <td>
                                @if( $tariff->published == 1)
                                    <span class="badge badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-warning">Не опубликовано</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tariffs.edit', ['id' => $tariff->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                <a href="" class="delete" data-delete-url="/admin/tariffs/{{ $tariff->id }}" data-element-id="{{ $tariff->id }}" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                Пока не создано ни одного тарифа
            @endif

        </form>

    </div>

    @if(count($tariffs)) {{ $tariffs->links() }} @endif

@endsection