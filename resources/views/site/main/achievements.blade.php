<section id="countersSection" class="pageSection countersSection">

    <!-- <div class="countersSectionOverlay"></div> -->
    <div class="mcontainer">
        <div class="animated-border-block section-title">
            <div class="svg-container">
                <svg class="rect-container">
                    <rect x="0" y="0" class="animatedBlock"/>
                    <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                </svg>
                <h2 class="title ">{{ trans('main.achievements') }}</h2>
            </div>
        </div>

        <ul class="countersList">
            <li class="mcol-xs-12">
                <div class="descriptionBlock">
                    <div class="title">{{ trans('main.years_on_market') }}</div>
                    <div class="counterContainer" data-count="13">{{ $achievements->years }}</div>
                </div>
            </li>
            <li class="mcol-xs-12">
                <div class="descriptionBlock">
                    <div class="title">{{ trans('main.offices_amount') }}</div>
                    <div class="counterContainer" data-count="406">{{ $achievements->offices }}</div>
                </div>
            </li>
            <li class="mcol-xs-12">
                <div class="descriptionBlock">
                    <div class="title">{{ trans('main.cities') }}</div>
                    <div class="counterContainer" data-count="100">{{ $achievements->cities }}</div>
                </div>
            </li>
            <li class="mcol-xs-12">
                <div class="descriptionBlock">
                    <div class="title">{{ trans('main.happy_clients') }}</div>
                    <div class="counterContainer" data-count="{{ $achievements->clients }}">{{ $achievements->clients }}</div>
                </div>
            </li>
            <li class="mcol-xs-12">
                <div class="descriptionBlock">
                    <div class="title">{{ trans('main.given_credits') }}</div>
                    <div class="counterContainer" data-count="{{ $achievements->credits }}">{{ $achievements->credits }}</div>
                </div>
            </li>
        </ul>
    </div>
</section>