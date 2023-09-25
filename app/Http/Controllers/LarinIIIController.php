<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LarinIIIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $larin = DB::connection('pgsql')
        ->table('vueltas')
        ->orderBy('linea','asc')
        ->get();

        $heads = [
            ['label' => 'Línea'],
            ['label'=>  'Día de la semana'],
            ['label' => 'Vueltas'],
            ['label' => 'Acciones', 'no-export' => true]
        ];

        return view('larinIII',compact('larin','heads'));
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
        $larin = DB::connection('pgsql')
        ->table('vueltas')
        ->where('id',$id)
        ->get();

        return view('lariniii-update',compact('larin'));
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
        DB::update('update vueltas set vueltas = ? where id = ?', [$request->vueltas, $id]);
        return redirect('larinIII');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
