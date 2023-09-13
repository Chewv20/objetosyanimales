
const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    $(document).ready(function(){
        // Ventana modal
        var modal = document.getElementById("ventanaModal");
        var modal1 = document.getElementById("ventanaModal1");
        var modal2 = document.getElementById("ventanaModal2");


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

        document.getElementById("pdf").addEventListener("click",function() {
            modal2.style.display = "block";
        });

        document.getElementsByClassName("cerrar")[2].addEventListener("click",function() {
            modal2.style.display = "none";
        });

        window.addEventListener("click",function(event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
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
            crearTabla()
            

        })
        
        document.getElementById('oficio_f').addEventListener('change',(e)=>{
            var link = document.getElementById("link");
            let fecha = document.getElementById('fecha_2').value
            let url = '/eventos/pdf/'+fecha+'/'+e.target.value
            console.log(url);
            link.setAttribute('href', url);
        })

        document.getElementById('fecha_2').addEventListener('change',(e)=>{
            var link = document.getElementById("link");
            
            let oficio = document.getElementById('oficio_f').value
            let url = '/eventos/pdf/'+e.target.value+'/'+oficio
            console.log(url);
            link.setAttribute('href', url);
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

        let lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
        lineas.forEach(element => {
            
            if(element=='A' || element =='B'){
                generaTabla('#linea'+element,'L'+element)
            }else if(element == '12'){
                generaTabla('#linea'+element,element)
            }else{
                generaTabla('#linea'+element,'0'+element)
            }
        });
        
        document.getElementById('borrarFiltro').addEventListener('click',(e)=>{
            crearTabla()
            modal1.style.display = "none";
        })

        document.getElementById('aplicarFiltro').addEventListener('click',(e)=>{
            let lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
            let tiempo = parseInt(document.getElementById('tiempo').value)
            let filtro = $('#filtros').val()
            let filtros = []
            filtros.push(tiempo)
            if(document.querySelector('.form-check-input').checked){
                filtros.push('>')
            }else{
                filtros.push('<=')
            }
            filtro.forEach(element => {
                filtros.push(element)
            })
            lineas.forEach(element => {
                $('#linea'+element).DataTable().destroy()
                if(element=='A' || element =='B'){
                    generaTabla2('#linea'+element,'L'+element,filtros)
                }else if(element == '12'){
                    generaTabla2('#linea'+element,element,filtros)
                }else{
                    generaTabla2('#linea'+element,'0'+element,filtros)
                }
            });
            modal1.style.display = "none";
        })

        

        document.getElementById('submit').addEventListener('click',(e)=>{
            e.preventDefault()
            let resultado = validar();
            
            if(!resultado){                
                compruebaRep()
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Revisa los campos',
                    text: 'Revisa que todos los campos sean correctos'
                })
            }
        })

        document.getElementById('vueltas_l').addEventListener('change',(e)=>{
            if(e.target.value != ''){
                document.getElementById('vueltas_R').readOnly= true
            }else{
                document.getElementById('vueltas_R').readOnly= false
            }
        })

        document.getElementById('vueltas_R').addEventListener('change',(e)=>{
            if(e.target.value != ''){
                document.getElementById('vueltas_l').readOnly= true
            }else{
                document.getElementById('vueltas_l').readOnly= false
            }
        })

    })

    function validar(){
        let error = false;

        let inputsrequeridos = document.querySelectorAll('#form-evento [required]')  
        for(let i=0;i<inputsrequeridos.length;i++){
            if(inputsrequeridos[i].value =='' ){
                inputsrequeridos[i].style.borderColor = '#FF0400'
                error = true
            }else{
                inputsrequeridos[i].style.removeProperty('border');
            }
        }

        return error;
    }

    function compruebaRep(){
        let Pfecha = document.getElementById('fecha_f').value
        let Phora = document.getElementById('hora_l').value
        let Plinea = document.getElementById('linea').value
        let Plarin = document.getElementById('larin').value

        
        fetch('/eventos/getReporte/',{
            method : 'POST',
            body: JSON.stringify({
                fecha : Pfecha,
                hora  : Phora,
                linea : Plinea,
                larin : Plarin,       
            }),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response=>{
            return response.json()
        }).then( data=>{      
            if(data[0]){            
                Swal.fire(
                    {icon: 'error',
                    title: 'Se intenta guardar un reporte existente',
                    text: data[0].id}
                )
                console.log(data[0].id);
            }else{
                guardar();
            }
        }).catch(error => console.error(error));
    }

    function generaTabla(linea,idLinea){
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

    function generaTabla2(linea,idLinea,filtros){

        new DataTable(linea, {
            responsive: true,
            autoWidth: false,
            language: {
                infoEmpty: 'No se han registrado Incidentes Relevantes durante el día',
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLineaF",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : idLinea,
                    tiempo : filtros[0],
                    vueltas : filtros[1],
                    desc1 : filtros[2],
                    desc2 : filtros[3],
                    desc3 : filtros[4],
                    desc4 : filtros[5],
                    desc5 : filtros[6],
                    desc6 : filtros[7],
                    desc7 : filtros[8],
                    desc8 : filtros[9],
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


    function guardar(){
        let Pfecha   = document.getElementById('fecha_f').value
        let Plinea   = document.getElementById('linea').value
        let Phora    = document.getElementById('hora_l').value
        let Plarin   = document.getElementById('larin').value
        let Pdescripcion = document.getElementById('descripcion').value
        let Pretardo = document.getElementById('retardo_l').value
        let Pvueltas = document.getElementById('vueltas_l').value        
        let Pusuario = document.getElementById('usuario').value
        let PvueltasR = document.getElementById('vueltas_R').value
        fetch('/eventos/',{
                method : 'POST',
                body: JSON.stringify({
                    fecha   : Pfecha,  
                    linea   : Plinea,  
                    hora    : Phora,   
                    larin   : Plarin,
                    descripcion : Pdescripcion,  
                    retardo : Pretardo,
                    vueltas : Pvueltas,
                    usuario : Pusuario,
                    vueltasR : PvueltasR
                }),
                headers:{
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response=>{
                return response.json()
            }).then( data=>{
                if(data.success){
                    Swal.fire(
                        {icon: 'success',
                        title: 'Reporte guardado con éxito',
                        text: data.id}
                    )
                    limpiar() 
                }
                console.log(data);
            }).catch(error => console.error(error));

        return true

    }


    function limpiar(){
        document.getElementById('linea').value = "" 
        document.getElementById('hora_l').value = ""
        document.getElementById('vueltas_l').value = ""
        document.getElementById('retardo_l').value = ""
        document.getElementById('descripcion').value = ""
        document.getElementById('larin').value = '0'
        document.getElementById('vueltas_R').value = ""
        document.getElementById('vueltas_l').readOnly= false
        document.getElementById('vueltas_R').readOnly= false
        $('#larin').trigger('change');
        crearTabla()
    }

    function crearTabla(){
        let lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
        
            lineas.forEach(element => {
                $('#linea'+element).DataTable().destroy()
                if(element=='A' || element =='B'){
                    generaTabla('#linea'+element,'L'+element)
                }else if(element == '12'){
                    generaTabla('#linea'+element,element)
                }else{
                    generaTabla('#linea'+element,'0'+element)
                }
            });
    }