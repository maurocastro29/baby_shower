
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formRegistroEvento");
    const eventDateInput = document.getElementById('fechaEvento');
    var continuarFecha = false;
    var continuarNombre = false;
    var continuarSexo = false;
    // Establecer la fecha mínima en el campo input
    const today = new Date();
    const year = today.getFullYear();
    const month = (today.getMonth() + 1).toString().padStart(2, '0'); // Asegurar dos dígitos en el mes
    const day = today.getDate().toString().padStart(2, '0'); // Asegurar dos dígitos en el día
    const minDate = `${year}-${month}-${day}`;
    eventDateInput.setAttribute('min', minDate);

    // Añadir el evento para validar la fecha cuando el usuario la seleccione
    eventDateInput.addEventListener('change', function(){
        debugger;
        // Obtener la fecha seleccionada por el usuario
        const selectedDate = new Date(eventDateInput.value);
        console.log(selectedDate);
        // Obtener la fecha actual
        const today = new Date();
        console.log(today);
        
        // Eliminar la parte de horas, minutos, segundos de ambas fechas
        selectedDate.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);
        console.log(selectedDate);
        console.log(today);

        // Comparar la fecha seleccionada con la fecha actual
        if (selectedDate < today) {
            Swal.fire({
                position: "top-center",
                icon: "warning",
                title: "¡No puedes seleccionar una fecha anterior a la fecha actual.!",
                showConfirmButton: false,
                timer: 3000
            });
        }else{
            continuarFecha = true;
        }
    });

    form.addEventListener('submit', function(event) {
        debugger;
        event.preventDefault();
        var sexoBebe = document.getElementById('sexoBebe').value;
        var nameBaby = document.getElementById('nombreBebe').value;
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
                form.submit();  // Enviar el formulario si no hay errores
              }else{
                continuarNombre = false;
              }
            });
        }else{
            continuarNombre = true;
        }
        if(consitunarSexo && continuarNombre && continuarFecha){
            form.submit();  // Enviar el formulario si no hay errores
        }
    });

});