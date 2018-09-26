$(document).ready(function () {

    window.onkeydown = function (e) {
        if (e.keyCode === 13) {
            e.preventDefault()
        }
    }

    var map, infoWindow, marker, service;

    function initMap() {
        var el_lng = +$('#lng').val();
        var el_lat = +$('#lat').val();
        if (typeof google !== 'undefined') {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: el_lat ? el_lat : 50.458, lng: el_lng ? el_lng : 30.528},
                zoom: 10
            });
            infoWindow = new google.maps.InfoWindow;
            service = new google.maps.places.PlacesService(map);

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: el_lat ? el_lat : position.coords.latitude,
                        lng: el_lng ? el_lng : position.coords.longitude
                    };

                    // Create the search box and link it to the UI element.
                    var input = document.getElementById('pac-input');
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                    // Bias the SearchBox results towards current map's viewport.
                    map.addListener('bounds_changed', function () {
                        searchBox.setBounds(map.getBounds());
                    });

                    var markers = [];
                    // Listen for the event fired when the user selects a prediction and retrieve
                    // more details for that place.
                    searchBox.addListener('places_changed', function () {
                        var places = searchBox.getPlaces();

                        if (places.length == 0) {
                            return;
                        }
                        marker.setMap(null);


                        // For each place, get the icon, name and location.
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function (place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }

                            marker = new google.maps.Marker({
                                map: map,
                                draggable: true,
                                animation: google.maps.Animation.DROP,
                                title: place.name,
                                position: place.geometry.location
                            });

                            if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);

                        marker.addListener('click', toggleBounce);
                        setData(marker);
                    });


                    map.setCenter(pos);
                    marker = new google.maps.Marker({
                        map: map,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        position: pos,
                    });

                    marker.addListener('click', toggleBounce);
                    marker.addListener('dragend', function () {
                        setData(marker);
                    });

                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                    $('#pac-input').hide();
                });
            } else {
                // Browser doesn't support Geolocation

                handleLocationError(false, infoWindow, map.getCenter());
            }
            infoWindow.open(map);
        }
    }

    initMap();

    function setData(marker) {
        setMarkerData(marker.getPosition().lat(), marker.getPosition().lng());
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            latLng: marker.getPosition()
        }, function (result, status) {
            if (status === 'OK') {
                setLocation(result);
            }
        })
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    function setMarkerData(lat, lng) {
        $('#lng').val(lng);
        $('#lat').val(lat);
    }

    function setLocation(location) {
        $('input[name="address_uk"]').val(location[0].address_components[1].long_name + ', ' + location[0].address_components[0].long_name);
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
            if (typeof el.chosen().val() !== 'undefined') {
                $('#city').removeClass('fillable');
                initCities(el.chosen().val());
            }
        });
    }

    function initCities(id) {
        axios.post('/admin/offices/get-cities', {id: id})
            .then(response => {
                fetchCities(response);
                markSelectedCity();
            })
            .catch(error => {
                console.log(error);
            });
    }

    function fetchCities(response) {
        let el = $('#city');
        el.chosen({
            no_results_text: "Ничего не найдено!"
        });

        if (response) {
            let cities_selected = $('#city').chosen().val();

            if (!el.hasClass('fillable')) {
                clear();

                _.map(response.data, function (item) {
                    el.append('<option value="' + item.id + '">' + item.title_ru + '</option>');
                });

                el.val(cities_selected);

                el.trigger("chosen:updated");
            }
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

        if ($('#city option:selected').length && $('#city').hasClass('fillable')) {

            let ids = $('#city option:selected').map(function () {
                return $(this).data('region');
            }).get();

            el.val(ids);
            el.removeClass('fillable');
        }

        el.trigger("chosen:updated");
    }

    function markSelectedCity() {
        let el = $('#city');
        $('#city > option[value="' + el.data('selected') + '"]').attr("selected", "selected");
        el.trigger("chosen:updated");
    }

    //Timepicker Init
    function initTimepicker() {
        var el_start = $('input[name="time_start"]');
        var el_end = $('input[name="time_end"]');

        $('.time_start').timepicker({
            timeFormat: 'H:mm',
            interval: 60,
            minTime: '8:00',
            maxTime: '12:00',
            defaultTime: el_start.val() ? el_start.val() : '9',
            startTime: '8:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('.time_end').timepicker({
            timeFormat: 'H:mm',
            interval: 60,
            minTime: '17:00',
            maxTime: '22:00',
            defaultTime: el_end.val() ? el_end.val() : '17',
            startTime: '17:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    }

    initTimepicker();
});