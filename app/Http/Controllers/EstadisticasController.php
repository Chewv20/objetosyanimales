<?php

namespace App\Http\Controllers;

use App\Models\Accidentados;
use App\Models\Animales;
use App\Models\Incidentesrelevantes;
use App\Models\Objeto;
use App\Models\Personasajenas;
use App\Models\Puertas;
use App\Models\Zapatas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EstadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objetos = Objeto::all();
        $numObjetos = count($objetos);
        return view('inicio',compact('numObjetos'));
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
        //
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

    public function getCount(Request $request){
        $objetos = DB::table('objetos')
        ->whereDate('fecha','>=',$request->fecha,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();

        $animales = DB::table('animales')
        ->whereDate('fecha','>=',$request->fecha,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();

        $accidentados = DB::table('accidentados')
        ->whereDate('fecha','>=',$request->fecha,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();

        $personasajenas = DB::table('personasajenas')
        ->whereDate('fecha','>=',$request->fecha,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();

        $incidentesrelevantes = DB::table('incidentesrelevantes')
        ->whereDate('fecha','>=',$request->fecha,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();

        $puertas = DB::table('puertas')
        ->whereDate('fecha','>=',$request->fecha,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();
        
        $zapatas = DB::table('zapatas')
        ->whereDate('fecha','>=',$request->fecha,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();

        $cuentas = [];

        $cuentas[0] = count($objetos);
        $cuentas[1] = count($animales);
        $cuentas[2] = count($accidentados);
        $cuentas[3] = count($personasajenas);
        $cuentas[4] = count($incidentesrelevantes);
        $cuentas[5] = count($puertas);
        $cuentas[6] = count($zapatas);
        $cuentas[7] = count($objetos)+count($animales)+count($accidentados)+count($personasajenas)+count($incidentesrelevantes)+count($puertas)+count($zapatas);

        

        return $cuentas;

    }

    public function getAll(){
        $objetos = Objeto::all();
        $animales = Animales::all();
        $accidentados = Accidentados::all();
        $personasajenas = Personasajenas::all();
        $incidentesrelevantes = Incidentesrelevantes::all();
        $puertas = Puertas::all();
        $zapatas = Zapatas::all();

        $numobjetos = count($objetos);
        $numanimales = count($animales);
        $numaccidentados = count($accidentados);
        $numpersonasajenas = count($personasajenas);
        $numincidentesrelevantes = count($incidentesrelevantes);
        $numpuertas =count($puertas);
        $numzapatas = count($zapatas);
        $numtotal = $numobjetos+$numanimales+$numaccidentados+$numpersonasajenas+$numincidentesrelevantes+$numpuertas+$numzapatas;

        $total = [];

        array_push($total,$numobjetos,$numanimales,$numaccidentados,$numpersonasajenas,$numincidentesrelevantes,$numpuertas,$numzapatas,$numtotal);

        return $total;
    }
}
