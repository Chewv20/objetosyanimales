<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PhpParser\Node\Expr\AssignOp\Concat;
use iio\libmergepdf\Merger;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $larines = DB::connection('pgsql')
        ->table('larines')
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
        if($request->vueltas > 1 ){
            $descr_larga = $request->descripcion." "."Pierde ".$request->vueltas." vueltas";
        }else if($request->vueltas == 0){
            $descr_larga = $request->descripcion;
        }else{
            $descr_larga = $request->descripcion." "."Pierde ".$request->vueltas." vuelta";
        }
        $fec_mov = date("Y-m-d");
        $hor_mov = date('H:i');
        
        DB::update('update folio set folio = ? where anio = ?', [$consulta_id[0]->folio+1,$anio]);
        DB::insert('insert into evento (id, fecha, linea, hora, larin, retardo, vueltas, descripcion,usuario,hor_mov,fecha_mov) values (?,?,?,?, ?, ?, ?, ?, ?, ?, ?)', [$id, $request->fecha, $request->linea, $request->hora, $request->larin, $request->retardo, $request->vueltas, $descr_larga, $request->usuario, $hor_mov,$fec_mov]);

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
        $larines = DB::connection('pgsql')
        ->table('larines')
        ->where('clave_larin', $request->id_larin)
        ->orderBy('id_larin','asc')
        ->get();

        return response()->json($larines,200);
    }

    public function getLineaF(Request $request)
    {
        $eventos = DB::connection('pgsql')
            ->table('evento')
            ->where([
            ['linea',$request->linea],
            ['fecha',$request->fecha],
            ['retardo','>=',$request->tiempo],
            ['vueltas',$request->vueltas,0],
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

            return datatables($eventos)->toJson(); 
        
    }

    public function getLinea(Request $request)
    {
        $eventos = DB::connection('pgsql')
            ->table('evento')
            ->where([
            ['linea',$request->linea],
            ['fecha',$request->fecha],
            ])
            ->orderBy('hora')
            ->get();

            return datatables($eventos)->toJson(); 
        
    }

    public function getReporte(Request $request)
    {
        if(isset($request)){
            $comprueba = DB::connection('pgsql')
            ->table('evento')
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

    public function imprimir($fecha,$oficio)
    {
        $eventos = DB::connection('pgsql')
            ->table('evento')
            ->where([
                ['fecha',$fecha],
            ])
            ->orderBy('hora','desc')
            ->get();

        $pdf = \PDF::loadView('PDF/ido-caratula', compact('eventos','fecha','oficio'));
        $pdf2 = \PDF::loadView('PDF/ido', compact('eventos','fecha','oficio'));
        $pdf->render();
        $pdf2->render();
        $caratula = 'caratula.pdf';
        $ido = 'ido_'.$fecha.'.pdf';
        $pdf->save('../public/pdf/'.$caratula);
        $pdf2->save('../public/pdf/ido.pdf');

        $pdfMerger = PDFMerger::init();

        $pdfMerger->addPDF(base_path('public/pdf/'.$caratula), 'all');
        $pdfMerger->addPDF(base_path('public/pdf/'.'ido.pdf'), 'all');

        $pdfMerger->merge();
        //return $pdf->download('ejemplo.pdf');
        //return $pdf2->stream(); 

        $pdfMerger->save($ido, "download");
        //return $pdf2->stream();                     
    }
}
