<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PhpParser\Node\Expr\AssignOp\Concat;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $larines = DB::connection('pgsql2')
        ->table('tbl_ido_larines')
        ->orderBy('id_larin','asc')
        ->get();

        $lineas = DB::select('select * from lineas order by id_linea asc');

        $eventos1 = DB::connection('pgsql')
        ->table('evento')
        ->where('linea','01')
        ->orderBy('id')
        ->get();

        return view('eventos',compact('larines','lineas','eventos1'));
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
        $anio = substr($request->fecha,0,4);
        $consulta_id = DB::connection('pgsql')
        ->table('folio')
        ->where('anio',$anio)
        ->select('folio')
        ->get();
        $id2 = 100000+$consulta_id[0]->folio+1;
        $id = "STC".substr(strval($anio),-2)."-".substr(strval($id2),1,5);   
        $descr_larga = "";
        if($request->vueltas > 1){
            $descr_larga = $request->descripcion." "."Pierde ".$request->vueltas." vueltas";
        }else{
            $descr_larga = $request->descripcion." "."Pierde ".$request->vueltas." vuelta";
        }

        DB::update('update folio set folio = ? where anio = ?', [$consulta_id[0]->folio+1,$anio]);
        DB::insert('insert into evento (id, fecha, linea, hora, larin, retardo, vueltas, descripcion) values (?, ?, ?, ?, ?, ?, ?, ?)', [$id, $request->fecha, $request->linea, $request->hora, $request->larin, $request->retardo, $request->vueltas, $descr_larga]);

        return redirect('/eventos');
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

    public function getLarin(Request $request)
    {
        $larines = DB::connection('pgsql2')
        ->table('tbl_ido_larines')
        ->where('clave_larin', $request->id_larin)
        ->orderBy('id_larin','asc')
        ->get();

        return response()->json($larines,200);
    }

    public function getLinea(Request $request)
    {
        if(isset($request)){
            $eventos = DB::connection('pgsql')
            ->table('evento')
            ->where([
            ['linea',$request->linea],
            ['fecha',$request->fecha],
            ['retardo','>=',$request->tiempo],    
            ])
            ->orderBy('hora')
            ->get();

            return datatables($eventos)->toJson();
        }
    }
}
