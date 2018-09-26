@extends('admin.layouts.app')

@section('content')
    <h3>{{ $step->title_ru or 'Новый шаг оформления кредита' }}</h3>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST"
      @if(isset($step))
          action="{{ route('steps.update', ['id' => $step->id]) }}"
      @else
          action="{{ route('steps.store') }}"
      @endif
          class="form-group">

        {{ csrf_field() }}
        @if(isset($step)) {{ method_field('put') }} @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ru-tab" data-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="true">русский</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uk-tab" data-toggle="tab" href="#uk" role="tab" aria-controls="uk" aria-selected="false">украинский</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-tab"><br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Заголовок *</label>
                            <input type="text" name="title_ru" class="form-control"
                                   @isset($step)
                                   value="{{ old('title_ru') ? old('title_ru') : $step->title_ru }}"
                                   @else
                                   value="{{ old('title_ru') }}"
                                    @endisset
                            >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Длительность процедуры * </label>
                            <input type="text" name="time_ru" class="form-control"
                                   @isset($step)
                                   value="{{ old('time_ru') ? old('time_ru') : $step->time_ru }}"
                                   @else
                                   value="{{ old('time_ru') }}"
                                    @endisset
                            >
                            <small>например <strong>2 минуты</strong></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Описание *</label>
                            <textarea name="description_ru" class="form-control" rows="5">
                                @isset($step)
                                    {{ old('description_ru') ? old('description_ru') : $step->description_ru }}
                                @else
                                    {{ old('description_ru') }}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Заголовок * <small>(украинский вариант)</small></label>
                            <input type="text" name="title_uk" class="form-control"
                               @isset($step)
                                   value="{{ old('title_uk') ? old('title_uk') : $step->title_uk }}"
                               @else
                                   value="{{ old('title_uk') }}"
                                @endisset
                            >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Длительность процедуры * <small>(украинский вариант)</small></label>
                            <input type="text" name="time_uk" class="form-control"
                               @isset($step)
                                   value="{{ old('time_uk') ? old('time_uk') : $step->time_uk }}"
                               @else
                                   value="{{ old('time_uk') }}"
                                @endisset
                            >
                            <small>например <strong>2 хвилини</strong></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Описание * <small>(украинский вариант)</small></label>
                            <textarea name="description_uk" class="form-control" rows="5">
                                @isset($step)
                                    {{ old('description_uk') ? old('description_uk') : $step->description_uk }}
                                @else
                                    {{ old('description_uk') }}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="1" @if(isset($step) &&  $step->published ) {{ 'selected' }} @endif >
                            Опубликовано
                        </option>
                        <option value="0" @if(isset($step) &&  !$step->published ) {{ 'selected' }} @endif >
                            Не опубликовано
                        </option>
                    </select>
                </div>
            </div>
            {{--<div class="col-sm-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="">Алиас</label>--}}
                    {{--<input type="text" name="alias"  class="form-control" value="">--}}
                    {{--<small class="red">не заполнять если не уверены, заполнится автоматически</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>

    </form>
@endsection

@section('scripts')
    <script src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/wysiwyg.js')}}"></script>
@endsection