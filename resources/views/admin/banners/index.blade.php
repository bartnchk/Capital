@extends('admin.layouts.app')

@section('content')

    <h3>Баннеры</h3>

    <div class="table">

        <form action="{{ route('banners.destroyAll') }}" method="post">
            {{ csrf_field() }}
            <div class="button-group form-group">
                <a href="{{ route('banners.create') }}">
                    <button type="button" class="btn btn-success">
                        <i aria-hidden="true" class="fa fa-pencil"></i>
                        Создать
                    </button>
                </a>
                <button type="submit" class="btn btn-danger">
                    <i aria-hidden="true" class="fa fa-trash-o"></i>
                    Удалить
                </button>
            </div>
            @if(count($banners))
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
                    @foreach($banners as $banner)
                        <tr  data-element-id="{{ $banner->id }}">
                            <td>
                                <input type="checkbox" name="banners[]" value="{{ $banner->id }}" class="one" data-id="d1">
                            </td>
                            <td>{{ $loop->iteration+$page }}</td>
                            <td><a href="{{ route('banners.edit', ['id' => $banner->id]) }}">{{ $banner->title_ru }}</a></td>
                            <td>
                                @if( $banner->published == 1)
                                    <span class="badge badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-warning">Не опубликовано</span>
                                @endif
                            </td>
                            <td><a href="{{ route('banners.edit', ['id' => $banner->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td>
                                <a href=""  class="delete" data-delete-url="/admin/banner/delete/{{ $banner->id }}" data-element-id="{{ $banner->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                Не создано ни одного баннера
            @endif

        </form>

    </div>

    @if(count($banners)) {{ $banners->links() }} @endif

@endsection