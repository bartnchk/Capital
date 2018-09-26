window._ = require('lodash');

$(document).ready(function () {

    // initMap();

    let city = $('#city_id');
    let department = $('#department');
    let departmentsMap;

    let $depChosenResults = $('#department_chosen .chosen-results');

    if ($('#departmentMap').length) initMap();

    function getAllItems() {
        if ($('#departmentsMap').length === 0) return;

        axios.get(window.location.href + '/get-departments')
            .then(response => {
                initMap(response.data);
                setDepartmentsList(response.data);
            })
            .catch(error => {
                console.log(error);
            })

    }

    getAllItems();

    function setDepartmentsList(data) {
        let $departmentsListBlock = $('.departments-list-block');
        let itemsHTML = '';

        data.map((item) => {
            itemsHTML += `
                <div class="departments-item">

                    <div class="departments-item__img">
                      <img src="${item.image_path}">
                    </div>
                    
                    <div class="departments-item__location departments-item__wrap">
                      <div class="departments-item__title">№${item.number}</div>
                      <div class="departments-item__descr">${item.city_location}, ${ item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk }</div>
                    </div>

                    <div class="departments-item__time departments-item__wrap">
                      <div class="departments-item__title">Время работы</div>
                      <div class="departments-item__descr">${item.hasOwnProperty('work_days_ru') && item.work_days_ru !== null ? item.work_days_ru +', ' : '' } ${item.hasOwnProperty('work_days_uk') && item.work_days_uk !== null ? item.work_days_uk : '' } ${item.hasOwnProperty('time_start') && item.time_start !== null ? ', ' +item.time_start : '' } ${item.hasOwnProperty('time_end') && item.time_end !== null ? ' - ' + item.time_end : '' }</div>
                    </div>
                    
                    <div class="departments-item__phone departments-item__wrap">
                      <div class="departments-item__title">Телефон</div>
                      <div class="departments-item__descr">${item.phone}</div>
                    </div>

                </div>
                `;
        });        
        $departmentsListBlock.html(itemsHTML);
    };

    city.chosen().change(function () {
        let city_id = city.chosen().val();
        if (city_id !== 'national') {
            axios.get(window.location.href + '/get-departments?city=' + city_id)
                .then(response => {
                    fetchDepartments(response);
                    initMap(response.data);     
                    setDepartmentsList(response.data);          
                })
                .catch(error => {
                    console.log(error);
                });
        } else {
            getAllItems();
        }
    });

    department.chosen().change(function () {
        let city_id = city.chosen().val();
        let department_id = department.chosen().val();
        if (department_id !== 'all') {
            axios.get(window.location.href + '/get-departments?city=' + city_id + '&department=' + department_id)
                .then(response => {
                    _.map(response.data, function (item) {
                        departmentsMap.panZoom({lat: parseFloat(item.lat), lng: parseFloat(item.lng)});
                    });
                    departmentsMap.zoom(18);
                    setDepartmentsList(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        } else {
            departmentsMap.zoom(8);
            axios.get(window.location.href + '/get-departments?city=' + city_id)
                .then(response => {
                    setDepartmentsList(response.data);          
                })
                .catch(error => {
                    console.log(error);
                });
        }
    });

    department.on('chosen:showing_dropdown', function(evt, params) {
        let $chosenList = $depChosenResults.html();
        let replacedText = $chosenList.replace(/ divtitle/gm, '<div class="title">')
                                      .replace(/ div/gm, '<div>')
                                      .replace(/\/div/gm, '</div>'); 
        $depChosenResults.html(replacedText);
    });

    function chosenReplaceHtml(elCurHtml, elResHtml) {
        let $newOptionText = elCurHtml.replace(/divtitle/gm, '')
                                           .replace(/ div/gm, '')
                                           .replace(/\/div/gm, ''); 
        elResHtml.html($newOptionText);
    }

    department.on('change', function(evt, params) {        
        $depChosenResults.on('click', function(e) {
            let target = e.target;
            while (target.tagName != 'UL') {
                if (target.tagName == 'LI') {
                    let $curIndex = $(target).attr('data-option-array-index');
                    let $curOptionHtml = $($('#department option')[$curIndex]).html();
                    chosenReplaceHtml($curOptionHtml, $('#department_chosen .chosen-single span'));
                }
                target = target.parentNode;
            }
        });
    });

    $('#department_chosen .chosen-search input').on('keyup', function() {
        let $chosenHtml = $depChosenResults.html();
        chosenReplaceHtml($chosenHtml, $depChosenResults);
    });

    function fetchDepartments(response) {
        department.chosen({
            no_results_text: "Ничего не найдено!"
        });

        if (response) {
            clear();
            _.map(response.data, function (item) {
                department.append(`<option value="${item.id}">
                                    divtitle № ${item.number} ${item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk} /div
                                    div ${item.phone} /div
                                    div ${item.hasOwnProperty('time_start') && item.time_start !== null ? item.time_start : ''} ${item.hasOwnProperty('time_end') && item.time_end !== null ? '- ' + item.time_end : ''} /div
                                   </option>`);
            });
            department.trigger("chosen:updated");
        }
    }

    function clear() {
        department.empty();
        department.append('<option value="all">' + department.data('all') + '</option>');
    }

    function CreateMap(mapID) {
        if (typeof google !== 'undefined') {

            let current_location;
            navigator.geolocation.getCurrentPosition(function (position) {
                current_location = {lat: position.coords.latitude, lng: position.coords.longitude};
            });

            this.map = null;
            this.mapDiv = document.getElementById(mapID);
            this.mapData = this.mapDiv.dataset;
            this.center = {lat: parseFloat(this.mapData.lat), lng: parseFloat(this.mapData.lng)};

            this.initMap = function (zoom) {
                zoom = zoom || 8;
                this.map = new google.maps.Map(this.mapDiv, {
                    center: this.center,
                    zoom: zoom,
                });
            };
        }
    }

    function CreateMapDepartments(mapID, locations) {
        CreateMap.apply(this, arguments);

        let infoWindows = [];
        let currentMark = null;

        this.panZoom = function (location) {
            this.map.panTo(location);
        },

            this.zoom = function (zoom) {
                this.map.setZoom(zoom)
            },

            // start setCluster
            this.setCluster = function () {
                // Start markers array
                let markers = locations.map(function (item, i) {

                    let marker = new google.maps.Marker({
                        position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                        icon: '/img/marker.png'
                    });

                    // Start info Windows
                    let infoWindow = new google.maps.InfoWindow({
                        content: item.image_path !== null ? `
                      <div class="lombard-map__image-wrapper">
                        <img class="lombard-map__image" src="${item.image_path}">
                      </div>
                      <div class="lombard-map__number">№ ${item.number}</div>
                      <div class="lombard-map__location">${item.city_location}, ${ item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk } </div>
                      <div class="lombard-map__phone">
                        <a href="tel:${item.phone}">${item.phone}</a>
                      </div>
                      <div class="lombard-map__work-time">${item.hasOwnProperty('work_days_ru') && item.work_days_ru !== null ? item.work_days_ru +', ' : '' } ${item.hasOwnProperty('work_days_uk') && item.work_days_uk !== null ? item.work_days_uk : '' } ${item.hasOwnProperty('time_start') && item.time_start !== null ? ', ' +item.time_start : '' } ${item.hasOwnProperty('time_end') && item.time_end !== null ? ' - ' + item.time_end : '' }</div>
                      <a href="${item.link}" class="lombard-map__link">${item.details}</a>
                      `
                            :
                      `<div class="lombard-map__number">№ ${item.number}</div>
                      <div class="lombard-map__location">${item.city_location}, ${ item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk } </div>
                      <div class="lombard-map__phone">
                        <a href="tel:${item.phone}">${item.phone}</a>
                      </div>
                      <div class="lombard-map__work-time">${item.hasOwnProperty('work_days_ru') && item.work_days_ru !== null ? item.work_days_ru +', ' : '' } ${item.hasOwnProperty('work_days_uk') && item.work_days_uk !== null ? item.work_days_uk : '' } ${item.hasOwnProperty('time_start') && item.time_start !== null ? ', ' +item.time_start : '' } ${item.hasOwnProperty('time_end') && item.time_end !== null ? ' - ' + item.time_end : '' }</div>
                      <a href="${item.link}" class="lombard-map__link">${item.details}</a>
                    `
                    });
                    infoWindows.push(infoWindow);

                    let hoverInfoWindow = new google.maps.InfoWindow({
                        content: `<div>№ ${item.number}</div>`
                    });
                    // End info Windows

                    // Start Event listeners
                    google.maps.event.addListener(marker, 'click', function () {
                        for (let i = 0; i < infoWindows.length; i++) {
                            infoWindows[i].close();
                        }
                        hoverInfoWindow.close();
                        infoWindow.open(this.map, marker);
                        // start style image if noload
                        let $lombardMapImage = $('.lombard-map__image');
                        if( $lombardMapImage.outerWidth() < 50) {
                          $lombardMapImage.hide();
                        }
                        // end style image if noload
                        currentMark = infoWindow;

                        // start show close btn
                        $('.lombard-map__image-wrapper').closest('.gm-style-iw').next().show();
                        // end show close btn
                    });

                    google.maps.event.addListener(marker, 'mouseover', function () {
                        if (currentMark) return;
                        hoverInfoWindow.open(this.map, marker);
                    });

                    google.maps.event.addListener(marker, 'mouseout', function () {
                        hoverInfoWindow.close();
                    });

                    google.maps.event.addListener(infoWindow, 'closeclick', function () {
                        currentMark = null;
                    });
                    // End Event listeners

                    return marker;
                });
                // End markers array

                let markerCluster = new MarkerClusterer(this.map, markers, {
                    // imagePath: 'img/cluster-image',
                    styles: [{
                        url: '/img/cluster-image.png',
                        width: 42,
                        height: 42,
                        textColor: '#fff',
                        textSize: 12
                    }],
                });


            }
        // end setCluster


    }

    function CreateMapDepartment(mapID, location) {
        CreateMap.apply(this, arguments);

        let lat = $('#departmentMap').data('lat');
        let lng = $('#departmentMap').data('lng');

        this.setMarker = function () {
            let marker = new google.maps.Marker({
                position: {lat: parseFloat(lat), lng: parseFloat(lng)},
                map: this.map,
                zoom: this.map.setZoom(14),
                icon: '/img/marker.png'
            });
        }
    }

    function initMap(locations) {
        // departments
        (function () {

            if (!$('#departmentsMap').length) return;
            departmentsMap = new CreateMapDepartments('departmentsMap', locations);
            departmentsMap.initMap();
            departmentsMap.setCluster();
        }());
        // department
        (function () {
            if (!$('#departmentMap').length) return;
            let departmentMap = new CreateMapDepartment('departmentMap');
            departmentMap.initMap();
            departmentMap.setMarker();
        }());
    };
});
