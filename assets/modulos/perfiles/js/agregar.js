$("#agregar").click(function() {
    datos = {
        'perfil': $("#perfil").val()
    };
    
    $.ajax({
        type: 'POST',
        url: '/perfiles/agregar_ajax/',
        data: datos,
        success: function (data) {
            resultado = $.parseJSON(data);
            if (resultado['status'] == 'error') {
                $.notify('<strong>' + resultado['data'] + '</strong>', 
                {
                    type: 'danger',
                    allow_dismiss: false
                });
            } else if (resultado['status'] == 'ok') {
                $.notify('<strong>' + resultado['data'] + '</strong>', 
                {   type: 'success',
                    allow_dismiss: false
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
});