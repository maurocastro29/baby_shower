
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formRegistroEvento");

    form.addEventListener('submit', function(event) {
        var sexoBebe = document.getElementById('nombreBebe').value;
        var nombreOmitido = document.querySelector('input[name="nombreOmitido"]:checked').value;

        if (sexoBebe === '') {
            event.preventDefault();
            document.getElementById('errores').style.display = 'block';
            document.getElementById('errores').innerHTML = 'Por favor, ingese una opcion en el sexo del bebé.';
        }
    });

}