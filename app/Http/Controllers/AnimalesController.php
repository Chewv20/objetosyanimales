<?php

namespace App\Http\Controllers;

use App\Models\Animales;
use App\Models\Estaciones;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();
        

        return view('animales',compact('lineas'));
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
        Animales::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animales = Animales::where('id',$id)->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();

        return view('animales-update',compact('animales','lineas','estaciones'));
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
        Animales::where('id',$id)
        ->update([
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
            'linea'=>$request->linea,
            'estacion'=>$request->estacion,
            'descripcion'=>$request->descripcion,
            'status'=>$request->status,
            'retardo'=>$request->retardo,
            'usu_correccion'=>$request->usu_correccion,
        ]);

        return redirect('animales');
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
        $animales = Animales::find($id);
        $animales->delete();
        return redirect('animales');
    }

    public function getReporte(Request $request)
    {
        $animales = DB::table('animales')
        ->where([
            ['fecha',$request->fecha],
            ['hora',$request->hora],
            ['linea',$request->linea],
            ['estacion',$request->estacion],
            ['descripcion',$request->descripcion],
            ['status',$request->status],
            ['retardo',$request->retardo],
        ])
        ->orderBy('id')
        ->get();

        return $animales;
    }

    public function get()
    {
        $animales = Animales::all();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($animales as $animal) {
            foreach ($lineas as $linea) {
                if ($animal->linea==$linea->id_linea) {
                    $animal->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($animal->estacion==$estacion->id_estacion) {
                    $animal->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($animales)->toJson();
    }
}
