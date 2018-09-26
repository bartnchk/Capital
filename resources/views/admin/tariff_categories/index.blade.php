@extends('admin.layouts.app')

@section('content')

    <h3>Категории тарифов</h3>

    <div class="table">

        <form action="{{ route('tariff_categories.destroyAll') }}" method="post">
            {{ csrf_field() }}
            <div class="button-group form-group">
                <a href="{{ route('tariff_categories.create') }}">
                    <button type="button" class="btn btn-success"><i aria-hidden="true" class="fa fa-pencil"></i>Создать</button>
                </a>
                <button type="submit" class="btn btn-danger"><i aria-hidden="true" class="fa fa-trash-o"></i>Удалить</button>
            </div>
            @if(count($categories))
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
                    @foreach($categories as $category)
                        <tr  data-element-id="{{ $category->id }}">
                            <td>
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="one" data-id="d1">
                            </td>
                            <td>{{ $loop->iteration+$page }}</td>
                            <td><a href="{{ route('tariff_categories.edit', ['id' => $category->id]) }}">{{ $category->title_ru }}</a></td>
                            <td>
                                @if( $category->published == 1)
                                    <span class="badge badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-warning">Не опубликовано</span>
                                @endif
                            </td>
                            <td><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td>
                                <a href=""  class="delete" data-delete-url="/admin/tariff-categories/{{ $category->id }}" data-element-id="{{ $category->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                Не создано ни одной категории
            @endif

        </form>

    </div>

    @if(count($categories)) {{ $categories->links() }} @endif

@endsection

{{--@section('scripts')--}}
    {{--<script>--}}
        {{--// назначить для <tr> и для кнопки  data-element-id="id свойство объекта"--}}
        {{--// для кнопки class="delete" и  data-delete-url="/admin/tariffs/id объекта"--}}
        {{--$('.delete').click(function (e) {--}}
            {{--e.preventDefault();--}}

            {{--var url = $(this).data('delete-url');--}}
            {{--var id = $(this).data('element-id');--}}

            {{--$.ajax({--}}
                {{--dataType: 'JSON',--}}
                {{--type: "DELETE",--}}
                {{--url: url,--}}
                {{--data: {--}}
                    {{--'_token': $('meta[name="csrf-token"]').attr('content'),--}}
                {{--},--}}
                {{--success: function (response) {--}}
                    {{--if (response.status == 'success') {--}}

                        {{--$('tr[data-element-id="' +id+ '"]').fadeOut(500);--}}

                    {{--}--}}
                    {{--if (response.status == 'error') {--}}

                        {{--console.log(response.message)--}}
                        {{--// $.alert({--}}
                        {{--//     title: 'Alert!',--}}
                        {{--//     content: response.message,--}}
                        {{--// });--}}
                    {{--}--}}
                {{--}--}}
            {{--})--}}
        {{--});--}}

        {{--$(".all").on("change", function() {--}}
            {{--var groupId = $(this).data('id');--}}
            {{--$('.one[data-id="' + groupId + '"]').prop("checked", this.checked);--}}
        {{--});--}}

        {{--$(".one").on("change", function() {--}}
            {{--var groupId = $(this).data('id');--}}
            {{--var allChecked = $('.one[data-id="' + groupId + '"]:not(:checked)').length == 0;--}}
            {{--$('.all[data-id="' + groupId + '"]').prop("checked", allChecked);--}}
        {{--});--}}

        {{--$('input.custom-file-input').change(function() {--}}
            {{--var i = $(this).prev('label').clone();--}}
            {{--var file = $('input.custom-file-input')[0].files[0].name;--}}
            {{--console.log(file);--}}
            {{--$(this).parent('.custom-file').find('label').html(file);--}}
        {{--});--}}
    {{--</script>--}}

{{--@endsection--}}