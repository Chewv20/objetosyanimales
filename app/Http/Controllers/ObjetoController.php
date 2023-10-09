<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lineas;
use App\Models\Objeto;
use App\Models\Estaciones;
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
        $objeto = Objeto::where('id',$id)->get();
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();

        return view('objetos-update',compact('objeto','lineas','estaciones'));
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
        DB::update('update objetos set linea=?, fecha = ?, estacion=?, retardo= ?, corte_corriente=?, tipo_objeto=? where id = ?', [$request->linea,$request->fecha,$request->estacion, $request->retardo, $request->corte_corriente,$request->tipo_objeto,$id]);
        return redirect('objeto');
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
        DB::table('objetos')->where('id', $id)->delete();
        return redirect('objeto');
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
        $lineas = Lineas::all();
        $estaciones = Estaciones::all();


        foreach ($objetos as $objeto) {
            foreach ($lineas as $linea) {
                if ($objeto->linea==$linea->id_linea) {
                    $objeto->linea=$linea->linea;
                }
            }

            foreach ($estaciones as $estacion) {
                if ($objeto->estacion==$estacion->id_estacion) {
                    $objeto->estacion=$estacion->estacion;
                }
            }
        }

        return datatables($objetos)->toJson();
    }
}
