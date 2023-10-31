<?php

namespace App\Http\Controllers;

use App\Models\Arrollados;
use App\Models\Estaciones;
use App\Models\Lineas;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArrolladosController extends Controller
{
    public function index()
    {
        $lineas = Lineas::all();
        

        return view('arrollados',compact('lineas'));
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
        arrollados::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arrollados = Arrollados::where('id',$id)->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();

        return view('arrollados-update',compact('arrollados','lineas'));
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
        Arrollados::where('id',$id)
        ->update([
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
            'linea'=>$request->linea,
            'estacion'=>$request->estacion,
            'descripcion'=>$request->descripcion,
            'status'=>$request->status,
            'genero'=>$request->genero,
            'edad'=>$request->edad,
            'retardo'=>$request->retardo,
            'usu_correccion'=>$request->usu_correccion,
        ]);

        return redirect('arrollados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(string $id)
    {
        $arrollados = Arrollados::find($id);
        $arrollados->delete();
        return redirect('arrollados');
    }

    public function getReporte(Request $request)
    {
        $arrollados = DB::table('arrollados')
        ->where([
            ['fecha',$request->fecha],
            ['hora',$request->hora],
            ['linea',$request->linea],
            ['estacion',$request->estacion],
            ['descripcion',$request->descripcion],
            ['status',$request->status],
            ['genero',$request->genero],
            ['edad',$request->edad],
            ['retardo',$request->retardo],
        ])
        ->orderBy('id')
        ->get();

        return $arrollados;
    }

    public function get()
    {
        $arrollados = Arrollados::all();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($arrollados as $accidentado) {
            foreach ($lineas as $linea) {
                if ($accidentado->linea==$linea->id_linea) {
                    $accidentado->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($accidentado->estacion==$estacion->id_estacion) {
                    $accidentado->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($arrollados)->toJson();
    }

    public function getFiltro(Request $request)
    {
        $arrollados = DB::table('arrollados')
        ->whereDate('fecha','>=',$request->fecha1,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($arrollados as $accidentado) {
            foreach ($lineas as $linea) {
                if ($accidentado->linea==$linea->id_linea) {
                    $accidentado->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($accidentado->estacion==$estacion->id_estacion) {
                    $accidentado->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($arrollados)->toJson();
    }
}
