@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Zapatas</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/zapatas.css') }}" />

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
                        <form action="/zapatas/" id='form-zapatas' method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" id="fecha" class="form-control" name="fecha"  min="1992-03-18" max="<?php echo $hoy;?>">
                                    
                                </div>
                                <div class="col">
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
                                
                                <div class="col">
                                    <label for="hora">Hora</label>
                                    <input type="time" name="hora" class="form-control" id="hora" required>
                                </div>

                                <div class="col">
                                    <x-adminlte-select name='humo' id="humo" label='Humo' >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-cloud"></i>
                                            </div>
                                        </x-slot>
                                        <option value="">-- Seleccione una opción --</option>
                                        <option value="SI">Si</option>
                                        <option value="NO">No</option>
                                    </x-adminlte-select>
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
                                    data-index="2"
                                    >
                            
                            </div>
                            <div style="width: 20%" class="form-floating mx-1">
                                <input 
                                    type="text" 
                                    id="descripcionFiltro"
                                    class="form-control"
                                    placeholder="Busqueda en la Descripcion" 
                                    data-index="3"
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
                        <table class="table table-sm table-bordered" id="zapatas">
                            <thead class="text-center">
                                <tr class="color-line line-objetos">
                                    <th scope="col" style="text-align: center">Fecha</th>
                                    <th scope="col" style="text-align: center">Hora</th>
                                    <th scope="col" style="text-align: center">Linea</th>
                                    <th scope="col" style="text-align: center">Descripción</th>
                                    <th scope="col" style="text-align: center">Humo</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <thead class="text-center">
                                <tr class="color-line line-objetos">
                                    <th scope="col" >Fecha</th>
                                    <th scope="col" >Hora</th>
                                    <th scope="col" >Linea</th>
                                    <th scope="col" >Descripción</th>
                                    <th scope="col" >Humo</th>
                                    <th scope="col" >Acciones</th>
                                </tr>
                            </thead>
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
<script src="{{ URL::asset('js/zapatas.js') }}"></script>

@stop