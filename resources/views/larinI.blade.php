@extends('adminlte::page')

@section('title', 'Modulos Anexo I')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Anexo I </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class=" col-12 table-responsive tbl_anexoi">
                        <table class="table table-sm table-bordered" id="anexoi">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Tipo de Larin</th>
                                <th scope="col">Clave Larin</th>
                                <th scope="col">Descripcion Corta del Larin</th>
                                <th scope="col">Descripcion del Larin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($larinI as $item)
                                <tr>
                                    <td>{{ $item -> tipo_larin }}</td>
                                    <td>{{ $item -> clave_larin }}</td>
                                    <td>{{ $item -> descripcion_corta_larin }}</td>
                                    <td>{{ $item -> larin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

<script src="{{ URL::asset('js/larinI.js') }}"></script>

@stop