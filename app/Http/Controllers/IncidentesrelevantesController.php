<?php

namespace App\Http\Controllers;

use App\Models\Estaciones;
use App\Models\Estaciones2;
use App\Models\Incidentesrelevantes;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IncidentesrelevantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();

        return view('incidentes',compact('lineas'));
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
        Incidentesrelevantes::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incidentes = Incidentesrelevantes::where('id',$id)->get();
        $lineas = Lineas::all();

        return view('incidentes-update',compact('incidentes','lineas'));
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
        Incidentesrelevantes::where('id',$id)
        ->update([
            'linea'=>$request->linea,
            'fecha'=>$request->fecha,
            'lugar'=>$request->lugar,
            'evento'=>$request->evento,
            'usu_correccion'=>$request->usu_correccion,
        ]);

        return redirect('incidentesrelevantes');
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
        DB::table('incidentesrelevantes')->where('id', $id)->delete();
        return redirect('incidentes');
    }

    public function getReporte(Request $request)
    {
        $incidentes = DB::table('incidentesrelevantes')
        ->where([
            ['linea',$request->linea],
            ['lugar',$request->lugar],
            ['evento',$request->evento],
            ['fecha',$request->fecha],
        ])
        ->orderBy('id')
        ->get();

        return $incidentes;
    }

    public function get()
    {
        $incidentes = Incidentesrelevantes::all();
        $lineas = Lineas::all();
        $estaciones = Estaciones2::all();


        foreach ($incidentes as $incidente) {
            foreach ($lineas as $linea) {
                if ($incidente->linea==$linea->id_linea) {
                    $incidente->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($incidente->lugar==$estacion->id_estacion) {
                    $incidente->lugar=$estacion->estacion;
                }
            }
        }

        return datatables($incidentes)->toJson();
    }

    public function getFiltro(Request $request)
    {
        $incidentes = DB::table('incidentesrelevantes')
        ->whereDate('fecha','>=',$request->fecha1,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones2::all();


        foreach ($incidentes as $incidente) {
            foreach ($lineas as $linea) {
                if ($incidente->linea==$linea->id_linea) {
                    $incidente->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($incidente->lugar==$estacion->id_estacion) {
                    $incidente->lugar=$estacion->estacion;
                }
            }
        }

        return datatables($incidentes)->toJson();
    }
}
