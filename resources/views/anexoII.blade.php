@extends('adminlte::page')

@section('title', 'Informe Diario de Operación')

@section('content_header')
    <h1 class="m-0 text-dark">Incidentes Registrados en las Estaciones</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/anexoii.css') }}" />
    <link rel="icon" href="{{ URL::asset('img/logo.png') }}" />
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
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col">
                                <button type="button" id="abrirModal" class="btn btn-outline-success"><span class="fa fa-plus"></span> Registrar incidente</button>
                            </div>
                            <button type="button" id="abrirFiltro" class="btn btn-outline-success float-left" ><span class="fa fa-plus"></span> Filtro</button>
                        </div>
                    </div>   
                    
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
                                                            <input type="time" id="hora_l" class="form-control" aria-label="Hora" aria-describedby="hora-evento" name="hora" required>
                                                         </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <x-adminlte-select2 style="width: 50%" name="larin" id="larin" label="Larin" required>
                                                            <option value='0'>-- Seleccione un larin --</option>
                                                            @foreach ($larines as $item)
                                                                <option value="{{ $item -> clave_larin }}">{{ $item -> clave_larin }} --- {{ $item -> descripcion_corta_larin }}</option>
                                                            @endforeach
                                                        </x-adminlte-select2>
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
                                                <div class="row"> 
                                                    <div class="col" style="text-align: center">
                                                        <input type="text" id="usuario" class="form-control" name="usuario" value="{{ auth()->user()->username }}" hidden>
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

                    <div id="ventanaModal1" class="modal">
                        <div class="contenido-modal">
                            <span class="cerrar">&times;</span>
                                                       
                            <form id='form-filtro' method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        @php
                                            $config = [
                                                "placeholder" => "Selecciona los filtros de busqueda",
                                                "allowClear" => true,
                                            ];
                                        @endphp
                                        <x-adminlte-select2 id="filtros" name="sel2Category[]" label="Filtros"
                                            igroup-size="sm" :config="$config" multiple placeholder="Selecciona">
                                            <option value="puertas">Apertura de puertas</option>
                                            <option value="arrolla">Arrollado</option>
                                            <option value='traspaso'>Traspaso de Batería</option>
                                            <option value='neumati'>Neumatico Ponchado</option>
                                            <option value="tren evacuado">Tren evacuado</option>
                                            <option value="carro evacuado">Carro Evacuado</option>
                                            <option value="motriz inactiva">Motriz inactiva</option>
                                            <option value="espejo de agua">Espejo de Agua</option>
                                        </x-adminlte-select2>

                                         <x-adminlte-button id="aplicarFiltro" class="btn-flat" label="Aplicar Filtros" theme="success" icon="fas fa-lg fa-save"/>
                                         <x-adminlte-button id="borrarFiltro" class="btn-flat" label="Borrar Filtros" theme="danger" icon="fa fa-trash"/>
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
                            <p >Incidentes registrados en las estaciones de Línea</p>
                        </div>

                        <div class=" col-12 table-responsive tbl_eventos_L<?php echo $linea; ?>">
                            <table class="table table-sm table-bordered" id="linea<?php echo $linea; ?>">
                            <thead class="text-center">
                                <tr class="color-line line-<?php echo $linea; ?>">
                                    <th scope="col" class="col-1">Hora</th>
                                    <th scope="col" class="w-75">Descripción</th>
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
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script src="{{ URL::asset('js/anexoii.js') }}"></script>

@stop