<?php

namespace App\Http\Controllers;

use App\Models\Cables;
use App\Models\Estaciones;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CablesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();

        return view('cables', compact('lineas'));
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
        Cables::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cables = Cables::where('id',$id)->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();

        return view('cables-update', compact('cables','lineas','estaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cables $cables)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Cables::where('id',$id)
        ->update([
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
            'linea'=>$request->linea,
            'estacion'=>$request->estacion,
            'ubicacion'=>$request->ubicacion,
            'metrosrobados'=>$request->metrosrobados,
            'descripcion'=>$request->descripcion,
            'usu_correccion'=>$request->usu_correccion,
        ]);

        return redirect('cables');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cables $cables)
    {
        //
    }
    
    public function delete(string $id)
    {
        $cables = Cables::find($id);
        $cables->delete();
        return redirect('cables');
    }

    public function getReporte(Request $request)
    {
        $cables = DB::table('cables')
        ->where([
            ['fecha',$request->fecha],
            ['hora',$request->hora],
            ['linea',$request->linea],
            ['estacion',$request->estacion],
            ['ubicacion',$request->ubicacion],
            ['metrosrobados',$request->metrosrobados],
            ['descripcion',$request->descripcion],
        ])
        ->orderBy('id')
        ->get();

        return $cables;
    }

    public function get()
    {
        $cables = Cables::all();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($cables as $cable) {
            foreach ($lineas as $linea) {
                if ($cable->linea==$linea->id_linea) {
                    $cable->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($cable->estacion==$estacion->id_estacion) {
                    $cable->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($cables)->toJson();
    }

    public function getFiltro(Request $request)
    {
        $cables = DB::table('cables')
        ->whereDate('fecha','>=',$request->fecha1,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($cables as $cables) {
            foreach ($lineas as $linea) {
                if ($cables->linea==$linea->id_linea) {
                    $cables->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($cables->estacion==$estacion->id_estacion) {
                    $cables->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($cables)->toJson();
    }
}
