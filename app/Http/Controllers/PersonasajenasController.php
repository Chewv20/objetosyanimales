<?php

namespace App\Http\Controllers;

use App\Models\Lineas;
use App\Models\Estaciones;
use App\Models\Personasajenas;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonasajenasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();
        

        return view('personasajenas',compact('lineas'));
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
        Personasajenas::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $personasajenas = Personasajenas::where('id',$id)->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();

        return view('personasajenas-update',compact('personasajenas','lineas','estaciones'));
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
        Personasajenas::where('id',$id)
        ->update([
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
            'linea'=>$request->linea,
            'estacion'=>$request->estacion,
            'descripcion'=>$request->descripcion,
            'genero'=>$request->genero,
            'edad'=>$request->edad,
            'retardo'=>$request->retardo,
            'usu_correccion'=>$request->usu_correccion,
        ]);

        return redirect('personasajenas');
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
        $personasajenas = Personasajenas::find($id);
        $personasajenas->delete();
        return redirect('personasajenas');
    }

    public function getReporte(Request $request)
    {
        $personasajenas = DB::table('personasajenas')
        ->where([
            ['fecha',$request->fecha],
            ['hora',$request->hora],
            ['linea',$request->linea],
            ['estacion',$request->estacion],
            ['descripcion',$request->descripcion],
            ['genero',$request->genero],
            ['edad',$request->edad],
            ['retardo',$request->retardo],
        ])
        ->orderBy('id')
        ->get();

        return $personasajenas;
    }

    public function get()
    {
        $personasajenas = Personasajenas::all();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($personasajenas as $personaajena) {
            foreach ($lineas as $linea) {
                if ($personaajena->linea==$linea->id_linea) {
                    $personaajena->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($personaajena->estacion==$estacion->id_estacion) {
                    $personaajena->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($personasajenas)->toJson();
    }

    public function getFiltro(Request $request)
    {
        $personasajenas = DB::table('personasajenas')
        ->whereDate('fecha','>=',$request->fecha1,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($personasajenas as $personaajena) {
            foreach ($lineas as $linea) {
                if ($personaajena->linea==$linea->id_linea) {
                    $personaajena->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($personaajena->estacion==$estacion->id_estacion) {
                    $personaajena->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($personasajenas)->toJson();
    }
}
