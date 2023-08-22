@extends('adminlte::page')

@section('title', 'Informe Diario de Operación')

@section('content_header')
    <h1 class="m-0 text-dark">Informe Diario de Operación</h1>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* Fondo modal: negro con opacidad al 50% */
        .modal {
        display: none; /* Por defecto, estará oculto */
        position: fixed; /* Posición fija */
        z-index: 1; /* Se situará por encima de otros elementos de la página*/
        padding-top: 150px; /* El contenido estará situado a 200px de la parte superior */
        left: 35px;
        top: 0;
        width: 100%; /* Ancho completo */
        height: 100%; /* Algura completa */
        overflow: auto; /* Se activará el scroll si es necesario */
        background-color: rgba(0,0,0,0.5); /* Color negro con opacidad del 50% */
        }

        /* Ventana o caja modal */
        .contenido-modal {
        position: relative; /* Relativo con respecto al contenedor -modal- */
        background-color: white;
        margin: auto; /* Centrada */
        padding: 10px;
        width: 80%;
        -webkit-animation-name: animarsuperior;
        -webkit-animation-duration: 0.5s;
        animation-name: animarsuperior;
        animation-duration: 0.5s
        }

        /* Animación */
        @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
        }

        @keyframes animarsuperior {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
        }

        /* Botón cerrar */
        .cerrar {
        color: black;
        float: right;
        font-size: 30px;
        font-weight: bold;
        }

        .cerrar:hover,
        .cerrar:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
        .color-line.line-1, .color-line.line-01  { background: #f04e98; }
        .color-line.line-2, .color-line.line-02  { background: #005eb8; }
        .color-line.line-3, .color-line.line-03  { background: #af9800; }
        .color-line.line-4, .color-line.line-04  { background: #6bbbae; }
        .color-line.line-5, .color-line.line-05  { background: #ffd100; }
        .color-line.line-6, .color-line.line-06  { background: #da291c; }
        .color-line.line-7, .color-line.line-07  { background: #e87722; }
        .color-line.line-8, .color-line.line-08  { background: #009a44; }
        .color-line.line-9, .color-line.line-09  { background: #512f2e; }
        .color-line.line-12 { background: #c09b57; }
        .color-line.line-A, .color-line.line-LA  { background: #981d97; }
        .color-line.line-B, .color-line.line-LB  { background: -webkit-linear-gradient(bottom,  #00843d 0%,#00843d 50%,#b1b3b3 50%,#b1b3b3 100%);}
        .color-line.line-B.diagonal  { background: linear-gradient(to bottom left, #b1b3b3 50% ,#00843d 50%);}
    </style>
@stop

@php
    $hoy = date("Y-m-d");
@endphp

@section('content')

    <p id='fechaHoy'></p>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="col-8 col-md-5 ">
                        <div class="input-group input-group-sm mb-3">
                           <div class="input-group-prepend d-none d-md-block">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Ver IDO del día</span>
                           </div>
                           <div class="input-group-prepend d-md-none">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Ver Día</span>
                           </div>
                           <input type="date" id="fecha" class="form-control" name="fecha_inicial" value="<?php echo $hoy;?>" min="2020-11-04" max="<?php echo $hoy;?>">
                        </div>
                    </div>
                    
                   <button type="button" id="abrirModal" class="btn btn-outline-success"><span class="fa fa-plus"></span> Registrar evento</button>
                    
                   
                    <div id="ventanaModal" class="modal">
                        <div class="contenido-modal">
                            <span class="cerrar">&times;</span>
                                                       
                            <form action="/eventos/" id='form-evento' method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">

                                                <div class="row">
                                                    <div class="col">
                                                        <x-adminlte-select name="linea" id="linea" required>
                                                            <option value>-- Seleccione una linea --</option>
                                                            @foreach ($lineas as $item)
                                                                <option value="{{ $item -> id_linea }}">{{ $item -> linea }}</option>
                                                            @endforeach
                                                        </x-adminlte-select>                                                        
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                               <span class="input-group-text" id="hora">Hora:</span>
                                                            </div>  
                                                            <input type="time" class="form-control" aria-label="Hora" aria-describedby="hora-evento" name="hora" required>
                                                         </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <x-adminlte-select2 style="width: 50%" name="larin" id="larin" label="Larin" required>
                                                            <option value>-- Seleccione un larin --</option>
                                                            @foreach ($larines as $item)
                                                                <option value="{{ $item -> clave_larin }}">{{ $item -> clave_larin }} --- {{ $item -> descripcion_corta_larin }}</option>
                                                            @endforeach
                                                        </x-adminlte-select2>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                           <div class="input-group-prepend">
                                                              <span class="input-group-text" id="retardo">Minutos retardo</span>
                                                           </div>
                                                           <input type="text" class="form-control" aria-label="Default" aria-describedby="min-retardo" name="retardo" required>
                                                        </div>
                                                     </div>
                                                     <div class="col">
                                                        <div class="input-group input-group-sm mt-1 mt-md-0">
                                                           <div class="input-group-prepend">
                                                              <span class="input-group-text" id="vueltas">Vueltas perdidas</span>
                                                           </div>
                                                           <input type="text" class="form-control" aria-label="Default" aria-describedby="vue-perdidas" name="vueltas" required>
                                                        </div>
                                                     </div>
                                                </div>
                                                <br><br>

                                                <div class="row"> 
                                                    <div class="col" style="text-align: center">
                                                        <x-adminlte-button id="submit" class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>
                                                    </div>
                                                </div>

                                                <div class="row"> 
                                                    <div class="col" style="text-align: center">
                                                        <input type="date" id="fecha_f" class="form-control" name="fecha" value="<?php echo $hoy;?>" min="<?php echo $hoy;?>" max="<?php echo $hoy;?>" hidden>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <x-adminlte-textarea name="descripcion" id="descripcion" rows="15" style="resize: none;" placeholder="Descripcion del evento" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                        $lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
                        foreach( $lineas as $linea){ ?>

                        <!-- Inician las tablas de los eventos cada una de las lineas -->
                        <div class="col-12 blk_eventos_L<?php echo $linea; ?>">
                            <h5 class="mb-0">Línea <?php echo $linea; ?></h5>
                            <p >Incidentes de Operación en Línea</p>
                        </div>

                        <div class=" col-12 table-responsive tbl_eventos_L<?php echo $linea; ?>">
                            <table class="table table-sm table-bordered" id="linea<?php echo $linea; ?>">
                            <thead class="text-center">
                                <tr class="color-line line-<?php echo $linea; ?>">
                                    <th scope="col">Hora</th>
                                    <th scope="col" class="w-75">Descripción</th>
                                    <th scope="col">Retardo</th>
                                </tr>
                            </thead>
                            </table>
                        </div>

                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    $(document).ready(function(){
        // Ventana modal
        var modal = document.getElementById("ventanaModal");

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
            $('#linea1').DataTable().destroy();
            generaTabla1()
            $('#linea2').DataTable().destroy();
            generaTabla2()
            $('#linea3').DataTable().destroy();
            generaTabla3()
            $('#linea4').DataTable().destroy();
            generaTabla4()
            $('#linea5').DataTable().destroy();
            generaTabla5()
            $('#linea6').DataTable().destroy();
            generaTabla6()
            $('#linea7').DataTable().destroy();
            generaTabla7()
            $('#linea8').DataTable().destroy();
            generaTabla8()
            $('#linea9').DataTable().destroy();
            generaTabla9()
            $('#lineaA').DataTable().destroy();
            generaTablaA()
            $('#lineaB').DataTable().destroy();
            generaTablaB()
            $('#linea12').DataTable().destroy();
            generaTabla12()
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

        generaTabla1()
        generaTabla2()
        generaTabla3()
        generaTabla4()
        generaTabla5()
        generaTabla6()
        generaTabla7()
        generaTabla8()
        generaTabla9()
        generaTablaA()
        generaTablaB()
        generaTabla12()


    })

    function generaTabla1(){
        new DataTable('#linea1', {
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
                    linea : '01',
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

    function generaTabla2(){
        new DataTable('#linea2', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '02',
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
            info: false         
        });

    }

    function generaTabla3(){
        new DataTable('#linea3', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '03',
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
            info: false         
        });

    }

    function generaTabla4(){
        new DataTable('#linea4', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '04',
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
            info: false         
        });

    }

    function generaTabla5(){
        new DataTable('#linea5', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '05',
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
            info: false         
        });

    }

    function generaTabla6(){
        new DataTable('#linea6', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '06',
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
            info: false         
        });

    }

    function generaTabla7(){
        new DataTable('#linea7', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '07',
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
            info: false         
        });

    }

    function generaTabla8(){
        new DataTable('#linea8', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '08',
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
            info: false         
        });

    }

    function generaTabla9(){
        new DataTable('#linea9', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '09',
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
            info: false         
        });

    }

    function generaTablaA(){
        new DataTable('#lineaA', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : 'LA',
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
            info: false         
        });

    }

    function generaTablaB(){
        new DataTable('#lineaB', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : 'LB',
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
            info: false         
        });

    }

    function generaTabla12(){
        new DataTable('#linea12', {
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
            },
            ajax : {
                method : "POST",
                url : "/eventos/getLinea",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : { 
                    fecha : document.getElementById('fecha').value,
                    linea : '12',
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
            info: false         
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


</script>
@stop