$("#agregar").click(function () {
    datos = {
        'variable': $("#variable").val(),
        'valor': $("#valor").val(),
        'comentarios': $("#comentarios").val()
    };
    $.ajax({
        type: 'POST',
        url: '/variables/agregar_ajax/',
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

                toastr[$context]($message, '', {
                    positionClass: $position
                });
            } else if (resultado['status'] == 'ok') {
                $context = 'success';
                $message = resultado['data'];
                $position = 'toast-top-right';

                toastr[$context]($message, '', {
                    positionClass: $position
                });
                $("#variable").val("");
                $("#valor").val("");
                $("#comentarios").val("");
                $("#variable").focus();
            }
            $("#loading").hide();
            $("#agregar").show();
        },
        error: function (xhr) { // if error occured
            $context = 'error';
            $message = xhr.statusText;
            $position = 'toast-top-right';

            toastr[$context]($message, '', {
                positionClass: $position
            });
            $("#loading").hide();
            $("#agregar").show();
        }
    });
});