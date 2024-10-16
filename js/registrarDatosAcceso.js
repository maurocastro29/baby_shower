
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formRegistroAcceso'); // Selecciona el formulario

    form.addEventListener('submit', function (event) {
        var erroresUsuario = [];
        var erroresPassword = [];
        let isValid = true; // Variable para rastrear si el formulario es válido
        const usuario = document.getElementById('usuario').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        // Validar el usuario
        if (!validateUsername(usuario)) {
            isValid = false;
            erroresUsuario.push('El usuario debe tener al menos 6 caracteres, empezar con una letra y puede contener números.');
        }
        // Validar las contraseñas
        if (!validatePasswordMatch(password, confirmPassword)) {
            isValid = false;
            erroresPassword.push('El usuario debe tener al menos 6 caracteres, empezar con una letra y puede contener números.');
        }
        // Si alguna validación falla, prevenir el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }
        if (erroresUsuario.length === 0 && erroresPassword.length === 0) {
            // Si no hay errores, enviar el formulario
            form.submit();  // Enviar el formulario si no hay errores
        }
    });

    document.getElementById('usuario').addEventListener('blur', function (){
        debugger;
        var usuario = this.value;
        var errores = [];
        if (!validateUsername(usuario)) {
            errores.push('El usuario debe tener al menos 6 caracteres, empezar con una letra y puede contener números.');
        }

        // Si no hay errores de formato, validamos si el usuario ya existe
        if (errores.length === 0) {
            // Realizar una solicitud AJAX para validar si el usuario existe en la base de datos
            $.ajax({
                url: 'validaciones.php',
                type: 'POST',
                data: {
                    action: 'validarUsuario', // Aquí especificas qué validación estás haciendo
                    usuario: usuario
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.exists) {
                        // Mostrar el mensaje de error si el usuario ya existe
                        $('#usuario').addClass('is-invalid');
                        $('#usuario-error').remove();
                        if (!$('#usuario-error').length) {
                            $('<div id="usuario-error" class="text-danger">Este usuario ya está registrado</div>').insertAfter('#usuario');
                        }
                    } else {
                        // Limpiar el mensaje de error si el usuario es válido y no existe
                        $('#usuario').removeClass('is-invalid');
                        $('#usuario-error').remove();

                        // Añadir borde verde y mensaje de usuario válido
                        $('#usuario').addClass('is-valid'); // Agregar clase para mostrar que el usuario es válido
                        if (!$('#usuario-success').length) {
                            $('<div id="usuario-success" class="text-success">Este usuario es válido</div>').insertAfter('#usuario');
                        }
                    }
                },
                error: function () {
                    console.error('Error al verificar el usuario.');
                }
            });
        } else {
            // Si el formato no es válido, mostrar el error de formato
            $('#usuario').addClass('is-invalid');
            $('#usuario-error').remove();
            if (!$('#usuario-error').length) {
                $('<div id="usuario-error" class="text-danger">' + errores.join(', ') + '</div>').insertAfter('#usuario');
            }
        }
    });


    // Validar el formato del usuario
    function validateUsername(username) {
        const regex = /^[A-Za-z][A-Za-z0-9]{5,}$/;
        return regex.test(username);
    }

    // Validar que las contraseñas coincidan
    function validatePasswordMatch(password, confirmPassword) {
        return password === confirmPassword;
    }

    $('#confirmPassword').on('input', function() {
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
    
        if (password === confirmPassword) {
            // Si las contraseñas coinciden
            $('#confirmPassword').removeClass('is-invalid').addClass('is-valid');
            $('#password').removeClass('is-invalid').addClass('is-valid');
            $('#password-error, #password-success').remove();
    
            if (!$('#password-success').length) {
                $('<div id="password-success" class="text-success">Las contraseñas coinciden</div>').insertAfter('#confirmPassword');
            }
        } else {
            // Si las contraseñas no coinciden
            $('#confirmPassword').removeClass('is-valid').addClass('is-invalid');
            $('#password').removeClass('is-valid').addClass('is-invalid');
            $('#password-success, #password-error').remove();
    
            if (!$('#password-error').length) {
                $('<div id="password-error" class="text-danger">Las contraseñas no coinciden</div>').insertAfter('#confirmPassword');
            }
        }
    });
});
