@extends('admin.layouts.app')

@section('content')

    <h3>Финансовая отчетность</h3>

    <div class="table">

        <form action="{{ route('reports.destroyAll') }}" method="post">
            {{ csrf_field() }}
            <div class="button-group form-group">
                <a href="{{ route('reports.create') }}">
                    <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Создать</button>
                </a>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Удалить</button>
            </div>
            @if(count($reports))
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
                    @foreach($reports as $report)
                        <tr  data-element-id="{{ $report->id }}">
                            <td>
                                <input type="checkbox" name="reports[]" value="{{ $report->id }}" class="one" data-id="d1">
                            </td>
                            <td>{{ $loop->iteration+$page }}</td>
                            <td><a href="{{ route('reports.edit', ['id' => $report->id]) }}">{{ $report->title_ru }}</a></td>
                            <td>
                                @if( $report->published == 1)
                                    <span class="badge badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-warning">Не опубликовано</span>
                                @endif
                            </td>
                            <td><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td>
                                <a href=""  class="delete" data-delete-url="/admin/reports/{{ $report->id }}" data-element-id="{{ $report->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                Не создано ни одного отчета
            @endif

        </form>

    </div>

    @if(count($reports)) {{ $reports->links() }} @endif

@endsection