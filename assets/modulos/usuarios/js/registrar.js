

var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    console.log(place.address_components);
    console.log(place);
    $("#place_id").val(place.place_id);

    set_map(place.place_id);
});

function set_map(place_id) {
    function initMap() {
        // The location of Uluru
        var uluru = {lat: -25.344, lng: 131.036};
        // The map, centered at Uluru
        var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 4, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
    }


}

$("#registrarse").click(function () {
    if ($("#address").val() === "") {
        $("#place_id").val("");
    }

    datos = {
        'email': $("#email").val(),
        'place_id': $("#place_id").val(),
        'password': $("#password").val(),
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