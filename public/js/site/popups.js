$(document).ready(function () {

    /**   отправить заявку на звонок    **/

    $('.callbackPopupSubmitButton').click( function(e) {
        e.preventDefault();
        if (ValidationModule.isValid(this.form)){
            $.get( '/callbacks/create', $('#popup_callback_form').serialize(), function(data) {

                    PopupModule.closePopup(popupCallback);
                    PopupModule.openPopup(popupSuccess);
                    $('#popup_callback_form')[0].reset();
                },
                'json'
            );
        }

    });
    $('.callbackSubmitButton').click( function(e) {
        e.preventDefault();
        if (ValidationModule.isValid(this.form)){
            $.get( '/callbacks/create', $('#faq_callback_form').serialize(), function(data) {

                    PopupModule.openPopup(popupSuccess);
                    $('#faq_callback_form')[0].reset();
                },
                'json'
            );
        }
        // $.get( '/callbacks/create', $('#faq_callback_form').serialize(), function(data) {
        //
        //         PopupModule.openPopup(popupSuccess);
        //         $('#faq_callback_form')[0].reset();
        //     },
        //     'json'
        // );
    });
});