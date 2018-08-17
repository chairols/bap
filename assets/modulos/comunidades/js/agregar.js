$("#agregar").click(function () {
    datos = {
        'codigo': $("#codigo").val(),
        'comunidad': $("#comunidad").val(),
        'direccion': $("#direccion").val()
    };
    $.ajax({
        type: 'POST',
        url: '/comunidades/agregar_ajax/',
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
                {   type: 'success',
                    allow_dismiss: false
                });
                document.getElementById("codigo").value = "";
                document.getElementById("comunidad").value = "";
                document.getElementById("direccion").value = "";
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