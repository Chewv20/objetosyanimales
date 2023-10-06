<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lineas;
use App\Models\Objeto;
use Illuminate\Support\Facades\DB;


class ObjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();
        

        return view('objetos',compact('lineas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::insert('insert into objetos (linea, fecha, estacion, retardo, corte_corriente, tipo_objeto) values (?, ?, ?, ?, ?, ?)', [$request->linea,$request->fecha,$request->estacion,$request->retardo,$request->corte_corriente,$request->tipo_objeto]);

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getReporte(Request $request)
    {
        $objetos = DB::table('objetos')
        ->where([
            ['linea',$request->linea],
            ['estacion',$request->estacion],
            ['retardo',$request->retardo],
            ['fecha',$request->fecha],
            ['corte_corriente',$request->corte_corriente],
            ['tipo_objeto',$request->tipo_objeto],
        ])
        ->orderBy('id')
        ->get();

        return $objetos;
    }

    public function get()
    {
        $objetos = Objeto::all();

        return datatables($objetos)->toJson();
    }
}
