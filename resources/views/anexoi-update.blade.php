@extends('adminlte::page')

@section('title', 'Anexo I')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Actualizar evento Anexo I</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/eventos.css') }}" />
@stop

@php
    $hoy = date("Y-m-d");
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class=" col-12 table-responsive tbl_anexoi">
                        @foreach ($evento as $item)
                        <form action="{{ route('eventos.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <div class="row">
                                <div class="col">
                                    <x-adminlte-select name="linea" id="linea" required>
                                        <option value>-- Seleccione una linea --</option>
                                        @foreach ($linea as $item2)
                                            <option value="{{ $item2 -> id_linea }}" @if ($item2->id_linea==$item->linea) selected @endif>{{ $item2 -> linea }}</option>
                                        @endforeach
                                    </x-adminlte-select>                                                        
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text" id="hora">Hora:</span>
                                        </div>  
                                        <input type="time" id="hora_l" class="form-control" aria-label="Hora" aria-describedby="hora-evento" name="hora" value="{{ $item->hora }}" required>
                                     </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <x-adminlte-select2 style="width: 50%" name="larin" id="larin" label="Larin" required>
                                        <option value='0'>-- Seleccione un larin --</option>
                                        @foreach ($larin as $item3)
                                            <option value="{{ $item3 -> clave_larin }}" @if ($item3->clave_larin==$item->larin) selected @endif>{{ $item3 -> clave_larin }} --- {{ $item3 -> descripcion_corta_larin }}</option>
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
                                       <input type="number" class="form-control" id='retardo_l' aria-label="Default" aria-describedby="min-retardo" name="retardo" value="{{ $item->retardo }}" required>
                                    </div>
                                 </div>
                                 <div class="col">
                                    <div class="input-group input-group-sm mt-1 mt-md-0">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text" id="vueltas">Vueltas perdidas</span>
                                       </div>
                                       <input type="number" id="vueltas_l" class="form-control" aria-label="Default" aria-describedby="vue-perdidas" name="vueltas" value="{{ $item->vueltas }}">
                                    </div>
                                 </div>
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="col">
                                    <div class="input-group input-group-sm mt-1 mt-md-0">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text" id="vueltasProgramadas">Vueltas Realizadas</span>
                                       </div>
                                       <input type="number" id="vueltas_R" class="form-control" aria-label="Default" aria-describedby="vue-perdidas" name="vueltas_realizadas" value="{{ $item->vueltas_realizadas }}">
                                    </div>
                                </div>
                                <div class="col-8 col-md-5 ">
                                    <div class="input-group input-group-sm mb-3">
                                       <div class="input-group-prepend d-none d-md-block">
                                          <span class="input-group-text" id="inputGroup-sizing-sm">Fecha:</span>
                                       </div>
                                       <input type="date" id="fecha" class="form-control" name="fecha" value="{{ $item->fecha }}" min="2020-11-04" max="<?php echo $hoy;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col" style="text-align: center">
                                    <input type="text" id="usuario" class="form-control" name="usuario" value="{{ auth()->user()->username }}" hidden>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <x-adminlte-textarea name="descripcion" id="descripcion" rows="15" style="resize: none;" placeholder="Descripcion del evento" required>
                                        {{ $item->descripcion }}
                                    </x-adminlte-textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <x-adminlte-button type="submit" label="Enviar" theme="primary" icon="fas fa-save"/>
                            </div>
                        </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

<script src="{{ URL::asset('js/anexoi.js') }}"></script>

@stop