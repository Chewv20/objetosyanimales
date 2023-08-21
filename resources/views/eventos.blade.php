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
                                                       
                            <form action="" id='form-evento'>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">

                                                <div class="row">
                                                    <div class="col">
                                                        <x-adminlte-select name="linea" id="linea" required>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
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
                                                           <input type="text" class="form-control" aria-label="Default" aria-describedby="vue-perdidas" name="vperdidas" required>
                                                        </div>
                                                     </div>
                                                </div>
                                                <br><br>

                                                <div class="row"> 
                                                    <div class="col" style="text-align: center">
                                                        <x-adminlte-button id="submit" class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>
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

        // Botón que abre el modal
        var boton = document.getElementById("abrirModal");

        // Hace referencia al elemento <span> que tiene la X que cierra la ventana
        var span = document.getElementsByClassName("cerrar")[0];

        // Cuando el usuario hace click en el botón, se abre la ventana
        boton.addEventListener("click",function() {
            modal.style.display = "block";
        });

        // Si el usuario hace click en la x, la ventana se cierra
        span.addEventListener("click",function() {
            modal.style.display = "none";
        });

        // Si el usuario hace click fuera de la ventana, se cierra.
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
                console.log(respuesta);
            }).catch(error => console.error(error));
        });
    })

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