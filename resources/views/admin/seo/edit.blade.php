@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <h2>{{ $page->title }}</h2>
    <p>* - поля обязательные для заполнения</p>
    <form method="POST" action="{{ route('seo.update', ['id' => $page->id]) }}" class="form-group"  enctype="multipart/form-data">

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
                            <label>Meta_title ru </label>
                            <input type="text" name="meta_title_ru" class="form-control"
                                   value="{{ $page->meta_title_ru or '' }}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Meta_description ru </label>
                            <textarea name="meta_description_ru" class="form-control"
                                      rows="7">{{ $page->meta_description_ru or '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Meta_keywords ru</label>
                            <textarea name="meta_keywords_ru" class="form-control"
                                      rows="7">{{ $page->meta_keywords_ru or '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-tab"><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Meta_title ua</label>
                            <input type="text" name="meta_title_uk" class="form-control"
                                   value="{{ $page->meta_title_uk or '' }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Meta_description ua</label>
                            <textarea name="meta_description_uk" class="form-control"
                                      rows="7">{{ $page->meta_description_uk or '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Meta_keywords ua</label>
                            <textarea name="meta_keywords_uk" class="form-control"
                                      rows="7">{{ $page->meta_keywords_uk or '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection