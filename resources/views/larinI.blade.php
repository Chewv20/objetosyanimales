@extends('adminlte::page')

@section('title', 'Anexo I')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Anexo I </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="/larinI/create"><x-adminlte-button label="Agregar Larin" theme="success" icon="fa fa-plus"/></a>
                    <div class=" col-12 table-responsive tbl_anexoi">
                        <x-adminlte-datatable id="table1" :heads="$heads" head-theme='dark' scrollable hoverable with-footer beautify bordered footer-theme='dark' >
                            @forelse ($larinI as $item)
                                <tr>
                                        <th>{{ $item -> id }}</th>
                                        <th>{{ $item -> tipo_larin }}</th>
                                        <th>{{ $item -> clave_larin }}</th>
                                        <th>{{ $item -> descripcion_corta_larin }}</th>
                                        <th>{{ $item -> larin }}</th>
                                        <th>
                                            <a href="/larinI/{{ $item->clave_larin }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a>
                                            <form action="{{ route('larinI.destroy', $item->clave_larin) }}" method="post">
                                                <input class="btn btn-danger" type="submit" value="Eliminar" />
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </th>
                                </tr>
                            @empty
                                <tr>Sin larines</tr>
                            @endforelse
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop