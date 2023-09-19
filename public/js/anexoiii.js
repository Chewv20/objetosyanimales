    $(document).ready(function(){
        // Ventana modal

        cargarReloj();

    })

    function cargarReloj(){
        let hoy = new Date()
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        const dias_semana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        let fecha = dias_semana[hoy.getDay()] + ', ' + hoy.getDate() + ' de ' + meses[hoy.getMonth()] + ' de ' + hoy.getUTCFullYear()
        document.getElementById('fechaHoy').innerHTML = fecha + ', '+hoy.toLocaleTimeString('en-US')
        setTimeout(cargarReloj, 500);
    }



  