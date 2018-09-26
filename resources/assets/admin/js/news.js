$(document).ready(function () {

    window.onkeydown = function (e) {
        if (e.keyCode === 13) {
            e.preventDefault()
        }
    }


///Chosen init
    function initChosen() {
        var el = $('#region, #city');
        el.chosen({
            no_results_text: "Ничего не найдено!"
        });

        initRegion();
        markSelectedRegion();
        getSelectRegion(el)
    }

    initChosen();

    function initRegion(id) {
        var el = $('#region');
        el.chosen().change(function () {
            if (typeof el.chosen().val() !== 'undefined')
                initCities(el.chosen().val());
        });
    }

    function initCities(id) {
        axios.post('/admin/cities/get-cities', {id: id})
            .then(response => {
                fetchCities(response);
                markSelectedCity();
            })
            .catch(error => {
                console.log(error);
            });
    }

    function fetchCities(response) {
        var el = $('#city');
        el.chosen({
            no_results_text: "Ничего не найдено!"
        });

        if (response) {
            clear();
            _.map(response.data, function (item) {
                el.append('<option value="' + item.id + '">' + item.title_ru + '</option>');
            });
            el.trigger("chosen:updated");
        }
    }

    function clear() {
        let el = $('#city');
        el.empty();
        el.append('<option value="0">Выберите город</option>');
    }

    function getSelectRegion(el) {
        initCities(el.chosen().val());
    }

    function markSelectedRegion() {
        let el = $('#region');
        $('#region > option[value="' + el.data('selected') + '"]').attr("selected", "selected");
        el.trigger("chosen:updated");
    }

    function markSelectedCity() {
        let el = $('#city');
        $('#city > option[value="' + el.data('selected') + '"]').attr("selected", "selected");
        el.trigger("chosen:updated");
    }

});