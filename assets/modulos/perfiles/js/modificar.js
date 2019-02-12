$(document).ready(function ()
{
    var updateOutput = function (e)
    {
        var list = e.length ? e : $(e.target),
                output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
            .on('change', updateOutput);


    $("#nestable").change(function () {
        actualizar_orden();
    });

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));


});

function actualizar(idmenu, idperfil) {
    console.log('Menú: ' + idmenu);
    console.log('Perfil: ' + idperfil);


    datos = {
        'idmenu': idmenu,
        'idperfil': idperfil
    };
    $.ajax({
        type: 'POST',
        url: '/perfiles/actualizar_accesos/',
        data: datos,
        beforeSend: function () {
            $("#checkbox-" + idmenu).attr("disabled", "disabled");
            $("#progreso-" + idmenu).show();
        },
        success: function (data) {
            resultado = $.parseJSON(data);
            if (resultado['status'] == 'error') {
                $.notify('<strong>' + resultado['data'] + '</strong>',
                        {
                            type: 'danger',
                            allow_dismiss: false
                        });
            } else if (resultado['status'] == 'ok') {
                $("#progreso-" + idmenu).hide();
                $.notify('Se actualizó correctamente',
                        {type: 'success',
                            allow_dismiss: false
                        });
            }
            $("#checkbox-" + idmenu).removeAttr("disabled");
        },
        error: function (xhr) { // if error occured
            $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText,
                    {
                        type: 'danger',
                        allow_dismiss: false
                    });
        }
    });


}

function actualizar_orden() {
    datos = {
        'orden': $("#nestable-output").val()
    };
    $.ajax({
        type: 'POST',
        url: '/perfiles/actualizar_orden/',
        data: datos,
        beforeSend: function () {

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
                $message = 'Se actualizó correctamente';
                $position = 'toast-top-right';

                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $position
                });
            }
        },
        error: function (xhr) { // if error occured
            $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText,
                    {
                        type: 'danger',
                        allow_dismiss: false
                    });
        }
    });
}

$("#actualizar").click(function () {
    datos = {
        'perfil': $("#perfil").val(),
        'idperfil': $("#perfil").attr('idperfil')
    };
    $.ajax({
        type: 'POST',
        url: '/perfiles/modificar_ajax/',
        data: datos,
        beforeSend: function () {
            $("#actualizar").hide();
            $("#actualizar_loading").show();
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
            $("#actualizar_loading").hide();
            $("#actualizar").show();
        },
        error: function (xhr) { // if error occured
            $context = 'error';
            $message = xhr.statusText;
            $position = 'toast-top-right';

            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $position
            });
            $("#actualizar_loading").hide();
            $("#actualizar").show();
        }
    });
});