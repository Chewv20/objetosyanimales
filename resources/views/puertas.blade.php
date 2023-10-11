@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Cierre de Puertas</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/puertas.css') }}" />

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
                        <form action="/puertas/" id='form-puertas' method="POST">
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
                                        <option value='0'>-- Seleccione una estación o terminal--</option>
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
                                    <x-adminlte-select name='puerta_opuesta' id="puerta_opuesta" label='Puerta Opuesta' >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-wrench"></i>
                                            </div>
                                        </x-slot>
                                        <option value="">-- Seleccione una opción --</option>
                                        <option value="SI">Si</option>
                                        <option value="NO">No</option>
                                    </x-adminlte-select>
                                </div>
                                
                                <div class="col-3">
                                    <x-adminlte-select name='desalojado' id="desalojado" label='Desalojado' >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                        </x-slot>
                                        <option value="">-- Seleccione una opción --</option>
                                        <option value="SI">Si</option>
                                        <option value="NO">No</option>
                                    </x-adminlte-select>
                                </div>

                                <div class="col-3">
                                    <x-adminlte-select name='asistencia_policia' id="asistencia_policia" label='Asistencia Policia' >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                        </x-slot>
                                        <option value="">-- Seleccione una opción --</option>
                                        <option value="SI">Si</option>
                                        <option value="NO">No</option>
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

                    <div class=" col-12">
                        <table class="table table-sm table-bordered" id="puertas">
                        <thead class="text-center">
                            <tr class="color-line line-objetos">
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Linea</th>
                                <th scope="col">Estacion / Terminal</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Puerta Opuesta</th>
                                <th scope="col">Desalojo</th>
                                <th scope="col">Asistencia Policia</th>
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
<script src="{{ URL::asset('js/puertas.js') }}"></script>

@stop