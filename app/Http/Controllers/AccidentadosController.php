<?php

namespace App\Http\Controllers;

use App\Models\Accidentados;
use App\Models\Estaciones;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccidentadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();
        

        return view('accidentados',compact('lineas'));
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
        Accidentados::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $accidentados = Accidentados::where('id',$id)->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();

        return view('accidentados-update',compact('accidentados','lineas','estaciones'));
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
        Accidentados::where('id',$id)
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

        return redirect('accidentados');
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
        $accidentados = Accidentados::find($id);
        $accidentados->delete();
        return redirect('accidentados');
    }

    public function getReporte(Request $request)
    {
        $accidentados = DB::table('accidentados')
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

        return $accidentados;
    }

    public function get()
    {
        $accidentados = Accidentados::all();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($accidentados as $accidentado) {
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

        return datatables($accidentados)->toJson();
    }
}
