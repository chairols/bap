$("#agregar").click(function () {
    datos = {
        'codigo': $("#codigo").val(),
        'comunidad': $("#comunidad").val(),
        'pais': $("#pais").val(),
        'direccion': $("#direccion").val()
    };
    $.ajax({
        type: 'POST',
        url: '/comunidades/agregar_ajax/',
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
                document.getElementById("codigo").value = "";
                document.getElementById("comunidad").value = "";
                document.getElementById("direccion").value = "";
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