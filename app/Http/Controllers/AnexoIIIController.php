<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnexoIIIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        
        return view('anexoIII');
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
        //
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

    public function get(Request $request)
    {
        $eventos = DB::connection('pgsql')
        ->table('evento')
        ->where([        
        ['fecha',$request->fecha],
        ])
        ->orderBy('hora')
        ->get();

        return $eventos;
    }
    
    public function getVueltas(Request $request)
    {
        if($request->festivo == 1){
            $vueltas = DB::connection('pgsql')
            ->table('vueltas')
            ->where([        
            ['id_numerico',7],
            ])
            ->orderBy('linea','asc')
            ->get();

            return $vueltas;
        }else{
            $vueltas = DB::connection('pgsql')
            ->table('vueltas')
            ->where([        
            ['id_numerico',$request->id],
            ])
            ->orderBy('linea','asc')
            ->get();

            return $vueltas;
        }
    }
}
