@if(Session::has('flash_message'))
    <div id="popupNotification" class="popupActionsSuccess popupError popup">
        <div class="popupContentWrapper">
            <header class="modalHeader relative">
                <div class="modal-title title">Сообщение</div>
            </header>

            <div class="popUpContainer">
                <div class="description contentRow">
                    <p id="flash-message">{{ Session::get('flash_message') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif