@section('meta_title') <title>{!!  $meta_tags['meta_title_'.$locale] or 'Ломбард "Капитал". Быстрые кредиты под залог золота и техники' !!}</title>  @endsection
@section('meta_description')<meta name="description" content="{!!  $meta_tags['meta_description_'.$locale] or 'Кредитуем под залог❗ золота ✅ серебра ✅ техники ✅ телефонов ✅ ноутбуков ✅ планшетов ✅ строительных инструментов и т.п. ✅ Звоните бесплатно 0 800 300 703' !!}">@endsection
@section('meta_keywords') <meta name="keywords" content="{{ $meta_tags['meta_keywords_'.$locale] or ''}}"> @endsection