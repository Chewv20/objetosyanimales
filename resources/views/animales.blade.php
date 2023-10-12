@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Animales en Vías</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/animales.css') }}" />

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
                        <form action="/animales/" id='form-animales' method="POST">
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
                                    <x-adminlte-select name='status' id="status" label='Status' >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-paw"></i>
                                            </div>
                                        </x-slot>
                                        <option value="Muerto">Muerto</option>
                                        <option value="Vivo" selected>Vivo</option>
                                    </x-adminlte-select>
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
                    <div class=" col-12">
                        <table class="table table-sm table-bordered" id="animalesVias">
                        <thead class="text-center">
                            <tr class="color-line line-objetos">
                                <th scope="col">Fecha</th>
                                <th scope="col">Linea</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Status</th>
                                <th scope="col">Retardo</th>
                                <th scope="col">Acciones</th>
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

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="{{ URL::asset('js/animales.js') }}"></script>

@stop