@extends('admin.layouts.app')

@section('content')

    <h2>Шаги получения кредита</h2>

    <div class="table">

        <form action="{{ route('steps.destroyAll') }}" method="post">
            {{ csrf_field() }}
            <div class="button-group form-group">
                <a href="{{ route('steps.create') }}">
                    <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Создать</button>
                </a>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Удалить</button>
            </div>
            @if(count($steps))
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
                    @foreach($steps as $step)
                        <tr  data-element-id="{{ $step->id }}">
                            <td>
                                <input type="checkbox" name="steps[]" value="{{ $step->id }}" class="one" data-id="d1">
                            </td>
                            <td>{{ $loop->iteration+$page }}</td>
                            <td><a href="{{ route('steps.edit', ['id' => $step->id]) }}">{{ $step->title_ru }}</a></td>
                            <td>
                                @if( $step->published == 1)
                                    <span class="badge badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-warning">Не опубликовано</span>
                                @endif
                            </td>
                            <td><a href="{{ route('steps.edit', ['id' => $step->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td>
                                <a href=""  class="delete" data-delete-url="/admin/steps/{{ $step->id }}" data-element-id="{{ $step->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                Не создано ни одного шага
            @endif

        </form>

    </div>

    @if(count($steps)) {{ $steps->links() }} @endif

@endsection