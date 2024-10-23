/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {


    const formCambiarPassword = document.getElementById("formCambiarPassword");
    var inputPassword = document.getElementById("inputPassword").disabled = true;
    var inputPasswordConfirm = document.getElementById("inputPasswordConfirm").disabled = true;
    document.getElementById("btnCambiarPassword").disabled = true;
    var isvalueOldPassword = false;
    var isvalueNewPassword = false;

    // Manejador del evento blur o cuando el usuario pierde el foco en el campo de contraseña
    document.getElementById('inputPasswordOld').addEventListener('blur', function () {
        debugger;
        var passwordOld = this.value;
        var errores = [];
        var inputPassword = document.getElementById("inputPassword");
        var inputPasswordConfirm = document.getElementById("inputPasswordConfirm");
        // Realizar una solicitud AJAX para validar si el correo existe en la base de datos
        $.ajax({
            url: '../admin/funciones/cambiar_password.php',
            type: 'POST',
            data: {
                action: 'validarPassword', // Aquí especificas qué validación estás haciendo
                inputPasswordOld: passwordOld
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.exists) {
                    inputPassword.disabled = false;
                    inputPasswordConfirm.disabled = false;
                    isvalueOldPassword = true;
                    if(isvalueNewPassword && isvalueOldPassword){//Si las contraseñas nuevas coinciden y la anterior se valido se habilita el boton de confirmar
                        document.getElementById("btnCambiarPassword").disabled = true;
                    }
                } else {
                    isvalueOldPassword = false;
                    inputPassword.disabled = true;
                    inputPasswordConfirm.disabled = true;
                    document.getElementById("btnCambiarPassword").disabled = true;
                    inputPassword.value = '';
                    inputPasswordConfirm.value = '';
                    Swal.fire({
                        position: "top-center",
                        icon: "warning",
                        title: "¡Contraseña incorrecta. escriba nuevamente su contraseña actual!",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#inputPasswordConfirm').removeClass('is-invalid');
                    $('#inputPassword').removeClass('is-invalid');
                    $('#inputPasswordConfirm').removeClass('is-valid');
                    $('#inputPassword').removeClass('is-valid');
                    $('#inputPassword-error, #inputPassword-success').remove();
                }
            },
            error: function () {
                isvalueOldPassword = false;
                btnCambiarPassword.disabled = true;
                console.error('Error al verificar el correo.');
            }
        });
        
    });

    formCambiarPassword.addEventListener('submit', function(event) {
        debugger;
        event.preventDefault();
        var inputPasswordNew = document.getElementById('inputPassword').value;

        $.ajax({
            url: '../admin/funciones/cambiar_password.php',
            type: 'POST',
            data: {
                action: 'cambiarPassword', // Aquí especificas qué validación estás haciendo
                inputPassword: inputPasswordNew
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.exists) {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    Swal.fire({
                        position: "top-center",
                        icon: "warning",
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            },
            error: function () {
                console.error('Error al verificar el correo.');
            }
        });

        /*/var nameBaby = document.getElementById('nombreBebe').value;
        if (sexoBebe === '') {
            Swal.fire({
                position: "top-center",
                icon: "warning",
                title: "¡Por favor, ingese una opcion en el sexo del bebé.!",
                showConfirmButton: false,
                timer: 3000
            });
            continuarSexo = false;
        }else{
            consitunarSexo = true;
        }
        if(nameBaby === ""){
            Swal.fire({
              title: "No ha digitado el nombre del bebé",
              text: "¿Desea continuar el proceso o quiere escribirlo?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, continuar",
              denyButtonText: `Volver a escribir`
            }).then((result) => {
              if (result.isConfirmed) {
                formCambiarPassword.submit();  // Enviar el formulario si no hay errores
              }else{
                continuarNombre = false;
              }
            });
        }else{
            continuarNombre = true;
        }
        if(consitunarSexo && continuarNombre && continuarFecha){
            formCambiarPassword.submit();  // Enviar el formulario si no hay errores
        }*/
    });

    

    $('#inputPasswordConfirm').on('input', function() {
        var inputPassword = $('#inputPassword').val();
        var inputPasswordConfirm = $('#inputPasswordConfirm').val();
    
        if (inputPassword === inputPasswordConfirm) {
            debugger
            isvalueNewPassword = true;
            if(isvalueOldPassword){//Si las contraseñas nuevas coinciden y la anterior se valido se habilita el boton de confirmar
                document.getElementById("btnCambiarPassword").disabled = false;
            }
            // Si las contraseñas coinciden
            $('#inputPasswordConfirm').removeClass('is-invalid').addClass('is-valid');
            $('#inputPassword').removeClass('is-invalid').addClass('is-valid');
            $('#inputPassword-error, #inputPassword-success').remove();
    
            if (!$('#inputPassword-success').length) {
                $('<div id="inputPassword-success" class="text-success">Las contraseñas coinciden</div>').insertAfter('#inputPasswordConfirm');
            }
        } else {
            isvalueNewPassword = false;
            document.getElementById("btnCambiarPassword").disabled = true;
            // Si las contraseñas no coinciden
            $('#inputPasswordConfirm').removeClass('is-valid').addClass('is-invalid');
            $('#inputPassword').removeClass('is-valid').addClass('is-invalid');
            $('#inputPassword-success, #inputPassword-error').remove();
    
            if (!$('#inputPassword-error').length) {
                $('<div id="inputPassword-error" class="text-danger">Las contraseñas no coinciden</div>').insertAfter('#inputPasswordConfirm');
            }
        }
    });

    $('#inputPassword').on('input', function() {
        var inputPassword = $('#inputPassword').val();
        var inputPasswordConfirm = $('#inputPasswordConfirm').val();
        if(inputPasswordConfirm.length > 0){
            debugger;
            if (inputPassword === inputPasswordConfirm) {
                isvalueNewPassword = true;
                if(isvalueOldPassword){//Si las contraseñas nuevas coinciden y la anterior se valido se habilita el boton de confirmar
                    document.getElementById("btnCambiarPassword").disabled = false;
                }
                // Si las contraseñas coinciden
                $('#inputPasswordConfirm').removeClass('is-invalid').addClass('is-valid');
                $('#inputPassword').removeClass('is-invalid').addClass('is-valid');
                $('#inputPassword-error, #inputPassword-success').remove();
        
                if (!$('#inputPassword-success').length) {
                    $('<div id="inputPassword-success" class="text-success">Las contraseñas coinciden</div>').insertAfter('#inputPasswordConfirm');
                }
            } else {
                isvalueNewPassword = false;
                document.getElementById("btnCambiarPassword").disabled = true;
                // Si las contraseñas no coinciden
                $('#inputPasswordConfirm').removeClass('is-valid').addClass('is-invalid');
                $('#inputPassword').removeClass('is-valid').addClass('is-invalid');
                $('#inputPassword-success, #inputPassword-error').remove();
        
                if (!$('#inputPassword-error').length) {
                    $('<div id="inputPassword-error" class="text-danger">Las contraseñas no coinciden</div>').insertAfter('#inputPasswordConfirm');
                }
            }
        }else{
            isvalueNewPassword = false;
            document.getElementById("btnCambiarPassword").disabled = true;
            $('#inputPasswordConfirm').removeClass('is-invalid');
            $('#inputPassword').removeClass('is-invalid');
            $('#inputPasswordConfirm').removeClass('is-valid');
            $('#inputPassword').removeClass('is-valid');
            $('#inputPassword-error, #inputPassword-success').remove();
        }
        
    });

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
