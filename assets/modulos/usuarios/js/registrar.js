var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});

google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    console.log(place.address_components);
    console.log(place);
    $("#place_id").val(place.place_id);
});

$("#registrarse").click(function() {
    if($("#address").val() === "") {
        $("#place_id").val("");
    }
    
    datos = {
        'email': $("#email").val(),
        'place_id': $("#place_id").val(),
        'password': $("#password").val(),
        'g-recaptcha-response':grecaptcha.getResponse()
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