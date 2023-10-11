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
                
                <input id="fecha" type="date" class="form-control" value="<?php echo $hoy;?>" min="1992-03-18" max="<?php echo $hoy;?>">
            </div>
            <div class="col-2">
                
                <input id="fecha2" type="date" class="form-control" value="<?php echo $hoy;?>" min="1992-03-18" max="<?php echo $hoy;?>">
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
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'> Objetos en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numObjetos' ></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'>Animales en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numAnimales' ></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'>Arrollados y Accidentados</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numAccidentados' ></p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'>Personas Ajenas en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numPersonasAjenas' ></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'>Incidentes Relevantes</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numIncidentes' ></p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'>Cierre de Puertas</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numPuertas' ></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'>Zapatas</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numZapatas' ></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="{{ URL::asset('js/estadisticas.js') }}"></script>

@stop
