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
                $.notify(resultado['data'],
                        {
                            type: 'success',
                            allow_dismiss: false
                        });
                document.getElementById("icono").value = "";
                document.getElementById("titulo").value = "";
                document.getElementById("menu").value = "";
                document.getElementById("href").value = "";
                document.getElementById("orden").value = "";
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
});
