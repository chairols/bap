$("#modificar").click(function () {
    datos = {
        'variable': $("#variable").val(),
        'valor': $("#valor").val(),
        'comentarios': $("#comentarios").val()
    };
    $.ajax({
        type: 'POST',
        url: '/variables/modificar_ajax/',
        data: datos,
        beforeSend: function () {
            $("#modificar").hide();
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
            }
            $("#loading").hide();
            $("#modificar").show();
        },
        error: function (xhr) { // if error occured
            $context = 'error';
            $message = xhr.statusText;
            $position = 'toast-top-right';

            toastr[$context]($message, '', {
                positionClass: $position
            });
            $("#loading").hide();
            $("#modificar").show();
        }
    });
});