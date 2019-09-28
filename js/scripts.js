$(function(){


    // Galería de imágenes
    $('.galeria .contenedor-imagen').on('click', function(){
        $('#modal').modal;
        var ruta_imagen = ($(this).find('img').attr('src'));
        $('#imagen-modal').attr('src', ruta_imagen);
    });


    // Acciones del formulario de consultas
    $("#boton_formulario").click(function(){
        //console.log("El botón ha sido presionado.");

        // Declaración de variables
        let nombre = $("#nombre").val();
        let email = $("#email").val();
        let mensaje = $("#mensaje").val();

        //console.log("Nombre: " + nombre + " Email: " + email + " Mensaje: " + mensaje );

        // Variables para pasarle al procesador del formulario procesa_formulario.php
        var parametros = {
            "nombre": nombre,
            "email": email,
            "mensaje": mensaje
        };
    
        // Llamada Ajax
        // Esto es lo que llama al formulario
    
        $.ajax({
            type: 'POST',
            dataType:'JSON',
            url: 'procesa_formulario.php',
            data: parametros,
            success:function(data){
               console.log("Todo bien: " + data); 
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log("Algo falló: " + thrownError);
            }
        });

    });

})


