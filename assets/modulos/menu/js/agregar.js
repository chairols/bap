$("#agregar").click(function() {
    alertify.confirm("Se agregará el menú <strong>"+ $("#titulo").val() + "<br>¿Desea continuar?</strong>", function (e) {
        if(e) {
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
                success: function(data) {
                    resultado = $.parseJSON(data);
                    if (resultado['status'] == 'error') {
                        alertify.error(resultado['data']);
                    } else if (resultado['status'] == 'ok') {
                        alertify.success("Se agregó correctamente.");
                        document.getElementById("icono").value = "";
                        document.getElementById("titulo").value = "";
                        document.getElementById("menu").value = "";
                        document.getElementById("href").value = "";
                        document.getElementById("orden").value = "";
                    }
                }
            });
        }
    });
});
