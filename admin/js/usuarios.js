$(function () {
    document.addEventListener("DOMContentLoaded", function () {
    
    alert("Hola mundo");

});

    let editarUsuario = '';
    //EDITAR UN USUARIO
    $('#editar-usuarios-form').submit(function (e) {
        const datosEnviar = {
            editarUsuario: '1',
            primerNombre: $('#inputFirstName').val(),
            segundoNombre: $('#inputSecondName').val(),
            primerApellido: $('#inputFirstApellido').val(),
            segundoApellido: $('#inputSecondApellido').val(),
            cedula: $('#inputCedula').val(),
            telefono: $('#inputTelefono').val(),
            email: $('#inputEmail').val(),
            usuario: $('#inputUsuario').val(),
            tipoUsuario: $('#selectTipoUsuario').val(),
            password: $('#inputPassword').val(),
            confirmarPassword: $('#inputPasswordConfirm').val(),
            fechaCreacion: getFechaActual()
        };
        console.log(datosEnviar);
        let url = './backend/controllers/usuarios_controller.php';
        $.post(url, datosEnviar, function (response) {
            $('#reservar-form').trigger('reset');
            if (response == 1) {
                alert('Usuario creado con exito');
            }
            console.log(response);
        });
        e.preventDefault();
        editarUsuario = '';
    });

    function getFechaActual() {
        let date = new Date();
        //obtener fecha
        let dia = ('0' + date.getDate()).slice(-2);
        let mes = ('0' + (date.getMonth() + 1)).slice(-2);
        let anio = date.getFullYear();
        let fecha = anio + '-' + mes + '-' + dia;
        //obtener hora
        let hora = ('0' + date.getHours()).slice(-2);
        let minutos = ('0' + date.getMinutes()).slice(-2);
        let horaActual = hora + ':' + minutos;
        fechaAct = fecha + ' - ' + horaActual;
        return fechaAct;
    }

});