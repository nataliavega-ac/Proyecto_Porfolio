$(function(){


    // Galería de imágenes
    $('.galeria .contenedor-imagen').on('click', function(){
        $('#modal').modal;
        var ruta_imagen = ($(this).find('img').attr('src'));
        $('#imagen-modal').attr('src', ruta_imagen);
    });



    // Botón para ir arriba
    $('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		},300 );
	});

	$(window).scroll(function(){
		if ($(this).scrollTop() > 0){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		};
	});


    // Destraba el validador
    $("#nombre").keyup(function() {
        $("#nombre").removeClass("borde_alerta").addClass("borde_normal");
    });
    $("#email").keyup(function() {
        $("#email").removeClass("borde_alerta").addClass("borde_normal");
    });

    // Acciones del formulario de consultas
    $("#boton_formulario").click(function(event){
       
        // Previene el envío accidental del formulario
        event.preventDefault();
        event.stopPropagation();

        // Declaración de variables
        let nombre = $("#nombre").val();
        let email = $("#email").val();
        let mensaje = $("#mensaje").val();

        var validate = true;
        
        if(email.indexOf('@', 0) == -1 || email.indexOf('.', 0) == -1) {
            $.notify("Debe ingresar un email válido", "error");
            $("#email").removeClass("borde_normal").addClass("borde_alerta");
            $("#email").focus();
            validate = false;
        };

        if (nombre.length < 2) {
            $.notify("Debe completar el nombre y debe tener 3 o más caracteres", "error");
            $("#nombre").removeClass("borde_normal").addClass("borde_alerta");
            $("#nombre").focus();
            validate = false;
        };


        if(validate) {

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
                    $.notify("Formulario enviado con éxito.", "success");
                    $("#nombre").val("");
                    $("#email").val("");
                    $("#mensaje").val("");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.notify("Existió un error en el envío del mail", "error");
                }
            });


        };

       

    });

})


