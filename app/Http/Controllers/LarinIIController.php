<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class LarinIIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $larin = DB::connection('pgsql')
        ->table('larinesii')
        ->orderBy('id_larin','asc')
        ->get();

        $heads = [
            ['label' => 'ID Larin'],
            ['label' => 'Tipo de Larin'],
            ['label'=>  'Clave del Larin'],
            ['label' => 'Descripcion Corta del Larin'],
            ['label' => 'Larin'],
            ['label' => 'Acciones', 'no-export' => true]
        ];

        return view('larinII',compact('larin','heads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('larinii-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::insert('insert into larinesii (tipo_larin, clave_larin, descripcion_corta_larin, larin) values (?, ?, ?, ?)', [$request->tipo_larin, $request->clave_larin,$request->descripcion_corta,$request->larin]);

        return redirect('larinII');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $larin = DB::connection('pgsql')
        ->table('larinesii')
        ->where('clave_larin',$id)
        ->get();

        return view('larinii-update',compact('larin'));
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
        DB::update('update larinesii set tipo_larin = ?, descripcion_corta_larin = ?, larin = ? where clave_larin = ?', [$request->tipo_larin,$request->descripcion_corta, $request->larin, $id]);
        return redirect('larinII');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('larinesii')->where('clave_larin', $id)->delete();
        return redirect('larinII');
    }

    public function get()
    {
        $anexoi = DB::connection('pgsql')
        ->table('larinesii')
        ->orderBy('id_larin')
        ->get();

        return datatables($anexoi)->toJson();
    }
}
