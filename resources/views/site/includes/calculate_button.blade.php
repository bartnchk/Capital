<div class="sectionBlock">
    @if(!isset($tariff))
        <h3 class="title">{{ trans('main.calculate_bail') }}</h3>
    @endif


    <div class="more-button credit-button inversed">
        <div class="more-button-wrapper">
            <div class="more-button-container">
                <a href="{{ route('calculator') }}" class="title semi-bold">{{ trans('main.calculate_my_credit') }}</a>
                <i class="icomoon standard-arrow-icon inversed"></i>
            </div>
        </div>
    </div>
</div>