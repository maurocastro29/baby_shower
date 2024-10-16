
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formRegistro");
    
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevenir envío del formulario hasta validar los campos
        let errores = [];
        // Obtener los valores de los campos
        const primerNombre = document.getElementById("primerNombre").value.trim();
        const primerApellido = document.getElementById("primerApellido").value.trim();
        const tipoIdentificacion = document.getElementById("tipoIdentificacion").value;
        const numeroIdentificacion = document.getElementById("numeroIdentificacion").value.trim();
        const correo = document.getElementById("correo").value.trim();
        // Validaciones básicas
        if (primerNombre === "") {
        errores.push("El primer nombre es obligatorio.");
        }
        if (primerApellido === "") {
        errores.push("El primer apellido es obligatorio.");
        }
        if (tipoIdentificacion === "") {
        errores.push("Debe seleccionar un tipo de identificación.");
        }
        if (numeroIdentificacion === "") {
        errores.push("El número de identificación es obligatorio.");
        }
        if (!validarEmail(correo)) {
        errores.push("El correo no es válido.");
        }
        // Mostrar los errores o enviar el formulario si todo está bien
        if (errores.length > 0) {
        mostrarErrores(errores);
        } else {
        // Si no hay errores, enviar el formulario
        form.submit();  // Enviar el formulario si no hay errores
        }
    });

    // Función para mostrar errores
    function mostrarErrores(errores) {
        const erroresDiv = document.getElementById("errores");
        erroresDiv.innerHTML = ""; // Limpiar mensajes de error previos
        errores.forEach(function (error) {
        const p = document.createElement("p");
        p.textContent = error;
        erroresDiv.appendChild(p);
        });
        erroresDiv.style.display = "block"; // Mostrar el contenedor de errores
    }

    // Función para validar correo electrónico
    function validarEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Función para validar usuario
    function validarEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Manejador del evento submit o cuando el usuario pierde el foco en el campo de correo
    document.getElementById('correo').addEventListener('blur', function () {
        var correo = this.value;
        var errores = [];
        // Primero validamos el formato del correo
        if (!validarEmail(correo)) {
            errores.push("El correo no es válido.");
        }
        // Si no hay errores de formato, validamos si el correo ya existe
        if (errores.length === 0) {
            // Realizar una solicitud AJAX para validar si el correo existe en la base de datos
            $.ajax({
                url: 'validaciones.php',
                type: 'POST',
                data: {
                    action: 'validarCorreo', // Aquí especificas qué validación estás haciendo
                    correo: correo
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.exists) {
                        // Mostrar el mensaje de error si el correo ya existe
                        $('#correo').addClass('is-invalid');
                        $('#correo-error').remove();
                        if (!$('#correo-error').length) {
                            $('<div id="correo-error" class="text-danger">Este correo ya está registrado</div>').insertAfter('#correo');
                        }
                    } else {
                        // Limpiar el mensaje de error si el correo es válido y no existe
                        $('#correo').removeClass('is-invalid');
                        $('#correo-error').remove();
                    }
                },
                error: function () {
                    console.error('Error al verificar el correo.');
                }
            });
        } else {
            // Si el formato no es válido, mostrar el error de formato
            $('#correo').addClass('is-invalid');
            $('#correo-error').remove();
            if (!$('#correo-error').length) {
                $('<div id="correo-error" class="text-danger">' + errores.join(', ') + '</div>').insertAfter('#correo');
            }
        }
    });

    document.getElementById('tipoIdentificacion').addEventListener('blur', function () {
        var tipoIdentificacion = document.getElementById('tipoIdentificacion').value; // Obtener el valor del campo tipo de identificación
        var errores = [];
        // Validar que se haya seleccionado un tipo de identificación
        if (!tipoIdentificacion) {
            errores.push("Debe seleccionar un tipo de identificación.");
            // Si hay errores (como que no se seleccionó un tipo de identificación), mostrar el error
            $('#tipoIdentificacion').addClass('is-invalid');
            $('#tipo-identificacion-error').remove();
            if (!$('#tipo-identificacion-error').length) {
                $('<div id="tipo-identificacion-error" class="text-danger">' + errores.join(', ') + '</div>').insertAfter('#tipoIdentificacion');
            }
        }else{
            $('#tipoIdentificacion').removeClass('is-invalid');
            $('#tipo-identificacion-error').remove();
        }
    });

    // Manejador del evento submit o cuando el usuario pierde el foco en el campo de numeroIdentificacion
    document.getElementById('numeroIdentificacion').addEventListener('blur', function () {
        var numeroIdentificacion = this.value;
        var tipoIdentificacion = document.getElementById('tipoIdentificacion').value; // Obtener el valor del campo tipo de identificación
        var errores = [];
        var errorIdentificacion = [];
        // Validar que se haya seleccionado un tipo de identificación
        if (!tipoIdentificacion) {
            errorIdentificacion.push("Debe seleccionar un tipo de identificación");
        }
        // Validar que el número de identificación solo contenga números y que tenga más de 6 dígitos
        var regexSoloNumeros = /^[0-9]+$/;
        if (!regexSoloNumeros.test(numeroIdentificacion)) {
            errores.push("El número de identificación debe contener solo números");
        }
        if (numeroIdentificacion.length <= 6) {
            errores.push("El número de identificación debe tener más de 6 dígitos");
        }
        // Si no hay errores previos, continuamos con la validación del número de identificación
        if (errores.length === 0 && errorIdentificacion.length === 0) {
            $('#tipoIdentificacion').removeClass('is-invalid');
            $('#tipo-identificacion-error').remove();
            // Realizar una solicitud AJAX para validar si el número de identificación ya está registrado
            $.ajax({
                url: 'validaciones.php',
                type: 'POST',
                data: {
                    action: 'validarNumeroIdentificacion', // Aquí especificas qué validación estás haciendo
                    numeroIdentificacion: numeroIdentificacion
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    $('#numero-identificacion-error').remove(); // Eliminar mensajes de error previos
                    
                    if (data.exists) {
                        // Mostrar el mensaje de error si el número de identificación ya existe
                        $('#numeroIdentificacion').addClass('is-invalid');
                        $('<div id="numero-identificacion-error" class="text-danger">Este número de identificación ya está registrado</div>').insertAfter('#numeroIdentificacion');
                    } else {
                        // Limpiar el mensaje de error si el número de identificación es válido y no existe
                        $('#numeroIdentificacion').removeClass('is-invalid');
                        $('#numero-identificacion-error').remove();
                    }
                },
                error: function () {
                    console.error('Error al verificar el número de identificación.');
                }
            });
        } else {
            // Si hay errores (como que no se seleccionó un tipo de identificación), mostrar el error
            if (errorIdentificacion.length > 0){
                $('#tipoIdentificacion').addClass('is-invalid');
                $('#tipo-identificacion-error').remove();
                if (!$('#tipo-identificacion-error').length) {
                    $('<div id="tipo-identificacion-error" class="text-danger">' + errorIdentificacion.join(', ') + '</div>').insertAfter('#tipoIdentificacion');
                }
            }
            if (errores.length > 0){
                $('#numeroIdentificacion').addClass('is-invalid');
                $('#numero-identificacion-error').remove();
                if (!$('#numero-identificacion-error').length) {
                    $('<div id="numero-identificacion-error" class="text-danger">' + errores.join(', ') + '</div>').insertAfter('#numeroIdentificacion');
                }
            }
        }
    });

    // Manejador del evento submit o cuando el usuario pierde el foco en el campo de usuario
    document.getElementById('usuario').addEventListener('blur', function () {
        var usuario = this.value;
        var errores = [];
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
                $('<div id="usuario-error" class="text-danger">' + errores.join(', ') + '</div>').insertAfter('#correo');
            }
        }
    });
    
});
