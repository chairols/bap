$("#agregar").click(function() {
    datos = {
        'pais': $("#pais").val()
    };
    
    $.ajax({
        type: 'POST',
        url: '/paises/agregar_ajax/',
        data: datos,
        beforeSend: function() {
            $("#agregar").hide();
            $("#loading").show();
        },
        success: function(data) {
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
                $("#pais").val("");
            }
            $("#loading").hide();
            $("#agregar").show();
            $("#pais").focus();
        },
        error: function (xhr) { // if error occured
            $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText, 
            {
                type: 'danger',
                allow_dismiss: false
            });
            $("#loading").hide();
            $("#agregar").show();
            $("#pais").focus();
        }
    });
});