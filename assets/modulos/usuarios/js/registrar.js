$(document).ready(function() {
    $("#lat").val("-34.6157437");
    $("#lon").val("-58.43338");
    //$("#actualizar_mapa").click();
    initMap();
});
var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    console.log(place.address_components);
    console.log(place);
    $("#place_id").val(place.place_id);

    $("#lat").val(place.geometry.location.lat());
    $("#lon").val(place.geometry.location.lng());
    $("#direccion").val(place.formatted_address);
    $("#actualizar_mapa").click();

    place.address_components.forEach(function(data) {
        if(data.types[0] == 'country' && data.types[1] == 'political') {
            $("#pais_nombre_largo").val(data.long_name);
            $("#pais_nombre_corto").val(data.short_name);
        }
    });
});

$("#actualizar_mapa").click(function () {
    updateMap($("#lat").val(), $("#lon").val());
});
/*
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {lat: -34.6157437, lng: -58.43338},
        disableDefaultUI: true
    });
}
*/

function initMap() {
    var myLatLng = {lat: parseFloat($("#lat").val()), lng: parseFloat($("#lon").val())};
    
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: myLatLng,
        disableDefaultUI: true
    });
}

function updateMap(lat, lon) {

    //var myLatLng = {lat: -25.363, lng: 131.044};
    var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lon)};
    //var myLatLng = {lat: -34.5868451, lng: -58.425443};
    
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: myLatLng,
        disableDefaultUI: true
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });

}

$("#registrarse").click(function () {
    if ($("#address").val() === "") {
        $("#place_id").val("");
    }

    datos = {
        'email': $("#email").val(),
        'place_id': $("#place_id").val(),
        'password': $("#password").val(),
        'lat': $("#lat").val(),
        'lon': $("#lon").val(),
        'pais_nombre_largo': $("#pais_nombre_largo").val(),
        'pais_nombre_corto': $("#pais_nombre_corto").val(),
        'direccion': $("#direccion").val(),
        'g-recaptcha-response': grecaptcha.getResponse()
    };
    $.ajax({
        type: 'POST',
        url: '/usuarios/registrar_ajax/',
        data: datos,
        beforeSend: function () {
            $("#registrarse").hide();
            $("#registrarse_loading").show();
        },
        success: function (data) {
            resultado = $.parseJSON(data);
            if (resultado['status'] == 'error') {
                $context = 'error';
                $message = resultado['data'];
                $position = 'toast-top-right';

                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $position
                });
                if("widget" in resultado) {
                    $("#widget").html(resultado['widget']);
                    $("#script").html(resultado['script']);
                }
            } else if (resultado['status'] == 'ok') {
                $context = 'success';
                $message = resultado['data'];
                $position = 'toast-top-right';

                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $position
                });
            }
            $("#registrarse_loading").hide();
            $("#registrarse").show();
        },
        error: function (xhr) { // if error occured
            $context = 'error';
            $message = xhr.statusText;
            $position = 'toast-top-right';

            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $position
            });
            
            $("#registrarse_loading").hide();
            $("#registrarse").show();
        }
    });
});