$(document).ready(function(){

    //delete image from client gallery
    $('.delete-client-photo').on('click', function(){

        var id = $(this).data('id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var elem = $(this).closest('div.col-sm-3');

        $.ajax({
            type: 'DELETE',
            url: '/admin/images/' + id,
            data: {_token: token, id : id},
            dataType: 'json',
            success: function(data) {

                if(data.class == 'success') {

                    elem.empty();
                    window.flash(data.message, data.class);

                } else {

                    window.flash(data.message, data.class);

                }
            }
        })
    })

});