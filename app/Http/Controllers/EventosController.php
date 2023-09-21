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
        ->orderBy('id','asc')
        ->get();

        $lineas = DB::connection('pgsql')
        ->table('lineas')
        ->orderBy('id_linea','asc')
        ->get();

        //$lineas = DB::select('select * from lineas order by id_linea asc');



        return view('eventos',compact('larines','lineas'));
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
        $vueltasP = 0;
        $vueltasR = 0;
        if($request->vueltas != ''){
            $vueltasP = $request->vueltas;
        }
        if($request->vueltasR != ''){
            $vueltasR = $request->vueltasR;
        }

        if($vueltasR > 1 ){
            $descr_larga = $request->descripcion." "."Realiza ".$vueltasR." vueltas";
        }else if($vueltasR == 0){
            $descr_larga = $request->descripcion;
        }else if($vueltasR > 0 && $vueltasR < 1){
            $descr_larga = $request->descripcion." "."Realiza ".$vueltasR." de vuelta";;
        }else if($vueltasR == 1 ){
            $descr_larga = $request->descripcion." "."Realiza ".$vueltasR." vuelta";
        }

        if($vueltasP > 1 ){
            $descr_larga = $request->descripcion." "."Pierde ".$vueltasP." vueltas";
        }else if($vueltasP > 0 && $vueltasP < 1){
            $descr_larga = $request->descripcion." "."Pierde ".$vueltasP." de vuelta";;
        }else if($vueltasP == 1){
            $descr_larga = $request->descripcion." "."Pierde ".$vueltasP." vuelta";
        }

        
        $fec_mov = date("Y-m-d");
        $hor_mov = date('H:i');
        
        DB::update('update folio set folio = ? where anio = ?', [$consulta_id[0]->folio+1,$anio]);
        DB::insert('insert into evento (id, fecha, linea, hora, larin, retardo, vueltas, descripcion,usuario,hor_mov,fecha_mov,vueltas_realizadas) values (?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?)', [$id, $request->fecha, $request->linea, $request->hora, $request->larin, $request->retardo, $vueltasP, $descr_larga, $request->usuario, $hor_mov,$fec_mov,$vueltasR]);

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
        $evento = DB::connection('pgsql')
        ->table('evento')
        ->where('id',$id)
        ->get();

        $linea = DB::connection('pgsql')
        ->table('lineas')
        ->orderBy('id_linea','asc')
        ->get();

        $larin = DB::connection('pgsql')
        ->table('larines')
        ->orderBy('id','asc')
        ->get();

        return view('anexoi-update',compact('evento','linea','larin'));
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

        DB::update('update evento set fecha=?, linea = ?, hora=?, larin = ?, vueltas=?, descripcion=?, retardo = ?, vueltas_realizadas=?, usu_correccion=?, fecha_correccion=?, hora_correccion=? where id = ?', [$request->fecha,$request->linea,$request->hora, $request->larin, $request->vueltas, $descr_larga,$request->retardo,$request->vueltas_realizadas,$request->usuario,$fec_mov,$hor_mov,$id]);
        return redirect('eventos');

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
        DB::table('evento')->where('id', $id)->delete();
        return redirect('eventos');
    }

    public function getLarin(Request $request)
    {
        $larines = DB::connection('pgsql')
        ->table('larines')
        ->where('clave_larin', $request->id_larin)
        ->orderBy('id','asc')
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
                ['descripcion',$request->descripcion],
            ])
            ->orderBy('hora','desc')
            ->get();

            return response()->json($comprueba,200);
        }
    }

    public function imprimir($fecha,$oficio)
    {
        $lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB'];
        $vueltasPr = [];
        $vueltasP = [];
        $realizadas = [];
        $porcentaje = [];

        $eventos = DB::connection('pgsql')
        ->table('evento')
        ->where([
            ['fecha',$fecha],
        ])
        ->orderBy('hora','asc')
        ->get();
        
        $anexoii = DB::connection('pgsql')
        ->table('anexoii')
        ->where([
            ['fecha',$fecha],
        ])
        ->orderBy('hora','desc')
        ->get();

        $fcreado = date_create($fecha);
        $dia = date_format($fcreado, 'w');

        $vueltas = DB::connection('pgsql')
        ->table('vueltas')
        ->where([        
            ['id',$dia],
        ])
        ->orderBy('linea','asc')
        ->get();

        foreach ($lineas as $item) {
            foreach ($vueltas as $item2) {
                if($item==$item2->linea){
                    $vueltasPr[$item]=$item2->vueltas;
                }
            }
        }
        foreach ($lineas as $item) {
            $vueltasP[$item]=0;
        }
        foreach ($lineas as $item) {
            foreach ($eventos as $item2) {
                if($item==$item2->linea){
                    $vueltasP[$item]-=$item2->vueltas;
                    $vueltasP[$item]+=$item2->vueltas_realizadas;
                }
            }
        }
        foreach ($lineas as $item) {
            $realizadas[$item]=$vueltasPr[$item]+$vueltasP[$item];
            $porcentaje[$item]=$realizadas[$item]*100/$vueltasPr[$item];
        }

        $pdf = \PDF::loadView('PDF/ido-caratula', compact('eventos','fecha','oficio'));
        $pdf2 = \PDF::loadView('PDF/ido', compact('eventos','fecha','oficio','anexoii','vueltasPr','realizadas','porcentaje'));
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
        // return $pdf4->stream();                     
    }
}
