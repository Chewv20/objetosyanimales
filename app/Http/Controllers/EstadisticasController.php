<?php

namespace App\Http\Controllers;

use App\Models\Accidentados;
use App\Models\Animales;
use App\Models\Arrollados;
use App\Models\Cables;
use App\Models\Estaciones;
use App\Models\Estacionessi;
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
        
        return view('inicio');
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
        $objetos = Objeto::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $animales = Animales::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $arrollados = Arrollados::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $accidentados = Accidentados::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $personasajenas = Personasajenas::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $incidentesrelevantes = Incidentesrelevantes::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $puertas = Puertas::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $zapatas = Zapatas::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $cables = Cables::whereBetween('fecha',[$request->fecha,$request->fecha2])->count();
        $estaciones = Estacionessi::all();

        $numObjetos = [];
        $numAnimales = [];
        $numArrollados = [];
        $numAccidentes = [];
        $numPersonas = [];
        $numIncidentes = [];
        $numPuertas = [];
        $numCables = [];
        
        foreach ($estaciones as $estacion) {
            $numObjetos[$estacion->id_estacion]=Objeto::where([
                ['estacion','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
            $numAnimales[$estacion->id_estacion]=Animales::where([
                ['estacion','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
            $numArrollados[$estacion->id_estacion]=Arrollados::where([
                ['estacion','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
            $numAccidentes[$estacion->id_estacion]=Accidentados::where([
                ['estacion','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
            $numPersonas[$estacion->id_estacion]=Personasajenas::where([
                ['estacion','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
            $numIncidentes[$estacion->id_estacion]=Incidentesrelevantes::where([
                ['lugar','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
            $numPuertas[$estacion->id_estacion]=Puertas::where([
                ['estacion','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
            $numCables[$estacion->id_estacion]=Cables::where([
                ['estacion','=',$estacion->id_estacion],
                ['fecha', '>=', $request->fecha],
                ['fecha', '<=', $request->fecha2],
            ])->count();
        }

        $numtotal = $objetos+$animales+$arrollados+$accidentados+$personasajenas+$incidentesrelevantes+$puertas+$zapatas+$cables;
        $total = [];
        array_push($total,$objetos,$animales,$accidentados,$personasajenas,$incidentesrelevantes,$puertas,$zapatas,$numtotal,$cables,$arrollados);
        
        $respuesta = [
            'total' => $total,
            'objetos' => $numObjetos,
            'animales' => $numAnimales,
            'accidentados' => $numAccidentes,
            'personas' => $numPersonas,
            'incidentes' => $numIncidentes,
            'puertas' => $numPuertas,
            'cables' => $numCables,
            'arrollados' => $numArrollados
        ]; 

        return response()->json($respuesta,200);

        /* return $total; */

    }

    public function getAll(){
        $lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB'];

        $objetos = Objeto::all()->count();
        $animales = Animales::all()->count();
        $arrollados = Arrollados::all()->count();
        $accidentados = Accidentados::all()->count();
        $personasajenas = Personasajenas::all()->count();
        $incidentesrelevantes = Incidentesrelevantes::all()->count();
        $puertas = Puertas::all()->count();
        $zapatas = Zapatas::all()->count();
        $cables = Cables::all()->count();
        $estaciones = Estacionessi::all();

        $numObjetos = [];
        $numAnimales = [];
        $numArrollados = [];
        $numAccidentes = [];
        $numPersonas = [];
        $numIncidentes = [];
        $numPuertas = [];
        $numCables = [];
        
        foreach ($estaciones as $estacion) {
            $numObjetos[$estacion->id_estacion]=Objeto::where('estacion','=',$estacion->id_estacion)->count();
            $numAnimales[$estacion->id_estacion]=Animales::where('estacion','=',$estacion->id_estacion)->count();
            $numArrollados[$estacion->id_estacion]=Arrollados::where('estacion','=',$estacion->id_estacion)->count();
            $numAccidentes[$estacion->id_estacion]=Accidentados::where('estacion','=',$estacion->id_estacion)->count();
            $numPersonas[$estacion->id_estacion]=Personasajenas::where('estacion','=',$estacion->id_estacion)->count();
            $numIncidentes[$estacion->id_estacion]=Incidentesrelevantes::where('lugar','=',$estacion->id_estacion)->count();
            $numPuertas[$estacion->id_estacion]=Puertas::where('estacion','=',$estacion->id_estacion)->count();
            $numCables[$estacion->id_estacion]=Cables::where('estacion','=',$estacion->id_estacion)->count();
        }
        $numtotal = $objetos+$animales+$arrollados+$accidentados+$personasajenas+$incidentesrelevantes+$puertas+$zapatas+$cables;

        $total = [];

        array_push($total,$objetos,$animales,$accidentados,$personasajenas,$incidentesrelevantes,$puertas,$zapatas,$numtotal,$cables,$arrollados);


        $respuesta = [
            'total' => $total,
            'objetos' => $numObjetos,
            'animales' => $numAnimales,
            'arrollados' => $numArrollados,
            'accidentados' => $numAccidentes,
            'personas' => $numPersonas,
            'incidentes' => $numIncidentes,
            'puertas' => $numPuertas,
            'cables' => $numCables,
        ]; 

        return response()->json($respuesta,200);
        /* return $total; */
    }
}
