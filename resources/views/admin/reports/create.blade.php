@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <h2>Реквизиты и отчетность</h2>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST"
          @if(isset($report))
            action="{{ route('reports.update', ['id' => $report->id]) }}"
          @else
            action="{{ route('reports.store') }}"
          @endif
           class="form-group"  enctype="multipart/form-data">

        {{ csrf_field() }}
        @if(isset($report))
            {{ method_field('put') }}
            <input type="hidden" name="url" value="{{ url()->previous() }}">
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ru-tab" data-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="true">русский</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uk-tab" data-toggle="tab" href="#uk" role="tab" aria-controls="uk" aria-selected="false">украинский</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-sm-8">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-tab"><br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Заголовок *</label>
                                    <input type="text" name="title_ru" class="form-control"
                                       @isset($report)
                                           value="{{ old('title_ru') ? old('title_ru') : $report->title_ru }}"
                                       @else
                                           value="{{ old('title_ru') }}"
                                        @endisset
                                    >
                                </div>

                                <div class="form-group">
                                    <label>Текст *</label>
                                    <textarea name="description_ru" id="description_ru" class="form-control" rows="5">
                                        @isset($report)
                                            {{ old('description_ru') ? old('description_ru') : $report->description_ru }}
                                        @else
                                            {{ old('description_ru') }}
                                        @endisset
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        @isset($report)
                            @include('admin.includes.seo_tags_ru', array('page' => $report ))
                        @else
                            @include('admin.includes.seo_tags_ru')
                        @endisset

                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Заголовок *  <small>(украинский вариант)</small></label>
                                    <input type="text" name="title_uk" class="form-control"
                                       @isset($report)
                                           value="{{ old('title_uk') ? old('title_uk') : $report->title_uk }}"
                                       @else
                                           value="{{ old('title_uk') }}"
                                        @endisset
                                    >
                                </div>

                                <div class="form-group">
                                    <label>Текст * <small>(украинский вариант)</small></label>
                                    <textarea name="description_uk" id="description_ru" class="form-control" rows="5">
                                        @isset($report)
                                            {{ old('description_uk') ? old('description_uk') : $report->description_uk }}
                                        @else
                                            {{ old('description_uk') }}
                                        @endisset
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        @isset($report)
                            @include('admin.includes.seo_tags_uk', array('page' => $report ))
                        @else
                            @include('admin.includes.seo_tags_uk')
                        @endisset
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <br>
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="1" @if(isset($report) &&  $report->published ) {{ 'selected' }} @endif >
                            Опубликовано
                        </option>
                        <option value="0" @if(isset($report) &&  !$report->published ) {{ 'selected' }} @endif >
                            Не опубликовано
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Алиас</label>
                    <input type="text" name="alias"  class="form-control" value="@if(isset($report)) {{ $report->alias }} @endif">
                    <small class="red">не заполнять если не уверены, заполнится автоматически</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Сертификат</h5>
                    <input type="file" name="image" class="form-control">
                    <span><small>не обязательно для заполнения</small></span>
                </div>
            </div>
            <div class="col-sm-4">
                <h5>Прикрепленные документы</h5>
                <input class="form-control" type="file" name="documents[]" multiple />
                <span><small>не обязательно для заполнения</small></span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-4">
                    @if(isset($report->certificate))
                        <div class="card card-body bg-light">
                            <img src="{{ asset('storage/images/reports/'.$report->certificate) }}" alt=""   class="img-fluid">
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-4">
                @if(isset($report->documents))
                    <h6>Вы можете добавить названия документам для красивого отображения</h6>
                    <ul class="list-group">
                        @foreach($report->documents as $document)
                            <li class="list-group-item" data-element-id="{{ $document->id }}">
                                <div class="row admin-document">
                                    <span class="col-xs-10">{{ $document->path }}</span>
                                    <a href="" class="delete col-xs-2" data-delete-url="/admin/documents/{{ $document->id }}" data-element-id="{{ $document->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <br>
                                <div class="row">
                                    <input class="form-control col-xs-12" name="document_titles[{{ $document->id }}]" type="text" value="{{ $document->title or '' }}" placeholder="введите имя документа">
                                </div>

                            </li>
                            <br>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/wysiwyg.js')}}"></script>
@endsection