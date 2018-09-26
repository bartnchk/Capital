//раскрываем боковое меню до выбранного элемента
showActiveElement();

$(document).ready(function () {

    //sidebar
    $('a.dropdown-toggle').on('click', function(){

        $(this).parent().find('ul:first').slideToggle();
        $(this).parent().find('ul.submenu:first').show();

    });

    // multiple checkboxes
    $(".all").on("change", function() {
        var groupId = $(this).data('id');
        $('.one[data-id="' + groupId + '"]').prop("checked", this.checked);
    });

    $(".one").on("change", function() {
        var groupId = $(this).data('id');
        var allChecked = $('.one[data-id="' + groupId + '"]:not(:checked)').length == 0;
        $('.all[data-id="' + groupId + '"]').prop("checked", allChecked);
    });

    $('input.custom-file-input').change(function() {
        var i = $(this).prev('label').clone();
        var file = $('input.custom-file-input')[0].files[0].name;
        console.log(file);
        $(this).parent('.custom-file').find('label').html(file);
    });
    //еденичное удаление записей
    // назначить для <tr> и для кнопки  data-element-id="id свойство объекта"
    // для кнопки class="delete" и  data-delete-url="/admin/tariffs/id объекта"
    $('.delete').click(function (e) {
        e.preventDefault();

        var url = $(this).data('delete-url');
        var id = $(this).data('element-id');

        $.ajax({
            dataType: 'json',
            type: "DELETE",
            url: url,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.class == 'success') {

                    $('tr[data-element-id="' +id+ '"], li[data-element-id="' +id+ '"]').fadeOut(200);
                }
                window.flash(response.message, response.class);
            }
        })
    });
    // function showNotification(message, classType) {
    //     $('#main').prepend('<div class="alert alert-'+ classType +'">'+ message +'</div>');
    //
    //     setTimeout( function () {$('.alert').fadeOut(500)}, 3000);
    //
    // }

    //admin/user
    function changePassword() {
        $('button[name="change_password"]').on('click', function () {
            var el_password = $('.password_form');

            el_password.toggleClass('show');
            el_password.slideToggle();

            if (el_password.hasClass('show'))
                el_password.find('input').prop('required', true);
            else
                el_password.find('input').prop('required', false);
        })
    }changePassword();

     /**изменение статус колбека**/
    $('.status-switcher').click(function () {

        var url = $(this).data('change-url');
        var id = $(this).data('change-id');

        $.ajax({
            dataType: 'JSON',
            type: "PUT",
            url: url,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.class == 'success') {
                    var $badge = $('#status-badge-' + id);
                    if ( $badge.hasClass('badge-success') ) {
                        $badge.removeClass( "badge-success" ).addClass('badge-warning').html('не обработано');
                    } else {
                        $badge.removeClass( "badge-warning" ).addClass('badge-success').html('обработано');
                    }
                    window.flash(response.message, response.class);
                }
                if (response.class == 'error') {

                    window.flash(response.message, response.class);
                }
            }
        })
    });

    /**  поиск по новостям  **/
    $('#searchInputButton').click(function () {
        url = '/admin/news?q=' + $('#searchInputField').val();
        window.location.assign(url);
    });
    $('#searchInputField').on('keyup', function (e) {
        if(e.keyCode === 13){
            url = '/admin/news?q=' + $('#searchInputField').val();
            window.location.assign(url);
        }
    });

    /**  поиск по отделениям  **/

    $('#searchOfficeButton').click(function () {
        url = '/admin/offices?q=' + $('#searchOfficeField').val();
        window.location.assign(url);
    });
    $('#searchOfficeField').on('keyup', function (e) {
        if(e.keyCode === 13){
            url = '/admin/offices?q=' + $('#searchOfficeField').val();
            window.location.assign(url);
        }
    });

});

/**раскрываем боковое меню до выбранного элемента**/
function showActiveElement()
{
    var elems = location.pathname.split('/');
    var currentPage = elems[elems.length - 1];
    var parents = $('#' + currentPage).parents('ul');

    if(parents.length)
    {
        parents.show();
    }
}