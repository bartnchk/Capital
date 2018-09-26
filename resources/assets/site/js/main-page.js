window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(document).ready(function(){

    /** показываем уведомления, если они есть**/
    var message = $('#flash-message').html();

    if(message){

        console.log(123123123);

        popupActionsSuccessOpen( $('#popupNotification') );

        setTimeout(function(){
            PopupModule.closePopup( $('#popupNotification') );
            PopupModule.hideOverlay("popup", pageOverlay);
        }, 2500);
    }

     /** подписка на скидку **/
    $('#discount').on('click', function(){

        if( !ValidationModule.isValid(this.form) )
            return false;

        PopupModule.closePopup($('#popupActions'));

        var name  = $('#discount-name').val();
        var email = $('#discount-email').val();
        var phone = $('#discount-phone').val();

        axios.post('/main/discount',{name: name, email: email, phone: phone});

        popupActionsSuccessOpen( $('#popupActionsSuccess') );

        return false;
    });

    /** подписка на новости **/
    $('#subscribe').on('click', function(){

        if( !ValidationModule.isValid(this.form) )
            return false;

        var email = $('#subscribe-email').val();

        if(!email) {
            $('#popupNotification').find('p').html('Вы не ввели e-mail ');

            popupActionsSuccessOpen( $('#popupNotification') );

            setTimeout(function(){
                PopupModule.closePopup( $('#popupNotification') );
                PopupModule.hideOverlay("popup", pageOverlay);
            }, 2500);

            return false;
        }

        axios.post('/main/subscribe', {email: email}).then(function(response){});

        popupActionsSuccessOpen( $('#popupSubscribeSuccess') );

        return false;

    });
});
