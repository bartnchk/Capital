$(document).ready(function () {

///Chosen init
    function initChosen() {
        var el = $('input#category, input#regions, input#cities');
        el.chosen({
            no_results_text: "Ничего не найдено!"
        });
        loadCategories();
        loadRegions();

    }initChosen();

    function loadCategories () {
        axios.get('/admin/vacancies/get-categories')
            .then(response => {
                fillCategories(response);
                markSelected('#category');
            })
            .catch(error => {
                console.log(error);
            });
    }

    function fillCategories(response) {
        let el = $('#category');
        if (response){
            el.empty();
            el.append('<option value="">Выберите категорию</option>');
            _.map(response.data, function (item) {
                el.append('<option value="' + item.id + '">' + item.title_ru + '</option>');
            });
            el.trigger("chosen:updated");
        }

    }

    function loadRegions () {
        let el = $('input#regions');
        axios.get('/admin/vacancies/get-regions')
            .then(response => {
                fillRegions(response);
                markSelected('#regions');
                if (el.chosen().val() !== '0'){
                    loadCities(el.chosen().val());
                }
            })
            .catch(error => {
                console.log(error);
            });
    }

    function fillRegions(response) {
        let el = $('input#regions');
        if (response){
            el.empty();
            el.append('<option value="">Выберите область</option>');
            _.map(response.data, function (item) {
                el.append('<option value="' + item.id + '">' + item.title_ru + '</option>');
            });
            el.trigger("chosen:updated");
        }

        el.chosen().change(function () {
            if (typeof el.chosen().val() !== 'undefined')
                loadCities(el.chosen().val());
        });
    }

    function loadCities(id) {
        axios.post('/admin/vacancies/get-cities', {id: id})
            .then(response => {
                fillCities(response);
                markSelected('#cities');
            })
            .catch(error => {
                console.log(error);
            });
    }

    function fillCities(response) {
        let el = $('input#cities');

        if (response) {
            el.empty();
            el.append('<option value="">Выберите город</option>');
            _.map(response.data, function (item) {
                el.append('<option value="' + item.id + '">' + item.title_ru + '</option>');
            });
            el.trigger("chosen:updated");
        }
    }

    function markSelected(element) {
        let el = $(element);
        $( element + ' > option[value="' + el.data('selected') + '"]').attr("selected", "selected");
        el.trigger("chosen:updated");
    }
});