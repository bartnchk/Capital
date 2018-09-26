@php
    if(isset($page)){
        $desc = old('meta_description_uk') ? old('meta_description_uk') : $page->meta_description_uk;
        $keywords = old('meta_keywords_uk') ? old('meta_keywords_uk') : $page->meta_keywords_uk;
    }else {
        $desc =  old('meta_description_uk');
        $keywords = old('meta_keywords_uk');
    }

@endphp
<h5>Мета_теги <small>(необязательно для заполнения)</small></h5>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Meta_title ua </label>
            <input type="text" name="meta_title_uk" class="form-control"
               @isset($page)
                   value="{{ old('meta_title_uk') ? old('meta_title_uk') : $page->meta_title_uk }}"
               @else
                   value="{{ old('meta_title_uk') }}"
                @endisset
            >
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Meta_description ua </label>
            <textarea name="meta_description_uk" class="form-control" rows="4">{{ $desc or '' }}</textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Meta_keywords ua</label>
            <textarea name="meta_keywords_uk" class="form-control" rows="4">{{ $keywords or '' }}</textarea>
        </div>
    </div>
</div>