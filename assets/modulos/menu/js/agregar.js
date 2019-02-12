$(document).ready(function() {
    //$(".sss").multiselect();
});

$("#agregar").click(function () {
    datos = {
        'icono': $("#icono").val(),
        'titulo': $("#titulo").val(),
        'menu': $("#menu").val(),
        'href': $("#href").val(),
        'orden': $("#orden").val(),
        'padre': $("#padre").val(),
        'visible': $("#visible").is(':checked')
    };
    $.ajax({
        type: 'POST',
        url: '/menu/agregar_ajax/',
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
                document.getElementById("icono").value = "";
                document.getElementById("titulo").value = "";
                document.getElementById("menu").value = "";
                document.getElementById("href").value = "";
                document.getElementById("orden").value = "";
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
