<?php

namespace App\Http\Controllers;

use App\Models\Estaciones2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Estaciones2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Estaciones2 $estaciones2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estaciones2 $estaciones2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estaciones2 $estaciones2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estaciones2 $estaciones2)
    {
        //
    }

    public function get(Request $request)
    {
        $estaciones2 = DB::table('estaciones2')
        ->where('linea',$request->linea)
        ->orderBy('id_estacion')
        ->get();
        
        return $estaciones2;
    }
}
