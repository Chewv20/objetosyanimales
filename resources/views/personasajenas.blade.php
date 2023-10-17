@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Personas Ajenas en Vías</aside></h1>
    <link rel="stylesheet" href="{{ URL::asset('css/personasajenas.css') }}" />

@stop

@php
    $hoy = date("Y-m-d");
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-modal id="formRegistro" title="Registrar incidente" size="xl" theme="success"
                        icon="fas fa-edit" v-centered scrollable>
                        <form action="/personasajenas/" id='form-personasajenas' method="POST">
                            @csrf
                            <div class="row">
                                <div>
                                    <label for="fecha">Fecha</label>
                                    <input type="date" id="fecha" class="form-control" name="fecha"  min="1992-03-18" max="<?php echo $hoy;?>">
                                    
                                </div>
                                <div class="col-md-3">
                                    <x-adminlte-select name='linea' id='selLinea' label='Línea' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-subway"></i>
                                            </div>
                                        </x-slot>
                                        <option value='0'>-- Seleccione una línea --</option>
                                        @foreach ($lineas as $linea)
                                            <option value="{{ $linea->id_linea }}">{{ $linea->linea }}</option>
                                        @endforeach
                                    </x-adminlte-select>  
                                </div>
                                <div class="col-md-4">
                                    <x-adminlte-select name='estacion' id='selEstacion' label='Estación' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-dot-circle"></i>
                                            </div>
                                        </x-slot>
                                        <option value='0'>-- Seleccione una estación --</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col">
                                    <label for="hora">Hora</label>
                                    <input type="time" name="hora" class="form-control" id="hora" required>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <x-adminlte-textarea name='descripcion' id="descripcion" label='Descripción' rows="5" placeholder='Ingresa la descripción' style="resize: none;" required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fa fa-archive"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-textarea>
                                </div>
                            </div>    
                            
                            <div class="row">
                                <div class="col-3">
                                    <x-adminlte-input name="retardo" id="retardo" label="Retardo" placeholder="Ingresa el retardo" type="number" min=0 required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col">
                                    <x-adminlte-select name='genero' id="genero" label='Genero' >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-male"></i>
                                            </div>
                                        </x-slot>
                                        <option value="" selected>-- Seleccione un genero --</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </x-adminlte-select>
                                </div>

                                <div class="col-3">
                                    <x-adminlte-input name="edad" id="edad" label="Edad" placeholder="Ingresa la edad" type="number" min=0 required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                            </div>
                            <input type="text" id='usuario' value="{{ auth()->user()->username }}" hidden>
                            
                            
                            <div class="center">
                                <x-adminlte-button id="submit" class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>
                            </div>
                        </form>
                    </x-adminlte-modal>
                    <x-adminlte-button label="Registrar incidente" data-toggle="modal" theme="success" icon="fas fa-plus" data-target="#formRegistro"/>

                    <br><br>
                    <div class="row">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 20%" class="form-floating mx-1">
                                <input 
                                    type="text" 
                                    id="lineaFiltro"
                                    class="form-control"
                                    placeholder="Busqueda en la Línea" 
                                    data-index="1"
                                    >
                            
                            </div>
                            <div style="width: 20%" class="form-floating mx-1">
                                <input 
                                    type="text" 
                                    id="descripcionFiltro"
                                    class="form-control"
                                    placeholder="Busqueda en la Descripcion" 
                                    data-index="4"
                                    >
                            </div>
                            <div style="width: 20%" class="form-floating mx-1">
                                <input 
                                    type="date" 
                                    id="fechaDesde"
                                    class="form-control" 
                                    max="{{ $hoy }}">
                            </div>
                            <div style="width: 20%" class="form-floating mx-1">
                                <input 
                                    type="date" 
                                    id="fechaHasta"
                                    class="form-control"
                                    max="{{ $hoy }}">
                            </div>
                            <div style="width: 20%" class="form-floating mx-1">
                                <button class="btn btn-outline-success" id="filtroFecha">
                                    Aplicar Filtro Fecha
                                </button>
                            </div>
                            <div style="width: 20%" class="form-floating mx-1">
                                <button class="btn btn-outline-danger" id="borrarFecha">
                                    Borrar Filtro Fecha
                                </button>
                            </div>
                            
                        </div>
                        
                    </div>

                    <br><br>
                    <div class=" col-12">
                        <table class="table table-sm table-bordered" id="personasAjenasVias">
                            <thead class="text-center">
                                <tr class="color-line line-objetos">
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Linea</th>
                                    <th style="text-align: center">Hora</th>
                                    <th style="text-align: center">Ubicación</th>
                                    <th style="text-align: center">Descripción</th>
                                    <th style="text-align: center">Genero</th>
                                    <th style="text-align: center">Edad</th>
                                    <th style="text-align: center">Retardo</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr class="color-line line-objetos">
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Linea</th>
                                    <th style="text-align: center">Hora</th>
                                    <th style="text-align: center">Ubicación</th>
                                    <th style="text-align: center">Descripción</th>
                                    <th style="text-align: center">Genero</th>
                                    <th style="text-align: center">Edad</th>
                                    <th style="text-align: center">Retardo</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </tfoot>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.css" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/keytable/2.10.0/css/keyTable.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/keytable/2.10.0/js/dataTables.keyTable.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/searchbuilder/1.6.0/js/dataTables.searchBuilder.js"></script>
<script src="https://cdn.datatables.net/searchbuilder/1.6.0/js/searchBuilder.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.js"></script>
<script src="{{ URL::asset('js/personasajenas.js') }}"></script>

@stop