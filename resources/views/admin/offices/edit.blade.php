@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ isset($office->id) ? route('offices.update') : route('offices.store')}}"
          id="item-form" class="form-group" enctype="multipart/form-data">
        {{isset($office->id) ? method_field('PUT') : method_field('POST') }}
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="id" type="hidden" value="{{ $office->id ? $office->id : old('id') }}"/>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Номер отделения *</label>
                    <input type="text" name="number" class="form-control"
                           value="{{ $office->id ? $office->number : old('number') }}">
                </div>

                <div class="form-row d-flex justify-content-between">
                    <div class="form-group col-md-6">
                        <label for="">Область *</label>
                        <select name="region_id" id="region" class="form-control"
                                data-selected="{{ $office->id ? $office->region_id : old('region_id') }}" data-placeholder="Выберите регион">
                            @foreach($regions as $region)
                                <option value="{{$region->id}}">{{ $region->title_ru }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Город *</label>
                        <select name="city_id" id="city" class="form-control"
                                data-selected="{{ $office->id ? $office->city_id : old('city_id') }}" data-placeholder="Выберите город">
                        </select>
                    </div>
                </div>

                <div class="form-row d-flex justify-content-between">
                    <div class="form-group col-md-6">
                        <label>Адрес (RU) *</label>
                        <input type="text" name="address_ru" class="form-control"
                               value="{{ $office->id ? $office->address_ru : old('address_ru') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Адрес (UA) *</label>
                        <input type="text" name="address_uk" class="form-control"
                               value="{{ $office->id ? $office->address_uk : old('address_uk') }}">
                    </div>
                </div>
                <div id="map"></div>
                <input id="pac-input" class="controls input" type="text" placeholder="Поиск адреса">
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h5>Титульное изображение</h5>
                            <span><small>будет отображаться в списке отделений</small></span>
                            <input type="file" name="image" class="form-control-file border" @if(!isset($office)) required @endif>
                        </div>

                        @isset($office->image)
                            <div class="card card-body bg-light">
                                <img src="{{ asset('/storage/images/offices/'.$office->image) }}" alt=""   class="img-fluid">
                            </div>
                        @endisset

                    </div>
                    <div class="col-sm-6">
                        <h5>Изображения для галереи</h5>
                        <span><small>не обязательно для заполнения</small></span>
                        <input class="form-control-file border" type="file" name="images[]" multiple />

                        @if(isset($office) and count($office->images))
                            <div class="clearfix mt-3">
                                @foreach($office->images as $image)
                                    @include('admin.offices.image')
                                @endforeach
                            </div>

                        @endif
                    </div>

                </div>

                <hr>

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
                        @isset($office)
                            @include('admin.includes.seo_tags_ru', array('page' => $office ))
                        @else
                            @include('admin.includes.seo_tags_ru')
                        @endisset
                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                        @isset($office)
                            @include('admin.includes.seo_tags_uk', array('page' => $office ))
                        @else
                            @include('admin.includes.seo_tags_uk')
                        @endisset
                    </div>
                </div>

            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Состояние</label>
                    <select name="published" id="" class="form-control">
                        <option value="{{ $office::PUBLISHED }}" @if($office->published == $office::PUBLISHED ) {{ 'selected' }} @endif >
                            Активен
                        </option>
                        <option value="{{ $office::UNPUBLISHED }}" @if(isset($office->published) && $office->published == $office::UNPUBLISHED) {{ 'selected' }} @endif >
                            Не активен
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Телефон *</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ isset($office) ? $office->phone : old('phone') }}">
                </div>

                <div class="form-group">
                    <label>График работы</label>
                    <div id="worktime" class="d-flex align-items-center">
                        <input type="text" name="time_start" class="form-control time_start"
                               value="{{ isset($office) ? $office->time_start : old('time_start') }}" required><span style="padding: 0 8px">До</span>
                        <input type="text" name="time_end" class="form-control time_end"
                               value="{{ isset($office) ? $office->time_end : old('time_end') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Дни работы (RU)</label>
                    <input type="text" name="work_days_ru" class="form-control"
                           value="{{ isset($office) ? $office->work_days_ru : old('work_days_ru') }}">
                </div>

                <div class="form-group">
                    <label>Дни работы (UA)</label>
                    <input type="text" name="work_days_uk" class="form-control"
                           value="{{ isset($office) ? $office->work_days_uk : old('work_days_uk') }}">
                </div>
            </div>
        </div>
        <input type="hidden" id="lng" name="lng" value="{{ $office->id ? $office->lng : old('lng') }}"/>
        <input type="hidden" id="lat" name="lat" value="{{ $office->id ? $office->lat : old('lat') }}"/>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTGhjnmUd3qBnjsEK_yFQZDtrdcTRSyYY&libraries=places&language=ru-RU&region=UA"></script>
@endsection
