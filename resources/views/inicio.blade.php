@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />



@section('content_header')
    <h1 class="m-0 text-dark">Estadísticas</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/estadisticas.css') }}" />
@stop

@section('content')
    @php
        $hoy = date("Y-m-d");
    @endphp

    <div>
        <div class="row">
            <div class="col-2">
                
                <input id="fecha" type="date" class="form-control" min="1991-01-01" max="<?php echo $hoy;?>">
            </div>
            <div class="col-2">
                
                <input id="fecha2" type="date" class="form-control" min="1991-01-01" max="<?php echo $hoy;?>">
            </div>
            <div class="col-2">
                <button type="button" id="filtro" class="btn btn-outline-success" >Aplicar Filtro</button>
            </div>
        </div>
    </div>

    

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card bg-gray"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fas fa-folder'>Total</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='total' ></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'> Objetos en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numObjetos' ></p>
                                    <a href="/objeto"><button type="button" class="btn btn-success">Registrar</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-purple"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fas fa-paw'>Animales en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numAnimales' ></p>
                                    <a href="/animales" style="color: white"><button type="button" class="btn btn-purple">Registrar</button></a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-red"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-male'>Arrollados y Accidentados</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numAccidentados' ></p>
                                    <a href="/accidentados"><button type="button" class="btn btn-danger">Registrar</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card bg-cyan"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fas fa-user-alt-slash'>Personas Ajenas en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numPersonasAjenas' ></p>
                                    <a href="/personasajenas" ><button type="button" class="btn btn-info">Registrar</button></a>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-yellow"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fas fa-exclamation-triangle'>Incidentes Relevantes</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numIncidentes' ></p>
                                    <a href="/incidentesrelevantes"><button type="button" class="btn btn-warning">Registrar</button></a>

                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card bg-orange"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fas fa-door-open'>Cierre de Puertas</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numPuertas' ></p>
                                    <a href="/puertas"><button type="button" class="btn btn-orange">Registrar</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-dark"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fas fa-wind'>Zapatas</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numZapatas' ></p>
                                    <a href="/zapatas"><button type="button" class="btn btn-dark">Registrar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="map">   
                    </div>    
                    
                </div>
            </div>
            
        </div>
    </div>
    
@stop

@section('js')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
<script src="{{ URL::asset('js/estadisticas.js') }}"></script>

@stop
