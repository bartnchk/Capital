<div id="pageOverlay" class="pageOverlay 1js_openPopup"></div>

<div id="popupSearch" class="popupSearch popup">
    <div class="contentContainer searchFormContainer">
        <button class="popupCloseButton" type="button"><i class="icomoon icon-close"></i></button>
        <form id="searchBlock" action="{{ route('search') }}" class="searchBlock ">
            <input type="text" class="title" placeholder="{{ trans('main.search') }} ..." name="q">
            <div class="borderBlock"></div>
            <button type="submit" class="js_hide"></button>
        </form>
    </div>
</div>