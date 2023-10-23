<?php

namespace App\Http\Controllers;

use App\Models\Estacionessi;
use Illuminate\Http\Request;

class EstacionessiController extends Controller
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
    public function show(Estacionessi $estacionessi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estacionessi $estacionessi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estacionessi $estacionessi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estacionessi $estacionessi)
    {
        //
    }

    public function get(Request $request)
    {
        $estaciones = Estacionessi::where('linea',$request->linea)
                                ->orderBy('id_estacion')
                                ->get();
        
        return $estaciones;
    }
}
