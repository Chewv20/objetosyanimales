<?php

namespace App\Http\Controllers;

use App\Models\Puertas;
use App\Models\Estacionesvias;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PuertasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();

        return view('puertas',compact('lineas'));
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
        Puertas::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $puertas = Puertas::where('id',$id)->get();
        $lineas = Lineas::all();

        return view('puertas-update',compact('puertas','lineas'));
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
        Puertas::where('id',$id)
        ->update([
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
            'linea'=>$request->linea,
            'estacion'=>$request->estacion,
            'descripcion'=>$request->descripcion,
            'puerta_opuesta'=>$request->puerta_opuesta,
            'desalojo'=>$request->desalojo,
            'asistencia_policia'=>$request->asistencia_policia,
            'usu_correccion'=>$request->usu_correccion,
        ]);

        return redirect('puertas');
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
        $puertas = Puertas::find($id);
        $puertas->delete();
        return redirect('puertas');
    }

    public function getReporte(Request $request)
    {
        $puertas = DB::table('puertas')
        ->where([
            ['fecha',$request->fecha],
            ['hora',$request->hora],
            ['linea',$request->linea],
            ['estacion',$request->estacion],
            ['via',$request->via],
            ['descripcion',$request->descripcion],
            ['puerta_opuesta',$request->status],
            ['desalojo',$request->genero],
            ['asistencia_policia',$request->edad],
        ])
        ->orderBy('id')
        ->get();

        return $puertas;
    }

    public function get()
    {
        $puertas = Puertas::all();
        $lineas = Lineas::all();
        $estaciones = Estacionesvias::all();


        foreach ($puertas as $puerta) {
            foreach ($lineas as $linea) {
                if ($puerta->linea==$linea->id_linea) {
                    $puerta->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($puerta->estacion==$estacion->id_estacion) {
                    $puerta->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($puertas)->toJson();
    }

    public function getFiltro(Request $request)
    {
        $puertas = DB::table('puertas')
        ->whereDate('fecha','>=',$request->fecha1,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();
        $lineas = Lineas::all();
        $estaciones = Estacionesvias::all();


        foreach ($puertas as $puerta) {
            foreach ($lineas as $linea) {
                if ($puerta->linea==$linea->id_linea) {
                    $puerta->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($puerta->estacion==$estacion->id_estacion) {
                    $puerta->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($puertas)->toJson();
    }
}
