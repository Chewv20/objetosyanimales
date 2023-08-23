const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    $(document).ready(function(){
        // Ventana modal
        var modal = document.getElementById("ventanaModal");
        var modal1 = document.getElementById("ventanaModal1");

        document.getElementById("abrirModal").addEventListener("click",function() {
            modal.style.display = "block";
        });

        document.getElementsByClassName("cerrar")[0].addEventListener("click",function() {
            modal.style.display = "none";
        });

        window.addEventListener("click",function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        document.getElementById("abrirFiltro").addEventListener("click",function() {
            modal1.style.display = "block";
        });

        document.getElementsByClassName("cerrar")[1].addEventListener("click",function() {
            modal1.style.display = "none";
        });

        window.addEventListener("click",function(event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        });

        cargarReloj();

        document.getElementById('fecha').addEventListener('change',(e)=>{
            let fecha = new Date(e.target.value)
            fecha.setTime(fecha.getTime() + fecha.getTimezoneOffset() * 60 * 1000);
            let hoy = new Date()
            hoy.setHours(0,0,0,0);
            if( fecha.getTime() != hoy.getTime() ){
                $('#abrirModal').hide()
            }else{
                $('#abrirModal').show()
            }
            let lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
            lineas.forEach(element => {
                $('#linea'+element).DataTable().destroy()
                if(element=='A' || element =='B'){
                    generaTabla('#linea'+element,'L'+element,document.getElementById('tiempo').value)
                }else if(element == '12'){
                    generaTabla('#linea'+element,element,document.getElementById('tiempo').value)
                }else{
                    generaTabla('#linea'+element,'0'+element,document.getElementById('tiempo').value)
                }
            });

        })
        
        $('#larin').select2({
            dropdownAutoWidth : true,
            width: '400px'
        })

        $('#larin').on('select2:select', function (e) {
            var prueba = e.params.data;
            Pclave = prueba.id
            fetch('/eventos/getLarin',{
                method : 'POST',
                body: JSON.stringify({
                    id_larin : Pclave
                    }),
                headers:{
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response=>{
                return response.json()
            }).then( respuesta=>{
                document.getElementById('descripcion').value=respuesta[0].larin
                console.log(respuesta[0].larin);
            }).catch(error => console.error(error));
        });

        let $select = $('#filtros');

        let selecteds = [];
            
            $select.children(':selected').each((idx, el) => {
                // Obtenemos los atributos que necesitamos
                selecteds.push({
                id: el.id,
                value: el.value
                });
            });

        let lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
        lineas.forEach(element => {
            
            if(element=='A' || element =='B'){
                generaTabla('#linea'+element,'L'+element,0)
            }else if(element == '12'){
                generaTabla('#linea'+element,element,0)
            }else{
                generaTabla('#linea'+element,'0'+element,0)
            }
        });
        
        document.getElementById('borrarFiltro').addEventListener('click',(e)=>{
            let lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
        
            lineas.forEach(element => {
                $('#linea'+element).DataTable().destroy()
                if(element=='A' || element =='B'){
                    generaTabla('#linea'+element,'L'+element,0)
                }else if(element == '12'){
                    generaTabla('#linea'+element,element,0)
                }else{
                    generaTabla('#linea'+element,'0'+element,0)
                }
            });
            modal1.style.display = "none";
        })

        document.getElementById('aplicarFiltro').addEventListener('click',(e)=>{
            let lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
            let tiempo = document.getElementById('tiempo').value
            console.log(tiempo);
            lineas.forEach(element => {
                $('#linea'+element).DataTable().destroy()
                if(element=='A' || element =='B'){
                    generaTabla('#linea'+element,'L'+element,tiempo)
                }else if(element == '12'){
                    generaTabla('#linea'+element,element,tiempo)
                }else{
                    generaTabla('#linea'+element,'0'+element,tiempo)
                }
            });
            modal1.style.display = "none";
        })


    })

    function generaTabla(linea,idLinea,tiempo){
        new DataTable(linea, {
            responsive: true,
            autoWidth: false,
            language: {
                infoEmpty: 'No se han registrado Incidentes Relevantes durante el día',
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : idLinea,
                    tiempo : tiempo,
                },
            },
            columns: [
                { data: 'hora' },
                { data: 'descripcion' },
                { data: 'retardo' },
            ],
            paging: false,
            searching: false,
            ordering:  false,
            info: false,
            processing: true,
            serverSide: true    
        });

    }

    function cargarReloj(){
        let hoy = new Date()
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        const dias_semana = ['Domingo', 'Lunes', 'martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        let fecha = dias_semana[hoy.getDay()] + ', ' + hoy.getDate() + ' de ' + meses[hoy.getMonth()] + ' de ' + hoy.getUTCFullYear()
        document.getElementById('fechaHoy').innerHTML = fecha + ', '+hoy.toLocaleTimeString('en-US')
        setTimeout(cargarReloj, 500);
    }
