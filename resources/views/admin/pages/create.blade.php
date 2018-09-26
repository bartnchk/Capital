@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <h3>{{ $page->title_ru }}</h3>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST" action="{{ route('pages.update', ['id' => $page->id]) }}" class="form-group"  enctype="multipart/form-data">

        {{ csrf_field() }}
        @if(isset($page)) {{ method_field('put') }} @endif

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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Заголовок страницы *</label>
                            <input type="text" name="title_ru" class="form-control"
                               @isset($page)
                                   value="{{ old('title_ru') ? old('title_ru') : $page->title_ru }}"
                               @else
                                   value="{{ old('title_ru') }}"
                                @endisset
                            >
                        </div>

                        <div class="form-group">
                            <label>Описание страницы *</label>
                            <textarea name="description_ru" class="form-control" rows="7">
                                @isset($page)
                                    {{ old('description_ru') ? old('description_ru') : $page->description_ru }}
                                @else
                                    {{ old('description_ru') }}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
                @include('admin.includes.seo_tags_ru' )
            </div>
            <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Заголовок страницы * <small>(украинский вариант)</small></label>
                            <input type="text" name="title_uk" class="form-control"
                               @isset($page)
                                   value="{{ old('title_uk') ? old('title_uk') : $page->title_uk }}"
                               @else
                                   value="{{ old('title_uk') }}"
                                @endisset
                            >
                        </div>

                        <div class="form-group">
                            <label>Описание страницы * <small>(украинский вариант)</small></label>
                            <textarea name="description_uk" class="form-control" rows="7">
                                @isset($page)
                                    {{ old('description_uk') ? old('description_uk') : $page->description_uk }}
                                @else
                                    {{ old('description_uk') }}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
                @include('admin.includes.seo_tags_uk' )
            </div>
        </div>

        @if($page->alias == 'about')
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h5>Титульное изображение</h5>
                        <span><small>будет отображаться вверху возле текста</small></span>
                        <input type="file" name="image" class="form-control" @if($page->image == null) required @endif>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h5>Изображения для галереи</h5>
                    <span><small>не обязательно для заполнения</small></span>
                    <input class="form-control" type="file" name="images[]" multiple />
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-3">
                        @if(isset($page->image))
                            <div class="card card-body bg-light">
                                <img src="{{ asset('storage/images/page/'.$page->image) }}" alt=""   class="img-fluid">
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-sm-6">
                    @if(isset($page) and count($page->images))
                        <div class="clearfix">
                            @foreach($page->images as $image)
                                @include('admin.pages.image')
                            @endforeach
                        </div>

                    @endif
                </div>
            </div>
        @endif


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