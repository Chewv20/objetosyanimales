<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AnexoiiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $larines = DB::connection('pgsql')
        ->table('larinesii')
        ->orderBy('id_larin','asc')
        ->get();

        $lineas = DB::connection('pgsql')
        ->table('lineas')
        ->orderBy('id_linea','asc')
        ->get();

        //$lineas = DB::select('select * from lineas order by id_linea asc');

        return view('anexoII',compact('larines','lineas'));
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
        ->table('folioanexoii')
        ->where('anio',$anio)
        ->select('folio')
        ->get();
        $id2 = 100000+$consulta_id[0]->folio+1;
        $id = "STC".substr(strval($anio),-2)."-".substr(strval($id2),1,5);   
        $fec_mov = date("Y-m-d");
        $hor_mov = date('H:i');
        
        DB::update('update folioanexoii set folio = ? where anio = ?', [$consulta_id[0]->folio+1,$anio]);
        DB::insert('insert into anexoii (id, fecha, linea, hora, larin,descripcion,usuario,hora_mov,fecha_mov) values (?,?, ?, ?, ?, ?, ?, ?, ?)', [$id, $request->fecha, $request->linea, $request->hora, $request->larin, $request->descripcion, $request->usuario, $hor_mov,$fec_mov]);

        $respuesta = [
            'success' => true,
            'id' => $id
        ];
        return $respuesta;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anexoii = DB::connection('pgsql')
        ->table('anexoii')
        ->where('id',$id)
        ->get();

        $linea = DB::connection('pgsql')
        ->table('lineas')
        ->orderBy('id_linea','asc')
        ->get();

        $larin = DB::connection('pgsql')
        ->table('larinesii')
        ->orderBy('id_larin','asc')
        ->get();

        return view('anexoii-update',compact('anexoii','linea','larin'));
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
        $fec_mov = date("Y-m-d");
        $hor_mov = date('H:i');

        DB::update('update anexoii set fecha=?, linea = ?, hora=?, larin = ?, descripcion=?, usu_correccion=?, fecha_correccion=?, hora_correccion=? where id = ?', [$request->fecha,$request->linea,$request->hora, $request->larin, $request->descripcion,$request->usuario,$fec_mov,$hor_mov,$id]);
        return redirect('anexoii');

        // return $request;
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
        DB::table('anexoii')->where('id', $id)->delete();
        return redirect('anexoii');

        /* return $id; */
    }

    public function getLarin(Request $request)
    {
        $larines = DB::connection('pgsql')
        ->table('larinesii')
        ->where('clave_larin', $request->id_larin)
        ->orderBy('id_larin','asc')
        ->get();

        return response()->json($larines,200);
    }

    public function getReporte(Request $request)
    {
        if(isset($request)){
            $comprueba = DB::connection('pgsql')
            ->table('anexoii')
            ->where([
                ['fecha',$request->fecha],
                ['hora',$request->hora],
                ['linea',$request->linea],
                ['larin',$request->larin],
            ])
            ->orderBy('hora','desc')
            ->get();

            return response()->json($comprueba,200);
        }
    }

    public function getLinea(Request $request)
    {
        $anexoii = DB::connection('pgsql')
            ->table('anexoii')
            ->where([
            ['linea',$request->linea],
            ['fecha',$request->fecha],
            ])
            ->orderBy('hora')
            ->get();

            return datatables($anexoii)->toJson(); 
        
    }

    public function getLineaF(Request $request)
    {
        $anexoii = DB::connection('pgsql')
            ->table('anexoii')
            ->where([
            ['linea',$request->linea],
            ['fecha',$request->fecha],
            ['descripcion','LIKE','%'.$request->desc1.'%'],
            ['descripcion','LIKE','%'.$request->desc2.'%'],
            ['descripcion','LIKE','%'.$request->desc3.'%'],
            ['descripcion','LIKE','%'.$request->desc4.'%'],
            ['descripcion','LIKE','%'.$request->desc5.'%'],
            ['descripcion','LIKE','%'.$request->desc6.'%'],
            ['descripcion','LIKE','%'.$request->desc7.'%'],
            ['descripcion','LIKE','%'.$request->desc8.'%'],
            ])
            ->orderBy('hora')
            ->get();

            return datatables($anexoii)->toJson(); 
        
    }


}
