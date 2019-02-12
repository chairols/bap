$("#agregar").click(function() {
    datos = {
        'perfil': $("#perfil").val()
    };
    
    $.ajax({
        type: 'POST',
        url: '/perfiles/agregar_ajax/',
        data: datos,
        beforeSend: function () {
            $("#agregar").hide();
            $("#loading").show();
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
                $("#perfil").val("");
                $("#perfil").focus();
            }
            $("#loading").hide();
            $("#agregar").show();
        },
        error: function (xhr) { // if error occured
            $context = 'error';
            $message = xhr.statusText;
            $position = 'toast-top-right';

            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $position
            });
            $("#loading").hide();
            $("#agregar").show();
        }
    });
});