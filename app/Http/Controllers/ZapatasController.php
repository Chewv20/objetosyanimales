<?php

namespace App\Http\Controllers;

use App\Models\Zapatas;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZapatasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineas = Lineas::all();

        return view('zapatas',compact('lineas'));
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
        Zapatas::create($request->all());

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $zapatas = Zapatas::where('id',$id)->get();
        $lineas = Lineas::all();

        return view('zapatas-update',compact('zapatas','lineas'));

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
    public function update(Request $request,string $id)
    {
        Zapatas::where('id',$id)
        ->update([
            'linea'=>$request->linea,
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
            'descripcion'=>$request->descripcion,
            'humo'=>$request->humo,
            'usu_correccion'=>$request->usu_correccion,
        ]);

        return redirect('zapatas');
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
        $zapatas = Zapatas::find($id);
        $zapatas->delete();
        return redirect('zapatas');
    }

    public function getReporte(Request $request)
    {
        $zapatas = DB::table('zapatas')
        ->where([
            ['linea',$request->linea],
            ['hora',$request->hora],
            ['descripcion',$request->descripcion],
            ['fecha',$request->fecha],
            ['humo',$request->humo],
        ])
        ->orderBy('id')
        ->get();

        return $zapatas;
    }

    public function get()
    {
        $zapatas = Zapatas::all();
        $lineas = Lineas::all();


        foreach ($zapatas as $zapata) {
            foreach ($lineas as $linea) {
                if ($zapata->linea==$linea->id_linea) {
                    $zapata->linea=$linea->linea;
                }
            }
        }

        return datatables($zapatas)->toJson();
    }

    public function getFiltro(Request $request)
    {
        $zapatas = DB::table('zapatas')
        ->whereDate('fecha','>=',$request->fecha1,'and')
        ->whereDate('fecha','<=',$request->fecha2)
        ->get();
        $lineas = Lineas::all();


        foreach ($zapatas as $zapata) {
            foreach ($lineas as $linea) {
                if ($zapata->linea==$linea->id_linea) {
                    $zapata->linea=$linea->linea;
                }
            }
        }

        return datatables($zapatas)->toJson();
    }
}
