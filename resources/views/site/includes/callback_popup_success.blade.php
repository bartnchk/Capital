<div id="popupSuccess" class="popupSuccess popup">
    <div class="popupContentWrapper">

        <header class="modalHeader relative">
            <div class="modal-title title">{{ trans('main.thanks_for_feedback') }}</div>
        </header>

        <div class="popUpContainer">
            <div class="description contentRow">
                <p>{{ trans('main.we_will_call') }}</p>
            </div>

            <div class="buttonWrapper contentRow">
                <a href="{{ route('actions') }}" class="standardButton white">{{ trans('main.all_actions') }}</a>
            </div>
        </div>
    </div>
</div>